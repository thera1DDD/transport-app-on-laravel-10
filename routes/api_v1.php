<?php

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
    Route::post('/sendOffer',[\App\Http\Controllers\API\V1\MainDisplayController::class,'sendOffer']);
    Route::get('/getRoutes',[\App\Http\Controllers\API\V1\MainDisplayController::class,'getRoutes']);
    Route::get('/filter',[\App\Http\Controllers\API\V1\MainDisplayController::class,'filterRoutes']);
});
Route::group(['prefix'=>'profile',],function (){
    Route::get('/show',[\App\Http\Controllers\API\V1\ProfileController::class,'show']);
    Route::put('/update',[\App\Http\Controllers\API\V1\ProfileController::class,'update']);
});

Route::group(['prefix'=>'personalRoutes',],function (){
    Route::get('/getAllById/{users_id}',[\App\Http\Controllers\API\V1\PersonalRoutesController::class,'getMyRoutes']);
    Route::post('/add',[\App\Http\Controllers\API\V1\PersonalRoutesController::class,'addRoute']);
});

