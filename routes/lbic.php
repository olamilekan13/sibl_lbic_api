<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Lbic\LbicController;



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


//route for lbic admin only
Route::group(['middleware' => 'lbic_auth'], function () {

    Route::group(['prefix' => 'auth'], function () {
        Route::post('lbicviewAllRegisteredUser', [LbicController::class, 'lbicviewAllRegisteredUser']);
    });

});




