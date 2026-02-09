<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Str;

class Material extends Model
{
    protected $fillable = [
        'titulo', 'texto', 'anexo', 'publicado', 'disciplina_id','slug', 'tipo_anexo'
    ];

    public function disciplina() {
        return $this->belongsTo(Disciplina::class);
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
}
