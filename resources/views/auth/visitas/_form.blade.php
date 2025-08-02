
<div class="form-group">
    <h4>Informações do responsável pela visita</h4>
    <div class="form-group mb-3">
        <label for="name" class="form-label">Nome:</label>
        <input id="name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name" value="{{isset($userExiste->name) ? $userExiste->name : old('name')}}" required autocomplete="name" autofocus
        {{ isset($userExiste->name) ? 'readonly' : ''}}>
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group mb-3">
        <label for="cpf" class="form-label">CPF:</label>
        <input id="cpf" type="text" class="cpf form-control form-control-lg @error('cpf') is-invalid @enderror" name="cpf" value="{{isset($userExiste->cpf) ? $userExiste->cpf :old('cpf')}}" required autocomplete="cpf" autofocus placeholder="Ex.: 123.456.789.10"
        {{ isset($userExiste->cpf) ? 'readonly' : ''}}>
            @error('cpf')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group mb-3">
        <label for="email" class="form-label">E-mail:</label>
        <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{isset($email) ? $email: old('email')}}" required autocomplete="email" autofocus placeholder="exemplo@exemplo.com"
        {{ isset($email) ? 'readonly' : ''}}>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group mb-3">
        <label for="telephone" class="form-label">Telefone:</label>
        <input id="telephone" type="text" class="telefone form-control form-control-lg @error('telephone') is-invalid @enderror" name="telephone" value="{{isset($userExiste->telephone) ? $userExiste->telephone: old('telephone')}}" required autofocus placeholder="Ex. (81)99999-9999">
        @error('telephone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <h4>Informações da visita</h4>
</div>
<div class="form-group mb-3">
    <label for="data" class="form-label">Data:</label>
    <input id="data" type="date" name="data" class="form-control @error('data') is-invalid @enderror" value="{{ isset($registro->data) ? $registro->data : old('data') }}" placeholder="Ex.: 01/01/2019" required>
    @error('data')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="d-flex flex-row mb-3">
    <div class="form-group mr-5 w-100">
        <label for="hora_inicial" class="form-label">Hora de início:</label>
        <input class="form-control @error('hora_inicial')'is-invalid' @enderror" type="time" name="hora_inicial" id="hora_inicial">

        @error('hora_inicial')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group w-100">
        <label for="hora_final" class="form-label">Hora de fim:</label>
        <input type="time" name="hora_final" class="form-control @error('hora_final') is-invalid @enderror">

        @error('hora_final')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group mb-3">
    <label for="descricao" class="form-label">Descrição:</label>
    <textarea name="descricao" class="form-control @error('descricao') is-invalid @enderror" type="text" placeholder="Mínimo de 10 caracteres." required>{{ isset($registro->descricao) ? $registro->descricao : old('descricao') }}</textarea>
    @error('descricao')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <div class="g-recaptcha @error('g-recaptcha-response') is-invalid @enderror" data-sitekey="{{ env('NOCAPTCHA_SITEKEY') }}"></div>
         @error ('g-recaptcha-response')
              <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
              </span>
        @enderror
</div>
@if (Auth::user())
    <label class="input-checkbox d-flex justify-content-start" for="confirmada">Criar esta visita já confirmada? &nbsp;
        <input type="checkbox" name="confirmada" {{ isset($registro->confirmada) && $registro->confirmada == true ? 'checked' : ''}} value="true">
        <span class="checkmark"></span>
    </label>

    @error('confirmada')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
    @enderror

    <div class="justify-content-center">
        <p>Agendando uma visita você concorda com nossos <a href="{{ route('termo.privacidade') }}">Termos & Privacidade</a>.</p>
    </div>
@endif

