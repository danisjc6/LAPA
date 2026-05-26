<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estrutura extends Model
{
    /** @use HasFactory<\Database\Factories\EstruturaFactory> */
    use HasFactory;

        protected $fillable = [
        'nome',
        'slug',
        'descricao',
        'sistema_id'
    ];


    public function sistema()
    {
        return $this->belongsTo(Sistema::class);
    }

    public function conteudos()
    {
        return $this->belongsToMany(Conteudo::class, 'conteudo_estrutura', 'estrutura_id', 'conteudo_id');
    }
}
