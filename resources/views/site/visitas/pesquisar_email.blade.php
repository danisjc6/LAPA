@extends('layouts.app')

@section('titulo', 'Agendar visita')
@section('content')
<section class="bg-slate-100">
    <div class="mx-auto max-w-7xl px-6 py-14 lg:py-20">
        <div class="mx-auto max-w-md">

            <form
                id="form-busca"
                action="{{ route('site.visita.buscar.registro') }}"
                method="GET"
                class="rounded-xl border border-slate-200 bg-white shadow-sm"
            >
                @csrf

                <div class="h-1.5 w-full rounded-t-xl bg-emerald-700"></div>

                <div class="px-7 py-6">
                    <h2 class="text-2xl font-bold tracking-tight text-slate-900">
                        Agendamento de visitas
                    </h2>
                    <p class="mt-1 text-sm text-slate-600">
                        Informe seu e-mail para iniciar a solicitação.
                    </p>
                </div>

                <div class="px-7 pb-7">

                    <x-ui.field name="email" label="Digite seu e-mail" required>
                        <x-ui.input name="email" value="{{ isset($user->email) ? $user->email : old('email') }}" required="true"  autocomplete="email" type="email" placeholder="exemplo@exemplo.com"/>
                    </x-ui.field>

                    <button
                        form="form-busca"
                        class="mt-5 w-full rounded-lg bg-emerald-700 px-4 py-2.5 text-sm font-semibold text-white shadow-sm
                               hover:bg-emerald-800 focus:outline-none focus:ring-4 focus:ring-emerald-700/20"
                    >
                        Iniciar solicitação
                    </button>

                    <p class="mt-3 text-center text-xs text-slate-500">
                        Você receberá instruções no e-mail informado.
                    </p>
                </div>
            </form>

        </div>
    </div>
</section>
@endsection
