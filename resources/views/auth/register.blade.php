@extends('layouts.app')
@section('titulo', 'Registrar-se')

@section('content')
    <x-ui.section>
        <x-ui.form id="register" :action="route('register')" method="POST" enctype="multipart/form-data">
            <x-ui.form.header title="Cadastro"
                description="Por favor, preencha o formulário para solicitar acesso ao sistema." />

            <x-ui.form.body>
                <x-ui.form.section title="Foto de perfil">
                    <div class="flex items-center gap-4">
                        <div class="h-20 w-20 overflow-hidden rounded-full border border-slate-200 bg-slate-50">
                            <img
                                id="img-foto"
                                src="{{ isset($user?->avatar) ? asset($user->avatar) : 'https://placehold.co/160x160?text=Foto' }}"
                                alt="Prévia da foto"
                                class="h-full w-full object-cover"
                            >
                        </div>

                        <div class="flex-1">
                            <label class="block text-sm font-semibold text-slate-700">
                                Enviar arquivo de foto (opcional)
                            </label>
                            <input
                                type="file"
                                name="anexo_upload"
                                accept="image/png,image/jpeg,image/jpg,image/gif"
                                class="mt-2 block w-full text-sm text-slate-700
                                        file:mr-4 file:rounded-lg file:border-0 file:bg-slate-900 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white
                                        hover:file:bg-slate-800"
                                onchange="document.getElementById('img-foto').src = window.URL.createObjectURL(this.files[0])"
                            >
                            <p class="mt-2 text-xs text-slate-500">
                                Formatos aceitos: jpg, jpeg, png ou gif.
                            </p>

                            @error('avatar')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </x-ui.form.section>

                <x-ui.form.section title="Informações pessoais">
                    <x-ui.field name="nome" label="Nome" required>
                        <x-ui.input name="nome" required="true"/>
                    </x-ui.field>

                    <x-ui.field name="cpf" label="CPF" required>
                        <x-ui.input name="cpf" class="cpf" required="true"/>
                    </x-ui.field>

                    <x-ui.field name="email" label="E-mail" required>
                        <x-ui.input name="email"
                            required="true" autocomplete="email" type="email" placeholder="exemplo@exemplo.com" />
                    </x-ui.field>

                    <x-ui.field name="telefone" label="Telefone" required>
                        <x-ui.input name="telefone" class="telefone"
                            required="true" autocomplete="telefone" type="telefone" placeholder="(87) 99999-9999" />
                    </x-ui.field>

                    <x-ui.field name="link_lattes" label="Link Lattes">
                        <x-ui.input name="link_lattes"
                            autocomplete="link_lattes" type="text" placeholder="https://lattes.cnpq.br/..." />
                    </x-ui.field>
                </x-ui.form.section>
                @php($user = auth()->user())

                <x-ui.form.section title="Segurança">
                    <x-ui.field name="password" label="Senha" required>
                        <x-ui.input name="password" required="true"
                            type="password" />
                    </x-ui.field>

                    <x-ui.field name="password_confirmation" label="Confirmar Senha" required>
                        <x-ui.input name="password_confirmation" required="true"
                            type="password" />
                    </x-ui.field>
                </x-ui.form.section>


                {{-- Termos + ações --}}
                <div class="border-t border-slate-200 pt-6 space-y-4">
                    <p class="text-sm text-slate-600">
                        Criando uma conta você concorda com nossos
                        <a href="{{ route('termos') }}" class="font-semibold text-slate-900 hover:underline">
                            Termos & Privacidade
                        </a>.
                    </p>

                    <div class="flex flex-col-reverse gap-3 sm:flex-row sm:items-center sm:justify-between">
                        @if (Route::has('register'))
                            <p class="text-sm text-slate-600">
                                Já possui acesso? <a class="font-semibold text-slate-900 hover:underline" href="{{ route('login') }}">Acessar conta</a>.
                            </p>
                        @endif

                        <button
                            type="submit"
                            class="inline-flex justify-center rounded-lg bg-emerald-700 px-5 py-2.5 text-sm font-semibold text-white
                                    shadow-sm hover:bg-emerald-800 focus:outline-none focus:ring-4 focus:ring-emerald-700/20"
                        >
                            Solicitar
                        </button>
                    </div>
                </div>

            </x-ui.form.body>

        </x-ui.form>
    </x-ui.section>
    </section>
@endsection
