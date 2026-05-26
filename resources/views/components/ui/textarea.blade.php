@props([
    'name',
    'id' => null,
    'rows' => 4,
    'value' => '',
    'placeholder' => null,
    'required' => false,
    'readonly' => false,
])

@php
    $id = $id ?? $name;

    $base = "block w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-slate-900
             placeholder:text-slate-400 shadow-sm outline-none
             focus:border-emerald-700 focus:ring-2 focus:ring-emerald-700/15";

    $ro = "bg-slate-50 text-slate-700 cursor-not-allowed";
@endphp

<textarea
    id="{{ $id }}"
    name="{{ $name }}"
    rows="{{ $rows }}"
    @if($required) required @endif
    @if($readonly) readonly @endif
    @if($placeholder) placeholder="{{ $placeholder }}" @endif
    {{ $attributes->merge(['class' => trim($base.' '.($readonly ? $ro : ''))]) }}
>{{ old($name, $value) }}</textarea>
