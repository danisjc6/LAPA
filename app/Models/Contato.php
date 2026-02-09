<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'texto', 'telefone', 'facebook', 'twitter', 'instagram', 'user_id','slug',
    ];

    public function user() {
        return $this->belongsTo(User::class);
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
