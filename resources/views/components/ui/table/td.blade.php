@props([
    'align' => 'left',
])

<td
    {{ $attributes->class([
        'px-6 py-4',
        'text-sm text-slate-600',
        'text-left' => $align === 'left',
        'text-center' => $align === 'center',
        'text-right' => $align === 'right',
    ]) }}
>
    {{ $slot }}
</td>
