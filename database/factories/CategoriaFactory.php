<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\Disciplina;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoriaFactory extends Factory
{
    protected $model = Categoria::class;

    public function definition(){

        return [
            'nome' => $this->faker->word,
            'disciplina_id' => Disciplina::factory()->create(),
            'slug' => $this->faker->unique()->email(),
        ];
    }
}
