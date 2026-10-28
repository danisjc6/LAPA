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
        'titulo', 'descricao', 'anexo', 'publicado', 'slug',
    ];

    public function anexo() {
        return $this->hasMany(Anexo::class);
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
