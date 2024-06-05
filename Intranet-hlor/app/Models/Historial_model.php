<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial_model extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = '_matronas_historial';
    protected $primaryKey = 'mat_historial_pk';
     const UPDATED_AT = 'null';
    const CREATED_AT = 'null';
    protected $fillable = [
        'mat_historial_fecha_pap',
        'mat_historial_indicaciones',
        'mat_historial_observaciones',
        'mat_historial_motivo_pap',
        'user_rut_sin_dv',
        'user_rut_dv'
    ];
}
