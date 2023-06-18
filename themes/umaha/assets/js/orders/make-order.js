
new class MakeOrder {
    constructor() {
        //Init selectors
        this.checkOutButton = "checkOutButton";
        console.log(this.checkOutButton);
        //Add events
        this.eventHandlers();
    }

    eventHandlers() {
        $(document).on("click", `.${this.checkOutButton}`, (e) => {
            const button = $(e.currentTarget),
                form = button.parents("form");

            this.makeOrder(form, button);
        });
    }

    makeOrder(form, button) {

        const shipping_type_id = $( "input[type=radio][name=shipping_type_id]:checked" ).val()

        let data = {
            'order': {
                'payment_method_id': 1,
                'shipping_type_id': shipping_type_id,
                'shipping_price': $( `#shipping-price-${shipping_type_id}` ).val(),
                'property': {
                    'address': form
                    .find('input[name="address"]')
                    .val(),
                }
            },
            'user': {
                'email': form
                    .find('input[name="email"]')
                    .val(),
                'name': form
                    .find('input[name="name"]')
                    .val(),
                'phone': form
                    .find('input[name="phone"]')
                    .val(),
            },
            'shipping_address': {
                'id': $( "input[type=radio][name=shipping_address_id]:checked" ).val()  //Address data of user with ID == 10 will be save in order
            },
            'billing_address': {
                //New billing address will be created for user.
                'country': '',
                'address1': '',
                'address2': ''
            }
        };


        console.log(data)

        $.request('MakeOrder::onCreate', {
            'data': data,
            success: function(obResponse) {
                console.log(obResponse)
                if (!obResponse) {
                    return;
                }

                if (!!obResponse['X_OCTOBER_REDIRECT']) {
                    return this.success(obResponse);  
                }

                if (!obResponse.status) {
                    //Show message with error
                    toastr["error"](obResponse.message);

                    toastr.options = {
                        closeButton: false,
                        debug: false,
                        newestOnTop: false,
                        progressBar: false,
                        positionClass: "toast-bottom-right",
                        preventDuplicates: false,
                        onclick: null,
                        showDuration: "300",
                        hideDuration: "1000",
                        timeOut: "5000",
                        extendedTimeOut: "1000",
                        showEasing: "swing",
                        hideEasing: "linear",
                        showMethod: "fadeIn",
                        hideMethod: "fadeOut",
                    };
                    return;
                }

                //Show "Success message"
                return this.success(obResponse);
            }
        });
    }
}();
