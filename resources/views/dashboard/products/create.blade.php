<x-layouts.app :title="__('Products')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Add New Product</flux:heading>
        <flux:subheading size="lg" class="mb-6">Manage data Products</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    @if(session()->has('successMessage'))
    <flux:badge color="lime" class="mb-3 w-full">{{ session()->get('successMessage') }}</flux:badge>
    @elseif(session()->has('errorMessage'))
    <flux:badge color="red" class="mb-3 w-full">{{ session()->get('errorMessage') }}</flux:badge>
    @endif

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <flux:input label="Name" name="name" value="{{ old('name') }}" class="mb-3" />

        <flux:input label="Slug" name="slug" value="{{ old('slug') }}" class="mb-3" />

        <flux:textarea label="Description" name="description" class="mb-3">{{ old('description') }}</flux:textarea>

        <flux:input label="SKU" name="sku" value="{{ old('sku') }}" class="mb-3" />

        <flux:input type="number" label="Price" name="price" value="{{ old('price') }}" class="mb-3" />

        <flux:input type="number" label="Stock" name="stock" value="{{ old('stock') }}" class="mb-3" />

        <flux:input type="file" label="Image" name="image" class="mb-3" />

        <flux:select label="Category" name="product_category_id" class="mb-3">
            <option value="">-- Select Category --</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ old('product_category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
            @endforeach
        </flux:select>


        <flux:separator />

        <div class="mt-4">
            <flux:button type="submit" variant="primary">Simpan</flux:button>
            <flux:link href="{{ route('products.index') }}" variant="ghost" class="ml-3">Kembali</flux:link>
        </div>

    </form>
</x-layouts.app>