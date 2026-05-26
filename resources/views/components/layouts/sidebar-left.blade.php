<aside
    x-show="sidebarOpen"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="-translate-x-4 opacity-0"
    x-transition:enter-end="translate-x-0 opacity-100"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="translate-x-0 opacity-100"
    x-transition:leave-end="-translate-x-4 opacity-0"
    class="col-span-12 -mb-2 -mt-7 shrink-0 rounded-3xl border-r border-slate-200 bg-white/90 lg:col-span-4 xl:col-span-3"
>
    <div class="sticky top-0 flex flex-col">

        {{-- Cabeçalho --}}
        <div class="px-6 pb-5 pt-6">
            <div class="flex items-start justify-between gap-4">

                <div class="min-w-0">
                    <h2 class="text-2xl font-bold tracking-tight text-slate-900">
                        {{ $title }}
                    </h2>

                    <p class="mt-1 text-sm leading-relaxed text-slate-500">
                        Explore categorias e conteúdos do atlas.
                    </p>
                </div>

                {{-- Fechar sidebar --}}
                <button
                    type="button"
                    @click="sidebarOpen = false"
                    class="group inline-flex h-10 w-10 shrink-0 cursor-pointer items-center justify-center
                           rounded-xl border border-slate-200 bg-white text-slate-500 shadow-sm
                           transition-all duration-200
                           hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-700"
                    aria-label="Fechar menu lateral"
                    title="Fechar menu"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 transition-transform duration-200 group-hover:-translate-x-0.5"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M15.78 4.22a.75.75 0 0 1 0 1.06L11.06 10l4.72 4.72a.75.75 0 1 1-1.06 1.06L10 11.06l-4.72 4.72a.75.75 0 0 1-1.06-1.06L8.94 10 4.22 5.28a.75.75 0 0 1 1.06-1.06L10 8.94l4.72-4.72a.75.75 0 0 1 1.06 0Z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </button>
            </div>

            {{-- Pesquisa --}}
            <div class="mt-5">
                <label
                    for="atlas-search"
                    class="sr-only"
                >
                    Pesquisar no atlas
                </label>

                <div class="relative">
                    <span
                        class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M8.5 3a5.5 5.5 0 1 0 3.472 9.765l3.631 3.632a.75.75 0 1 0 1.06-1.06l-3.632-3.631A5.5 5.5 0 0 0 8.5 3ZM4.5 8.5a4 4 0 1 1 8 0a4 4 0 0 1-8 0Z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </span>

                    <input
                        id="atlas-search"
                        type="text"
                        placeholder="{{ $searchPlaceholder }}"
                        class="block w-full rounded-full border border-slate-200 bg-white
                               py-3 pl-11 pr-4 text-sm text-slate-900 shadow-sm
                               placeholder:text-slate-400
                               transition
                               focus:border-emerald-600 focus:outline-none
                               focus:ring-4 focus:ring-emerald-100"
                    >
                </div>
            </div>
        </div>

        @php
            /*
             * Recupera o conteúdo atual diretamente da rota.
             *
             * Com Route Model Binding:
             * request()->route('conteudo') retorna o model Conteudo.
             *
             * Sem Route Model Binding:
             * pode retornar diretamente a slug.
             */
            $conteudoDaRota = request()->route('conteudo');

            if (is_object($conteudoDaRota) && isset($conteudoDaRota->slug)) {
                $slugConteudoAtual = $conteudoDaRota->slug;
            } elseif (is_string($conteudoDaRota)) {
                $slugConteudoAtual = $conteudoDaRota;
            } else {
                $slugConteudoAtual = null;
            }

            /*
             * Mantemos essas variáveis como fallback caso
             * já estejam sendo enviadas pelo componente/controller.
             */
            $slugSistemaAtual = $currentSistemaSlug ?? null;
            $slugAnimalAtual = $currentAnimalSlug ?? null;
        @endphp

        {{-- Navegação --}}
        <div class="flex-1 px-2 pb-6">
            <nav
                class="space-y-1"
                aria-label="Navegação do Atlas"
            >
                @foreach ($menuLateral() as $itemSistema)
                    @php
                        $sistema = $itemSistema['sistema'];

                        $animaisSistema = collect(
                            $itemSistema['animais'] ?? []
                        );

                        /*
                         * Verifica se o conteúdo atualmente acessado
                         * está dentro deste sistema.
                         */
                        $sistemaPossuiConteudoAtual =
                            $animaisSistema->contains(
                                function ($itemAnimal) use ($slugConteudoAtual) {
                                    if (! $slugConteudoAtual) {
                                        return false;
                                    }

                                    return collect(
                                        $itemAnimal['conteudos'] ?? []
                                    )->contains(
                                        fn ($conteudo) =>
                                            $conteudo->slug === $slugConteudoAtual
                                    );
                                }
                            );

                        /*
                         * O sistema abre automaticamente quando:
                         *
                         * 1. possui o conteúdo da página atual;
                         * 2. ou corresponde ao sistema atual informado.
                         */
                        $sistemaAtivo =
                            $sistemaPossuiConteudoAtual
                            || $sistema->slug === $slugSistemaAtual;

                        $sistemaAberto = $sistemaAtivo;
                    @endphp

                    {{-- Sistema --}}
                    <section
                        x-data="{ open: {{ $sistemaAberto ? 'true' : 'false' }} }"
                    >
                        <button
                            type="button"
                            @click="open = !open"
                            class="group flex w-full cursor-pointer items-center justify-between
                                   rounded-2xl px-3 py-3 text-left
                                   transition-all duration-200
                                {{ $sistemaAtivo
                                    ? 'bg-emerald-50 text-emerald-900'
                                    : 'text-slate-700 hover:bg-slate-50 hover:text-slate-950'
                                }}"
                            :aria-expanded="open"
                        >
                            <span class="flex min-w-0 items-center gap-3">

                                {{-- Ícone do sistema --}}
                                <span
                                    class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl
                                           transition-all duration-200
                                        {{ $sistemaAtivo
                                            ? 'bg-emerald-100 text-emerald-700'
                                            : 'bg-slate-100 text-slate-500 group-hover:bg-slate-200'
                                        }}"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                    >
                                        <path
                                            d="M10 2.5c-1.2 0-2.1.9-2.1 2.1S8.8 6.7 10 6.7s2.1-.9 2.1-2.1S11.2 2.5 10 2.5ZM5.3 5.8c-1 0-1.8.8-1.8 1.8s.8 1.8 1.8 1.8 1.8-.8 1.8-1.8-.8-1.8-1.8-1.8Zm9.4 0c-1 0-1.8.8-1.8 1.8s.8 1.8 1.8 1.8 1.8-.8 1.8-1.8-.8-1.8-1.8-1.8ZM10 8.4c-2.5 0-4.6 1.8-4.6 4.1 0 1.8 1.4 3 3.1 2.4.9-.3 2.1-.3 3 0 1.7.6 3.1-.6 3.1-2.4 0-2.3-2.1-4.1-4.6-4.1Z"
                                        />
                                    </svg>
                                </span>

                                <span class="truncate text-sm font-bold">
                                    {{ $sistema->nome }}
                                </span>
                            </span>

                            {{-- Seta do sistema --}}
                            <span
                                class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg
                                       text-slate-400 transition-colors duration-200
                                       group-hover:bg-white/70 group-hover:text-slate-600"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 transition-transform duration-200"
                                    :class="{ 'rotate-180': open }"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 11.168l3.71-3.938a.75.75 0 1 1 1.08 1.04l-4.25 4.512a.75.75 0 0 1-1.08 0L5.21 8.27a.75.75 0 0 1 .02-1.06Z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </span>
                        </button>

                        {{-- Animais --}}
                        <div
                            x-show="open"
                            x-collapse
                            class="ml-7.25 border-l border-slate-200 pl-3"
                        >
                            <div class="space-y-1 py-1">

                                @foreach ($itemSistema['animais'] ?? [] as $itemAnimal)
                                    @php
                                        $animal = $itemAnimal['animal'];

                                        $conteudosAnimal = collect(
                                            $itemAnimal['conteudos'] ?? []
                                        );

                                        $primeiroConteudo =
                                            $conteudosAnimal->first();

                                        /*
                                         * Verifica se o conteúdo atual
                                         * pertence a este animal.
                                         */
                                        $animalPossuiConteudoAtual =
                                            $slugConteudoAtual
                                                ? $conteudosAnimal->contains(
                                                    fn ($conteudo) =>
                                                        $conteudo->slug === $slugConteudoAtual
                                                )
                                                : false;

                                        /*
                                         * O animal abre automaticamente quando:
                                         *
                                         * 1. possui o conteúdo atual;
                                         * 2. ou corresponde ao animal atual informado.
                                         */
                                        $animalAtivo =
                                            $animalPossuiConteudoAtual
                                            || $animal->slug === $slugAnimalAtual;

                                        $animalAberto = $animalAtivo;
                                    @endphp

                                    {{-- Animal --}}
                                    <div
                                        x-data="{ open: {{ $animalAberto ? 'true' : 'false' }} }"
                                        class="relative"
                                    >
                                        <div
                                            class="group relative flex items-center rounded-xl
                                                   transition-all duration-200
                                                {{ $animalAtivo
                                                    ? 'bg-emerald-50/70'
                                                    : 'hover:bg-slate-50'
                                                }}"
                                        >
                                            {{-- Indicador lateral --}}
                                            <span
                                                class="absolute bottom-2 left-0 top-2 w-1 rounded-full
                                                       transition-all duration-200
                                                    {{ $animalAtivo
                                                        ? 'bg-emerald-600'
                                                        : 'bg-transparent group-hover:bg-slate-300'
                                                    }}"
                                            ></span>

                                            {{-- Nome do animal --}}
                                            @if ($primeiroConteudo)
                                                <a
                                                    href="{{ route('atlas.show', [
                                                        'conteudo' => $primeiroConteudo->slug,
                                                    ]) }}"
                                                    class="flex min-w-0 flex-1 items-center gap-2.5
                                                           py-2.5 pl-4 pr-2"
                                                >
                                                    {{-- Ícone do animal --}}
                                                    <span
                                                        class="flex h-7 w-7 shrink-0 items-center justify-center
                                                               rounded-lg transition-all duration-200
                                                            {{ $animalAtivo
                                                                ? 'bg-emerald-100 text-emerald-700'
                                                                : 'bg-slate-100 text-slate-400 group-hover:text-slate-600'
                                                            }}"
                                                    >
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            class="h-3.5 w-3.5"
                                                            viewBox="0 0 20 20"
                                                            fill="currentColor"
                                                        >
                                                            <path
                                                                d="M10 2.5c-1.2 0-2.1.9-2.1 2.1S8.8 6.7 10 6.7s2.1-.9 2.1-2.1S11.2 2.5 10 2.5ZM5.3 5.8c-1 0-1.8.8-1.8 1.8s.8 1.8 1.8 1.8 1.8-.8 1.8-1.8-.8-1.8-1.8-1.8Zm9.4 0c-1 0-1.8.8-1.8 1.8s.8 1.8 1.8 1.8 1.8-.8 1.8-1.8-.8-1.8-1.8-1.8ZM10 8.4c-2.5 0-4.6 1.8-4.6 4.1 0 1.8 1.4 3 3.1 2.4.9-.3 2.1-.3 3 0 1.7.6 3.1-.6 3.1-2.4 0-2.3-2.1-4.1-4.6-4.1Z"
                                                            />
                                                        </svg>
                                                    </span>

                                                    <span
                                                        class="truncate text-sm font-semibold transition-colors
                                                            {{ $animalAtivo
                                                                ? 'text-emerald-900'
                                                                : 'text-slate-600 group-hover:text-slate-900'
                                                            }}"
                                                    >
                                                        {{ $animal->nome }}
                                                    </span>
                                                </a>
                                            @else
                                                <div
                                                    class="flex min-w-0 flex-1 items-center gap-2.5
                                                           py-2.5 pl-4 pr-2"
                                                >
                                                    <span
                                                        class="flex h-7 w-7 shrink-0 items-center justify-center
                                                               rounded-lg bg-slate-100 text-slate-400"
                                                    >
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            class="h-3.5 w-3.5"
                                                            viewBox="0 0 20 20"
                                                            fill="currentColor"
                                                        >
                                                            <path
                                                                d="M10 2.5c-1.2 0-2.1.9-2.1 2.1S8.8 6.7 10 6.7s2.1-.9 2.1-2.1S11.2 2.5 10 2.5ZM5.3 5.8c-1 0-1.8.8-1.8 1.8s.8 1.8 1.8 1.8 1.8-.8 1.8-1.8-.8-1.8-1.8-1.8Zm9.4 0c-1 0-1.8.8-1.8 1.8s.8 1.8 1.8 1.8 1.8-.8 1.8-1.8-.8-1.8-1.8-1.8ZM10 8.4c-2.5 0-4.6 1.8-4.6 4.1 0 1.8 1.4 3 3.1 2.4.9-.3 2.1-.3 3 0 1.7.6 3.1-.6 3.1-2.4 0-2.3-2.1-4.1-4.6-4.1Z"
                                                            />
                                                        </svg>
                                                    </span>

                                                    <span class="truncate text-sm font-semibold text-slate-400">
                                                        {{ $animal->nome }}
                                                    </span>
                                                </div>
                                            @endif

                                            {{-- Botão exclusivo para abrir/fechar --}}
                                            @if ($conteudosAnimal->isNotEmpty())
                                                <button
                                                    type="button"
                                                    @click.stop="open = !open"
                                                    class="mr-1 flex h-8 w-8 shrink-0 cursor-pointer
                                                           items-center justify-center rounded-lg
                                                           text-slate-400 transition-all duration-200
                                                           hover:bg-white hover:text-emerald-700
                                                           hover:shadow-sm"
                                                    :aria-expanded="open"
                                                    aria-label="Exibir conteúdos de {{ $animal->nome }}"
                                                    title="Exibir conteúdos"
                                                >
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="h-4 w-4 transition-transform duration-200"
                                                        :class="{ 'rotate-180': open }"
                                                        viewBox="0 0 20 20"
                                                        fill="currentColor"
                                                    >
                                                        <path
                                                            fill-rule="evenodd"
                                                            d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 11.168l3.71-3.938a.75.75 0 1 1 1.08 1.04l-4.25 4.512a.75.75 0 0 1-1.08 0L5.21 8.27a.75.75 0 0 1 .02-1.06Z"
                                                            clip-rule="evenodd"
                                                        />
                                                    </svg>
                                                </button>
                                            @endif
                                        </div>

                                        {{-- Conteúdos do animal --}}
                                        <div
                                            x-show="open"
                                            x-collapse
                                            class="ml-6"
                                        >
                                            <ul
                                                class="ml-2 mt-1 space-y-0.5 border-l
                                                       border-slate-200 py-1 pl-3"
                                            >
                                                @forelse ($conteudosAnimal as $conteudo)
                                                    @php
                                                        /*
                                                         * Conteúdo ativo baseado
                                                         * diretamente na URL atual.
                                                         */
                                                        $conteudoAtivo =
                                                            $conteudo->slug === $slugConteudoAtual;
                                                    @endphp

                                                    <li>
                                                        <a
                                                            href="{{ route('atlas.show', [
                                                                'conteudo' => $conteudo->slug,
                                                            ]) }}"
                                                            class="group/item relative flex items-center gap-2
                                                                   rounded-lg px-3 py-2 text-[13px]
                                                                   transition-all duration-150
                                                                {{ $conteudoAtivo
                                                                    ? 'bg-emerald-50 font-semibold text-emerald-800'
                                                                    : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900'
                                                                }}"
                                                        >
                                                            {{-- Marcador --}}
                                                            <span
                                                                class="h-1.5 w-1.5 shrink-0 rounded-full
                                                                       transition-colors duration-150
                                                                    {{ $conteudoAtivo
                                                                        ? 'bg-emerald-600'
                                                                        : 'bg-slate-300 group-hover/item:bg-emerald-400'
                                                                    }}"
                                                            ></span>

                                                            <span class="min-w-0 flex-1 truncate">
                                                                {{ $conteudo->titulo }}
                                                            </span>

                                                            {{-- Conteúdo atual --}}
                                                            @if ($conteudoAtivo)
                                                                <svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    class="h-3.5 w-3.5 shrink-0 text-emerald-600"
                                                                    viewBox="0 0 20 20"
                                                                    fill="currentColor"
                                                                    aria-hidden="true"
                                                                >
                                                                    <path
                                                                        fill-rule="evenodd"
                                                                        d="M16.704 4.153a.75.75 0 0 1 .143 1.051l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.816a.75.75 0 0 1 1.05-.143Z"
                                                                        clip-rule="evenodd"
                                                                    />
                                                                </svg>
                                                            @endif
                                                        </a>
                                                    </li>
                                                @empty
                                                    <li class="px-3 py-2 text-xs italic text-slate-400">
                                                        Nenhum conteúdo cadastrado
                                                    </li>
                                                @endforelse
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                @endforeach
            </nav>
        </div>
    </div>
</aside>
