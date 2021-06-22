<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AppointmentsController;

Route::get('/',[HomeController::class,'index'])->name('home');
Route::prefix('appointments')->group(function(){
    Route::post('store',[AppointmentsController::class,'store'])->name('appointment.store');
});