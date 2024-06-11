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
        Route::post('/matronas/control_nuevo', 'new_control');
        Route::post('/matronas/list_users', 'list_table_user');
        Route::post('/matronas/list_historial', 'list_table_historial');
        Route::post('/matronas/historial_usuario', 'user_historial');
        Route::post('/matronas/editar_historial', 'edit_historial');
        Route::post('/matronas/historial_usuario_eliminar', 'user_delete');
    });

    Route::controller(mantenedor_controller::class)->group(function(){
        Route::get('/mantenedor_nac/{id}', 'view_nacionalidad');
        Route::post('/mantenedor_nac/ingreso_nueva_nac', 'ingreso_nacionalidad');
        Route::post('/mantenedor_nac/eliminar_nac', 'eliminar_nacionalidad');
        Route::post('/list_nacionalidad', 'listar_nacionalidad');

        Route::get('/mantenedor_prev/{id}', 'view_prevision');
        Route::post('/mantenedor_prev/ingreso_nueva_prev', 'ingreso_prevision');
        Route::post('/mantenedor_prev/eliminar_prev', 'eliminar_prevision');
        Route::post('/list_prevision', 'listar_prevision');

        Route::get('/mantenedor_motivo/{id}', 'view_motivo');
        Route::post('/mantenedor_motivo/ingreso_nuevo_motivo', 'ingreso_motivo_pap');
        Route::post('/mantenedor_motivo/eliminar_motivo', 'eliminar_motivo');
        Route::post('/list_motivo', 'listar_motivo_pap');
    });

});

Route::controller( login_controller::class)->group(function(){
    Route::post('/login', 'index');
    Route::post('/register_user', 'register_new_user');
});
