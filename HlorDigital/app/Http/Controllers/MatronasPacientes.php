<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\MatronasPacientesModel;
use Yajra\DataTables\Facades\DataTables;

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
                'paciente_nombre'           => $request->input('name'),
                'paciente_apellido_paterno' => $request->input('lastName'),
                'paciente_apellido_materno' => $request->input('surName'),
                'paciente_rut_sin_dv'       => $request->input('rutSinDv'),
                'paciente_edad'             => $request->input('edad'),
                'paciente_direccion'        => $request->input('direccion'),
                'paciente_rut_dv'           => $request->input('rutDv'),
                'paciente_estado_pap'       => $request->input('statePap'),
                'paciente_fecha'            => $request->input('fechaPap')
            ]);
            $nuevo_paciente->save();
            return response()->json([ 
                'status' => 200,
                'message' => 'Paciente Ingresado Exitosamente'
            ]);
        }
        
    }

    public function listPacients(){
        $object_pacient = MatronasPacientesModel::select('paciente_id','paciente_nombre','paciente_apellido_paterno','paciente_rut_sin_dv','paciente_fecha','paciente_estado_pap')->get();
        //procesar datos del select y armar objeto con datos definitivos
        
        return Datatables::of($object_pacient)
        ->addColumn('action', function($object_pacient) {
            $btnAction = '<button class="btn btn-primary" id="'. $object_pacient['paciente_id'] .'"><i class="text-white fa-solid fa-eye"></i></button>
                        <button class="btn btn-info" id="'. $object_pacient['paciente_id'] .'"><i class="text-white fa-solid fa-file-pen"></i></button>
                        <button class="btn btn-danger" id="'. $object_pacient['paciente_id'] .'"><i class="text-white fa-solid fa-hand-holding-heart"></i></button>';
            
            return $btnAction;        
        })->rawColumns(['action'])->make(true);
    }
}
