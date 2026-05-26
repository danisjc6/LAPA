<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conteudo extends Model
{
    protected $fillable = [
        'titulo',
        'slug',
        'resumo',
        'img_capa',
        'publicado',
        'sistema_id',
        'area_id',
        'published_at'
    ];

    public function secoes()
    {
        return $this->hasMany(Secao::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function sistema()
    {
        return $this->belongsTo(Sistema::class);
    }

    public function animais()
    {
        return $this->belongsToMany(Animal::class, 'animal_conteudo', 'conteudo_id', 'animal_id');
    }

    public function estruturas()
    {
        return $this->belongsToMany(Estrutura::class, 'conteudo_estrutura', 'conteudo_id', 'estrutura_id');
    }

    public function arquivos(): HasMany
    {
        return $this->hasMany(Arquivo::class, 'conteudo_id')
            ->orderBy('sort_order');
    }
}
