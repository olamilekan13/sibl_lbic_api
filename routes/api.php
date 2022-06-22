<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LbicController;

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
//route for lbic admin only
Route::group(['middleware' => 'lbic_auth'], function () {
    Route::group(['prefix' => 'auth'], function () {
       

Route::post('viewAllRegisteredUser', [LbicController::class, 'viewAllRegisteredUser']);













});
});

