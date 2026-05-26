@extends('layouts.app')

@section('titulo', 'Editar área de conhecimento')
@section('content')
        <div class="container">
            <h2>Editar área de conhecimento (categoria)</h2>
            <form action="{{ route('auth.categoria.atualizar', $registro->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('categorias._form')
                <div class="input-btn">
                    <button class="btn">Editar</button>
                </div>
            </form>
        </div>
@endsection
