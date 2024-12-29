<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
        @vite('resources/css/app.css')

        <style>
            body {
                background-image: url('/assets/background_login.jpg');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-color: rgba(0, 0, 0, 0.6);
                background-blend-mode: darken;
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <!-- Card Container -->
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-gray-100 dark:bg-gray-800 shadow-lg sm:rounded-lg" 
             style="background: linear-gradient(135deg, #62f67d, #fffb7d); box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);">
            
            <!-- USER and MITRA Buttons -->
            <div class="flex justify-around mb-6">
                <a href="/" class="w-1/2 px-6 py-3 text-xl text-center font-bold bg-white shadow-md text-gray-800 rounded-lg hover:bg-blue-500 hover:text-white transition-all duration-300 ease-in-out transform hover:scale-105">
                    USER
                </a>
                <a href="{{ route('mitra.login') }}" class="w-1/2 px-6 py-3 text-xl text-center font-bold bg-white shadow-md text-gray-800 rounded-lg ml-4 hover:bg-red-500 hover:text-white transition-all duration-300 ease-in-out transform hover:scale-105">
                    MITRA
                </a>
            </div>
            
            <!-- Logo -->
            <div class="text-center mb-6">
                <a href="/">
                    <img src="/assets/logo.png" class="w-40 mx-auto" alt="Logo">
                </a>
            </div>

            <!-- Slot for Form Content -->
            <div>
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>