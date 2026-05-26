@extends('layouts.app')
@section('titulo', 'Registrar-se')

@section('content')
<section class="bg-slate-100">
    <div class="mx-auto max-w-7xl px-6 py-12 lg:py-16">
        <div class="mx-auto w-full max-w-3xl">

            <form
                action="{{ route('register') }}"
                method="POST"
                enctype="multipart/form-data"
                class="rounded-xl border border-slate-200 bg-white shadow-sm"
            >
                @csrf

                {{-- Accent + Header --}}
                <div class="h-1.5 w-full rounded-t-xl bg-emerald-700"></div>
                <div class="px-7 py-6 border-b border-slate-200">
                    <h2 class="text-2xl font-bold tracking-tight text-slate-900">Cadastro</h2>
                    <p class="mt-1 text-sm text-slate-600">
                        Por favor, preencha o formulário para solicitar acesso ao sistema.
                    </p>
                </div>

                <div class="px-7 py-7 space-y-8">
                    @php($user = auth()->user())

                    {{-- =========================
                         Seção: Foto de perfil
                    ========================== --}}
                    <div class="space-y-3">
                        <h3 class="text-sm font-semibold uppercase tracking-wide text-slate-600">
                            Foto de perfil
                        </h3>

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
                    </div>

                    {{-- Divider --}}
                    <div class="border-t border-slate-200"></div>

                    {{-- =========================
                         Seção: Dados pessoais
                    ========================== --}}
                    <div>
                        <h3 class="text-sm font-semibold uppercase tracking-wide text-slate-600 mb-4">
                            Dados do solicitante
                        </h3>

                        <div class="grid gap-4 md:grid-cols-2">
                            {{-- Nome --}}
                            <div>
                                <label for="name" class="block text-sm font-semibold text-slate-700">
                                    Nome <span class="text-red-600">*</span>
                                </label>
                                <input
                                    id="name"
                                    type="text"
                                    name="name"
                                    value="{{ isset($user?->name) ? $user->name : old('name') }}"
                                    required
                                    autocomplete="name"
                                    class="mt-2 block w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-slate-900
                                           placeholder:text-slate-400 shadow-sm outline-none
                                           focus:border-emerald-700 focus:ring-2 focus:ring-emerald-700/15"
                                    placeholder="Ex.: Maria"
                                >
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- CPF --}}
                            <div>
                                <label for="cpf" class="block text-sm font-semibold text-slate-700">
                                    CPF <span class="text-red-600">*</span>
                                </label>
                                <input
                                    id="cpf"
                                    type="text"
                                    name="cpf"
                                    value="{{ isset($user?->cpf) ? $user->cpf : old('cpf') }}"
                                    required
                                    autocomplete="off"
                                    placeholder="Ex.: 123.456.789-10"
                                    {{ auth()->check() ? 'readonly' : '' }}
                                    class="cpf mt-2 block w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-slate-900
                                           placeholder:text-slate-400 shadow-sm outline-none
                                           focus:border-emerald-700 focus:ring-2 focus:ring-emerald-700/15
                                           {{ auth()->check() ? 'bg-slate-50 text-slate-700' : '' }}"
                                >
                                @error('cpf')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="md:col-span-2">
                                <label for="email" class="block text-sm font-semibold text-slate-700">
                                    E-mail <span class="text-red-600">*</span>
                                </label>
                                <input
                                    id="email"
                                    type="email"
                                    name="email"
                                    value="{{ isset($user?->email) ? $user->email : old('email') }}"
                                    required
                                    autocomplete="email"
                                    placeholder="Ex.: maria@gmail.com"
                                    {{ auth()->check() ? 'readonly' : '' }}
                                    class="mt-2 block w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-slate-900
                                           placeholder:text-slate-400 shadow-sm outline-none
                                           focus:border-emerald-700 focus:ring-2 focus:ring-emerald-700/15
                                           {{ auth()->check() ? 'bg-slate-50 text-slate-700' : '' }}"
                                >
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Descrição --}}
                            <div class="md:col-span-2">
                                <label for="user_description" class="block text-sm font-semibold text-slate-700">
                                    Descrição profissional <span class="text-slate-400">(opcional)</span>
                                </label>
                                <textarea
                                    id="user_description"
                                    name="user_description"
                                    rows="4"
                                    class="mt-2 block w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-slate-900
                                           placeholder:text-slate-400 shadow-sm outline-none
                                           focus:border-emerald-700 focus:ring-2 focus:ring-emerald-700/15"
                                    placeholder="Descreva sua área de atuação e experiência."
                                >{{ isset($user?->user_description) ? $user->user_description : old('user_description') }}</textarea>

                                @error('user_description')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Lattes --}}
                            <div class="md:col-span-2">
                                <label for="link_lattes" class="block text-sm font-semibold text-slate-700">
                                    Link do Lattes <span class="text-slate-400">(opcional)</span>
                                </label>
                                <input
                                    id="link_lattes"
                                    type="url"
                                    name="link_lattes"
                                    value="{{ isset($user?->link_lattes) ? $user->link_lattes : old('link_lattes') }}"
                                    class="mt-2 block w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-slate-900
                                           placeholder:text-slate-400 shadow-sm outline-none
                                           focus:border-emerald-700 focus:ring-2 focus:ring-emerald-700/15"
                                    placeholder="Cole o link do seu currículo Lattes"
                                >
                                @error('link_lattes')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- =========================
                         Seção: Senha (apenas guest)
                    ========================== --}}
                    @guest
                        <div class="border-t border-slate-200 pt-8">
                            <h3 class="text-sm font-semibold uppercase tracking-wide text-slate-600 mb-4">
                                Segurança
                            </h3>

                            <div class="grid gap-4 md:grid-cols-2">
                                <div class="md:col-span-2">
                                    <label for="password" class="block text-sm font-semibold text-slate-700">
                                        Senha <span class="text-red-600">*</span>
                                    </label>
                                    <input
                                        id="password"
                                        type="password"
                                        name="password"
                                        required
                                        autocomplete="new-password"
                                        class="mt-2 block w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-slate-900
                                               placeholder:text-slate-400 shadow-sm outline-none
                                               focus:border-emerald-700 focus:ring-2 focus:ring-emerald-700/15"
                                        placeholder="Use 6+ caracteres com letras, números e símbolos"
                                    >
                                    @error('password')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md:col-span-2">
                                    <label for="password-confirm" class="block text-sm font-semibold text-slate-700">
                                        Confirmar senha <span class="text-red-600">*</span>
                                    </label>
                                    <input
                                        id="password-confirm"
                                        type="password"
                                        name="password_confirmation"
                                        required
                                        autocomplete="new-password"
                                        class="mt-2 block w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-slate-900
                                               placeholder:text-slate-400 shadow-sm outline-none
                                               focus:border-emerald-700 focus:ring-2 focus:ring-emerald-700/15"
                                        placeholder="Repita a senha"
                                    >
                                    @error('password_confirmation')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    @endguest

                    {{-- reCAPTCHA --}}
                    <div class="border-t border-slate-200 pt-8">
                        <div class="g-recaptcha @error('g-recaptcha-response') ring-2 ring-red-500/30 rounded-md @enderror"
                             data-sitekey="{{ env('NOCAPTCHA_SITEKEY') }}"></div>

                        @error('g-recaptcha-response')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Termos + ações --}}
                    <div class="border-t border-slate-200 pt-6 space-y-4">
                        <p class="text-sm text-slate-600">
                            Criando uma conta você concorda com nossos
                            <a href="{{ route('termo.privacidade') }}" class="font-semibold text-slate-900 hover:underline">
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

                </div>
            </form>

        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="{{ asset('js/toggle_anexo_input.js') }}"></script>
@endpush
