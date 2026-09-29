@props([
    'href' => null,
])

@if ($href)
    <a
        href="{{ $href }}"
        {{ $attributes->class([
            'block px-4 py-2 text-sm text-slate-700',
            'transition-colors hover:bg-slate-50',
            'cursor-pointer',
        ]) }}
        role="menuitem"
    >
        {{ $slot }}
    </a>
@else
    {{ $slot }}
@endif
