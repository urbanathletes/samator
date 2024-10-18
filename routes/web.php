<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdsController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\PromoArayaController;
use App\Http\Controllers\PromoGrahaController;
use App\Http\Controllers\SpecialController;
use App\Http\Controllers\RemoveAccountController;
use App\Http\Controllers\PromoSamatorController;
use App\Http\Controllers\PromoTarakanController;
use App\Http\Controllers\RefferalController;

// Route::resource('/', AdsController::class);
Route::resource('/', PromoSamatorController::class);


Route::resource('/guest', GuestController::class);

//Samator
Route::resource('/samator', PromoSamatorController::class);
Route::post('/order', [PromoSamatorController::class, 'order']);

//Graha
Route::resource('/graha-sa', PromoGrahaController::class);
Route::post('/order', [PromoGrahaController::class, 'order']);

//Araya
Route::resource('/araya', PromoArayaController::class);
Route::post('/order', [PromoArayaController::class, 'order']);

//Tarakan
Route::resource('/tarakan', PromoTarakanController::class);
Route::post('/order', [PromoTarakanController::class, 'order']);
