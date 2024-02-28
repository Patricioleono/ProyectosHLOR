<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\MatronasPacientesModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class MatronasPacientes extends Controller
{

    public function saveNewPacient(Request $request){
        Log::info('INICIO FUNCIÓN GUARDAR NUEVO PACIENTE');
        
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
                'numeric' => 'El campo :attribute es de tipo numérico.'
            ]);
        }

        if($validacionFormulario->fails()){
            Log::info('VALIDACIÓN ERRÓNEA RESPUESTA');

            return response()->json([
              'status' => 400,
              'message' => $validacionFormulario->errors()
            ]);
        }else{
            Log::info('VALIDACIÓN CORRECTA INSERT EN BASE DE DATOS');

            //insertar datos en base de datos
            $nuevo_paciente = MatronasPacientesModel::create([
                'paciente_nombre'           => $request->input('name'),
                'paciente_apellido_paterno' => $request->input('lastName'),
                'paciente_apellido_materno' => $request->input('surName'),
                'paciente_rut_sin_dv'       => $request->input('rutSinDv'),
                'paciente_edad'             => $request->input('edad'),
                'paciente_direccion'        => $request->input('direccion'),
                'paciente_dv'               => $request->input('rutDv'),
                'paciente_estado_pap'       => $request->input('statePap'),
                'paciente_fecha'            => $request->input('fechaPap'),
                'paciente_estado'           => true
            ]);
          
            $nuevo_paciente->save();
            Log::info('TERMINO FUNCIÓN GUARDAR NUEVO PACIENTE');

            return response()->json([ 
                'status' => 200,
                'message' => 'Paciente Ingresado Exitosamente'
            ]);
        }
        
    }

    public function listPacientsAlta(): object {
        Log::info('INICIO FUNCIÓN LISTAR PACIENTES ALTA');
        $array_pacientAlta = DB::select('SELECT * FROM fn_pacientlist(false)');
        $array_response = $this->createListPacient($array_pacientAlta);
        Log::info('TERMINO FUNCIÓN LISTAR PACIENTES ALTA');

        return Datatables::of($array_response)->make(true);
    }
    public function listPacients(): object {
        Log::info('OBTENER LISTA DE PACIENTES');
        
        $array_pacient = DB::select('SELECT * FROM fn_pacientList(true)');
        $array_response = $this->createListPacient($array_pacient);
        
        return Datatables::of($array_response)->make(true);
    }

    protected function formatRut(int $int_rut, string $str_dv): string{
        Log::info("INICIO FORMATEO RUT");

        $int_reverse_rut = strrev($int_rut);
        $int_split_rut = str_split($int_reverse_rut, 3);
        $int_join_rut = implode('.', $int_split_rut);
        $int_reverse_join_dv = strrev($int_join_rut)."-".$str_dv;
        Log::info("TERMINO FORMATEO RUT");

        return $int_reverse_join_dv;
    }

    protected function createListPacient(array $array_pacient): array{
        $array_response = [];
        for($i = 0; $i < count($array_pacient); $i++){
            array_push($array_response, 
                        [
                            'id_paciente'       => $array_pacient[$i]->id_paciente,
                            'nombre'            => $array_pacient[$i]->nombre,
                            'apellidos'         => $array_pacient[$i]->apellidos,
                            'rut'               => $this->formatRut($array_pacient[$i]->rut, $array_pacient[$i]->dv),
                            'ultimo_control'    => $array_pacient[$i]->ultimo_control,
                            'estado_pap'        => $array_pacient[$i]->estado_pap
                        ]
            );
        }

        return $array_response;
    }
    
    public function selectOnePacient(Request $request_id): object{
        Log::info("OBTENER PACIENTE POR ID");
        $int_id = $request_id->input('id');
        $array_response = MatronasPacientesModel::select('*')->where('paciente_id', '=', $int_id)->get();
      
        Log::info("RETORNAR RESPUESTA CON PACIENTE SELECCIONADO");

        return response()->json(
            [
                'status'=> 200,
                'message' => 'Paciente Obtenido Exitosamente',
                'data'  => $array_response
            ]
        );
    }

    public function darDeAlta(Request $request_id){
        $int_id = $request_id->input('id');
        DB::select("SELECT * FROM fn_pacientalta($int_id)");

        return response()->json(
            [
              'status'=> 200,
              'message' => 'Paciente dado de Alta Exitosamente'
            ]);
    }

    public function updatePacient(Request $object_request): object{

        Log::info('INICIO FUNCIÓN GUARDAR NUEVO PACIENTE');
        
        $bolean_fechaPap = $object_request->input('fechaPap');
        if($bolean_fechaPap == 'no'){
            $validacionFormulario = Validator::make($object_request->all(),[
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
            $validacionFormulario = Validator::make($object_request->all(),[
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
                'numeric' => 'El campo :attribute es de tipo numérico.'
            ]);
        }

        if($validacionFormulario->fails()){
            Log::info('VALIDACIÓN ERRÓNEA RESPUESTA');

            return response()->json([
              'status' => 400,
              'message' => $validacionFormulario->errors()
            ]);
        }else{
            $str_nombre             = $object_request->input('name');
            $str_apellido_paterno   = $object_request->input('lastName');
            $str_apellido_materno   = $object_request->input('surName');
            $boolean_estado_pap     = $object_request->input('statePap');
            $int_rut_sin_dv         = $object_request->input('rutSinDv');
            $str_rut_dv             = $object_request->input('rutDv');
            $int_edad               = $object_request->input('edad');
            $str_direccion          = $object_request->input('direccion');
            $date_fecha_pap         = $object_request->input('fechaPap');
            $int_id                 = $object_request->input('id');

            Log::info('VALIDACIÓN CORRECTA UPDATE EN BASE DE DATOS');
            DB::select('SELECT fn_updatepacient(?,?,?,?,?,?,?,?,?,?)', [$str_nombre, $str_apellido_paterno, $str_apellido_materno, $boolean_estado_pap, $int_rut_sin_dv, $str_rut_dv, $int_edad, $str_direccion, $date_fecha_pap, $int_id]);
            return response()->json([
                'status' => 200,
                'message' => 'Datos de Paciente Actualizados con exito'
            ]);
        }
    }
}
