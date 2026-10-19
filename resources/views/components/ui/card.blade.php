@props([
    'href' => null,
    'title' => null,
    'description' => null,
    'action' => 'Ver detalhes',
])

@php
    $tag = $href ? 'a' : 'div';
@endphp

<{{ $tag }}
    @if ($href)
        href="{{ $href }}"
    @endif

    {{ $attributes->class([
        'group relative flex h-full flex-col overflow-hidden',
        'rounded-2xl border border-slate-200 bg-white p-6',
        'transition-all duration-200',
        'hover:-translate-y-0.5 hover:border-green-200',
        'hover:shadow-lg hover:shadow-slate-200/60',
        'focus-visible:outline-none focus-visible:ring-2',
        'focus-visible:ring-green-600 focus-visible:ring-offset-2',
    ]) }}
>
    <div
        class="
            absolute inset-x-0 top-0 h-1
            bg-green-600 opacity-0
            transition-opacity
            group-hover:opacity-100
        "
    ></div>

    <div class="flex-1">
        @if ($title)
            <h2
                class="
                    text-lg font-bold tracking-tight text-slate-900
                    transition-colors group-hover:text-green-700
                "
            >
                {{ $title }}
            </h2>
        @endif

        @if ($description)
            <p class="mt-2 text-sm leading-6 text-slate-600">
                {{ $description }}
            </p>
        @endif

        {{ $slot }}
    </div>

    @if ($href)
        <div
            class="
                mt-6 flex items-center justify-between
                border-t border-slate-100 pt-4
            "
        >
            <span
                class="
                    text-sm font-semibold text-slate-600
                    transition-colors group-hover:text-green-700
                "
            >
                {{ $action }}
            </span>

            <svg
                class="
                    h-5 w-5 text-slate-400
                    transition-all duration-200
                    group-hover:translate-x-1
                    group-hover:text-green-700
                "
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                viewBox="0 0 24 24"
                aria-hidden="true"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3"
                />
            </svg>
        </div>
    @endif
</{{ $tag }}>
