@props([
    'href' => '#',
])

<a
  href="{{ $href }}"
  @click="open=false"
  class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50"
  role="menuitem"
>
  {{ $slot }}
</a>
