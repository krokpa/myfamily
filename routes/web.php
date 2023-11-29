<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;

Route::get('/', [IndexController::class,'index'])->name('index')->middleware('unauthenticated');

Route::prefix('auth')->group(function () {

    Route::get('sign-in', [AuthController::class,'signIn'])->name('signIn')->middleware('unauthenticated');
    Route::post('sign-in', [AuthController::class,'signIn'])->name('signInPost')->middleware('unauthenticated');
    
    Route::get('sign-up', [AuthController::class,'signUp'])->name('signUp')->middleware('unauthenticated');
    Route::post('sign-up', [AuthController::class,'signUp'])->name('signUpPost')->middleware('unauthenticated');

    Route::get('logout', [AuthController::class,'logout'])->name('logout');

});

Route::prefix('user')->group(function () {

    Route::get('home', [UserController::class,'home'])->name('user_home')->middleware('authenticated');
    
});

Route::get('users', [UserController::class,'users'])->name('manage_users')->middleware('authenticated');
Route::post('users', [UserController::class,'users'])->name('manage_users_post')->middleware('authenticated');

Route::get('family', [UserController::class,'family'])->name('manage_family')->middleware('authenticated');
Route::post('family', [UserController::class,'family'])->name('manage_family_post')->middleware('authenticated');

Route::get('user/cars/{id}', [UserController::class,'userCars'])->name('manage_user_cars')->middleware('authenticated');
Route::post('user/cars/{id}', [UserController::class,'userCars'])->name('manage_user_cars_post')->middleware('authenticated');

Route::get('user/profil', [UserController::class,'userProfil'])->name('userProfil')->middleware('authenticated');
Route::post('user/profil', [UserController::class,'userProfil'])->name('userProfil_post')->middleware('authenticated');
