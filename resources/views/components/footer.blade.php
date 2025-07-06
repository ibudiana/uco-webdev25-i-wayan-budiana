<footer class="mt-24 py-7 bg-gray-100 text-gray-700 text-sm">
  <div class="container mx-auto py-10 px-6">
    <!-- Top Banner Section -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 border-b pb-8">
      <div class="flex items-start gap-4">
        <div class="text-red-500 text-3xl">
          <i class="fas fa-shipping-fast"></i>
        </div>
        <div>
          <h3 class="font-bold uppercase text-sm">International Shipment</h3>
          <p>Orders are shipped seamlessly between countries</p>
        </div>
      </div>
      <div class="flex items-start gap-4">
        <div class="text-red-500 text-3xl">
          <i class="fas fa-headset"></i>
        </div>
        <div>
          <h3 class="font-bold uppercase text-sm">Online Support 24/7</h3>
          <p>Orders are shipped seamlessly between countries</p>
        </div>
      </div>
      <div class="flex items-start gap-4">
        <div class="text-red-500 text-3xl">
          <i class="fas fa-sync-alt"></i>
        </div>
        <div>
          <h3 class="font-bold uppercase text-sm">Money Return</h3>
          <p>Orders are shipped seamlessly between countries</p>
        </div>
      </div>
      <div class="flex items-start gap-4">
        <div class="text-red-500 text-3xl">
          <i class="fas fa-tags"></i>
        </div>
        <div>
          <h3 class="font-bold uppercase text-sm">Member Discount</h3>
          <p>Orders are shipped seamlessly between countries</p>
        </div>
      </div>
    </div>

    <!-- Middle Content -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-8 mt-10 text-sm">
      <!-- Logo and Contact -->
      <div class="space-y-4">
        <h2 class="text-2xl font-bold text-black">IBUDIANA<span class="text-red-500">.</span></h2>
        <p>Solid is the information & experience directed at an end-user</p>
        <p><strong>Mon - Fri:</strong> 9:00-20:00</p>
        <p><strong>Call:</strong> 0020 500 · CALL · 000</p>
        <p><strong>Email:</strong> info@webmail.com</p>
        <div class="flex gap-4 mt-2">
          <a href="#" class="text-black"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="text-black"><i class="fab fa-youtube"></i></a>
          <a href="#" class="text-black"><i class="fab fa-twitter"></i></a>
          <a href="#" class="text-black"><i class="fab fa-linkedin-in"></i></a>
        </div>
      </div>

      <!-- About -->
      <div>
        <h3 class="font-bold mb-3">ABOUT US</h3>
        <p>
          Elegant pink origami design three type of dimensional view and decoration co Great for adding a decorative touch to any room’s decor.
        </p>
      </div>

      <!-- Info -->
      <div>
        <h3 class="font-bold mb-3">INFORMATION</h3>
        <ul class="space-y-2">
          <li><a href="#">About</a></li>
          <li><a href="#">FAQ’s</a></li>
          <li><a href="#">Wishlist</a></li>
          <li><a href="#">Cart</a></li>
          <li><a href="#">Checkout</a></li>
        </ul>
      </div>

      <!-- My Account -->
      <div>
        <h3 class="font-bold mb-3">MY ACCOUNT</h3>
        <ul class="space-y-2">
          <li><a href="#">Wishlist</a></li>
          <li><a href="#">Cart</a></li>
          <li><a href="#">Checkout</a></li>
          <li><a href="#">My Account</a></li>
          <li><a href="#">Shop</a></li>
        </ul>
      </div>

      <!-- Newsletter -->
      <div>
        <h3 class="font-bold mb-3">GET NEWSLETTER</h3>
        <p>Get 10% off your first order! Hurry up</p>
        <div class="mt-3">
            <form action="{{ route('subscribers.store') }}" method="POST">
                @csrf
                <input type="email" name="email" placeholder="Enter email address"
                    class="w-full px-4 py-2 border rounded-md mb-2" />
                <button class="bg-red-500 text-white px-4 py-2 rounded-md w-full">Subscribe Now</button>
                <x-alerts.custom />
            </form>
        </div>
      </div>
    </div>

    <!-- App Download and Payments -->
    <div class="mt-10 flex flex-col md:flex-row justify-between items-center border-t pt-6">
      <div class="mb-4 md:mb-0">
        <strong>Order faster with our App!</strong>
        <div class="flex gap-3 mt-2">
          <a href="#" class="flex items-center">
            <i class="fab fa-apple text-gray-500 text-2xl"></i>
          </a>
          <a href="#" class="flex items-center">
            <i class="fab fa-google-play text-gray-500 text-2xl"></i>
          </a>
        </div>
      </div>
      <div class="flex gap-6 text-2xl text-gray-500">
        <i class="fab fa-cc-amazon-pay"></i>
        <i class="fab fa-cc-paypal"></i>
        <i class="fas fa-wallet"></i>
        <i class="fas fa-truck"></i>
      </div>
    </div>
  </div>

  <!-- Bottom Line -->
  <div class="bg-gray-200 py-4 text-center text-xs text-gray-600">
    Copyright & Design By <strong>I Wayan Budiana</strong> - {{ date('Y') }}. All rights reserved.
  </div>
</footer>


<script>
    function imagePreview() {
        return {
            imageUrl: null,
            fileChosen(event) {
                const file = event.target.files[0];
                if (!file) return;

                const reader = new FileReader();
                reader.onload = e => {
                    this.imageUrl = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
    }

    function setCookie(name, value, days) {
        const expires = new Date(Date.now() + days * 864e5).toUTCString()
        document.cookie = name + '=' + encodeURIComponent(value) + '; expires=' + expires + '; path=/'
    }

    function getCookie(name) {
        return document.cookie.split('; ').reduce((r, v) => {
            const parts = v.split('=')
            return parts[0] === name ? decodeURIComponent(parts[1]) : r
        }, '')
    }

    // document.addEventListener('alpine:init', () => {
    //     Alpine.store('cart', {
    //         cartOpen: false,
    //         cart: JSON.parse(localStorage.getItem('cart') || '[]'),

    //         addItem(item) {
    //             const existing = this.cart.find(i => i.id === item.id);
    //             if (existing) {
    //                 existing.qty += item.qty ?? 1;
    //             } else {
    //                 this.cart.push({ ...item, qty: item.qty ?? 1 });
    //             }
    //             this.save();
    //         },

    //         removeItem(index) {
    //             this.cart.splice(index, 1);
    //             this.save();
    //         },

    //         totalPrice() {
    //             return this.cart.reduce((total, item) => total + item.price * item.qty, 0);
    //         },

    //         save() {
    //             localStorage.setItem('cart', JSON.stringify(this.cart));
    //         }
    //     });
    // });

    document.addEventListener('alpine:init', () => {
        Alpine.store('cart', {
            cartOpen: false,
            cart: [],
            loading: true,

            async init() {

                if (window.isLoggedIn) {
                    await this.fetchFromServer();
                } else {
                    this.cart = JSON.parse(localStorage.getItem('cart') || '[]');
                }

                this.loading = false;
            },

            async fetchFromServer() {
                try {
                    const response = await fetch('/cart/fetch');
                    const data = await response.json();
                    this.cart = data;
                } catch (error) {
                    console.error('Failed to fetch cart:', error);
                }
            },

            addItem(item) {
                const existing = this.cart.find(i => i.id === item.id);
                if (existing) {
                    existing.qty += item.qty ?? 1;
                } else {
                    this.cart.push({ ...item, qty: item.qty ?? 1 });
                }

                window.isLoggedIn ? this.saveToServer() : this.save();
            },

            increaseQty(index) {
                this.cart[index].qty++;
                window.isLoggedIn ? this.saveToServer() : this.save();
            },

            decreaseQty(index) {
                if (this.cart[index].qty > 1) {
                    this.cart[index].qty--;
                    window.isLoggedIn ? this.saveToServer() : this.save();
                }
            },

            removeItem(index) {
                this.cart.splice(index, 1);
                window.isLoggedIn ? this.saveToServer() : this.save();
            },

            totalPrice() {
                return this.cart.reduce((total, item) => total + item.price * item.qty, 0);
            },

            save() {
                localStorage.setItem('cart', JSON.stringify(this.cart));
            },

            async saveToServer() {
                try {
                    await fetch('/cart/store', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ cart: this.cart })
                    });
                } catch (error) {
                    console.error('Failed to save cart to server:', error);
                }
            }
        });
    });


    function openAddCategoryModal() {
        document.getElementById('addCategoryModal').classList.remove('hidden');
        }

    function closeAddCategoryModal() {
        document.getElementById('addCategoryModal').classList.add('hidden');
    }

    window.isLoggedIn = @json(Auth::check());
</script>

@if (auth()->check())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Alpine.store('cart').init();

            const tokenMeta = document.querySelector('meta[name="csrf-token"]');

            if (!tokenMeta) {
                console.error('CSRF token meta tag not found');
                return;
            }

            const csrfToken = tokenMeta.content;

            const cart = JSON.parse(localStorage.getItem('cart') || '[]');

            if (cart.length > 0) {
                fetch('/cart/store', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ cart })
                })
                .then(res => res.json())
                .then(data => {
                    console.log('Cart synced:', data.message);
                    localStorage.removeItem('cart');
                    if (window.Alpine) Alpine.store('cart').cart = [];
                });
            }
        });
    </script>
@endif

