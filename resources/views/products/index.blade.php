@extends('layouts.app')

@section('title', 'Produk - PanglimaHosting')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Pilih Paket Hosting</h1>
        <p class="text-lg text-gray-600">Temukan paket yang sesuai dengan kebutuhan Anda</p>
    </div>

    <!-- Filter Tabs -->
    <div class="flex justify-center mb-8">
        <div class="bg-white rounded-lg shadow-md p-1">
            <a href="{{ route('products.index') }}" 
               class="px-6 py-2 rounded-md {{ $type === 'all' ? 'bg-gradient-to-r from-cyan-500 to-blue-600 text-white' : 'text-gray-700 hover:text-cyan-600' }} transition duration-300">
                Semua
            </a>
            <a href="{{ route('products.index', ['type' => 'vps']) }}" 
               class="px-6 py-2 rounded-md {{ $type === 'vps' ? 'bg-gradient-to-r from-cyan-500 to-blue-600 text-white' : 'text-gray-700 hover:text-cyan-600' }} transition duration-300">
                VPS
            </a>
            <a href="{{ route('products.index', ['type' => 'hosting']) }}" 
               class="px-6 py-2 rounded-md {{ $type === 'hosting' ? 'bg-gradient-to-r from-cyan-500 to-blue-600 text-white' : 'text-gray-700 hover:text-cyan-600' }} transition duration-300">
                Shared Hosting
            </a>
        </div>
    </div>

    <!-- Products Grid -->
    @if($products->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($products as $product)
        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $product->type === 'vps' ? 'bg-cyan-100 text-cyan-800' : 'bg-purple-100 text-purple-800' }}">
                        {{ strtoupper($product->type) }}
                    </span>
                </div>
                
                <h3 class="text-xl font-semibold mb-2">{{ $product->name }}</h3>
                <p class="text-gray-600 mb-4">{{ $product->description }}</p>
                
                <div class="text-3xl font-bold mb-4 {{ $product->type === 'vps' ? 'text-cyan-600' : 'text-purple-600' }}">
                    {{ $product->formatted_price }}
                </div>
                
                <ul class="space-y-2 mb-6">
                    @foreach(array_slice($product->features, 0, 4) as $feature)
                    <li class="flex items-center text-gray-700">
                        <i class="fas fa-check text-green-500 mr-2"></i>
                        {{ $feature }}
                    </li>
                    @endforeach
                    @if(count($product->features) > 4)
                    <li class="text-gray-500 text-sm">
                        <i class="fas fa-plus mr-2"></i>
                        Dan {{ count($product->features) - 4 }} fitur lainnya
                    </li>
                    @endif
                </ul>
                
                <div class="space-y-2">
                    <a href="{{ route('products.show', $product) }}" 
                       class="block w-full bg-gradient-to-r {{ $product->type === 'vps' ? 'from-cyan-500 to-blue-600' : 'from-purple-500 to-cyan-600' }} text-white text-center py-3 rounded-lg font-semibold hover:opacity-90 transition duration-300">
                        Lihat Detail
                    </a>
                    
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" 
                                class="w-full border-2 {{ $product->type === 'vps' ? 'border-cyan-500 text-cyan-600' : 'border-purple-500 text-purple-600' }} py-2 rounded-lg font-semibold hover:bg-gray-50 transition duration-300">
                            Tambah ke Keranjang
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-12">
        <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-search text-gray-400 text-3xl"></i>
        </div>
        <h3 class="text-xl font-semibold text-gray-900 mb-2">Tidak ada produk ditemukan</h3>
        <p class="text-gray-600">Coba pilih kategori yang berbeda</p>
    </div>
    @endif
</div>
@endsection 