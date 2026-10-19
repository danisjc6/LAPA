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
        'descricao',
        'imagem_path'
    ];

    public function conteudos()
    {
        return $this->hasMany(Conteudo::class);
    }

    public function modelos3D(): HasMany
    {
        return $this->hasMany(ModeloAnatomico3D::class, 'animal_id')
            ->orderBy('ordem');
    }

    public function arquivos(): HasMany
    {
        return $this->hasMany(Arquivo::class, 'animal_id')
            ->orderBy('sort_order');
    }
}
