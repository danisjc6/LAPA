<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
     /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'nome', 'disciplina_id','slug',
    ];

    public function disciplina() {
        return $this->belongsTo(Disciplina::class);
    }

    public function atla() {
        return $this->hasMany(Atla::class);
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
