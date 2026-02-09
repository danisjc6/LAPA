<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Str;
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','cpf','email','telephone','user_description','avatar','user_type','email_verified_at','cpf_verified_at','link_lattes','slug', 'tipo_avatar',
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function disciplina()
    {
        return $this->hasMany(Disciplina::class);
    }

    public function postagem()
    {
        return $this->hasMany(Postagem::class);
    }

    public function conta()
    {
        return $this->hasOne(Conta::class);
    }

    public function visita()
    {
        return $this->hasMany(Visita::class);
    }

    public function salvarUserVisitante($user)
    {
        return $this->create($user);
    }

    /**
    * Get the route key for the model.
    *
    * @return string
    */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function contato() {
        return $this->hasMany(Contato::class);
    }
}
