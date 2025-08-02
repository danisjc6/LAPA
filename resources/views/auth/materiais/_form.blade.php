@if(isset($registro))
    <p>Essa página de material está <strong>{{ $registro->publicado ? 'publicada' : 'salva no rascunho' }}.</strong></p>
@endif
<div class="form-group">
    <label for="titulo">Título do Material*</label>
    <input class="form-control form-control-lg @error('titulo') is-invalid @enderror" type="text" name="titulo" value="{{ isset($registro->titulo) ? $registro->titulo : old('titulo') }}" placeholder="Ex.: Anatomia de mamíferos">
    @error('titulo')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <label for="texto">Texto*</label>
    <textarea id="summernote" class="form-control form-control-lg @error('texto') is-invalid @enderror" type="text" name="texto" placeholder="Ex.: Texto explicativo sobre o que foi mencionado no título.">{{ isset($registro->texto) ? $registro->texto : old('texto') }}</textarea>
    @error('texto')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <label for="user_id">Selecione o assunto*</label>
    <select class="form-control @error('disciplina_id') is-invalid @enderror" name="disciplina_id" id="disciplinas">
        <option hidden disabled selected value>{{ __('Selecione um assunto') }}</option>
        @foreach($disciplinas as $disciplina)
            @if(isset($registro->disciplina->id) && $disciplina->id == $registro->disciplina->id || old('disciplina_id') == $disciplina->id)
                <option value="{{ $disciplina->id }}" selected>{{ ucfirst($disciplina->nome) }}</option>
            @else
                <option value="{{ $disciplina->id }}">{{ ucfirst($disciplina->nome) }}</option>
            @endif
        @endforeach
    </select>
    @error('disciplina_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group" id="radio-group-anexo">
    <label class="@error('tipo_anexo') is-invalid @enderror @error('anexo_web') is-invalid @enderror @error('anexo_drive') is-invalid @enderror @error('anexo_upload') is-invalid @enderror">Escolher origem do material anexo*</label><br>
    <input type="radio" name="tipo_anexo" value="upload" id="upload-radio" {{ isset($registro) ? ($registro->tipo_anexo == 'upload' ? 'checked' : '') : ''}}>
    <label for="upload-radio">Enviar arquivo do dispositivo</label><br>
    <input type="radio" name="tipo_anexo" value="link_web" id="drive-radio" {{ isset($registro) ? ($registro->tipo_anexo == 'link_web' ? 'checked' : '') : '' }}>
    <label for="web-radio">Link de anexo do material</label>
    @if($errors->first('tipo_anexo') || $errors->first('anexo_upload') || $errors->first('anexo_web'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('tipo_anexo') | $errors->first('anexo_upload') | $errors->first('anexo_web')}}</strong>
        </span>
    @endif
</div>

<div class="form-group form-group-anime {{ isset($registro) ? 'show' : '' }}">
    <label id="upload" class="file-input w-100 input-anime {{ isset($registro) ? ($registro->tipo_anexo == 'upload' ? 'show' : '') : '' }}" for="anexo">
        <div class="d-flex flex-column text-center border rounded bg-white">
            <div class="file-header">
                <img height="200px" id="img-foto" src="{{ asset($registro->anexo ?? asset('img/file-image.svg')) }}" alt="" style="max-height: 200px">
            </div>
            <div class="file-label">
                <p>Escolher um arquivo para o anexo.</p>
            </div>
        </div>
        <input id="anexo" class="d-none form-control form-control-lg" type="file" name="anexo_upload" placeholder="Escolha um arquivo jpeg, jpg, png ou gif" onchange="document.getElementById('img-foto').src = window.URL.createObjectURL(this.files[0])">
    </label>
    <div id="link_web" class="web-link input-anime {{ isset($registro) ? ($registro->tipo_anexo == 'link_web' ? 'show' : '') : '' }}">
        <label>Link do anexo</label>
        <input type="text" class="form-control form-control-lg" name="anexo_web" placeholder="O link de anexo deve ser num formato de documento válido ex.: pdf, doc, png" value="{{ isset($registro->tipo_anexo) && $registro->tipo_anexo == 'link_web' ? $registro->anexo : old('anexo_web') }}">
    </div>
    @error('anexo')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
</ br>
<div class="form-group">
    <p>Assunto não cadastrado? <a class="" href="{{ route('auth.disciplina.adicionar') }}">{{ __('Cadastrar Assunto') }}</a>.</p>
</div>

@section('scripts')
  <!-- Script de mostrar/esconder campos de anexos -->
  <script src="{{ asset('js/toggle_anexo_material.js') }}"></script>
@endsection


