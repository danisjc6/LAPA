<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $areas = [
            [
                'nome' => 'Anatomia',
                'slug' => 'anatomia',
                'descricao' => 'Conteúdos relacionados às estruturas corporais dos animais.',
            ],
            [
                'nome' => 'Patologia',
                'slug' => 'patologia',
                'descricao' => 'Conteúdos relacionados a doenças, lesões e alterações morfológicas ou funcionais.',
            ],
            [
                'nome' => 'Histologia',
                'slug' => 'histologia',
                'descricao' => 'Conteúdos relacionados aos tecidos e estruturas microscópicas.',
            ],
        ];

        foreach ($areas as $area) {
            Area::updateOrCreate(
                ['slug' => $area['slug']],
                $area
            );
        }
    }
}
