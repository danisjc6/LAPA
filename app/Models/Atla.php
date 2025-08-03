<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Str;


class Atla extends Model
{
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titulo', 'descricao', 'anexo', 'publicado', 'categoria_id','slug',
    ];

    public function categoria() {
        return $this->belongsTo('App\Categoria');
    }

    public function anexo() {
        return $this->hasMany('App\Anexo');
    }

    public function quantidadeAtlasPublicados() {
        return $this->where('publicado', true)->where('categoria_id', $this->categoria_id)->count();
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
