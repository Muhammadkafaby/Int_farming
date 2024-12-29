<!-- resources/views/layouts/master.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Petani SuperMitraApp')</title>
    <!-- Bootstrap CSS -->
    @vite('resources/css/app.css')
    {{-- <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" /> --}}
    @vite(['resources/css/app.css','resources/js/app.js'])

</head>
<body>
    @include('navbar_mitra') <!-- Include navbar -->
    @if (session('error'))
    <div class="bg-red-500 text-white p-4 rounded">
        {{ session('error') }}
    </div>
@endif

@if (session('success'))
    <div class="bg-green-500 text-white p-4 rounded">
        {{ session('success') }}
    </div>
@endif
    @yield('content')
    @include('footer') <!-- Include footer -->

    {{-- <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script> --}}
    @vite(['resources/css/app.css','resources/js/app.js'])

</body>
</html>