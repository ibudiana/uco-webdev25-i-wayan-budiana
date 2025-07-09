{{-- Navbar Section  --}}
<header x-data="{navbarOpen: false}" class="dark:bg-gray-100 shadow">
    <div class="container mx-auto">
        <div class="relative flex items-center justify-between mx-auto px-4 sm:static sm:px-6 lg:px-8">
            <div class="flex-shrink-0">
                <a href="/" class="flex items-center text-2xl font-bold text-amber-900 py-4 space-x-2">
                    <x-application-logo class="hidden sm:block w-10 h-10 fill-current" />
                    <span class="hidden sm:block">IBUDIANA</span>
                </a>
            </div>

            <div class="flex w-full items-center justify-between">
                {{-- Menu links --}}
                <div class="relative py-10 z-50 sm:py-0 lg:z-0">
                    {{-- Toggle Button for Mobile --}}
                    <button @click="navbarOpen = !navbarOpen" :class="navbarOpen && 'navbarTogglerActive'" id="navbarToggler" class="absolute left-4 top-1/2 block -translate-y-1/2 rounded-lg lg:hidden">
                        <span class="my-[6px] block h-[2px] w-[30px] bg-gray-600"></span>
                        <span class="my-[6px] block h-[2px] w-[30px] bg-gray-600"></span>
                        <span class="my-[6px] block h-[2px] w-[30px] bg-gray-600"></span>
                    </button>

                    <nav x-transition :class="!navbarOpen && 'hidden'" id="navbarCollapse" class="fixed left-0 mt-9 lg:mt-0 w-full z-50 bg-gray-50 px-6 py-5 shadow transition-all lg:static lg:block lg:w-full lg:max-w-full lg:bg-transparent lg:shadow-none xl:ml-11 dark:bg-dark-2">
                        <ul class="flex flex-col space-y-4 lg:flex-row lg:space-y-0 lg:space-x-6">
                            @foreach ($menus as $menu)
                                <li>
                                    <a href="{{ $menu['url'] }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                        {{ $menu['label'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </nav>

                </div>

                {{-- Icons Button Links --}}
                <div class="flex items-center space-x-4 mr-2">
                    @guest
                    {{-- <x-icon-button /> --}}
                    <a href="{{ route('login') }}" class="sm:inline-block text-sm font-medium text-gray-700 hover:text-amber-900 dark:hover:text-amber-400">Login</a>
                    <a href="{{ route('register') }}" class="sm:inline-block bg-amber-800 hover:bg-amber-900 text-white text-sm font-bold py-2 px-4 rounded-lg transition-colors">
                        Register
                    </a>
                    @endguest

                    @auth
                    <div class="flex sm:items-center sm:ms-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-2 py-1 border border-transparent text-sm leading-4 font-medium rounded-full text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white focus:outline-none transition ease-in-out duration-150">

                                    {{-- Avatar dari UI-Avatars.com --}}
                                    <img class="h-8 w-8 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=a0a0a0&color=fff&bold=true" alt="{{ Auth::user()->name }}">

                                    {{-- Nama User --}}
                                    <div class="ms-2 hidden sm:block">{{ Auth::user()->name }}</div>

                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('transaction.index')">
                                    {{ __('Orders') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                    @endauth

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
