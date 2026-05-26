@extends('layouts.app')

@section('titulo', 'Informações do Contato Laboratório')
@section('content')
    <x-ui.section>
        <x-ui.form :action="route('auth.contato.salvar')" method="POST" enctype="multipart/form-data">
            <x-ui.form.header title="Adicionar Informações de Contato do LAPA"
                description="Adicione informações de contato." />

            <x-ui.form.body>
                @include('auth.contato._form')

                <x-ui.form.actions>
                    <div class="d-flex justify-content-center gap-3 mt-4">
                        <button class="btn">Salvar</button>

                    </div>
                    </x-ui.actions>
            </x-ui.form.body>
        </x-ui.form>
    </x-ui.section>
@endsection
