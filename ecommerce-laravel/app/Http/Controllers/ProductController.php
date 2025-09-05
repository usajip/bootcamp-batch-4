<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::with('category');
        
        // Add search functionality
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhereHas('category', function($categoryQuery) use ($searchTerm) {
                      $categoryQuery->where('name', 'LIKE', '%' . $searchTerm . '%');
                  });
            });
        }
        
        $products = $query->paginate(5)->appends($request->query());
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ProductCategory::all();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048|mimes:jpeg,png,jpg,webp',
            'category_id' => 'required|exists:product_categories,id',
        ]);

        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->product_category_id = $request->category_id;

        // Handle image upload
        if ($request->hasFile('image')) {
            $product->image = $request->file('image')->store('products', 'images');
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        $sessionKey = 'product_clicked_' . $product->id;
        if (!session()->has($sessionKey)) {
            $product->increment('clicks');
            session()->put($sessionKey, true);
        }
        $product_recommendations = Product::where('product_category_id', $product->product_category_id)
                                        ->where('id', '!=', $product->id)
                                        ->inRandomOrder()
                                        ->take(4)
                                        ->get();
        return view('products.detail', compact('product', 'product_recommendations'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = ProductCategory::all();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    public function editProduct($id)
    {
        $product = Product::findOrFail($id); //mencari data di table products berdasarkan id, kalo tida ketemu redirect ke 404
        $categories = ProductCategory::all();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048|mimes:jpeg,png,jpg,webp',
            'category_id' => 'required|exists:product_categories,id',
        ]);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->product_category_id = $request->category_id;

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image) {
                Storage::disk('images')->delete($product->image);
            }
            $product->image = $request->file('image')->store('products', 'images');
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product "' . $product->name . '" updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Delete the product image if it exists
        if ($product->image) {
            Storage::disk('images')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product "' . $product->name . '" deleted successfully.');
    }
}
