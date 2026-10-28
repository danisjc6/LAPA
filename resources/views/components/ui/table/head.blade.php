<thead
    {{ $attributes->merge([
        'class' => '
            border-b border-slate-200
            bg-slate-50/80
        '
    ]) }}
>
    {{ $slot }}
</thead>
