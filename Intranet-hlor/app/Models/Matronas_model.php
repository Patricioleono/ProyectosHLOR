<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matronas_model extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = '_matronas_user';
    protected $primaryKey ='user_pk';
    const UPDATED_AT = 'null';
    const CREATED_AT = 'null';
    protected $fillable = [
        'user_nombres',
        'user_apellido_paterno',
        'user_apellido_materno',
        'user_rut_sin_dv',
        'user_rut_dv',
        'user_direccion',
        'user_telefono',
        'user_fecha_nacimiento',
        'user_nacionalidad',
        'user_prevision'
    ];
}
