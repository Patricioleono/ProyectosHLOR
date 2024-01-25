<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MatronasPacientes extends Controller
{
    

    public function saveNewPacient(Request $request){
        $name = $request->post('name');
        $lasName = $request->post('lasName');
        $surName = $request->post('surName');
        $statePap = $request->post('statePap');
        $rutDv = $request->post('rutDv');
        $rutSinDv = $request->post('rutSinDv');
        $yearsOld = $request->post('edad');
        $adress = $request->post('direccion');
        $datePap = $request->post('fechaPap');


        return response()->json([ ]);
    }
}
