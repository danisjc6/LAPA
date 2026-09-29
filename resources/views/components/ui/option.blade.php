@aware([
    'name' => null,
    'selected' => null,
])

@props([
    'value',
    'disabled' => false,
])

@php
    $currentValue = old($name, $selected);

    $currentValue = $currentValue instanceof \BackedEnum
        ? $currentValue->value
        : $currentValue;

    $optionValue = $value instanceof \BackedEnum
        ? $value->value
        : $value;

    $isSelected = (string) $currentValue === (string) $optionValue;
@endphp

<option
    value="{{ $optionValue }}"
    @selected($isSelected)
    @disabled($disabled)
    {{ $attributes->merge([
        'class' => 'bg-white text-slate-900'
    ]) }}
>
    {{ $slot }}
</option>
