<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdsController;
use App\Http\Controllers\SpecialController;
use App\Http\Controllers\RemoveAccountController;
use App\Http\Controllers\Promo99KController;
use App\Http\Controllers\RefferalController;

// Route::resource('/', AdsController::class);
Route::resource('/', Promo99KController::class);

//special deal
// Route::resource('/special-deal', SpecialController::class);
//remove account
// Route::resource('/remove-account', RemoveAccountController::class);
//refferal
// Route::controller(RefferalController::class)->group(function () {
//     Route::get('/refferal/question/{id}', 'question');
//     Route::post('/refferal/save-guest', 'saveGuest');
//     Route::post('/refferal/unlock-membership', 'unlockMembership');
//     Route::post('/refferal/choose-package', 'choosePackage');
//     Route::post('/refferal/order', 'order');
// });
// Route::resource('/refferal', RefferalController::class);

//Samator
Route::resource('/samator', Promo99KController::class);
Route::post('/order', [Promo99KController::class, 'order']);
