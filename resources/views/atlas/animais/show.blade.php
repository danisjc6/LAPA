@extends('layouts.app')

@section('titulo', 'Atlas Interativo')

@section('content')

    <x-layouts.sub-layout>

        <x-ui.page-header
            title="Atlas interativo do {{ $animal->nome }}"
            description="Explore os conteúdos disponíveis para este animal."
        />
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($conteudos as $conteudo)
                <x-ui.card
                    :href="route('atlas.show', $conteudo->slug)"
                    :title="$conteudo->titulo"
                    :description="$conteudo->resumo"
                    action="Acessar conteúdo"
                />
            @endforeach
        </div>

    </x-layouts.sub-layout>

@endsection
