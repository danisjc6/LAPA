@props([
    'class' => 'px-7 py-7 space-y-3',
])

<div {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</div>
