<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login as login_controller;
use App\Http\Controllers\Dashboard as dashboard_controller;


Route::get('/', function () {
    return view('login');
});
Route::get('/register', function () {
    return view('register');
});


Route::controller(dashboard_controller::class)->group(function(){
    Route::get('/dashboard', function(){
        return view('dashboard.dashboard');
    });
});

Route::controller(login_controller::class)->group(function(){
    Route::post('/login', 'index');
    Route::post('/register_user', 'register_new_user');
});
