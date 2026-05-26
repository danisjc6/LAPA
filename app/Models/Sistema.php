<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sistema extends Model
{
    /** @use HasFactory<\Database\Factories\SistemaFactory> */
    use HasFactory;

    protected $fillable = [
        'nome',
        'slug',
        'descricao'
    ];

    public function estruturas()
    {
        return $this->hasMany(Estrutura::class);
    }

    public function conteudos()
    {
        return $this->hasMany(Conteudo::class);
    }
}
