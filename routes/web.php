<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/',[\App\Http\Controllers\Admin\HomeController::class,'index'])->name('home.index');
    Route::get('/chart',[\App\Http\Controllers\Admin\HomeController::class,'routesChart'])->name('home.index');


    Route::group(['prefix'=>'routes',],function (){
        Route::get('/',[\App\Http\Controllers\Admin\RoutingController::class,'index'])->name('routing.index');
        Route::delete('{routing}',[\App\Http\Controllers\Admin\RoutingController::class,'destroy'])->name('routing.delete');
        Route::get('/create', [\App\Http\Controllers\Admin\RoutingController::class, 'create'])->name('routing.create');
        Route::post('/store', [\App\Http\Controllers\Admin\RoutingController::class, 'store'])->name('routing.store');
        Route::get('/{routing}/edit',[\App\Http\Controllers\Admin\RoutingController::class, 'edit'])->name('routing.edit');
        Route::put('{routing}',[\App\Http\Controllers\Admin\RoutingController::class, 'update'])->name('routing.update');
    });

    Route::group(['prefix'=>'offers',],function (){
        Route::get('/',[\App\Http\Controllers\Admin\OfferController::class,'index'])->name('offer.index');
        Route::delete('{offer}',[\App\Http\Controllers\Admin\OfferController::class,'destroy'])->name('offer.delete');
        Route::get('/create', [\App\Http\Controllers\Admin\OfferController::class, 'create'])->name('offer.create');
        Route::post('/store', [\App\Http\Controllers\Admin\OfferController::class, 'store'])->name('offer.store');
        Route::get('/{offer}/edit',[\App\Http\Controllers\Admin\OfferController::class, 'edit'])->name('offer.edit');
        Route::put('{offer}',[\App\Http\Controllers\Admin\OfferController::class, 'update'])->name('offer.update');
    });

    Route::group(['prefix'=>'profile',],function (){
        Route::get('/',[\App\Http\Controllers\Admin\ProfileController::class,'index'])->name('profile.index');
        Route::put('{currentUser}',[\App\Http\Controllers\Admin\ProfileController::class,'update'])->name('profile.update');
        Route::get('/logout',[\App\Http\Controllers\Admin\ProfileController::class,'destroy'])->name('profile.logout');
    });

    Route::group(['prefix'=>'users',],function (){
        Route::get('/',[\App\Http\Controllers\Admin\UserController::class,'index'])->name('user.index');
        Route::delete('{user}',[\App\Http\Controllers\Admin\UserController::class,'destroy'])->name('user.delete');
        Route::get('/create', [\App\Http\Controllers\Admin\UserController::class, 'create'])->name('user.create');
        Route::post('/store', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('user.store');
        Route::get('/{user}/edit',[\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('user.edit');
        Route::put('{user}',[\App\Http\Controllers\Admin\UserController::class, 'update'])->name('user.update');
    });


//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
