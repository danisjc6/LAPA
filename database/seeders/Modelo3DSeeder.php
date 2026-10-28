<?php

namespace Database\Seeders;

use App\Models\Animal;
use App\Models\ModeloAnatomico3D;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Modelo3DSeeder extends Seeder
{
    public function run(): void
    {
        $animais = [
            'aves' => 'Ave',
            'caninos' => 'Canino',
            'equinos' => 'Equino',
            'ovinos' => 'Ovino',
        ];

        $disk = Storage::disk('public');

        foreach ($animais as $pasta => $nomeAnimal) {
            $animal = Animal::where('nome', $nomeAnimal)->firstOrFail();

            $diretorio = "modelos_3d/{$pasta}";

            if (! $disk->exists($diretorio)) {
                $this->command?->warn(
                    "Diretório não encontrado: {$diretorio}"
                );

                continue;
            }

            $ordem = 1;

            foreach ($disk->allFiles($diretorio) as $arquivo) {
                if (strtolower(pathinfo($arquivo, PATHINFO_EXTENSION)) !== 'glb') {
                    continue;
                }

                $nomeArquivo = pathinfo(
                    $arquivo,
                    PATHINFO_FILENAME
                );

                $titulo = Str::of($nomeArquivo)
                    ->replace('_', ' ')
                    ->squish()
                    ->toString();

                $base = preg_replace('/\.glb$/i', '', $arquivo);

                $extensoes = ['png', 'jpg', 'jpeg'];

                $preview = collect($extensoes)
                    ->map(fn ($extensao) => "{$base}.{$extensao}")
                    ->first(fn ($path) => Storage::disk('public')->exists($path));

                ModeloAnatomico3D::updateOrCreate(
                    [
                        'arquivo_path' => $arquivo,
                    ],
                    [
                        'titulo' => $titulo,

                        'slug' => Str::slug(
                            "{$nomeAnimal}-{$titulo}"
                        ),

                        'descricao' => null,

                        'preview_image_path' => $preview ?? null,

                        'ordem' => $ordem,

                        'ativo' => true,

                        'animal_id' => $animal->id,
                    ]
                );

                $ordem++;
            }
        }
    }
}
