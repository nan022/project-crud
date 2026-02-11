<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    //
    public function index(){
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    public function create(){
        return view('product.add');
    }

    public function store(Request $request)
    {
        // Form validation
        $request->validate([
            'name'          => 'required|min:5',
            'desc'          => 'required|min:5',
            'stock'         => 'required|numeric'
        ]);

        // Create new product
        Product::create([
            'name' => $request->name,
            'desc' => $request->desc,
            'stock' => $request->stock
        ]);

        // Redirect to index
        return redirect()->route('product.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(string $id): View
    {
        $product = Product::findOrFail($id);

        return view('product.edit', compact('product'));
    }
        
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'          => 'required|min:5',
            'desc'          => 'required|min:5',
            'stock'         => 'required|numeric'
        ]);

        $product = Product::findOrFail($id);

        $product->update([
            'name' => $request->name,
            'desc' => $request->desc,
            'stock' => $request->stock
        ]);

        return redirect()->route('product.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect()->route('product.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
}
