@props([
    'modelo',
])

@php
    $titulo = $modelo->titulo;

    $ativo = (bool) $modelo->ativo;

    $imagem = $modelo->preview_image_path
        ? asset('storage/' . $modelo->preview_image_path)
        : 'https://placehold.co/800x500/F3F4F6/94A3B8?text=Sem+preview';

    $url = route('modelos-3d.show', $modelo);
@endphp

<article
    {{ $attributes->merge([
        'class' => 'overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-200 hover:-translate-y-0.5 hover:shadow-md'
    ]) }}
>
    <a href="{{ $url }}" class="block">
        <div class="aspect-[16/9] overflow-hidden bg-slate-100">
            <img
                src="{{ $imagem }}"
                alt="{{ $titulo }}"
                class="h-full w-full object-cover transition duration-300 group-hover:scale-[1.02]"
            >
        </div>
    </a>

    <div class="space-y-4 p-4">
        <div class="flex items-start justify-between gap-3">
            <div class="min-w-0">
                <h3 class="text-2xl font-semibold leading-tight text-slate-900">
                    {{ $titulo }}
                </h3>

            </div>

        </div>

        <a
            href="{{ $url }}"
            class="inline-flex w-full items-center justify-between rounded-xl border border-emerald-500 px-4 py-3 text-sm font-semibold text-emerald-700 transition hover:bg-emerald-50"
        >
            <span class="inline-flex items-center gap-3">
                <span class="flex size-8 items-center justify-center rounded-lg bg-emerald-50">
                    <i class="fa-solid fa-cube text-sm"></i>
                </span>

                Abrir modelo
            </span>

            <i class="fa-solid fa-arrow-right text-sm"></i>
        </a>
    </div>
</article>
