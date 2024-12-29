@extends('layouts.master')

@section('content')
    <div class="container mx-auto p-6">

    </div>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-center mb-6">Keranjang Checkout</h1>

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded-md mb-6">
                {{ session('success') }}
            </div>
        @endif
        
        @if (!empty($cart))
        <form action="{{ route('cart.checkout') }}" method="POST">
            @csrf
            <div class="grid gap-6">
                
                @foreach ($cart as $id => $item)
                <div class="bg-white rounded-lg shadow-md p-4 flex items-center gap-4">
                
                    <input type="checkbox" name="selected_items[]" value="{{ $id }}" class="h-5 w-5 text-blue-500 border-gray-300 rounded">
                    <div class="w-20 h-20 bg-gray-200 rounded overflow-hidden">
                        <img src="{{ asset('images/' . $item['photo']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                    </div>

                    <div class="flex-1">
                        <p class="text-lg font-semibold">{{ $item['name'] }}</p>
                        <p class="text-gray-500 text-sm">Kuantitas: {{ $item['quantity'] }}</p>
                    </div>

                    <div class="text-right">
                        @php
                            // dd($item);
                            $discountedPrice = $item['price'] - ($item['price'] * ($item['discount'] / 100));
                        @endphp
                        <p class="text-gray-500 text-sm">Harga:</p>
                        <p class="text-sm font-bold text-gray-500 line-through">Rp{{ number_format($item['price'], 0, ',', '.') }} </p>
                        <span class="text-xl font-bold text-green-500">Rp{{ number_format($discountedPrice, 0, ',', '.') }}</span>
                    </div>
                </div>
                @endforeach

                <div class="bg-white rounded-lg shadow-md p-4 flex flex-col gap-4 items-center">
                    <p class="text-xl font-bold">
                        Total:
                        <span class="text-red-500">Rp{{ number_format(array_sum(array_map(fn($item) => ($item['price'] - ($item['price'] * ($item['discount'] / 100))) * $item['quantity'], $cart)), 0, ',', '.') }}</span>
                    </p>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded">
                        Checkout
                    </button>
                </div>
            </div>
        </form>
        @else
            <p class="text-center mb-8 text-gray-600">Keranjang kosong!</p>
        @endif
    </div>
    <div class="container mx-auto p-6"></div>
</body>
</html>
@endsection