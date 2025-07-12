@extends('layouts.app')

@section('title', 'Pembayaran - PanglimaHosting')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Pembayaran</h1>
        <p class="text-gray-600">Pilih metode pembayaran yang Anda inginkan</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Order Details -->
        <div>
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Detail Pesanan</h2>
                
                <div class="space-y-4">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Order ID:</span>
                        <span class="font-semibold">{{ $order->midtrans_order_id }}</span>
                    </div>
                    
                    <div class="flex justify-between">
                        <span class="text-gray-600">Produk:</span>
                        <span class="font-semibold">{{ $order->product->name }}</span>
                    </div>
                    
                    <div class="flex justify-between">
                        <span class="text-gray-600">Jumlah:</span>
                        <span class="font-semibold">{{ $order->quantity }}</span>
                    </div>
                    
                    <div class="flex justify-between">
                        <span class="text-gray-600">Customer:</span>
                        <span class="font-semibold">{{ $order->customer_name }}</span>
                    </div>
                    
                    <div class="flex justify-between">
                        <span class="text-gray-600">Email:</span>
                        <span class="font-semibold">{{ $order->customer_email }}</span>
                    </div>
                    
                    <div class="border-t border-gray-200 pt-4">
                        <div class="flex justify-between text-lg font-bold">
                            <span>Total Pembayaran:</span>
                            <span class="text-cyan-600">{{ $order->formatted_total }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                    <h3 class="font-semibold text-gray-900 mb-2">Informasi Penting:</h3>
                    <ul class="text-sm text-gray-600 space-y-1">
                        <li><i class="fas fa-info-circle text-blue-500 mr-2"></i>Pembayaran akan diproses secara aman oleh Midtrans</li>
                        <li><i class="fas fa-clock text-orange-500 mr-2"></i>Batas waktu pembayaran: 24 jam</li>
                        <li><i class="fas fa-shield-alt text-green-500 mr-2"></i>Data Anda terlindungi dengan enkripsi SSL</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Payment Gateway -->
        <div>
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Metode Pembayaran</h2>
                
                <div id="snap-container" class="mb-4">
                    <!-- Midtrans Snap will be rendered here -->
                </div>
                
                <div class="text-center">
                    <p class="text-sm text-gray-600 mb-4">
                        <i class="fas fa-lock mr-1"></i>
                        Pembayaran aman dengan Midtrans
                    </p>
                    
                    <div class="flex justify-center space-x-4 text-sm text-gray-500">
                        <div class="flex items-center">
                            <i class="fas fa-credit-card mr-1"></i>
                            Credit Card
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-university mr-1"></i>
                            Bank Transfer
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-wallet mr-1"></i>
                            E-Wallet
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Midtrans Snap Script -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    // Trigger Snap popup on page load
    window.snap.embed('{{ $snapToken }}', {
        embedId: 'snap-container',
        onSuccess: function(result) {
            // Handle success
            window.location.href = '{{ route("payment.success") }}';
        },
        onPending: function(result) {
            // Handle pending
            alert('Pembayaran pending, silakan selesaikan pembayaran Anda.');
        },
        onError: function(result) {
            // Handle error
            window.location.href = '{{ route("payment.failed") }}';
        },
        onClose: function() {
            // Handle customer closed the popup without finishing payment
            alert('Pembayaran dibatalkan. Silakan coba lagi.');
        }
    });
</script>
@endsection 