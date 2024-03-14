<?php

use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\MainDisplayController;
use App\Http\Controllers\API\V1\PersonalRoutesController;
use App\Http\Controllers\API\V1\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix'=>'mainDisplay'],function (){
    Route::post('/sendOffer',[MainDisplayController::class,'sendOffer']);
    Route::get('/getRoutes',[MainDisplayController::class,'getRoutes']);
    Route::get('/filter',[MainDisplayController::class,'filterRoutes']);
});
Route::group(['prefix'=>'profile',],function (){
    Route::get('/show',[ProfileController::class,'show']);
    Route::put('/update',[ProfileController::class,'update']);
    Route::post('/offer/reply',[ProfileController::class,'replyOffer']);
});

Route::group(['prefix'=>'personalRoutes',],function (){
    Route::get('/getAllById/{users_id}',[PersonalRoutesController::class,'getMyRoutes']);
    Route::post('/add',[PersonalRoutesController::class,'addRoute']);
});

Route::group(['prefix'=>'reg',],function (){
    Route::post('/sendCode',[AuthController::class,'sendSMS']);
    Route::post('/verifyCode',[AuthController::class,'verifyCode']);
    Route::post('/checkToken',[AuthController::class,'checkToken']);
    Route::post('/logout',[AuthController::class,'logout']);
});

