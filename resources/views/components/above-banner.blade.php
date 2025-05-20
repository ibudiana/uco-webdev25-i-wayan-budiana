<div x-data="{ showBanner: true }" x-show="showBanner" x-transition
     class="relative isolate flex items-center gap-x-6 overflow-hidden bg-gray-50 dark:bg-gray-900 px-6 py-2.5 sm:px-3.5 sm:before:flex-1">

    <!-- Background Gradient Left -->
    <div class="absolute top-1/2 left-[max(-7rem,calc(50%-52rem))] -z-10 -translate-y-1/2 transform-gpu blur-2xl" aria-hidden="true">
        <div class="aspect-577/310 w-144.25 bg-gradient-to-r from-[#ff80b5] to-[#9089fc] opacity-30"
             style="clip-path: polygon(74.8% 41.9%, 97.2% 73.2%, 100% 34.9%, 92.5% 0.4%, 87.5% 0%, 75% 28.6%, 58.5% 54.6%, 50.1% 56.8%, 46.9% 44%, 48.3% 17.4%, 24.7% 53.9%, 0% 27.9%, 11.9% 74.2%, 24.9% 54.1%, 68.6% 100%, 74.8% 41.9%)">
        </div>
    </div>

    <!-- Background Gradient Right -->
    <div class="absolute top-1/2 left-[max(45rem,calc(50%+8rem))] -z-10 -translate-y-1/2 transform-gpu blur-2xl" aria-hidden="true">
        <div class="aspect-577/310 w-144.25 bg-gradient-to-r from-[#ff80b5] to-[#9089fc] opacity-30"
             style="clip-path: polygon(74.8% 41.9%, 97.2% 73.2%, 100% 34.9%, 92.5% 0.4%, 87.5% 0%, 75% 28.6%, 58.5% 54.6%, 50.1% 56.8%, 46.9% 44%, 48.3% 17.4%, 24.7% 53.9%, 0% 27.9%, 11.9% 74.2%, 24.9% 54.1%, 68.6% 100%, 74.8% 41.9%)">
        </div>
    </div>

    <!-- Promo Text & Button -->
    <div class="flex flex-wrap items-center gap-x-4 gap-y-2">
        <p class="text-sm/6 text-gray-900 dark:text-gray-50">
            <strong class="font-semibold">New Year Promo</strong>
            <svg viewBox="0 0 2 2" class="mx-2 inline size-0.5 fill-current" aria-hidden="true">
                <circle cx="1" cy="1" r="1" />
            </svg>
            Clearance Sale - Diskon s/d 70%.
        </p>
        <a href="#" class="flex-none rounded-full bg-gray-900 dark:bg-gray-50 px-3.5 py-1 text-sm font-semibold text-gray-50 dark:text-gray-900 shadow-xs hover:bg-gray-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-900">
            Register now <span aria-hidden="true">&rarr;</span>
        </a>
    </div>

    <!-- Close Button -->
    <div class="flex flex-1 justify-end">
        <button @click="showBanner = false" type="button" class="-m-3 p-3 focus-visible:-outline-offset-4">
            <span class="sr-only">Dismiss</span>
            <svg class="size-5 text-gray-900 dark:text-gray-50" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z" />
            </svg>
        </button>
    </div>
</div>
