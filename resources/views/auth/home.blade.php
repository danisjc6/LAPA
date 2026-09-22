@extends('layouts.app')
@section('titulo', 'Gerenciar - LAPA')

@section('content')
<section class="bg-slate-100">
    <div class="mx-auto max-w-7xl px-6 py-10 lg:py-14">

        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold tracking-tight text-slate-900">
                Painel do sistema
            </h1>
            <p class="mt-2 text-sm text-slate-600">
                Acesse rapidamente as principais áreas do laboratório.
            </p>
        </div>

        {{-- Principais funcionalidades --}}
        <div class="flex items-center justify-between gap-4">
            <h3 class="text-base font-semibold text-slate-900">Principais funcionalidades</h3>
            <span class="h-px flex-1 bg-slate-200"></span>
        </div>

        <div class="mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            {{-- Card --}}

            <a href="{{ route('auth.atlas') }}"
               class="group rounded-xl border border-slate-200 bg-white p-5 shadow-sm transition
                      hover:-translate-y-0.5 hover:border-slate-300 hover:shadow-md">
                <div class="flex items-start gap-4">
                    <div class="rounded-lg bg-emerald-50 p-3 text-emerald-700">
                        <span class="fa fa-book-open text-2xl"></span>
                    </div>
                    <div class="min-w-0">
                        <h3 class="font-semibold text-slate-900">{{ __('Atlas') }}</h3>
                        <p class="mt-1 text-sm text-slate-600">Conteúdos e referências.</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('auth.visitas') }}"
               class="group rounded-xl border border-slate-200 bg-white p-5 shadow-sm transition
                      hover:-translate-y-0.5 hover:border-slate-300 hover:shadow-md">
                <div class="flex items-start gap-4">
                    <div class="rounded-lg bg-emerald-50 p-3 text-emerald-700">
                        <span class="fa fa-id-card-alt text-2xl"></span>
                    </div>
                    <div class="min-w-0">
                        <h3 class="font-semibold text-slate-900">{{ __('Visitas') }}</h3>
                        <p class="mt-1 text-sm text-slate-600">Agendamentos e histórico.</p>
                    </div>
                </div>
            </a>
        </div>

        {{-- Mais opções --}}
        <div class="mt-10 flex items-center justify-between gap-4">
            <h3 class="text-base font-semibold text-slate-900">Mais opções</h3>
            <span class="h-px flex-1 bg-slate-200"></span>
        </div>

        <div class="mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <a href="{{ route('auth.acesso_gerenciamento') }}"
               class="group rounded-xl border border-slate-200 bg-white p-5 shadow-sm transition
                      hover:-translate-y-0.5 hover:border-slate-300 hover:shadow-md">
                <div class="flex items-start gap-4">
                    <div class="rounded-lg bg-emerald-50 p-3 text-emerald-700">
                        <span class="fa fa-check-circle text-2xl"></span>
                    </div>
                    <div class="min-w-0">
                        <h3 class="font-semibold text-slate-900">{{ __('Solicitações') }}</h3>
                        <p class="mt-1 text-sm text-slate-600">Pedidos de gerenciamento.</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('auth.contatos') }}"
               class="group rounded-xl border border-slate-200 bg-white p-5 shadow-sm transition
                      hover:-translate-y-0.5 hover:border-slate-300 hover:shadow-md">
                <div class="flex items-start gap-4">
                    <div class="rounded-lg bg-emerald-50 p-3 text-emerald-700">
                        <span class="fa fa-info-circle text-2xl"></span>
                    </div>
                    <div class="min-w-0">
                        <h3 class="font-semibold text-slate-900">{{ __('Contatos') }}</h3>
                        <p class="mt-1 text-sm text-slate-600">Fale com o laboratório.</p>
                    </div>
                </div>
            </a>
        </div>

    </div>
</section>
@endsection
