@extends('layouts.app')

{{-- Meta Section --}}
@section('title', 'Home')

{{-- Home Content --}}
@section('content')
<div class="mt-10 relative overflow-hidden ">
  <div class="pt-16 pb-80 sm:pt-24 sm:pb-40 lg:pt-40 lg:pb-48">
    <div class="relative mx-auto max-w-7xl px-4 sm:static sm:px-6 lg:px-8">
      <div class="sm:max-w-lg">
        <h1 class="text-4xl font-bold tracking-tight text-gray-900 dark:text-gray-50 sm:text-6xl">Summer styles are finally here</h1>
        <p class="mt-4 text-xl text-gray-500 dark:text-gray-400">This year, our new summer collection will shelter you from the harsh elements of a world that doesn't care if you live or die.</p>
      </div>
      <div>
        <div class="mt-10">
          <!-- Decorative image grid -->
          <div aria-hidden="true" class="pointer-events-none lg:absolute lg:inset-y-0 lg:mx-auto lg:w-full lg:max-w-7xl">
            <div class="absolute transform sm:top-0 sm:left-1/2 sm:translate-x-8 lg:top-1/2 lg:left-1/2 lg:translate-x-8 lg:-translate-y-1/2">
              <div class="flex items-center space-x-6 lg:space-x-8">
                <div class="grid shrink-0 grid-cols-1 gap-y-6 lg:gap-y-8">
                  <div class="h-64 w-44 overflow-hidden rounded-lg sm:opacity-0 lg:opacity-100">
                    <img src="https://tailwindcss.com/plus-assets/img/ecommerce-images/home-page-03-hero-image-tile-01.jpg" alt="" class="size-full object-cover">
                  </div>
                  <div class="h-64 w-44 overflow-hidden rounded-lg">
                    <img src="https://tailwindcss.com/plus-assets/img/ecommerce-images/home-page-03-hero-image-tile-02.jpg" alt="" class="size-full object-cover">
                  </div>
                </div>
                <div class="grid shrink-0 grid-cols-1 gap-y-6 lg:gap-y-8">
                  <div class="h-64 w-44 overflow-hidden rounded-lg">
                    <img src="https://tailwindcss.com/plus-assets/img/ecommerce-images/home-page-03-hero-image-tile-03.jpg" alt="" class="size-full object-cover">
                  </div>
                  <div class="h-64 w-44 overflow-hidden rounded-lg">
                    <img src="https://tailwindcss.com/plus-assets/img/ecommerce-images/home-page-03-hero-image-tile-04.jpg" alt="" class="size-full object-cover">
                  </div>
                  <div class="h-64 w-44 overflow-hidden rounded-lg">
                    <img src="https://tailwindcss.com/plus-assets/img/ecommerce-images/home-page-03-hero-image-tile-05.jpg" alt="" class="size-full object-cover">
                  </div>
                </div>
                <div class="grid shrink-0 grid-cols-1 gap-y-6 lg:gap-y-8">
                  <div class="h-64 w-44 overflow-hidden rounded-lg">
                    <img src="https://tailwindcss.com/plus-assets/img/ecommerce-images/home-page-03-hero-image-tile-06.jpg" alt="" class="size-full object-cover">
                  </div>
                  <div class="h-64 w-44 overflow-hidden rounded-lg">
                    <img src="https://tailwindcss.com/plus-assets/img/ecommerce-images/home-page-03-hero-image-tile-07.jpg" alt="" class="size-full object-cover">
                  </div>
                </div>
              </div>
            </div>
          </div>

          <a href="{{ route('products.index') }}" class="inline-block rounded-md border border-transparent bg-amber-500 px-8 py-3 text-center font-medium text-gray-700 hover:bg-amber-600">Shop Collection</a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="mt-10 mx-auto max-w-7xl grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-5 gap-6">
    @forelse ($products as $product)
        <x-products.card :product="$product" />
    @empty
    @endforelse
</div>

<div class="mt-10 mx-auto max-w-7xl">
    <h2 class="text-3xl font-bold text-center">Pertanyaan yang Sering Diajukan (FAQ)</h2>

    <div class="mt-10 space-y-4">

      <!-- FAQ Item -->
      <div x-data="{ open: false }" class="bg-white shadow rounded-lg p-4">
        <button @click="open = !open" class="w-full text-left flex justify-between items-center">
          <span class="font-semibold">1. Bagaimana cara memesan produk?</span>
          <svg :class="{'rotate-180': open}" class="w-5 h-5 transform transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
          </svg>
        </button>
        <div x-show="open" x-transition class="mt-2 text-gray-600">
          Pilih produk yang Anda inginkan, klik tombol "Beli Sekarang", lalu ikuti instruksi untuk menyelesaikan pesanan dan pembayaran.
        </div>
      </div>

      <!-- FAQ Item -->
      <div x-data="{ open: false }" class="bg-white shadow rounded-lg p-4">
        <button @click="open = !open" class="w-full text-left flex justify-between items-center">
          <span class="font-semibold">2. Apa metode pembayaran yang tersedia?</span>
          <svg :class="{'rotate-180': open}" class="w-5 h-5 transform transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
          </svg>
        </button>
        <div x-show="open" x-transition class="mt-2 text-gray-600">
          Kami menerima pembayaran melalui transfer bank, e-wallet (OVO, Dana, GoPay), dan kartu kredit.
        </div>
      </div>

      <!-- FAQ Item -->
      <div x-data="{ open: false }" class="bg-white shadow rounded-lg p-4">
        <button @click="open = !open" class="w-full text-left flex justify-between items-center">
          <span class="font-semibold">3. Berapa lama waktu pengiriman?</span>
          <svg :class="{'rotate-180': open}" class="w-5 h-5 transform transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
          </svg>
        </button>
        <div x-show="open" x-transition class="mt-2 text-gray-600">
          Pengiriman biasanya memakan waktu 2–5 hari kerja tergantung lokasi Anda. Kami akan mengirimkan nomor resi setelah pesanan dikirim.
        </div>
      </div>

      <!-- FAQ Item -->
      <div x-data="{ open: false }" class="bg-white shadow rounded-lg p-4">
        <button @click="open = !open" class="w-full text-left flex justify-between items-center">
          <span class="font-semibold">4. Apakah bisa melakukan retur atau pengembalian barang?</span>
          <svg :class="{'rotate-180': open}" class="w-5 h-5 transform transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
          </svg>
        </button>
        <div x-show="open" x-transition class="mt-2 text-gray-600">
          Ya, retur dapat dilakukan maksimal 7 hari setelah barang diterima, dengan syarat barang masih dalam kondisi seperti saat diterima.
        </div>
      </div>

      <!-- FAQ Item -->
      <div x-data="{ open: false }" class="bg-white shadow rounded-lg p-4">
        <button @click="open = !open" class="w-full text-left flex justify-between items-center">
          <span class="font-semibold">5. Bagaimana jika barang yang diterima rusak?</span>
          <svg :class="{'rotate-180': open}" class="w-5 h-5 transform transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
          </svg>
        </button>
        <div x-show="open" x-transition class="mt-2 text-gray-600">
          Silakan hubungi customer service kami dengan foto bukti kerusakan. Kami akan membantu Anda melakukan penggantian.
        </div>
      </div>

    </div>

</div>

<div class="mt-10 mx-auto max-w-7xl">
    <h2 class="text-3xl font-bold text-center">Featured Articles</h2>
    <div class="mt-10 mx-auto max-w-7xl grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-5 gap-6">
        @foreach($posts as $post)
            <div class="bg-white dark:bg-gray-700 rounded-lg shadow-md overflow-hidden flex flex-col">
                    @if($post->image)
                    <img src="{{-- {{ asset('storage/' . $post->image) }} --}}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                @endif
                <div class="p-6 flex flex-col flex-grow">
                    <h2 class="text-xl font-bold mb-2"><a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a></h2>
                    <p class="text-gray-600 dark:text-gray-400 mb-4 text-sm">By {{ $post->author->name }} on {{ $post->created_at->format('M d, Y') }}</p>
                    <div class="prose dark:prose-invert max-w-none text-gray-700 dark:text-gray-300 flex-grow">
                        {{ Str::limit($post->content, 100) }}
                    </div>
                    <a href="{{ route('blog.show', $post->slug) }}" class="text-blue-500 hover:text-blue-700 font-semibold mt-4 inline-block self-start">Read More &rarr;</a>
                </div>
            </div>
        @endforeach
    </div>
</div>


@endsection
{{-- End Home Content --}}
