<nav class="relative z-50 flex items-center justify-between
        overflow-visible
        border-b border-slate-200
        bg-white/90 p-2 mb-10
        backdrop-blur">
    <a href="{{ route('home') }}" class="mx-6 hover:scale-105">
        <img src="{{ asset('img/lapa-uag.png') }}" width="50px" alt="">
    </a>


    <menu class="flex justify-center items-center gap-6">
        <x-nav-link href="{{ route('atlas.index') }}" :active="request()->is('atlas', 'atlas/*')">
            Atlas Interativo
        </x-nav-link>

        <x-nav-link href="{{ route('modelos-3d.index') }}" :active="request()->is('modelos-3d', 'modelos-3d/*')">
            Anatomia 3D
        </x-nav-link>

        {{-- <x-nav-link href="{{ route('site.contato.index') }}" :active="Request::is('site/contato/*')">Sobre</x-nav-link> --}}

        <a href="@if($contato?->link_agendamento_visita) $contato->link_agendamento_visita @endif" target="_blank" rel="noopener noreferrer"
            class="bg-green-700 text-white font-bold px-4 py-2 rounded-md hover:scale-102 hover:bg-green-800 shadow-lg shadow-green-600/50">Agendar visita</a>

        <!-- Authentication Links -->
        @auth
            <x-user-dropdown
                label="Postagens"
                :name="Auth::user()->name"
                role="Administrador"
                >
                <x-dropdown-item :href="route('profile.edit')">
                    <i class="fa fa-user me-2"></i>Meu Perfil
                </x-dropdown-item>
                <x-dropdown-item :href="'#'">
                    <i class="fa fa-cog me-2"></i>Configurações
                </x-dropdown-item>

                <hr class="my-1 border-slate-200">

                <x-dropdown-item>
                    <form id="logout" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button
                            type="submit"
                            class="block w-full cursor-pointer px-4 py-2 text-left text-sm text-red-600 transition-colors hover:bg-red-50"
                            title="Sair"
                        >
                            <i class="fa fa-sign-out-alt me-2"></i>
                            Sair
                        </button>
                    </form>
                </x-dropdown-item>
            </x-user-dropdown>
        @endauth
    </menu>
</nav>
