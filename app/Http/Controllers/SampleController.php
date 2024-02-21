<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\PaymentService;
use App\Services\SimpleService;
use Illuminate\Http\Request;

class SampleController extends Controller
{
    //1//
    // public function index(Request $request, SimpleService $simpleService){
    //     $simpleService->log('this is a test log');
    //     return $request->all(00);
    // }

    //2//
    // private $simpleService;
    // public function __construct(SimpleService $simpleService)
    // {
    //     $this->simpleService = $simpleService;
    // }

    // public function index(Request $request)
    // {
    //     $this->simpleService->log('this is a test log');
    //     return $request->all();
    // }

    //3//
    // private $simpleService;
    // public function __construct(SimpleService $simpleService)
    // {
    //     $this->simpleService = $simpleService;
    // }

    // public function index(Request $request)
    // {
    //     $this->simpleService->log('this is a test log');
    //     $this->anotherMethod();
    //     return $request->all();
    // }
    // public function anotherMethod()
    // {
    //     $this->simpleService->log('this is a another test log');
    // }

    //4//
    // public function index(Request $request)
    // {
    //     $payment = new PaymentService;
    //     dd($payment->process());
    // }

    //5//
    // public function index(Request $request, PaymentService $paymentService)
    // {
    //     dd($paymentService->process());
    // }

    //6//
    // public function index()
    // {
    //     dd(app());
    // }

    //7//
    public function index(PaymentService $paymentService)
    {
        //dd($paymentService);
        dd(app());
    }


}
