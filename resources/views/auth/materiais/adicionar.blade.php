@extends('layouts.app')

@section('titulo', 'Adicionar Material')
@section('content')
        <div class="container">
            <form class="card px-5 pb-5 pt-4" action="{{ route('auth.material.salvar') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h2>Adicionar Material</h2>
                @include('auth.materiais._form')
                <div class="d-flex justify-content-center gap-3">
                    <input name="rascunho" type="submit" class="btn btn-primary" value="Salvar como rascunho">
                    <input name="publicar" type="submit" class="btn btn-success" value="Publicar agora">
                </div>
            </form>

        </div>
@endsection