@extends('layouts.app')

@section('titulo', 'Visualizar Atlas Interativo')

@section('content')
<x-layouts.sub-layout>
    <x-ui.section>
            <x-ui.page-header
                title="{{ $conteudo->titulo }}"
                description="{{ $conteudo->resumo }}"
            />
            <div class="flex flex-wrap gap-2 mb-5">
                <span class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700">
                    Espécie: {{ $conteudo->animal->nome }}
                </span>

                <span class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700">
                    Área: {{ $conteudo->area->nome }}
                </span>

                <span class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700">
                    Sistema: {{ $conteudo->sistema->nome }}
                </span>
            </div>


            @foreach ($conteudo->secoes as $secao)
                <x-dynamic-component
                    :component="$secao->componentName()"
                    :secao="$secao"
                />
            @endforeach

    </x-ui.section>

</x-layouts.sub-layout>
@endsection
