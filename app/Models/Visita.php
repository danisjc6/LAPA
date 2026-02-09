<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'data', 'hora_inicial', 'hora_final', 'descricao', 'confirmada', 'user_id','slug',
    ];

    public $horas = [
        ['07:00', 7],
        ['07:30', 7.30],
        ['08:00', 8],
        ['08:30', 8.30],
        ['09:00', 9],
        ['09:30', 9.30],
        ['10:00', 10],
        ['10:30', 10.30],
        ['11:00', 11],
        ['11:30', 11.30],
        ['12:00', 12],
        ['12:30', 12.30],
        ['13:00', 13],
        ['13:30', 13.30],
        ['14:00', 14],
        ['14:30', 14.30],
        ['15:00', 15],
        ['15:30', 15.30],
        ['16:00', 16],
        ['16:30', 16.30],
        ['17:00', 17],
        ['17:30', 17.30],
        ['18:00', 18],
        ['18:30', 18.30],
        ['19:00', 19],
        ['19:30', 19.30],
        ['20:00', 20],
        ['20:30', 20.30],
        ['21:00', 21],
        ['21:30', 21.30],
    ];

    public function user()
    {
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

    function horaFloatParaString($horaFloat) {
        array_push($this->horas, ['22:00', 22]);
        foreach($this->horas as $hora) {
            if($horaFloat == $hora[1]) {
                return $hora[0];
            }
        }
    }

}
