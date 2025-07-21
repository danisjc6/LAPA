<nav class="navbar navbar-expand-lg bg-white py-2">
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
                    <nav class="d-flex flex-md-row flex-column">
                        <li class="nav-item{{ Request::is('gerenciar') || Request::is('auth/*') && !Request::is('auth/registros') ? ' active' : '' }}">
                            <a href="{{ route('auth.gerenciar') }}" title="Gerenciar" class="nav-link">
                                <i class="fas fa-sliders-h"></i> Gerenciar
                            </a>
                        </li>
                        <li class="nav-item{{ Request::is('auth/registros') ? ' active' : '' }}">
                            <a href="{{ route('auth.registros') }}" title="Minha conta" class="nav-link">
                                <i class="fas fa-user"></i> {{ Auth::user()->name ?? "" }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a title="Sair" class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i>
                            </a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                @endauth
            </ul>
        </div>
    </div>
</nav>
