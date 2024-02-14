<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatronasPacientesModel extends Model
{
    use HasFactory;

    protected $table = '_matronas';
    protected $primaryKey = 'paciente_id';
    const UPDATED_AT = null;
    const CREATED_AT = null;
    
    protected $fillable = [
        'paciente_nombre',
        'paciente_apellido_paterno',
        'paciente_apellido_materno',
        'paciente_rut_sin_dv',
        'paciente_edad',
        'paciente_direccion',
        'paciente_dv',
        'paciente_estado',
        'paciente_fecha',
        'paciente_estado_pap'
    ];


}
