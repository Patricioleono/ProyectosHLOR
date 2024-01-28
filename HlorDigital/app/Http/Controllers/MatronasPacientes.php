<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MatronasPacientes extends Controller
{

    public function saveNewPacient(Request $request){
        $fechaPap = $request->input('fechaPap');
        if($fechaPap == 'no'){
            $validacionFormulario = Validator::make($request->all(),[
                'name' => 'required',
                'lastName' =>'required',
                'surName' =>'required',
                'statePap' =>'required',
                'rutSinDv' =>'required|numeric',
                'rutDv' =>'required|numeric',
                'edad' =>'required|numeric',
                'direccion' =>'required'
            ], $messages = [
                'required' => 'El campo :attribute es Obligatorio.',
                'numeric' => 'El campo :attribute es de tipo numerico.'
            ]);
        }else{
            $validacionFormulario = Validator::make($request->all(),[
                'name' => 'required',
                'lastName' =>'required',
                'surName' =>'required',
                'statePap' =>'required',
                'rutSinDv' =>'required|numeric',
                'rutDv' =>'required|numeric',
                'edad' =>'required|numeric',
                'direccion' =>'required',
                'fechaPap' =>'required'
            ], $messages = [
                'required' => 'El campo :attribute es Obligatorio.',
                'numeric' => 'El campo :attribute es de tipo numerico.'
            ]);
        }

        //respuesta si la validacion falla
        if($validacionFormulario->fails()){
            return response()->json([
              'status' => 400,
              'message' => $validacionFormulario->errors()
            ]);
        }


        return response()->json([ 
            'status' => 200,
            'message' => 'Registrando Datos'
        ]);
    }
}
