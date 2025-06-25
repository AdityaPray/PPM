<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class OrdersExport implements FromCollection, WithHeadings
{
    protected $month;
    protected $year;

    public function __construct($month, $year)
    {
        $this->month = $month;
        $this->year = $year;
    }

    public function collection(): Collection
    {
        return Order::with('product')
            ->whereMonth('created_at', $this->month)
            ->whereYear('created_at', $this->year)
            ->get()
            ->map(function ($order) {
                return [
                    'Nama Produk'   => $order->product->name ?? '-',
                    'Nama Pembeli'  => $order->name,
                    'No. HP'        => $order->phone,
                    'Jumlah'        => $order->quantity,
                    'Total Harga'   => $order->total_price,
                    'Status'        => $order->status,
                    'Catatan'       => $order->note,
                    'Tanggal Pesan' => $order->created_at->format('d-m-Y H:i')
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Nama Produk',
            'Nama Pembeli',
            'No. HP',
            'Jumlah',
            'Total Harga',
            'Status',
            'Catatan',
            'Tanggal Pesan'
        ];
    }
}
