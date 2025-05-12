<x-layouts.app :title="('products')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Products</flux:heading>
        <flux:subheading size="lg" class="mb-6">Manage product data</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <div class="flex justify-between items-center mb-4">
        <form action="{{ route('products.index') }}" method="get">
            @csrf
            <flux:input icon="magnifying-glass" name="q" value="{{ $q }}" placeholder="Search Products" />
        </form>
        <div>
            <flux:button icon="plus">
                <flux:link href="{{ route('products.create') }}" variant="subtle">Add New Product</flux:link>
            </flux:button>
        </div>
    </div>

    @if(session()->has('successMessage'))
    <flux:badge color="lime" class="mb-3 w-full">{{ session('successMessage') }}</flux:badge>
    @endif

    <div class="w-full overflow-x-auto px-0 mx-0">
        <table class="w-full table-auto border border-gray-700 text-sm">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-4 py-2 border">ID</th>
                    <th class="px-4 py-2 border">Image</th>
                    <th class="px-4 py-2 border">Name</th>
                    <th class="px-4 py-2 border">Slug</th>
                    <th class="px-4 py-2 border">SKU</th>
                    <th class="px-4 py-2 border">Price</th>
                    <th class="px-4 py-2 border">Stock</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Created At</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white text-black">
                @forelse($products as $key => $product)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-2 border">{{ $key + 1 }}</td>
                    <td class="px-4 py-2 border">
                        @if($product->image_url)
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                            class="h-10 w-10 object-cover rounded mx-auto">
                        @else
                        <div class="h-10 w-10 bg-gray-200 flex items-center justify-center rounded mx-auto">
                            <span class="text-gray-500 text-sm">N/A</span>
                        </div>
                        @endif
                    </td>
                    <td class="px-4 py-2 border">{{ $product->name }}</td>
                    <td class="px-4 py-2 border">{{ $product->slug }}</td>
                    <td class="px-4 py-2 border">{{ $product->sku }}</td>
                    <td class="px-4 py-2 border">Rp {{ number_format($product->price, 2, ',', '.') }}</td>
                    <td class="px-4 py-2 border">{{ $product->stock }}</td>
                    <td class="px-4 py-2 border">
                        @if($product->is_active)
                        <flux:badge color="lime">Active</flux:badge>
                        @else
                        <flux:badge color="red">Inactive</flux:badge>
                        @endif
                    </td>
                    <td class="px-4 py-2 border">{{ $product->created_at->format('d-m-Y') }}</td>
                    <td class="px-4 py-2 border">
                        <flux:dropdown>
                            <flux:button icon:trailing="chevron-down">Actions</flux:button>
                            <flux:menu>
                                <flux:menu.item icon="pencil" href="{{ route('products.edit', $product->id) }}">Edit
                                </flux:menu.item>
                                <flux:menu.item icon="trash" variant="danger"
                                    onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this product?')) document.getElementById('delete-form-{{ $product->id }}').submit();">
                                    Delete
                                </flux:menu.item>
                                <form id="delete-form-{{ $product->id }}"
                                    action="{{ route('products.destroy', $product->id) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </flux:menu>
                        </flux:dropdown>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center py-4 text-gray-500">No products found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $products->links() }}
        </div>
    </div>
</x-layouts.app>