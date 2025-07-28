@extends('layouts.app')

@section('titulo', 'Gerenciar visitas')
@section('content')
        <div class="container">
            <h2>Gerenciar solicitações de visitas</h2>
            <a href="{{ route('site.visita.busca') }}" class="btn btn-success mb-2">Agendar</a>

            <div class="table-responsive">
                <table class="table table-rounded table-hover shadow" >
                  <thead class="table-success">
                    <tr>
                        <th>Responsável</th>
                        <th>Data</th>
                        <th>Email</th>
                        <th>Confirmada?</th>
                        <th>Ações</th>

                    </tr>
                </thead>
                <tbody>
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
                </tbody>
              </table>
          </div>
        </div>
@endsection