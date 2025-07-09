<x-layout>
    <div class="container my-5">
        <div class="row">
            {{-- Kolom Gambar Produk --}}
            <div class="col-md-6">
                @if($product->image_url)
                    <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="img-fluid rounded shadow">
                @else
                    <div class="bg-secondary text-white text-center py-5">Gambar tidak tersedia</div>
                @endif
            </div>

            {{-- Kolom Detail Produk dan Form --}}
            <div class="col-md-6">
                <h2>{{ $product->name }}</h2>
                <p class="text-muted">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                <hr>
                <p>{{ $product->description }}</p>

                {{-- Form Konfirmasi Sebelum Masuk WhatsApp --}}
                <form method="POST" action="{{ route('order.submit') }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Anda</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
    <label for="phone" class="form-label">Nomor WhatsApp</label>
    <input 
        type="text" 
        name="phone" 
        class="form-control" 
        required 
        pattern="08\d{10}" 
        title="Nomor WhatsApp harus terdiri dari 12 digit angka. Contoh: 081234567890">
</div>


                    <div class="mb-3">
                        <label for="note" class="form-label">Catatan (Opsional)</label>
                        <textarea name="note" class="form-control"></textarea>
                    </div>

                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-whatsapp"></i> Konfirmasi & Lanjut ke WhatsApp
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layout>