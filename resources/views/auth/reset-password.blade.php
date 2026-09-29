<x-layouts.guest>
    <div class="w-full max-w-md">
        <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">

            {{-- Cabeçalho --}}
            <div class="mb-8 text-center">
                <div
                    class="mx-auto mb-5 flex h-14 w-14 items-center
                           justify-center rounded-2xl bg-green-50 text-green-700"
                >
                    <i class="fa-solid fa-lock text-xl"></i>
                </div>

                <h1 class="text-2xl font-bold tracking-tight text-slate-900">
                    Redefinir senha
                </h1>

                <p class="mt-3 text-sm leading-6 text-slate-500">
                    Crie uma nova senha para recuperar o acesso à sua conta.
                </p>
            </div>

            {{-- Formulário --}}
            <form
                method="POST"
                action="{{ route('password.store') }}"
                class="space-y-5"
            >
                @csrf

                <input
                    type="hidden"
                    name="token"
                    value="{{ $request->route('token') }}"
                >

                {{-- E-mail --}}
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
                        value="{{ old('email', $request->email) }}"
                        placeholder="seuemail@exemplo.com"
                        autocomplete="username"
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

                {{-- Nova senha --}}
                <div>
                    <label
                        for="password"
                        class="mb-2 block text-sm font-medium text-slate-700"
                    >
                        Nova senha
                    </label>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        placeholder="Digite sua nova senha"
                        autocomplete="new-password"
                        required
                        @class([
                            'w-full rounded-xl border bg-white px-4 py-3',
                            'text-sm text-slate-900 placeholder:text-slate-400',
                            'outline-none transition-colors',
                            'focus:border-green-600 focus:ring-2 focus:ring-green-600/10',
                            'border-red-400' => $errors->has('password'),
                            'border-slate-200' => !$errors->has('password'),
                        ])
                    >

                    @error('password')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Confirmar senha --}}
                <div>
                    <label
                        for="password_confirmation"
                        class="mb-2 block text-sm font-medium text-slate-700"
                    >
                        Confirmar nova senha
                    </label>

                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        placeholder="Confirme sua nova senha"
                        autocomplete="new-password"
                        required
                        @class([
                            'w-full rounded-xl border bg-white px-4 py-3',
                            'text-sm text-slate-900 placeholder:text-slate-400',
                            'outline-none transition-colors',
                            'focus:border-green-600 focus:ring-2 focus:ring-green-600/10',
                            'border-red-400' => $errors->has('password_confirmation'),
                            'border-slate-200' => !$errors->has('password_confirmation'),
                        ])
                    >

                    @error('password_confirmation')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Botão principal --}}
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
                    Redefinir senha
                </button>
            </form>
        </div>
    </div>
</x-layouts.guest>
