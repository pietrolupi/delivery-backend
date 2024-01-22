<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Braintree\Gateway;

class PaymentController extends Controller
{
    protected $braintree;

    public function __construct(Gateway $braintree){

        $this->braintree = $braintree;
    }

    public function token(){

        $clientToken = $this->braintree->clientToken()->generate();

        return response()->json(['token' => $clientToken]);
    }

    public function checkout(Request $request){

        $nonce = $request->payment_method_nonce;
        $amount = $request->amount;

        $result = $this->braintree->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => ['submitForSettlement' => true]
        ]);

        if ($result->success) {

            return response()->json(['success' => true, 'transaction' => $result->transaction]);
        } else {

            return response()->json(['success' => false, 'error' => $result->message]);
        }
    }

    }

