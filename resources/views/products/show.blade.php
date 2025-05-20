@extends('layouts.app')

{{-- Meta Section --}}
@section('title', 'Product Details - ' . $product['name'])

{{-- Product Content --}}

@section('content')
@php
    $image    = $product->images->isNotEmpty()  ? asset('storage/upload/products/' . $product->images[0]->url) : asset('assets/images/no-images.jpeg');
@endphp

<section class="py-12">
    <div class="container mx-auto max-w-4xl">
        <!-- Product Image -->
        <div class="mb-6">
            <img src="{{ $image  }}" alt="{{ $product['name'] }}" class="w-34 h-auto rounded-lg shadow-lg">
        </div>
        <!-- Product Title -->
        <h1 class="text-3xl font-bold mb-2 text-gray-900 dark:text-gray-50">{{ $product['name'] }}</h1>
        <p class="text-gray-900 dark:text-gray-50 text-sm mb-6">
            Category: <span class="font-semibold">{{ $product['category']['name'] }}</span> |
            Brand: <span class="font-semibold">{{ $product['brand']['name'] }}</span>
        </p>

        <!-- Product Price & Stock -->
        <div class="flex items-center justify-between mb-6">
            <div class="text-2xl font-bold text-amber-600 ">Rp {{ $product['formatted_price'] }}</div>
            <div class="text-sm text-gray-900 dark:text-gray-50">Stock: {{ $product['stock'] }}</div>
        </div>

        <!-- Description -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-2 text-gray-900 dark:text-gray-50">Description</h2>
            <p class="text-gray-900 dark:text-gray-50">{{ $product['description'] }}</p>
        </div>

        <!-- Variants -->
        @if ($product->variants->isNotEmpty())
            <div>
                <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-50">Variants</h2>
                <div class="space-y-4">
                    @foreach ($product->variants as $variant)
                        <div class="rounded-lg p-4 shadow-sm border-1 border-amber-500">
                            <div class="flex flex-col mb-2 gap-2">
                                <div>
                                    <span class="font-medium">SKU: {{ $variant->sku }}</span>
                                </div>
                                <div class="text-amber-600 font-semibold">
                                    Rp {{ number_format($variant->price, 0, ',', '.') }}
                                </div>
                            </div>
                            <div class="text-sm text-gray-600 mb-2">Stock: {{ $variant->stock }}</div>

                            <!-- Attribute Values -->
                            @if ($variant->attributeValues->isNotEmpty())
                                <div class="flex flex-wrap gap-2">
                                    @php
                                        // Group attribute_values by attribute name
                                        $groupedAttributes = [];

                                        foreach ($variant->attributeValues as $attrValue) {
                                            $name = $attrValue->attribute->name;
                                            $groupedAttributes[$name][] = $attrValue->value;
                                        }
                                    @endphp

                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($groupedAttributes as $name => $values)
                                            <span class="inline-block text-gray-700 text-xs px-2 py-1 rounded">
                                                {{ $name }}: {{ implode(', ', $values) }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <a href="{{ route('products.edit', $product->slug) }}" >
            <button type="submit" class="mt-4 rounded-md bg-amber-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-amber-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-600">
                Edit Product
            </button>
        </a>
    </div>
</section>

@endsection
