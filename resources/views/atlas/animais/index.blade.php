@extends('layouts.app')

@section('titulo', 'Atlas Interativo')

@section('content')


<x-layouts.sub-layout>

    {{-- Título --}}
    <x-ui.page-header
        title="Animais"
        description="Explore os conteudos por animais."
    />

    {{-- Cards --}}
    <section class="mt-8 grid gap-5 md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4">
        @foreach ($animais as $animal)

            <x-ui.card
                :href="route('atlas.animais.show', $animal->slug)"
                :title="$animal->nome"
                :description="$animal->descricao"
                action="Explorar animal"
            />

        @endforeach
    </section>

</x-layouts.sub-layout>

@endsection
