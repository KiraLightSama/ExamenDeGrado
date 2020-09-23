<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objetivo extends Model
{
    protected $table = 'objetivos';

    protected $fillable = [
        'nombre',
        'valor',
        'tipo_objetivo_id'
    ];

    public $timestamps = false;
}
