@extends('layouts.master')

@section('content')
<div class="container mx-auto p-4" style="padding-top: 9rem; padding-bottom: 5rem;">
    <div class="flex justify-between items-center mb-4 ">
        
        <form action="{{ route('belanja.search') }}" method="GET" class="w-full md:w-1/2 md:flex-1">
            <input type="text" name="search" placeholder="Cari barang..." value="{{ request('search') }}" class="w-full p-2 border rounded-lg shadow focus:outline-none focus:ring-2 focus:ring-blue-500" />
            <button type="submit" class="hidden">Cari</button>
        </form>
        
       
        <div class="ml-4">
            <form action="{{ route('belanja.search') }}" method="GET" class="flex items-center">
                <select name="sort_price" class="ml-4 p-2 border rounded-lg shadow focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="this.form.submit()">
                    <option value="terendah" {{ request('sort_price') === 'terendah' ? 'selected' : '' }}>Harga: Terendah</option>
                    <option value="tertinggi" {{ request('sort_price') === 'tertinggi' ? 'selected' : '' }}>Harga: Tertinggi</option>
                </select>
            </form>
        </div>
    </div>
    
    
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @php
            $sortedFiles = $files;

            $sortPrice = request()->query('sort_price') ?? 'terendah';
            if ($sortPrice === 'terendah') {
                $sortedFiles = $sortedFiles->sortBy(function ($file) {
                    return $file->price - ($file->price * ($file->discount / 100));
                });
            } else {
                $sortedFiles = $sortedFiles->sortByDesc(function ($file) {
                    return $file->price - ($file->price * ($file->discount / 100));
                });
            }
        @endphp

        @foreach ($sortedFiles as $file)
        <div class="p-4 border border-gray-300 rounded-lg shadow-lg bg-white">
            <img src="{{ asset('images/' . $file->photo) }}" alt="{{ $file->item_name }}" class="w-full h-48 object-cover rounded-md mb-4">
            <h2 class="mt-4 text-lg font-semibold text-gray-800">{{ $file->item_name ?? 'Nama Produk' }}</h2>
            @php
                $discountedPrice = $file->price - ($file->price * ($file->discount / 100));
            @endphp
            <div class="text-xl font-bold text-gray-800 mt-2">
                Rp{{ number_format($discountedPrice ?? 0, 0, ',', '.') }}
                <span class="text-sm text-gray-500 line-through">Rp{{ number_format($file->price ?? 0, 0, ',', '.') }}</span>
                <span class="text-red-600 font-semibold">{{ $file->discount ?? '0' }}%</span>
            </div>
            <div class="text-yellow-500 mb-0.5">★ {{ $file->rating ?? '0' }} ({{ $file->sold ?? 'no' }} terjual)</div>
            <div class="text-sm text-green-600 mb-2">Dijual oleh: {{ $file->mitra->name ?? 'Nama Toko' }}</div>
            
            <!-- Tombol Tambahkan ke Keranjang -->
            <button type="button" onclick="showModal(this)"
                data-id="{{ $file->id }}"
                data-name="{{ $file->item_name }}"
                data-price="{{ $discountedPrice }}"
                data-original-price="{{ $file->price }}"
                data-discount="{{ $file->discount }}"
                data-description="{{ $file->description }}"
                data-photo="{{ asset('images/' . $file->photo) }}"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">
                Tambahkan ke Keranjang
            </button>
        </div>
        @endforeach
    </div>
</div>

<!-- Modal -->
<div id="productModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
        <button class="absolute top-1 right-1 text-gray-500 hover:text-gray-700" onclick="hideModal()">✖</button>
        <img id="modalPhoto" src="" alt="Product Photo" class="w-full h-48 object-cover rounded-md mb-4">
        <h2 id="modalName" class="text-xl font-bold mb-2"></h2>
        <p id="modalDescription" class="text-sm text-gray-700 mb-4"></p>
        <div class="mb-4">
            <span id="modalPrice" class="text-lg font-semibold text-green-600"></span>
            <span id="modalOriginalPrice" class="text-sm text-gray-500 line-through"></span>
            <span id="modalDiscount" class="text-sm text-red-500 font-semibold"></span>
        </div>
        <div class="flex items-center mb-4">
            <label for="modalQuantity" class="text-sm font-semibold mr-2">Kuantitas:</label>
            <input id="modalQuantity" type="number" min="1" value="1" class="w-16 border rounded-lg p-1">
        </div>
        <form id="addToCartForm" action="#" method="POST">
            @csrf
            <input type="hidden" name="quantity" id="modalQuantityInput">
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">
                Tambahkan ke Keranjang
            </button>
        </form>
        
    </div>
</div>

<script>
    function showModal(button) {
        const id = button.dataset.id;
        const name = button.dataset.name;
        const price = button.dataset.price;
        const originalPrice = button.dataset.originalPrice;
        const discount = button.dataset.discount;
        const description = button.dataset.description;
        const photo = button.dataset.photo;
        const modalQuantity = document.getElementById('modalQuantity');
        document.getElementById('modalQuantityInput').value = modalQuantity.value;

        document.getElementById('modalName').textContent = name;
        document.getElementById('modalDescription').textContent = description;
        document.getElementById('modalPhoto').src = photo;
        document.getElementById('modalPrice').textContent = `Rp${parseInt(price).toLocaleString()}`;
        document.getElementById('modalOriginalPrice').textContent = `Rp${parseInt(originalPrice).toLocaleString()}`;
        document.getElementById('modalDiscount').textContent = `${discount}%`;

        document.getElementById('addToCartForm').action = `/cart/add/${id}`;

        document.getElementById('productModal').classList.remove('hidden');
    }
    document.getElementById('modalQuantity').addEventListener('input', function() {
    document.getElementById('modalQuantityInput').value = this.value;
});

    function hideModal() {
        document.getElementById('productModal').classList.add('hidden');
    }
</script>
@endsection