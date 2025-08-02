@extends('layouts.app')

@section('titulo', 'Adicionar atla')
@section('content')
    <div class="container">
        <form class="card px-5 pb-5 pt-4" action="{{ route('auth.atla.salvar') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h2 class="mb-4">Adicionar página do atlas</h2>

            <div class="form-group mb-3">
                <label for="titulo" class="form-label">Título da página do atlas</label>
                <input class="form-control @error('titulo') is-invalid @enderror" type="text" name="titulo"
                    value="{{ old('titulo') }}" placeholder="ex: Atlas olho mamífero">

                @error('titulo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="descricao" class="form-label">Descrição*</label>
                <textarea rows="14" id="summernote_atlas"
                    class="form-control @error('descricao') is-invalid @enderror" type="text" name="descricao"
                    autocomplete="descricao">{{ old('descricao') }}</textarea>

                @error('descricao')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="categoria_id" class="form-label">Selecione a área de conhecimento</label>
                <select class="form-control @error('categoria_id') is-invalid @enderror"
                    name="categoria_id" id="categorias">
                    <option hidden disabled selected>{{ __('Selecione uma área de conhecimento') }}</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" @selected(old('categoria_id' == $categoria->id))>{{ ucfirst($categoria->nome) }}</option>
                        @endforeach
                </select>

                @error('categoria_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <p>Área de conhecimento não cadastrada? <a class="text-subtitle" href="{{ route('auth.categoria.adicionar') }}">
                    {{ __('Cadastrar Área de conhecimento') }}</a>.</p>
            </div>

            <div class="form-group mb-3" id="anexos">

                <label for="anexos" class="form-label">Anexos</label>
                <div class="row">
                    <div class="col-md-6">
                        <input class="form-control @error('descricao_anexos.1') is-invalid @enderror"
                            type="text" name="descricao_anexos[]" placeholder="Descrição do anexo"
                            value="{{ old('descricao_anexos.0') }}">
                    </div>
                    <div class="col-md-6">
                        <input class="form-control @error('anexos.1') is-invalid @enderror"
                            type="file" name="anexos[]">
                    </div>
                </div>


                @for ($i = 0; isset(old('descricao_anexos')[$i]); $i++)
                    <div class="row  {{ $errors->has('anexos.' . $i) || $errors->has('descricao_anexos.' . $i) ? 'is-invalid' : '' }}">
                        <input class="col-md-6 {{ $errors->has('descricao_anexos.' . $i) ? 'is-invalid' : '' }}"
                            type="text" name="descricao_anexos[]" placeholder="Descrição do anexo"
                            value="{{ isset($registro->opcao[$i]) ? $registro->opcao[$i]->nome : old('descricao_anexos.' . $i) }}">
                        <input class="col-md-6 {{ $errors->has('anexos.' . $i) ? 'is-invalid' : '' }}"
                            type="file" name="anexos[]" id="">
                    </div>
                @endfor

                @error('descricao_anexos.*')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                @error('anexos.*')
                    <div class="is-invalid"></div>
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="text-center">
                <button type="button" class="btn btn-success" id="maisAnexos" title="Mais anexos">
                    <span class="fa fa-plus"></span>
                </button>
            </div>

            <hr class="border-bottom my-5">

            <div class="d-flex justify-content-center gap-3">
                <input name="rascunho" type="submit" class="btn btn-primary" value="Salvar como rascunho">
                <input name="publicar" type="submit" class="btn btn-success" value="Publicar agora">
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            document.getElementById("maisAnexos").addEventListener("click", function() {
                let html = `<div class="row">
                    <div class="col-md-6">
                        <input class="form-control @error('descricao_anexos.1') is-invalid @enderror"
                            type="text" name="descricao_anexos[]" placeholder="Descrição do anexo"
                            value="{{ old('descricao_anexos.0') }}">
                    </div>
                    <div class="col-md-6">
                        <input class="form-control @error('anexos.1') is-invalid @enderror"
                            type="file" name="anexos[]">
                    </div>
                </div>`
                var opcao = document.getElementById("anexoClone").cloneNode(true);
                opcao.children[0].value = "";
                opcao.children[0].name = "descricao_anexos[]";
                opcao.children[1].name = "anexos[]";
                opcao.style = "display: flex";
                document.querySelector("#anexos").appendChild(opcao);
            });
        </script>
    @endpush
@endsection
