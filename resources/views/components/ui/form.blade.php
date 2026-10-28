@props([
    'id' => null,
    'action' => null,
    'method' => 'POST',
    'enctype' => null,
    'accent' => true,
    'accentClass' => 'bg-emerald-700',
    'maxWidth' => "max-w-3xl",
])

@php
    $httpMethod = strtoupper($method);
    $formMethod = $httpMethod === 'GET' ? 'GET' : 'POST';
@endphp

@if($maxWidth)
<div class="mx-auto w-full {{ $maxWidth }}">
@endif

<form
    @if($id) id="{{ $id }}" @endif
    @if($action) action="{{ $action }}" @endif
    method="{{ $formMethod }}"
    @if($enctype) enctype="{{ $enctype }}" @endif
    {{ $attributes->merge(['class' => 'rounded-xl border border-slate-200 bg-white shadow-sm']) }}
>
    @if ($httpMethod !== 'GET')
        @csrf
    @endif

    @if (! in_array($httpMethod, ['GET', 'POST']))
        @method($httpMethod)
    @endif

    @if($accent)
        <div class="h-1.5 w-full rounded-t-xl {{ $accentClass }}"></div>
    @endif

    {{ $slot }}
</form>

@if($maxWidth)
</div>
@endif
