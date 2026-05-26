<?php

namespace Database\Seeders;

use App\Models\Animal;
use App\Models\Conteudo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnimalConteudoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $vinculos = [
            'ave' => [
                'anatomia-circulatoria-aves',
                'anatomia-digestoria-aves',
                'anatomia-sistema-nervoso-aves',
                'anatomia-respiratoria-aves',
                'anatomia-tegumentar-aves',
                'anatomia-urogenital-aves',
            ],

            'bovino' => [
                'anatomia-circulatoria-bovinos',
                'anatomia-digestoria-bovinos',
                'anatomia-locomotora-bovinos',
                'anatomia-sistema-nervoso-bovinos',
                'anatomia-respiratoria-bovinos',
                'anatomia-tegumentar-bovinos',
                'anatomia-urogenital-bovinos',
            ],

            'canino' => [
                'anatomia-digestoria-caninos',
                'anatomia-locomotora-caninos',
                'anatomia-sistema-nervoso-caninos',
                'anatomia-tegumentar-caninos',
                'anatomia-urogenital-caninos',
            ],

            'equino' => [
                'anatomia-circulatoria-equinos',
                'anatomia-digestoria-equinos',
                'anatomia-locomotora-equinos',
                'anatomia-sistema-nervoso-equinos',
                'anatomia-respiratoria-equinos',
                'anatomia-tegumentar-equinos',
                'anatomia-urogenital-equinos',
            ],

            'gato' => [
                'anatomia-digestoria-gatos',
                'anatomia-locomotora-gatos',
                'anatomia-sistema-nervoso-gatos',
                'anatomia-tegumentar-gatos',
                'anatomia-urogenital-gatos',
            ],

            'ovino' => [
                'anatomia-circulatoria-ovinos',
                'anatomia-digestoria-ovinos',
                'anatomia-respiratoria-ovinos',
            ],

            'suino' => [
                'anatomia-circulatoria-suinos',
                'anatomia-digestoria-suinos',
                'anatomia-respiratoria-suinos',
                'anatomia-urogenital-suinos',
            ],
        ];

        foreach ($vinculos as $animalSlug => $conteudoSlugs) {
            $animal = Animal::where('slug', $animalSlug)->firstOrFail();

            foreach ($conteudoSlugs as $conteudoSlug) {
                $conteudo = Conteudo::where('slug', $conteudoSlug)->first();

                if (! $conteudo) {
                    $this->command?->error("Conteúdo não encontrado: {$conteudoSlug}");
                    continue;
                }

                DB::table('animal_conteudo')->updateOrInsert(
                    [
                        'animal_id' => $animal->id,
                        'conteudo_id' => $conteudo->id,
                    ],
                    [
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
        }
    }
}
