<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->category;
        $title = "Welcome to Product Page";
        $sub_title = "Find the best products at unbeatable prices!";

        if($category == null){
            $products = Product::paginate(4);
        }else{
            $products = Product::where('product_category_id', $category)->paginate(4)
            ->appends([
                'category' => $category,
            ]);
        }
        
        $categories = ProductCategory::all();

        $name = 'John';
        $age = 18;
        return view('home', compact('title', 'sub_title', 'products', 'categories', 'name', 'age'));
    }
}
