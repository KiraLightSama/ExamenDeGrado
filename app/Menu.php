<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';

    protected $fillable = [
        'id',
        'fecha'
    ];

    public $timestamps = false;


    public function users()
    {
        return $this->belongsToMany('App\User','menus_users','user_id','menu_id')->withPivot('tipo','marcado','alimento_id');
    }


}
