<div x-data class="relative">
    <!-- Trigger Cart -->
    <a href="javascript:void(0)" @click="$store.cart.cartOpen = true" class="text-gray-900 font-medium hover:text-amber-900">
        <i class="fa-solid fa-cart-shopping"></i>
        <span x-text="$store.cart.cart.reduce((total, item) => total + item.qty, 0)"></span>

    </a>

    <!-- Cart Sidebar -->
    <div
        x-show="$store.cart.cartOpen"
        x-cloak
        x-transition:enter="transition ease-in-out duration-300"
        x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in-out duration-300"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        class="fixed right-0 top-0 h-full w-80 bg-gray-50 dark:bg-gray-900 shadow-lg z-50 p-6 overflow-y-auto"
    >
        <!-- Header -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white">Your Cart</h2>
            <button @click="$store.cart.cartOpen = false" class="text-gray-900 dark:text-gray-50">
                <i class="fa-solid fa-xmark text-2xl"></i>
            </button>
        </div>

        <!-- Cart Items -->
        <div class="space-y-4" x-show="$store.cart.cart.length > 0">
            <template x-for="(item, index) in $store.cart.cart" :key="item.id">
                <div class="flex items-center justify-between border-b pb-2">
                    <div>
                        <p class="font-medium" x-text="item.name"></p>
                        <p class="text-sm text-gray-900 dark:text-gray-50">Qty: <span x-text="item.qty"></span></p>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold" x-text="'Rp ' + Number(item.price).toLocaleString('id-ID')"></p>
                        <button @click="$store.cart.removeItem(index)" class="text-xs text-red-600 hover:underline">Remove</button>
                    </div>
                </div>
            </template>
        </div>

        <!-- Empty Cart Message -->
        <div x-show="$store.cart.cart.length === 0" class="text-center text-gray-600 dark:text-gray-300 mt-8">
            <i class="fa-solid fa-cart-shopping text-4xl mb-2"></i>
            <p>Your cart is empty</p>
        </div>

        <!-- Checkout -->
        <div class="mt-6" x-show="$store.cart.cart.length > 0">
            <p class="font-semibold mb-2 text-right text-gray-900 dark:text-white">
                Total: <span x-text="'Rp ' + $store.cart.totalPrice().toLocaleString('id-ID')"></span>
            </p>
            <a href="{{ route('transaction.checkout') }}">
                <button class="w-full rounded-md bg-amber-600 text-gray-900 font-semibold py-2 hover:bg-amber-500">
                    Checkout
                </button>
            </a>
        </div>
    </div>
</div>
