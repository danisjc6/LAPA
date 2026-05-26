{{-- resources/views/components/conteudo/secoes/carrossel.blade.php --}}

@props([
    'secao',
])

@php
    $arquivos = $secao->arquivos;

    $itens = $arquivos
        ->map(function ($arquivo) use ($secao) {
            return [
                'src' => asset('storage/' . $arquivo->path),

                'alt' => $arquivo->alt_text
                    ?? $arquivo->titulo
                    ?? '',

                'titulo' => $arquivo->titulo
                    ?? $secao->titulo
                    ?? null,

                'descricao' => $arquivo->descricao
                    ?? $arquivo->legenda
                    ?? null,
            ];
        })
        ->values()
        ->all();

    $primeiroItem = $itens[0] ?? null;
@endphp


@if ($arquivos->isNotEmpty())

    <section
        x-data="{
            atual: 0,

            total: {{ $arquivos->count() }},

            itens: @js($itens),

            modoTeatro: false,

            telaCheia: false,


            get itemAtual() {
                return this.itens[this.atual] ?? {};
            },


            selecionar(index) {
                if (this.total <= 0) {
                    return;
                }

                this.atual = index;

                this.$nextTick(() => {
                    const miniatura = this.$root.querySelector(
                        `[data-thumb-index='${this.atual}']`
                    );

                    miniatura?.scrollIntoView({
                        behavior: 'smooth',
                        block: 'nearest',
                        inline: 'center'
                    });
                });
            },


            proximo() {
                if (this.total <= 1) {
                    return;
                }

                this.selecionar(
                    (this.atual + 1) % this.total
                );
            },


            anterior() {
                if (this.total <= 1) {
                    return;
                }

                this.selecionar(
                    (this.atual - 1 + this.total) % this.total
                );
            },


            irPara(index) {
                this.selecionar(index);
            },


            alternarTeatro() {
                this.modoTeatro = !this.modoTeatro;

                document.body.classList.toggle(
                    'overflow-hidden',
                    this.modoTeatro
                );
            },


            sairTeatro() {
                this.modoTeatro = false;

                document.body.classList.remove(
                    'overflow-hidden'
                );
            },


            async alternarTelaCheia() {
                if (!document.fullscreenElement) {

                    this.sairTeatro();

                    try {

                        await this.$refs.carrossel.requestFullscreen();

                    } catch (error) {

                        console.error(
                            'Não foi possível entrar em tela cheia.',
                            error
                        );

                    }

                    return;
                }

                await document.exitFullscreen();
            }
        }"

        x-ref="carrossel"

        @fullscreenchange.window="
            telaCheia =
                document.fullscreenElement === $refs.carrossel
        "

        @keydown.escape.window="
            if (modoTeatro) {
                sairTeatro()
            }
        "

        @keydown.arrow-right.window="
            if (modoTeatro || telaCheia) {
                proximo()
            }
        "

        @keydown.arrow-left.window="
            if (modoTeatro || telaCheia) {
                anterior()
            }
        "

        class="transition-all duration-300"

        :class="
            telaCheia
                ? 'flex h-screen w-screen flex-col bg-slate-950 p-4'
                : (
                    modoTeatro
                        ? 'fixed inset-0 z-[100] flex flex-col bg-slate-950/95 p-4 md:p-6'
                        : 'w-full'
                )
        "
    >


        {{-- ========================================================= --}}
        {{-- CARD PRINCIPAL --}}
        {{-- ========================================================= --}}

        <div
            class="
                overflow-hidden
                rounded-2xl
                border
                border-slate-200
                bg-white
                shadow-sm
            "

            :class="{
                'flex-1 min-h-0':
                    modoTeatro || telaCheia
            }"
        >


            <div
                class="
                    grid
                    grid-cols-1
                    lg:grid-cols-[minmax(0,1fr)_320px]
                "

                :class="{
                    'h-full':
                        modoTeatro || telaCheia
                }"
            >


                {{-- ================================================= --}}
                {{-- ÁREA ESQUERDA --}}
                {{-- ================================================= --}}

                <div
                    class="min-w-0 p-2.5"

                    :class="{
                        'flex min-h-0 flex-col':
                            modoTeatro || telaCheia
                    }"
                >


                    {{-- ============================================= --}}
                    {{-- IMAGEM PRINCIPAL --}}
                    {{-- ============================================= --}}

                    <div
                        class="
                            group
                            relative
                            overflow-hidden
                            rounded-xl
                            bg-slate-50
                        "

                        :class="
                            modoTeatro || telaCheia
                                ? 'min-h-0 flex-1'
                                : 'aspect-[16/10]'
                        "
                    >


                        {{-- IMAGEM ATUAL --}}
                        <img
                            src="{{ $primeiroItem['src'] }}"

                            :src="itemAtual.src"

                            alt="{{ $primeiroItem['alt'] }}"

                            :alt="itemAtual.alt ?? ''"

                            class="
                                h-full
                                w-full
                                object-contain
                            "
                        >



                        {{-- ========================================= --}}
                        {{-- CONTROLES SUPERIORES --}}
                        {{-- ========================================= --}}

                        <div
                            class="
                                absolute
                                right-3
                                top-3
                                z-30
                                flex
                                items-center
                                gap-2
                            "
                        >


                            {{-- CONTADOR --}}
                            @if ($arquivos->count() > 1)

                                <div
                                    class="
                                        flex
                                        h-10
                                        items-center
                                        rounded-lg
                                        border
                                        border-slate-200
                                        bg-white/95
                                        px-3
                                        text-sm
                                        font-medium
                                        text-slate-700
                                        shadow-sm
                                        backdrop-blur
                                    "
                                >
                                    <span
                                        x-text="atual + 1"
                                    ></span>

                                    <span
                                        class="mx-1 text-slate-400"
                                    >
                                        /
                                    </span>

                                    <span>
                                        {{ $arquivos->count() }}
                                    </span>
                                </div>

                            @endif



                            {{-- ===================================== --}}
                            {{-- MODO TEATRO --}}
                            {{-- ===================================== --}}

                            <button
                                type="button"

                                x-show="!telaCheia"

                                @click="alternarTeatro()"

                                class="
                                    flex
                                    h-10
                                    w-10
                                    items-center
                                    justify-center
                                    rounded-lg
                                    border
                                    border-slate-200
                                    bg-white/95
                                    text-slate-700
                                    shadow-sm
                                    backdrop-blur
                                    transition

                                    hover:bg-white
                                    hover:text-emerald-700

                                    focus:outline-none
                                    focus:ring-2
                                    focus:ring-emerald-500
                                "

                                :aria-label="
                                    modoTeatro
                                        ? 'Sair do modo teatro'
                                        : 'Abrir modo teatro'
                                "

                                :title="
                                    modoTeatro
                                        ? 'Sair do modo teatro'
                                        : 'Modo teatro'
                                "
                            >

                                {{-- ENTRAR NO MODO TEATRO --}}
                                <svg
                                    x-show="!modoTeatro"

                                    class="h-5 w-5"

                                    viewBox="0 0 24 24"

                                    fill="none"

                                    stroke="currentColor"

                                    stroke-width="1.8"

                                    aria-hidden="true"
                                >
                                    <rect
                                        x="3"
                                        y="5"
                                        width="18"
                                        height="14"
                                        rx="2"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        d="M7 9h10"
                                    />
                                </svg>


                                {{-- SAIR DO MODO TEATRO --}}
                                <svg
                                    x-show="modoTeatro"

                                    x-cloak

                                    class="h-5 w-5"

                                    viewBox="0 0 24 24"

                                    fill="none"

                                    stroke="currentColor"

                                    stroke-width="1.8"

                                    aria-hidden="true"
                                >
                                    <rect
                                        x="5"
                                        y="7"
                                        width="14"
                                        height="10"
                                        rx="2"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        d="M8 4h8"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        d="M8 20h8"
                                    />
                                </svg>

                            </button>



                            {{-- ===================================== --}}
                            {{-- TELA CHEIA --}}
                            {{-- ===================================== --}}

                            <button
                                type="button"

                                @click="alternarTelaCheia()"

                                class="
                                    flex
                                    h-10
                                    w-10
                                    items-center
                                    justify-center
                                    rounded-lg
                                    border
                                    border-slate-200
                                    bg-white/95
                                    text-slate-700
                                    shadow-sm
                                    backdrop-blur
                                    transition

                                    hover:bg-white
                                    hover:text-emerald-700

                                    focus:outline-none
                                    focus:ring-2
                                    focus:ring-emerald-500
                                "

                                :aria-label="
                                    telaCheia
                                        ? 'Sair da tela cheia'
                                        : 'Abrir em tela cheia'
                                "

                                :title="
                                    telaCheia
                                        ? 'Sair da tela cheia'
                                        : 'Tela cheia'
                                "
                            >

                                {{-- ENTRAR EM TELA CHEIA --}}
                                <svg
                                    x-show="!telaCheia"

                                    class="h-5 w-5"

                                    viewBox="0 0 24 24"

                                    fill="none"

                                    stroke="currentColor"

                                    stroke-width="2"

                                    aria-hidden="true"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M8 3H3v5"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M16 3h5v5"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M8 21H3v-5"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M16 21h5v-5"
                                    />
                                </svg>


                                {{-- SAIR DA TELA CHEIA --}}
                                <svg
                                    x-show="telaCheia"

                                    x-cloak

                                    class="h-5 w-5"

                                    viewBox="0 0 24 24"

                                    fill="none"

                                    stroke="currentColor"

                                    stroke-width="2"

                                    aria-hidden="true"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M8 3v5H3"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M16 3v5h5"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M8 21v-5H3"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M16 21v-5h5"
                                    />
                                </svg>

                            </button>

                        </div>



                        {{-- ========================================= --}}
                        {{-- SETAS DE NAVEGAÇÃO --}}
                        {{-- ========================================= --}}

                        @if ($arquivos->count() > 1)


                            {{-- ANTERIOR --}}
                            <button
                                type="button"

                                @click="anterior()"

                                class="
                                    absolute
                                    left-4
                                    top-1/2
                                    z-20

                                    flex
                                    h-11
                                    w-11
                                    -translate-y-1/2
                                    items-center
                                    justify-center

                                    rounded-full

                                    border
                                    border-slate-200

                                    bg-white/95

                                    text-slate-700

                                    shadow-md
                                    backdrop-blur

                                    transition
                                    duration-200

                                    hover:scale-105
                                    hover:border-emerald-200
                                    hover:bg-white
                                    hover:text-emerald-700

                                    focus:outline-none
                                    focus:ring-2
                                    focus:ring-emerald-500
                                    focus:ring-offset-2
                                "

                                aria-label="Imagem anterior"
                            >
                                <svg
                                    class="h-5 w-5"

                                    viewBox="0 0 24 24"

                                    fill="none"

                                    stroke="currentColor"

                                    stroke-width="2"

                                    aria-hidden="true"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m15 18-6-6 6-6"
                                    />
                                </svg>
                            </button>



                            {{-- PRÓXIMO --}}
                            <button
                                type="button"

                                @click="proximo()"

                                class="
                                    absolute
                                    right-4
                                    top-1/2
                                    z-20

                                    flex
                                    h-11
                                    w-11
                                    -translate-y-1/2
                                    items-center
                                    justify-center

                                    rounded-full

                                    border
                                    border-slate-200

                                    bg-white/95

                                    text-slate-700

                                    shadow-md
                                    backdrop-blur

                                    transition
                                    duration-200

                                    hover:scale-105
                                    hover:border-emerald-200
                                    hover:bg-white
                                    hover:text-emerald-700

                                    focus:outline-none
                                    focus:ring-2
                                    focus:ring-emerald-500
                                    focus:ring-offset-2
                                "

                                aria-label="Próxima imagem"
                            >
                                <svg
                                    class="h-5 w-5"

                                    viewBox="0 0 24 24"

                                    fill="none"

                                    stroke="currentColor"

                                    stroke-width="2"

                                    aria-hidden="true"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m9 18 6-6-6-6"
                                    />
                                </svg>
                            </button>


                        @endif

                    </div>



                    {{-- ================================================= --}}
                    {{-- MINIATURAS --}}
                    {{-- ================================================= --}}

                    @if ($arquivos->count() > 1)

                        <div
                            class="
                                mt-3
                                flex
                                flex-none
                                gap-3
                                overflow-x-auto
                                pb-2
                            "
                        >

                            @foreach ($arquivos as $index => $arquivo)

                                <button
                                    type="button"

                                    data-thumb-index="{{ $index }}"

                                    @click="irPara({{ $index }})"

                                    class="
                                        relative
                                        h-20
                                        w-30
                                        flex-none
                                        overflow-hidden
                                        rounded-lg
                                        border-2
                                        bg-slate-50
                                        p-0.5
                                        transition-all
                                        duration-200
                                    "

                                    :class="
                                        atual === {{ $index }}
                                            ? 'border-emerald-600 shadow-sm'
                                            : 'border-transparent hover:border-slate-300'
                                    "

                                    aria-label="
                                        Visualizar {{
                                            $arquivo->titulo
                                            ?? 'imagem ' . ($index + 1)
                                        }}
                                    "
                                >

                                    <img
                                        src="{{
                                            asset(
                                                'storage/' .
                                                $arquivo->path
                                            )
                                        }}"

                                        alt="{{
                                            $arquivo->alt_text
                                            ?? $arquivo->titulo
                                            ?? ''
                                        }}"

                                        class="
                                            h-full
                                            w-full
                                            rounded-md
                                            object-cover
                                        "

                                        loading="lazy"
                                    >

                                </button>

                            @endforeach

                        </div>

                    @endif

                </div>



                {{-- ===================================================== --}}
                {{-- INFORMAÇÕES DA IMAGEM --}}
                {{-- ===================================================== --}}

                <aside
                    class="
                        border-t
                        border-slate-200
                        p-6

                        lg:border-l
                        lg:border-t-0
                    "

                    :class="{
                        'min-h-0 overflow-y-auto':
                            modoTeatro || telaCheia
                    }"
                >


                    {{-- TÍTULO --}}
                    <h3
                        x-show="itemAtual.titulo"

                        x-text="itemAtual.titulo"

                        class="
                            text-lg
                            font-semibold
                            leading-snug
                            text-slate-900
                        "
                    ></h3>



                    {{-- DESCRIÇÃO --}}
                    <p
                        x-show="itemAtual.descricao"

                        x-text="itemAtual.descricao"

                        class="
                            mt-4
                            text-sm
                            leading-relaxed
                            text-slate-600
                        "
                    ></p>



                    {{-- QUANTIDADE --}}
                    <div
                        class="
                            mt-5
                            flex
                            items-center
                            gap-2
                            text-sm
                            text-slate-600
                        "
                    >

                        <svg
                            class="h-4 w-4"

                            viewBox="0 0 24 24"

                            fill="none"

                            stroke="currentColor"

                            stroke-width="1.8"

                            aria-hidden="true"
                        >
                            <rect
                                x="3"
                                y="5"
                                width="18"
                                height="14"
                                rx="2"
                            />

                            <circle
                                cx="8.5"
                                cy="10"
                                r="1.5"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="m21 15-5-5L5 19"
                            />
                        </svg>


                        <span>
                            {{ $arquivos->count() }}

                            {{
                                $arquivos->count() === 1
                                    ? 'imagem'
                                    : 'imagens'
                            }}
                        </span>

                    </div>

                </aside>

            </div>

        </div>

    </section>

@endif
