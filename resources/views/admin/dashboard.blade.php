@extends('layouts.admin')

@section('title', 'Dashboard - PanglimaHosting')
@section('page-title', 'Dashboard')

@section('content')
<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-gradient-to-r from-cyan-500 to-blue-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-box text-white text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total Produk</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $totalProducts }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-shopping-cart text-white text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total Pesanan</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $totalOrders }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-teal-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-money-bill-wave text-white text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total Pendapatan</p>
                <p class="text-2xl font-semibold text-gray-900">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-red-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-clock text-white text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Pesanan Pending</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $pendingOrders }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Recent Orders -->
<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-900">Pesanan Terbaru</h2>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Order ID
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Customer
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Produk
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Total
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Tanggal
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($recentOrders as $order)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $order->midtrans_order_id }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div>
                            <div class="text-sm font-medium text-gray-900">{{ $order->customer_name }}</div>
                            <div class="text-sm text-gray-500">{{ $order->customer_email }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div>
                            <div class="text-sm font-medium text-gray-900">{{ $order->product->name }}</div>
                            <div class="text-sm text-gray-500">Qty: {{ $order->quantity }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $order->formatted_total }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($order->status === 'paid')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Paid
                            </span>
                        @elseif($order->status === 'pending')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Pending
                            </span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                Failed
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $order->created_at->format('d M Y H:i') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('admin.orders.show', $order) }}" 
                           class="text-cyan-600 hover:text-cyan-900">
                            Lihat Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                        Belum ada pesanan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($recentOrders->count() > 0)
    <div class="px-6 py-4 border-t border-gray-200">
        <a href="{{ route('admin.orders') }}" 
           class="text-cyan-600 hover:text-cyan-900 text-sm font-medium">
            Lihat Semua Pesanan →
        </a>
    </div>
    @endif
</div>

<!-- Quick Actions -->
<div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h3>
        <div class="space-y-3">
            <a href="{{ route('admin.products.create') }}" 
               class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-200">
                <i class="fas fa-plus text-cyan-600 mr-3"></i>
                <span class="text-gray-700">Tambah Produk Baru</span>
            </a>
            
            <a href="{{ route('admin.orders') }}" 
               class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-200">
                <i class="fas fa-list text-blue-600 mr-3"></i>
                <span class="text-gray-700">Kelola Pesanan</span>
            </a>
            
            <a href="{{ route('home') }}" 
               class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-200">
                <i class="fas fa-eye text-purple-600 mr-3"></i>
                <span class="text-gray-700">Lihat Website</span>
            </a>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Statistik Produk</h3>
        <div class="space-y-4">
            @php
                $vpsCount = \App\Models\Product::where('type', 'vps')->count();
                $hostingCount = \App\Models\Product::where('type', 'hosting')->count();
            @endphp
            
            <div class="flex justify-between items-center">
                <span class="text-gray-600">VPS</span>
                <span class="font-semibold text-gray-900">{{ $vpsCount }} produk</span>
            </div>
            
            <div class="flex justify-between items-center">
                <span class="text-gray-600">Shared Hosting</span>
                <span class="font-semibold text-gray-900">{{ $hostingCount }} produk</span>
            </div>
            
            <div class="w-full bg-gray-200 rounded-full h-2">
                @if($totalProducts > 0)
                <div class="bg-gradient-to-r from-cyan-500 to-blue-600 h-2 rounded-full" 
                     style="width: {{ ($vpsCount / $totalProducts) * 100 }}%"></div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 