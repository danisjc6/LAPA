
@props([
    'modelos',
    'modeloAtual' => null,
])

<div
    x-data="{
        scroll(direction) {
            this.$refs.carousel.scrollBy({
                left: direction * 350,
                behavior: 'smooth'
            });
        },

        centralizarAtivo() {
            const ativo = this.$refs.carousel.querySelector('[data-active]');

            if (!ativo) return;

            const container = this.$refs.carousel;

            container.scrollLeft =
                ativo.offsetLeft
                - container.offsetLeft
                - (container.clientWidth / 2)
                + (ativo.clientWidth / 2);
        }
    }"
    x-init="$nextTick(() => centralizarAtivo())"
    {{ $attributes->class([
        'rounded-2xl border border-slate-200 bg-white p-4 shadow-sm'
    ]) }}
>
    <div class="flex items-center gap-4">

        <button
            type="button"
            @click="scroll(-1)"
            class="flex h-11 w-11 shrink-0 cursor-pointer items-center justify-center rounded-full border border-slate-200 bg-white text-slate-600 transition-all duration-200 hover:border-green-200 hover:bg-green-50 hover:text-green-700"
            aria-label="Modelos anteriores"
        >
            <i class="fa-solid fa-chevron-left"></i>
        </button>

        <div
            x-ref="carousel"
            class="flex min-w-0 flex-1 gap-2 overflow-x-auto scroll-smooth py-1 [scrollbar-width:none] [&::-webkit-scrollbar]:hidden"
        >
            @foreach ($modelos as $modelo)
                @php
                    $ativo = $modeloAtual?->id === $modelo->id;
                @endphp

                <a
                    href="{{ route('modelos-3d.show', $modelo) }}"
                    @if ($ativo) data-active aria-current="page" @endif
                    @class([
                        'group flex w-32 shrink-0 flex-col overflow-hidden rounded-xl border-2 transition-all duration-200',
                        'border-green-600 bg-green-100' => $ativo,
                        'border-slate-200 bg-white hover:border-green-300 hover:shadow-sm' => !$ativo,
                    ])
                >
                    <div class="flex h-18 items-center justify-center bg-slate-50 p-2">
                        @if ($modelo->preview_image_path)
                            <img
                                src="{{ asset('storage/' . $modelo->preview_image_path) }}"
                                alt="{{ $modelo->titulo }}"
                                class="h-full w-full object-contain transition-transform duration-200 group-hover:scale-105"
                                loading="lazy"
                            >
                        @else
                            <i class="fa-solid fa-cube text-3xl text-slate-300"></i>
                        @endif
                    </div>

                    <div class="flex min-h-10 items-center justify-center px-1 py-2">
                        <span
                            @class([
                                'line-clamp-2 text-center text-xs font-semibold',
                                'text-green-700' => $ativo,
                                'text-slate-700 group-hover:text-green-600' => !$ativo,
                            ])
                        >
                            {{ $modelo->titulo }}
                        </span>
                    </div>
                </a>
            @endforeach
        </div>

        <button
            type="button"
            @click="scroll(1)"
            class="flex h-11 w-11 shrink-0 cursor-pointer items-center justify-center rounded-full border border-slate-200 bg-white text-slate-600 transition-all duration-200 hover:border-green-200 hover:bg-green-50 hover:text-green-700"
            aria-label="Próximos modelos"
        >
            <i class="fa-solid fa-chevron-right"></i>
        </button>

    </div>
</div>
