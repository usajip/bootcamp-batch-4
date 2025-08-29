<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ProductCategory::withCount('products')
                        ->withSum('products', 'stock')
                        ->withSum('products', 'price')
                        ->paginate(5);
        return view('admin.product_category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:30|unique:product_categories,name',
            // 'name' => ['required', 'string', 'max:2', 'unique:product_categories,name'],
        ]);

        // $name_check = ProductCategory::where('name', $request->name)->exists(); // true/false

        // if ($name_check) {
        //     return redirect()->back()->withErrors(['name' => 'Category name already exists.']);
        // }

        $category = new ProductCategory;
        $category->name = $request->name;
        $category->save();

        return redirect()->back()->with('success', 'Product category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductCategory $productCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $productCategory)
    {
        //
    }
}
