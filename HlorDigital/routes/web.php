<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MatronasPacientes;



Route::get('/', function () {
    return view('matronas.vistaPrincipal');
});

Route::controller(MatronasPacientes::class)->group( function() {
    Route::post('/newPacient', 'saveNewPacient');
    Route::post('/listPacients', 'listPacients');
    Route::post('/listPacientsAlta', 'listPacientsAlta');
    Route::post('/onePacient', 'selectOnePacient');
    Route::post('/visualizarPaciente', 'visualizarPaciente');
    Route::post('/darDeAlta', 'darDeAlta');
});