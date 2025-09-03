<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('checkout', compact('cart'));
    }

    public function processCheckout(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);

        $name = $request->input('name');
        $phone = $request->input('phone');
        $address = $request->input('address');


        // Format checkout details for WhatsApp
        $message = "*Checkout Order*%0A";
        $message .= "Nama: $name%0A";
        $message .= "No. HP: $phone%0A";
        $message .= "Alamat: $address%0A";
        $message .= "%0A*Detail Pesanan:*%0A";
        $total = 0;
        foreach ($cart as $item) {
            $lineTotal = $item['quantity'] * $item['price'];
            $total += $lineTotal;
            $message .= "- {$item['name']} x{$item['quantity']} = Rp " . number_format($lineTotal, 0, ',', '.') . "%0A";
        }
        $message .= "%0A*Total Belanja: Rp " . number_format($total, 0, ',', '.') . "*";

        // WhatsApp number (replace with your business number)
        $waNumber = '6281234567890';
        $waUrl = "https://wa.me/$waNumber?text=$message";

        // Clear the cart after successful checkout
        session()->forget('cart');

        return redirect()->away($waUrl);
    }
}
