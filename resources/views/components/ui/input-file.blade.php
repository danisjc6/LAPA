@props([
    'name',
    'id' => null,
    'accept' => null,
    'required' => false,
    'disabled' => false,
])
<input
    id="{{ $id ?? $name }}"
    type="file"
    name="{{ $name }}"
    @if($accept) accept="{{ $accept }}" @endif
    @required($required)
    @disabled($disabled)
    {{ $attributes->class([
        'block w-full cursor-pointer rounded-lg border bg-white text-sm text-slate-700',
        'file:mr-4 file:cursor-pointer file:border-0 file:border-r file:border-slate-200 file:bg-slate-50 file:px-4 file:py-2.5 file:text-sm file:font-semibold file:text-emerald-800',
        'hover:file:bg-emerald-50 focus:outline-none focus:ring-2 focus:ring-emerald-700/15',
        'border-red-500' => $errors->has($name),
        'border-slate-300' => !$errors->has($name),
        'cursor-not-allowed opacity-60' => $disabled,
    ]) }}
/>
