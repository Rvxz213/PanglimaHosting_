@extends('layouts.app')

@section('title', $product->name . ' - PanglimaHosting')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Breadcrumb -->
    <nav class="flex mb-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-cyan-600">
                    <i class="fas fa-home mr-2"></i>
                    Beranda
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                    <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-cyan-600">Produk</a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                    <a href="{{ route('products.index', ['type' => $product->type]) }}" class="text-gray-700 hover:text-cyan-600">
                        {{ strtoupper($product->type) }}
                    </a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                    <span class="text-gray-500">{{ $product->name }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <!-- Product Info -->
        <div>
            <div class="mb-6">
                <span class="px-4 py-2 rounded-full text-sm font-semibold {{ $product->type === 'vps' ? 'bg-cyan-100 text-cyan-800' : 'bg-purple-100 text-purple-800' }}">
                    {{ strtoupper($product->type) }}
                </span>
            </div>
            
            <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>
            <p class="text-lg text-gray-600 mb-6">{{ $product->description }}</p>
            
            <div class="text-5xl font-bold mb-8 {{ $product->type === 'vps' ? 'text-cyan-600' : 'text-purple-600' }}">
                {{ $product->formatted_price }}
                <span class="text-lg font-normal text-gray-500">/bulan</span>
            </div>
            
            <!-- Features -->
            <div class="mb-8">
                <h3 class="text-xl font-semibold mb-4">Fitur yang Didapatkan</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($product->features as $feature)
                    <div class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-3"></i>
                        <span class="text-gray-700">{{ $feature }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="space-y-4">
                <form action="{{ route('cart.add') }}" method="POST" class="flex gap-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="flex items-center border border-gray-300 rounded-lg">
                        <label for="quantity" class="px-3 text-gray-600">Qty:</label>
                        <input type="number" name="quantity" id="quantity" value="1" min="1" 
                               class="w-16 px-2 py-2 border-0 focus:ring-0 text-center">
                    </div>
                    <button type="submit" 
                            class="flex-1 bg-gradient-to-r {{ $product->type === 'vps' ? 'from-cyan-500 to-blue-600' : 'from-purple-500 to-cyan-600' }} text-white py-3 px-6 rounded-lg font-semibold hover:opacity-90 transition duration-300">
                        <i class="fas fa-shopping-cart mr-2"></i>
                        Tambah ke Keranjang
                    </button>
                </form>
                
                <a href="{{ route('checkout') }}" 
                   class="block w-full bg-gray-800 text-white text-center py-3 rounded-lg font-semibold hover:bg-gray-900 transition duration-300">
                    Beli Sekarang
                </a>
            </div>
        </div>
        
        <!-- Product Card -->
        <div class="bg-white rounded-lg shadow-lg p-8 border-2 {{ $product->type === 'vps' ? 'border-cyan-200' : 'border-purple-200' }}">
            <div class="text-center mb-6">
                <div class="w-20 h-20 {{ $product->type === 'vps' ? 'bg-gradient-to-r from-cyan-500 to-blue-600' : 'bg-gradient-to-r from-purple-500 to-cyan-600' }} rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-server text-white text-3xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-900">{{ $product->name }}</h2>
                <p class="text-gray-600">{{ $product->description }}</p>
            </div>
            
            <div class="text-center mb-6">
                <div class="text-4xl font-bold {{ $product->type === 'vps' ? 'text-cyan-600' : 'text-purple-600' }}">
                    {{ $product->formatted_price }}
                </div>
                <p class="text-gray-500">per bulan</p>
            </div>
            
            <div class="space-y-3 mb-8">
                @foreach($product->features as $feature)
                <div class="flex items-center">
                    <i class="fas fa-check text-green-500 mr-3"></i>
                    <span class="text-gray-700">{{ $feature }}</span>
                </div>
                @endforeach
            </div>
            
            <div class="space-y-3">
                <button class="w-full bg-gradient-to-r {{ $product->type === 'vps' ? 'from-cyan-500 to-blue-600' : 'from-purple-500 to-cyan-600' }} text-white py-3 rounded-lg font-semibold hover:opacity-90 transition duration-300">
                    Pilih Paket Ini
                </button>
                <p class="text-center text-sm text-gray-500">
                    <i class="fas fa-shield-alt mr-1"></i>
                    Garansi 30 hari uang kembali
                </p>
            </div>
        </div>
    </div>
    
    <!-- Related Products -->
    <div class="mt-16">
        <h2 class="text-2xl font-bold text-gray-900 mb-8">Paket Lainnya</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @php
                $relatedProducts = \App\Models\Product::where('type', $product->type)
                    ->where('id', '!=', $product->id)
                    ->take(3)
                    ->get();
            @endphp
            
            @foreach($relatedProducts as $relatedProduct)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-2">{{ $relatedProduct->name }}</h3>
                    <p class="text-gray-600 mb-4">{{ Str::limit($relatedProduct->description, 80) }}</p>
                    <div class="text-2xl font-bold mb-4 {{ $relatedProduct->type === 'vps' ? 'text-cyan-600' : 'text-purple-600' }}">
                        {{ $relatedProduct->formatted_price }}
                    </div>
                    <a href="{{ route('products.show', $relatedProduct) }}" 
                       class="block w-full bg-gray-800 text-white text-center py-2 rounded-lg font-semibold hover:bg-gray-900 transition duration-300">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection 