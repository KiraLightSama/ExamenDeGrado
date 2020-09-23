<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ejercicio extends Model
{
    protected $table = 'ejercicios';

    protected $fillable = [
        'nombre',
        'valor'
    ];


    public $timestamps = false;

    public function users (){
        return $this->hasMany('App\User');
    }
}
