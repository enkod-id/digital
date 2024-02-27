<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class PosController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $products = Product::where('user_id', $user_id)->get();
        return view('pos.index', compact('products'));
    }
}
