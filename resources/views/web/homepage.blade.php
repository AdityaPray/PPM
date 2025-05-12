<x-layout>
    <div class="row">
        {{-- Bagian Categories --}}
        <div class="col-4">
            <h3>Categories</h3>
            @foreach($categories as $category)
                <div class="card mb-3" style="height:38vh">
                    <img src="{{ $category['image'] }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $category['name'] }}</h5>
                        <p class="card-text">{{ $category['description'] }}</p>
                        <a href="/category/{{ $category['slug'] }}" class="btn btn-primary btn-sm">Detail</a>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Bagian Products --}}
        <div class="col-8">
            <h3>Products</h3>
            <div class="row">
                @foreach($products as $product)
                    <div class="col-6 mb-4">
                        <div class="card h-100">
                            @if($product->image_url)
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="card-img-top">
                            @else
                                <div class="h-100 w-100 bg-secondary text-white d-flex align-items-center justify-content-center">
                                    N/A
                                </div>
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                                <a href="products" class="btn btn-sm btn-primary">Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layout>
