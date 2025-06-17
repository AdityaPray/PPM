<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'name'       => 'required|string|max:255',
            'phone'      => 'required|string|max:20',
            'note'       => 'nullable|string'
        ]);

        $product = Product::findOrFail($request->product_id);

        // Simpan ke database
        Order::create([
            'product_id' => $product->id,
            'name'       => $request->name,
            'phone'      => $request->phone,
            'note'       => $request->note,
        ]);

        // Buat pesan WhatsApp
        $message = "Saya tertarik dengan produk ini:\n"
                 . "{$product->name}\n"
                 . "Harga: Rp " . number_format($product->price, 0, ',', '.') . "\n"
                 . "Nama: {$request->name}\n"
                 . "Catatan: {$request->note}\n"
                 . url('/product/' . $product->slug);

        // Ganti dengan nomor admin tujuan WhatsApp
        $whatsappNumber = "6283161080128";

        // Redirect ke WhatsApp
        return redirect()->away("https://wa.me/{$whatsappNumber}?text=" . urlencode($message));
    }

    public function index()
    {
        $orders = Order::with('product')->latest()->get();
        return view('dashboard.admin.orders', compact('orders'));
    }
}