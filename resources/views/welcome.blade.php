@extends('layouts.app')

@section('content')
    <section class="relative overflow-hidden">
        <main class="mx-auto max-w-360 px-6 py-12 lg:px-8 lg:py-16">
            <div class="grid items-center gap-10 lg:grid-cols-[1.1fr_0.9fr]">
                <div class="max-w-2xl">
                    <span class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-sm font-medium text-emerald-800">
                        Plataforma LAPA
                    </span>

                    <h1 class="mt-4 text-4xl font-extrabold leading-tight tracking-tight text-slate-900 sm:text-5xl lg:text-6xl">
                        Laboratório de Anatomia e Patologia Animal
                    </h1>

                    <p class="mt-5 text-lg leading-8 text-slate-600">
                        Acesse conteúdos, agende visitas e consulte materiais didáticos
                        em um ambiente organizado, intuitivo e pensado para facilitar
                        o uso no dia a dia.
                    </p>

                    <div class="mt-8 flex flex-wrap gap-3">
                        <a href="{{ route('site.atlas.index') }}"
                        class="rounded-2xl bg-emerald-700 px-6 py-3.5 text-sm font-semibold text-white shadow-lg transition hover:bg-emerald-800">
                            Explorar atlas
                        </a>

                        <a href="#"
                        class="rounded-2xl border border-slate-300 bg-white px-6 py-3.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                            Ver materiais
                        </a>
                    </div>
                </div>

                <div class="flex justify-center lg:justify-end">
                    <div class="rounded-4xl border border-slate-200 bg-white p-4 shadow-xl">
                        <img
                            src="{{ asset('img/hero-direita-lapa-1024.webp') }}"
                            srcset="
                                {{ asset('img/hero-direita-lapa-640.webp') }} 640w,
                                {{ asset('img/hero-direita-lapa-1024.webp') }} 1024w,
                                {{ asset('img/hero-direita-lapa-1440.webp') }} 1440w,
                                {{ asset('img/hero-direita-lapa-1920.webp') }} 1920w
                            "
                            alt="Ilustração do LAPA"
                            class="w-full max-w-lg rounded-3xl"
                            loading="eager"
                            fetchpriority="high"
                            decoding="async"
                        >
                    </div>
                </div>
            </div>

            <div class="mt-12 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                <a href="{{ route('site.atlas.index') }}" class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                    <h2 class="text-base font-bold text-slate-900">Atlas Interativo</h2>
                    <p class="mt-2 text-sm leading-6 text-slate-600">
                        Navegue por categorias, tópicos e conteúdos anatômicos.
                    </p>
                </a>

                <a href="{{ route('site.visita.busca') }}" class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                    <h2 class="text-base font-bold text-slate-900">Agendamento</h2>
                    <p class="mt-2 text-sm leading-6 text-slate-600">
                        Solicite visitas e acompanhe informações de uso do laboratório.
                    </p>
                </a>

            </div>
        </main>
    </section>
@endsection
