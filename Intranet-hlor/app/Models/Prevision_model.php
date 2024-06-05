<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prevision_model extends Model
{
    use HasFactory;
    protected $table = '_matronas_prevision';
    protected $primaryKey = 'mat_prevision_pk';
    public $timestamps  = false;
    const UPDATED_AT = 'null';
    const CREATED_AT = 'null';

    protected $fillable =  [
       'mat_prevision_nombre',
       'mat_prevision_sigla'
    ];
}
