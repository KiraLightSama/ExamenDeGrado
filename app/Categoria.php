<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';

    protected $fillable = [
        'id',
        'nombre',
        'distribucion'
    ];


    public $timestamps = false;

    public function alimentos()
    {
        return $this->hasMany('App\Alimento');
    }
}
