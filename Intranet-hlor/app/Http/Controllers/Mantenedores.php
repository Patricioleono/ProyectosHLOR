<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Nacionalidad_model as nacionalidad;
use App\Models\Prevision_model as prevision;
use App\Models\Motivo_pap_model as motivo_pap;
use Yajra\DataTables\Facades\DataTables;

class Mantenedores extends Controller
{
    public function view_nacionalidad(int $id)
    {
        $user_data = DB::table('_login')->where('log_id', $id)->get(['log_nombres', 'log_apellido_paterno', 'log_apellido_materno', 'log_time', 'log_id']);
        return view('dashboard.mantenedores.nacionalidad', ['user_data' => $user_data]);
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
            $nacionalidad->mat_pais_origen = strtoupper($object_request->nacionalidad);
            $nacionalidad->mat_sigla_nacionalidad = strtoupper($object_request->sigla);
            $nacionalidad->save();
        }

        return response()->json([
            'status' => 200,
            'message' => 'Nacionalidad ingresada con exito'
        ]);
    }

    public function listar_nacionalidad(): object
    {
        $data_array = nacionalidad::select('*')->get();
        $convert_data = $this->list_table($data_array);
        return DataTables::of($convert_data)->make(true);
    }

    protected function list_table(object $data_array): array
    {
        (array) $array_response = [];
        foreach($data_array as $data){
            array_push($array_response,
             [
                'id_nac' => $data->mat_nacionalidad_pk,
                'nombre_nac' => $data->mat_pais_origen,
                'sigla_nac' => $data->mat_sigla_nacionalidad
            ]);
        }
        return $array_response;
    }

    public function eliminar_nacionalidad(Request $object_request)
    {
        if($object_request->input('id')){
            $nacionalidad = nacionalidad::find($object_request->input('id'));
            $nacionalidad->delete();
        }
        return response()->json([
            'status' => 200,
            'message' => 'Nacionalidad eliminada con exito'
        ]);
    }

    public function view_prevision(int $id)
    {
        $user_data = DB::table('_login')->where('log_id', $id)->get(['log_nombres', 'log_apellido_paterno', 'log_apellido_materno', 'log_time', 'log_id']);
        return view('dashboard.mantenedores.prevision', ['user_data' => $user_data]);
    }

    public function listar_prevision()
    {
        $data_array = prevision::select('*')->get();
        $convert_data = $this->list_table_prevision($data_array);
        return DataTables::of($convert_data)->make(true);
    }

    protected function list_table_prevision(object $data_array): array
    {
        (array) $array_response = [];
        foreach($data_array as $data){
            array_push($array_response,
                [
                    'id_prev' => $data->mat_prevision_pk,
                    'nombre_prev' => $data->mat_prevision_nombre,
                    'sigla_prev' => $data->mat_prevision_sigla
                ]);
        }
        return $array_response;
    }

    public function ingreso_prevision(Request $object_request): object
    {
        $validate_form = Validator::make($object_request->all(), [
            'prevision' =>'required|string',
           'sigla' =>'required|string|max:5'
        ], $message = [
            'prevision.required' => 'Debe ingresar una prevision',
           'sigla.required' => 'Debe ingresar una sigla',
        ]);

        if($validate_form->fails()){
            return response()->json([
               'status' => 400,
               'message' => $validate_form->errors()
            ]);
        }else{
            $prevision = new prevision();
            $prevision->mat_prevision_nombre = strtoupper($object_request->prevision);
            $prevision->mat_prevision_sigla = strtoupper($object_request->sigla);
            $prevision->save();
        }

        return response()->json([
            'status' => 200,
           'message' => 'Prevision ingresada con exito'
        ]);
    }

    public function eliminar_prevision(Request $object_request): object
    {
        if($object_request->input('id')){
            $prevision = prevision::find($object_request->input('id'));
            $prevision->delete();
        }
        return response()->json([
            'status' => 200,
           'message' => 'Prevision eliminada con exito'
        ]);
    }

    public function view_motivo(int $id): object
    {
        $user_data = DB::table('_login')->where('log_id', $id)->get(['log_nombres', 'log_apellido_paterno', 'log_apellido_materno', 'log_time', 'log_id']);
        return view('dashboard.mantenedores.motivo_pap', ['user_data' => $user_data]);
    }

    public function listar_motivo_pap(): object
    {
        $data_array = motivo_pap::select('*')->get();
        $convert_data = $this->list_table_motivo_pap($data_array);
        return DataTables::of($convert_data)->make(true);
    }

    public function list_table_motivo_pap(object $data_array): array
    {
        $array_response = [];
        foreach($data_array as $data){
            array_push($array_response,
                [
                    'id_motivo' => $data->mat_motivo_pap_pk,
                    'nombre_motivo' => $data->mat_motivo_pap,
                    'sigla_motivo' => $data->mat_sigla_pap
                ]);
        }
        return $array_response;
    }

    public function ingreso_motivo_pap(Request $object_request): object
    {
        $validate_form = Validator::make($object_request->all(), [
            'motivo_pap' =>'required|string',
            'sigla' =>'required|string|max:5'
        ], $message = [
            'prevision.required' => 'Debe ingresar un motivo pap',
            'sigla.required' => 'Debe ingresar una sigla',
        ]);

        if($validate_form->fails()){
            return response()->json([
                'status' => 400,
                'message' => $validate_form->errors()
            ]);
        }else{
            $motivo_pap = new motivo_pap();
            $motivo_pap->mat_motivo_pap = strtoupper($object_request->motivo_pap);
            $motivo_pap->mat_sigla_pap = strtoupper($object_request->sigla);
            $motivo_pap->save();
        }

        return response()->json([
            'status' => 200,
            'message' => 'Motivo pap ingresado con exito'
        ]);
    }

    public function eliminar_motivo(Request $object_request): object
    {
        if($object_request->input('id')){
            $prevision = motivo_pap::find($object_request->input('id'));
            $prevision->delete();
        }
        return response()->json([
            'status' => 200,
            'message' => 'Motivo pap eliminado con exito'
        ]);
    }
}
