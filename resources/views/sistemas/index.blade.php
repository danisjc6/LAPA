@extends('layouts.app')

@section('titulo', 'Gerenciar áreas de conhecimento')
@section('content')
    <x-ui.section>
        <x-ui.topbar title="Categorias" subtitle="Gerenciar áreas de conhecimento (categorias).">
            <x-slot:actions>
                <a href="{{ route('auth.categoria.adicionar') }}"
                    class="inline-flex items-center justify-center rounded-lg bg-emerald-700 px-4 py-2.5 text-sm font-semibold text-white
                            shadow-sm hover:bg-emerald-800 focus:outline-none focus:ring-4 focus:ring-emerald-700/20">
                    Adicionar categoria
                </a>
            </x-slot:actions>
        </x-ui.topbar>
        <x-ui.table title="Gerenciar Categorias" :count="$registros->count()"
            empty="Nenhum resultado em categorias encontrado.." :colspan="3">
            <x-slot:thead>
                <tr class="text-xs font-semibold uppercase tracking-wide text-slate-600">
                    <th class="px-6 py-3">Título</th>
                    <th class="px-6 py-3">Assunto</th>
                    <th class="px-6 py-3 text-right">Ações</th>
                </tr>
            </x-slot:thead>
            <x-slot:tbody>
                @if (isset($registros) && count($registros) > 0)
                    @foreach ($registros as $registro)
                        <tr class="hover:bg-slate-50/70">
                            <td class="px-6 py-4">
                                {{ ucfirst($registro->nome) }}
                            </td>

                            <td class="px-6 py-4 text-sm text-slate-700">
                                {{ isset($registro->disciplina) ? ucfirst($registro->disciplina->nome) : 'Nenhum assunto' }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-3 text-sm font-semibold">
                                    <a href="{{ route('auth.categoria.editar', $registro->slug) }}"
                                        class="text-slate-700 hover:text-slate-900 hover:underline">
                                        Editar
                                    </a>
                                    <a href="{{ route('auth.categoria.deletar', $registro->slug) }}"
                                        class="text-red-600 hover:text-red-700 hover:underline"
                                        onclick="return confirm('Tem certeza que deseja deletar esta área de conhecimento?');">
                                        Deletar
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" class="px-6 py-14 text-center text-slate-600">
                            Nenhum resultado em categorias encontrado.
                        </td>
                    </tr>
                @endif
            </x-slot:tbody>
        </x-ui.table>

    </x-ui.section>

@endsection
