@extends('layouts.admin')

@section('title', 'Detail Pesanan - Admin Panel')

@section('page-title', 'Detail Pesanan #' . $order->id)

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Order Details -->
    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-900">Informasi Pesanan</h2>
        </div>
        
        <div class="p-6">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Order ID</label>
                    <p class="mt-1 text-sm text-gray-900">#{{ $order->id }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Midtrans Order ID</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $order->midtrans_order_id ?? '-' }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <div class="mt-1">
                        @if($order->status === 'paid')
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                Dibayar
                            </span>
                        @elseif($order->status === 'pending')
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Menunggu
                            </span>
                        @else
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                Gagal
                            </span>
                        @endif
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Total</label>
                    <p class="mt-1 text-lg font-semibold text-gray-900">{{ $order->formatted_total }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tanggal Pesanan</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                </div>
                
                @if($order->updated_at != $order->created_at)
                <div>
                    <label class="block text-sm font-medium text-gray-700">Terakhir Diupdate</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $order->updated_at->format('d/m/Y H:i') }}</p>
                </div>
                @endif
            </div>
            
            <!-- Update Status -->
            <div class="mt-6 pt-6 border-t border-gray-200">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Update Status</h3>
                <form method="POST" action="{{ route('admin.orders.update-status', $order) }}">
                    @csrf
                    @method('PUT')
                    <div class="flex space-x-4">
                        <select name="status" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500">
                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Menunggu</option>
                            <option value="paid" {{ $order->status === 'paid' ? 'selected' : '' }}>Dibayar</option>
                            <option value="failed" {{ $order->status === 'failed' ? 'selected' : '' }}>Gagal</option>
                        </select>
                        <button type="submit" class="px-4 py-2 bg-cyan-600 hover:bg-cyan-700 text-white rounded-lg">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Customer & Product Details -->
    <div class="space-y-6">
        <!-- Customer Information -->
        <div class="bg-white rounded-lg shadow-sm">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Informasi Pelanggan</h2>
            </div>
            
            <div class="p-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $order->customer_name }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $order->customer_email }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Product Information -->
        <div class="bg-white rounded-lg shadow-sm">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Informasi Produk</h2>
            </div>
            
            <div class="p-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Produk</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $order->product->name }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tipe</label>
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                            {{ $order->product->type === 'vps' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                            {{ strtoupper($order->product->type) }}
                        </span>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Harga Satuan</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $order->product->formatted_price }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $order->quantity }}</p>
                    </div>
                    
                    @if($order->product->description)
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $order->product->description }}</p>
                    </div>
                    @endif
                    
                    @if($order->product->features && count($order->product->features) > 0)
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Fitur</label>
                        <ul class="mt-1 text-sm text-gray-900 list-disc list-inside">
                            @foreach($order->product->features as $feature)
                                <li>{{ $feature }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Payment Information -->
        @if($order->payment)
        <div class="bg-white rounded-lg shadow-sm">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Informasi Pembayaran</h2>
            </div>
            
            <div class="p-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status Pembayaran</label>
                        <div class="mt-1">
                            @if($order->payment->payment_status === 'settlement')
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    Berhasil
                                </span>
                            @elseif($order->payment->payment_status === 'pending')
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Menunggu
                                </span>
                            @else
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                    Gagal
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    @if($order->payment->midtrans_transaction_id)
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Transaction ID</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $order->payment->midtrans_transaction_id }}</p>
                    </div>
                    @endif
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tanggal Pembayaran</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $order->payment->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<div class="mt-6">
    <a href="{{ route('admin.orders') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
        <i class="fas fa-arrow-left mr-2"></i>
        Kembali ke Daftar Pesanan
    </a>
</div>
@endsection 