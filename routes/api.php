<?php

use App\Http\Controllers\Api\AddOrderController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\HomeTecController;
use App\Http\Controllers\Api\IntroController;
use App\Http\Controllers\Api\NotifyController;
use App\Http\Controllers\Api\RateController;
use App\Http\Controllers\Api\TecnicalController;
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


Route::group([
    'middleware'=>['api.password']
],function (){
    Route::get('/images-start',[IntroController::class,'index']);
    Route::post('/signup-tec',[TecnicalController::class,'signUp']);
    Route::post('/signup-client',[ClientController::class,'signUp']);
    Route::post('/send-mail',[TecnicalController::class,'sendMail']);
    Route::post('/login-tec',[TecnicalController::class,'logIn']);
    Route::post('/login-client',[ClientController::class,'logIn']);
    Route::post('/update-password-tec',[TecnicalController::class,'updatePassword']);
    Route::post('/update-password-client',[ClientController::class,'updatePassword']);

    Route::post('/add-rate',[RateController::class,'addRate']);

    Route::get('/get-category',[IntroController::class,'category']);
    Route::post('/get-category-image',[IntroController::class,'categoryImage']);
    Route::post('/get-category-name',[IntroController::class,'categoryName']);
    
    Route::post('/re-email-tec',[TecnicalController::class,'reEmailTec']);
    
    Route::post('/re-email-client',[ClientController::class,'reEmailClient']);
    
    Route::get('/re-adds-tec',[IntroController::class,'reAddsTec']);
    Route::get('/re-adds-client',[IntroController::class,'reAddsClient']);

    Route::group([
        'middleware' => 'api.guard:technical',
    ], function () {
        Route::get('/delete-tec',[TecnicalController::class,'delete']);
        Route::get('/get-data-tec',[TecnicalController::class,'getData']);
        Route::post('/update-profile-tec',[TecnicalController::class,'updateProfile']);
        Route::post('/update-profile-tec-photo',[TecnicalController::class,'updateProfilePhoto']);
        Route::get('/data-home-tec',[HomeTecController::class,'index']);
        Route::get('/get-data-complete-order-{id}',[HomeTecController::class,'getDataOrder']);
        Route::get('/get-online',[HomeTecController::class,'online']);
        Route::get('/check-online',[HomeTecController::class,'checkOnline']);
        //2
        Route::post('/re-tec-one',[AddOrderController::class,'tecOperationOne']);
        //3
        Route::get('/arrive-order-{id}',[AddOrderController::class,'tecOperationTwo']);
        //4
        Route::post('/add-invoice-order',[AddOrderController::class,'tecOperationThree']);
        
        //7
        Route::get('/end-order-{id}',[AddOrderController::class,'tecOperationSiven']);

        Route::get('/get-notify-tec',[NotifyController::class,'getNotifyTec']);
    });
    Route::group([
        'middleware' => 'api.guard:user',
    ], function () {
        Route::get('/delete-client',[ClientController::class,'delete']);
        Route::get('/get-data-client',[ClientController::class,'getData']);
        Route::post('/update-profile-client',[ClientController::class,'updateProfile']);
        Route::post('/update-profile-client-photo',[ClientController::class,'updateProfilePhoto']);
        Route::get('/get-tecnical-{id}',[ClientController::class,'getTecs']);
        Route::get('/data-home-client',[ClientController::class,'index']);
        //1
        Route::post('/add-order',[AddOrderController::class,'addOne']);
        //5
        Route::get('/accept-pay-{id}',[AddOrderController::class,'clientPay']);

        Route::get('/get-notify-client',[NotifyController::class,'getNotifyClient']);
    });
});
