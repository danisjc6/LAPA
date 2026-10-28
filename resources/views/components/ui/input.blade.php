@props([
    'name',
    'id' => null,
    'type' => 'text',
    'value' => null,
    'placeholder' => null,
    'autocomplete' => null,
    'required' => false,
    'readonly' => false,
    'disabled' => false,
    'invalid' => null,
])

@php
    $id = $id ?? $name;

    $base = "block w-full rounded-lg border border-slate-300 bg-white mt-2 px-4 py-2.5 text-slate-900
             placeholder:text-slate-400 shadow-sm outline-none
             focus:border-emerald-700 focus:ring-2 focus:ring-emerald-700/15";

    $ro = "bg-slate-50 text-slate-700 cursor-not-allowed";
@endphp

<input
    id="{{ $id }}"
    name="{{ $name }}"
    type="{{ $type }}"
    value="{{ old($name, $value) }}"
    @if($placeholder) placeholder="{{ $placeholder }}" @endif
    @if($autocomplete) autocomplete="{{ $autocomplete }}" @endif
    @required($required)
    @readonly($readonly)
    {{ $attributes->merge(['class' => trim($base.' '.($readonly ? $ro : ''))]) }}
>
