{{-- Wrapper Modal --}}
<div
    x-show="open"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    @click.self="open = false"
    @keydown.escape.window="open = false"
    class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-900 bg-opacity-50"
    style="display: none;"
>
    {{-- Jendela Modal --}}
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-90"
        x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-90"
        class="w-full max-w-md p-6 bg-white dark:bg-gray-800 rounded-lg shadow-xl"
    >
        <h3 class="text-lg font-bold text-gray-900 dark:text-white">
            Payment Confirmation
        </h3>

        <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
            Are you sure you want to confirm the payment? Please upload the proof of payment.
        </p>

        {{-- Ganti 'action' dengan route yang sesuai --}}
        <form action="{{ route('transaction.confirm') }}" method="POST" class="mt-4" enctype="multipart/form-data">
            @csrf
            <div>
                <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">
                <label for="image" class="sr-only">Upload Image</label>
                <input type="file" name="image" id="image" accept="image/*" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" required>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">PNG, JPG, GIF up to 2MB.</p>
                @error('image')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Grup Tombol Aksi --}}
            <div class="flex justify-end mt-6 space-x-3">
                <button type="button" @click="open = false" class="px-4 py-2 text-sm font-semibold text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 text-sm font-semibold text-white bg-green-600 rounded-md hover:bg-green-700 focus:outline-none">
                    Yes, Confirm
                </button>
            </div>
        </form>
    </div>
</div>
