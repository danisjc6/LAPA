@props([
    'align' => 'end', // start | center | end | between
    'reverseOnMobile' => true,
])

@php
    $justify = match ($align) {
        'start' => 'sm:justify-start',
        'center' => 'sm:justify-center',
        'between' => 'sm:justify-between',
        default => 'sm:justify-end',
    };

    $mobileDirection = $reverseOnMobile
        ? 'flex-col-reverse'
        : 'flex-col';
@endphp

<div
    {{ $attributes->class([
        'flex gap-3',
        $mobileDirection,
        'sm:flex-row sm:items-center',
        $justify,
    ]) }}
>
    {{ $slot }}
</div>
