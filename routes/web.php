<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
Route::get('/',[HomeController::class,'index'])->name('home');
Route::prefix('appointments')->group(function(){
    Route::post('store',[AppointmentsController::class,'store'])->name('appointment.store');
});

Route::get('login',[LoginController::class,'index'])->name('login');
Route::post('loginButton',[LoginController::class,'login'])->name('loginButton');

Route::prefix('dashboard')->middleware('auth')->group(function(){
    Route::get('home',[DashboardController::class,'index'])->name('dashboard');
    Route::post('logout',[LoginController::class,'logout'])->name('dashboad.logout');
    
    Route::prefix('appointment')->group(function(){
        Route::get('/',[AppointmentsController::class,'index'])->name('dashboard.appointment.index');
        Route::get('datatable',[AppointmentsController::class,'datatable'])->name('dashboard.appointment.datatable');
    });
});