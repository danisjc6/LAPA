<?php

namespace Database\Seeders;

use App\Postagem;
use Illuminate\Database\Seeder;

class PostagemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 10; $i++) {
            Postagem::factory()->create([
                'tipo_postagem'=>'edital',
                'publicado'=>true,
            ]);
            Postagem::factory()->create([
                'tipo_postagem'=>'evento',
                'publicado'=>true,
            ]);
            Postagem::factory()->create([
                'tipo_postagem'=>'noticia',
                'publicado'=>true,
            ]);
        }
    }
}