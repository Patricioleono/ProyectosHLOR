<?php

namespace App\Http\Controllers;

use App\Models\Login_model as login_model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\hlor_scan as helpers;

class Login extends Controller
{

    public function index(Request $object_request): object
    {
        Log::info("VALIDANDO DATOS: ". json_encode($object_request->all()));
        $credentials = $object_request->only('email', 'password');
        $validate_form = Validator::make($credentials, [
            'email' => 'required',
            'password' => 'required'
        ], $messages = [
            'email.required' => "el campo Correo es obligatorio",
            'password.required' => "el campo Contraseña es obligatorio",
        ]);

        if($validate_form->fails()){
            Log::info("ERROR EN VALIDACION");
            return response()->json([
                'status' => 400,
               'message' => $validate_form->errors()
            ]);
        }

        $user_login = login_model::where('log_email', $credentials['email'])->get();

        if($credentials['email'] === $user_login[0]->log_email && Hash::check($credentials['password'], $user_login[0]->log_password))
        {
            login_model::where('log_email', $credentials['email'])->update([
                'log_time' => date('Y-m-d'),
                'log_ip' => helpers::get_ip_address($user_login[0]->log_nombres." ".$user_login[0]->log_apellido_paterno." ".$user_login[0]->log_apellido_materno)
            ]);

            $data_login  = login_model::where('log_email', $credentials['email'])->get();
            return response()->json([
                'status' => 200,
                'data' => $data_login[0]->log_id,
                'to' => '/dashboard'
            ]);
        }

        return response()->json([
            'status' => 400,
           'message' => 'Usuario o contraseña incorrectos'
        ]);
    }

    public function register_new_user(Request $object_request){
        Log::info("VALIDANDO DATOS: " .json_encode($object_request->all()));
        $validate_form = Validator::make($object_request->all(), [
            'str_email' => 'required|email',
            'str_pass' => 'required|string|min:3|max:36',
            'str_name' => 'required|string',
            'str_last_name' => 'required|string',
            'str_sur_name' => 'required|string',
            'int_rut' => 'required|integer',
            'str_dv' => 'required|string',
        ], $messages = [
            'str_email.required' => "el campo Correo es obligatorio",
            'str_pass.required' => "el campo Contraseña es obligatorio",
            'str_name.required' => "el campo Nombre es obligatorio",
            'str_last_name.required' => "el campo Apellido es obligatorio",
            'str_sur_name.required' => "el campo Apellido es obligatorio",
            'int_rut.required' => "el campo RUT es obligatorio",
        ]);

        if($validate_form->fails()) {
           Log::info("ERROR EN VALIDACION");
           return response()->json([
               'status' => 400,
               'message' => $validate_form->errors()
           ]);
        }else{
            Log::info("PROCESO PARA INSERTAR DATOS");
            $object_new_user = new login_model();

            $object_new_user->log_email = $object_request->post('str_email');
            $object_new_user->log_password = Hash::make($object_request->post('str_pass'));
            $object_new_user->log_nombres = $object_request->post('str_name');
            $object_new_user->log_apellido_paterno = $object_request->post('str_last_name');
            $object_new_user->log_apellido_materno = $object_request->post('str_sur_name');
            $object_new_user->log_rut = $object_request->post('int_rut');
            $object_new_user->log_rut_dv = $object_request->post('str_dv');
            $object_new_user->log_time = date('Y-m-d');

            $object_new_user->save();
            return response()->json([
                'status' => 200,
                'message' => 'Usuario registrado correctamente'
            ]);
        }
    }


}
