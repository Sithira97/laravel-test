<?php

namespace App\Services;

class PaymentService
{
    //4//
    // public function process()
    // {
    //     return 'payment';
    // }

    //5//
    public $gateway;
    public function __construct(PaymentGateway $paymentGateway)
    {
        $this->gateway = $paymentGateway;
    }

    public function process()
    {
        return $this->gateway->execute();
    }
}