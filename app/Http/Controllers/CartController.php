<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function cart()
    {
        return view('shop.cart');
    }

    public function addToCart($id) // by this function we add product of choose in card
    {
        $product = Product::find($id);

        if (!$product) {
            abort(404);
        }

        $cart = session()->get('cart');

        if (!$cart) {
            $cart = [
                $id => [
                    "name" => $product->name,
                    "quantity" => 1,
                    "price" => $product->price,
                    "photo" => $product->thumb_image_url
                ]
            ];

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Added to cart successfully!');
        }

        // if cart not empty then check if this product exist then increment quantity
        if (isset($cart[$id])) {

            $cart[$id]['quantity']++;

            session()->put('cart', $cart); // this code put product of choose in cart

            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "photo" => $product->thumb_image_url
        ];

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    // update product of choose in cart
    public function update(Request $request)
    {
        if ($request->id and $request->quantityType) {
            $cart = session()->get('cart');
            if ($request->quantityType == 'add') {
                $cart[$request->id]['quantity']++;
            } else {
                $cart[$request->id]['quantity']--;
            }
            // $cart[$request->id]["quantity"] = $request->quantity;

            session()->put('cart', $cart);

            session()->flash('success', 'Cart updated successfully');
        }
    }

    // delete or remove product of choose in cart
    public function remove(Request $request)
    {
        if ($request->id) {

            $cart = session()->get('cart');

            if (isset($cart[$request->id])) {

                unset($cart[$request->id]);

                session()->put('cart', $cart);
            }

            session()->flash('success', 'Product removed successfully');
        }
    }
}
