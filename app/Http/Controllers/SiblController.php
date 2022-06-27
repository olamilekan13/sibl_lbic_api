<?php

namespace App\Http\Controllers;
use Hash;
use Session;
use Validator;
use JWTAuth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\coverPlan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use App\Models\PasswordReset;
use App\Mail\ResetPasswordEmail;

class SiblController extends Controller
{
    // login for sibl admin


    public function login(Request $request){
        try
        {
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required|string|min:6',
            ]);

            // if ($validator->fails()) {
            //     return response()->json($validator->errors(), 422);
            // }

            if (! $token = auth('api')->attempt(['email' => $request->email, 'password' => $request->password])) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            return $this->createNewToken($token);
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



    // view all registered allotees

    
    public function siblviewAllRegisteredUser(){

        try{


         $allotees = User::get();
        
         return response()->json(['allotees'=>$allotees],200);
        // $allotee->address ;
    
        } catch (\Exception $e) {
            return response()->json([
                "error" => $e->getMessage()
            ], 500);
        }

    }



    // For admin to set cover plan

    public function createCoverPlan(Request $request)
{
  $request->validate([
    'cover_type' => 'required|max:255',
    'cover_flat' => 'required',
    'cover_price' => 'required'
  ]);

  $coverplan = new coverPlan([
    'cover_type' => $request->get('cover_type'),
    'cover_flat' => $request->get('cover_flat'),
    'cover_price' => $request->get('cover_price'),
  ]);

  $coverplan->save();

  return response()->json($coverplan);
}





}



