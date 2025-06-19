@extends('layouts.app')

@section('content')
<div class="container py-12">
    @if (session('status'))
        <div class="mb-6 p-4 rounded-md bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
            {{ session('status') }}
        </div>
    @endif

    <div class="max-w-xl mx-auto bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md text-center">
        <!-- Icon success -->
        <div class="flex justify-center mb-4">
            <svg class="w-16 h-16 text-green-500" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 12l2 2l4 -4M12 22C6.48 22 2 17.52 2 12S6.48 2 12 2s10 4.48 10 10s-4.48 10-10 10z" />
            </svg>
        </div>

        <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
            Thank you for your order!
        </h2>
        <p class="text-gray-700 dark:text-gray-300">
            Your payment has been successfully processed. We will process and ship your order shortly.
        </p>

        <div class="mt-6">
            <a href="{{ route('home') }}" class="inline-block px-6 py-2 bg-blue-600 text-white font-medium rounded hover:bg-blue-700 transition">
                Bact to home
            </a>
        </div>
    </div>
</div>

<script>
    // Hapus cart dari localStorage
    localStorage.removeItem('cart');

    // Reset Alpine.js cart store jika ada
    if (window.Alpine && Alpine.store('cart')) {
        Alpine.store('cart').cart = [];
        Alpine.store('cart').save();
    }
</script>
@endsection
