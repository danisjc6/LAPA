@props([
    'colspan' => 1,
    'title' => 'Nenhum registro encontrado',
    'description' => null,
    'icon' => 'fa-solid fa-inbox',
])

<tr>
    <td
        colspan="{{ $colspan }}"
        class="px-6 py-14"
    >
        <div
            class="
                flex flex-col items-center
                justify-center text-center
            "
        >
            <div
                class="
                    flex h-11 w-11
                    items-center justify-center
                    rounded-xl bg-slate-100
                    text-slate-400
                "
            >
                <i class="{{ $icon }}"></i>
            </div>

            <p
                class="
                    mt-3 text-sm font-medium
                    text-slate-700
                "
            >
                {{ $title }}
            </p>

            @if ($description)
                <p
                    class="
                        mt-1 max-w-sm
                        text-sm text-slate-500
                    "
                >
                    {{ $description }}
                </p>
            @endif
        </div>
    </td>
</tr>
