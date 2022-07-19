<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Allotee\AuthController;

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

Route::group(['middleware' => 'user_auth'], function () {
    Route::group(['prefix' => 'auth'], function () {
Route::get('show/{id}', [AuthController::class, 'show']);
Route::post('getCover', [AuthController::class, 'getCover']); 







      
});
});
