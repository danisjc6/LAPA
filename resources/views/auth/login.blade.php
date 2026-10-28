@extends('layouts.app')

@section('titulo', 'Login')
@section('content')
    <div class="px-4 py-10">
        <div class="mx-auto w-full max-w-md">
            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm"> {{-- Header --}} <div
                    class="border-b border-slate-100 px-6 py-5">
                    <h1 class="text-2xl font-semibold text-slate-900">Entrar</h1>
                    <p class="mt-1 text-sm text-slate-600"> Acesse sua conta para agendar visitas e consultar materiais. </p>
                </div> {{-- Body --}} <div class="px-6 py-6">
                    <form method="POST" action="{{ route('login') }}" class="space-y-4">
                        @csrf

                        <x-ui.field name="email" label="Endereço de e-mail" required>
                            <div class="relative">
                                <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-slate-400">
                                    <i class="fa-regular fa-envelope"></i>
                                </span>

                                <x-ui.input
                                    name="email"
                                    type="email"
                                    :value="old('email')"
                                    autocomplete="email"
                                    placeholder="exemplo@exemplo.com"
                                    class="pl-10"
                                    required
                                />
                            </div>
                        </x-ui.field>
                       <x-ui.field name="password" label="Senha" required>
                            <div class="relative">
                                <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-slate-400" >
                                    <i class="fa-solid fa-lock"></i>
                                </span>

                                <x-ui.input
                                    name="password"
                                    type="password"
                                    autocomplete="current-password"
                                    placeholder="••••••••"
                                    class="pl-10"
                                    required
                                />
                            </div>
                        </x-ui.field>
                        {{-- Opções --}}
                        <div class="flex items-center justify-between gap-3">
                            <label class="inline-flex items-center gap-2 text-sm text-slate-700">
                                <input type="checkbox" name="remember" class="h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-slate-900/20">
                                Lembrar sessão </label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                    class="text-sm font-medium text-slate-900 hover:underline"> Esqueceu a senha? </a>
                            @endif
                        </div>
                        {{-- Botões --}}
                        <button type="submit" class="mt-2 inline-flex w-full items-center justify-center rounded-lg bg-green-800 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-4 focus:ring-green-700/20">
                            Entrar
                        </button>

                        <div class="relative py-2">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-slate-200"></div>
                            </div>
                            <div class="relative flex justify-center">
                                <span class="bg-white px-3 text-xs text-slate-500">ou</span>
                            </div>
                        </div>
                        <a href="{{ route('register') }}"
                            class="inline-flex w-full items-center justify-center rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-900 hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-slate-900/10">
                            Solicitar acesso
                        </a>
                    </form>
                </div>
            </div>
            <p class="mt-4 text-center text-xs text-slate-500"> Ao entrar, você concorda com os
                termos de uso e política de privacidade do sistema. </p>
        </div>
    </div>
@endsection
