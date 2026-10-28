<?php

namespace Database\Seeders;

use App\Models\Contato;
use Illuminate\Database\Seeder;

class ContatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contato::firstOrCreate(
            ['id' => 1],
            [
                'email' => null,
                'telefone' => null,
                'texto' => null,
                'facebook' => null,
                'instagram' => null,
                'twitter' => null,
                'link_agendamento_visita' => null,
            ]
        );
    }
}
