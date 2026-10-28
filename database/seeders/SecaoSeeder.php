<?php

namespace Database\Seeders;

use App\Enums\TipoSecao;
use App\Models\Conteudo;
use App\Models\Secao;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SecaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $conteudos = Conteudo::all();

        foreach($conteudos as $conteudo){
            Secao::create([
                'titulo' => '',
                'tipo' => TipoSecao::Carrossel,
                'conteudo_id' => $conteudo->id,
                'body' => '',
            ]);
        }

    }
}
