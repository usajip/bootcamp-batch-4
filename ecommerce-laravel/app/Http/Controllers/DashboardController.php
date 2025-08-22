<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $productStock = Product::sum('stock');
        $totalCategories = ProductCategory::count();
        $totalClicks = 12340;

        $data = [
            [
                'title'=>'Jumlah Produk',
                'sub_title'=>'Total produk yang tersedia di sistem.',
                'bg_color'=>'linear-gradient(135deg, #369FFF 0%, #1E90FF 50%, #4169E1 100%)',
                'value'=> $totalProducts
            ],
            [
                'title'=>'Jumlah Stok Produk',
                'sub_title'=>'Total stok produk yang tersedia di sistem.',
                'bg_color'=>'linear-gradient(135deg, #28a745 0%, #20c997 50%, #17a2b8 100%)',
                'value'=> $productStock
            ],
            [
                'title'=>'Jumlah Kategori Produk',
                'sub_title'=>'Total kategori produk yang tersedia di sistem.',
                'bg_color'=>'linear-gradient(135deg, #fd7e14 0%, #ffc107 50%, #e83e8c 100%)',
                'value'=> $totalCategories
            ],
            [
                'title'=>'Jumlah Klik Produk',
                'sub_title'=>'Total klik pada produk yang telah dilihat pengguna.',
                'bg_color'=>'linear-gradient(135deg, #6f42c1 0%, #e83e8c 50%, #dc3545 100%)',
                'value'=> $totalClicks
            ]
        ];

        return view('dashboard', compact('data'));
    }
}
