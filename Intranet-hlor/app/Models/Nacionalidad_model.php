<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nacionalidad_model extends Model
{
    use HasFactory;

    protected $table = '_matronas_nacionalidad';
    protected $primaryKey = 'mat_nacionalidad_pk';
    public $timestamps  = false;
    const UPDATED_AT = 'null';
    const CREATED_AT = 'null';
    protected $fillable =  [
        'mat_pais_origen',
        'mat_sigla_nacionalidad'
    ];
}
