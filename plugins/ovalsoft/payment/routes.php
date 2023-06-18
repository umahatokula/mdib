<?php

use Illuminate\Http\Request;
use Ovalsoft\Payment\Models\Payment;

Route::post('payment/save', function(Request $request) {
	$payment            = new Payment;
	$payment->name      = $request->name;
	$payment->email     = $request->email;
	$payment->phone     = $request->phone;
	$payment->amount    = $request->amount;
	$payment->category  = $request->category;
	$payment->reference = $request->reference;
	$payment->save();

    Flash::success('Transaction successful');
	return $payment;
});


Route::post('/payment/webhook', function (Request $request) {

	$user = Auth::getUser();

	$string = '{
    "event": "charge.success",
    "data": {
        "id": 615919407,
        "domain": "test",
        "status": "success",
        "reference": "T062463367529096",
        "amount": 2000000,
        "message": null,
        "gateway_response": "Successful",
        "paid_at": "2020-04-11T10:04:33.000Z",
        "created_at": "2020-04-11T10:04:27.000Z",
        "channel": "card",
        "currency": "NGN",
        "ip_address": "105.112.123.97",
        "metadata": {
            "custom_fields": [
                {
                    "display_name": "Mobile Number",
                    "variable_name": "mobile_number",
                    "value": "+2348012345678"
                }
            ],
            "referrer": "http://7ca79475.ngrok.io/entre/sign-up/silver-membership"
        },
        "log": {
            "start_time": 1586599467,
            "time_spent": 7,
            "attempts": 1,
            "errors": 0,
            "success": true,
            "mobile": false,
            "input": [],
            "history": [
                {
                    "type": "action",
                    "message": "Attempted to pay with card",
                    "time": 6
                },
                {
                    "type": "success",
                    "message": "Successfully paid with card",
                    "time": 7
                }
            ]
        },
        "fees": 40000,
        "fees_split": null,
        "authorization": {
            "authorization_code": "AUTH_af5vk0o8rk",
            "bin": "408408",
            "last4": "4081",
            "exp_month": "12",
            "exp_year": "2020",
            "channel": "card",
            "card_type": "visa DEBIT",
            "bank": "Test Bank",
            "country_code": "NG",
            "brand": "visa",
            "reusable": true,
            "signature": "SIG_w64GvZBkmY14ltvtTouQ",
            "account_name": null,
            "receiver_bank_account_number": null,
            "receiver_bank": null
        },
        "customer": {
            "id": 23076399,
            "first_name": "",
            "last_name": "",
            "email": "tasyp@mailinator.com",
            "customer_code": "CUS_erhowjtxbqkxpi2",
            "phone": "+1 (368) 352-7823",
            "metadata": {},
            "risk_action": "default"
        },
        "plan": {},
        "subaccount": {},
        "order_id": null,
        "paidAt": "2020-04-11T10:04:33.000Z",
        "requested_amount": 2000000
    }
}';
	$response = json_decode($request);
  
	Event::fire('ovalsoft.payment.success', [$user, $response]);

});