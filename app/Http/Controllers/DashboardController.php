<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $selectedMonth = $request->input('month', now()->month);
        $selectedYear = $request->input('year', now()->year);

        // Total pendapatan untuk bulan & tahun yang dipilih
        $totalRevenue = Order::whereMonth('created_at', $selectedMonth)
            ->whereYear('created_at', $selectedYear)
            ->sum('total_price');

        // Data untuk grafik dan tabel: pendapatan per hari
        $salesData = Order::selectRaw('DAY(created_at) as day, SUM(total_price) as total')
            ->whereMonth('created_at', $selectedMonth)
            ->whereYear('created_at', $selectedYear)
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        $chartLabels = $salesData->pluck('day');
        $chartData = $salesData->pluck('total');

        return view('dashboard', compact(
            'totalRevenue',
            'chartLabels',
            'chartData',
            'selectedMonth',
            'selectedYear'
        ));
    }
}
