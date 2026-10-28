@props([
    'align' => 'left',
])

<th
    scope="col"
    {{ $attributes->class([
        'px-6 py-3.5',
        'text-xs font-semibold uppercase',
        'tracking-wide text-slate-500',
        'text-left' => $align === 'left',
        'text-center' => $align === 'center',
        'text-right' => $align === 'right',
    ]) }}
>
    {{ $slot }}
</th>
