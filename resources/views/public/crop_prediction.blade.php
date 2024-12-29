@extends('layouts.master')

@section('content')

<div class="min-h-screen bg-gray-100 flex items-center justify-center" style="padding-top: 9rem; padding-bottom: 5rem;">
    <div class="w-full max-w-3xl bg-gradient-to-r from-green-200 to-yellow-100 border border-gray-300 shadow-xl rounded-xl p-8 dark:bg-gray-800 dark:border-gray-700">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Prediksi Harga Panen</h2>
        
        <form action="/predict-harvest" method="POST" class="space-y-6">
            @csrf <!-- Ensure CSRF protection is added -->
            
            <!-- Nitrogen -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Nitrogen</label>
                <input type="number" name="nitrogen" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-green-300" placeholder="Masukkan rasio nitrogen">
            </div>

            <!-- Phosphorus -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Phosphorus</label>
                <input type="number" name="phosphorus" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-green-300" placeholder="Masukkan rasio phosphorus">
            </div>

            <!-- Potassium -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Potassium</label>
                <input type="number" name="potassium" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-green-300" placeholder="Masukkan rasio potassium">
            </div>

            <!-- Temperature -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Temperature (°C)</label>
                <input type="number" name="temperature" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-green-300" placeholder="Masukkan suhu dalam °C">
            </div>

            <!-- Humidity -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Humidity (%)</label>
                <input type="number" name="humidity" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-green-300" placeholder="Masukkan kelembaban dalam %">
            </div>

            <!-- pH Value -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2">pH Value</label>
                <input type="number" step="0.1" name="ph_value" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-green-300" placeholder="Masukkan nilai pH">
            </div>

            <!-- Rainfall -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Rainfall (mm)</label>
                <input type="number" name="rainfall" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-green-300" placeholder="Masukkan curah hujan dalam mm">
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 focus:outline-none focus:ring focus:ring-blue-300">
                    Prediksi Harga Panen
                </button>
            </div>
        </form>

        <!-- Hasil Prediksi -->
        <div class="mt-8 text-center">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Harga Panen per 100 kg</h3>
            <p id="prediction-result" class="text-xl font-bold text-blue-600 mt-2">₹ 0</p>
        </div>
    </div>
</div>

@endsection
