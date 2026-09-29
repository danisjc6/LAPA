@extends('layouts.app')

@section('titulo', 'Atlas Interativo')

@section('content')
 <x-ui.section>
        <x-ui.form :action="route('profile.update')" method="POST" enctype="multipart/form-data">
            @method('patch')
            <x-ui.form.header title="Informações de Perfil"
                description="Update your account's profile information and email address." />

            <x-ui.form.body>
                <x-ui.field name="nome" label="Nome" required>
                    <x-ui.input name="nome"
                        :value="$user->nome" />
                </x-ui.field>

                <x-ui.field name="cpf" label="CPF" required>
                    <x-ui.input name="cpf" class="cpf"
                        :value="$user->cpf" />
                </x-ui.field>

                <x-ui.field name="email" label="E-mail" required>
                    <x-ui.input name="email" :value="$user->email"
                        required="true" autocomplete="email" type="email" placeholder="exemplo@exemplo.com" />
                </x-ui.field>

                <x-ui.field name="telefone" label="Telefone" required>
                    <x-ui.input name="telefone" :value="$user->telefone"
                        required="true" autocomplete="telefone" type="telefone" placeholder="(87) 99999-9999" />
                </x-ui.field>

                <x-ui.field name="link_lattes" label="Link Lattes" required>
                    <x-ui.input name="link_lattes" :value="$user->link_lattes"
                        autocomplete="link_lattes" type="text" placeholder="https://lattes.cnpq.br/..." />
                </x-ui.field>

                <x-ui.form.actions>
                    <x-ui.button type="submit" :size="'lg'">
                        Salvar
                    </x-ui.button>
                </x-ui.actions>
            </x-ui.form.body>
        </x-ui.form>

        <x-ui.form :action="route('password.update')" method="POST">
            @method('put')
            <x-ui.form.header title="Atualização de Senha"
                description="Certifique-se de que sua conta esteja usando uma senha longa e aleatória para garantir a segurança." />

            <x-ui.form.body>
                <x-ui.field name="current_password" label="Senha Atual" required>
                    <x-ui.input name="current_password"
                        type="password" />
                </x-ui.field>

                <x-ui.field name="password" label="Nova Senha" required>
                    <x-ui.input name="password"
                        type="password" />
                </x-ui.field>

                <x-ui.field name="password_confirmation" label="Confirmar Nova Senha" required>
                    <x-ui.input name="password_confirmation"
                        type="password" />
                </x-ui.field>



                <x-ui.form.actions>
                    <x-ui.button type="submit" :variant="'secondary'" :size="'lg'">
                        Salvar
                    </x-ui.button>
                </x-ui.actions>
            </x-ui.form.body>
        </x-ui.form>
    </x-ui.section>
@endsection
