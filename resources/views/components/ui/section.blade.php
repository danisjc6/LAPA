@props([
    'bg' => 'bg-slate-100',
    'size' => 'max-w-7xl',
    'py' => 'py-10 lg:py-14',
    'px' => 'px-6',
])

<section {{ $attributes->class([$bg]) }}>
    <div class="mx-auto {{ $size }} {{ $px }} {{ $py }}">
        {{ $slot }}
    </div>
</section>
