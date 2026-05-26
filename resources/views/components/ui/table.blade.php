@props([
    'title' => null,
    'subtitle' => null,
    'count' => null,          
    'empty' => null,          // mensagem vazio
    'colspan' => 1,           // qtd de colunas para o empty state
])

<div {{ $attributes->merge(['class' => 'rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden']) }}>
    {{-- Topbar opcional --}}
    @if($title || $subtitle || !is_null($count) || isset($topbar))
        <div class="px-6 py-5 border-b border-slate-200">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    @if($title)
                        <h3 class="text-lg font-bold tracking-tight text-slate-900">{{ $title }}</h3>
                    @endif
                    @if($subtitle)
                        <p class="mt-1 text-sm text-slate-600">{{ $subtitle }}</p>
                    @endif
                    @if(!is_null($count))
                        <p class="mt-2 text-xs text-slate-500">
                            Total: <span class="font-semibold text-slate-900">{{ $count }}</span>
                        </p>
                    @endif
                </div>

                @isset($topbar)
                    <div class="flex items-center gap-2">
                        {{ $topbar }}
                    </div>
                @endisset
            </div>
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full text-left text-sm">
            <thead class="bg-slate-50 text-slate-700">
                {{ $thead }}
            </thead>

            <tbody class="divide-y divide-slate-200">
                {{-- Empty state (quando informado) --}}
                @if($empty && trim($tbody) === '')
                    <tr>
                        <td colspan="{{ $colspan }}" class="px-6 py-12 text-center text-slate-600">
                            {{ $empty }}
                        </td>
                    </tr>
                @else
                    {{ $tbody }}
                @endif
            </tbody>
        </table>
    </div>

    @isset($footer)
        <div class="border-t border-slate-200 px-6 py-4">
            {{ $footer }}
        </div>
    @endisset
</div>
