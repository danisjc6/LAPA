@extends('layouts.app')

@section('titulo', 'Atlas Interativo')

@section('content')


<x-layouts.sub-layout>

    {{-- Título --}}
    <section>
        <h1 class="text-3xl font-extrabold tracking-tight text-[#101238] sm:text-4xl">
            Sistemas do corpo animal
        </h1>

        <p class="mt-3 max-w-3xl text-base leading-7 text-slate-600">
            Explore os sistemas do organismo animal, seus órgãos, estruturas e funções.
        </p>
    </section>

    {{-- Cards --}}
    <section class="mt-8 grid gap-5 md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4">
        @foreach ($sistemas as $sistema)

            <a
                href="#"
                class="
                    group
                    relative
                    flex h-full flex-col
                    overflow-hidden
                    rounded-2xl
                    border border-slate-200
                    bg-white
                    p-6
                    transition-all duration-200
                    hover:-translate-y-0.5
                    hover:border-green-200
                    hover:shadow-lg
                    hover:shadow-slate-200/60
                    focus-visible:outline-none
                    focus-visible:ring-2
                    focus-visible:ring-green-600
                    focus-visible:ring-offset-2
                "
            >

                {{-- detalhe superior --}}
                <div
                    class="
                        absolute inset-x-0 top-0
                        h-1
                        bg-green-600
                        opacity-0
                        transition-opacity
                        group-hover:opacity-100
                    "
                ></div>


                {{-- Conteúdo --}}
                <div class="flex-1">

                    <h2
                        class="
                            text-lg
                            font-bold
                            tracking-tight
                            text-slate-900
                            transition-colors
                            group-hover:text-green-700
                        "
                    >
                        {{ $sistema->nome }}
                    </h2>

                    <p class="mt-2 text-sm leading-6 text-slate-600">
                        {{ $sistema->descricao }}
                    </p>

                </div>


                {{-- Ação --}}
                <div
                    class="
                        mt-6
                        flex items-center
                        justify-between
                        border-t border-slate-100
                        pt-4
                    "
                >
                    <span
                        class="
                            text-sm
                            font-semibold
                            text-slate-600
                            transition-colors
                            group-hover:text-green-700
                        "
                    >
                        Explorar sistema
                    </span>

                    <svg
                        class="
                            h-5 w-5
                            text-slate-400
                            transition-all duration-200
                            group-hover:translate-x-1
                            group-hover:text-green-700
                        "
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3"
                        />
                    </svg>
                </div>

            </a>

        @endforeach
    </section>

</x-layouts.sub-layout>

@endsection
