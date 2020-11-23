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

    public function users()
    {
        return $this->belongsToMany('App\User','alimentos_users','user_id','alimento_id');
    }

    public function menus()
    {
        return $this->belongsToMany('App\Menu','menus_users','user_id','menu_id')->withPivot('tipo','marcado','alimento_id');
    }

    public function categoria()
    {
        return $this->belongsTo('App\Categoria');
    }

    public function clasificacion()
    {
        return $this->belongsTo('App\Clasificacion');
    }




}
