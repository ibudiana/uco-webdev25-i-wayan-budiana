<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-50">
            {{ __('Shipping Addresses') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-50">
            {{ __("Manage your shipping addresses.") }}
        </p>
    </header>

    {{-- Form Add Address --}}
    <form method="POST" action="{{ route('profile.shipping-addresses.store') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="address_line1" :value="__('Address Line 1')" />
            <x-text-input id="address_line1" name="address_line1" type="text" class="mt-1 block w-full" required />
            <x-input-error :messages="$errors->get('address_line1')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="address_line2" :value="__('Address Line 2')" />
            <x-text-input id="address_line2" name="address_line2" type="text" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('address_line2')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="city" :value="__('City')" />
            <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" required />
            <x-input-error :messages="$errors->get('city')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="state" :value="__('State')" />
            <x-text-input id="state" name="state" type="text" class="mt-1 block w-full" required />
            <x-input-error :messages="$errors->get('state')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="postal_code" :value="__('Postal Code')" />
            <x-text-input id="postal_code" name="postal_code" type="text" class="mt-1 block w-full" required />
            <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="country" :value="__('Country')" />
            <x-text-input id="country" name="country" type="text" class="mt-1 block w-full" required />
            <x-input-error :messages="$errors->get('country')" class="mt-2" />
        </div>

        <div class="flex items-center gap-2">
            <input id="is_default" name="is_default" type="checkbox" value="1">
            <label for="is_default" class="text-sm text-gray-600">{{ __('Set as default address') }}</label>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Add Address') }}</x-primary-button>

            @if (session('status') === 'shipping-address-added')
                <p x-data="{ show: true }" x-show="show" x-transition
                   x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm text-green-600">
                    {{ __('Shipping address added.') }}
                </p>
            @endif
        </div>
    </form>

    {{-- List Addresses --}}
    <div class="mt-8">
        @forelse ($shippingAddresses as $address)
            <div class="p-4 border border-gray-200 dark:border-gray-700 rounded-md mb-4">
                <div class="flex justify-between">
                    <div>
                        <p class="font-semibold">{{ $address->name }}</p>
                        <p>{{ $address->address_line1 }} {{ $address->address_line2 }}</p>
                        <p>{{ $address->city }}, {{ $address->state }} {{ $address->postal_code }}</p>
                        <p>{{ $address->country }}</p>
                        @if ($address->is_default)
                            <p class="text-sm text-green-600">{{ __('Default Address') }}</p>
                        @endif
                    </div>
                    <form method="POST" action="{{ route('profile.shipping-addresses.delete', $address->id) }}">
                        @csrf
                        @method('DELETE')
                        <x-danger-button>{{ __('Delete') }}</x-danger-button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-sm text-gray-500">{{ __('No shipping addresses saved.') }}</p>
        @endforelse

        @if (session('status') === 'shipping-address-deleted')
            <p x-data="{ show: true }" x-show="show" x-transition
               x-init="setTimeout(() => show = false, 2000)"
               class="text-sm text-red-600">
                {{ __('Shipping address deleted.') }}
            </p>
        @endif
    </div>
</section>
