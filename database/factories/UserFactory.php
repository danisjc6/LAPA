<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/
class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'cpf' =>  $this->faker->unique()->regexify('[0-9]{3}+\.[0-9]{3}+\.[0-9]{3}\-[0-9]{2}'),
            'cpf_verified_at' => now(),
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'telephone' => $this->faker->phoneNumber,
            'user_type' => 'admin',
            'user_description'=>$this->faker->text($maxNbChars = 200),
            'slug' => $this->faker->unique()->safeEmail,
        ];
    }
}
