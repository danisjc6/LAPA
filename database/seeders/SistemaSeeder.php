<?php

namespace Database\Seeders;

use App\Models\Sistema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SistemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sistemas = [
            [
                'nome' => 'Sistema Circulatório',
                'slug' => 'sistema-circulatorio',
                'descricao' => 'Sistema responsável pelo transporte de sangue, gases, nutrientes, hormônios e resíduos metabólicos pelo organismo.',
            ],
            [
                'nome' => 'Sistema Digestório',
                'slug' => 'sistema-digestorio',
                'descricao' => 'Sistema responsável pela ingestão, digestão, absorção de nutrientes e eliminação dos resíduos alimentares.',
            ],
            [
                'nome' => 'Sistema Locomotor',
                'slug' => 'sistema-locomotor',
                'descricao' => 'Sistema formado por ossos, articulações e músculos, responsável pela sustentação, proteção e movimentação do corpo.',
            ],
            [
                'nome' => 'Sistema Nervoso',
                'slug' => 'sistema-nervoso',
                'descricao' => 'Sistema responsável pelo controle, integração e coordenação das funções corporais, além da percepção e resposta aos estímulos.',
            ],
            [
                'nome' => 'Sistema Respiratório',
                'slug' => 'sistema-respiratorio',
                'descricao' => 'Sistema responsável pela condução do ar e pelas trocas gasosas entre o organismo e o meio externo.',
            ],
            [
                'nome' => 'Sistema Tegumentar',
                'slug' => 'sistema-tegumentar',
                'descricao' => 'Sistema formado pela pele e seus anexos, responsável pela proteção do corpo, regulação térmica e percepção sensorial.',
            ],
            [
                'nome' => 'Sistema Urogenital',
                'slug' => 'sistema-urogenital',
                'descricao' => 'Sistema que reúne estruturas urinárias e reprodutivas, responsáveis pela eliminação de resíduos líquidos, reprodução e manutenção do equilíbrio corporal.',
            ],
        ];

        foreach ($sistemas as $sistema) {
            Sistema::updateOrCreate(
                ['slug' => $sistema['slug']],
                $sistema
            );
        }
    }
}
