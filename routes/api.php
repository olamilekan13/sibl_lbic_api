<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LbicController;
use App\Http\Controllers\SiblController;


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



//route for lbic admin only
Route::group(['middleware' => 'lbic_auth'], function () {
    Route::group(['prefix' => 'auth'], function () {
       

Route::post('libcviewAllRegisteredUser', [LbicController::class, 'libcviewAllRegisteredUser']);













});
});





//route for sibl admin only
Route::group(['middleware' => 'sibl_auth'], function () {
    Route::group(['prefix' => 'auth'], function () {
       

Route::post('siblViewAllRegisteredUser', [SiblController::class, 'siblViewAllRegisteredUser']);
Route::post('createCoverPlan', [SiblController::class, 'createCoverPlan']);














});
});

