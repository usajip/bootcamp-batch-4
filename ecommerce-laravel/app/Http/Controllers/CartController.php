<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        // If the cart is empty or the product is not in the cart, add it
        if (!isset($cart[$id])) {
            $cart[$id] = [
                'image' => $product->image,
                'name' => $product->name,
                'quantity' => 1,
                'price' => $product->price,
            ];
        } else {
            // If the product is already in the cart, increment the quantity
            $cart[$id] = [
                'image' => $product->image,
                'name' => $product->name,
                'quantity' => $cart[$id]['quantity'] + 1,
                'price' => $product->price,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart')->with('success', 'Product added to cart successfully.');
    }
    
    public function updateQuantity(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $quantity = (int) $request->input('quantity', 1);
            if ($quantity > 0) {
                $product = Product::findOrFail($id);
                $cart[$id] = [
                'image' => $product->image,
                'name' => $product->name,
                'quantity' => $quantity,
                'price' => $product->price,
            ];
            } else {
                unset($cart[$id]);
            }
            session()->put('cart', $cart);
        }
        return redirect()->route('cart')->with('success', 'Cart updated successfully.');
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->route('cart')->with('success', 'Product removed from cart.');
    }
}
