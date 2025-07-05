<!-- START: Header -->
<header class="flex items-center justify-between h-16 px-4 md:px-6 bg-white dark:bg-gray-900 ">
    <!-- Tombol Toggle Sidebar -->
    <button @click="toggleSidebar" class="text-gray-500 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded-md">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
    </button>

    <!-- Menu Pengguna -->
    <div class="flex space-x-2 sm:items-center sm:ms-6">
    {{-- Avatar dari UI-Avatars.com --}}
        <img class="h-8 w-8 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=a0a0a0&color=fff&bold=true" alt="{{ Auth::user()->name }}">
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
        {{-- light / dark mode --}}
        <button @click="darkMode = !darkMode" class="text-gray-900 dark:text-gray-50 mr-2">
            <template x-if="darkMode">
                <i class="fa-solid fa-moon"></i>
            </template>
            <template x-if="!darkMode">
                <i class="fa-solid fa-sun"></i>
            </template>
        </button>

        <x-icon-button icon="fa-solid fa-shop" route="home"/>
    </div>
</header>
<!-- END: Header -->
