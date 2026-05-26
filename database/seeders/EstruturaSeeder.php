<?php

namespace Database\Seeders;

use App\Models\Estrutura;
use App\Models\Sistema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstruturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $digestorio = Sistema::where('slug', 'sistema-digestorio')->firstOrFail();
        $circulatorio = Sistema::where('slug', 'sistema-circulatorio')->firstOrFail();


        $estruturas = [
            [
                'nome' => 'Coração',
                'slug' => 'coracao',
                'descricao' => 'fazer.',
                'sistema_id' => $circulatorio->id,
            ],
            [
                'nome' => 'Retículo',
                'slug' => 'reticulo',
                'descricao' => 'Compartimento gástrico dos ruminantes relacionado à seleção e movimentação do conteúdo alimentar.',
                'sistema_id' => $digestorio->id,
            ],
            [
                'nome' => 'Omaso',
                'slug' => 'omaso',
                'descricao' => 'Compartimento gástrico responsável pela absorção de água e nutrientes.',
                'sistema_id' => $digestorio->id,
            ],
            [
                'nome' => 'Abomaso',
                'slug' => 'abomaso',
                'descricao' => 'Compartimento glandular do estômago dos ruminantes, semelhante ao estômago simples dos monogástricos.',
                'sistema_id' => $digestorio->id,
            ],
        ];

        foreach ($estruturas as $estrutura) {
            Estrutura::updateOrCreate(
                ['slug' => $estrutura['slug']],
                $estrutura
            );
        }
    }
}
