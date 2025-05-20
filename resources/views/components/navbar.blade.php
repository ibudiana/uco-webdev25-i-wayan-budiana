<x-above-banner />
{{-- Navbar Section  --}}
<header x-data="{navbarOpen: false}" class="w-full dark:bg-gray-100 shadow">
    <div class="container mx-auto">
        <div class="relative flex items-center justify-between">
            <div class="w-60 max-w-full px-4 ml-8 lg:ml-0">
                <a href="#" class="flex items-center text-2xl font-bold text-amber-900 w-full py-5 space-x-2">
                    <i class="fas fa-star"></i>
                    <span>IBUDIANA</span>
                </a>
            </div>

            <div class="flex w-full items-center justify-between">
                {{-- Menu links --}}
                <div>
                    <button @click="navbarOpen = !navbarOpen" :class="navbarOpen && 'navbarTogglerActive'" id="navbarToggler" class="absolute left-4 top-1/2 block -translate-y-1/2 rounded-lg lg:hidden">
                        <span class="relative my-[6px] block h-[2px] w-[30px] bg-gray-600"></span>
                        <span class="relative my-[6px] block h-[2px] w-[30px] bg-gray-600"></span>
                        <span class="relative my-[6px] block h-[2px] w-[30px] bg-gray-600"></span>
                    </button>

                    <nav x-transition :class="!navbarOpen && 'hidden'" id="navbarCollapse" class="absolute right-4 top-full w-full bg-gray-50 px-6 py-5 shadow transition-all lg:static lg:block lg:w-full lg:max-w-full lg:bg-transparent lg:shadow-none xl:ml-11 dark:bg-dark-2">
                        <ul class="flex flex-col space-y-4 lg:flex-row lg:space-y-0 lg:space-x-6">
                            @foreach ($menus as $menu)
                                <li>
                                    <a href="{{ $menu['url'] }}" class="text-gray-600 font-medium text-dark hover:text-amber-900 lg:ml-10 lg:inline-flex">
                                        {{ $menu['label'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </nav>

                </div>

                {{-- Icons Button --}}
                <div class="flex items-center space-x-4 mr-2">
                    {{-- Cart --}}
                    {{-- Search --}}
                    <a href="#" class="font-medium text-gray-900 hover:text-amber-900">
                        <i class="fa-solid fa-user"></i>
                    </a>
                    <x-cart-sidebar />

                    {{-- light / dark mode --}}
                    <button @click="darkMode = !darkMode" class="text-gray-900">
                        <template x-if="darkMode">
                            <i class="fa-solid fa-moon"></i>
                        </template>
                        <template x-if="!darkMode">
                            <i class="fa-solid fa-sun"></i>
                        </template>
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>
