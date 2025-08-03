<?php

namespace Database\Seeders;

use App\Disciplina;
use App\Material;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $disciplina = Disciplina::factory()->create();

        for($i = 0; $i < 10; $i++) {
            Material::factory()->create([
               'publicado' => true,
               'disciplina_id' => $disciplina->id,
            ]);
        }
    }
}
