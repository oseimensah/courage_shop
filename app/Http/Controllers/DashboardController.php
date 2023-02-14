<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pays = Payment::all()->pluck('amount')->toArray();
        $orders = Order::all()->count();
        $products = Product::all()->count();
        $payments = array_sum($pays);
        // dd($products);
        return view('admin.dashboard', compact('payments', 'products', 'orders'));
    }
}
