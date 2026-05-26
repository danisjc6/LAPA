@props([
    'title' => null,
    'description' => null,
    'border' => true,
])

@if($title || $description)
    <div @class([
        'px-7 py-6',
        'border-b border-slate-200' => $border,
    ])>
        @if($title)
            <h2 class="text-2xl font-bold tracking-tight text-slate-900">
                {{ $title }}
            </h2>
        @endif

        @if($description)
            <p class="mt-1 text-sm text-slate-600">
                {{ $description }}
            </p>
        @endif

        {{ $slot }}
    </div>
@endif
