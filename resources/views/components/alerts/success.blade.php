<x-modal name="success-alert" show="{{ session()->has('success') }}">
    @if ($message = session('success'))
        <div
            x-init="setTimeout(() => show = false, 3000)"
            class="relative p-5 sm:p-6 bg-green-50 border border-green-200 rounded-lg shadow-md text-green-800"
        >

            <!-- Success Icon -->
            <div class="flex items-center mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-green-600" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M5 13l4 4L19 7"/>
                </svg>
                <h3 class="text-md font-semibold">Success</h3>
            </div>

            <!-- Message Content -->
            <p class="text-sm">
                {{ $message }}
            </p>
        </div>
    @endif
</x-modal>
