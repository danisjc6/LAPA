@extends('layouts.app')

@section('titulo', 'Adicionar área de conhecimento')
@section('content')
 <x-ui.section>
        <x-ui.form :action="route('auth.categoria.salvar')" method="POST" enctype="multipart/form-data">
            <x-ui.form.header title="Adicionar área de conhecimento (categoria)" description="Adicione uma nova categoria." />

            <x-ui.form.body>
                @include('categorias._form')

                <x-ui.form.actions>
                    <div class="d-flex justify-content-center gap-3 mt-4">
                    <button class="btn btn-success">Adicionar</button>
                    </div>
                    </x-ui.actions>
            </x-ui.form.body>
        </x-ui.form>
    </x-ui.section>
@endsection
