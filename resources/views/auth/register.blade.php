@extends('layouts.app')
@section('titulo', 'Registrar-se')
@section('content')
<div class="container">
    <form class="card px-5 pb-5 pt-4" action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h2>Cadastro</h2>
        <p class="small">Por favor preencha o formulário para Solicitar acesso ao sistema.</p>
        @include('auth.registros._form')
        <div class="form-group">
            <div class="g-recaptcha{{$errors->has('g-recaptcha-response') ? ' has-error' : '' }}" data-sitekey="{{ env('NOCAPTCHA_SITEKEY') }}"></div>

            @if ($errors->has('g-recaptcha-response'))
                <span class="invalid-feedback" style="display: block;">
                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                </span>
            @endif

        </div>
        <p>Criando uma conta você concorda com nossos <a href="{{ route('termo.privacidade') }}">Termos & Privacidade</a>.</p>
        <button type="submit" class="registerbtn btn btn-success">Solicitar</button>
        <hr>

        @if (Route::has('register'))
            <p>Já possui acesso ao sistema? <a class="" href="{{ route('login') }}">{{ __('Acessar conta') }}</a>.</p>
        @endif

    </form>
</div>
@endsection

