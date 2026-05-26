@props([
    'name',
    'label',
    'required' => false,
    'hint' => null,
])

<label for="{{ $name }}" class="block text-sm font-semibold text-slate-700">
    {{ $label }}
    @if($required)
        <span class="text-red-600">*</span>
    @endif
</label>
<div class="mt-2">
    {{ $slot }}
</div>

@error($name)
    <span class="mt-2 text-sm text-red-600">{{ $message }}</span>
@enderror

@if($hint)
    <span class="mt-2 text-xs text-slate-500">{{ $hint }}</span>
@endif
