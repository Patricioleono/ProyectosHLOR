<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login as login_controller;
use App\Http\Controllers\Dashboard as dashboard_controller;
use App\Http\Controllers\Rrhh as rrhh_controller;
use App\Http\Controllers\Matronas as matronas_controller;
use Illuminate\Support\Facades\DB;


Route::get('/', function () {
    return view('login');
});
Route::get('/register', function () {
    return view('register');
});


Route::controller(dashboard_controller::class)->group(function(){
    Route::get('/dashboard/{id}','index');
});
Route::controller(rrhh_controller::class)->group(function(){
    Route::get('/rrhh/{id}','index');
});

Route::controller(matronas_controller::class)->group(function(){
    Route::get('/matronas/{id}', 'index');
});

Route::controller( login_controller::class)->group(function(){
    Route::post('/login', 'index');
    Route::post('/register_user', 'register_new_user');
});
