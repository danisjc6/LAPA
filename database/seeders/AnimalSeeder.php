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
                'imagem_path' => 'animais/ave.jpg',
            ],
            [
                'nome' => 'Bovino',
                'slug' => 'bovino',
                'nome_cientifico' => 'Bos taurus / Bos indicus',
                'descricao' => 'Grupo de animais como boi, vaca, touro e bezerro.',
                'imagem_path' => null,
            ],
            [
                'nome' => 'Canino',
                'slug' => 'canino',
                'nome_cientifico' => 'Canis lupus familiaris',
                'descricao' => 'Grupo de animais representado pelos cães domésticos.',
                'imagem_path' => 'animais/cao.jpg',
            ],
            [
                'nome' => 'Equino',
                'slug' => 'equino',
                'nome_cientifico' => 'Equus caballus',
                'descricao' => 'Grupo de animais como cavalo, égua, garanhão e potro.',
                'imagem_path' => 'animais/equino.jpg',

            ],
            [
                'nome' => 'Gato',
                'slug' => 'gato',
                'nome_cientifico' => 'Felis catus',
                'descricao' => 'Espécie representada pelos gatos domésticos.',
                'imagem_path' => null,
            ],
            [
                'nome' => 'Ovino',
                'slug' => 'ovino',
                'nome_cientifico' => 'Ovis aries',
                'descricao' => 'Grupo de animais como ovelha, carneiro e cordeiro.',
                'imagem_path' => 'animais/ovino.jpg',
            ],
            [
                'nome' => 'Suíno',
                'slug' => 'suino',
                'nome_cientifico' => 'Sus scrofa domesticus',
                'descricao' => 'Grupo de animais como porco, leitão, matriz e cachaço.',
                'imagem_path' => null,
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
