<x-layouts.app :title="__('Categories')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Kategori</flux:heading>
        <flux:subheading size="lg" class="mb-6">Data kategori</flux:heading>
        <flux:separator variant="subtle" />
    </div>

    <div class="flex justify-between items-center mb-4">
        <div>
            <form action="{{ route('categories.index') }}" method="get">
                @csrf
                <flux:input icon="magnifying-glass" name="q" value="{{ $q }}" placeholder="Cari Kategori" />
            </form>
        </div>
        <div>
            <flux:button icon="plus">
                <flux:link href="{{ route('categories.create') }}" variant="subtle">Tambah Kategori</flux:link>
            </flux:button>
        </div>
    </div>

    @if(session()->has('successMessage'))
        <flux:badge color="lime" class="mb-3 w-full">{{session()->get('successMessage')}}</flux:badge>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        ID
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        gambar
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        nama produk
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Deskripsi
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        tanggal buat
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        hapus/edit
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $key=>$category)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ $key+1 }}
                            </p>
                        </td>
                       <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        @if($category->image)
                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="h-10 w-10 object-cover rounded">
                        @else
                        <div class="h-10 w-10 bg-gray-200 flex items-center justify-center rounded">
                            <span class="text-gray-500 text-sm">N/A</span>
                        </div>
                        @endif
                    </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ $category->name }}
                            </p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900">
                                {{  $category->description }}
                            </p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ $category->created_at }}
                            </p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">

                            <flux:dropdown>
                                <flux:button icon:trailing="chevron-down">Actions</flux:button>

                                <flux:menu>
                                    <flux:menu.item icon="pencil" href="{{ route('categories.edit', $category->id) }}">Edit</flux:menu.item>
                                    <flux:menu.item icon="trash" variant="danger" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this category?')) document.getElementById('delete-form-{{ $category->id }}').submit();">hapus</flux:menu.item>
                                    <form id="delete-form-{{ $category->id }}" action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </flux:menu>
                            </flux:dropdown>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3">
            {{ $categories->links() }}
        </div>
    </div>
    
</x-layouts.app>