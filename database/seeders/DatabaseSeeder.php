<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(AnimalSeeder::class);
        $this->call(AreaSeeder::class);
        $this->call(SistemaSeeder::class);
        $this->call(EstruturaSeeder::class);
        $this->call(ConteudoSeeder::class);
        $this->call(SecaoSeeder::class);
        $this->call(ArquivoSeeder::class);
        $this->call(Modelo3DSeeder::class);
        $this->call(ContatoSeeder::class);

            User::factory()->create();
    }
}
