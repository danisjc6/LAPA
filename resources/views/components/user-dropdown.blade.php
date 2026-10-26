@props([
    'name' => Auth::user()->nome ?? 'Usuário',
    'role' => 'Administrador',
    'photo' => Auth::user()->foto_perfil ?? null,
])

<div
    x-data="{ open: false }"
    @click.outside="open = false"
    @keydown.escape.window="open = false"
    class="relative"
>
    <button
        type="button"
        @click="open = !open"
        class="flex cursor-pointer items-center gap-3 rounded-xl px-3 py-2 transition hover:bg-slate-100"
        :aria-expanded="open.toString()"
        aria-haspopup="true"
    >
        <div
            class="
                flex h-10 w-10 shrink-0 items-center justify-center
                overflow-hidden rounded-full bg-slate-200 text-slate-700
            "
        >
            @if ($photo)
                <img
                    src="{{ asset('storage/' . $photo) }}"
                    alt="Foto de {{ $name }}"
                    class="h-full w-full object-cover"
                >
            @else
                <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-slate-100 text-slate-800">
                    <i class="fa-solid fa-user" aria-hidden="true"></i>
                </span>
            @endif
        </div>

        <div class="hidden text-left md:block">
            <div class="text-sm font-semibold text-slate-900">
                {{ $name }}
            </div>

            <div class="text-xs text-slate-500">
                {{ $role }}
            </div>
        </div>

        <svg
            class="h-4 w-4 text-slate-500 transition-transform"
            :class="{ 'rotate-180': open }"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            stroke-width="2"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="m19 9-7 7-7-7"
            />
        </svg>
    </button>

    <div
        x-cloak
        x-show="open"
        x-transition
        class="
            absolute right-0 z-50 mt-2 w-64 overflow-hidden
            rounded-2xl border border-slate-200 bg-white shadow-lg
        "
    >
        <div class="border-b border-slate-100 bg-slate-50 px-4 py-3">
            <div class="text-sm font-semibold text-slate-900">
                {{ $name }}
            </div>

            <div class="text-xs text-slate-500">
                {{ $role }}
            </div>
        </div>

        <div class="py-2">
            {{ $slot }}
        </div>
    </div>
</div>
