@extends('layouts.app')

@section('titulo', 'Anatomia 3D')

@section('content')
<x-ui.section :size="'max-w-[1800px]'">
    <x-ui.page-header
        title="{{ $modelo->titulo }} 3D"
        description="Rotacione, aproxime e explore os modelos anatômicos tridimensionais em detalhes."
    />
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-12">
        <div class="lg:col-span-8">
            <div class="mb-3" x-data
                    x-init="$nextTick(() => $el.scrollIntoView({
                        behavior: 'instant',
                        block: 'center'}))"
            >
                <x-modelos-3d.viewer :modelo="$modelo" />
            </div>
            <x-modelos-3d.carrossel :modelos="$modelos" :modelo-atual="$modelo" class="lg:col-span-12" />

        </div>
        <div class="lg:col-span-4">
            <div class="flex flex-col gap-6">
                <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="mb-5 text-xl font-semibold text-slate-800">Informações do modelo</h2>
                    <p class="text-sm text-slate-600">{{ $modelo->descricao }}</p>
                    <ul class="ml-3 space-y-2">
                        <li><strong class="font-semibold text-slate-600 text-md">Espécie:</strong> {{ $modelo->animal->nome }}</li>
                        <li><strong class="font-semibold text-slate-600 text-md">Área:</strong> sdfasfd</li>
                        <li><strong class="font-semibold text-slate-600 text-md">Sistema:</strong> sdfsadf</li>
                    </ul>
                </div>


                <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="mb-5 text-xl font-semibold text-slate-800">
                        Dicas de uso
                    </h2>

                    <div class="space-y-5">
                        <div class="flex items-center gap-4">
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg bg-green-50 text-green-700">
                                <i class="fa-solid fa-computer-mouse text-lg"></i>
                            </div>

                            <div>
                                <h3 class="text-sm font-semibold text-slate-800">
                                    Aproximar e afastar
                                </h3>
                                <p class="text-sm text-slate-600">
                                    Use a roda do mouse para controlar o zoom.
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg bg-green-50 text-green-700">
                                <i class="fa-solid fa-arrows-rotate text-lg"></i>
                            </div>

                            <div>
                                <h3 class="text-sm font-semibold text-slate-800">
                                    Rotacionar
                                </h3>
                                <p class="text-sm text-slate-600">
                                    Clique e arraste com o botão esquerdo do mouse.
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg bg-green-50 text-green-700">
                                <i class="fa-solid fa-hand text-lg"></i>
                            </div>

                            <div>
                                <h3 class="text-sm font-semibold text-slate-800">
                                    Mover
                                </h3>
                                <p class="text-sm text-slate-600">
                                    Clique e arraste com o botão direito do mouse.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-ui.section>
@endsection
