{{-- Navbar Section  --}}
<header x-data="{navbarOpen: false}" class="w-full dark:bg-gray-100 shadow">
    <div class="container mx-auto">
        <div class="relative flex items-center justify-between">
            <div class="w-60 max-w-full px-4 ml-8 lg:ml-0">
                <a href="#" class="flex items-center text-2xl font-bold text-amber-900 w-full py-5 space-x-2">
                    <x-application-logo class="w-10 h-10 fill-current text-gray-500" />
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
                    @guest
                    <x-icon-button />
                    @endguest
                    @auth
                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ Auth::user()->name }}</div>

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
