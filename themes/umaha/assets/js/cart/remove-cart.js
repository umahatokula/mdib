new class RemoveOfferFromCart {
    constructor() {
        this.eventHandlers();
    }

    eventHandlers() {
        $(document).on("click", `a.remove-cart-item`, (e) => {

            const offerID = e.target.parentNode.id
            const rowid = `offer-row-${offerID}`

            // this.deleteRow(rowid);
            this.removeOffer(offerID);
        });

    }

    removeOffer(offerID) {

        const cartItems = [];
        cartItems.push(offerID)

        //Prepare array with offers ID
		let data = {
		  'cart': cartItems
		};

        // console.log(data)

		//Send ajax request and update cart items
		$.request('Cart::onRemove', {
		  'data': data,
		  'update': {'cart/mini-cart/mini-cart': '.mini-cart-wrapper'},
		  'redirect' : '/cart'
		});
	}

    deleteRow(rowid) {
	    var row = document.getElementById(rowid);
	    row.parentNode.removeChild(row);

        const selector = '#cartTable tr';
        this.deleteTable(selector);
	}

	deleteTable(selector) {
	    var rowCount = $(selector).length;
	    console.log(selector, rowCount)

	    if (rowCount == 0) {
	    	var elem = document.querySelector('#cartTable');
			elem.parentNode.removeChild(elem);
	    }
	}

}();
