@extends('layouts.master')

@section('content')

<div class="min-h-screen flex items-center justify-center py-10 bg-gray-50 dark:bg-gray-900">
    <div class="w-full max-w-3xl bg-gradient-to-r from-green-200 to-yellow-100 border border-gray-300 shadow-xl rounded-xl p-8 dark:bg-gray-800 dark:border-gray-700">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">
            Hasil Deteksi Penyakit Kentang
        </h2>
        
        <div class="relative flex justify-center">
            <!-- Display the uploaded/detected image -->
            <img 
                src="{{ $image_url }}" 
                alt="Detected Image" 
                style="width: 100%; max-width: 300px; height: auto; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);" 
                class="mx-auto"
            >
        </div>
        
        <div class="mt-8 flex justify-center">
            <a href="/cek_tanaman" 
               class="px-8 py-3 bg-blue-500 text-white font-semibold text-base rounded-lg shadow-lg hover:bg-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-300 focus:ring-offset-2 transition-all duration-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-500">
                Kembali
            </a>
        </div>
    </div>
</div>

@endsection
