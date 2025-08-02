@extends('layouts.app')

@section('titulo', 'Agendar visita')
@section('content')
        <div class="container col-11 col-md-10 col-lg-10">

            <div class="d-flex flex-wrap-reverse fadeInDown" data-anime="300">
                <form class="card px-5 pb-5 pt-4" id="form-busca" action="{{ route('site.visita.buscar.registro') }}" method="GET" enctype="multipart/form-data">
                    <h2 class="fadeInDown" data-anime="150">Agendamento de visitas</h2>
                    @csrf
                    <div class="form-group">
                        <label for="email" class="form-label">Digite seu email:</label>
                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{isset($user->email) ? $user->email: old('email')}}" required autocomplete="email" autofocus placeholder="Ex.: exemplo@exemplo.com">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <button form="form-busca" class="btn btn-success w-100">Iniciar solicitação</button>
                    </div>
                </>
            </div>
        </div>
@endsection