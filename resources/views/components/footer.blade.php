<footer class="mt-10  bottom-0 left-0 w-full bg-white dark:bg-gray-900 shadow">
    <div class="container mx-auto py-7">
        <p class="text-center font-medium text-gray-900 dark:text-gray-50">
            © 2025 ibudiana. All Rights Reserved.
        </p>
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

