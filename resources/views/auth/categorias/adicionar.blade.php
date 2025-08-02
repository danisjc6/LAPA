@extends('layouts.app')

@section('titulo', 'Adicionar área de conhecimento')
@section('content')
        <div class="container">
            <form class="card px-5 pb-5 pt-4" action="{{ route('auth.categoria.salvar') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h2>Adicionar área de conhecimento (categoria)</h2>
                @include('auth.categorias._form')
                <div class="input-btn">
                    <button class="btn btn-success">Adicionar</button>
                </div>
            </form>
        </div>
@endsection