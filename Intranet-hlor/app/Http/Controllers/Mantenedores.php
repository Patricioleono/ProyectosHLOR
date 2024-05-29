<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Nacionalidad_model as nacionalidad;

class Mantenedores extends Controller
{
    public function view_nacionalidad(int $id){

        $user_data = DB::table('_login')->where('log_id', $id)->get(['log_nombres', 'log_apellido_paterno', 'log_apellido_materno', 'log_time', 'log_id']);
        $nacionalidad = DB::table('_matronas_nacionalidad')->get();
        return view('dashboard.mantenedores.nacionalidad', ['user_data' => $user_data, 'nacionalidad' => $nacionalidad]);
    }

    public function ingreso_nacionalidad(Request $object_request): object
    {
        $validate_form = Validator::make($object_request->all(), [
            'nacionalidad' =>'required|string',
            'sigla' => 'required|string|max:5'
        ], $message = [
            'nacionalidad.required' => 'Debe ingresar una nacionalidad',
           'sigla.required' => 'Debe ingresar una sigla',
        ]);

        if($validate_form->fails()){
            return response()->json([
               'status' => 400,
               'message' => $validate_form->errors()
            ]);
        }else{
            $nacionalidad = new nacionalidad();
            $nacionalidad->mat_pais_origen = $object_request->nacionalidad;
            $nacionalidad->mat_sigla_nacionalidad = $object_request->sigla;
            $nacionalidad->save();

        }
        return response()->json([
            'status' => 200,
            'message' => 'Nacionalidad ingresada con exito'
        ]);

    }
}
