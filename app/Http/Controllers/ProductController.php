<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function productList()
    {
        $products = Product::all();

        if(Auth::user() != null)
            return view('livewire.products', compact('products'));
        else
            return redirect()->route('dashboard');
    }

    public function cartList()
    {
        return view('livewire.cart');
    }

    public function addToCart(Request $request)
    {
        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $request->image,
            )
        ]);
        session()->flash('success', 'Produkt został dodany prawidłowo do koszyka!');

        return redirect()->route('cart.list');
    }
    
}