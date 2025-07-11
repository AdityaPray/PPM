<x-layouts.app :title="('Edit Product')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Edit Produk</flux:heading>
        <flux:subheading size="lg" class="mb-6">Update Data Produk</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    @if(session()->has('successMessage'))
    <flux:badge color="lime" class="mb-3 w-full">{{ session('successMessage') }}</flux:badge>
    @elseif(session()->has('errorMessage'))
    <flux:badge color="red" class="mb-3 w-full">{{ session('errorMessage') }}</flux:badge>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <flux:input label="nama produk" name="name" value="{{ old('name', $product->name) }}" class="mb-3" />

        <flux:input label="Slug" name="slug" value="{{ old('slug', $product->slug) }}" class="mb-3" />

        <flux:input label="kode produk" name="sku" value="{{ old('sku', $product->sku) }}" class="mb-3" />

        <flux:input type="number" label="harga" name="price" value="{{ old('price', $product->price) }}" class="mb-3" />

        <flux:input type="number" label="stok barang" name="stock" value="{{ old('stock', $product->stock) }}" class="mb-3" />

        <flux:textarea label="Deskripsi" name="description" class="mb-3">{{ old('description', $product->description) }}</flux:textarea>

        @if($product->image_url)
        <div class="mb-3">
            <img src="{{ asset('storage/' . $product->image_url) }}"  alt="{{ $product->name }}" class="w-32 h-32 object-cover rounded">
        </div>
        @endif

        <flux:input type="file" label="gambar" name="image" class="mb-3" accept="image/*" />


        <div class="mb-3">
            <label class="block mb-2 text-sm font-medium">Status</label>
            <select name="is_active"
                class="w-full rounded border border-gray-300 p-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="1" {{ old('is_active', $product->is_active) == 1 ? 'selected' : '' }}>tersedia</option>
                <option value="0" {{ old('is_active', $product->is_active) == 0 ? 'selected' : '' }}>habis</option>
            </select>
        </div>
        <flux:select label="kategori" name="product_category_id" class="mb-3">
            <option value="">-- pilih kategori --</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ old('product_category_id', $product->product_category_id) == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
            @endforeach
              
        </flux:select>

        <flux:separator />

        <div class="mt-4">
            <flux:button type="submit" variant="primary">Update</flux:button>
            <flux:link href="{{ route('products.index') }}" variant="ghost" class="ml-3">Kembali</flux:link>
        </div>
    </form>
</x-layouts.app>