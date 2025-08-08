<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $title = "Welcome to Product Page";
        $sub_title = "Find the best products at unbeatable prices!";
        $products = [
            [
                'name' => 'Laptop',
                'price' => 15000000,
                'stock' => 10,
                'image' =>'images/laptop.jpeg',
                'description' => 'High-performance laptop suitable for work and gaming.'
            ],
            [
                'name' => 'Smartphone',
                'price' => 7000000,
                'stock' => 25,
                'image' =>'images/laptop.jpeg',
                'description' => 'Latest smartphone with advanced features and great camera.'
            ],
            [
            'name' => 'Headphones',
            'price' => 1200000,
            'stock' => 50,
            'image' =>'images/laptop.jpeg',
            'description' => 'Comfortable headphones with excellent sound quality.'
            ],
            [
            'name' => 'Keyboard',
            'price' => 800000,
            'stock' => 30,
            'image' =>'images/laptop.jpeg',
            'description' => 'Mechanical keyboard for fast and accurate typing.'
            ],
            [
            'name' => 'Monitor',
            'price' => 3000000,
            'stock' => 15,
            'image' =>'images/laptop.jpeg',
            'description' => 'High-resolution monitor for crisp and clear visuals.'
            ]
        ];

        $name = 'John';
        $age = 18;
        return view('home', compact('title', 'sub_title', 'products', 'name', 'age'));
    }
}
