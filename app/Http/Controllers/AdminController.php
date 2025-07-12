<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', 'paid')->sum('total');
        $pendingOrders = Order::where('status', 'pending')->count();
        
        $recentOrders = Order::with('product')->latest()->take(5)->get();
        
        return view('admin.dashboard', compact('totalProducts', 'totalOrders', 'totalRevenue', 'pendingOrders', 'recentOrders'));
    }

    public function products()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function createProduct()
    {
        return view('admin.products.create');
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:vps,hosting',
            'price' => 'required|integer|min:0',
            'features' => 'nullable|array'
        ]);

        $data = $request->all();
        
        // Filter out empty features
        if (isset($data['features']) && is_array($data['features'])) {
            $data['features'] = array_filter($data['features'], function($feature) {
                return !empty(trim($feature));
            });
        }

        Product::create($data);
        
        return redirect()->route('admin.products')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function editProduct(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function updateProduct(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:vps,hosting',
            'price' => 'required|integer|min:0',
            'features' => 'nullable|array'
        ]);

        $data = $request->all();
        
        // Filter out empty features
        if (isset($data['features']) && is_array($data['features'])) {
            $data['features'] = array_filter($data['features'], function($feature) {
                return !empty(trim($feature));
            });
        }

        $product->update($data);
        
        return redirect()->route('admin.products')->with('success', 'Produk berhasil diperbarui!');
    }

    public function deleteProduct(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Produk berhasil dihapus!');
    }

    public function orders()
    {
        $orders = Order::with('product', 'payment')->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function showOrder(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,failed'
        ]);

        $order->update(['status' => $request->status]);
        
        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui!');
    }
}
