<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    protected $table = 'seguimientos';

    protected $fillable = [
        'id',
        'fecha',
    ];

    public function users()
    {
        return $this->belongsToMany('App\User','seguimientos_users','user_id','seguimiento_id')->withPivot('peso_actual');
    }
}
