<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\LoginController;
Route::get('/',[HomeController::class,'index'])->name('home');
Route::prefix('appointments')->group(function(){
    Route::post('store',[AppointmentsController::class,'store'])->name('appointment.store');
});
Route::prefix('dashboard')->group(function(){
    Route::get('login',[LoginController::class,'index']);
    Route::post('loginButton',[LoginController::class,'login'])->name('dashboard.login');
});