@extends('layouts.app')
@section('titulo', 'Registrar-se')

@section('content')
    <x-ui.section>
        <x-ui.form id="register" :action="route('register')" method="POST" enctype="multipart/form-data">
            <x-ui.form.header title="Cadastro"
                description="Por favor, preencha o formulário para solicitar acesso ao sistema." />

            <x-ui.form.body>

                <x-ui.form.section title="Foto de perfil">
                    <x-ui.image-upload name="foto_perfil" shape="circle" />
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
                        <a href="#" class="font-semibold text-slate-900 hover:underline">
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
