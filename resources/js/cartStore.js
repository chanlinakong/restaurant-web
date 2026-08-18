const cartStore = {

    cart: JSON.parse(localStorage.getItem('cart')) || [],


    addToCart(item) {

        let existing = this.cart.find(
            product => product.id === item.id
        );


        if (existing) {

            existing.qty++;

        } else {

            this.cart.push(item);

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
                total + (item.price * item.qty),
            0
        );

    },

    goToPayment() {

        const checkoutData = {

        order_type: "delivery",

        items: this.cart.map(item => ({
            menu_item_id: item.id,
            quantity: item.qty,
            unit_price: item.price,
            notes: null
        })),

        total: Number((this.subtotal * 1.1).toFixed(2))

    };

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