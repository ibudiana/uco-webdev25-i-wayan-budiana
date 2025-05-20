@props(['product'])

@php
  $image    = $product->images->isNotEmpty()  ? asset('storage/upload/products/' . $product->images[0]->url) : asset('assets/images/no-images.jpeg');
  $url      = route('products.show', $product->slug);
  $price    = 'Rp. ' . ($product->formatted_price ?? number_format($product->price, 2));
  $title    = $product->name;
  $desc     = $product->description;
@endphp

<div class="relative rounded-lg overflow-hidden bg-white shadow-sm hover:shadow-lg text-gray-700 dark:bg-gray-900 dark:text-gray-200">
    {{-- Gambar Produk --}}
    <div class="aspect-[4/3] overflow-hidden">
        <img src="{{ $image }}" alt="product" class="h-full w-full object-cover transition-transform duration-300 hover:scale-105">
    </div>

    {{-- Konten --}}
    <div class="p-6 pb-16">
        <h3 class="mb-2 text-lg font-semibold leading-tight hover:text-amber-600 transition-colors">
            <a href="{{ $url }}">
                {{ $title }}
            </a>
        </h3>

        <p class="mb-2 text-sm font-medium text-amber-700 dark:text-amber-300">
            {{ $price }}
        </p>

        <p class="mb-4 text-sm text-gray-600 line-clamp-3 dark:text-gray-400">
            {{ $desc }}
        </p>

        <div class="flex flex-wrap gap-2 text-xs font-semibold text-gray-500 dark:text-gray-400">
            <span><i class="fa-solid fa-tag mr-1"></i>{{ $product->category->name }}</span>
        </div>
    </div>

    {{-- Tombol Read More --}}
    <button
    @click="$store.cart.addItem({ id: {{ $product->id }}, name: '{{ $product->name }}', price: {{ $product->price}}, qty: 1 })" class="absolute bottom-4 right-4 text-amber-600 hover:text-amber-800 transition-colors">
        <i class="fa-solid fa-shopping-cart text-lg"></i>
    </button>
</div>


