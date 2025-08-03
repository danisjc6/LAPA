<?php

namespace Database\Factories;

use App\Models\Conta;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ContaFactory extends Factory{

    protected $model = Conta::class;

    public function definition()
    {
        return [
            'password' => Hash::make('password'),
            'user_id' => User::factory()->create(),
            'remember_token' => Str::random(10),
        ];
    }
}
