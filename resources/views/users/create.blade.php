@extends('layouts.app')

@section('titulo', 'Cadastrar usuário')

@section('content')
    <x-ui.section>
        <x-ui.form
            id="usuario-create"
            :action="route('users.store')"
            method="POST"
            enctype="multipart/form-data"
        >

            <x-ui.form.header
                title="Cadastrar usuário"
                description="Cadastre um novo usuário e defina o acesso ao sistema."
            />

            <x-ui.form.body>

                {{-- Foto --}}
                <x-ui.form.section title="Foto de perfil">
                    <x-ui.image-upload name="foto_perfil" shape="circle" />
                </x-ui.form.section>


                {{-- Dados pessoais --}}
                <x-ui.form.section title="Informações pessoais">

                    <x-ui.field
                        name="nome"
                        label="Nome"
                        required
                    >
                        <x-ui.input
                            name="nome"
                            :value="old('nome')"
                            required="true"
                        />
                    </x-ui.field>


                    <x-ui.field
                        name="cpf"
                        label="CPF"
                        required
                    >
                        <x-ui.input
                            name="cpf"
                            :value="old('cpf')"
                            class="cpf"
                            required="true"
                        />
                    </x-ui.field>


                    <x-ui.field
                        name="email"
                        label="E-mail"
                        required
                    >
                        <x-ui.input
                            name="email"
                            :value="old('email')"
                            type="email"
                            autocomplete="email"
                            placeholder="exemplo@exemplo.com"
                            required="true"
                        />
                    </x-ui.field>


                    <x-ui.field
                        name="telefone"
                        label="Telefone"
                        required
                    >
                        <x-ui.input
                            name="telefone"
                            :value="old('telefone')"
                            class="telefone"
                            placeholder="(87) 99999-9999"
                            required="true"
                        />
                    </x-ui.field>


                    <x-ui.field
                        name="link_lattes"
                        label="Link Lattes"
                    >
                        <x-ui.input
                            name="link_lattes"
                            :value="old('link_lattes')"
                            type="url"
                            placeholder="https://lattes.cnpq.br/..."
                        />
                    </x-ui.field>

                </x-ui.form.section>


                {{-- Acesso --}}
                <x-ui.form.section title="Acesso ao sistema">

                    <x-ui.field
                        name="status"
                        label="Status"
                        required
                    >
                        <x-ui.select
                            name="status"
                            required
                            placeholder="Selecione o status"
                        >
                            @foreach (\App\Enums\StatusUser::cases() as $status)
                                <x-ui.option :value="$status->value">
                                    {{ $status->label() }}
                                </x-ui.option>
                            @endforeach
                        </x-ui.select>
                    </x-ui.field>


                    <x-ui.field
                        name="password"
                        label="Senha"
                        required
                    >
                        <x-ui.input
                            name="password"
                            type="password"
                            autocomplete="new-password"
                            required="true"
                        />
                    </x-ui.field>


                    <x-ui.field
                        name="password_confirmation"
                        label="Confirmar senha"
                        required
                    >
                        <x-ui.input
                            name="password_confirmation"
                            type="password"
                            autocomplete="new-password"
                            required="true"
                        />
                    </x-ui.field>

                </x-ui.form.section>


                {{-- Ações --}}
                <div
                    class="
                        flex flex-col-reverse gap-3
                        border-t border-slate-200
                        pt-6
                        sm:flex-row
                        sm:items-center
                        sm:justify-end
                    "
                >

                    <a
                        href="{{ route('users.index') }}"
                        class="
                            inline-flex justify-center
                            rounded-lg
                            border border-slate-300
                            bg-white
                            px-5 py-2.5
                            text-sm font-semibold
                            text-slate-700
                            transition
                            hover:bg-slate-50
                        "
                    >
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="
                            inline-flex items-center justify-center gap-2
                            rounded-lg
                            bg-emerald-700
                            px-5 py-2.5
                            text-sm font-semibold
                            text-white
                            shadow-sm
                            transition
                            hover:bg-emerald-800
                            focus:outline-none
                            focus:ring-4
                            focus:ring-emerald-700/20
                        "
                    >
                        <i class="fa-solid fa-user-plus"></i>

                        Cadastrar usuário
                    </button>

                </div>

            </x-ui.form.body>

        </x-ui.form>
    </x-ui.section>
@endsection


@push('scripts')
    <script>
        document
            .getElementById('foto_perfil')
            .addEventListener('change', function () {
                const arquivo = this.files[0];

                if (!arquivo) {
                    return;
                }

                document.getElementById('img-foto').src =
                    URL.createObjectURL(arquivo);
            });
    </script>
@endpush
