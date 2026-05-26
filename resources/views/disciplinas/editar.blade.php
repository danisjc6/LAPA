@extends('layouts.app')

@section('titulo', 'Editar assunto')
@section('content')
        <div class="container">
            <h2>Editar assunto (disciplina)</h2>
            <form action="{{ route('auth.disciplina.atualizar', $registro->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('disciplinas._form')
                <div class="input-btn">
                    <button class="btn">Salvar alterações</button>
                </div>
            </form>
        </div>
@endsection
