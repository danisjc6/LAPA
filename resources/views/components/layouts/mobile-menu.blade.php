@php
    $user = auth()->user();
@endphp

<div x-data="{ mobileMenuOpen: false }" @keydown.escape.window="mobileMenuOpen = false" class="lg:hidden">
    {{-- Fundo do menu --}}
    <div x-show="mobileMenuOpen" x-cloak x-transition.opacity @click="mobileMenuOpen = false" class="fixed inset-0 z-40 bg-slate-950/45"></div>
    {{-- Painel expansível --}}
    <section id="menu-mobile-lapa" x-show="mobileMenuOpen" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="translate-y-3 opacity-0" x-transition:enter-end="translate-y-0 opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="translate-y-0 opacity-100" x-transition:leave-end="translate-y-3 opacity-0" aria-label="Menu do LAPA" class="fixed inset-x-3 bottom-[calc(5.75rem+env(safe-area-inset-bottom))] z-50 mx-auto flex max-h-[calc(100dvh-7rem-env(safe-area-inset-bottom))] max-w-md flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-2xl">
        <div class="flex shrink-0 items-center justify-between border-b border-slate-100 px-4 py-3">
            <div>
                <h2 class="text-base font-semibold text-slate-900">Menu</h2>
                <p class="text-xs text-slate-500">Navegação e serviços do LAPA</p>
            </div>
            <button type="button" @click="mobileMenuOpen = false" aria-label="Fechar menu" class="flex h-9 w-9 items-center justify-center rounded-lg text-slate-500 hover:bg-slate-100"><i class="fa-solid fa-xmark" aria-hidden="true"></i></button>
        </div>
        @auth
            <div class="flex shrink-0 items-center gap-3 border-b border-slate-100 bg-slate-50/80 px-4 py-3">
                @if ($user->foto_perfil)
                    <img src="{{ asset('storage/'. $user->foto_perfil) }}" alt="Foto de perfil" class="h-11 w-11 shrink-0 rounded-full object-cover ring-2 ring-white">
                @else
                    <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-emerald-100 text-emerald-800">
                        <i class="fa-solid fa-user" aria-hidden="true"></i>
                    </span>
                @endif
                <div class="min-w-0">
                    <p class="truncate text-sm font-semibold text-slate-900">{{ $user->nome }}</p>
                    <p class="truncate text-xs text-slate-500">{{ $user->role->nome ?? '' }}</p>
                </div>
            </div>
        @endauth
        <nav aria-label="Opções do menu" class="min-h-0 overflow-y-auto p-3">
            {{-- Opções públicas: disponíveis com ou sem login --}}

            <p class="px-3 pb-1 text-[11px] font-semibold uppercase tracking-wider text-slate-400">Explorar o LAPA</p>
            <a href="@if($contato?->link_agendamento_visita) $contato->link_agendamento_visita @endif" target="_blank" rel="noopener noreferrer" class="grid min-h-15 grid-cols-[2.5rem_minmax(0,1fr)_0.75rem] items-center gap-3 rounded-xl px-3 py-2 transition hover:bg-emerald-50">
                <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-50 text-emerald-700"><i class="fa-solid fa-calendar-days" aria-hidden="true"></i></span>
                <span class="min-w-0"><span class="block text-sm font-semibold text-slate-900">Agendar visita</span><span class="block text-xs text-slate-500">Solicite uma visita ao laboratório</span></span>
                <i class="fa-solid fa-chevron-right text-xs text-slate-400" aria-hidden="true"></i>
            </a>
            <a href="#" class="grid min-h-15 grid-cols-[2.5rem_minmax(0,1fr)_0.75rem] items-center gap-3 rounded-xl px-3 py-2 transition hover:bg-emerald-50">
                <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-50 text-emerald-700"><i class="fa-solid fa-circle-info" aria-hidden="true"></i></span>
                <span class="min-w-0"><span class="block text-sm font-semibold text-slate-900">Sobre o LAPA</span><span class="block text-xs text-slate-500">Conheça o laboratório e sua equipe</span></span>
                <i class="fa-solid fa-chevron-right text-xs text-slate-400" aria-hidden="true"></i>
            </a>

            <div class="my-3 border-t border-slate-100"></div>
            {{-- Opções de conta --}}
            <p class="px-3 pb-1 text-[11px] font-semibold uppercase tracking-wider text-slate-400">Minha conta</p>
            @auth
                <a href="{{ route('profile.edit') }}" class="grid min-h-15 grid-cols-[2.5rem_minmax(0,1fr)_0.75rem] items-center gap-3 rounded-xl px-3 py-2 transition hover:bg-emerald-50">
                    <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-50 text-emerald-700"><i class="fa-solid fa-user-gear" aria-hidden="true"></i></span>
                    <span class="min-w-0"><span class="block text-sm font-semibold text-slate-900">Meu perfil</span><span class="block text-xs text-slate-500">Visualize e atualize seus dados</span></span>
                    <i class="fa-solid fa-chevron-right text-xs text-slate-400" aria-hidden="true"></i>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="grid min-h-15 w-full grid-cols-[2.5rem_minmax(0,1fr)_0.75rem] items-center gap-3 rounded-xl px-3 py-2 text-left transition hover:bg-red-50">
                        <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-red-50 text-red-600"><i class="fa-solid fa-right-from-bracket" aria-hidden="true"></i></span>
                        <span class="min-w-0"><span class="block text-sm font-semibold text-red-700">Sair da conta</span><span class="block text-xs text-slate-500">Encerrar sessão</span></span>
                        <span></span>
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="grid min-h-15 grid-cols-[2.5rem_minmax(0,1fr)_0.75rem] items-center gap-3 rounded-xl px-3 py-2 transition hover:bg-emerald-50">
                    <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-50 text-emerald-700"><i class="fa-solid fa-right-to-bracket" aria-hidden="true"></i></span>
                    <span class="min-w-0"><span class="block text-sm font-semibold text-slate-900">Acesso Interno</span><span class="block text-xs text-slate-500">Entrar no sistema</span></span>
                    <i class="fa-solid fa-chevron-right text-xs text-slate-400" aria-hidden="true"></i>
                </a>
            @endauth
        </nav>
    </section>
    {{-- Barra inferior: quatro opções sempre visíveis --}}
    <nav aria-label="Navegação principal mobile" class="fixed inset-x-0 bottom-0 z-50 border-t border-slate-200 bg-white/95 px-3 pt-2 pb-[calc(0.5rem+env(safe-area-inset-bottom))] shadow-[0_-6px_20px_rgba(15,23,42,0.06)] backdrop-blur-md">
        <div class="mx-auto grid w-full max-w-lg grid-cols-4 items-stretch gap-1">
            <a href="{{ route('home') }}" @class(['relative flex h-16 min-w-0 flex-col items-center justify-center gap-1 rounded-xl px-1 py-2 text-center text-[11px] font-medium leading-tight transition-colors', 'text-emerald-600' => request()->routeIs('home'), 'text-slate-500 hover:bg-slate-50 hover:text-emerald-700' => !request()->routeIs('home')]) @if(request()->routeIs('home')) aria-current="page" @endif>
                @if(request()->routeIs('home'))<span class="absolute top-0 h-0.5 w-7 rounded-full bg-emerald-500"></span>@endif
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10.5 12 3l9 7.5V21a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1V10.5Z"/></svg>
                <span>Início</span>
            </a>
            <a href="{{ route('atlas.index') }}" @class(['relative flex h-16 min-w-0 flex-col items-center justify-center gap-1 rounded-xl px-1 py-2 text-center text-[11px] font-medium leading-tight transition-colors', 'text-emerald-600' => request()->routeIs('atlas.*'), 'text-slate-500 hover:bg-slate-50 hover:text-emerald-700' => !request()->routeIs('atlas.*')]) @if(request()->routeIs('atlas.*')) aria-current="page" @endif>
                @if(request()->routeIs('atlas.*'))<span class="absolute top-0 h-0.5 w-7 rounded-full bg-emerald-500"></span>@endif
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.5C9.5 4.8 6.5 4.5 3 5v13c3.5-.5 6.5-.2 9 1.5 2.5-1.7 5.5-2 9-1.5V5c-3.5-.5-6.5-.2-9 1.5Zm0 0v13"/></svg>
                <span>Atlas</span>
            </a>
            <a href="{{ route('modelos-3d.index') }}" @class(['relative flex h-16 min-w-0 flex-col items-center justify-center gap-1 rounded-xl px-1 py-2 text-center text-[11px] font-medium leading-tight transition-colors', 'text-emerald-600' => request()->routeIs('modelos-3d.*'), 'text-slate-500 hover:bg-slate-50 hover:text-emerald-700' => !request()->routeIs('modelos-3d.*')]) @if(request()->routeIs('modelos-3d.*')) aria-current="page" @endif>
                @if(request()->routeIs('modelos-3d.*'))<span class="absolute top-0 h-0.5 w-7 rounded-full bg-emerald-500"></span>@endif
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m12 2 9 5-9 5-9-5 9-5Zm-9 5v10l9 5 9-5V7M12 12v10"/></svg>
                <span>Anatomia 3D</span>
            </a>
            <button type="button" @click="mobileMenuOpen = !mobileMenuOpen" :aria-expanded="mobileMenuOpen.toString()" aria-controls="menu-mobile-lapa" :class="mobileMenuOpen ? 'text-emerald-600' : 'text-slate-500 hover:bg-slate-50 hover:text-emerald-700'" class="relative flex h-16 min-w-0 flex-col items-center justify-center gap-1 rounded-xl px-1 py-2 text-center text-[11px] font-medium leading-tight transition-colors">
                <span x-show="mobileMenuOpen" x-cloak class="absolute top-0 h-0.5 w-7 rounded-full bg-emerald-500"></span>
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h16"/></svg>
                <span>Menu</span>
            </button>
        </div>
    </nav>
</div>
