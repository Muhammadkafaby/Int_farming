@extends('layouts.master')

@section('content')

<div class="min-h-screen flex items-center justify-center py-10 bg-gray-50 dark:bg-gray-900">
    <div class="w-full max-w-3xl bg-gradient-to-r from-green-200 to-yellow-100 border border-gray-300 shadow-xl rounded-xl p-8 dark:bg-gray-800 dark:border-gray-700">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">
            Deteksi Penyakit Kentang
        </h2>
        <form action="/cek_tanaman/hasil" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            <div class="flex flex-col items-center">
                <label for="image" class="text-lg font-medium text-gray-700 dark:text-gray-200 mb-3">
                    Upload Gambar Tanaman
                </label>
                <input 
                    type="file" 
                    name="image" 
                    id="image" 
                    class="block w-full max-w-sm text-sm text-gray-700 bg-gray-50 border border-gray-300 rounded-lg shadow-md p-2 cursor-pointer focus:outline-none focus:ring-2 focus:ring-green-400 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600" 
                    required
                    onchange="previewImage(event)"
                >
                <img 
                    id="imagePreview" 
                    style="width: 100%; max-width: 300px; height: auto; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15); display: none;" 
                    class="mt-6"
                >
            </div>
            <div class="flex justify-center">
                <button 
                    type="submit" 
                    class="px-8 py-3 bg-green-500 text-white font-semibold text-base rounded-lg shadow-lg hover:bg-green-600 focus:outline-none focus:ring-4 focus:ring-green-300 focus:ring-offset-2 transition-all duration-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-500"
                >
                    Detect
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById('imagePreview');
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

@endsection

@section('footer')
