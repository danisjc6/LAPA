@extends('layouts.app')

@section('titulo', 'Editar Informações de Contato do Laboratório')
@section('content')
        <div class="container">
            <form class="card px-5 pb-5 pt-4" action="{{ route('auth.contato.atualizar', $registro->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <h2>Editar contato</h2>

                @include('auth.contato._form')
                <div class="input-btn">
                    <button class="btn btn-success">Salvar alterações</button>
                </div>
            </form>
        </div>
@endsection