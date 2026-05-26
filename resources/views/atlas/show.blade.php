@extends('layouts.app')

@section('titulo', 'Visualizar Atlas Interativo')

@section('content')
<x-layouts.sub-layout>
    <section class="w-full max-w-none">
        <main
        x-data="atlasContentMain()"
        class="col-span-12 lg:col-span-6 xl:col-span-6"
    >
        {{-- Breadcrumb remoçao temporaria
        <nav class="flex flex-wrap items-center gap-2 text-sm">
            <a href="#" class="font-medium text-emerald-700 hover:text-emerald-800">
                Atlas Interativo
            </a>

            <span class="text-slate-400">/</span>

            <a href="#" class="font-medium text-emerald-700 hover:text-emerald-800">
                Anatomia
            </a>

            <span class="text-slate-400">/</span>

            <a href="#" class="font-medium text-emerald-700 hover:text-emerald-800">
                Bovino
            </a>

            <span class="text-slate-400">/</span>

            <span class="text-slate-500">
                Sistema Digestório
            </span>
        </nav> --}}

        {{-- Cabeçalho do conteúdo --}}
        <header class="my-4">
            <h1 class="text-4xl font-bold tracking-tight text-slate-950">
                {{ $conteudo->titulo }}
            </h1>

            <p class="mt-3 max-w-3xl text-sm leading-6 text-slate-600">
                {{ $conteudo->resumo }}
            </p>

            <div class="mt-4 flex flex-wrap gap-2">
                <span class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700">
                    Espécie: Avaliar
                </span>

                <span class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700">
                    Área: {{ $conteudo->area->nome }}
                </span>

                <span class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700">
                    Sistema: {{ $conteudo->sistema->nome }}
                </span>
            </div>
        </header>

        {{-- Carrossel no lugar da Figura 1 --}}
        @foreach ($conteudo->secoes as $secao)
            <x-dynamic-component
                :component="$secao->componentName()"
                :secao="$secao"
            />
        @endforeach

        {{-- Estruturas relacionadas --}}
        <section class="mt-3 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-grip text-slate-700"></i>

                <h2 class="text-lg font-semibold text-slate-900">
                    Estruturas relacionadas
                </h2>
            </div>

            <div class="mt-4 grid grid-cols-1 gap-3 sm:grid-cols-2 xl:grid-cols-4">
                <a href="#" class="flex items-center justify-between rounded-xl border border-slate-200 bg-white px-4 py-3 transition hover:border-emerald-300 hover:bg-emerald-50/40">
                    <div class="flex items-center gap-3">
                        <span class="flex h-9 w-9 items-center justify-center rounded-full bg-emerald-100 text-emerald-700">
                            <i class="fa-solid fa-stomach"></i>
                        </span>

                        <span class="text-sm font-semibold text-slate-700">
                            Rúmen
                        </span>
                    </div>

                    <i class="fa-solid fa-chevron-right text-xs text-slate-400"></i>
                </a>

                <a href="#" class="flex items-center justify-between rounded-xl border border-slate-200 bg-white px-4 py-3 transition hover:border-emerald-300 hover:bg-emerald-50/40">
                    <div class="flex items-center gap-3">
                        <span class="flex h-9 w-9 items-center justify-center rounded-full bg-blue-100 text-blue-700">
                            <i class="fa-solid fa-atom"></i>
                        </span>

                        <span class="text-sm font-semibold text-slate-700">
                            Retículo
                        </span>
                    </div>

                    <i class="fa-solid fa-chevron-right text-xs text-slate-400"></i>
                </a>

                <a href="#" class="flex items-center justify-between rounded-xl border border-slate-200 bg-white px-4 py-3 transition hover:border-emerald-300 hover:bg-emerald-50/40">
                    <div class="flex items-center gap-3">
                        <span class="flex h-9 w-9 items-center justify-center rounded-full bg-amber-100 text-amber-700">
                            <i class="fa-solid fa-dna"></i>
                        </span>

                        <span class="text-sm font-semibold text-slate-700">
                            Omaso
                        </span>
                    </div>

                    <i class="fa-solid fa-chevron-right text-xs text-slate-400"></i>
                </a>

                <a href="#" class="flex items-center justify-between rounded-xl border border-slate-200 bg-white px-4 py-3 transition hover:border-emerald-300 hover:bg-emerald-50/40">
                    <div class="flex items-center gap-3">
                        <span class="flex h-9 w-9 items-center justify-center rounded-full bg-purple-100 text-purple-700">
                            <i class="fa-solid fa-stomach"></i>
                        </span>

                        <span class="text-sm font-semibold text-slate-700">
                            Abomaso
                        </span>
                    </div>

                    <i class="fa-solid fa-chevron-right text-xs text-slate-400"></i>
                </a>
            </div>
        </section>

        {{-- Conteúdos relacionados + botão 3D --}}
        <section class="mt-3 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="grid gap-5 lg:grid-cols-[minmax(0,1fr)_220px]">
                <div>
                    <div class="flex items-center gap-3">
                        <i class="fa-regular fa-file-lines text-slate-700"></i>

                        <h2 class="text-lg font-semibold text-slate-900">
                            Conteúdos relacionados
                        </h2>
                    </div>

                    <div class="mt-4 divide-y divide-slate-100 rounded-xl border border-slate-200">
                        <a
                            href="#"
                            class="flex items-center justify-between px-4 py-3 text-sm text-slate-700 transition hover:bg-slate-50 hover:text-emerald-700"
                        >
                            <span class="flex items-center gap-3">
                                <i class="fa-regular fa-file-lines text-slate-400"></i>
                                Sistema Digestório Bovino
                            </span>

                            <i class="fa-solid fa-chevron-right text-xs text-slate-400"></i>
                        </a>

                        <a
                            href="#"
                            class="flex items-center justify-between px-4 py-3 text-sm text-slate-700 transition hover:bg-slate-50 hover:text-emerald-700"
                        >
                            <span class="flex items-center gap-3">
                                <i class="fa-regular fa-file-lines text-slate-400"></i>
                                Intestino Bovino
                            </span>

                            <i class="fa-solid fa-chevron-right text-xs text-slate-400"></i>
                        </a>

                        <a
                            href="#"
                            class="flex items-center justify-between px-4 py-3 text-sm text-slate-700 transition hover:bg-slate-50 hover:text-emerald-700"
                        >
                            <span class="flex items-center gap-3">
                                <i class="fa-regular fa-file-lines text-slate-400"></i>
                                Patologias Gástricas em Ruminantes
                            </span>

                            <i class="fa-solid fa-chevron-right text-xs text-slate-400"></i>
                        </a>
                    </div>
                </div>

                <div class="flex items-end">
                    <a
                        href="#"
                        class="flex w-full items-center justify-center gap-2 rounded-xl bg-emerald-700 px-5 py-4 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-800"
                    >
                        <i class="fa-solid fa-cube"></i>
                        Ver modelo 3D
                    </a>
                </div>
            </div>
        </section>
    </main>

    </section>
</x-layouts.sub-layout>
@endsection
