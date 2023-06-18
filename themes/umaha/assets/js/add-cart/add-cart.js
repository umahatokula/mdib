new class ButtonAddToCart {
    constructor() {
        //Init selectors
        this.btnAddToCart = "btn-add-to-cart";
        console.log(this.btnAddToCart);
        //Add events
        this.eventHandlers();
    }

    eventHandlers() {
        $(document).on("click", `.${this.btnAddToCart}`, (e) => {
            const button = $(e.currentTarget),
                form = button.parents("form");

            this.addOfferToCart(form, button);
        });
    }

    addOfferToCart(form, button) {
        const cartData = [
            {
                offer_id: form
                    .find('input[name="offer_id"]')
                    .val(),
                quantity: form
                    .find('input[name="quantity"]')
                    .val(),
            },
        ];

        $.request("Cart::onAdd", {
            data: { cart: cartData },
            update: {
                "cart/mini-cart/mini-cart": ".mini-cart-wrapper",
            },
        });
    }
}();

