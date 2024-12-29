@extends('layouts.master_mitra')

@section('content')

<div class="container mx-auto p-4" style="padding-bottom: 5rem;">
    <div class="flex justify-between items-center mb-4">

        <div class="w-full md:w-1/2 md:flex-1">
            <input
                type="text"
                placeholder="Cari barang..."
                class="w-full p-2 border rounded-lg shadow focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
        </div>
        
        <div class="ml-1">
            <select
                class="p-2 border rounded-lg shadow focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                <option value="terendah">Harga: Terendah</option>
                <option value="tertinggi">Harga: Tertinggi</option>
            </select>
        </div>
    </div>

    <!-- Product Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @forelse ($farmingNeeds as $file)
        <div class="border rounded-lg shadow-lg p-4">
            <img src="{{ asset('images/' . $file->photo) }}" alt="{{ $file->item_name }}" class="w-full h-48 object-cover rounded-md mb-4">
            <h2 class="mt-4 text-lg font-semibold text-gray-800">{{ $file->item_name ?? 'Nama Produk' }}</h2>
            @php
                $discountedPrice = $file->price - ($file->price * ($file->discount / 100));
            @endphp
            <div class="text-xl font-bold text-gray-800 mt-2">
                Rp{{ number_format($discountedPrice ?? 0, 0, ',', '.') }}
                <span class="text-sm text-gray-500 line-through">Rp{{ number_format($file->price ?? 0, 0, ',', '.') }}</span>
                <span class="text-red-600 font-semibold">{{ $file->discount ?? '0' }}%</span>
                <div class="text-yellow-500 mb-0.5">★ {{ $file->rating ?? '0' }} ({{ $file->sold ?? 'no' }} terjual)</div>
            <div class="text-sm text-green-600 mb-2">Toko {{ $file->mitra->name ?? 'Nama Toko' }}</div>
            </div>
            <a 
                href="{{ route('farming_needs.detail', ['id' => $file->id]) }}" 
                class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg text-center block mt-2"
            >
                Detail
            </a>
            <form action="{{ route('mitra.delete_product', ['id' => $file->id]) }}" method="POST" class="delete-form w-full mt-2">
                @csrf
                @method('DELETE')
                <button 
                    type="button" 
                    class="delete-button w-full bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg text-center block"
                >
                    Delete
                </button>
            </form>
        </div>
        @empty
        <p class="col-span-4 text-center text-gray-500">Tidak ada produk untuk toko ini.</p>
        @endforelse
    </div>
</div>

{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-button');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                const form = this.closest('form');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda tidak akan dapat mengembalikan ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: 'green',
                    cancelButtonColor: 'red',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>

@endsection