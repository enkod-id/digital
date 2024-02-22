<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // Menampilkan semua data produk
    public function index()
    {
        $user_id = Auth::id();
        $categories = Category::all();
        $products = Product::where('user_id', $user_id)->get();
        return view('products.index', compact('products', 'categories'));
    }

    // Menampilkan form untuk membuat produk baru
public function create()
{
    $categories = Category::all(); // Mengambil semua kategori dari database
    return view('products.index', compact('categories'));
}

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
        'user_id' => Auth::id(), // Menggunakan ID pengguna yang sudah login
    ]);

    return redirect()->route('products.index')->with('success', 'Product created successfully.');
}

    // Menampilkan detail produk
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // Menampilkan form untuk mengedit produk
    public function edit($id)
{
    $product = Product::find($id);
    $categories = Category::all();

    if ($product) {
        return view('products.edit', compact('product', 'categories'));
    }

    return redirect()->route('products.index')
                     ->with('error', 'Product not found');
}


    // Memperbarui produk dalam database
    public function update(Request $request, $id)
{
    // Validasi data input
    $request->validate([
        'name' => 'required',
        'description' => 'required',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'category_id' => 'required|exists:categories,id',
    ]);

    // Dapatkan produk berdasarkan ID
    $product = Product::findOrFail($id);

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
    ]);

    return redirect()->route('products.index')->with('success', 'Product updated successfully.');
}

    // Menghapus produk dari database
    public function destroy($id)
{
    $product = Product::find($id);

    if ($product) {
        $product->delete();
        return redirect()->route('products.index')
                         ->with('success', 'Product deleted successfully');
    }

    return redirect()->route('products.index')
                     ->with('error', 'Product not found');
}
}
