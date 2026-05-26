@props([
    'title',
    'subtitle' => null,
])

<div {{ $attributes->merge(['class' => 'flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between']) }}>
    <div>
        <h2 class="text-3xl font-extrabold tracking-tight text-slate-900">
            {{ $title }}
        </h2>

        @if($subtitle)
            <p class="mt-1 text-sm text-slate-600">
                {{ $subtitle }}
            </p>
        @endif
    </div>

    @if (isset($actions))
        <div class="flex items-center gap-2">
            {{ $actions }}
        </div>
    @endif
</div>
