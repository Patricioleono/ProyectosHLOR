<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class Dashboard extends Controller
{
    public function index(int $id): object
    {
        $user_data = DB::table('_login')->where('log_id', $id)->get(['log_nombres', 'log_apellido_paterno', 'log_apellido_materno', 'log_time', 'log_id']);
        return view('dashboard.dashboard', ['user_data' => $user_data]);
    }
}
