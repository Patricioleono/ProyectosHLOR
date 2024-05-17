<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controller\Controller\Login as login_controller;


Route::get('/', function () {
    return view('login');
});
Route::get('/dashbaord', function () {
    return view('dashboard');
});


Route::controller(login_controller::class)->group(function(){
    Route::post('/login', 'index');
});
