<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Login_model extends Model
{
    use HasFactory;
    use Notifiable;

    public $timestamps  = false;
    protected $table = '_login';
    protected $primaryKey = 'log_id';
    const UPDATED_AT = 'null';
    const CREATED_AT = 'null';

    protected $fillable = [
        'log_email',
        'log_password',
        'log_nombres',
        'log_apellido_paterno',
        'log_apellido_materno',
        'log_rut',
        'log_rut_dv',
        'log_ip',
        'log_time'
    ];
}
