@extends('layouts.app')

@section('titulo', 'Gerenciar Solicitações de Registros')
@section('content')
    <x-ui.section>

        <div class="mb-6">
            <h2 class="text-2xl font-bold tracking-tight text-slate-900">
                Gerenciar Solicitações de Registros
            </h2>
            <p class="mt-1 text-sm text-slate-600">
                Total: <span class="font-semibold text-slate-900">{{ $registros->count() }}</span>
            </p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full text-left text-sm">
                    <thead class="bg-slate-50 text-slate-700">
                        <tr>
                            <th class="px-6 py-3 font-semibold">Ações</th>
                            <th class="px-6 py-3 font-semibold">Nome</th>
                            <th class="px-6 py-3 font-semibold">Sobrenome</th>
                            <th class="px-6 py-3 font-semibold">CPF</th>
                            <th class="px-6 py-3 font-semibold">E-mail</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-200">
                        @forelse($registros as $registro)
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-2">
                                        <a
                                            href="{{ route('auth.acesso_gerenciamento.aceitarSolicitacao', $registro->id) }}"
                                            class="inline-flex items-center justify-center rounded-lg bg-emerald-700 px-3 py-2 text-xs font-semibold text-white
                                                   hover:bg-emerald-800 focus:outline-none focus:ring-4 focus:ring-emerald-700/20"
                                            onclick="return confirm('Tem certeza que deseja aceitar a solicitação?');"
                                        >
                                            Aceitar
                                        </a>

                                        <a
                                            href="{{ route('auth.acesso_gerenciamento.recusarSolicitacao', $registro->id) }}"
                                            class="inline-flex items-center justify-center rounded-lg bg-red-600 px-3 py-2 text-xs font-semibold text-white
                                                   hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-600/20"
                                            onclick="return confirm('Tem certeza que deseja recusar a solicitação?');"
                                        >
                                            Recusar
                                        </a>
                                    </div>
                                </td>

                                <td class="px-6 py-4 font-medium text-slate-900">
                                    {{ $registro->name }}
                                </td>
                                <td class="px-6 py-4 text-slate-700">
                                    {{ $registro->surname }}
                                </td>
                                <td class="px-6 py-4 font-mono text-slate-700">
                                    {{ $registro->cpf }}
                                </td>
                                <td class="px-6 py-4 text-slate-700">
                                    {{ $registro->email }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-slate-600">
                                    Nenhuma solicitação pendente no momento.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </x-ui.section>

@endsection
