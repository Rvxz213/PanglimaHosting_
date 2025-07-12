@extends('layouts.app')

@section('title', 'Keranjang - PanglimaHosting')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Keranjang Belanja</h1>
        <p class="text-gray-600">Review produk yang akan Anda beli</p>
    </div>

    @if(count($cart) > 0)
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Cart Items -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900">Produk dalam Keranjang</h2>
                </div>
                
                <div class="divide-y divide-gray-200">
                    @php $total = 0; @endphp
                    @foreach($products as $product)
                    @php 
                        $quantity = $cart[$product->id];
                        $subtotal = $product->price * $quantity;
                        $total += $subtotal;
                    @endphp
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="w-16 h-16 {{ $product->type === 'vps' ? 'bg-gradient-to-r from-cyan-500 to-blue-600' : 'bg-gradient-to-r from-purple-500 to-cyan-600' }} rounded-lg flex items-center justify-center">
                                    <i class="fas fa-server text-white"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $product->name }}</h3>
                                    <p class="text-gray-600">{{ $product->description }}</p>
                                    <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full {{ $product->type === 'vps' ? 'bg-cyan-100 text-cyan-800' : 'bg-purple-100 text-purple-800' }}">
                                        {{ strtoupper($product->type) }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="text-right">
                                <div class="text-lg font-semibold text-gray-900">{{ $product->formatted_price }}</div>
                                <div class="text-sm text-gray-500">Qty: {{ $quantity }}</div>
                                <div class="text-sm font-semibold text-gray-900">Subtotal: Rp {{ number_format($subtotal, 0, ',', '.') }}</div>
                            </div>
                        </div>
                        
                        <div class="mt-4 flex justify-between items-center">
                            <div class="flex items-center space-x-2">
                                <span class="text-sm text-gray-600">Fitur:</span>
                                <div class="flex flex-wrap gap-1">
                                    @foreach(array_slice($product->features, 0, 3) as $feature)
                                    <span class="px-2 py-1 text-xs bg-gray-100 text-gray-700 rounded">{{ $feature }}</span>
                                    @endforeach
                                    @if(count($product->features) > 3)
                                    <span class="px-2 py-1 text-xs bg-gray-100 text-gray-700 rounded">+{{ count($product->features) - 3 }} lagi</span>
                                    @endif
                                </div>
                            </div>
                            
                            <form action="{{ route('cart.remove', $product->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">
                                    <i class="fas fa-trash mr-1"></i>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <!-- Order Summary -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-lg p-6 sticky top-8">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Ringkasan Pesanan</h2>
                
                <div class="space-y-3 mb-6">
                    @foreach($products as $product)
                    @php $quantity = $cart[$product->id]; $subtotal = $product->price * $quantity; @endphp
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">{{ $product->name }} ({{ $quantity }}x)</span>
                        <span class="font-medium">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    @endforeach
                </div>
                
                <div class="border-t border-gray-200 pt-4 mb-6">
                    <div class="flex justify-between text-lg font-semibold">
                        <span>Total</span>
                        <span class="text-cyan-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>
                
                <div class="space-y-3">
                    <a href="{{ route('checkout') }}" 
                       class="block w-full bg-gradient-to-r from-cyan-500 to-blue-600 text-white text-center py-3 rounded-lg font-semibold hover:opacity-90 transition duration-300">
                        Lanjutkan ke Pembayaran
                    </a>
                    
                    <a href="{{ route('products.index') }}" 
                       class="block w-full border-2 border-gray-300 text-gray-700 text-center py-3 rounded-lg font-semibold hover:bg-gray-50 transition duration-300">
                        Lanjutkan Belanja
                    </a>
                </div>
                
                <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                    <h3 class="font-semibold text-gray-900 mb-2">Keuntungan:</h3>
                    <ul class="text-sm text-gray-600 space-y-1">
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Garansi 30 hari uang kembali</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Setup gratis</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Support 24/7</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>SSL gratis</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="text-center py-12">
        <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-shopping-cart text-gray-400 text-3xl"></i>
        </div>
        <h3 class="text-xl font-semibold text-gray-900 mb-2">Keranjang Kosong</h3>
        <p class="text-gray-600 mb-6">Belum ada produk di keranjang belanja Anda</p>
        <a href="{{ route('products.index') }}" 
           class="inline-block bg-gradient-to-r from-cyan-500 to-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:opacity-90 transition duration-300">
            Mulai Belanja
        </a>
    </div>
    @endif
</div>
@endsection 