<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Atla;
use App\Categoria;

class AtlaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoria = Categoria::factory()->create();

        for($i = 0; $i < 10; $i++) {
            Atla::factory()->create([
                'publicado' => true,
                'categoria_id' => $categoria->id,
            ]);
        }
    }
}
