@extends('layouts.app')

@section('title', 'Pembayaran Berhasil - PanglimaHosting')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center">
        <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-check text-green-600 text-3xl"></i>
        </div>
        
        <h1 class="text-3xl font-bold text-gray-900 mb-4">Pembayaran Berhasil!</h1>
        <p class="text-lg text-gray-600 mb-8">Terima kasih telah memilih PanglimaHosting</p>
        
        <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Pesanan Anda Telah Dikonfirmasi</h2>
            
            <div class="space-y-3 text-left">
                <div class="flex justify-between">
                    <span class="text-gray-600">Status:</span>
                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold">
                        Pembayaran Berhasil
                    </span>
                </div>
                
                <div class="flex justify-between">
                    <span class="text-gray-600">Email Konfirmasi:</span>
                    <span class="font-semibold">Telah dikirim</span>
                </div>
                
                <div class="flex justify-between">
                    <span class="text-gray-600">Setup Server:</span>
                    <span class="font-semibold">Dalam proses (1-2 jam)</span>
                </div>
            </div>
            
            <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                <h3 class="font-semibold text-blue-900 mb-2">Langkah Selanjutnya:</h3>
                <ol class="text-sm text-blue-800 space-y-1">
                    <li>1. Tim kami akan memproses pesanan Anda dalam 1-2 jam kerja</li>
                    <li>2. Anda akan menerima email dengan detail akses server</li>
                    <li>3. Tim support kami akan membantu setup awal</li>
                    <li>4. Server Anda siap digunakan!</li>
                </ol>
            </div>
        </div>
        
        <div class="space-y-4">
            <a href="{{ route('home') }}" 
               class="inline-block bg-gradient-to-r from-cyan-500 to-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:opacity-90 transition duration-300">
                Kembali ke Beranda
            </a>
            
            <div class="text-sm text-gray-500">
                <p>Pertanyaan? Hubungi support kami di:</p>
                <p class="font-semibold">support@panglimahosting.com</p>
            </div>
        </div>
    </div>
</div>
@endsection 