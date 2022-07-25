<?php

namespace App\Http\Controllers\Allotee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function getCover(){

        try {
            $user = Auth::user();
            $plan= coverPlan::where('user_id', $user->id)->get();
            return response()->json(['plan'=>$plan],200);
            
        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => $e->getMessage()
            ],500);
        }
    }
}
