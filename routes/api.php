<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login','LoginController@login')->name('login'); 
Route::post('verify_email','VerificationController@verify')->name('verify_email');
Route::post('verify_code','VerificationController@verifyCode')->name('verify_code');

Route::middleware(['authUser'])->group(function(){
    Route::post('logout','LoginController@logout')->name('logout');
    Route::middleware(['admin'])->group(function(){
        Route::post('send-link','UserController@sendlink');
        Route::apiResources([
        'users' => UserController::class,
        ]);

    });
   
    Route::apiResources([
        'profile' => ProfileController::class,
        
    ]);

});
