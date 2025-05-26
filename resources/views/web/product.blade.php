<x-layout>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-6">
                @if($product->image)
                    <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded shadow">
                @else
                    <div class="bg-secondary text-white text-center py-5">Gambar tidak tersedia</div>
                @endif
            </div>
            <div class="col-md-6">
                <h2>{{ $product->name }}</h2>
                <p class="text-muted">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                <hr>
                <p>{{ $product->description }}</p>

                @php
                    $message = "Saya tertarik dengan produk ini:\n"
                             . "*$product->name*\n"
                             . "Harga: Rp " . number_format($product->price, 0, ',', '.') . "\n"
                             . url()->current();
                @endphp

                <a href="https://wa.me/6283161080128?text={{ urlencode($message) }}" class="btn btn-success">
                    <i class="bi bi-whatsapp"></i> PESAN
                </a>
            </div>
        </div>
    </div>
</x-layout>
