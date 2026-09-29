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

                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center">

                        <div
                            class="
                                flex h-20 w-20 shrink-0 items-center justify-center
                                overflow-hidden rounded-full
                                border border-slate-200
                                bg-slate-100
                                text-slate-400
                            "
                        >
                            <img
                                id="img-foto"
                                src="{{ asset('images/default-avatar.png') }}"
                                alt="Prévia da foto de perfil"
                                class="h-full w-full object-cover"
                            >
                        </div>

                        <div class="flex-1">

                            <label
                                for="foto_perfil"
                                class="block text-sm font-semibold text-slate-700"
                            >
                                Selecionar foto
                            </label>

                            <input
                                id="foto_perfil"
                                type="file"
                                name="foto_perfil"
                                accept="image/png,image/jpeg,image/webp"
                                class="
                                    mt-2 block w-full text-sm text-slate-600

                                    file:mr-4
                                    file:cursor-pointer
                                    file:rounded-lg
                                    file:border-0
                                    file:bg-slate-900
                                    file:px-4
                                    file:py-2
                                    file:text-sm
                                    file:font-semibold
                                    file:text-white

                                    hover:file:bg-slate-800
                                "
                            >

                            <p class="mt-2 text-xs text-slate-500">
                                JPG, PNG ou WEBP. Tamanho máximo de 2 MB.
                            </p>

                            @error('foto_perfil')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>

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
