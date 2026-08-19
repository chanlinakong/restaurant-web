const cartStore = {
    cart: JSON.parse(localStorage.getItem('cart')) || [],

    addToCart(item) {
        let existing = this.cart.find(
            product => product.id === item.id
        );

        if (existing) {
            existing.qty++;
        } else {
            this.cart.push({
                ...item,
                qty: item.qty || 1
            });
        }

        this.save();
    },

    increaseQty(id) {
        let item = this.cart.find(
            item => item.id === id
        );

        if (item) {
            item.qty++;
        }

        this.save();
    },

    decreaseQty(id) {
        let item = this.cart.find(
            item => item.id === id
        );

        if (item) {
            if (item.qty > 1) {
                item.qty--;
            } else {
                this.cart = this.cart.filter(
                    product => product.id !== id
                );
            }
        }

        this.save();
    },

    get totalItems() {
        return this.cart.reduce(
            (total, item) => total + item.qty,
            0
        );
    },

    get subtotal() {
        return this.cart.reduce(
            (total, item) =>
                total + (Number(item.price) * item.qty),
            0
        );
    },

    goToPayment(addressId) {
        if (!addressId) {
            alert('Please select a delivery address.');
            return;
        }

        if (!this.cart.length) {
            alert('Your cart is empty.');
            return;
        }

        const checkoutData = {
            order_type: "delivery",
            table_number: null,
            payment_method: "stripe",

            // IMPORTANT
            address_id: Number(addressId),

            items: this.cart.map(item => ({
                menu_item_id: item.id,
                quantity: item.qty,
                unit_price: Number(item.price),
                notes: null
            })),

            total: Number(this.subtotal.toFixed(2))
        };

        // Store the COMPLETE checkout object
        sessionStorage.setItem(
            'checkout_cart',
            JSON.stringify(checkoutData)
        );

        window.location.href = '/payment';
    },

    save() {
        localStorage.setItem(
            'cart',
            JSON.stringify(this.cart)
        );
    }
};

export default cartStore;