
<x-admin-layout>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

    {{-- Total User --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl p-6 flex items-center gap-4">
        <div class="p-3 bg-blue-100 dark:bg-blue-900 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600 dark:text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m8-4.26a4 4 0 100-8 4 4 0 000 8zM7 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
        </div>
        <div>
            <p class="text-sm text-gray-500 dark:text-gray-300">Total Pengguna</p>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $totalUser }}</h2>
        </div>
    </div>

    {{-- Total Produk --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl p-6 flex items-center gap-4">
        <div class="p-3 bg-green-100 dark:bg-green-900 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600 dark:text-green-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 7h18M3 12h18M3 17h18" />
            </svg>
        </div>
        <div>
            <p class="text-sm text-gray-500 dark:text-gray-300">Total Produk</p>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $totalProduk }}</h2>
        </div>
    </div>

    {{-- Total Pesanan --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl p-6 flex items-center gap-4">
        <div class="p-3 bg-purple-100 dark:bg-purple-900 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-600 dark:text-purple-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 3h18l-2 13H5L3 3zm2 16h14a2 2 0 11-2 2H7a2 2 0 11-2-2z" />
            </svg>
        </div>
        <div>
            <p class="text-sm text-gray-500 dark:text-gray-300">Total Pesanan</p>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $totalPesanan }}</h2>
        </div>
    </div>
     <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl p-6 flex items-center gap-4">
        <div class="p-3 bg-purple-100 dark:bg-purple-900 rounded-full">
           <svg xmlns="http://www.w3.org/2000/svg"
     class="h-8 w-8 text-purple-600 dark:text-purple-300"
     fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M19 7v14H5a2 2 0 01-2-2V5a2 2 0 012-2h9l5 4z" />
</svg>

        </div>
        <div>
            <p class="text-sm text-gray-500 dark:text-gray-300">Total Konten</p>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $totalKonten }}</h2>
        </div>
    </div>

     <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl p-6 flex items-center gap-4">
        <div class="p-3 bg-purple-100 dark:bg-purple-400 rounded-full">
             <svg xmlns="http://www.w3.org/2000/svg"
             class="h-8 w-8 text-green-600 dark:text-green-300"
             fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor">
            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2
                     3 .895 3 2-1.343 2-3 2m0-10
                     V6m0 12v-2m9-4
                     a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        </div>
        <div>
            <p class="text-sm text-gray-500 dark:text-gray-300">Transaksi</p>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $totalPembayaran }}</h2>
        </div>
    </div>

</div>
{{-- Chart Section --}}
<div class="mt-10 bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg">
    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">Statistik Data</h2>

    <canvas id="dashboardChart" class="w-full h-64"></canvas>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('dashboardChart').getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['User', 'Produk', 'Pesanan',"Transaksi"],
            datasets: [{
                label: 'Total Data',
                data: [
                    {{ $totalUser }},
                    {{ $totalProduk }},
                    {{ $totalPesanan }},
 {{ $totalPembayaran }}
                ],
                backgroundColor: [
                    'rgba(59, 130, 246, 0.7)',   // Biru
                    'rgba(16, 185, 129, 0.7)',   // Hijau
                    'rgba(139, 92, 246, 0.7)',
                    'rgba(139, 92, 246, 0.7)'    // Ungu
                ],
                borderColor: [
                    'rgba(59, 130, 246, 1)',
                    'rgba(16, 185, 129, 1)',
                    'rgba(139, 92, 246, 1)',
                    'rgba(139, 92, 246, 1)'
                ],
                borderWidth: 2,
                borderRadius: 10
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#d1d5db'
                    }
                },
                x: {
                    ticks: {
                        color: '#d1d5db'
                    }
                }
            }
        }
    });
</script>

</x-admin-layout>
