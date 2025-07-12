<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $vpsProducts = Product::where('type', 'vps')->take(3)->get();
        $hostingProducts = Product::where('type', 'hosting')->take(3)->get();
        
        return view('home', compact('vpsProducts', 'hostingProducts'));
    }
}
