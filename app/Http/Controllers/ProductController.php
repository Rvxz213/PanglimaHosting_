<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get('type', 'all');
        
        if ($type === 'all') {
            $products = Product::all();
        } else {
            $products = Product::where('type', $type)->get();
        }
        
        return view('products.index', compact('products', 'type'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}
