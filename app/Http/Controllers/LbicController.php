<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use Validator;
use JWTAuth;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use App\Models\PasswordReset;
use App\Mail\ResetPasswordEmail;


class LbicController extends Controller
{
    
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




    public function lbicviewAllRegisteredUser(){

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


    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 6000,
            'user' => auth('api')->user()
        ]);
    }





}
