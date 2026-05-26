@props([
    'title' => null,
    'description' => null,
    'divider' => false,
    'contentClass' => '',
])

<div @class([
    'pt-8 border-t border-slate-200' => $divider,
])>
    @if($title || $description)
        <div class="mb-4">
            @if($title)
                <h3 class="text-sm font-semibold uppercase tracking-wide text-slate-600">
                    {{ $title }}
                </h3>
            @endif

            @if($description)
                <p class="mt-1 text-sm text-slate-500">
                    {{ $description }}
                </p>
            @endif
        </div>
    @endif

    <div class="{{ $contentClass }}">
        {{ $slot }}
    </div>
</div>
