<?php

namespace Database\Factories;

use App\Models\Disciplina;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DisciplinaFactory extends Factory
{
    protected $model = Disciplina::class;

    public function definition()
    {
        return [
            'nome' => $this->faker->name,
            'user_id' => User::factory(),
            'slug' => $this->faker->unique()->email,
        ];
    }

    public function noUser()
    {
        return $this->state(function (array $attributes) {
            return [
                'user_id' => null,
            ];
        });
    }
}
