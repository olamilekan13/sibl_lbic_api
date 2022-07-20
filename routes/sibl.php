<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Sibl\SiblController;



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

//route for sibl admin only
Route::group(['middleware' => 'sibl_auth'], function () {
        Route::group(['prefix' => 'auth'], function () {
        Route::get('siblViewAllRegisteredUser', [SiblController::class, 'siblViewAllRegisteredUser']);
        Route::post('createCoverPlan', [SiblController::class, 'createCoverPlan']);
});
});

