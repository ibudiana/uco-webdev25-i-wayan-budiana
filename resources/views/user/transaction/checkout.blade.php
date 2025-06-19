@extends('layouts.app')

@section('content')
<div class="container my-10">
    <div class="p-4 sm:p-8 bg-gray-50 dark:bg-gray-900 shadow sm:rounded-lg" x-show="!$store.cart.loading">
        <div x-show="$store.cart.cart.length > 0">
            <form action="{{ route('transaction.process') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="cart_data" id="cart_data" :value="JSON.stringify($store.cart.cart)">

                <div class="flex flex-col md:flex-row gap-8">
                    <!-- LEFT COLUMN: ORDER SUMMARY -->
                    <div class="md:w-1/2 space-y-6">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-50">
                                {{ __('Order Summary') }}
                            </h2>
                        </header>

                        <div class="space-y-4">
                            <template x-for="(item, index) in $store.cart.cart" :key="item.id">
                                <div class="flex items-center justify-between border-b pb-2">
                                    <div>
                                        <p class="font-medium" x-text="item.name"></p>
                                        <p class="text-sm text-gray-900 dark:text-gray-50">
                                            Qty: <span x-text="item.qty"></span>
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-semibold" x-text="'Rp ' + Number(item.price).toLocaleString('id-ID')"></p>
                                        <button @click="$store.cart.removeItem(index)" class="text-xs text-red-600 hover:underline">Remove</button>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <p class="font-semibold text-right text-gray-900 dark:text-white">
                            Total: <span x-text="'Rp ' + $store.cart.totalPrice().toLocaleString('id-ID')"></span>
                        </p>
                    </div>

                    <div class="w-px bg-gray-300"></div>

                    <!-- RIGHT COLUMN: SHIPPING AND PAYMENT -->
                    <div class="md:w-1/2 space-y-6">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-50">
                                {{ __('Shipping Address') }}
                            </h2>
                        </header>

                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="phone" :value="__('Phone')" />
                            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" maxlength="20" required />
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="address_line1" :value="__('Address Line 1')" />
                            <x-text-input id="address_line1" name="address_line1" type="text" class="mt-1 block w-full" maxlength="255" required />
                            <x-input-error :messages="$errors->get('address_line1')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="address_line2" :value="__('Address Line 2')" />
                            <x-text-input id="address_line2" name="address_line2" type="text" class="mt-1 block w-full" />
                            <x-input-error :messages="$errors->get('address_line2')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="city" :value="__('City')" />
                            <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" maxlength="100" required />
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="state" :value="__('State')" />
                            <x-text-input id="state" name="state" type="text" class="mt-1 block w-full" maxlength="100" required />
                            <x-input-error :messages="$errors->get('state')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="postal_code" :value="__('Postal Code')" />
                            <x-text-input id="postal_code" name="postal_code" type="text" class="mt-1 block w-full" maxlength="20" required />
                            <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="country" :value="__('Country')" />
                            <x-text-input id="country" name="country" type="text" class="mt-1 block w-full" maxlength="100" required />
                            <x-input-error :messages="$errors->get('country')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="payment_method" :value="__('Payment Method')" />
                            <x-select-input
                                id="payment_method"
                                name="payment_method"
                                :options="$paymentMethods"
                                :value="old('payment_method', 1)"
                                required
                            />
                            <x-input-error class="mt-2" :messages="$errors->get('payment_method')" />
                        </div>

                        <div class="flex justify-end">
                            <x-primary-button>{{ __('Continue to payment') }}</x-primary-button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="max-w-xl" x-show="$store.cart.cart.length === 0">
            <p class="text-gray-500">Your cart is empty.</p>
        </div>
    </div>
</div>
@endsection
