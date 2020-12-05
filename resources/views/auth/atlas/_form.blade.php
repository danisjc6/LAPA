@if(isset($registro))
    <p>Essa página do atlas está <strong>{{ $registro->publicado ? 'publicada' : 'salva no rascunho' }}.</strong></p>
@endif

<div class="form-group">
    <label for="titulo">Título da página do atlas*</label>
    <input class="form-control form-control-lg @error('titulo') is-invalid @enderror" type="text" name="titulo" value="{{ isset($registro->titulo) ? $registro->titulo : old('titulo') }}" placeholder="ex: Atlas olho mamífero">
    @error('titulo')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <label for="descricao">Descrição*</label>
    <textarea rows="14" id="summernote_atlas" class="form-control form-control-lg @error('descricao') is-invalid @enderror" type="text" name="descricao" autocomplete="descricao">{{ isset($registro->descricao) ? $registro->descricao : old('descricao') }}</textarea>
    @error('descricao')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <label for="categoria_id">Selecione a área de conhecimento*</label>
    <select class="custom-select custom-select-lg @error('categoria_id') is-invalid @enderror" name="categoria_id" id="categorias">
        <option hidden disabled selected value>{{ __('Selecione uma área de conhecimento') }}</option>
        @foreach($categorias as $categoria)
            @if((isset($registro->categoria->id) && $categoria->id == $registro->categoria->id) || old('categoria_id') == $categoria->id) 
                <option value="{{ $categoria->id }}" selected>{{ ucfirst($categoria->nome) }}</option>
            @else
                <option value="{{ $categoria->id }}">{{ ucfirst($categoria->nome) }}</option>
            @endif
        @endforeach
    </select>
    @error('categoria_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group">
    <p>Área de conhecimento não cadastrada? <a class="" href="{{ route('auth.categoria.adicionar') }}">{{ __('Cadastrar Área de conhecimento') }}</a>.</p>
</div>

<div class="form-group" id="anexos">
    @if (isset($registro))
        @php
            $anexos = App\Anexo::where('atla_id', $registro->id)->get();
        @endphp
    @endif

    <label for="anexos">Anexos*</label>
    <div class="row mx-0 mb-2 anexo-field" id="anexoClone" style="display: none;">
        <input class="form-control form-control-lg col-md-6" type="text" placeholder="Descrição do anexo">
        <input class="form-control form-control-lg col-md-6" type="file">
    </div>
    <div class="row mx-0 mb-2 anexo-field">
        
        @if(!isset($anexos))
            <input class="form-control form-control-lg col-md-6 {{ $errors->has('descricao_anexos.1') ? 'error' : '' }}" type="text" name="descricao_anexos[]" placeholder="Descrição do anexo" value="{{ old('descricao_anexos.0') }}">
            <input class="form-control form-control-lg col-md-6 {{ $errors->has('anexos.1') ? 'error' : '' }}" type="file" name="anexos[]">
        @elseif(isset($anexos[0]))
            <input class="form-control form-control-lg col-md-9" type="text" placeholder="Descrição do anexo" value="{{ isset($anexos[0]->descricao) ? $anexos[0]->descricao : '' }}" disabled>
            <img class="upload-small" src="{{ asset($anexos[0]->foto) }}" alt="{{ $anexos[0]->descricao }}">
            <a href="{{ route('auth.anexo.deletar', $anexos[0]->id) }}" onclick="return confirm('Tem certeza que deseja deletar essa foto?');" class="btn btn-danger" title="Deletar anexo">
                <span class="fas fa-trash"></span>
            </a>
        @else
            <p>Nenhum anexo, clique no botão + para adicionar anexos.</p>
        @endif
    </div>
    @if(isset($anexos))
        @for($i = 1; $i < count($anexos); $i++)
            <div class="row mx-0 mb-2 anexo-field">
                <input class="form-control form-control-lg col-md-9" disabled type="text" placeholder="Descrição do anexo" value="{{ isset($anexos[$i]->descricao) ? $anexos[$i]->descricao : old('descricao_anexos.'.$i) }}">
                <img class="upload-small" src="{{ asset($anexos[$i]->foto) }}" alt="{{ $anexos[$i]->descricao }}">
                <a href="{{ route('auth.anexo.deletar', $anexos[$i]->id) }}" onclick="return confirm('Tem certeza que deseja deletar essa foto?');" class="btn btn-danger" title="Deletar anexo">
                    <span class="fas fa-trash"></span>
                </a>
            </div>
        @endfor
    @endif

    {{-- @dd($errors) --}}
    @for ($i = 0; isset(old('descricao_anexos')[$i]); $i++)
        <div class="row mx-0 mb-2 {{ $errors->has('anexos.'.$i) || $errors->has('descricao_anexos.'.$i) ? 'is-invalid' : '' }}">
            <input class="form-control form-control-lg col-md-6 {{ $errors->has('descricao_anexos.'.$i) ? 'is-invalid' : '' }}" type="text" name="descricao_anexos[]" placeholder="Descrição do anexo" value="{{ isset($registro->opcao[$i]) ? $registro->opcao[$i]->nome : old('descricao_anexos.'.$i) }}">
            <input class="form-control form-control-lg col-md-6 {{ $errors->has('anexos.'.$i) ? 'is-invalid' : '' }}" type="file" name="anexos[]" id="">
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
<div class="input-btn border-bottom pb-4 mb-4">
    <button type="button" class="btn" id="maisAnexos" title="Mais anexos">
        <span class="fa fa-plus"></span>
    </button>
</div>

@section('scripts')

    <script>
        document.getElementById("maisAnexos").addEventListener("click", function() {
            var opcao = document.getElementById("anexoClone").cloneNode(true);
            opcao.children[0].value = "";
            opcao.children[0].name = "descricao_anexos[]";
            opcao.children[1].name = "anexos[]";
            opcao.style = "display: flex";
            document.querySelector("#anexos").appendChild(opcao);
        });
    </script>

@endsection
