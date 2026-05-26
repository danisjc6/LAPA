@extends('layouts.app')

@section('titulo', 'Adicionar atla')
@section('content')
    <x-ui.section>
        <x-ui.form :action="route('auth.atla.salvar')" method="POST" enctype="multipart/form-data">
            <x-ui.form.header title="Adicionar página do atlas" />

            <x-ui.form.body>
                <x-ui.form.section>
                    <div class="">
                        <x-ui.field name="titulo" label="Título da página do atlas" required>
                            <x-ui.input name="titulo" value="{{ old('titulo') }}" placeholder="ex: Atlas olho mamífero" />
                        </x-ui.field>

                    </div>
                    <div class="">
                        <x-ui.field name="descricao" label="Descrição" required>
                            <x-ui.textarea name="descricao" required />
                            {{-- //{{ old('descricao') }} --}}
                        </x-ui.field>

                    </div>
                    <div class="">
                        <x-ui.field name="categoria_id" :required="true" label="Selecione a área de conhecimento">
                            <x-ui.select name="categoria_id" :required="true">
                                <option hidden disabled selected>Selecione uma área de conhecimento</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" @selected(old('categoria_id' == $categoria->id))>
                                        {{ ucfirst($categoria->nome) }}</option>
                                @endforeach
                            </x-ui.select>
                        </x-ui.field>
                    </div>

                    <div class="form-group">
                        <p>Área de conhecimento não cadastrada? <a class="text-subtitle"
                                href="{{ route('auth.categoria.adicionar') }}">
                                {{ __('Cadastrar Área de conhecimento') }}</a>.</p>
                    </div>
                    <div class="form-group mb-3" id="anexos">

                        <label for="anexos" class="form-label">Anexos</label>
                        <div class="row">
                            <div class="col-md-6">
                                <input class="form-control @error('descricao_anexos.1') is-invalid @enderror" type="text"
                                    name="descricao_anexos[]" placeholder="Descrição do anexo"
                                    value="{{ old('descricao_anexos.0') }}">
                            </div>
                            <div class="col-md-6">
                                <input class="form-control @error('anexos.1') is-invalid @enderror" type="file"
                                    name="anexos[]">
                            </div>
                        </div>


                        @for ($i = 0; isset(old('descricao_anexos')[$i]); $i++)
                            <div
                                class="row  {{ $errors->has('anexos.' . $i) || $errors->has('descricao_anexos.' . $i) ? 'is-invalid' : '' }}">
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
                </x-ui.form.section>
                <x-ui.form.actions>
                    <div class="d-flex justify-content-center gap-3 mt-4">
                        <input name="rascunho" type="submit" class="btn btn-primary" value="Salvar como rascunho">
                        <input name="publicar" type="submit" class="btn btn-success" value="Publicar agora">
                    </div>
                    </x-ui.actions>
            </x-ui.form.body>
        </x-ui.form>
    </x-ui.section>

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
