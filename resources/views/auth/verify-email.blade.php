<x-layouts.guest>
    <div class="w-full max-w-lg">
        <div
            class="
                overflow-hidden rounded-2xl
                border border-slate-200
                bg-white
                shadow-sm
            "
        >
            {{-- Cabeçalho --}}
            <div class="border-b border-slate-100 px-6 py-6 sm:px-8">
                <div
                    class="
                        mb-5 flex h-12 w-12
                        items-center justify-center
                        rounded-xl bg-green-50
                        text-green-700
                    "
                >
                    <i class="fa-regular fa-envelope text-xl"></i>
                </div>

                <h1 class="text-xl font-semibold text-slate-900">
                    Verifique seu e-mail
                </h1>

                <p class="mt-2 text-sm leading-6 text-slate-600">
                    Enviamos um link de verificação para o endereço de e-mail
                    informado durante o cadastro.
                </p>
            </div>

            {{-- Conteúdo --}}
            <div class="space-y-6 px-6 py-6 sm:px-8">
                <div
                    class="
                        flex gap-3 rounded-xl
                        border border-slate-200
                        bg-slate-50
                        p-4
                    "
                >
                    <div class="mt-0.5 text-slate-500">
                        <i class="fa-solid fa-circle-info"></i>
                    </div>

                    <p class="text-sm leading-6 text-slate-600">
                        Para continuar utilizando o LAPA, acesse sua caixa de
                        entrada e clique no link de verificação enviado para
                        seu e-mail.
                    </p>
                </div>

                @if (session('status') === 'verification-link-sent')
                    <div
                        class="
                            flex items-start gap-3
                            rounded-xl
                            border border-green-200
                            bg-green-50
                            p-4
                            text-green-800
                        "
                    >
                        <i class="fa-solid fa-circle-check mt-0.5"></i>

                        <div>
                            <p class="text-sm font-medium">
                                E-mail reenviado com sucesso
                            </p>

                            <p class="mt-1 text-sm text-green-700">
                                Um novo link de verificação foi enviado para
                                seu endereço de e-mail.
                            </p>
                        </div>
                    </div>
                @endif

                <div class="space-y-3">
                    <form
                        method="POST"
                        action="{{ route('verification.send') }}"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="
                                inline-flex w-full cursor-pointer
                                items-center justify-center gap-2
                                rounded-xl
                                bg-green-700
                                px-5 py-3
                                text-sm font-medium text-white
                                transition-all duration-200
                                hover:bg-green-800
                                focus-visible:outline-none
                                focus-visible:ring-2
                                focus-visible:ring-green-600
                                focus-visible:ring-offset-2
                            "
                        >
                            <i class="fa-solid fa-rotate-right text-xs"></i>

                            Reenviar e-mail de verificação
                        </button>
                    </form>

                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="
                                inline-flex w-full cursor-pointer
                                items-center justify-center gap-2
                                rounded-xl
                                border border-slate-200
                                bg-white
                                px-5 py-3
                                text-sm font-medium text-slate-700
                                transition-all duration-200
                                hover:border-slate-300
                                hover:bg-slate-50
                                hover:text-slate-900
                                focus-visible:outline-none
                                focus-visible:ring-2
                                focus-visible:ring-slate-400
                                focus-visible:ring-offset-2
                            "
                        >
                            <i class="fa-solid fa-arrow-right-from-bracket text-xs"></i>

                            Sair da conta
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <p class="mt-5 text-center text-xs leading-5 text-slate-500">
            Não encontrou o e-mail? Verifique também sua caixa de spam ou
            lixo eletrônico.
        </p>
    </div>
</x-layouts.guest>
