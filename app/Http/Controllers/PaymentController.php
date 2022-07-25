<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CoverPlan;
use App\Models\UserCoverPlan;
use App\Models\Transactions;

class PaymentController extends Controller
{


    public function subscribeCoverPlan(){
         
        try
        {
            $this->validate($request, [
                'cover_id' => 'required',
                'reference' => 'required',
            ]);
            $user = Auth::user();
             
            $checkcover = CoverPlan::where('id', $request->cover_id)->first();
            if(!$checkcover)
            {
                return response()->json([
                'error' => 'Invalid cover plan'
                ], 422);
            }

            $verifypayment = $this->verifyPaystackPayment($request->reference);

            dd($verifypayment);


        } catch (ValidationException $e) {
            return response()->json([
                "error" => $e->validator->errors()->first()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                "error" => $e->getMessage()
            ], 500);
        }

}

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

// $this->verifyPaystackPayment($request->payment_reference);
