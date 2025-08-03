<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Visita;
use Illuminate\Database\Eloquent\Factories\Factory;

class VisitaFactory extends Factory
{
    protected $model = Visita::class;

    public function definition()
    {
        return [
            'data' => $this->faker->date,
            'hora_inicial' => $this->faker->time,
            'hora_final' => $this->faker->time,
            'descricao' => $this->faker->text,
            'confirmada' => false,
            'user_id' => User::factory()->create(),
        ];
    }
}
