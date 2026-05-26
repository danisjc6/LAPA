@extends('layouts.app')

@section('titulo', 'Gerenciar visitas')
@section('content')
        <x-ui.section>
            <x-ui.topbar
                title="Visitas"
                subtitle="Gerencie solicitações de visitas."
            >
                <x-slot:actions>
                    <a href="{{ route('site.visita.busca') }}"
                    class="inline-flex items-center justify-center rounded-lg bg-emerald-700 px-4 py-2.5 text-sm font-semibold text-white
                            shadow-sm hover:bg-emerald-800 focus:outline-none focus:ring-4 focus:ring-emerald-700/20">
                        Agendar visita
                    </a>
                </x-slot:actions>
            </x-ui.topbar>

             <x-ui.table
                title="Gerenciar Visitas"
                :count="$registros->count()"
                empty="Nenhum resultado em postagem encontrado"
                :colspan="5">

                <x-slot:thead>
                    <tr class="text-xs font-semibold uppercase tracking-wide text-slate-600">
                        <th class="px-6 py-3">Responsável</th>
                        <th class="px-6 py-3">Data</th>
                        <th class="px-6 py-3">E-mail</th>
                        <th class="px-6 py-3 text-right">Confirmada?</th>
                        <th class="px-6 py-3 text-right">Ações</th>
                    </tr>
                </x-slot:thead>
            <x-slot:tbody>
                 @foreach($registros as $registro)
                    <tr>
                        <td>{{ $registro->user->name ?? '' }}</td>
                        <td>{{ date('d/m/Y', strtotime($registro->data)).' das '.date('H:i', strtotime($registro->hora_inicial)).' às '.date('H:i', strtotime($registro->hora_final)) }}</td>
                        <td>{{ $registro->user->email }}</td>
                        <td>{{ $registro->confirmada ? 'Sim' : 'Não' }}</td>
                        <td>
                           <a href="{{ route('auth.visita.ver', $registro->slug) }}" class="btn btn-primary">Ver</a>
                           <a href="{{ route('auth.visita.deletar', $registro->id) }}" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja cancelar essa visita?');">Cancelar</a>
                       </td>
                    </tr>
                    @endforeach
            </x-slot:tbody>


            </x-ui.table>

    </x-ui.section>

@endsection
