
<div class="form-group">
    <label for="nome">Nome da área de conhecimento*</label>
    <input {{ isset($registro->nome) ? 'readonly' : '' }} class="form-control form-control-lg @error('nome') is-invalid @enderror" type="text" name="nome" value="{{ isset($registro->nome) ?
																			$registro->nome : old('nome') }}" placeholder="ex: Sistema Nervoso">
    @error('nome')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <label for="disciplina_id">Selecione o assunto*</label>
    <select class="form-control @error('disciplina_id') is-invalid @enderror" name="disciplina_id" id="disciplinas">
        <option disabled selected value>{{ __('Clique para selecionar assunto') }}</option>
        @foreach($disciplinas as $disciplina)
            @if(isset($registro->disciplina->id) && $disciplina->id == $registro->disciplina->id)
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
<div class="form-group">
     <hr>
      <p>Assunto não cadastrado? <a class="" href="{{ route('auth.disciplina.adicionar') }}">{{ __('Cadastrar Assunto') }}</a>.</p>
</div>
