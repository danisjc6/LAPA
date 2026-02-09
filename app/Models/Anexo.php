<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anexo extends Model
{
    protected $fillable = [
        'descricao',
        'foto',
        'atla_id',
    ];

    public function atla()
    {
        return $this->belongsTo(Atla::class);
    }
}
