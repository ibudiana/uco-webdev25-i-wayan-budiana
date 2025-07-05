<!-- START: Sidebar -->
<aside
    class="fixed inset-y-0 left-0 z-30 w-64 flex-shrink-0 overflow-y-auto bg-gray-800 dark:bg-gray-900 text-white transition-transform duration-300 ease-in-out"
    :class="isSidebarOpen ? 'translate-x-0' : '-translate-x-full'"
>
    <!-- Logo/Header Sidebar -->
    <div class="flex items-center justify-center h-16 px-4 bg-gray-900">
        <svg class="w-8 h-8 mr-2 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
        <span class="text-xl font-semibold">Admin Panel</span>
    </div>

    <!-- Menu Navigasi -->
    <nav class="py-4 px-2">
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            <i class="fas fa-tachometer-alt text-xl pr-4"></i>
            {{ __('Dashboard') }}
        </x-nav-link>

        @if (Auth::user()->hasRole('admin'))
            <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">
                <i class="fab fa-product-hunt text-xl pr-4"></i>
                {{ __('Products') }}
            </x-nav-link>

            <x-nav-link :href="route('blogs.index')" :active="request()->routeIs('blogs.*')">
                <i class="fas fa-blog text-xl pr-4"></i>
                {{ __('Posts') }}
            </x-nav-link>
        @endif

        <x-nav-link :href="route('transaction.index')" :active="request()->routeIs('transaction.*')">
            <i class="fas fa-shopping-cart text-xl pr-4"></i>
            {{ __('Orders') }}
        </x-nav-link>

    </nav>
</aside>
<!-- END: Sidebar -->

<!-- Backdrop untuk mobile, muncul saat sidebar terbuka -->
<div
    x-show="isSidebarOpen"
    @click="isSidebarOpen = false"
    class="fixed inset-0 z-20 bg-black bg-opacity-50 lg:hidden"
    x-transition:enter="transition-opacity ease-linear duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity ease-linear duration-300"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
></div>
