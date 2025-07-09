<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;

class DashboardController extends Controller
{
public function index(Request $request)

    {
        // Ambil input filter
        $selectedMonth = $request->input('month', now()->month);
        $selectedYear = $request->input('year', now()->year);
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Siapkan query dasar
        $query = Order::query();

        // Filter data berdasarkan tanggal atau bulan-tahun
        if ($startDate && $endDate) {
            $query->whereDate('created_at', '>=', $startDate)
                  ->whereDate('created_at', '<=', $endDate);
        } else {
            $query->whereMonth('created_at', $selectedMonth)
                  ->whereYear('created_at', $selectedYear);
        }

        // Hitung total pendapatan dari hasil query
        $totalRevenue = $query->sum('total_price');

        // Ambil data pendapatan per hari (tanggal lengkap)
        $salesData = $query->selectRaw('DATE(created_at) as full_date, SUM(total_price) as total')
                           ->groupBy('full_date')
                           ->orderBy('full_date')
                           ->get();

        // Ambil label dan data untuk chart/tabel
        $chartLabels = $salesData->pluck('full_date')->map(function ($date) {
    return date('d F Y', strtotime($date));
});


        $chartData = $salesData->pluck('total');

        // Kirim data ke view
        return view('dashboard', compact(
            'totalRevenue',
            'chartLabels',
            'chartData',
            'selectedMonth',
            'selectedYear'
        ));
    }
}


