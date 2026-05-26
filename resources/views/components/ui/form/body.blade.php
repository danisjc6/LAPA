@props([
    'class' => 'px-7 py-7 space-y-8',
])

<div {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</div>
