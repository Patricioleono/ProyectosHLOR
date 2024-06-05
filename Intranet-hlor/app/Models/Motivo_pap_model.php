<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motivo_pap_model extends Model
{
    use HasFactory;
    protected $table ='_matronas_motivo_pap';
    public $timestamps = false;
    protected $primaryKey ='mat_motivo_pap_pk';
    const UPDATED_AT = 'null';
    const CREATED_AT = 'null';
    protected $fillable = [
       'mat_motivo_pap',
       'mat_sigla_pap'
    ];
}
