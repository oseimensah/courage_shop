<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Log;

class Home extends Component
{
    public $cart = [];
    public $featuredProducts = [];
    public $products = [];
    public $categories = [];
    public $cart_value = 0;
    public $showCart = false;
    public $showProduct = false;
    public Product $selectedProduct;
    public $total = 0;

    public function mount()
    {
        $this->featuredProducts = Product::where('featured', '1')->latest()->get();
        $this->products = Product::where('featured', '0')->latest()->get();
        $this->categories = Category::latest()->get();

        if (session('cart')) {
            $this->cart = session('cart');
            $this->cart_value = count(session('cart'));
            // dd($this->cart_value);
        }
    }

    public function render()
    {
        return view('livewire.home');
    }

    // methods
    public function viewProduct($id)
    {
        $this->showProduct = true;
        $this->selectedProduct = Product::firstWhere('id', $id);
        // dd($this->selectedProduct);
    }

    public function closeProduct()
    {
        // Log::critical($this->selectedProduct);
        $this->showProduct = false;
        // $this->selectedProduct = null;
        // Log::critical($this->selectedProduct);
    }

    public function addToCart($product)
    {
        if (isset($this->cart[$product['id']])) {
            $this->cart[$product['id']]['quantity']++;
            $this->cart[$product['id']]['amount'] = $this->cart[$product['id']]['price'] * $this->cart[$product['id']]['quantity'];
            $this->emit('swal', $product['name'] . ' already added to cart', 'info');
        } else {
            $this->cart[$product['id']] = [
                'id' => $product['id'],
                "name" => $product['name'],
                "quantity" => 1,
                "price" => $product['price'],
                "amount" => $product['price'],
                "photo" => $product['thumb_image_url']
            ];
            $this->cart_value = $this->cart_value + 1;
            $this->emit('swal', $product['name'] . ' added to cart', 'info');
        }

        // if item not exist in cart then add to cart with quantity = 1
        // $this->cart[$product['id']] = [
        //     'id' => $product['id'],
        //     "name" => $product['name'],
        //     "quantity" => 1,
        //     "price" => $product['price'],
        //     "amount" => $product['price'],
        //     "photo" => $product['thumb_image_url']
        // ];

        // $flag = false;
        // if ($this->cart_value > 0) {
        //     foreach ($this->cart as $cart) {
        //         if ($cart['id'] === $product['id']) {
        //             $flag = true;
        //             // dd($product);
        //             break;
        //         }
        //     }
        // }
        // if (!$flag) {
        //     $this->cart_value = $this->cart_value + 1;
        //     $this->cart[] = [
        //         'id' => $product['id'],
        //         'name' => $product['name'],
        //         'image' => $product['thumb_image_url'],
        //         'description' => $product['description'],
        //         'price' => $product['price'],
        //         'amount' => $product['price'],
        //         'quantity' => 1
        //     ];

        //     // dd($this->cart);
        //     $this->calculateTotal();
        // }
    }

    public function removeFromCart($key)
    {
        $this->cart_value = $this->cart_value - 1;
        unset($this->cart[$key]);
        array_values($this->cart);
        $this->calculateTotal();
    }

    public function showCartContent()
    {
        if ($this->showCart != true) {
            $this->showCart = true;
        } else {
            $this->showCart = false;
        }
    }

    public function calculateSubTotal($key)
    {
        $this->cart[$key]['amount'] = $this->cart[$key]['price'] * $this->cart[$key]['quantity'];
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->total = 0;

        foreach ($this->cart as $cart) {
            $this->total = $this->total + $cart['amount'];
        }
    }

    public function gotoCheckout()
    {
        session()->put('cart', $this->cart);
        return redirect()->route('carts');
    }
}
