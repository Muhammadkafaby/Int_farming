@extends('layouts.master_mitra')
<!-- Hero Section -->
@section('content')

<section class="bg-gray-100 py-12 relative" 
         style="background: url('{{ asset('assets/background_user_dashboard.jpg') }}') no-repeat center center; background-size: cover; height: 300px;">
    <!-- Optional overlay for better text visibility -->
    <div class="absolute inset-0 bg-black opacity-40 pointer-events-none"></div> 
    <!-- Text container -->
    <div class="container mx-auto flex flex-col items-center justify-center h-full relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white">Selamat Datang</h1>
        <h2 class="text-2xl md:text-3xl font-semibold text-white mt-2">{{ Auth::user()->name }}</h2>
    </div>
</section>

<!-- Product Grid -->
<section class="py-12 bg-gray-50 mb-12">
    <div class="container mx-auto px-6">
        <!-- Header -->
        <h2 class="text-3xl font-bold text-gray-800 mb-8">Laporan Penjualan Bulanan</h2>

        <!-- Filter Section -->
        {{-- <div class="bg-white p-6 rounded-lg shadow-lg mb-8">
            <h3 class="text-xl font-semibold text-gray-700 mb-4">Filter Laporan</h3>
            <form class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4"> --}}
                <!-- Month Filter -->
                {{-- <div class="w-full md:w-1/3">
                    <label for="month" class="block text-sm font-medium text-gray-700">Bulan</label>
                    <select id="month" name="month" class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Pilih Bulan</option>
                        <option value="01">Januari</option>
                        <option value="02">Februari</option>
                        <option value="03">Maret</option>
                        <option value="04">April</option>
                        <option value="05">Mei</option>
                        <option value="06">Juni</option>
                        <option value="07">Juli</option>
                        <option value="08">Agustus</option>
                        <option value="09">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                </div>
                <!-- Year Filter -->
                <div class="w-full md:w-1/3">
                    <label for="year" class="block text-sm font-medium text-gray-700">Tahun</label>
                    <select id="year" name="year" class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Pilih Tahun</option>
                        <option value="2024">2024</option>
                        <option value="2023">2023</option>
                        <option value="2022">2022</option>
                        <option value="2021">2021</option>
                    </select>
                </div>
                <!-- Filter Button -->
                <div class="w-full md:w-auto">
                    <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">Terapkan Filter</button>
                </div>
            </form>
        </div> --}}

        <!-- Sales Summary Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Total Sales -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold text-gray-700">Total Penjualan</h3>
                <p class="text-3xl font-bold text-green-500 mt-2">{{ Auth::user()->profit }}</p>
                <span class="text-sm text-gray-500">+10% dari bulan lalu</span>
            </div>
            <!-- Total Orders -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold text-gray-700">Total Pesanan</h3>
                @php
                    $totalOrders = 0;
                    foreach ($data as $datas) {
                        $totalOrders += $datas->sold;
                    }
                @endphp
                <p class="text-3xl font-bold text-blue-500 mt-2">{{ $totalOrders }}</p>
                <span class="text-sm text-gray-500">+5% dari bulan lalu</span>
            </div>
            <!-- Total Customers -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold text-gray-700">Rating Toko</h3>
                @php
                    $avgRating = 1;
                    foreach ($data as $datas) {
                        $avgRating += $datas->rating;
                    }
                    if (count($data) == 0) {
                        $avgRating = 0;
                    } else {
                        $avgRating = $avgRating / count($data);
                    }
                @endphp
                <p class="text-3xl font-bold text-yellow-500 mt-2">{{ $avgRating }}</p>
                
            </div>
        </div>

        <!-- Sales Table -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8">
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 text-left">
                            <th class="py-3 px-4">Produk</th>
                            <th class="py-3 px-4">Jumlah Terjual</th>
                            <th class="py-3 px-4">Pendapatan</th>
                            <th class="py-3 px-4">Rating</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach ($data as $datas)
                        <tr class="border-b">
                            <td class="py-3 px-4">{{ $datas->item_name }}</td>
                            <td class="py-3 px-4">{{ $datas->sold }}</td>
                            @php
                                $alltimeprofite = $datas->price * $datas->sold;
                            @endphp
                            <td class="py-3 px-4">Rp{{ number_format($alltimeprofite, 0, ',', '.') }}</td>
                            <td class="py-3 px-4">{{ $datas->rating }}</td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <!-- Sales Chart -->
    <div class="container mx-auto px-6">
        <!-- Header -->
        <h2 class="text-3xl font-bold text-gray-800 mb-8 hidden md:block">Laporan Pendapatan Tahunan</h2>

        <!-- Filter Section for Sales Chart -->
        <div class="bg-white p-6 rounded-lg shadow-lg mb-8 hidden md:block">
            <h3 class="text-xl font-semibold text-gray-700 mb-4">Filter Grafik Penjualan</h3>
            <form id="chartFilterForm" class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4">
                <!-- Year Filter -->
                <div class="w-full md:w-1/3">
                    <label for="chartYear" class="block text-sm font-medium text-gray-700">Tahun</label>
                    <select id="chartYear" name="year" class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="2024">2024</option>
                        <option value="2023">2023</option>
                        <option value="2022">2022</option>
                        <option value="2021">2021</option>
                    </select>
                </div>
                <!-- Filter Button -->
                <div class="w-full md:w-auto">
                    <button type="button" id="applyFilter" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">Terapkan Filter</button>
                </div>
            </form>
        </div>

        <!-- Sales Chart -->
        <div class="bg-white p-6 rounded-lg shadow-lg hidden md:block">
            <h3 class="text-xl font-semibold text-gray-700 mb-4">Grafik Penjualan</h3>
            <canvas id="salesChart" class="w-full h-64"></canvas> <!-- Canvas for Chart -->
        </div>
    </div>
</section>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Script for Chart.js and Filter -->
    <script>
    // Dummy data for different years
    const salesData = {
        2024: [...Array.from({length: 11}, () => Math.floor(Math.random() * 10000000)), {{ Auth::user()->profit }}],
        2023: Array.from({length: 12}, () => Math.floor(Math.random() * 10000000)),
        2022: Array.from({length: 12}, () => Math.floor(Math.random() * 10000000)),
        2021: Array.from({length: 12}, () => Math.floor(Math.random() * 10000000))
    };

    // Create the initial chart
    const ctx = document.getElementById('salesChart').getContext('2d');
    let salesChart = new Chart(ctx, {
        type: 'line', // Line chart
        data: {
            labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'], // Month labels
            datasets: [{
                label: 'Pendapatan (Rp)',
                data: salesData[2024], // Initial data for the year 2024
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2,
                fill: true,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString(); // Format to Rupiah
                        }
                    }
                }
            }
        }
    });


    document.getElementById('applyFilter').addEventListener('click', function() {
        const selectedYear = document.getElementById('chartYear').value;
        salesChart.data.datasets[0].data = salesData[selectedYear];
        salesChart.update(); 
    });
    </script>

@endsection

<!-- Footer -->
@section('footer')