<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoObjetivo extends Model
{
    protected $table = 'tipo_objetivos';

    protected $fillable = [
        'nombre'
    ];

    public $timestamps = false;

    public function objetivos(){
        return $this->hasMany('App\Objetivos');
    }
}
