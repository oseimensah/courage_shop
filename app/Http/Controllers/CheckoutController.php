<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $total = 0;
        $cart = session()->get('cart');
        foreach ($cart as $id => $product) {
            $total += $product['price'] * $product['quantity'];
        }

        return view('shop.checkout', compact('total'));
    }
}
