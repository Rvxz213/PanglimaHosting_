@extends('layouts.app')

@section('title', 'PanglimaHosting - #1 Hosting Provider')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-cyan-600 via-blue-600 to-purple-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">
                #1 Hosting Provider
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-cyan-100">
                VPS dan Shared Hosting Terbaik dengan Performa Tinggi
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('products.index', ['type' => 'vps']) }}" 
                   class="bg-white text-cyan-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                    Lihat VPS
                </a>
                <a href="{{ route('products.index', ['type' => 'hosting']) }}" 
                   class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-cyan-600 transition duration-300">
                    Lihat Hosting
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Mengapa Memilih PanglimaHosting?</h2>
            <p class="text-lg text-gray-600">Layanan hosting terbaik dengan teknologi terkini</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 bg-gradient-to-r from-cyan-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-rocket text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Performa Tinggi</h3>
                <p class="text-gray-600">SSD Storage dan teknologi terbaru untuk kecepatan maksimal</p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-shield-alt text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Keamanan Terjamin</h3>
                <p class="text-gray-600">SSL gratis dan proteksi DDoS untuk keamanan website Anda</p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-cyan-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-headset text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Support 24/7</h3>
                <p class="text-gray-600">Tim support kami siap membantu Anda kapan saja</p>
            </div>
        </div>
    </div>
</section>

<!-- VPS Products Section -->
@if($vpsProducts->count() > 0)
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">VPS Terbaik</h2>
            <p class="text-lg text-gray-600">Virtual Private Server dengan performa tinggi</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($vpsProducts as $product)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">{{ $product->name }}</h3>
                    <p class="text-gray-600 mb-4">{{ $product->description }}</p>
                    <div class="text-3xl font-bold text-cyan-600 mb-4">{{ $product->formatted_price }}</div>
                    
                    <ul class="space-y-2 mb-6">
                        @foreach($product->features as $feature)
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            {{ $feature }}
                        </li>
                        @endforeach
                    </ul>
                    
                    <a href="{{ route('products.show', $product) }}" 
                       class="block w-full bg-gradient-to-r from-cyan-500 to-blue-600 text-white text-center py-3 rounded-lg font-semibold hover:from-cyan-600 hover:to-blue-700 transition duration-300">
                        Pilih Paket
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-8">
            <a href="{{ route('products.index', ['type' => 'vps']) }}" 
               class="inline-block bg-gray-800 text-white px-8 py-3 rounded-lg font-semibold hover:bg-gray-900 transition duration-300">
                Lihat Semua VPS
            </a>
        </div>
    </div>
</section>
@endif

<!-- Hosting Products Section -->
@if($hostingProducts->count() > 0)
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Shared Hosting</h2>
            <p class="text-lg text-gray-600">Hosting terjangkau untuk website Anda</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($hostingProducts as $product)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300 border-2 border-gray-100">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">{{ $product->name }}</h3>
                    <p class="text-gray-600 mb-4">{{ $product->description }}</p>
                    <div class="text-3xl font-bold text-purple-600 mb-4">{{ $product->formatted_price }}</div>
                    
                    <ul class="space-y-2 mb-6">
                        @foreach($product->features as $feature)
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            {{ $feature }}
                        </li>
                        @endforeach
                    </ul>
                    
                    <a href="{{ route('products.show', $product) }}" 
                       class="block w-full bg-gradient-to-r from-purple-500 to-cyan-600 text-white text-center py-3 rounded-lg font-semibold hover:from-purple-600 hover:to-cyan-700 transition duration-300">
                        Pilih Paket
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-8">
            <a href="{{ route('products.index', ['type' => 'hosting']) }}" 
               class="inline-block bg-gray-800 text-white px-8 py-3 rounded-lg font-semibold hover:bg-gray-900 transition duration-300">
                Lihat Semua Hosting
            </a>
        </div>
    </div>
</section>
@endif

<!-- CTA Section -->
<section class="py-16 bg-gradient-to-r from-cyan-600 to-purple-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold mb-4">Siap Memulai?</h2>
        <p class="text-xl mb-8 text-cyan-100">Pilih paket hosting yang sesuai dengan kebutuhan Anda</p>
        <a href="{{ route('products.index') }}" 
           class="bg-white text-cyan-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
            Lihat Semua Produk
        </a>
    </div>
</section>
@endsection 