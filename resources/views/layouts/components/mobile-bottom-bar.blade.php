<nav
    class="fixed inset-x-0 bottom-0 z-50 border-t border-slate-200 bg-white/95 px-3 pb-[calc(0.75rem+env(safe-area-inset-bottom))] pt-2 shadow-[0_-8px_24px_rgba(15,23,42,0.08)] backdrop-blur lg:hidden"
>
    <div class="mx-auto grid max-w-md grid-cols-4 gap-1">
        <a
            href="{{ url('/') }}"
            @class([
                'flex flex-col items-center justify-center rounded-2xl px-2 py-2 text-xs font-semibold transition',
                'bg-green-50 text-green-700' => request()->is('/'),
                'text-slate-500 hover:bg-slate-50 hover:text-green-700' => ! request()->is('/'),
            ])
        >
            <svg class="mb-1 h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 10.5 12 3l9 7.5V21a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1V10.5Z" />
            </svg>

            Início
        </a>

        <a
            href="{{ url('/atlas') }}"
            @class([
                'flex flex-col items-center justify-center rounded-2xl px-2 py-2 text-xs font-semibold transition',
                'bg-green-50 text-green-700' => request()->is('atlas*'),
                'text-slate-500 hover:bg-slate-50 hover:text-green-700' => ! request()->is('atlas*'),
            ])
        >
            <svg class="mb-1 h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6.5A2.5 2.5 0 0 1 6.5 4H20v14H6.5A2.5 2.5 0 0 0 4 20.5v-14Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 8h8M8 12h6" />
            </svg>

            Atlas
        </a>

        <button
            type="button"
            class="flex flex-col items-center justify-center rounded-2xl px-2 py-2 text-xs font-semibold text-slate-500 transition hover:bg-slate-50 hover:text-green-700"
            @click="mobileMenuOpen = true"
        >
            <svg class="mb-1 h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.35-4.35M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15Z" />
            </svg>

            Buscar
        </button>

        <button
            type="button"
            class="flex flex-col items-center justify-center rounded-2xl px-2 py-2 text-xs font-semibold text-slate-500 transition hover:bg-slate-50 hover:text-green-700"
            @click="mobileMenuOpen = true"
        >
            <svg class="mb-1 h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h16" />
            </svg>

            Menu
        </button>
    </div>
</nav>
