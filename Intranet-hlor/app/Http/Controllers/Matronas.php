<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Matronas extends Controller
{
    public function index(int $id){
        $user_data = DB::table('_login')->where('log_id', $id)->get(['log_nombres', 'log_apellido_paterno', 'log_apellido_materno', 'log_time', 'log_id']);
        return view('dashboard.matronas', ['user_data' => $user_data]);
    }
}
