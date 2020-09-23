<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alimento extends Model
{
    protected $table = 'alimentos';

    protected $fillable = [
        'id',
        'nombre',
        'imagen',
        'calorias',
        'carbohidratos',
        'proteinas',
        'grasas',
        'informacion',
        'cantidad',
        'medida',
        'clasificacion_id',
        'categoria_id'
    ];


    public $timestamps = false;
}
