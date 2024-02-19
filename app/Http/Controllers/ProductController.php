<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Menampilkan semua data produk
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    // Menampilkan form untuk membuat produk baru
    public function create()
    {
        return view('products.create');
    }

    // Menyimpan produk baru ke dalam database
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
        ]);

        // Upload gambar
        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('images'), $imageName);

        // Simpan produk baru ke dalam database
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'status' => $request->status ?? 'available',
            'image' => $imageName,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    // Menampilkan detail produk
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // Menampilkan form untuk mengedit produk
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // Memperbarui produk dalam database
    public function update(Request $request, Product $product)
    {
        // Validasi data input
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
        ]);

        // Jika ada file gambar yang diunggah, upload dan perbarui nama file
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images'), $imageName);
            $product->image = $imageName;
        }

        // Perbarui data produk dalam database
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'status' => $request->status ?? 'available',
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    // Menghapus produk dari database
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
