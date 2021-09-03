<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SettingController;

Route::get('/',[HomeController::class,'index'])->name('home');
Route::prefix('appointments')->group(function(){
    Route::post('store',[AppointmentsController::class,'store'])->name('appointment.store');
});

Route::get('login',[LoginController::class,'index'])->name('login')->middleware('loginMiddleware');
Route::post('loginButton',[LoginController::class,'login'])->name('loginButton');

Route::prefix('dashboard')->middleware('auth')->group(function(){
    Route::get('home',[DashboardController::class,'index'])->name('dashboard');
    Route::post('download_report',[DashboardController::class,'export'])->name('dashboard.report');
    Route::post('download_report2',[DashboardController::class,'import'])->name('dashboard.report2');
    Route::post('logout',[LoginController::class,'logout'])->name('dashboad.logout');
    
    Route::prefix('appointment')->group(function(){
        Route::get('index/{id?}',[AppointmentsController::class,'index'])->name('dashboard.appointment.index');
        Route::get('edit/{id}',[AppointmentsController::class,'edit'])->name('dashboard.appointment.edit');
        Route::get('delete/{id}',[AppointmentsController::class,'delete'])->name('dashboard.appointment.delete');
        Route::post('update/{id}',[AppointmentsController::class,'update'])->name('dashboard.appointment.update');
        Route::get('datatable/{id?}',[AppointmentsController::class,'datatable'])->name('dashboard.appointment.datatable');
    });

    Route::prefix('settings')->group(function(){
        Route::get('/',[SettingController::class,'index'])->name('dashboard.settings.index');
        Route::post('/update',[SettingController::class,'update'])->name('dashboard.settings.update');
    });

    Route::prefix('images')->group(function(){
        Route::get('/',[ImageController::class,'index'])->name('dashboard.images.index');
        Route::get('/create',[ImageController::class,'create'])->name('dashboard.images.create');
        Route::post('/store',[ImageController::class,'store'])->name('dashboard.images.store');
        Route::get('/edit/{id}',[ImageController::class,'edit'])->name('dashboard.images.edit');
        Route::get('/delete/{id}',[ImageController::class,'delete'])->name('dashboard.images.delete');
        Route::post('/update/{id}',[ImageController::class,'update'])->name('dashboard.images.update');
        Route::get('/datatable',[ImageController::class,'datatable'])->name('dashboard.images.datatable');
    });
});