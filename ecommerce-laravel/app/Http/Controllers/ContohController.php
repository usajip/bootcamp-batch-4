<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContohController extends Controller
{
    public function logika()
    {
       return "Ini adalah contoh logika dalam controller.";
    }

    public function tambah($a, $b)
    {
        return $a + $b;
    }

    public function index()
    {
        $title = "Welcome to Product Page";
        $sub_title = "Find the best products at unbeatable prices!";
        $products = [
            [
            'name' => 'Laptop',
            'price' => 15000000,
            'stock' => 10
            ],
            [
            'name' => 'Smartphone',
            'price' => 7000000,
            'stock' => 25
            ],
            [
            'name' => 'Headphones',
            'price' => 1200000,
            'stock' => 50
            ],
            [
            'name' => 'Keyboard',
            'price' => 800000,
            'stock' => 30
            ],
            [
            'name' => 'Monitor',
            'price' => 3000000,
            'stock' => 15
            ]
        ];
        return view('products.index', compact('title', 'sub_title', 'products'));
    }
}
