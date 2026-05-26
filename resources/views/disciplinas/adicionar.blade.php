@extends('layouts.app')

@section('titulo', 'Adicionar assunto')
@section('content')
    <x-ui.section>
        <x-ui.form :action="route('auth.disciplina.salvar')" method="POST" enctype="multipart/form-data">
            <x-ui.form.header title="Adicionar assunto (disciplina)" description="Adicione novas disciplinas." />

            <x-ui.form.body>
                @include('disciplinas._form')

                <x-ui.form.actions>
                    <div class="d-flex justify-content-center gap-3 mt-4">
                        <button class="btn btn-success">Adicionar disciplina</button>
                    </div>
                    </x-ui.actions>
            </x-ui.form.body>
        </x-ui.form>
    </x-ui.section>
@endsection
