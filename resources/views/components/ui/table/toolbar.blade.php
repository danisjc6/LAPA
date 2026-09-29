@props([
    'count' => null,
    'total' => null,
    'label' => 'registros',
])

<div
    {{ $attributes->class([
        'flex flex-col gap-3 border-b border-slate-200 px-6 py-4',
        'sm:flex-row sm:items-center sm:justify-between',
    ]) }}
>
    <div class="shrink-0 text-sm text-slate-600">
        @if (!is_null($count))
            <span class="font-semibold text-slate-900">
                {{ number_format($count, 0, ',', '.') }}
            </span>

            {{ $label }}

            @if (!is_null($total) && $total !== $count)
                <span class="text-slate-400">
                    de {{ number_format($total, 0, ',', '.') }}
                </span>
            @endif
        @endif
    </div>

    @if (isset($filters))
        <div class="flex flex-wrap items-center gap-2">
            {{ $filters }}
        </div>
    @endif
</div>
