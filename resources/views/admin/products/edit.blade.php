@extends('layouts.admin')

@section('title', 'Edit Produk - Admin Panel')

@section('page-title', 'Edit Produk')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-900">Form Edit Produk</h2>
    </div>
    
    <form method="POST" action="{{ route('admin.products.update', $product) }}" class="p-6">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Produk</label>
                <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Tipe Produk</label>
                <select name="type" id="type" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500">
                    <option value="">Pilih Tipe</option>
                    <option value="vps" {{ old('type', $product->type) === 'vps' ? 'selected' : '' }}>VPS</option>
                    <option value="hosting" {{ old('type', $product->type) === 'hosting' ? 'selected' : '' }}>Hosting</option>
                </select>
                @error('type')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Harga (IDR)</label>
                <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" required min="0"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500">
                @error('price')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <div class="mt-6">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
            <textarea name="description" id="description" rows="4"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500">{{ old('description', $product->description) }}</textarea>
            @error('description')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mt-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Fitur-fitur</label>
            <div id="features-container">
                @if($product->features && count($product->features) > 0)
                    @foreach($product->features as $feature)
                    <div class="flex items-center space-x-2 mb-2">
                        <input type="text" name="features[]" value="{{ $feature }}"
                               class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500">
                        <button type="button" onclick="removeFeature(this)" class="text-red-600 hover:text-red-800">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    @endforeach
                @else
                    <div class="flex items-center space-x-2 mb-2">
                        <input type="text" name="features[]" placeholder="Contoh: CPU: 1 Core"
                               class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500">
                        <button type="button" onclick="removeFeature(this)" class="text-red-600 hover:text-red-800">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                @endif
            </div>
            <button type="button" onclick="addFeature()" class="mt-2 text-cyan-600 hover:text-cyan-800">
                <i class="fas fa-plus mr-1"></i> Tambah Fitur
            </button>
        </div>
        
        <div class="mt-8 flex justify-end space-x-4">
            <a href="{{ route('admin.products') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                Batal
            </a>
            <button type="submit" class="px-4 py-2 bg-cyan-600 hover:bg-cyan-700 text-white rounded-lg">
                Update Produk
            </button>
        </div>
    </form>
</div>

<script>
function addFeature() {
    const container = document.getElementById('features-container');
    const featureDiv = document.createElement('div');
    featureDiv.className = 'flex items-center space-x-2 mb-2';
    featureDiv.innerHTML = `
        <input type="text" name="features[]" placeholder="Contoh: RAM: 1 GB"
               class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500">
        <button type="button" onclick="removeFeature(this)" class="text-red-600 hover:text-red-800">
            <i class="fas fa-trash"></i>
        </button>
    `;
    container.appendChild(featureDiv);
}

function removeFeature(button) {
    button.parentElement.remove();
}
</script>
@endsection 