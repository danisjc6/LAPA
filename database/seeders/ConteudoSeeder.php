<?php

namespace Database\Seeders;

use App\Models\Animal;
use App\Models\Area;
use App\Models\Conteudo;
use App\Models\Estrutura;
use App\Models\Sistema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConteudoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $anatomia = Area::where('slug', 'anatomia')->firstOrFail();

        $circulatorio = Sistema::where('slug', 'sistema-circulatorio')->firstOrFail();
        $digestorio = Sistema::where('slug', 'sistema-digestorio')->firstOrFail();
        $locomotor = Sistema::where('slug', 'sistema-locomotor')->firstOrFail();
        $nervoso = Sistema::where('slug', 'sistema-nervoso')->firstOrFail();
        $respiratorio = Sistema::where('slug', 'sistema-respiratorio')->firstOrFail();
        $tegumentar = Sistema::where('slug', 'sistema-tegumentar')->firstOrFail();
        $urogenital = Sistema::where('slug', 'sistema-urogenital')->firstOrFail();
        $conteudosAtlas = [
            'sistema-circulatorio' => [
                'sistema_id' => $circulatorio->id,
                'titulo_base' => 'Anatomia circulatória {artigo} {animal}',
                'slug_base' => 'anatomia-circulatoria',
                'resumo_base' => 'Apresenta as principais estruturas anatômicas relacionadas ao sistema circulatório {artigo} {animal}.',
                'animais' => [
                    'bovinos' => ['nome' => 'bovinos', 'artigo' => 'dos', 'slug' => 'bovino'],
                    'equinos' => ['nome' => 'equinos', 'artigo' => 'dos', 'slug' => 'equino'],
                    'aves' => ['nome' => 'aves', 'artigo' => 'das', 'slug' => 'ave'],
                ],
            ],

            'sistema-digestorio' => [
                'sistema_id' => $digestorio->id,
                'titulo_base' => 'Anatomia digestória {artigo} {animal}',
                'slug_base' => 'anatomia-digestoria',
                'resumo_base' => 'Apresenta as principais estruturas anatômicas relacionadas ao sistema digestório {artigo} {animal}.',
                'animais' => [
                    'bovinos' => ['nome' => 'bovinos', 'artigo' => 'dos', 'slug' => 'bovino'],
                    'equinos' => ['nome' => 'equinos', 'artigo' => 'dos', 'slug' => 'equino'],
                    'suinos' => ['nome' => 'suínos', 'artigo' => 'dos', 'slug' => 'suino'],
                    'caninos' => ['nome' => 'caninos', 'artigo' => 'dos', 'slug' => 'canino'],
                    'aves' => ['nome' => 'aves', 'artigo' => 'das', 'slug' => 'ave'],
                ],
            ],

            'sistema-locomotor' => [
                'sistema_id' => $locomotor->id,
                'titulo_base' => 'Anatomia locomotora {artigo} {animal}',
                'slug_base' => 'anatomia-locomotora',
                'resumo_base' => 'Apresenta as principais estruturas anatômicas relacionadas ao sistema locomotor {artigo} {animal}.',
                'animais' => [
                    'bovinos' => ['nome' => 'bovinos', 'artigo' => 'dos', 'slug' => 'bovino'],
                    'equinos' => ['nome' => 'equinos', 'artigo' => 'dos', 'slug' => 'equino'],
                    'caninos' => ['nome' => 'caninos', 'artigo' => 'dos', 'slug' => 'canino'],
                ],
            ],

            'sistema-nervoso' => [
                'sistema_id' => $nervoso->id,
                'titulo_base' => 'Anatomia do sistema nervoso {artigo} {animal}',
                'slug_base' => 'anatomia-sistema-nervoso',
                'resumo_base' => 'Apresenta as principais estruturas anatômicas relacionadas ao sistema nervoso {artigo} {animal}.',
                'animais' => [
                    'bovinos' => ['nome' => 'bovinos', 'artigo' => 'dos', 'slug' => 'bovino'],
                    'equinos' => ['nome' => 'equinos', 'artigo' => 'dos', 'slug' => 'equino'],
                    'caninos' => ['nome' => 'caninos', 'artigo' => 'dos', 'slug' => 'canino'],
                ],
            ],

            'sistema-respiratorio' => [
                'sistema_id' => $respiratorio->id,
                'titulo_base' => 'Anatomia respiratória {artigo} {animal}',
                'slug_base' => 'anatomia-respiratoria',
                'resumo_base' => 'Apresenta as principais estruturas anatômicas relacionadas ao sistema respiratório {artigo} {animal}.',
                'animais' => [
                    'bovinos' => ['nome' => 'bovinos', 'artigo' => 'dos', 'slug' => 'bovino'],
                    'equinos' => ['nome' => 'equinos', 'artigo' => 'dos', 'slug' => 'equino'],
                    'suinos' => ['nome' => 'suínos', 'artigo' => 'dos', 'slug' => 'suino'],
                    'ovinos' => ['nome' => 'ovinos', 'artigo' => 'dos', 'slug' => 'ovino'],
                    'aves' => ['nome' => 'aves', 'artigo' => 'das', 'slug' => 'ave'],
                ],
            ],

            'sistema-tegumentar' => [
                'sistema_id' => $tegumentar->id,
                'titulo_base' => 'Anatomia tegumentar {artigo} {animal}',
                'slug_base' => 'anatomia-tegumentar',
                'resumo_base' => 'Apresenta as principais estruturas anatômicas relacionadas ao sistema tegumentar {artigo} {animal}.',
                'animais' => [
                    'bovinos' => ['nome' => 'bovinos', 'artigo' => 'dos', 'slug' => 'bovino'],
                    'equinos' => ['nome' => 'equinos', 'artigo' => 'dos', 'slug' => 'equino'],
                    'caninos' => ['nome' => 'caninos', 'artigo' => 'dos', 'slug' => 'canino'],
                ],
            ],

            'sistema-urogenital' => [
                'sistema_id' => $urogenital->id,
                'titulo_base' => 'Anatomia urogenital {artigo} {animal}',
                'slug_base' => 'anatomia-urogenital',
                'resumo_base' => 'Apresenta as principais estruturas anatômicas relacionadas ao sistema urogenital {artigo} {animal}.',
                'animais' => [
                    'bovinos' => ['nome' => 'bovinos', 'artigo' => 'dos', 'slug' => 'bovino'],
                    'equinos' => ['nome' => 'equinos', 'artigo' => 'dos', 'slug' => 'equino'],
                    'suinos' => ['nome' => 'suínos', 'artigo' => 'dos', 'slug' => 'suino'],
                    'caninos' => ['nome' => 'caninos', 'artigo' => 'dos', 'slug' => 'canino'],
                ],
            ],
        ];

        $conteudos = [];

        foreach ($conteudosAtlas as $sistemaSlug => $sistema) {
            foreach ($sistema['animais'] as $animalPasta => $animal) {
                $conteudos[] = [
                    'titulo' => str_replace(
                        ['{artigo}', '{animal}'],
                        [$animal['artigo'], $animal['nome']],
                        $sistema['titulo_base']
                    ),
                    'slug' => "{$sistema['slug_base']}-{$animalPasta}",
                    'resumo' => str_replace(
                        ['{artigo}', '{animal}'],
                        [$animal['artigo'], $animal['nome']],
                        $sistema['resumo_base']
                    ),
                    'img_capa' => "atlas/{$sistemaSlug}/{$animalPasta}/capa.jpg",
                    'publicado' => true,
                    'sistema_id' => $sistema['sistema_id'],
                    'area_id' => $anatomia->id,
                    'animal_id' => Animal::where('slug', $animal['slug'])->firstOrFail()->id,
                    'published_at' => now(),
                ];
            }
        }

        foreach ($conteudos as $conteudo) {
            Conteudo::updateOrCreate(
                ['slug' => $conteudo['slug']],
                $conteudo
            );
        }
    }
}
