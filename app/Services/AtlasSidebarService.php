<?php

namespace App\Services;

use App\Models\Conteudo;
use Illuminate\Support\Facades\Cache;

class AtlasSidebarService{

    public function montarNavegacaoLateral()
    {
        return Cache::remember('atlas:menu-lateral', now()->addHours(6), function () {
            $conteudos = Conteudo::query()
                ->select(['id', 'titulo', 'slug', 'resumo', 'publicado', 'area_id', 'sistema_id'])
                ->with([
                    'animais:id,nome,slug',
                    'sistema:id,nome,slug',
                ])
                ->where('publicado', true)
                ->get();

            return $conteudos
                ->flatMap(function ($conteudo){
                    return $conteudo->animais->map(function ($animal) use ($conteudo) {
                        return [
                            'animal' => $animal,
                            'sistema' => $conteudo->sistema,
                            'conteudo' => $conteudo
                        ];
                    });
                })
                ->groupBy(fn ($item) => $item['sistema']->id)
                ->map(function ($itens_do_sistema) {
                    $sistema = $itens_do_sistema->first()['sistema'];
                    $animais = $itens_do_sistema
                                ->groupBy(fn ($item) => $item['animal']->id)
                                ->map(function ($itens_do_sistema) {
                                    $animal = $itens_do_sistema->first()['animal'];

                                    $conteudos = $itens_do_sistema
                                                ->pluck('conteudo')
                                                ->unique('id')
                                                ->sortBy('titulo')
                                                ->values();

                                    return [
                                        'animal' => $animal,
                                        'conteudos' => $conteudos,
                                    ];

                                })
                                ->sortBy(fn ($item) => $item['animal']->nome)
                                ->values();
                            return [
                                'sistema' => $sistema,
                                'animais' => $animais,
                            ];

                })
                ->sortBy(fn ($item) => $item['sistema']->nome)
                ->values();
        });
    }
}
