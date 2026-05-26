
<div class="form-group">
    <x-ui.field name="nome" label="Nome da área de conhecimento" :required="true">
        <x-ui.input name="nome" value="{{ isset($registro->nome) ? $registro->nome : old('nome') }}" placeholder="ex: Sistema Nervoso" />
    </x-ui.field>
</div>
<div class="form-group">
     <x-ui.field name="disciplina_id" :required="true" label="Selecione o assunto">
        <x-ui.select name="disciplina_id" :required="true">
            <option disabled selected value>{{ __('Clique para selecionar assunto') }}</option>

            @foreach($disciplinas as $disciplina)
                <option value="{{ $disciplina->id }}" @selected(old('disciplina_id', $registro->disciplina->id ?? ''))>{{ ucfirst($disciplina->nome) }}</option>
            @endforeach
        </x-ui.select>
    </x-ui.field>

</div>
<div class="form-group">
     <hr>
      <p>Assunto não cadastrado? <a class="" href="{{ route('auth.disciplina.adicionar') }}">{{ __('Cadastrar Assunto') }}</a>.</p>
</div>
