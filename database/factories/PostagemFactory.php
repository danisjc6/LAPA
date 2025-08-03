<?php

namespace Database\Factories;

use App\Models\Postagem;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostagemFactory extends Factory
{
    protected $model = Postagem::class;

    public function definition()
    {
        return [
            'titulo'=>$this->faker->name(),
            'descricao' => $this->faker->text($maxNbChars = 200),
            'anexo'=> $this->faker->fileExtension,
            'user_id'=> User::factory()->create(),
            'publicado'=>$this->faker->boolean($chanceOfGettingTrue = 50),
            'slug'=>$this->faker->unique()->email(),
            'tipo_postagem'=>'edital',
       ];
    }
}
