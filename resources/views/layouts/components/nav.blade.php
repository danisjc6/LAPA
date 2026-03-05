<nav class="flex justify-between items-center bg-white/90 backdrop-blur border-b border-slate-200 p-2 mb-10">
    <a href="{{ route('site.home') }}" class="mx-6 hover:scale-105">
        <img src="{{ asset('img/lapa-uag.png') }}" width="50px" alt="">
    </a>


    <menu class="flex justify-center items-center gap-6">
        <x-nav-link href="{{ route('site.atlas.index') }}" :active="request()->is('site/atlas*')">
            Atlas Interativo
        </x-nav-link>
        <x-nav-link href="https://modelos3d.vercel.app/">Anatomia 3D</x-nav-link>

        <x-nav-dropdown
            label="Postagens"
            :active="request()->routeIs('site.postagens.*')"
        >
            <x-dropdown-item :href="route('site.postagens.indexEvento')">Eventos</x-dropdown-item>
            <x-dropdown-item :href="route('site.postagens.indexNoticia')">Notícias</x-dropdown-item>
            <x-dropdown-item :href="route('site.postagens.indexEdital')">Editais e seleções</x-dropdown-item>
        </x-nav-dropdown>

        <x-nav-link href="{{ route('site.materiais.index') }}" :active="Request::is('site/materiais/*')">Materiais</x-nav-link>
        <x-nav-link href="{{ route('site.contato.index') }}" :active="Request::is('site/contato/*')">Sobre</x-nav-link>
        <a href="{{ route('site.visita.busca') }}"
            class="bg-green-700 text-white font-bold px-4 py-2 rounded-md hover:scale-102 hover:bg-green-800 shadow-lg shadow-green-600/50">Agendar visita</a>

        <!-- Authentication Links -->
        @auth
            <li class="nav-item">
                <a href="{{ route('auth.gerenciar') }}" title="Gerenciar"
                    class="nav-link {{ Request::is('gerenciar') || (Request::is('auth/*') && !Request::is('auth/registros')) ? ' active' : '' }}">
                    Gerenciar
                </a>
            </li>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    {{-- <img src="{{ asset('img/avatar.jpg') }}" alt="Avatar" class="rounded-circle shadow-sm" width="40" height="40"> --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                        class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                        <path fill-rule="evenodd"
                            d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                    </svg>
                    <div class="ms-2 d-none d-md-block">
                        <div class="fw-semibold text-dark">{{ Auth::user()->name ?? 'Usuário' }}</div>
                        <small class="text-muted">Administrador</small>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end mt-2 shadow-sm">
                    <li><a class="dropdown-item" href="#"><i class="fa fa-user me-2"></i> Meu Perfil</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fa fa-cog me-2"></i> Configurações</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item text-danger" type="submit">
                                <i class="fa fa-sign-out-alt me-2"></i> Sair
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        @endauth
    </menu>
</nav>
