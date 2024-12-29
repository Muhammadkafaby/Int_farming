@extends('layouts.master')

@section('content')
<!-- Hero Section -->
<section 
    class="relative w-full h-screen text-center flex items-center justify-center" 
    style="
        background-image: url('assets/background_user_dashboard.jpg'); 
        background-size: cover; 
        background-position: center; 
        background-repeat: no-repeat;"
>
    <!-- Dark overlay -->
    <div class="absolute inset-0 bg-black opacity-60"></div>

    <!-- Content -->
    <div class="relative z-10 flex flex-col items-center justify-center text-center max-w-lg mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4 text-white">
            PETANI
        </h1>
        <p class="text-base sm:text-lg md:text-xl text-white mb-6">
            Pengelolaan Ekosistem Teknologi Agrikultur dengan Navigasi Intelektual
        </p>
        <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
            <a 
                href="{{ route('belanja') }}" 
                class="bg-transparent border-2 border-white text-white font-semibold py-3 px-8 rounded-lg hover:bg-white hover:text-black transition"
                style="min-width: 150px;"
            >
                Belanja Sekarang
            </a>
            <a 
                href="{{ route('cek_tanaman') }}" 
                class="bg-transparent border-2 border-white text-white font-semibold py-3 px-8 rounded-lg hover:bg-white hover:text-black transition"
                style="min-width: 150px;"
            >
                Cek Tanaman
            </a>
            <a 
                href="{{ route('chatbot') }}" 
                class="bg-transparent border-2 border-white text-white font-semibold py-3 px-8 rounded-lg hover:bg-white hover:text-black transition"
                style="min-width: 150px;"
            >
                Tanya Emilia
            </a>
        </div>
    </div>
</section>
@endsection
