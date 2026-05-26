@props([
    'name',
    'id' => null,

    // valor selecionado padrão (se não passar, usa old())
    'selected' => null,

    'required' => false,
    'disabled' => false,

    // opcional: força invalid manualmente. Se null, detecta via $errors->has($name)
    'invalid' => null,
])

@php
    $id = $id ?? $name;

    $isInvalid = is_null($invalid) ? ($errors?->has($name) ?? false) : (bool) $invalid;

    $base = "block w-full rounded-lg border bg-white px-3 py-2.5 text-sm text-slate-900
             shadow-sm outline-none
             focus:ring-2";

    $normal = "border-slate-300 focus:border-emerald-700 focus:ring-emerald-700/15";
    $invalidCls = "border-red-500 focus:border-red-600 focus:ring-red-500/15";
    $disabledCls = "bg-slate-100 text-slate-500 cursor-not-allowed opacity-80";

@endphp

<select
    id="{{ $id }}"
    name="{{ $name }}"
    @if($required) required @endif
    @if($disabled) disabled @endif
    aria-invalid="{{ $isInvalid ? 'true' : 'false' }}"
    {{ $attributes->merge([
        'class' => trim($base.' '.($isInvalid ? $invalidCls : $normal).' '.($disabled ? $disabledCls : ''))
    ]) }}
>
    {{ $slot }}
</select>
