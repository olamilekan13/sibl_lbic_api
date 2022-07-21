<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //

    protected function verifyPaystackPayment($reference)
    {
        $result = array();
        //The parameter after verify/ is the transaction reference to be verified
        $url = 'https://api.paystack.co/transaction/verify/' . $reference;
        $request = Http::withToken(config('app.paystackkey'))->get($url);
        // dd($request);
        if ($request) {
            $result = json_decode($request, true);
            Log::info($reference);
            Log::info($result);
            if ($result) {
                if ($result['status'] && $result['data']) {
                    if ($result['data']['status'] == 'success') {
                        return [true, [
                            'transaction_details' => $result['data']
                        ]];
                    }
                }
            }
        }
        return [false];
    }

}

$this->verifyPaystackPayment($request->payment_reference);
