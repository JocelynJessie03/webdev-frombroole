<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('pro_delete', false)->get();

        return view('pos', compact('products'));
    }



    public function create()
    {
        return view('products.create');
    }



  public function store(Request $request)
{
    $request->validate([
        'pro_name' => 'required',
        'pro_price' => 'required|numeric',
        'pro_currstock' => 'required|numeric',
        'pro_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);



    $imageName = null;

    if($request->hasFile('pro_image'))
    {
        $imageName = time().'.'.$request->pro_image->extension();

        $request->pro_image->move(
            public_path('products'),
            $imageName
        );
    }



    Product::create([

        'pro_ID' => 'PRO'.rand(1000,9999),

        'pro_name' => $request->pro_name,

        'pro_description' => $request->pro_description,

        'pro_price' => $request->pro_price,

        'pro_currstock' => $request->pro_currstock,

        'pro_image' => $imageName,

        'pro_delete' => false,
    ]);



    return redirect('/pos');
}
    
}