@extends('layouts.app')

@section('titulo', 'Gerenciar atlas')
@section('content')
<x-ui.section>
        <x-ui.topbar
            title="Atlas"
            subtitle="Gerencie páginase status de publicação."
        >
            <x-slot:actions>
                <a href="{{ route('auth.atla.adicionar') }}"
                class="inline-flex items-center justify-center rounded-lg bg-emerald-700 px-4 py-2.5 text-sm font-semibold text-white
                        shadow-sm hover:bg-emerald-800 focus:outline-none focus:ring-4 focus:ring-emerald-700/20">
                    Adicionar página
                </a>
            </x-slot:actions>
        </x-ui.topbar>

        {{-- Barra de filtros (bonita, sem dropdown Bootstrap) --}}
        <div class="mt-6 rounded-2xl border border-slate-200 bg-white/70 backdrop-blur shadow-sm">
            <form action="#" method="GET"
                  class="flex flex-col gap-3 p-4 md:flex-row md:items-center md:gap-4">

                {{-- Status como "segmented" --}}
                <div class="flex items-center gap-2">
                    <span class="text-xs font-semibold uppercase tracking-wide text-slate-600">Status</span>

                    <div class="inline-flex rounded-lg border border-slate-200 bg-white p-1">
                        @php
                            $status = $filtros['publicado'] ?? '';
                        @endphp

                        <button type="submit" name="publicado" value=""
                                class="rounded-md px-3 py-1.5 text-sm font-semibold transition
                                {{ $status === '' ? 'bg-slate-900 text-white' : 'text-slate-700 hover:bg-slate-50' }}">
                            Todos
                        </button>

                        <button type="submit" name="publicado" value="1"
                                class="rounded-md px-3 py-1.5 text-sm font-semibold transition
                                {{ (string)$status === '1' ? 'bg-slate-900 text-white' : 'text-slate-700 hover:bg-slate-50' }}">
                            Publicados
                        </button>

                        <button type="submit" name="publicado" value="0"
                                class="rounded-md px-3 py-1.5 text-sm font-semibold transition
                                {{ (string)$status === '0' ? 'bg-slate-900 text-white' : 'text-slate-700 hover:bg-slate-50' }}">
                            Rascunhos
                        </button>
                    </div>
                </div>

                {{-- Ações --}}
                <div class="flex items-center gap-2 md:justify-end">
                    <a href="#"
                       class="inline-flex items-center justify-center rounded-lg border border-slate-200 bg-white px-3 py-2.5 text-sm font-semibold text-slate-800
                              hover:bg-slate-50">
                        Limpar
                    </a>

                    <button type="submit"
                            class="inline-flex items-center justify-center rounded-lg bg-slate-900 px-3 py-2.5 text-sm font-semibold text-white
                                   hover:bg-slate-800 focus:outline-none focus:ring-4 focus:ring-slate-900/20">
                        Filtrar
                    </button>
                </div>
            </form>

        </div>

        <x-ui.table
            title="Gerenciar Solicitações de Registros"
            :count="$registros->count()"
            empty="Nenhum resultado em atlas encontrado.."
            :colspan="4"
        >
            <x-slot:thead>
                <tr class="text-xs font-semibold uppercase tracking-wide text-slate-600">
                    <th class="px-6 py-3">Título</th>
                    <th class="px-6 py-3">Área</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3 text-right">Ações</th>
                </tr>
            </x-slot:thead>

            <x-slot:tbody>
                @if(isset($registros) && count($registros) > 0)
                    @foreach ($registros as $registro)
                        <tr class="hover:bg-slate-50/70">
                            <td class="px-6 py-4">
                                <div class="font-semibold text-slate-900">{{ $registro->titulo }}</div>
                                <div class="mt-0.5 text-xs text-slate-500">
                                    {{ $registro->slug ?? '' }}
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                @if($registro->publicado)
                                    <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-600"></span>
                                        Publicado
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700">
                                        <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                                        Rascunho
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-3 text-sm font-semibold">
                                    <a href="{{ route('auth.atla.visualizar', $registro->slug) }}"
                                        class="text-slate-700 hover:text-slate-900 hover:underline">
                                        Ver
                                    </a>
                                    <a href="{{ route('auth.atla.editar', $registro->slug) }}"
                                        class="text-slate-700 hover:text-slate-900 hover:underline">
                                        Editar
                                    </a>
                                    <a href="{{ route('auth.atla.deletar', $registro->slug) }}"
                                        class="text-red-600 hover:text-red-700 hover:underline"
                                        onclick="return confirm('Tem certeza que deseja deletar este atlas?');">
                                        Deletar
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" class="px-6 py-14 text-center text-slate-600">
                            Nenhum resultado em atlas encontrado.
                        </td>
                    </tr>
                @endif
            </x-slot:tbody>
        </x-ui.table>

            {{-- Paginação (se paginator) --}}
            @if(isset($registros) && method_exists($registros, 'links'))
                <div class="border-t border-slate-200 px-6 py-4">
                    {{ $registros->links() }}
                </div>
            @endif
        </div>

</x-ui.section>
@endsection
