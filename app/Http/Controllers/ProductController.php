<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.product.home', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::latest()->get();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required'],
            'description' => ['required'],
            'image' => ['required', 'image',],
        ]);

        $product = Product::create([
            'category_id' => $request->category,
            'name' => $request->name,
            'price' => $request->price,
            'discount' => '0',
            'description' => $request->description,
            'featured' => $request->featured ? 1 : 0,
        ]);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $product->addMediaFromRequest('image')->toMediaCollection('product_image');
        }

        return redirect()->route('admin.products');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product.view', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::latest()->get();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'category' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required'],
            'description' => ['required'],
        ]);

        $product = Product::findOrFail($id);
        $product->category_id = $request->category;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->featured = $request->featured ? 1 : 0;

        $product->save();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $product->addMediaFromRequest('image')->toMediaCollection('product_image');
        }
        return redirect()->route('admin.products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products');
    }
}
