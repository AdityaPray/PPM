<x-layout>
    @include('components.navbar')
    <div class="row">
        @foreach($products as $product)
            <div class="col-3 mb-4">
                <div class="card">
                    @if($product->image_url)
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="card-img-top object-cover" style="height: 150px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                        <a href="#" class="btn btn-sm btn-primary">Detail</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-layout>
