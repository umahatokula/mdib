<?php
namespace Paystack\Helpers;

use \Closure;
use \Paystack\Contracts\RouteInterface;
use \Paystack\Http\RequestBuilder;

class Caller
{
    private $paystackObj;

    public function __construct($paystackObj)
    {
        $this->paystackObj = $paystackObj;
    }

    public function callEndpoint($interface, $payload = [ ], $sentargs = [ ])
    {
        $builder = new RequestBuilder($this->paystackObj, $interface, $payload, $sentargs);
        return $builder->build()->send()->wrapUp();
    }
}
