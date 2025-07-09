<x-layouts.app :title="__('Rekap Pemesanan')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Rekap Pemesanan</flux:heading>
        <flux:subheading size="lg" class="mb-6">Daftar semua pesanan yang masuk</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <div class="flex justify-end mb-4">
        <flux:button icon="plus" href="{{ route('orders.create') }}" variant="primary">
        Tambah Pesanan
        </flux:button>
    </div>


    @if(session()->has('success'))
    <flux:badge color="lime" class="mb-3 w-full">{{ session('success') }}</flux:badge>
    @endif

    <form action="{{ route('orders.export') }}" method="get" class="flex gap-2 items-center">
        <select name="month" class="form-select">
            @for ($i = 1; $i <= 12; $i++)
                <option value="{{ $i }}" {{ request('month') == $i ? 'selected' : '' }}
            class="text-gray-900 whitespace-nowrap">
                {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                </option>
                @endfor
        </select>

        <select name="year" class="form-select">
            @for ($y = now()->year; $y >= 2020; $y--)
            <option value="{{ $y }}" 
            class="text-gray-900 whitespace-nowrap"
            {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}
            </option>
            @endfor
        </select>

        <flux:button type="submit" icon="printer" variant="primary">
            Print to Excel
        </flux:button>
    </form>


    <div class="overflow-x-auto">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Produk
                    </th>
                    <th class="px-5 py-3 border-b-2 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Nama Pembeli
                    </th>
                    <th class="px-5 py-3 border-b-2 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        No. WA
                    </th>
                    <th class="px-5 py-3 border-b-2 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Jumlah
                    </th>
                    <th class="px-5 py-3 border-b-2 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Total Harga
                    </th>
                    <th class="px-5 py-3 border-b-2 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Status
                    </th>
                    <th class="px-5 py-3 border-b-2 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Catatan
                    </th>
                    <th class="px-5 py-3 border-b-2 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Waktu
                    </th>
                    <th class="px-5 py-3 border-b-2 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr class="bg-white border-b">
                    <td class="px-5 py-5 text-sm">
                        <p  class="text-gray-900 whitespace-no-wrap">
                            {{ $order->product->name ?? '-' }}
                        </p>
                    </td>
                    <td class="px-5 py-5 text-sm">
                        <p  class="text-gray-900 whitespace-no-wrap">
                            {{ $order->name }}
                        </p>
                    </td>
                    <td class="px-5 py-5 text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">
                            {{ $order->phone }}
                        </p>
                    </td>
                    <td class="px-5 py-5 text-sm">
                        <p  class="text-gray-900 whitespace-no-wrap">
                            {{ $order->quantity ?? '-' }}
                        </p>
                    </td>
                    <td class="px-5 py-5 text-sm">
                        <p  class="text-gray-900 whitespace-no-wrap">
                        @if($order->total_price)
                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        @else
                        -
                        @endif
                        </p>
                    </td>
                    <td class="px-5 py-5 text-sm">
                        <span class="inline-block px-2 py-1 text-xs font-semibold rounded 
                                {{ 
                                    $order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                    ($order->status === 'diproses' ? 'bg-blue-100 text-blue-800' :
                                    ($order->status === 'selesai' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'))
                                }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td class="px-5 py-5 text-sm">
                        <p  class="text-gray-900 whitespace-no-wrap">
                            {{ $order->note ?? '-' }}
                        </p>
                    </td>
                    <td class="px-5 py-5 text-sm">
                        <p  class="text-gray-900 whitespace-no-wrap">
                            {{ $order->created_at->format('d-m-Y H:i') }}
                        </p>
                    </td>
                    <td class="px-5 py-5 text-sm">
                        <flux:dropdown>
                            <flux:button icon:trailing="chevron-down">Action</flux:button>
                            <flux:menu>
                                <flux:menu.item icon="pencil" href="{{ route('orders.edit', $order->id) }}">Edit</flux:menu.item>
                                <flux:menu.item icon="trash" variant="danger"
                                    onclick="event.preventDefault(); if(confirm('Hapus pesanan ini?')) document.getElementById('delete-order-{{ $order->id }}').submit();">
                                    Hapus
                                </flux:menu.item>
                                <form id="delete-order-{{ $order->id }}" action="{{ route('orders.destroy', $order->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </flux:menu>
                        </flux:dropdown>
                    </td>
                </tr>
                @endforeach

                @if(session('open_whatsapp'))
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const phone = '{{ session('open_whatsapp') }}';
            const nomor = phone.replace(/^0/, '62');
            const pesan = encodeURIComponent("Halo, pesanan Anda telah selesai. Silakan dikonfirmasi. Terima kasih!");
            const url = `https://wa.me/${nomor}?text=${pesan}`;
            window.open(url, '_blank');
        });
    </script>
@endif

            </tbody>
        </table>
    </div>
</x-layouts.app>