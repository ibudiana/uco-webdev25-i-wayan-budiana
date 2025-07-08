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
                                        <p class="text-sm text-gray-900 dark:text-gray-50 flex items-center gap-2">
                                            Qty:
                                            <button type="button" @click="$store.cart.decreaseQty(index)" class="w-5 h-5 bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-50 rounded-full">-</button>
                                            <span x-text="item.qty"></span>
                                            <button type="button" @click="$store.cart.increaseQty(index)" class="w-5 h-5 bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-50 rounded-full">+</button>
                                        </p>
                                        <p x-show="item.qty == item.stock" style="color: red; font-weight: bold;">
                                            Warning: this is the maximum quantity available!
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

                        {{-- Select Shipping Address --}}
                        <div x-data="{ useNewAddress: @json(!$shippingAddresses || $shippingAddresses->count() == 0) }" class="space-y-4">
                            @if ($shippingAddresses && $shippingAddresses->count() > 0)
                            <div>
                                <x-input-label for="shipping_address_id" :value="__('Choose Shipping Address')" />
                                <select
                                    name="shipping_address_id"
                                    id="shipping_address_id"
                                    class="mt-1 block w-full"
                                    x-on:change="useNewAddress = ($event.target.value == 'new')"
                                >
                                    @foreach ($shippingAddresses as $shippingAddress)
                                        <option value="{{ $shippingAddress->id }}" {{ old('shipping_address_id') == $shippingAddress->id ? 'selected' : '' }}>
                                            {{ $shippingAddress->name }} - {{ $shippingAddress->address_line1 }}, {{ $shippingAddress->city }}
                                        </option>
                                    @endforeach

                                    <option value="new">{{ __('+ Use a new address') }}</option>

                                </select>
                            </div>

                            @else
                                <input type="hidden" name="shipping_address_id" value="new">
                                <p class="text-gray-500">{{ __('No saved addresses found. Please input a new one.') }}</p>
                                <script>document.addEventListener("alpine:init", () => Alpine.store('address', { useNewAddress: true }))</script>
                            @endif

                            {{-- New Address Form --}}
                            <div x-show="useNewAddress" x-cloak class="space-y-4">
                                <div>
                                    <x-input-label for="name" :value="__('Name')" />
                                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="phone" :value="__('Phone')" />
                                    <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" />
                                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="address_line1" :value="__('Address Line 1')" />
                                    <x-text-input id="address_line1" name="address_line1" type="text" class="mt-1 block w-full" />
                                    <x-input-error :messages="$errors->get('address_line1')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="address_line2" :value="__('Address Line 2')" />
                                    <x-text-input id="address_line2" name="address_line2" type="text" class="mt-1 block w-full" />
                                    <x-input-error :messages="$errors->get('address_line2')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="city" :value="__('City')" />
                                    <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" />
                                    <x-input-error :messages="$errors->get('city')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="state" :value="__('State')" />
                                    <x-text-input id="state" name="state" type="text" class="mt-1 block w-full" />
                                    <x-input-error :messages="$errors->get('state')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="postal_code" :value="__('Postal Code')" />
                                    <x-text-input id="postal_code" name="postal_code" type="text" class="mt-1 block w-full" />
                                    <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="country" :value="__('Country')" />
                                    <x-text-input id="country" name="country" type="text" class="mt-1 block w-full" />
                                    <x-input-error :messages="$errors->get('country')" class="mt-2" />
                                </div>
                            </div>
                        </div>



                        {{-- Payment Methode --}}
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
