@props([
    'secao',
])

<section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
    @if ($secao->titulo)
        <div class="flex items-center gap-3">
            <div
                class="flex size-9 shrink-0 items-center justify-center rounded-xl
                       bg-slate-100 text-slate-600"
            >
                <i class="fa-regular fa-book-open text-base"></i>
            </div>

            <h2 class="text-lg font-semibold text-slate-900">
                {{ $secao->titulo }}
            </h2>
        </div>
    @endif

    <div
        @class([
            'space-y-4 text-[15px] leading-7 text-slate-700',
            'mt-4' => $secao->titulo,
        ])
    >
        {!! $secao->conteudo !!}
    </div>
</section>
