@props(['secao'])

@php
    $itens = $secao->arquivos->values()->map(fn ($arquivo) => [
        'src' => asset('storage/' . $arquivo->path),
        'alt' => $arquivo->alt_text ?? $arquivo->titulo ?? 'Imagem anatômica',
        'titulo' => $arquivo->titulo ?? $secao->titulo ?? 'Imagem anatômica',
        'descricao' => $arquivo->descricao ?? $arquivo->legenda ?? null,
    ])->all();

    $total = count($itens);
    $primeiraTemDescricao = filled($itens[0]['descricao'] ?? null);
@endphp

@if ($total > 0)
<style>[x-cloak] { display: none !important; }</style>
<section
    x-data="{
        itens: @js($itens),
        atual: 0,
        modoTeatro: false,
        telaCheia: false,
        overflowAnterior: null,
        podeRolarEsquerda: false,
        podeRolarDireita: false,

        get total() { return this.itens.length },
        get itemAtual() { return this.itens[this.atual] },
        get ampliado() { return this.modoTeatro || this.telaCheia },
        get temDescricao() { return Boolean(this.itemAtual?.descricao?.trim()) },

        selecionar(indice) {
            if (indice < 0 || indice >= this.total) return;
            this.atual = indice;
            this.$nextTick(() => {
                const faixa = this.$refs.miniaturas;
                const miniatura = faixa?.querySelector(`[data-miniatura='${indice}']`);
                if (!faixa || !miniatura) return;
                const destino = miniatura.offsetLeft - faixa.offsetLeft
                    - (faixa.clientWidth - miniatura.clientWidth) / 2;
                faixa.scrollTo({
                    left: destino,
                    behavior: window.matchMedia('(prefers-reduced-motion: reduce)').matches
                        ? 'auto' : 'smooth'
                });
            });
        },

        atualizarRolagem() {
            const faixa = this.$refs.miniaturas;
            if (!faixa) return;
            this.podeRolarEsquerda = faixa.scrollLeft > 2;
            this.podeRolarDireita = faixa.scrollLeft + faixa.clientWidth < faixa.scrollWidth - 2;
        },

        rolarMiniaturas(direcao) {
            const faixa = this.$refs.miniaturas;
            if (!faixa) return;
            const miniatura = faixa.querySelector('[data-miniatura]');
            const deslocamento = (miniatura?.offsetWidth ?? 128) + 12;
            faixa.scrollBy({
                left: direcao * deslocamento * 2,
                behavior: window.matchMedia('(prefers-reduced-motion: reduce)').matches
                    ? 'auto' : 'smooth'
            });
        },

        proximo() { if (this.total > 1) this.selecionar((this.atual + 1) % this.total) },
        anterior() { if (this.total > 1) this.selecionar((this.atual - 1 + this.total) % this.total) },

        definirTeatro(ativo) {
            if (this.modoTeatro === ativo) return;
            this.modoTeatro = ativo;
            if (ativo) {
                this.overflowAnterior = document.body.style.overflow;
                document.body.style.overflow = 'hidden';
            } else if (this.overflowAnterior !== null) {
                document.body.style.overflow = this.overflowAnterior;
                this.overflowAnterior = null;
            }
        },

        async alternarTelaCheia() {
            try {
                if (document.fullscreenElement === this.$root) {
                    await document.exitFullscreen();
                } else if (!document.fullscreenElement) {
                    await this.$root.requestFullscreen();
                    this.definirTeatro(false);
                }
            } catch (erro) {
                console.error('Não foi possível alterar a tela cheia.', erro);
            }
        },

        sincronizarTelaCheia() {
            this.telaCheia = document.fullscreenElement === this.$root;
        },

        destroy() {
            this.definirTeatro(false);
            if (document.fullscreenElement === this.$root) {
                document.exitFullscreen().catch(() => {});
            }
        }
    }"
    x-init="sincronizarTelaCheia(); $nextTick(() => atualizarRolagem())"
    @resize.window="atualizarRolagem()"
    @fullscreenchange.window="sincronizarTelaCheia()"
    @keydown.escape.window="if (modoTeatro) definirTeatro(false)"
    @keydown.arrow-right.window="if (ampliado && !$event.target.closest('input, textarea, select, [contenteditable]')) { $event.preventDefault(); proximo() }"
    @keydown.arrow-left.window="if (ampliado && !$event.target.closest('input, textarea, select, [contenteditable]')) { $event.preventDefault(); anterior() }"
    class="w-full"
    :class="ampliado ? 'flex h-dvh flex-col overflow-y-auto bg-slate-950 p-3 sm:p-5' : ''"
    :style="modoTeatro && !telaCheia ? 'position:fixed;inset:0;z-index:1000' : ''"
    aria-label="Galeria anatômica"
>
    <div class="flex min-w-0 flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm"
         :class="ampliado ? 'min-h-0 flex-1' : ''">

        {{-- Imagem à esquerda; detalhes à direita --}}
        <div class="grid min-h-0 grid-cols-1 gap-4 p-3 sm:p-4 lg:gap-6 lg:grid-cols-[var(--colunas-lapa)]"
             style="--colunas-lapa: {{ $primeiraTemDescricao ? 'minmax(0,1fr) minmax(230px,32%)' : 'minmax(0,1fr)' }}"
             :style="{ '--colunas-lapa': temDescricao ? 'minmax(0,1fr) minmax(230px,32%)' : 'minmax(0,1fr)' }"
             :class="ampliado ? 'lg:min-h-0 lg:flex-1' : ''">
            <div class="group relative mx-auto h-[350px] min-h-0 w-full overflow-hidden rounded-xl border border-slate-100 bg-slate-50 sm:h-[420px] lg:h-[480px]"
                 :class="ampliado ? '!h-[45dvh] lg:!h-full' : (!temDescricao ? 'max-w-5xl' : '')">
                <img
                    src="{{ $itens[0]['src'] }}"
                    :src="itemAtual.src"
                    alt="{{ $itens[0]['alt'] }}"
                    :alt="itemAtual.alt"
                    loading="eager"
                    decoding="async"
                    class="block h-full w-full object-contain"
                >

                <div class="absolute right-3 top-3 flex items-center gap-2">
                    <button type="button" x-show="!telaCheia" @click="definirTeatro(!modoTeatro)"
                        :aria-label="modoTeatro ? 'Sair do modo teatro' : 'Abrir modo teatro'"
                        :title="modoTeatro ? 'Sair do modo teatro' : 'Modo teatro'"
                        class="flex size-9 cursor-pointer items-center justify-center rounded-lg border border-slate-200 bg-white/95 text-slate-700 shadow-sm transition hover:text-emerald-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-emerald-600">
                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M7 9h10"/></svg>
                    </button>
                    <button type="button" @click="alternarTelaCheia()"
                        :aria-label="telaCheia ? 'Sair da tela cheia' : 'Abrir em tela cheia'"
                        :title="telaCheia ? 'Sair da tela cheia' : 'Tela cheia'"
                        class="flex size-9 cursor-pointer items-center justify-center rounded-lg border border-slate-200 bg-white/95 text-slate-700 shadow-sm transition hover:text-emerald-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-emerald-600">
                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8 3H3v5m13-5h5v5M8 21H3v-5m13 5h5v-5"/></svg>
                    </button>
                </div>

                @if ($total > 1)
                    <button type="button" @click="anterior()" aria-label="Imagem anterior"
                        class="absolute left-3 top-1/2 flex size-10 cursor-pointer -translate-y-1/2 items-center justify-center rounded-full border border-slate-200 bg-white/95 text-slate-700 shadow-md transition hover:text-emerald-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-emerald-600">
                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m15 18-6-6 6-6"/></svg>
                    </button>
                    <button type="button" @click="proximo()" aria-label="Próxima imagem"
                        class="absolute right-3 top-1/2 flex size-10 cursor-pointer -translate-y-1/2 items-center justify-center rounded-full border border-slate-200 bg-white/95 text-slate-700 shadow-md transition hover:text-emerald-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-emerald-600">
                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m9 18 6-6-6-6"/></svg>
                    </button>
                @endif
            </div>

            {{-- Sem descrição, a imagem ganha toda a largura e o título fica abaixo dela. --}}
            <div x-show="!temDescricao" x-cloak class="mx-auto w-full max-w-5xl min-w-0 px-1 pb-1">
                <h3 class="text-base font-semibold leading-snug text-emerald-600"
                    x-text="itemAtual.titulo">{{ $itens[0]['titulo'] }}</h3>
                <p class="mt-1 text-xs text-slate-500" aria-live="polite">
                    Figura <span x-text="atual + 1">1</span> de {{ $total }}
                </p>
            </div>

            {{-- O painel lateral só aparece quando existe descrição real. --}}
            <aside x-show="temDescricao" x-cloak
                class="min-w-0 py-1 lg:py-2"
                :class="ampliado ? 'lg:min-h-0 lg:overflow-y-auto' : ''">
                <h3 class="text-lg font-semibold leading-snug text-emerald-700"
                    x-text="itemAtual.titulo">{{ $itens[0]['titulo'] }}</h3>
                <p class="mt-2 text-xs text-slate-500" aria-live="polite">
                    Figura <span x-text="atual + 1">1</span> de {{ $total }}
                </p>
                <div class="mt-5 border-t border-slate-100 pt-5">
                    <h4 class="mb-2 text-sm font-semibold text-slate-800">Sobre esta imagem</h4>
                    <p class="whitespace-pre-line text-sm leading-relaxed text-slate-600"
                        x-text="itemAtual.descricao"></p>
                </div>
            </aside>
        </div>

        {{-- Miniaturas ocupam toda a largura do card --}}
        @if ($total > 1)
            <nav class="border-t border-slate-100 px-3 pb-3 pt-4 sm:px-4" aria-label="Imagens da galeria">
                <div class="flex min-w-0 items-center gap-2">
                    <button type="button" @click="rolarMiniaturas(-1)"
                        :disabled="!podeRolarEsquerda"
                        aria-label="Rolar miniaturas para a esquerda"
                        class="flex size-9 shrink-0 cursor-pointer items-center justify-center rounded-full border border-slate-200 bg-white text-slate-700 shadow-sm transition hover:border-emerald-300 hover:text-emerald-700 disabled:cursor-not-allowed disabled:opacity-35 disabled:hover:border-slate-200 disabled:hover:text-slate-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-emerald-600">
                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m15 18-6-6 6-6"/></svg>
                    </button>

                    <div x-ref="miniaturas" @scroll.passive="atualizarRolagem()"
                        class="flex min-w-0 flex-1 gap-3 overflow-x-auto overscroll-x-contain pb-2 [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
                    @foreach ($itens as $indice => $item)
                        <button type="button" data-miniatura="{{ $indice }}" @click="selecionar({{ $indice }})"
                            :aria-current="atual === {{ $indice }} ? 'true' : null"
                            aria-label="Ver imagem {{ $indice + 1 }}: {{ $item['titulo'] }}"
                            class="group w-28 shrink-0 cursor-pointer text-left sm:w-32 md:w-36">
                            <span class="block overflow-hidden rounded-lg border-2 bg-slate-50 p-0.5 transition"
                                :class="atual === {{ $indice }} ? 'border-emerald-700 shadow-sm' : 'border-transparent group-hover:border-slate-300'">
                                <img src="{{ $item['src'] }}" alt="" loading="lazy"
                                     class="aspect-[4/3] w-full rounded-md object-contain">
                            </span>
                            <span class="mt-1.5 block truncate text-center text-xs"
                                :class="atual === {{ $indice }} ? 'font-semibold text-emerald-600' : 'text-slate-600'">
                                {{ $indice + 1 }}. {{ $item['titulo'] }}
                            </span>
                        </button>
                    @endforeach
                    </div>

                    <button type="button" @click="rolarMiniaturas(1)"
                        :disabled="!podeRolarDireita"
                        aria-label="Rolar miniaturas para a direita"
                        class="flex size-9 shrink-0 cursor-pointer items-center justify-center rounded-full border border-slate-200 bg-white text-slate-700 shadow-sm transition hover:border-emerald-300 hover:text-emerald-600 disabled:cursor-not-allowed disabled:opacity-35 disabled:hover:border-slate-200 disabled:hover:text-slate-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-emerald-600">
                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m9 18 6-6-6-6"/></svg>
                    </button>
                </div>
            </nav>
        @endif
    </div>
</section>
@endif
