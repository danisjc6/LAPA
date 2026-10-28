<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'texto', 'telefone', 'facebook', 'twitter', 'instagram', 'link_agendamento_visita',
    ];
}
