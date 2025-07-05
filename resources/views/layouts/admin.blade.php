<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: false }" x-init="darkMode = localStorage.getItem('theme') === 'dark'; $watch('darkMode', val => { document.documentElement.classList.toggle('dark', val); localStorage.setItem('theme', val ? 'dark' : 'light'); })" :class="darkMode ? 'dark' : 'light'">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    {{-- <script src="//unpkg.com/alpinejs" defer></script> --}}
    <style>
        [x-cloak] {
          display: none !important;
        }
    </style>

    @yield('meta')
</head>
<body class="bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-50">
    <!-- Navbar Section  -->
    @php
        $menus = [
            ['label' => 'Home', 'url' => '/'],
            ['label' => 'Products', 'url' => '/products']
        ];
    @endphp

    <!-- Page Content -->
    <main
        x-data="{
            isSidebarOpen: window.innerWidth >= 1024,
            toggleSidebar() { this.isSidebarOpen = !this.isSidebarOpen }
        }"
        class="flex min-h-screen"
    >

        <x-navbar.sidebar :menus="$menus" />

        <!-- START: Main Content -->
        <div class="flex-1 flex flex-col transition-all duration-300 ease-in-out" :class="isSidebarOpen ? 'lg:ml-64' : ''">
            <x-navbar.topbar />
            <main class="flex-1 p-4 md:p-6">
                @yield('content')
            </main>
        </div>
        {{-- @if (isset($slot)) {{ $slot }} @endif --}}
    </main>

    <!-- Footer Section -->
    {{-- <x-footer/> --}}
</body>
</html>
