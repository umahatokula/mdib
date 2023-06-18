$(document).on("click", `.btn-clear-cart`, (e) => {
    $.request("Cart::onClear", {
        update: { "cart/mini-cart/mini-cart": ".mini-cart-wrapper" },
        success: () => {
            $(".mini-cart-wrapper").html("Cart is empty");
            $(".cart-table").html("Cart is empty");
        },
    });
});
