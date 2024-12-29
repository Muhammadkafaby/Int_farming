@extends('layouts.master_mitra')

@section('content')
<div class="container mx-auto p-6">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('mitra.check_store') }}" class="flex items-center text-blue-600 hover:underline">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H16a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Kembali
        </a>
    </div>

    <!-- Product Detail Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-white border rounded-lg shadow-lg overflow-hidden p-6">
        <!-- Product Image Section -->
        <div>
            <div class="border rounded-lg overflow-hidden relative">
                <img src="{{ asset('images/' . $product->photo) }}" alt="{{ $product->item_name }}" class="w-full h-96 object-contain">
                <span class="absolute top-2 right-2 bg-green-500 text-white text-sm font-semibold px-3 py-1 rounded-full">In Stock</span>
            </div>
            <!-- Thumbnail Section -->
            <div class="flex mt-4 space-x-4">
                <img src="{{ asset('images/' . $product->photo) }}" class="w-20 h-20 object-cover border rounded-lg cursor-pointer hover:ring-2 hover:ring-blue-400">
                <!-- Add more thumbnails if available -->
            </div>
        </div>

        <!-- Product Info Section -->
        <div class="flex flex-col justify-between">
            <!-- Product Title and Description -->
            <div>
                <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $product->item_name }}</h1>
                <p class="text-gray-600 text-lg mb-6 leading-relaxed">{{ $product->description }}</p>
                <p class="text-2xl font-semibold text-green-600 mb-4">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
            </div>

            <!-- Stock and CTA -->
            <div class="mb-6">
                <p class="text-sm text-gray-500 mb-2">Stok Tersedia:</p>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-800 text-xl font-medium">{{ $product->stock }}</span>
                </div>
            </div>

            <!-- Add to Cart and Wishlist Buttons -->
            <div class="flex items-center space-x-4">
                <button 
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition duration-200 shadow-md" 
                    onclick="openEditModal()">
                    Edit Produk
                </button>
            </div>
        </div>
    </div>
</div>

<div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
    <div class="bg-white rounded-lg p-8 w-full max-w-md shadow-lg">
        <h2 class="text-2xl font-bold mb-6">Edit Produk</h2>
        <form id="editForm" action="{{ route('mitra.update_product', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="item_name" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                <input type="text" name="item_name" id="item_name" class="w-full border rounded-lg p-2 mt-1" value="{{ $product->item_name }}" required>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="description" id="description" class="w-full border rounded-lg p-2 mt-1" required>{{ $product->description }}</textarea>
            </div>
            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700">Harga</label>
                <input type="number" name="price" id="price" class="w-full border rounded-lg p-2 mt-1" value="{{ $product->price }}" required>
            </div>
            <div class="mb-4">
                <label for="stock" class="block text-sm font-medium text-gray-700">Stok</label>
                <input type="number" name="stock" id="stock" class="w-full border rounded-lg p-2 mt-1" value="{{ $product->stock }}" required>
            </div>
            <div class="mb-4">
                <label for="stock" class="block text-sm font-medium text-gray-700">Diskon</label>
                <input type="number" name="discount" id="discount" class="w-full border rounded-lg p-2 mt-1" value="{{ $product->discount }}" required>
            </div>
            <div class="mb-6">
                <label for="photo" class="block text-sm font-medium text-gray-700">Foto Produk</label>
                <input type="file" name="photo" id="photo" class="w-full border rounded-lg p-2 mt-1">
            </div>
            
            <div class="flex justify-end space-x-4">
                <button type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-bold py-2 px-4 rounded-lg" onclick="closeEditModal()">Batal</button>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditModal() {
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }
</script>
@endsection
