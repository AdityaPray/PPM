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
    // Menampilkan form edit
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('dashboard.admin.edit', compact('order'));
    }

    // Menyimpan hasil edit
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status'       => 'required|string',
            'quantity'     => 'nullable|integer|min:1',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->quantity = $request->quantity;

        // Jika quantity diubah, hitung ulang total_price
        if ($request->has('quantity') && $order->product) {
            $order->total_price = $order->product->price * $request->quantity;
        }

         $order->save();
        // Jika status selesai, kirim nomor ke session
    if ($order->status === 'selesai') {
        return redirect()
            ->route('orders.index', $order->id)
            ->with('success', 'Pesanan diperbarui.')
            ->with('open_whatsapp', $order->phone);
    }

       

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil diperbarui.');
    }

    // Menghapus order
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dihapus.');
    }

    public function create()
    {
    $products = \App\Models\Product::all(); // Ambil daftar produk kalau diperlukan
    return view('dashboard.admin.create', compact('products'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|size:12|regex:/^08\d{10}$/',
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
        'note' => 'nullable|string',
        'status' => 'required|in:pending,diproses,selesai',
    ]);

    $product = Product::findOrFail($validated['product_id']);
    $validated['total_price'] = $product->price * $validated['quantity'];

    Order::create($validated);

    return redirect()->route('orders.index')->with('success', 'Pesanan berhasil ditambahkan.');
}
}
