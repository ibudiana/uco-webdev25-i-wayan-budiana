<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-50">
            {{ __('Payment Methods') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-50">
            {{ __("Manage your saved payment methods.") }}
        </p>
    </header>

    {{-- Form untuk tambah metode pembayaran --}}
    <form method="post" action="{{ route('profile.payment-methods.store') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="type" :value="__('Payment Type')" />
            <x-select-input
                id="type"
                name="type"
                :options="[
                    'Credit Card' => 'Credit Card',
                    'Bank Transfer' => 'Bank Transfer',
                    'E-Wallet' => 'E-Wallet',
                ]"
                :value="old('type', 'Credit Card')"
                required
            />
            <x-input-error class="mt-2" :messages="$errors->get('type')" />
        </div>

        <div class="flex items-center gap-2">
            <input id="is_default" name="is_default" type="checkbox" value="1">
            <label for="is_default" class="text-sm text-gray-600">{{ __('Set as default payment info') }}</label>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Add Payment Method') }}</x-primary-button>

            @if (session('status') === 'payment-method-added')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Added.') }}</p>
            @endif
        </div>
    </form>

    {{-- Daftar metode pembayaran --}}
    <div class="mt-8">
        <h3 class="text-md font-semibold text-gray-800 dark:text-gray-100 mb-4">{{ __('Your Payment Methods') }}</h3>

        @forelse ($paymentMethods as $method)
            <div class="mb-4 p-4 border border-gray-200 dark:border-gray-700 rounded-md shadow-sm">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="font-medium text-gray-900 dark:text-gray-50">{{ $method->type }}</p>
                        <p class="text-sm text-gray-600 dark:text-gray-300">{{ $method->details }}</p>
                        @if ($method->is_default)
                            <p class="text-sm text-green-600">{{ __('Default Payment Method') }}</p>
                        @endif
                    </div>
                    <form method="POST" action="{{ route('profile.payment-methods.delete', $method->id) }}">
                        @csrf
                        @method('DELETE')
                        <x-danger-button>{{ __('Delete') }}</x-danger-button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-sm text-gray-600 dark:text-gray-300">{{ __('You have no saved payment methods.') }}</p>
        @endforelse

        @if (session('status') === 'payment-method-deleted')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-red-600 mt-4"
            >{{ __('Payment method deleted.') }}</p>
        @endif
    </div>
</section>
