<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlimentoUser extends Model
{
    protected $table = 'alimentos_users';

    protected $fillable = [
        'id',
        'user_id',
        'alimento_id'
    ];


    public $timestamps = false;
}
