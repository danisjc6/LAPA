<div class="form-group">
    <x-ui.field name="nome" label="Nome do assunto" :required="true">
        <x-ui.input name="nome" value="{{ isset($registro->nome) ? $registro->nome : old('nome') }}" placeholder="ex: Histologia Veterinária"/>
    </x-ui.field>
</div>
<div class="form-group">
    <x-ui.field name="user_id" :required="true" label="Selecione um professor">
        <x-ui.select name="user_id" :required="true">
            <option hidden disabled value>Clique para selecionar professor</option>
            <option value>Nenhum</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" @selected(old('user_id') === (string)$user->id)>
                    {{ $user->name }}
                </option>
            @endforeach
        </x-ui.select>
    </x-ui.field>

</div>
