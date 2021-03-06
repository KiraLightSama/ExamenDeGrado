<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'nombre',
        'genero',
        'fecha_nacimiento',
        'peso',
        'estatura',
        'energia_actual',
        'energia_objetivo',
        'cantidad_comidas',
        'carbohidratos',
        'grasa',
        'proteina',
        'objetivo_id',
        'ejercicio_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $timestamps = false;


    public function menus()
    {
        return $this->belongsToMany('App\Menu','menus_users','user_id','menu_id')->withPivot('tipo','marcado','alimento_id');
    }


    public function alimentos()
    {
        return $this->belongsToMany('App\Alimento','alimentos_users','user_id','alimento_id');
    }


    public function seguimientos()
    {
        return $this->belongsToMany('App\Seguimiento','seguimientos_users','user_id','seguimiento_id')->withPivot('peso_actual');
    }
}
