@extends('layouts.app')

@section('titulo', 'Editar usuário')

@section('content')
    <x-ui.section>

        <x-ui.form
            id="usuario-edit"
            :action="route('users.update', $user)"
            method="PUT"
            enctype="multipart/form-data"
        >
            <x-ui.form.header
                title="Editar usuário"
                description="Atualize as informações e o acesso do usuário ao sistema."
            />

            <x-ui.form.body>

                {{-- Foto --}}
                <x-ui.form.section title="Foto de perfil">
                    <x-ui.image-upload name="foto_perfil" shape="circle" :src="$user->foto_url" />
                </x-ui.form.section>


                {{-- Informações pessoais --}}
                <x-ui.form.section title="Informações pessoais">

                    <x-ui.field
                        name="nome"
                        label="Nome"
                        required
                    >
                        <x-ui.input
                            name="nome"
                            :value="old('nome', $user->nome)"
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
                            :value="old('cpf', $user->cpf)"
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
                            :value="old('email', $user->email)"
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
                            :value="old('telefone', $user->telefone)"
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
                            :value="old('link_lattes', $user->link_lattes)"
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
                            :selected="$user->status"
                        >
                            @foreach (\App\Enums\StatusUser::cases() as $status)
                                <x-ui.option :value="$status->value">
                                    {{ $status->label() }}
                                </x-ui.option>
                            @endforeach
                        </x-ui.select>
                    </x-ui.field>

                </x-ui.form.section>


                {{-- Segurança --}}
                <x-ui.form.section title="Segurança">

                    <div
                        class="
                            mb-5 rounded-lg
                            border border-slate-200
                            bg-slate-50
                            px-4 py-3
                        "
                    >
                        <div class="flex gap-3">
                            <i class="fa-solid fa-circle-info mt-0.5 text-slate-400"></i>

                            <p class="text-sm text-slate-600">
                                Deixe os campos de senha em branco para manter
                                a senha atual do usuário.
                            </p>
                        </div>
                    </div>

                    <x-ui.field
                        name="password"
                        label="Nova senha"
                    >
                        <x-ui.input
                            name="password"
                            type="password"
                            autocomplete="new-password"
                        />
                    </x-ui.field>


                    <x-ui.field
                        name="password_confirmation"
                        label="Confirmar nova senha"
                    >
                        <x-ui.input
                            name="password_confirmation"
                            type="password"
                            autocomplete="new-password"
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
                        <i class="fa-solid fa-check"></i>

                        Salvar alterações
                    </button>
                </div>

            </x-ui.form.body>

        </x-ui.form>

    </x-ui.section>
@endsection


@push('scripts')
    <script>
        const inputFoto = document.getElementById('foto_perfil');
        const imgFoto = document.getElementById('img-foto');

        inputFoto.addEventListener('change', function () {
            const arquivo = this.files[0];

            if (!arquivo) {
                return;
            }

            imgFoto.src = URL.createObjectURL(arquivo);
        });
    </script>
@endpush
