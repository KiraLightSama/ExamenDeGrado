<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeguimientoUser extends Model
{
    protected $table = 'seguimiento_users';

    protected $fillable = [
        'id',
        'peso_actual',
        'user_id',
        'seguimiento_id'
    ];

    public $timestamps = false;
}
