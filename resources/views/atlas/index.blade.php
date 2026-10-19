@extends('layouts.app')

@section('titulo', 'Atlas Interativo')

@section('content')

    <x-layouts.sub-layout>
        <section class="w-full max-w-none">
            {{-- <x-ui.breadcrumb remoção temporária
            class="mb-4"
            :items="[
                [
                    'label' => 'Atlas Interativo',
                    'url' => route('site.atlas.index'),
                ],
                [
                    'label' => 'animais',
                    'url' => route('site.atlas.index'),
                ],
                [
                    'label' => 'sistemas',
                    'url' => route('site.atlas.index'),
                ],
            ]"
        /> --}}

            <x-ui.page-header title="Explore a anatomia animal de forma organizada"
                description="Navegue por sistemas, órgãos, estruturas e espécies para acessar
                conteúdos, imagens e recursos educacionais" />

            {{-- Cards principais --}}
            <section class="mt-8 grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-3">

                <x-atlas.explore-card title="Sistemas"
                    description="Explore os principais sistemas do corpo animal e suas estruturas."
                    href="{{ route('atlas.sistemas.index') }}" color="green">
                    <x-slot:icon>
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"
                            aria-hidden="true">
                            <rect x="3" y="4" width="6" height="5" rx="1.5" />
                            <rect x="15" y="4" width="6" height="5" rx="1.5" />
                            <rect x="9" y="15" width="6" height="5" rx="1.5" />

                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 9v2.5h12V9M12 11.5V15" />
                        </svg>
                    </x-slot:icon>
                </x-atlas.explore-card>


                <x-atlas.explore-card title="Órgãos e estruturas"
                    description="Acesse diretamente órgãos e estruturas anatômicas específicas." href="#"
                    color="blue">
                    <x-slot:icon>
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 20.5S4 16 4 9.5A4.5 4.5 0 0 1 12 6.7a4.5 4.5 0 0 1 8 2.8c0 6.5-8 11-8 11Z" />

                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.5 12h2l1-2.2 1.6 4.4 1.1-2.2h1.8" />
                        </svg>
                    </x-slot:icon>
                </x-atlas.explore-card>


                <x-atlas.explore-card title="Espécies"
                    description="Consulte conteúdos organizados pelas diferentes espécies animais."
                    href="{{ route('atlas.animais.index') }}"
                    color="purple">
                    <x-slot:icon>
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            {{-- Dedos --}}
                            <ellipse cx="6.5" cy="8" rx="2.1" ry="2.8"
                                transform="rotate(-25 6.5 8)" />

                            <ellipse cx="10.3" cy="5.8" rx="2.1" ry="2.8"
                                transform="rotate(-8 10.3 5.8)" />

                            <ellipse cx="14.4" cy="5.8" rx="2.1" ry="2.8"
                                transform="rotate(8 14.4 5.8)" />

                            <ellipse cx="18" cy="8" rx="2.1" ry="2.8"
                                transform="rotate(25 18 8)" />

                            {{-- Almofada central --}}
                            <path d="
                                    M12.25 10.2
                                    C8.7 10.2 6.1 13.7 6.1 16.6
                                    C6.1 18.7 7.7 20.2 9.5 19.5
                                    C10.4 19.1 11.1 18.7 12.25 18.7
                                    C13.4 18.7 14.1 19.1 15 19.5
                                    C16.8 20.2 18.4 18.7 18.4 16.6
                                    C18.4 13.7 15.8 10.2 12.25 10.2
                                    Z
                                " />
                        </svg>
                    </x-slot:icon>
                </x-atlas.explore-card>

            </section>

        </section>
    </x-layouts.sub-layout>

@endsection
