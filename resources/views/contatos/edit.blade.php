@extends('layouts.app')

@section('titulo', 'Informações de Contato do Laboratório')
@section('content')
    <x-ui.section>
        <x-ui.form :action="route('contatos.update')" method="POST" enctype="multipart/form-data">
            @method('PUT')

            <x-ui.form.header title="Editar Informações de Contato do LAPA" description="Edite informações de contato." />

            <x-ui.form.body>
                @include('contatos._form')

                <x-ui.form.actions>
                    <div class="d-flex justify-content-center gap-3 mt-4">
                        <button type="submit"
                            class=" inline-flex items-center justify-center gap-2 rounded-lg
                            bg-emerald-700 px-5 py-2.5 text-sm font-semibold text-white shadow-sm
                            transition hover:bg-emerald-800 focus:outline-none
                            focus:ring-4 focus:ring-emerald-700/20">
                            Editar contato
                        </button>

                    </div>
                    </x-ui.actions>
            </x-ui.form.body>
        </x-ui.form>
    </x-ui.section>
@endsection
