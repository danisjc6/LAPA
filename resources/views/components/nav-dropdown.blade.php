@props([
    'label' => 'Menu',
    'active' => false,
    'align' => 'left', // left | right
    'width' => 'w-56',
])

@php
    $base = 'border-b-2 transition duration-300 inline-flex items-center';
    $classesAtivas = 'border-green-600 text-green-700 font-bold';
    $classesInativas =
        'border-transparent text-slate-700 font-semibold hover:border-green-700 hover:text-green-700 active:border-green-700 active:text-green-700 hover:scale-105';
    $classeAlinhamento = $align === 'right' ? 'right-0' : 'left-0';
@endphp

<li x-data="{ open: false }" class="relative list-none">
    <button type="button" @click="open = !open" @keydown.escape.window="open = false" @click.outside="open = false"
        class="{{ $base }} {{ $active ? $classesAtivas : $classesInativas }}"
        :class="open ? '{{ $classesAtivas }}' : '{{ $active ? $classesAtivas : $classesInativas }}'" aria-haspopup="true"
        :aria-expanded="open.toString()">
        {{ $label }}
        <svg class="h-4 w-4 text-slate-500 transition-transform duration-300 ease-out"
            :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd"
                d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.94l3.71-3.71a.75.75 0 1 1 1.06 1.06l-4.24 4.24a.75.75 0 0 1-1.06 0L5.21 8.29a.75.75 0 0 1 .02-1.08z"
                clip-rule="evenodd" />
        </svg>
    </button>

    <div x-cloak x-show="open" x-transition.origin.top
        class="absolute {{ $classeAlinhamento }} z-50 mt-2 {{ $width }} overflow-hidden rounded-xl border border-slate-200 bg-white shadow-lg"
        role="menu">
        {{ $slot }}
    </div>
</li>
