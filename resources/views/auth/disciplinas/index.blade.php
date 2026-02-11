@extends('layouts.app')

@section('titulo', 'Gerenciar assuntos')
@section('content')
        <div class="container">
            <h2>Gerenciar assuntos (disciplinas)</h2>
            <a href="{{ route('auth.disciplina.adicionar') }}" class="btn mb-2">Adicionar</a>

           

            <div class="table-responsive">
              <table class="table" id="myTable">
                <thead>
                    <tr>
                        <th>Ações</th>
                        <th>Nome</th>
                        <th>Professor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($registros as $registro)
                    <tr>
                        <td>
                            <a href="{{ route('auth.disciplina.editar', $registro->slug) }}" class="btn">Editar</a>
                            <a href="{{ route('auth.disciplina.deletar', $registro->slug) }}" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja deletar o assunto?');">Deletar</a>
                        </td>
                        <td>{{ ucfirst($registro->nome) }}</td>
                        <td>{{ isset($registro->user) ? $registro->user->name : 'Nenhum professor' }}</td>

                    </tr>
                    @endforeach
                </tbody>
              </table>

         </div>
       </div>
@endsection
