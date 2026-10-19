@extends('layouts.app')

@section('titulo', 'Atlas Interativo')

@section('content')


<x-layouts.sub-layout>

    {{-- Título --}}
    <x-ui.page-header
        title="Sistemas do corpo animal"
        description="Explore os sistemas do organismo animal, seus órgãos, estruturas e funções."
    />

    {{-- Cards --}}
    <section class="mt-8 grid gap-5 md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4">
        @foreach ($sistemas as $sistema)

            <x-ui.card
                :href="route('atlas.sistemas.show', $sistema->slug)"
                :title="$sistema->nome"
                :description="$sistema->descricao"
                action="Explorar sistema"
            />

        @endforeach
    </section>

</x-layouts.sub-layout>

@endsection
