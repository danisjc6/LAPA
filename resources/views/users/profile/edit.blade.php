@extends('layouts.app')

@section('titulo', 'Atlas Interativo')

@section('content')

<div class="space-y-6 lg:space-y-8">
    {{-- Informações de perfil --}}
    <x-ui.section>
        <x-ui.form :action="route('profile.update')" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <x-ui.form.header title="Informações de Perfil" description="Atualize seus dados pessoais, informações de contato e foto de perfil." />
            <x-ui.form.body>
                <x-ui.form.section title="Foto de perfil">
                    <x-ui.image-upload name="foto_perfil" shape="circle" :src="$user->foto_perfil ? Storage::disk('public')->url($user->foto_perfil) : null" />
                </x-ui.form.section>
                <x-ui.form.section title="Informações pessoais">
                    <x-ui.field name="nome" label="Nome" required>
                        <x-ui.input name="nome" :value="$user->nome" autocomplete="name" required />
                    </x-ui.field>
                    <x-ui.field name="cpf" label="CPF" required>
                        <x-ui.input name="cpf" :value="$user->cpf" class="cpf" inputmode="numeric" required />
                    </x-ui.field>
                    <x-ui.field name="email" label="E-mail" required>
                        <x-ui.input name="email" type="email" :value="$user->email" autocomplete="email" placeholder="exemplo@exemplo.com" required />
                    </x-ui.field>
                    <x-ui.field name="telefone" label="Telefone" required>
                        <x-ui.input name="telefone" type="tel" :value="$user->telefone" autocomplete="tel" placeholder="(87) 99999-9999" required />
                    </x-ui.field>
                    <x-ui.field name="link_lattes" label="Link Lattes" hint="Informe o endereço completo do seu currículo na Plataforma Lattes.">
                        <x-ui.input name="link_lattes" type="url" :value="$user->link_lattes" autocomplete="url" placeholder="https://lattes.cnpq.br/..." />
                    </x-ui.field>
                </x-ui.form.section>
                <x-ui.form.actions>
                    <x-ui.button type="submit" size="lg">Salvar alterações</x-ui.button>
                </x-ui.form.actions>
            </x-ui.form.body>
        </x-ui.form>
    </x-ui.section>
    {{-- Segurança da conta --}}
    <x-ui.section>
        <x-ui.form :action="route('password.update')" method="POST">
            @csrf
            @method('PUT')
            <x-ui.form.header title="Segurança da Conta" description="Altere sua senha para manter o acesso à sua conta protegido." />
            <x-ui.form.body>
                <x-ui.field name="current_password" label="Senha atual" required>
                    <x-ui.input name="current_password" type="password" autocomplete="current-password" required />
                </x-ui.field>
                <x-ui.field name="password" label="Nova senha" required hint="Utilize uma senha forte, preferencialmente com 12 caracteres ou mais.">
                    <x-ui.input name="password" type="password" autocomplete="new-password" required />
                </x-ui.field>
                <x-ui.field name="password_confirmation" label="Confirmar nova senha" required>
                    <x-ui.input name="password_confirmation" type="password" autocomplete="new-password" required />
                </x-ui.field>
                <x-ui.form.actions>
                    <x-ui.button type="submit" variant="secondary" size="lg">Atualizar senha</x-ui.button>
                </x-ui.form.actions>
            </x-ui.form.body>
        </x-ui.form>
    </x-ui.section>
</div>

@endsection
