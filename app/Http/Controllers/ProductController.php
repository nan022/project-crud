<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

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
}
