<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Arquivo extends Model
{
    protected $fillable = [
        'path',
        'conteudo_id',
        'secao_id',
        'animal_id',
        'tipo',
        'titulo',
        'descricao',
        'legenda',
        'thumbnail_path',
        'mime_type',
        'extensao',
        'tamanho',
        'alt_text',
        'sort_order',
    ];

    protected $casts = [
        'is_cover' => 'boolean',
    ];

        public function conteudo(): BelongsTo
    {
        return $this->belongsTo(Conteudo::class, 'conteudo_id');
    }

    public function secao(): BelongsTo
    {
        return $this->belongsTo(Secao::class, 'secao_id');
    }

    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class, 'animal_id');
    }

    public function getUrlAttribute(): string
    {
        return asset('storage/' . $this->path);
    }

    public function getThumbnailUrlAttribute(): ?string
    {
        if (! $this->thumbnail_path) {
            return null;
        }

        return asset('storage/' . $this->thumbnail_path);
    }
}
