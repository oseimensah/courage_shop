<?php

namespace App\Http\Controllers;

use App\Http\Traits\HelperTrait;
use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    use HelperTrait;

    public function checkout()
    {
        $total = 0;
        $cart = session()->get('cart');
        foreach ($cart as $id => $product) {
            $total += $product['price'] * $product['quantity'];
        }
        $code = 'order-' . $this->unique_code();
        $url = route('checkout.pay', ['code' => $code,]);

        $order = new Order;
        $order->user_id = auth()->user()->id;
        $order->amount = $total;
        $order->uuid = Str::uuid();
        $order->code = $code;
        $order->order_date = now()->toDateTimeString();
        $order->link = $url;

        $order->save();
        foreach ($cart as $key => $item) {
            $order->product()->attach($item['id'], ['quantity' => $item['quantity'], 'price' => $item['price']]);
        }
        $order->refresh();

        return view('shop.checkout', compact('order'));
    }

    public function pay(Request $request)
    {
        $order = null;
        if ($request->code != null) {
            $order = Order::firstWhere('code', $request->code);
        }
        return view('shop.checkout', compact('order'));
    }
}
