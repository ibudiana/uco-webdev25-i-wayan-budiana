@extends('layouts.app')

@section('title', 'Product Details - ' . $product['name'])

@section('content')
@php
    $image = $product->images->isNotEmpty()
        ? asset('storage/upload/products/' . optional($product->images->firstWhere('is_primary', 1))->url)
        : asset('assets/images/no-images.jpeg');
@endphp

<section class="py-12">
    <div class="container mx-auto max-w-6xl grid grid-cols-1 md:grid-cols-2 gap-8" x-data="{ showShare: false, productUrl: window.location.href }">

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

            <!-- Share Button -->
            <button @click="showShare = !showShare" class="mt-10 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
            <i class="fas fa-share-alt mr-2"></i> Share
            </button>

            <div x-show="showShare" x-transition class="mt-4 space-y-2">
                <p class="text-sm text-gray-600">Share to:</p>
                <div class="flex justify-center gap-4">
                    <!-- WhatsApp -->
                    <a
                    :href="`https://api.whatsapp.com/send?text=${encodeURIComponent(productUrl)}`"
                    target="_blank"
                    class="text-green-500 hover:text-green-600"
                    title="Share ke WhatsApp"
                    >
                    <i class="fab fa-whatsapp w-6 h-6"></i>
                    </a>

                    <!-- Facebook -->
                    <a
                    :href="`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(productUrl)}`"
                    target="_blank"
                    class="text-blue-600 hover:text-blue-700"
                    title="Share ke Facebook"
                    >
                    <i class="fab fa-facebook w-6 h-6"></i>
                    </a>

                    <!-- Twitter -->
                    <a
                    :href="`https://twitter.com/intent/tweet?url=${encodeURIComponent(productUrl)}&text=Produk%20menarik%20ini!`"
                    target="_blank"
                    class="text-blue-400 hover:text-blue-500"
                    title="Share ke Twitter"
                    >
                    <i class="fab fa-twitter w-6 h-6"></i>
                    </a>
                </div>
            </div>

            {{-- Rating --}}
            <div class="mt-10 max-w-xl mx-auto bg-white p-6 rounded shadow" x-data="reviewComponent({{ $product->id }})">
                <h2 class="text-xl font-bold mb-4">Tulis Ulasan untuk Produk</h2>

                <!-- Rating Bintang -->
                <div class="flex items-center space-x-1 mb-4">
                <template x-for="star in 5">
                    <svg
                    @click="rating = star"
                    @mouseover="hover = star"
                    @mouseleave="hover = 0"
                    :class="{
                        'text-yellow-400': star <= (hover || rating),
                        'text-gray-300': star > (hover || rating)
                    }"
                    class="w-8 h-8 cursor-pointer transition"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    >
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.177c.969 0 1.371 1.24.588 1.81l-3.38 2.455a1 1 0 00-.364 1.118l1.286 3.966c.3.921-.755 1.688-1.538 1.118l-3.38-2.455a1 1 0 00-1.175 0l-3.38 2.455c-.783.57-1.838-.197-1.538-1.118l1.286-3.966a1 1 0 00-.364-1.118L2.05 9.394c-.783-.57-.38-1.81.588-1.81h4.177a1 1 0 00.95-.69l1.286-3.967z" />
                    </svg>
                </template>
                </div>

                <!-- Form Ulasan -->
                <textarea x-model="comment" placeholder="Tulis ulasan Anda..." rows="4"
                class="w-full p-3 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400 mb-4"></textarea>

                <button @click="submitReview"
                class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition">
                Kirim Ulasan
                </button>

                <!-- Notifikasi -->
                <p x-show="message" x-text="message" class="mt-4 text-blue-600"></p>
            </div>

            <h2 class="mt-5 text-2xl font-bold mb-4">Ulasan Pembeli</h2>

            @forelse ($product->reviews as $review)
                <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
                    <div class="flex items-center gap-2">
                        <strong>{{ $review->user->name ?? $review->guest_name ?? 'Guest' }}</strong>
                        <span class="text-yellow-500">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $review->rating)
                                    ★
                                @else
                                    ☆
                                @endif
                            @endfor
                        </span>
                    </div>
                    <p class="text-sm text-gray-700 mt-1">{{ $review->comment }}</p>
                    <p class="text-xs text-gray-400">{{ $review->created_at->diffForHumans() }}</p>
                </div>
            @empty
                <p class="text-gray-500">Belum ada ulasan untuk produk ini.</p>
            @endforelse
        </div>

    </div>
</section>

<script>
    function reviewComponent(productId) {
      return {
        productId: productId,
        rating: 0,
        hover: 0,
        comment: '',
        message: '',

        async submitReview() {
          if (this.rating === 0 || this.comment.trim() === '') {
            this.message = 'Mohon beri rating dan komentar.';
            return;
          }

          try {
            const res = await fetch('/products/review', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
              },
              body: JSON.stringify({
                product_id: this.productId,
                rating: this.rating,
                comment: this.comment
              })
            });

            if (!res.ok) {
                if (res.status === 401) {
                    this.message = 'Anda harus login terlebih dahulu.';
                } else {
                    this.message = 'Gagal mengirim data. Coba lagi.';
                }
                return;
            }

            const data = await res.json();

            if (data.success) {
              this.message = 'Terima kasih atas ulasannya!';
              this.comment = '';
              this.rating = 0;
            } else {
              this.message = 'Gagal mengirim ulasan.';
            }

          } catch (error) {
            console.error(error);
            this.message = 'Terjadi kesalahan.';
          }
        }
      }
    }
  </script>
@endsection
