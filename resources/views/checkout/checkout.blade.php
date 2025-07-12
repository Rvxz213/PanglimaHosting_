@extends('layouts.app')

@section('title', 'Checkout - PanglimaHosting')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Checkout</h1>
        <p class="text-gray-600">Lengkapi informasi untuk menyelesaikan pesanan</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Checkout Form -->
        <div>
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Informasi Pelanggan</h2>
                
                <form action="{{ route('checkout.process') }}" method="POST">
                    @csrf
                    
                    <!-- Customer Name -->
                    <div class="mb-6">
                        <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="customer_name" id="customer_name" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500"
                               placeholder="Masukkan nama lengkap">
                    </div>
                    
                    <!-- Customer Email -->
                    <div class="mb-6">
                        <label for="customer_email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" name="customer_email" id="customer_email" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500"
                               placeholder="contoh@email.com">
                        <p class="text-sm text-gray-500 mt-1">Email akan digunakan untuk konfirmasi pesanan</p>
                    </div>
                    
                    <!-- Terms -->
                    <div class="mb-6">
                        <div class="flex items-start">
                            <input type="checkbox" id="terms" required
                                   class="mt-1 h-4 w-4 text-cyan-600 focus:ring-cyan-500 border-gray-300 rounded">
                            <label for="terms" class="ml-2 text-sm text-gray-700">
                                Saya setuju dengan <a href="#" class="text-cyan-600 hover:text-cyan-800">Syarat dan Ketentuan</a> 
                                serta <a href="#" class="text-cyan-600 hover:text-cyan-800">Kebijakan Privasi</a>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-cyan-500 to-blue-600 text-white py-3 rounded-lg font-semibold hover:opacity-90 transition duration-300">
                        Lanjutkan ke Pembayaran
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Order Summary -->
        <div>
            <div class="bg-white rounded-lg shadow-lg p-6 sticky top-8">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Ringkasan Pesanan</h2>
                
                <div class="space-y-4 mb-6">
                    @php $total = 0; @endphp
                    @foreach($products as $product)
                    @php 
                        $quantity = $cart[$product->id];
                        $subtotal = $product->price * $quantity;
                        $total += $subtotal;
                    @endphp
                    <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                        <div>
                            <h3 class="font-semibold text-gray-900">{{ $product->name }}</h3>
                            <p class="text-sm text-gray-600">{{ $product->description }}</p>
                            <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full {{ $product->type === 'vps' ? 'bg-cyan-100 text-cyan-800' : 'bg-purple-100 text-purple-800' }}">
                                {{ strtoupper($product->type) }}
                            </span>
                        </div>
                        <div class="text-right">
                            <div class="font-semibold text-gray-900">{{ $product->formatted_price }}</div>
                            <div class="text-sm text-gray-500">Qty: {{ $quantity }}</div>
                            <div class="text-sm font-semibold text-gray-900">Rp {{ number_format($subtotal, 0, ',', '.') }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div class="border-t border-gray-200 pt-4 mb-6">
                    <div class="flex justify-between text-lg font-semibold">
                        <span>Total</span>
                        <span class="text-cyan-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>
                
                <!-- Features -->
                <div class="mb-6">
                    <h3 class="font-semibold text-gray-900 mb-3">Yang Anda Dapatkan:</h3>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Setup server gratis
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            SSL certificate gratis
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Backup otomatis
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Support 24/7
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Garansi 30 hari
                        </li>
                    </ul>
                </div>
                
                <!-- Payment Methods -->
                <div class="p-4 bg-gray-50 rounded-lg">
                    <h3 class="font-semibold text-gray-900 mb-3">Metode Pembayaran:</h3>
                    <div class="grid grid-cols-2 gap-2 text-sm">
                        <div class="flex items-center">
                            <i class="fas fa-credit-card text-blue-600 mr-2"></i>
                            Credit Card
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-university text-green-600 mr-2"></i>
                            Bank Transfer
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-wallet text-orange-600 mr-2"></i>
                            E-Wallet
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-mobile-alt text-purple-600 mr-2"></i>
                            Virtual Account
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 