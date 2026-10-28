<div
    {{ $attributes->class([
        'overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm'
    ]) }}
>
    <div class="overflow-x-auto">
        <table class="min-w-full text-left text-sm">
            {{ $slot }}
        </table>
    </div>

    @isset($footer)
        <div class="border-t border-slate-200 px-6 py-4">
            {{ $footer }}
        </div>
    @endisset
</div>
