@props([
    'animal',
])

<a
    href="{{ route('modelos-3d.por-animal', ['animal' => $animal->slug]) }}"
    class="
        group block overflow-hidden
        rounded-xl border border-slate-200
        bg-white shadow-sm
        transition duration-200
        hover:-translate-y-0.5 hover:shadow-md
    "
>
    <div class="aspect-[7/6] overflow-hidden bg-slate-100">
        <img
            src="{{ asset('storage/' . $animal->imagem_path) }}"
            alt="{{ $animal->nome }}"
            class="
                h-full w-full object-cover
                transition duration-300
                group-hover:scale-[1.02]
            "
        >
    </div>

    <div class="flex items-center justify-between gap-4 p-5">
        <h2 class="text-xl font-semibold text-slate-700">
            {{ $animal->nome }}
        </h2>

        <span
            class="
                flex size-9 shrink-0 items-center justify-center
                rounded-full bg-emerald-50
                text-emerald-700
                transition
                group-hover:bg-emerald-600
                group-hover:text-white
            "
        >
            <i class="fa-solid fa-arrow-right text-sm"></i>
        </span>
    </div>
</a>
