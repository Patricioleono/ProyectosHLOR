<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Matronas extends Controller
{
    public function index(int $id){
        $user_data = DB::table('_login')->where('log_id', $id)->get(['log_nombres', 'log_apellido_paterno', 'log_apellido_materno', 'log_time', 'log_id']);
        return view('dashboard.matronas', ['user_data' => $user_data]);
    }

    public function new_user(Request $object_request){
        $validate_form = Validator::make($object_request->all(), [
            'nombres' => 'required|string',
            'apellido_paterno' => 'required|string',
            'apellido_materno' => 'required|string',
            'rut_sin_dv' => 'required|number',
            'rut_dv' => 'required|string',
            'prevision_social' => 'required|string',
            'nacionalidad' => 'required|string',
            'telefono' => 'required|number',
            'direccion' => 'required|string',
            'fecha_nacimiento' => 'required|date',
            'motivo_pap' => 'required',
            'fecha_pap' => 'required|date'
        ], $messages = [
            'nombres.required' => "el campo Nombres es obligatorio",
            'apellido_paterno.required' => "el campo Apellido Paterno es obligatorio",
            'apellido_materno.required' => "el campo Apellido Materno es obligatorio",
            'prevision_social.required' => "el campo Previsión Social es obligatorio",
            'nacionalidad.required' => "el campo Nacionalidad es obligatorio",
            'telefono.required' => "el campo Teléfono es obligatorio",
            'direccion.required' => "el campo Dirección es obligatorio"
        ]);

        if($validate_form->fails()){
          return response()->json([
              'status' => 400,
             'message' => $validate_form->errors()
          ]);
        }else{
            //insertar datos en bdo
        }
    }
}
