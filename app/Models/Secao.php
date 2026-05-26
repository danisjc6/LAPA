<?php

namespace App\Models;

use App\Enums\TipoSecao;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Secao extends Model
{
    protected $table = 'secoes';

    protected $fillable = [
        'titulo',
        'tipo',
        'body',
        'conteudo_id',
    ];

    protected $casts = [
        'tipo' => TipoSecao::class,
    ];

    public function componentName()
    {
        return $this->tipo->component();

    }

    public function conteudo(): BelongsTo
    {
        return $this->belongsTo(Conteudo::class, 'conteudo_id');
    }

    public function arquivos(): HasMany
    {
        return $this->hasMany(Arquivo::class, 'secao_id')
            ->orderBy('sort_order');
    }
}
