<?php

namespace Database\Factories;

use App\Models\Atla;
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
            'slug' =>   $this->faker->unique()->email(),
        ];
    }
}
