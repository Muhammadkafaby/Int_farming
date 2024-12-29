@extends('layouts.master_mitra')

@section('content')

<div class="min-h-screen flex items-center justify-center py-10 bg-gray-50 dark:bg-gray-900">
    <div class="w-full max-w-4xl bg-gradient-to-r from-green-200 to-yellow-100 border border-gray-300 shadow-xl rounded-xl p-8 mb-12 dark:bg-gray-800 dark:border-gray-700">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center dark:text-gray-200">
            Tambah Produk
        </h2>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form id="product-form" action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            <!-- Bagian Detail Produk -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div>
                    <!-- Nama Produk -->
                    <div class="mb-5">
                        <label for="item_name" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
                            Nama Produk
                        </label>
                        <input 
                            type="text" 
                            id="item_name" 
                            name="item_name" 
                            class="block w-full text-sm text-gray-700 bg-gray-50 border border-gray-300 rounded-lg shadow-md p-2 focus:outline-none focus:ring-2 focus:ring-green-400 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600" 
                            placeholder="Nama produk" 
                            required
                        >
                    </div>
                    <!-- Jenis Produk -->
                    <div class="mb-5">
                        <label for="item_type" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
                            Jenis Produk
                        </label>
                        <select 
                            id="item_type" 
                            name="item_type" 
                            class="block w-full text-sm text-gray-700 bg-gray-50 border border-gray-300 rounded-lg shadow-md p-2 focus:outline-none focus:ring-2 focus:ring-green-400 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600" 
                            required
                        >
                            <option value="">Pilih Jenis Produk</option>
                            <option value="Pupuk dan Vitamin">Pupuk dan Vitamin</option>
                            <option value="Benih">Benih</option>
                            <option value="Alat Tani">Alat Tani</option>
                            <option value="Obat Tanaman">Obat Tanaman</option>
                        </select>
                    </div>
                    <!-- Harga -->
                    <div class="mb-5">
                        <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
                            Harga (Rp)
                        </label>
                        <input 
                            type="number" 
                            id="price" 
                            name="price" 
                            class="block w-full text-sm text-gray-700 bg-gray-50 border border-gray-300 rounded-lg shadow-md p-2 focus:outline-none focus:ring-2 focus:ring-green-400 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600" 
                            placeholder="Harga produk" 
                            required
                        >
                        <span id="formattedHarga" class="block text-sm text-gray-700 dark:text-gray-400 mt-2"></span>
                    </div>
                    <!-- Stok -->
                    <div class="mb-5">
                        <label for="stock" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
                            Stok
                        </label>
                        <input 
                            type="number" 
                            id="stock" 
                            name="stock" 
                            class="block w-full text-sm text-gray-700 bg-gray-50 border border-gray-300 rounded-lg shadow-md p-2 focus:outline-none focus:ring-2 focus:ring-green-400 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600" 
                            placeholder="Jumlah stok" 
                            required
                        >
                    </div>

                    <div class="mb-5">
                        <label for="discount" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
                            Diskon
                        </label>
                        <input 
                            type="number" 
                            id="discount" 
                            name="discount" 
                            class="block w-full text-sm text-gray-700 bg-gray-50 border border-gray-300 rounded-lg shadow-md p-2 focus:outline-none focus:ring-2 focus:ring-green-400 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600" 
                            placeholder="0" 
                            required
                        >
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-5">
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
                            Deskripsi Produk
                        </label>
                        <textarea 
                            id="description" 
                            name="description" 
                            class="block w-full text-sm text-gray-700 bg-gray-50 border border-gray-300 rounded-lg shadow-md p-2 focus:outline-none focus:ring-2 focus:ring-green-400 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600" 
                            placeholder="Deskripsi produk" 
                            rows="4" 
                            required
                        ></textarea>
                    </div>
                </div>
                <!-- Bagian Foto Produk -->
                <div>
                    <div class="mb-5">
                        <label for="photo" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
                            Foto Produk
                        </label>
                        <input 
                            type="file" 
                            id="photo" 
                            name="photo" 
                            class="block w-full text-sm text-gray-700 bg-gray-50 border border-gray-300 rounded-lg shadow-md p-2 focus:outline-none focus:ring-2 focus:ring-green-400 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600" 
                            accept="image/*" 
                            required
                        >
                    </div>
                    <div class="mb-5">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
                            Preview Foto Produk
                        </label>
                        <div class="w-full h-64 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center text-gray-500 dark:text-gray-300">
                            <span id="preview-text">Foto belum diunggah</span>
                            <img 
                                id="preview-image" 
                                src="#" 
                                alt="Preview Produk" 
                                class="hidden w-full h-full object-contain rounded-lg"
                            >
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button 
                            type="button" 
                            id="remove-photo" 
                            class="px-4 py-2 bg-red-500 text-white font-semibold rounded-lg shadow hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-500"
                        >
                            Hapus Foto
                        </button>
                    </div>
                </div>
            </div>
            <!-- Submit Button -->
            <div class="flex justify-center">
                <button 
                    type="submit" 
                    class="px-6 py-3 bg-green-500 text-white font-semibold text-base rounded-lg shadow-lg hover:bg-green-600 focus:outline-none focus:ring-4 focus:ring-green-300 focus:ring-offset-2 transition-all duration-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-500"
                >
                    Tambah Produk
                </button>
            </div>
        </form>
    </div>
</div>

{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

<script>
    document.getElementById('photo').addEventListener('change', function(event) {
        const file = event.target.files[0];
        
        // Pengecekan format gambar
        if (!file.type.startsWith('image/')) {
            alert('Silakan unggah file gambar yang valid.');
            return;
        }
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewImage = document.getElementById('preview-image');
                const previewText = document.getElementById('preview-text');

                previewImage.src = e.target.result;
                previewImage.classList.remove('hidden');
                previewText.classList.add('hidden');
            }
            reader.readAsDataURL(file);
        }
    });

    document.getElementById('product-form').addEventListener('submit', function(event) {
        event.preventDefault();

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Pastikan semua data telah diisi dengan benar sebelum menambahkan produk.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Tambahkan!',
            cancelButtonText: 'Batal',
            confirmButtonColor: 'green',
            cancelButtonColor: 'red'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form
                this.submit(); // Allow form submission to proceed
            }
        });
    });

    const hargaInput = document.getElementById('price');
    const formattedHarga = document.getElementById('formattedHarga');

    hargaInput.addEventListener('input', function (e) {
        let value = this.value;
        let formattedValue = new Intl.NumberFormat('id-ID').format(value); // Format angka dengan pemisah titik
        formattedHarga.textContent = `Rp ${formattedValue}`;
    });

    document.getElementById('remove-photo').addEventListener('click', function () {
        const previewImage = document.getElementById('preview-image');
        const previewText = document.getElementById('preview-text');
        const photoInput = document.getElementById('photo');

        photoInput.value = '';
        previewImage.src = '#';
        previewImage.classList.add('hidden');
        previewText.classList.remove('hidden');
    });
</script>

@endsection

@section('footer')
