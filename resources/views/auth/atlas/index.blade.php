@extends('layouts.app')

@section('titulo', 'Gerenciar atlas')
@section('content')
        <div class="container">
            <h2>Gerenciar atlas</h2>
            <a href="{{ route('auth.atla.adicionar') }}" class="btn btn-sucess mb-2">Adicionar</a>

            <div class="d-sm-flex justify-content-between">
                @if(isset($filtros['categoria']) || isset($filtros['publicado']))
                    <p>Mostrando páginas por <strong>{{ $filtros['nomes'][1] ?? ''}}</strong> <strong>{{ $filtros['nomes'][0] ?? '' }}</strong>
                        <a class="btn btn-link align-self-start" href="{{ route('auth.atlas') }}">(Remover filtros)</a>
                    </p>
                @endif

                <div class="dropdown ml-auto mb-3">
                    <button class="btn dropdown-toggle" type="button" id="filtrarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Filtrar por
                    </button>
                    <div class="dropdown-menu dropdown-menu-right p-2 text-center" aria-labelledby="filtrarDropdown" style="min-width: 300px;">
                        <form action="{{ route('auth.atlas') }}" method="get">
                            @csrf
                            <div class="form-group mb-2">
                                <label for="">Status</label>
                                <select size="3" class="form-control" name="publicado" id="publicado">
                                    <option value="" {{ !isset($filtros['publicado']) ? 'selected' : '' }}>Todos</option>
                                    <option value="1" {{ isset($filtros['publicado']) && ($filtros['publicado'] == 1) ? 'selected' : '' }}>Publicados</option>
                                    <option value="0" {{ isset($filtros['publicado']) && ($filtros['publicado'] == 0) ? 'selected' : '' }}>Rascunhos</option>
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Categoria</label>
                                <select size="{{ isset($categorias) ? (count($categorias) + 1) : '' }}" class="form-control" name="categoria" id="categoria">
                                    <option value="" {{ !isset($filtros['categoria']) ? 'selected' : '' }}>Todas</option>
                                    @foreach ($categorias as $categoria)
                                        <option {{ isset($filtros['categoria']) && ($filtros['categoria'] == $categoria->id) ? 'selected' : '' }} value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <button class="btn align-self-start" type="submit">Filtrar</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-rounded table-hover shadow" >
                  <thead class="table-success">
                    <tr>
                        <th>Título</th>
                        <th>Área de conhecimento</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
               </thead>
                <tbody>
                    @if(isset($registros) && count($registros) > 0)
                        @foreach ($registros as $registro)
                            <tr>
                                <td>{{ $registro->titulo }}</td>
                                <td>{{ isset($registro->categoria) ? ucfirst($registro->categoria->nome) : 'Nenhuma área de conhecimento' }}</td>
                                <td>{{ $registro->publicado ? "Publicado" : "Rascunho" }}</td>
                                <td>
                                    <a href="{{ route('auth.atla.visualizar', $registro->slug) }}" class="btn btn-primary">Ver</a>
                                    <a href="{{ route('auth.atla.editar',$registro->slug) }}" class="btn btn-secondary">Editar</a>
                                    <a href="{{ route('auth.atla.deletar', $registro->slug) }}" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja deletar esse atla');">Deletar</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="text-center">Nenhum resultado em atlas encontrado</td>
                        </tr>
                    @endif
                </tbody>
              </table>
           </div>
       </div>
@endsection