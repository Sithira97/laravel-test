<?php

namespace App\Services;

class PaymentGateway
{
    //1//
    // public function execute()
    // {
    //     return "payment gateway";
    // }

    //2//
    public $apiKey;
    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }
    public function execute()
    {
        return "payment gateway";
    }
}