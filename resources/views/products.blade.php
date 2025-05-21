@extends('layouts.app')

{{-- Meta Section --}}
@section('title', 'Products')

{{-- Product Content --}}
@section('content')
<section class="pb-12 pt-12">
    <div class="container mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-6 gap-6">
            {{-- Sidebar Filter --}}
            <aside class="lg:col-span-1 p-4 text-sm">
                <h2 class="block text-lg/6 font-medium text-gray-900 dark:text-gray-50 mb-4">Filter Produk</h2>
                <form method="GET" action="{{ route('products.index') }}">
                    {{-- Filter Name --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2 text-gray-900 dark:text-gray-50">Search</label>
                        <input type="text" name="search" value="{{ request('search') }}" class="w-full border rounded px-3 py-2 dark:text-gray-50" placeholder="Search by name">
                    </div>

                    {{-- Filter Kategori --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2 text-gray-900 dark:text-gray-50">Brands</label>
                        <select name="brand" class="w-full border rounded px-3 py-2 dark:text-gray-50">
                            <option value="">All Brand</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Filter Brand --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2 text-gray-900 dark:text-gray-50">Categories</label>
                        <select name="category" class="w-full border rounded px-3 py-2 dark:text-gray-50">
                            <option value="">All Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    {{-- Filter Harga --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2 text-gray-900 dark:text-gray-50">Min Price</label>
                        <input type="number" name="min_price" value="{{ request('min_price') }}" class="w-full border rounded px-3 py-2 dark:text-gray-50" placeholder="Input minimal price">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2 text-gray-900 dark:text-gray-50">Max Price</label>
                        <input type="number" name="max_price" value="{{ request('max_price') }}" class="w-full border rounded px-3 py-2 dark:text-gray-50" placeholder="input maximum price">
                    </div>
                    {{-- Tombol Filter --}}
                    <button type="submit" class="w-full bg-amber-500 text-white py-2 rounded hover:bg-amber-600">Search</button>
                </form>

                {{-- Tombol Add New Product --}}
                <a href="{{ route('products.create') }}" >
                    <button class="mt-7 w-full bg-amber-500 text-white py-2 rounded hover:bg-amber-600">Add New Product</button>
                </a>
            </aside>

            {{-- Product Grid --}}
            <div class="lg:col-span-5">
                <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-5 gap-6">
                    @forelse ($products as $product)
                        <x-products.card :product="$product" />
                    @empty
                    <div class="w-full col-span-full flex flex-col items-center justify-center text-center py-12 text-gray-500 dark:text-gray-300">
                        <i class="fa-solid fa-box-open text-4xl mb-4 text-amber-500"></i>
                        <h3 class="text-lg font-semibold mb-2">No products found</h3>
                        <p class="text-sm max-w-md">
                            Sorry, we couldn't find any products that match your search. Try using different keywords or browse other categories.
                        </p>
                    </div>
                    @endforelse
                </div>
                {{-- Pagination Links --}}
                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

