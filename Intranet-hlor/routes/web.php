<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login as login_controller;
use App\Http\Controllers\Dashboard as dashboard_controller;
use App\Http\Controllers\Rrhh as rrhh_controller;
use App\Http\Controllers\Matronas as matronas_controller;
use App\Http\controllers\Mantenedores as mantenedor_controller;


Route::get('/', function () {
    return view('login');
});
Route::get('/register', function () {
    return view('register');
});


Route::controller(dashboard_controller::class)->group(function(){
    Route::get('/dashboard/{id}','index');

    Route::controller(rrhh_controller::class)->group(function(){
        Route::get('/rrhh/{id}','index');
    });

    Route::controller(matronas_controller::class)->group(function(){
        Route::get('/matronas/{id}', 'index');
        Route::post('/matronas/new_user', 'new_user');
    });

    Route::controller(mantenedor_controller::class)->group(function(){
        Route::get('/mantenedor_nac/{id}', 'view_nacionalidad');
        Route::post('/mantenedor_nac/ingreso_nueva_nac', 'ingreso_nacionalidad');
    });

});

Route::controller( login_controller::class)->group(function(){
    Route::post('/login', 'index');
    Route::post('/register_user', 'register_new_user');
});
