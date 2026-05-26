@props([

])
<div x-data="{ sidebarOpen: true }" class="relative grid grid-cols-12 gap-0">
    <x-layouts.sidebar-left
        title="Atlas Interativo"
        search-placeholder="Pesquisar..."
    />
    <main class="col-span-12 lg:col-span-8 xl:col-span-8 min-w-0 transation-all duration-200"
            :class="sidebarOpen
                ? 'lg:col-span-8 xl:col-span-8'
                : 'lg:col-span-12 xl:col-span-12'">
        <button
            type="button"
            x-show="!sidebarOpen"
            x-transition.opacity
            @click="sidebarOpen = true"
            class="fixed left-5 top-40 z-40 hidden h-11 w-11 items-center justify-center rounded-xl border border-slate-200 bg-white/95 text-slate-600 shadow-lg shadow-slate-200/70 backdrop-blur transition cursor-pointer hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-700 lg:inline-flex"
            aria-label="Abrir menu lateral"
            title="Abrir menu"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M2.5 4.75A.75.75 0 0 1 3.25 4h13.5a.75.75 0 0 1 0 1.5H3.25a.75.75 0 0 1-.75-.75Zm0 5A.75.75 0 0 1 3.25 9h13.5a.75.75 0 0 1 0 1.5H3.25a.75.75 0 0 1-.75-.75Zm.75 4.25a.75.75 0 0 0 0 1.5h13.5a.75.75 0 0 0 0-1.5H3.25Z" clip-rule="evenodd" />
            </svg>
        </button>
        <div class="mx-auto w-full max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            {{ $slot }}
        </div>
    </main>

    {{-- <div class="hidden xl:block xl:col-span-3">
        <x-ui.layouts.sidebar-right>

    </div> --}}
</div>

