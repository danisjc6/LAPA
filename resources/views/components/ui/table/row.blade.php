@props([
    'hover' => true,
])

<tr
    {{ $attributes->class([
        'transition-colors duration-150',
        'hover:bg-slate-50/70' => $hover,
    ]) }}
>
    {{ $slot }}
</tr>
