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
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="currentColor"
                    viewBox="0 0 16 16"
                >
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>

                    <path
                        fill-rule="evenodd"
                        d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"
                    />
                </svg>
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
