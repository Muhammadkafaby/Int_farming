@extends('layouts.master')

@section('content')
<div class="max-w-md mx-auto mt-10">
    
    <h1 class="text-xl font-semibold text-center mt-28  ">Tambah Balance</h1>

    @if (session('success'))
        <div class="p-4 mt-4 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('add_balance.store') }}" method="POST" class="mt-20">
        @csrf
        <div class="mb-4">
            <label for="amount" class="block text-sm font-medium text-gray-700">Jumlah</label>
            <input type="number" name="amount" id="amount" class="block w-full mt-1 p-2 border rounded" required>
            @error('amount')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="w-full px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded">
            Tambah Balance
        </button>
    </form>
</div>
@endsection
