<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Animal extends Model
{
    /** @use HasFactory<\Database\Factories\AnimalFactory> */
    use HasFactory;

    protected $table = 'animais';

    protected $fillable = [
        'nome',
        'slug',
        'nome_cientifico',
        'descricao'
    ];

    public function conteudos()
    {
        return $this->belongsToMany(Conteudo::class, 'animal_conteudo', 'animal_id', 'conteudo_id');
    }

    public function arquivos(): HasMany
    {
        return $this->hasMany(Arquivo::class, 'animal_id')
            ->orderBy('sort_order');
    }
}
