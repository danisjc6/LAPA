<?php

namespace Database\Factories;

use App\Models\Material;
use App\Models\Disciplina;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaterialFactory extends Factory
{
    protected $model = Material::class;

    public function definition()
    {
        return [
            'titulo' =>  $this->faker->word(),
            'texto' =>  $this->faker->text($maxNbChars = 200),
            'anexo' =>   $this->faker->fileExtension,
            'disciplina_id' =>   Disciplina::factory()->create(),
            'publicado' =>  $this->faker->boolean($chanceOfGettingTrue = 50),
            'slug' =>   $this->faker->unique()->email(),
        ];
    }
}