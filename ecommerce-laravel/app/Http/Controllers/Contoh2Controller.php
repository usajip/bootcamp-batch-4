<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Contoh2Controller extends Controller
{
    public function index()
    {
        $title = "Contoh 2";
        
        return view('contoh2.index', compact('title'));
    }
}
