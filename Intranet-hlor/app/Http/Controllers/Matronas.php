<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Matronas_model as matronas_user;
use App\Models\Historial_model as historial_user;
use Yajra\DataTables\Facades\DataTables;

class Matronas extends Controller
{
    public function index(int $id){
        $user_data = DB::table('_login')->where('log_id', $id)->get(['log_nombres', 'log_apellido_paterno', 'log_apellido_materno', 'log_time', 'log_id']);
        $motivos_pap = DB::table('_matronas_motivo_pap')->get(['mat_motivo_pap']);
        $nacionalidad = DB::table('_matronas_nacionalidad')->get(['mat_pais_origen']);
        $prevision = DB::table('_matronas_prevision')->get(['mat_prevision_nombre']);
        return view('dashboard.matronas', ['user_data' => $user_data, 'motivos_pap' => $motivos_pap, 'nacionalidades' => $nacionalidad, 'previsiones' => $prevision]);
    }

    public function new_user(Request $object_request){
        $validate_form = Validator::make($object_request->all(), [
            'nombres' => 'required|string',
            'apellido_paterno' => 'required|string',
            'apellido_materno' => 'required|string',
            'rut_sin_dv' => 'required',
            'rut_dv' => 'required|string',
            'prevision_social' => 'required|string',
            'nacionalidad' => 'required|string',
            'telefono' => 'required',
            'direccion' => 'required|string',
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
            $new_user = new matronas_user();
            $new_user->user_nombres = strtoupper($object_request->post('nombres'));
            $new_user->user_apellido_paterno = strtoupper($object_request->post('apellido_paterno'));
            $new_user->user_apellido_materno = strtoupper($object_request->post('apellido_materno'));
            $new_user->user_rut_sin_dv = $object_request->post('rut_sin_dv');
            $new_user->user_rut_dv = $object_request->post('rut_dv');
            $new_user->user_direccion = $object_request->post('direccion');
            $new_user->user_telefono = $object_request->post('telefono');
            $new_user->user_fecha_nacimiento = $object_request->post('fecha_nacimiento');
            $new_user->user_nacionalidad = $object_request->post('nacionalidad');
            $new_user->user_prevision = $object_request->post('prevision_social');
            $new_user->save();

            if(!is_null($object_request->post('resultado_pap')) || !is_null($object_request->post('indicaciones')) ){
                $new_user_historial = new historial_user();
                $new_user_historial->mat_historial_fecha_pap = $object_request->post('fecha_pap');
                $new_user_historial->mat_historial_motivo_pap = $object_request->post('motivo_pap');
                $new_user_historial->mat_historial_indicaciones = $object_request->post('indicaciones');
                $new_user_historial->mat_historial_resultado_pap = $object_request->post('resultado_pap');
                $new_user_historial->user_rut_sin_dv = $object_request->post('rut_sin_dv');
                $new_user_historial->user_rut_dv = $object_request->post('rut_dv');
                $new_user_historial->save();
            }
        }
        return response()->json([
            'status' => 200,
            'message' => 'Usuario registrado correctamente'
        ]);
    }

    public function list_table_user(){
        $data_array = matronas_user::select('*')->get ();
        $conver_data = $this->list_converter_user($data_array);
        return DataTables::of($conver_data)->make(true);
    }

    protected function list_converter_user(object $data): array
    {
        $array_response = [];
        foreach ($data as $user){
            array_push($array_response,
            [
                'id_user' => $user->user_pk,
                'user_name' => $user->user_nombres,
                'user_last_name' => $user->user_apellido_paterno,
                'user_last_last_name' => $user->user_apellido_materno,
                'user_rut' => $user->user_rut_sin_dv."-".$user->user_rut_dv,
                'user_direccion' => $user->user_direccion,
                'user_telefono' => $user->user_telefono,
                'user_nacimiento' => $user->user_fecha_nacimiento
            ]);
        }

        return $array_response;
    }

    public function user_historial(Request $object_request)
    {
        $rut = $object_request->post('rut');
        $dv = $object_request->post('dv');
        $existe_rut = historial_user::where('user_rut_sin_dv', $rut)->where('user_rut_dv', $dv)->get();

        if(count($existe_rut) > 0){
            return DB::select(" SELECT * FROM FN_USER_HISTORIAL($rut, $dv) ");
        }else{
            return response()->json([
                    'status' => 400,
                    'message' => 'Usuario: '.$rut.'-'.$dv.' sin registro historico'
            ]);
        }
    }

    public function user_delete(Request $object_request): object
    {
        matronas_user::where('user_rut_sin_dv', $object_request->post('rut'))->where('user_rut_dv', $object_request->post('dv'))->delete();
        return response()->json([
           'status' => 200,
           'message' => 'Usuario dado de alta'
        ]);
    }

    public function list_table_historial(Request $object_request)
    {
        $rut = $object_request->post('user_rut');
        $dv = $object_request->post('user_dv');
        $all_historial = DB::select("SELECT * FROM FN_USER_HISTORIAL($rut , $dv) ");
        $converted_data = $this->list_historial_converted($all_historial);
        return DataTables::of($converted_data)->make(true);
    }

    protected function list_historial_converted(array $list): array
    {
        $array_response = [];
        foreach ($list as $historial){
            array_push($array_response,
            [
                'id_historial' => $historial->id_historial,
                'fecha_pap' => $historial->fecha_pap,
                'indicaciones' => $historial->indicaciones,
                'resultado_pap' => $historial->resultado_pap
            ]);
        }

        return $array_response;
    }

    public function new_control(Request $object_request): object
    {
        $valitadion_form = Validator::make($object_request->all(), [
            'control_fecha_pap' =>'required',
            'control_resultado_pap' =>'required',
            'control_indicaciones' =>'required',
            'control_motivo_pap' =>'required'
        ], $messages = [
            'control_fecha_pap.required' => "el campo Fecha PAP es obligatorio",
            'control_resultado_pap.required' => "el campo Resultado PAP es obligatorio",
            'control_indicaciones.required' => "el campo Indicaciones es obligatorio",
            'control_motivo_pap.required' => "el campo Motivo PAP es obligatorio"
        ]);

        if($valitadion_form->fails()){
            return response()->json([
               'status' => 400,
               'message' => $valitadion_form->errors()
            ]);
        }else{
            $new_control = new historial_user();
            $new_control->mat_historial_fecha_pap = $object_request->post('control_fecha_pap');
            $new_control->mat_historial_motivo_pap = $object_request->post('control_motivo_pap');
            $new_control->mat_historial_indicaciones = $object_request->post('control_indicaciones');
            $new_control->mat_historial_resultado_pap = $object_request->post('control_resultado_pap');
            $new_control->user_rut_sin_dv = $object_request->post('user_rut');
            $new_control->user_rut_dv = $object_request->post('user_rut_dv');
            $new_control->save();
        }
        return response()->json([
           'status' => 200,
           'message' => 'Control registrado correctamente'
        ]);
    }

    public function edit_historial(Request $object_request)
    {
        $data_historial = historial_user::select('*')->where('mat_historial_pk', $object_request->post('id_historial'))->get();
        if($data_historial){
            return response()->json([
                'status' => 200,
                'data' => $data_historial
            ]);
        }else{
            return response()->json([
               'status' => 400,
               'message' => 'No se encontro el historial'
            ]);
        }

    }
}
