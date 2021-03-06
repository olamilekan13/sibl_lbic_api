<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Lbic\LbicController;
use App\Http\Controllers\Sibl\SiblController;
use App\Http\Controllers\Allotee\AuthController;
use App\Http\Controllers\PaymentController;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route::post('auth/register', [AuthController::class, 'register']);

Route::post('auth/login', [LbicController::class, 'login']);
Route::post('auth/login', [SiblController::class, 'login']);
Route::post('auth/logins', [AuthController::class, 'login']);
Route::post('auth/register', [AuthController::class, 'register']);

Route::post('auth/subscribeCoverPlan', [PaymentController::class, 'subscribeCoverPlan']);


