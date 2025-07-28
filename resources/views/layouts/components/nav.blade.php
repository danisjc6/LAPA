<nav class="navbar navbar-expand-lg bg-white py-2 mb-5">
    <div class="container">
        <ul class="navbar-nav d-flex flex-row">

            @if(!Request::is('/')
                && !Request::is('site/*/index')
                && !Request::is('gerenciar')
                && !Request::is('site/visita/busca')
                && !Request::is('login'))
                <li class="nav-item mr-2 mr-lg-0">
                    <a title="Voltar" href="#" class="nav-link" type="button" onclick="history.back()">
                        <span class="fas fa-arrow-left"></span>
                    </a>
                </li>
            @endif

            <li class="nav-item {{ Request::is('/') ? ' active' : '' }}">
                <a href="{{ route('site.home') }}"><img src="{{ asset('img/lapa-uag.png') }}" width="70px" alt="">
                </a>
            </li>

        </ul>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <i class="fas fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav gap-3">
                <li class="nav-item">
                    <a href="{{ route('site.atlas.index') }}"  class="nav-link {{ Request::is('site/atlas/*') ? 'active' : '' }}">Atlas Interativo</a>
                </li>
                <li class="nav-item">
                    <a href="https://modelos3d.vercel.app/" class="nav-link">Anatomia 3D</a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('site.visita.busca') }}" class="nav-link {{ Request::is('site/visita/*') ? 'active' : '' }}">Visitas</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Postagens
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('site.postagens.indexEvento') }}">Eventos</a></li>
                        <li><a class="dropdown-item" href="{{ route('site.postagens.indexNoticia') }}">Notícias</a></li>
                        <li><a class="dropdown-item" href="{{ route('site.postagens.indexEdital') }}">Editais e seleções</a></li>
                    </ul>
                </li>

                <li class="nav-item ">
                    <a href="{{ route('site.materiais.index') }}"  class="nav-link {{ Request::is('site/materiais/*') ? 'active' : '' }}">Materiais</a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('site.contato.index') }}"  class="nav-link {{ Request::is('site/contato/*') ? 'active' : '' }}">Sobre</a>
                </li>

                <!-- Authentication Links -->
                @auth
                    <li class="nav-item">
                        <a href="{{ route('auth.gerenciar') }}" title="Gerenciar" class="nav-link {{ Request::is('gerenciar') || Request::is('auth/*') && !Request::is('auth/registros') ? ' active' : '' }}">
                            Gerenciar
                        </a>
                    </li>
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            {{-- <img src="{{ asset('img/avatar.jpg') }}" alt="Avatar" class="rounded-circle shadow-sm" width="40" height="40"> --}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                            </svg>
                            <div class="ms-2 d-none d-md-block">
                                <div class="fw-semibold text-dark">{{ Auth::user()->name ?? 'Usuário' }}</div>
                                <small class="text-muted">Administrador</small>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end mt-2 shadow-sm">
                            <li><a class="dropdown-item" href="#"><i class="fa fa-user me-2"></i> Meu Perfil</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fa fa-cog me-2"></i> Configurações</a></li>
                            <li><hr class="dropdown-divider"></li>
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
            </ul>
        </div>
    </div>
</nav>
