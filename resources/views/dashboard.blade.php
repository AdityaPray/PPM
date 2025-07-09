<x-layouts.app :title="'Dashboard'">
    <div class="p-6 space-y-6">

        {{-- Filter Form --}}
        <form method="GET" action="{{ route('dashboard') }}" class="mb-6 flex gap-4">
            <select name="month" class="rounded border px-2 py-1">
                @for ($m = 1; $m <= 12; $m++)
                    <option value="{{ $m }}" {{ $selectedMonth == $m ? 'selected' : '' }}
                    class="text-gray-900 whitespace-nowrap">
                        {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                    </option>
                @endfor
            </select>

            <select name="year" class="rounded border px-2 py-1">
                @for ($y = date('Y'); $y >= 2020; $y--)
                    <option value="{{ $y }}" {{ $selectedYear == $y ? 'selected' : '' }}
                    class="text-gray-900 whitespace-nowrap">
                        {{ $y }}
                    </option>
                @endfor
            </select>

            <button type="submit" class="bg-yellow-500 text-white px-4 py-1 rounded">Tampilkan</button>
        </form>

        {{-- Total Revenue --}}
        <div class="text-white text-lg font-semibold">
            Total Pendapatan: Rp{{ number_format($totalRevenue, 0, ',', '.') }}
        </div>

        {{-- Chart --}}
        <div class="bg-white dark:bg-neutral-900 p-4 rounded-xl shadow">
            <h2 class="text-xl font-semibold mb-4 text-black dark:text-white">
                Grafik Pendapatan Harian - {{ date('F', mktime(0, 0, 0, $selectedMonth, 1)) }} {{ $selectedYear }}
            </h2>
            <canvas id="salesChart" height="100"></canvas>
        </div>

        {{-- Table --}}

        <form method="GET" action="{{ route('dashboard') }}" class="mb-4 flex gap-2 items-center">
    <label for="start_date">Dari:</label>
    <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}" class="border p-1 rounded">

    <label for="end_date">Sampai:</label>
    <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}" class="border p-1 rounded">

    <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">Tampilkan</button>
</form>

        <div class="bg-white dark:bg-neutral-900 p-4 rounded-xl shadow">
    <h2 class="text-lg font-semibold mb-2 text-black dark:text-white">Detail Pendapatan Harian</h2>

    <table class="w-full text-sm text-black dark:text-white border-collapse">
        <thead>
            <tr class="border-b border-gray-300 dark:border-gray-700">
                <th class="py-2 text-left">Tanggal</th>
                <th class="py-2 text-left">Total Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($chartLabels as $index => $tanggalLengkap)
                <tr>
                    <td class="py-1">{{ $tanggalLengkap }}</td>
                    <td class="py-1">Rp{{ number_format($chartData[$index], 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


    </div>

    {{-- ChartJS CDN & Script --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($chartLabels),
                datasets: [{
                    label: 'Pendapatan Harian (Rp)',
                    data: @json($chartData),
                    backgroundColor: '#f59e0b'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    </script>
</x-layouts.app>
