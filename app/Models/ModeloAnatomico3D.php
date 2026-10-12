<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModeloAnatomico3D extends Model
{
    use HasFactory;

    protected $table = 'modelos_anatomicos_3d';

    protected $fillable = [
        'titulo',
        'slug',
        'descricao',
        'arquivo_path',
        'preview_image_path',
        'ordem',
        'ativo',
        'animal_id',
    ];

    protected $casts = [
        'ativo' => 'boolean',
        'ordem' => 'integer',
    ];

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

}
