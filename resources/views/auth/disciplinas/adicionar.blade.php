@extends('layouts.app')

@section('titulo', 'Adicionar assunto')
@section('content')
        <div class="container">
            <form class="card px-5 pb-5 pt-4" action="{{ route('auth.disciplina.salvar') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h2>Adicionar assunto (disciplina)</h2>
                @include('auth.disciplinas._form')
                <div class="input-btn">
                    <button class="btn btn-success">Adicionar disciplina</button>
                </div>
            </form>
        </div>
@endsection