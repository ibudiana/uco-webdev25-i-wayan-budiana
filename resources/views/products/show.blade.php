@extends('layouts.app')

@section('title', 'Product Details - ' . $product['name'])

@section('content')
@php
    $image = $product->images->isNotEmpty()
        ? asset('storage/upload/products/' . optional($product->images->firstWhere('is_primary', 1))->url)
        : asset('assets/images/no-images.jpeg');
@endphp

<section class="py-12">
    <div class="container mx-auto max-w-6xl grid grid-cols-1 md:grid-cols-2 gap-8">

        <!-- Left: Product Gallery -->
        <div x-data="{ mainImage: '{{ $image }}' }" class="max-w-lg mx-auto">
            <!-- Gambar utama -->
            <div class="w-full rounded-lg shadow-lg mb-4">
                <img :src="mainImage" alt="Product Image" class="w-full h-full object-cover rounded shadow-md transition-transform duration-300 hover:scale-105" />
            </div>

            <!-- Thumbnail gallery -->
            <div class="flex space-x-2 overflow-x-auto">
                @foreach (optional($product)->images ?? [] as $image)
                    <button
                        type="button"
                        @click="mainImage = '{{ asset('storage/upload/products/' . $image->url) }}'"
                        class="border rounded overflow-hidden focus:outline-none focus:ring-2 focus:ring-amber-500"
                    >
                        <img src="{{ asset('storage/upload/products/' . $image->url) }}" alt="Thumbnail" class="w-20 h-20 object-cover hover:brightness-90" />
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Right: Product Details -->
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ $product['name'] }}</h1>
            <p class="text-sm text-gray-600 mb-4">
                Category: <span class="font-semibold">{{ $product['category']['name'] }}</span> |
                Brand: <span class="font-semibold">{{ $product['brand']['name'] }}</span>
            </p>

            <div class="flex items-center justify-between mb-6">
                <span class="text-2xl font-bold text-amber-600">Rp {{ $product['formatted_price'] }}</span>
                <span class="text-sm text-gray-700 dark:text-white">Stock: {{ $product['stock'] }}</span>
            </div>

            <!-- Color Variants -->
            <div class="mb-4">
                <span class="block text-sm font-medium text-gray-800 dark:text-white mb-2">Color</span>
                <div class="flex flex-wrap gap-2">
                    @foreach ($product->variants as $variant)
                        @foreach ($variant->attributeValues as $attrValue)
                            @if (strtolower($attrValue->attribute->name) === 'color')
                                <button class="w-6 h-6 rounded-full border-2 border-gray-300" style="background-color: {{ strtolower($attrValue->value) }};"></button>
                            @endif
                        @endforeach
                    @endforeach
                </div>
            </div>

            <!-- Size Variants -->
            <div class="mb-6">
                <span class="block text-sm font-medium text-gray-800 dark:text-white mb-2">Size</span>
                <div class="flex gap-3">
                    @foreach ($product->variants as $variant)
                        @foreach ($variant->attributeValues as $attrValue)
                            @if (strtolower($attrValue->attribute->name) === 'size')
                                <button class="px-3 py-1 border text-sm rounded hover:bg-gray-100 dark:hover:bg-gray-700">
                                    {{ $attrValue->value }}
                                </button>
                            @endif
                        @endforeach
                    @endforeach
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col md:flex-row gap-3">
                <button @click="$store.cart.addItem({ id: {{ $product->id }}, name: '{{ $product->name }}', price: {{ $product->price}}, qty: 1 })" class="w-full md:w-auto bg-amber-600 text-white px-6 py-2 rounded hover:bg-amber-500">Add to Cart</button>
            </div>

            <!-- Description -->
            <div class="mt-8">
                <h2 class="text-xl font-semibold mb-2 text-gray-900 dark:text-white">Deskripsi</h2>
                <p class="text-gray-700 dark:text-gray-300">{{ $product['description'] }}</p>
            </div>
        </div>
    </div>
</section>
@endsection
