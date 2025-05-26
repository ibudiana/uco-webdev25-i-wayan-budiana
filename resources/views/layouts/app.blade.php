<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: false }" x-init="darkMode = localStorage.getItem('theme') === 'dark'; $watch('darkMode', val => { document.documentElement.classList.toggle('dark', val); localStorage.setItem('theme', val ? 'dark' : 'light'); })" :class="darkMode ? 'dark' : 'light'">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    {{-- <script src="//unpkg.com/alpinejs" defer></script> --}}
    <style>
        [x-cloak] {
          display: none !important;
        }
    </style>

    <title>@yield('title', 'ibudiana shop')</title>
</head>
<body class="bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-50">

    <x-banner.above-header />

    <!-- Navbar Section  -->
    @php
        $menus = [
            ['label' => 'Home', 'url' => '/'],
            ['label' => 'Products', 'url' => '/products']
        ];
    @endphp

    <x-navbar.app :menus="$menus" />

    <!-- Page Content -->
    <main class="container mx-auto">
        @yield('content')
    </main>

    <!-- Footer Section -->
    <x-footer/>
</body>
</html>
