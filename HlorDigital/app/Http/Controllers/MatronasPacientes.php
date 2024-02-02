<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\MatronasPacientesModel;

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
        }else{
            //insertar datos en base de datos
            $nuevo_paciente = MatronasPacientesModel::create([
                'paciente_nombre' => $request->input('name'),
                'paciente_apellido_paterno' => $request->input('lastName'),
                'paciente_apellido_materno' => $request->input('surName'),
                'paciente_rut_sin_dv' => $request->input('rutSinDv'),
                'paciente_edad' => $request->input('edad'),
                'paciente_direccion' => $request->input('direccion'),
                'paciente_rut_dv' => $request->input('rutDv'),
                'paciente_estado_pap' => $request->input('statePap'),
                'paciente_fecha' => $request->input('fechaPap')
            ]);
            $nuevo_paciente->save();
            return response()->json([ 
                'status' => 200,
                'message' => 'Paciente Ingresado Exitosamente'
            ]);
        }


        
    }
}
