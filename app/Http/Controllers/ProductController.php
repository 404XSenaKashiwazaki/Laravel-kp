<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->latest()->paginate(10);

        return view('product.index', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            "name" => ["required","max:255","unique:products,name"],
            "deskripsi" => ["required","max:255"],
            "stok" => ["required","max:255"],
            "harga" => ["required","max:255"],
            "gambar" => ["required","image","mimes:jpeg,png,jpg,gif,svg","max:512000"]
        ]);
        if ($request->hasFile('gambar')) {
            $filename = uniqid() . '.' . $request->file('gambar')->getClientOriginalExtension();
            $path = $request->file('gambar')->storeAs('products', $filename, 'public');
            $validate["gambar"] = $path;
        }
        Product::create($validate);
        return Redirect::route('product.index')->with('success', 'Data berhasil di tambahkan');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {

        return view('product.form', ["product" => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validate = $request->validate([
            "name" => ["required","max:255",Rule::unique('products', 'name')->ignore($product->id)],
            "deskripsi" => ["required","max:255"],
            "stok" => ["required","max:255"],
            "harga" => ["required","max:255"],
            "gambar" => ["nullable","image","mimes:jpeg,png,jpg,gif,svg","max:512000"]
        ]);
        if ($request->hasFile('gambar')) {
            $filename = uniqid() . '.' . $request->file('gambar')->getClientOriginalExtension();
            $path = $request->file('gambar')->storeAs('products', $filename, 'public');
            Storage::disk('public')->delete($product->gambar);
            $validate["gambar"] = $path;
        }
        $product->update($validate);
        return Redirect::route('product.index')->with('success', 'Data berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {   $gambar = $product->gambar;
        $product->delete();
        if ($gambar) {
            Storage::disk('public')->delete($gambar);
        }
        return Redirect::route('product.index')->with('success', 'Data berhasil di hapus');
    }
}
