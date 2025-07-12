@extends('layouts.app')

@section('title', 'Pembayaran Gagal - PanglimaHosting')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center">
        <div class="w-24 h-24 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-times text-red-600 text-3xl"></i>
        </div>
        
        <h1 class="text-3xl font-bold text-gray-900 mb-4">Pembayaran Gagal</h1>
        <p class="text-lg text-gray-600 mb-8">Maaf, pembayaran Anda tidak dapat diproses</p>
        
        <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Apa yang bisa Anda lakukan?</h2>
            
            <div class="space-y-4 text-left">
                <div class="flex items-start">
                    <i class="fas fa-refresh text-blue-500 mt-1 mr-3"></i>
                    <div>
                        <h3 class="font-semibold text-gray-900">Coba Lagi</h3>
                        <p class="text-gray-600 text-sm">Pembayaran mungkin gagal karena masalah teknis sementara</p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <i class="fas fa-credit-card text-green-500 mt-1 mr-3"></i>
                    <div>
                        <h3 class="font-semibold text-gray-900">Ganti Metode Pembayaran</h3>
                        <p class="text-gray-600 text-sm">Coba dengan kartu kredit atau metode pembayaran lainnya</p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <i class="fas fa-headset text-purple-500 mt-1 mr-3"></i>
                    <div>
                        <h3 class="font-semibold text-gray-900">Hubungi Support</h3>
                        <p class="text-gray-600 text-sm">Tim kami siap membantu menyelesaikan masalah Anda</p>
                    </div>
                </div>
            </div>
            
            <div class="mt-6 p-4 bg-yellow-50 rounded-lg">
                <h3 class="font-semibold text-yellow-900 mb-2">Kemungkinan Penyebab:</h3>
                <ul class="text-sm text-yellow-800 space-y-1">
                    <li>• Saldo kartu kredit tidak mencukupi</li>
                    <li>• Masalah jaringan internet</li>
                    <li>• Pembayaran dibatalkan oleh bank</li>
                    <li>• Masalah teknis sementara</li>
                </ul>
            </div>
        </div>
        
        <div class="space-y-4">
            <a href="{{ route('products.index') }}" 
               class="inline-block bg-gradient-to-r from-cyan-500 to-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:opacity-90 transition duration-300">
                Coba Lagi
            </a>
            
            <div class="text-sm text-gray-500">
                <p>Butuh bantuan? Hubungi support kami:</p>
                <p class="font-semibold">support@panglimahosting.com</p>
                <p class="font-semibold">WhatsApp: +62 812-3456-7890</p>
            </div>
        </div>
    </div>
</div>
@endsection 