@props([
    'title',
    'description',
    'href' => '#',
    'color' => 'green',
])

@php
    $colors = match ($color) {
        'blue' => [
            'icon' => 'bg-blue-50 text-blue-700 ring-blue-100',
            'hover' => 'group-hover:text-blue-700',
        ],

        'purple' => [
            'icon' => 'bg-purple-50 text-purple-700 ring-purple-100',
            'hover' => 'group-hover:text-purple-700',
        ],

        default => [
            'icon' => 'bg-green-50 text-green-700 ring-green-100',
            'hover' => 'group-hover:text-green-700',
        ],
    };
@endphp

<a
    href="{{ $href }}"
    {{ $attributes->merge([
        'class' => '
            group relative flex h-full flex-col
            rounded-2xl border border-slate-200
            bg-white p-6
            transition-all duration-200
            hover:-translate-y-0.5
            hover:border-slate-300
            hover:shadow-lg hover:shadow-slate-200/60
            focus-visible:outline-none
            focus-visible:ring-2
            focus-visible:ring-green-600
            focus-visible:ring-offset-2
        '
    ]) }}
>
    {{-- Ícone --}}
    <div
        @class([
            'flex h-12 w-12 items-center justify-center',
            'rounded-xl ring-1',
            $colors['icon'],
        ])
    >
        {{ $icon }}
    </div>

    {{-- Conteúdo --}}
    <div class="mt-5 flex-1">
        <h3
            @class([
                'text-lg font-semibold tracking-tight text-slate-950',
                'transition-colors',
                $colors['hover'],
            ])
        >
            {{ $title }}
        </h3>

        <p class="mt-2 text-sm leading-6 text-slate-500">
            {{ $description }}
        </p>
    </div>

    {{-- Ação --}}
    <div class="mt-6 flex items-center gap-2 text-sm font-semibold text-slate-700">
        <span>Explorar</span>

        <svg
            class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-1"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            viewBox="0 0 24 24"
            aria-hidden="true"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="m9 18 6-6-6-6"
            />
        </svg>
    </div>
</a>
