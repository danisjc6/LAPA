@props([
    'type' => 'button',
    'variant' => 'primary',
    'size' => 'md',
    'disabled' => false,
])

@php
    $base = '
        inline-flex items-center justify-center gap-2
        rounded-lg font-semibold
        transition
        focus:outline-none focus:ring-2 focus:ring-offset-2
        disabled:pointer-events-none disabled:opacity-50
        cursor-pointer
    ';

    $variants = [
        'primary' => '
            bg-green-700 text-white
            hover:bg-green-800
            focus:ring-green-600
        ',

        'secondary' => '
            border border-slate-300
            bg-white text-slate-700
            hover:bg-slate-50
            focus:ring-slate-300
        ',

        'danger' => '
            bg-red-600 text-white
            hover:bg-red-700
            focus:ring-red-500
        ',

        'ghost' => '
            bg-transparent text-slate-700
            hover:bg-slate-100
            focus:ring-slate-300
        ',
    ];

    $sizes = [
        'sm' => 'px-3 py-1.5 text-sm',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-5 py-2.5 text-base',
    ];
@endphp

<button
    type="{{ $type }}"
    @disabled($disabled)
    {{ $attributes->class([
        $base,
        $variants[$variant] ?? $variants['primary'],
        $sizes[$size] ?? $sizes['md'],
    ]) }}
>
    {{ $slot }}
</button>
