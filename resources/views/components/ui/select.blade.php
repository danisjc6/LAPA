@props([
    'name',
    'id' => null,
    'selected' => null,
    'placeholder' => null,
    'required' => false,
    'disabled' => false,
    'invalid' => null,
])

@php
    $id = $id ?? $name;

    $selected = old($name, $selected);

    $selectedValue = $selected instanceof \BackedEnum
        ? $selected->value
        : $selected;

    $isInvalid = is_null($invalid)
        ? ($errors?->has($name) ?? false)
        : (bool) $invalid;

    $base = "
        block w-full appearance-none
        rounded-lg border
        bg-white
        px-4 py-2.5 pr-10
        text-sm text-slate-900
        shadow-sm
        outline-none
        transition-all duration-200
        hover:border-slate-400
        focus:ring-3
    ";

    $normal = "
        border-slate-300
        focus:border-emerald-600
        focus:ring-emerald-600/10
    ";

    $invalidCls = "
        border-red-500
        focus:border-red-600
        focus:ring-red-500/10
    ";

    $disabledCls = "
        cursor-not-allowed
        border-slate-200
        bg-slate-100
        text-slate-500
        shadow-none
        opacity-80
    ";
@endphp

<div class="relative">
    <select
        id="{{ $id }}"
        name="{{ $name }}"
        @required($required)
        @disabled($disabled)
        aria-invalid="{{ $isInvalid ? 'true' : 'false' }}"
        {{ $attributes->merge([
            'class' => trim(
                $base . ' ' .
                ($isInvalid ? $invalidCls : $normal) . ' ' .
                ($disabled ? $disabledCls : '')
            )
        ]) }}
    >
        @if ($placeholder)
            <option
                value=""
                disabled
                @selected(blank($selectedValue))
            >
                {{ $placeholder }}
            </option>
        @endif

        {{ $slot }}
    </select>

    <div
        class="
            pointer-events-none
            absolute inset-y-0 right-0
            flex items-center
            pr-3.5
        "
    >
        <i
            class="
                fa-solid fa-chevron-down
                text-xs text-slate-400
            "
        ></i>
    </div>
</div>
