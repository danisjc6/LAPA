<nav class="flex justify-between items-center bg-white/90 backdrop-blur border-b border-slate-200 p-2 mb-10">
    <a href="{{ route('home') }}" class="mx-6 hover:scale-105">
        <img src="{{ asset('img/lapa-uag.png') }}" width="50px" alt="">
    </a>


    <menu class="flex justify-center items-center gap-6">
        <x-nav-link href="{{ route('site.atlas.index') }}" :active="request()->is('atlas', 'atlas/*')">
            Atlas Interativo
        </x-nav-link>

        <x-nav-link href="{{ route('site.atlas.index') }}">
            Anatomia 3D
        </x-nav-link>

        {{-- <x-nav-dropdown
            label="Anatomia 3D"
            :active="request()->routeIs('*')"
        >
            <x-dropdown-item :href="route('site.visita.busca')">Eventos</x-dropdown-item>
            <x-dropdown-item :href="route('site.visita.busca')">Notícias</x-dropdown-item>
            <x-dropdown-item :href="route('site.visita.busca')">Editais e seleções</x-dropdown-item>
        </x-nav-dropdown> --}}

        <x-nav-link href="{{ route('site.contato.index') }}" :active="Request::is('site/contato/*')">Sobre</x-nav-link>
        <a href="{{ route('site.visita.busca') }}"
            class="bg-green-700 text-white font-bold px-4 py-2 rounded-md hover:scale-102 hover:bg-green-800 shadow-lg shadow-green-600/50">Agendar visita</a>

        <!-- Authentication Links -->
        @auth
            <x-user-dropdown
                label="Postagens"
                :name="Auth::user()->name"
                role="Administrador"
                >
                <x-dropdown-item :href="route('auth.registros')"><i class="fa fa-user me-2"></i>Meu Perfil</x-dropdown-item>
                <x-dropdown-item :href="route('site.visita.busca')"><i class="fa fa-cog me-2"></i>Configurações</x-dropdown-item>

                <hr class="dropdown-divider">

                <x-dropdown-item :href="route('site.visita.busca')">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item text-danger" type="submit">
                            <i class="fa fa-sign-out-alt me-2"></i> Sair
                        </button>
                    </form>
                </x-dropdown-item>
            </x-user-dropdown>
        @endauth
    </menu>
</nav>
