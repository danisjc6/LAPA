<?php

namespace Database\Seeders;

use App\Models\Animal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnimalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $animais = [
            [
                'nome' => 'Ave',
                'slug' => 'ave',
                'nome_cientifico' => 'Aves',
                'descricao' => 'Grupo de animais pertencentes à classe das aves, incluindo espécies domésticas, ornamentais e silvestres.',
            ],
            [
                'nome' => 'Bovino',
                'slug' => 'bovino',
                'nome_cientifico' => 'Bos taurus / Bos indicus',
                'descricao' => 'Grupo de animais como boi, vaca, touro e bezerro.',
            ],
            [
                'nome' => 'Canino',
                'slug' => 'canino',
                'nome_cientifico' => 'Canis lupus familiaris',
                'descricao' => 'Grupo de animais representado pelos cães domésticos.',
            ],
            [
                'nome' => 'Equino',
                'slug' => 'equino',
                'nome_cientifico' => 'Equus caballus',
                'descricao' => 'Grupo de animais como cavalo, égua, garanhão e potro.',
            ],
            [
                'nome' => 'Gato',
                'slug' => 'gato',
                'nome_cientifico' => 'Felis catus',
                'descricao' => 'Espécie representada pelos gatos domésticos.',
            ],
            [
                'nome' => 'Ovino',
                'slug' => 'ovino',
                'nome_cientifico' => 'Ovis aries',
                'descricao' => 'Grupo de animais como ovelha, carneiro e cordeiro.',
            ],
            [
                'nome' => 'Suíno',
                'slug' => 'suino',
                'nome_cientifico' => 'Sus scrofa domesticus',
                'descricao' => 'Grupo de animais como porco, leitão, matriz e cachaço.',
            ],
        ];

        foreach ($animais as $animal) {
            Animal::updateOrCreate(
                ['slug' => $animal['slug']],
                $animal
            );
        }
    }
}
