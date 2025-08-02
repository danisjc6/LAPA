<div class="form-group mb-3">
    <label for="email" class="form-label">Email do laboratório*</label>
    <input class="form-control form-control-lg {{ $errors->has('email') ? 'error' : '' }}" type="text" name="email" value="{{ isset($registro->email) ? $registro->email : old('email') }}" placeholder="Ex.: laboratorio@ufape.com">
    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group mb-3">
    <label for="texto" class="form-label">Descrição - Quem Somos*</label>
    <textarea rows="7" class="form-control form-control-lg {{ $errors->has('texto') ? 'error' : '' }}" type="text" name="texto" placeholder="Escreva aqui quem são as pessoas que participam ativamente do laboratorio">{{ isset($registro->texto) ? $registro->texto : old('texto') }}</textarea>
    @error('texto')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group mb-3">
    <label for="telefone" class="form-label">Telefone para contato do laboratório</label>
    <input class=" form-control form-control-lg {{ $errors->has('telefone') ? 'error' : '' }} telefone" type="text" name="telefone" value="{{ isset($registro->telefone) ? $registro->telefone : old('telefone') }}" placeholder="Ex.: (88) 999991111">
    @error('telefone')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<h3>Redes sociais</h3>
<div class="form-group mb-3">
    <label for="instagram" class="form-label">Instagram</label>
    <input class="form-control form-control-lg @error('instagram') is-invalid @enderror" type="text" name="instagram" value="{{ isset($registro->instagram) ? $registro->instagram : old('instagram') }}" placeholder="Ex.: https://instagram.com/lapaUFAPE">
    @error('instagram')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group mb-3">
    <label for="twitter" class="form-label">Twitter</label>
    <input  class="form-control form-control-lg @error('twitter') is-invalid @enderror"type="text" name="twitter" value="{{ isset($registro->twitter) ? $registro->twitter : old('twitter') }}" placeholder="Ex.: https://twitter.com/lapaUFAPE">
    @error('twitter')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group mb-3">
    <label for="facebook" class="form-label">Facebook</label>
    <input class="form-control form-control-lg @error('facebook') is-invalid @enderror" type="text" name="facebook" value="{{ isset($registro->facebook) ? $registro->facebook : old('facebook') }}" placeholder="Ex.: https://facebook.com/lapaUFAPE">
    @error('facebook')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>