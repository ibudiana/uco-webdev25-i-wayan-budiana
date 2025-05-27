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

    document.addEventListener('alpine:init', () => {
        Alpine.store('cart', {
            cartOpen: false,
            cart: JSON.parse(localStorage.getItem('cart') || '[]'),

            addItem(item) {
                const existing = this.cart.find(i => i.id === item.id);
                if (existing) {
                    existing.qty += item.qty ?? 1;
                } else {
                    this.cart.push({ ...item, qty: item.qty ?? 1 });
                }
                this.save();
            },

            removeItem(index) {
                this.cart.splice(index, 1);
                this.save();
            },

            totalPrice() {
                return this.cart.reduce((total, item) => total + item.price * item.qty, 0);
            },

            save() {
                localStorage.setItem('cart', JSON.stringify(this.cart));
            }
        });
    });
</script>
