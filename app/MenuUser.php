<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuUser extends Model
{
    protected $table = 'menus_users';

    protected $fillable = [
        'id',
        'user_id',
        'menu_id',
        'alimento_id',
        'tipo',
        'marcado'
    ];

    public $timestamps = false;
}
