@extends('layouts.app')

@section('titulo', 'Gerenciar áreas de conhecimento')
@section('content')
        <div class="container">
            <h2>Gerenciar áreas de conhecimento (categorias)</h2>
            <a href="{{ route('auth.categoria.adicionar') }}" class="btn mb-2">Adicionar</a>

        
            <div class="table-responsive">
              <table class="table" id="myTable">
                <thead>
                    <tr>
                        <th>Ações</th>
                        <th>Nome</th>
                        <th>Assunto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($registros as $registro)
                    <tr>
                        <td>
                            <a href="{{ route('auth.categoria.editar', $registro->slug) }}" class="btn">Editar</a>
                            <a href="{{ route('auth.categoria.deletar', $registro->slug) }}" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja deletar esta área de conhecimento?');">Deletar</a>
                        </td>
                        <td>{{ ucfirst($registro->nome) }}</td>
                        <td>{{ isset($registro->disciplina) ? ucfirst($registro->disciplina->nome) : 'Nenhum assunto' }}</td>

                    </tr>
                    @endforeach
                </tbody>
              </table>
          </div>
      </div>
@endsection
