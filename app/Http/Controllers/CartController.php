<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Auth;

class CartController extends Controller
{
    public function addToCart(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        // Cek apakah produk ada dan kuantitas valid
        if (!$product || $request->quantity <= 0) {
            return redirect()->back()->with('error', 'Invalid product or quantity.');
        }

        // Tambahkan produk ke keranjang
        $cart = new Cart();
        $cart->user_id = Auth::id();
        $cart->product_id = $product->id;
        $cart->product_name = $product->name;
        $cart->quantity = $request->quantity;
        $cart->price = $product->price;
        $cart->total_price = $product->price * $request->quantity;
        $cart->save();

        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully.');
    }

    public function index()
    {
        // Ambil data keranjang untuk pengguna yang sedang login
        $userCart = Cart::where('user_id', Auth::id())->get();
        return view('cart.index', compact('userCart'));
    }

    public function removeFromCart($cartId)
    {
        $cart = Cart::findOrFail($cartId);
        $cart->delete();
        return redirect()->route('cart.index')->with('success', 'Product removed from cart successfully.');
    }
}
