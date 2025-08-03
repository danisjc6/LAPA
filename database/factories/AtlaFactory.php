<?php

namespace Database\Factories;

use App\Models\Atla;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

class AtlaFactory extends Factory
{
    protected $model = Atla::class;

    public function definition()
    {
        return [
            'titulo'=>  $this->faker->word(),
            'descricao' =>  $this->faker->text($maxNbChars = 200),
            'anexo'=>   $this->faker->fileExtension,
            'publicado' =>  $this->faker->boolean($chanceOfGettingTrue = 50),
            'categoria_id' => Categoria::factory()->create(),
            'slug' =>   $this->faker->unique()->email(),
        ];
    }
}