<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MatronasPacientes;



Route::get('/', function () {
    return view('matronas.vistaPrincipal');
});

Route::controller(MatronasPacientes::class)->group( function() {
    Route::post('/newPacient', 'saveNewPacient');
});