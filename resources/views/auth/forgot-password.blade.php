<x-layouts.guest>
    <div class="w-full max-w-md">
        <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">

            {{-- Cabeçalho --}}
            <div class="mb-8 text-center">
                <div
                    class="mx-auto mb-5 flex h-14 w-14 items-center
                           justify-center rounded-2xl bg-green-50 text-green-700"
                >
                    <i class="fa-solid fa-key text-xl"></i>
                </div>

                <h1 class="text-2xl font-bold tracking-tight text-slate-900">
                    Recuperar senha
                </h1>

                <p class="mt-3 text-sm leading-6 text-slate-500">
                    Informe seu e-mail para receber as instruções
                    de recuperação de senha.
                </p>
            </div>

            {{-- Mensagem de sucesso --}}
            @if (session('status'))
                <div
                    class="mb-6 flex items-start gap-3 rounded-xl
                           border border-green-200 bg-green-50 p-4"
                >
                    <i class="fa-solid fa-circle-check mt-0.5 text-green-700"></i>

                    <p class="text-sm text-green-800">
                        {{ session('status') }}
                    </p>
                </div>
            @endif

            {{-- Formulário --}}
            <form
                method="POST"
                action="{{ route('password.email') }}"
                class="space-y-5"
            >
                @csrf

                <div>
                    <label
                        for="email"
                        class="mb-2 block text-sm font-medium text-slate-700"
                    >
                        E-mail
                    </label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="seuemail@exemplo.com"
                        autocomplete="email"
                        required
                        autofocus
                        @class([
                            'w-full rounded-xl border bg-white px-4 py-3',
                            'text-sm text-slate-900 placeholder:text-slate-400',
                            'outline-none transition-colors',
                            'focus:border-green-600 focus:ring-2 focus:ring-green-600/10',
                            'border-red-400' => $errors->has('email'),
                            'border-slate-200' => !$errors->has('email'),
                        ])
                    >

                    @error('email')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <button
                    type="submit"
                    class="flex w-full cursor-pointer items-center
                           justify-center rounded-xl bg-green-700
                           px-5 py-3 text-sm font-semibold text-white
                           transition-colors hover:bg-green-800
                           focus-visible:outline-none focus-visible:ring-2
                           focus-visible:ring-green-600
                           focus-visible:ring-offset-2"
                >
                    Enviar link de recuperação
                </button>
            </form>

            {{-- Voltar --}}
            <div class="mt-7 text-center">
                <a
                    href="{{ route('login') }}"
                    class="inline-flex items-center gap-2 text-sm
                           font-medium text-slate-500 transition-colors
                           hover:text-green-700"
                >
                    <i class="fa-solid fa-arrow-left text-xs"></i>
                    Voltar para o login
                </a>
            </div>
        </div>
    </div>
    <p class="mt-5 text-center text-xs leading-5 text-slate-500">
        Verifique também sua caixa de spam ou lixo eletrônico
        caso não encontre nossa mensagem.
    </p>
</x-layouts.guest>
