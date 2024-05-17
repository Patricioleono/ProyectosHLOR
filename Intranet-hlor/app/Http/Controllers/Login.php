<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Login extends Controller
{
    
    public function index(Request $object_request){
        return dd($object_request);
    }
}
