@extends('layouts.app')
@section('titulo', 'Gerenciar - LAPA')

<style>
    .card {
      transition: transform 0.3s;
    }

    .card:hover {
      transform: translateY(-5px);
    }
</style>
@section('content')
<div class="container">

        <div class="d-flex justify-content-center gap-5">
            <a class="card text-success ratio ratio-1x1 w-25 rounded-4 shadow-lg border-0" href="{{ route('auth.postagens') }}">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <span class="fa fa-newspaper fa-4x pb-3"></span>
                    <h3 class="card-title">
                        {{ __('Postagens') }}
                    </h3>
                </div>

            </a>
            <a class="card text-success ratio ratio-1x1 w-25 rounded-4 shadow-lg border-0" href="{{ route('auth.atlas') }}">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <span class="fa fa-book-open fa-4x pb-3"></span>
                    <h3 class="card-title">
                        {{ __('Atlas') }}
                    </h3>
                </div>
            </a>
            <a class="card text-success ratio ratio-1x1 w-25 rounded-4 shadow-lg border-0" href="{{ route('auth.materiais') }}">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <span class="fa fa-file fa-4x pb-3"></span>
                    <h3 class="card-title">
                        {{ __('Materiais') }}
                    </h3>
                </div>
            </a>
            <a class="card text-success ratio ratio-1x1 w-25 rounded-4 shadow-lg border-0" href="{{ route('auth.visitas') }}">
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <span class="fa fa-id-card-alt fa-4x pb-3"></span>
                        <h3 class="card-title">
                            {{ __('Visitas') }}
                        </h3>
                    </div>

            </a>
        </div>
        <h3 class="w-100 mb-4 mt-5">Mais opções</h3>
        <div class="d-flex justify-contente-center gap-5">
            <a class="card text-success ratio ratio-1x1 w-25 rounded-4 shadow-lg border-0" href="{{ route('auth.disciplinas') }}">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <span class="fas fa-bookmark fa-4x pb-3"></span>
                    <h3 class="card-title text-center px-3">
                        {{ __('Assuntos (disciplinas)') }}
                    </h3>
                </div>

            </a>
            <a class="card text-success ratio ratio-1x1 w-25 rounded-4 shadow-lg border-0" href="{{ route('auth.categorias') }}">
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <span class="fa fa-list-ul fa-4x pb-3"></span>
                        <h3 class="card-title text-center">
                            {{ __('Áreas de conhecimento') }}
                        </h3>
                    </div>

            </a>
	        <a class="card text-success ratio ratio-1x1 w-25 rounded-4 shadow-lg border-0" href="{{ route('auth.acesso_gerenciamento') }}">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <span class="fa fa-check-circle fa-4x pb-3"></span>
                    <h3 class="card-title text-center">
                        {{ __('Solicitações de gerenciamento') }}
                    </h3>
                </div>
            </a>
            <a class="card text-success ratio ratio-1x1 w-25 rounded-4 shadow-lg border-0" href="{{ route('auth.contatos') }}">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <span class="fa fa-info-circle fa-4x pb-3"></span>
                    <h3 class="card-title text-center">
                        {{ __('Contatos do laboratório') }}
                    </h3>
                </div>

            </a>
         </div>
</div>
@endsection
