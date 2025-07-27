@extends('layouts.app')

<style>
    .login-card {
        display: flex;
        justify-content: center;
        align-items: center;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(12px);
        border-radius: 16px;
        min-height: 60vh;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        color: white;
        animation: fadeIn 1s ease-in;
    }
    input:focus, textarea:focus, select:focus {
        border-color: #00ad50 !important;
        box-shadow: 0 0 0 0.25rem rgba(0, 173, 80, 0.25) !important;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@section('titulo', 'Login')
@section('content')
<div class="container d-flex justify-content-center">
    <div class="card login-card w-50 py-5">
        <h1 class="mb-3">{{ __('Login') }} </h1>
        <form class="w-75" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group mb-3">
                <label for="email" class="form-label">{{ __('E-Mail Address') }}</label>
                <input id="email" type="email" placeholder="E-mail" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            </div>
            <div class="form-group">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input id="password" type="password" placeholder="Senha" class="form-control @error('email') is-invalid @enderror" name="password" required autocomplete="current-password" >
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>Verifique se seu e-mail e senha estão corretos</strong>
                    </span>
                @enderror
            </div>
            <div class="d-flex justify-content-between my-4">
                <div class="form-group text-left">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        {{ __('Lembrar sessão') }}
                    </label>
                </div>
                @if (Route::has('password.request'))
                    <a class="" href="{{ route('password.request') }}">
                    {{ __('Esqueceu a Senha?') }}
                    </a>
                @endif
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-success w-75">
                    {{ __('Login') }}
                </button>
            </div>
            <hr>
            @if (Route::has('register'))
            <div class="text-center mt-3">
                <a href="{{ route('register') }}" class="btn btn-outline-success">
                    {{ __('Solicitar acesso') }}
                </a>
            </div>
            @endif


        </form>
    </div>
</div>
@endsection