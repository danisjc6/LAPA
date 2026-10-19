<?php

namespace Database\Seeders;

use App\Models\Animal;
use App\Models\Arquivo;
use App\Models\Secao;
use App\Models\Sistema;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArquivoSeeder extends Seeder
{
    public function run(): void
    {
        $basePath = 'atlas';

        if (! Storage::disk('public')->exists($basePath)) {
            $this->command?->warn("A pasta storage/app/public/{$basePath} não existe.");
            return;
        }


        $arquivos = Storage::disk('public')->allFiles($basePath);

        foreach ($arquivos as $index => $caminho) {

            if ($index === 0) {
                continue;
            }

            $partes = explode('/', $caminho);

            $animal_pasta = $partes[1] ?? null;
            $sistema_pasta = $partes[2] ?? null;
            $estrutura_pasta = $partes[3] ?? null;


            $animalSlug = $this->normalizarAnimal($animal_pasta);
            $animal = $animalSlug
                        ? Animal::query()
                            ->where('slug', $animalSlug)
                            ->first()
                        : null;
            $sistema = Sistema::where('slug', $sistema_pasta)->first();

            $nomeArquivo = basename($caminho);
            $extensao = strtolower(pathinfo($caminho, PATHINFO_EXTENSION));
            $mimeType = Storage::disk('public')->mimeType($caminho);
            $tamanho = Storage::disk('public')->size($caminho);

            $arquivo = Arquivo::create(
                [
                    'path' => $caminho,
                    'conteudo_id' => null,
                    'secao_id' => Secao::whereHas('conteudo', function($query) use ($sistema, $animal) {
                        $query->whereBelongsTo($sistema, 'sistema')
                            ->whereRelation('animal', 'animais.id', $animal->id);
                    })->value('id'),
                    'animal_id' => $animal->id,

                    'tipo' => 'imagem',

                    'titulo' => Str::headline($nomeArquivo),

                    'descricao' => null,

                    'legenda' => null,

                    'thumbnail_path' => null,

                    'mime_type' => $mimeType,

                    'extensao' => $extensao,

                    'tamanho' => $tamanho,

                    'alt_text' => null,
                    'sort_order' => 0
                ]
            );

        }
        $this->command?->info(
                'Seeder finalizado. ' . count($arquivos) . ' arquivos encontrados.'
            );
    }

    private function normalizarAnimal(string $pasta): string
    {
        return match (Str::slug($pasta)) {
            'bovinos' => 'bovino',
            'aves' => 'ave',
            'equinos' => 'equino',
            'suinos' => 'suino',
            'ovinos' => 'ovino',
            'caprinos' => 'caprino',
            'caninos' => 'canino',
            'felinos' => 'felino',
            'bubalinos' => 'bubalino',
            default => Str::singular(Str::slug($pasta)),
        };
    }
}
