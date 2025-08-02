@extends('layouts.app')

@section('titulo', 'Adicionar postagem')
@section('content')
        <div class="container">
            <form class="card px-5 pb-5 pt-4" action="{{ route('auth.postagem.salvar') }}" method="POST" enctype="multipart/form-data">
                <h2>Adicionar postagem</h2>
                @csrf
                @include('auth.postagem._form')
                <div class="d-flex justify-content-center gap-3 mt-4">
                    <input name="rascunho" type="submit" class="btn btn-primary" value="Salvar como rascunho">
                    <input name="publicar" type="submit" class="btn btn-success" value="Publicar agora">
                </div>
            </form>
        </div>
@endsection