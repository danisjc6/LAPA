<!-- Footer -->
<footer class="mt-5 shadow bg-white">
    <div class="d-flex flex-column flex-md-row justify-content-around align-items-center gap-5 p-4 mb-4">
        <div class="text-center">
            <a href="http://ufape.edu.br/">
                <img src="{{asset('img/logo_ufape_principal.png')}}" style="width: 50px;">
            </a>
        </div>
        <div>
            <p class="m-0 text-secondary">
                LAPA | Laboratório de Anatomia e Patologia Animal
            </p>
            <address class="m-0 text-secondary">Avenida Bom Pastor, s/n.º - Bairro Boa Vista<br>CEP: 55292-270 - Garanhuns - PE</address>
        </div>
        <div class="d-flex justify-content-center gap-3">

            @php($contato = App\Contato::latest('updated_at')->first())
            @if (isset($contato->email))
                <p><b>Email:</b>
                    <a href="mailto:{{ $contato->email ?? '' }}">{{ $contato->email ?? '' }}</a>
                </p>
            @endif

            @if (isset($contato->telefone))
                <p><b>Telefone:</b>
                    <a href="tel:{{ $contato->telefone ?? ''}}">{{ $contato->telefone ?? ''}}</a>
                </p>
            @endif

            <!-- Facebook -->
            @if(isset($contato->facebook))
                <a class="facebook-icone" href="{{ isset($contato->facebook) ? $contato->facebook : '#' }}" target="_blank">
                    <i class="fab fa-facebook-f fa-lg white-text"></i>
                </a>
            @endif

            <!-- Twitter -->
            @if(isset($contato->twitter))
                <a class="twitter-icone" href="{{ isset($contato->twitter) ? $contato->twitter : '#' }}" target="_blank">
                    <i class="fab fa-twitter fa-lg white-text"></i>
                </a>
            @endif

            <!-- Instagram -->
            @if(isset($contato->instagram))
                <a class="instagram-icone" href="{{ isset($contato->instagram) ? $contato->instagram : '#' }}" target="_blank">
                    <i class="fab fa-instagram fa-lg white-text"></i>
                </a>
            @endif

        </div>
    </div>
    <div class="container-fluid p-4 footer-bottom" style="background-color: #00ad50">
        <div class="row text-center text-white pt-4">
            <div class="col-6 col-md-3 mb-3 mb-md-0">
                <h6 class="fw-bold">Anatomia 3D</h6>
                <ul class="list-unstyled small">
                    <li><a href="#" class="text-white text-decoration-none">Osteologia equina</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Cão</a></li>
                </ul>
            </div>
            <div class="col-6 col-md-3 mb-3 mb-md-0">
                <h6 class="fw-bold">Navegação</h6>
                <ul class="list-unstyled small">
                	<li><a href="{{ route('site.atlas.index') }}">Atlas Iterativo</a>
                    <li><a href="{{ route('site.visita.busca') }}">Agendar Visitas</a>
                    <li><a href="{{ route('site.materiais.index') }}">Materiais</a>
                    <li><a href="{{ route('site.contato.index')}}">Sobre</a>
                </ul>
            </div>
            <div class="col-6 col-md-3 mb-3 mb-md-0">
                <h6 class="fw-bold">Postagens</h6>
                <ul class="list-unstyled small">
                    <li><a href="{{ route('site.postagens.indexEvento') }}">Eventos</a>
                    <li><a href="{{ route('site.postagens.indexNoticia') }}">Notícias</a>
                    <li><a href="{{ route('site.postagens.indexEdital') }}">Editais e Seleções</a>
                </ul>
            </div>
            <div class="col-6 col-md-3 mb-3 mb-md-0">
                <h6 class="fw-bold">Conta</h6>
                <ul class="list-unstyled small">
                    @guest
                        <li><a href="{{ route('login') }}">Acesso</a></li>
                    @else
                        <li><a href="{{ route('auth.gerenciar') }}" title="Gerenciar">Gerenciar</a></li>
                        <li><a href="{{ route('auth.registros') }}" title="Minha conta">Minha conta ({{ Auth::user()->name ?? "" }})</a></li>
                        <li><a title="Sair" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sair</a></li>
                    @endguest
                </ul>
            </div>
        </div>
    </div>

</footer>

<style>
    .footer-bottom {
        background-color: #00ad50;
        animation: fadeIn 1s ease forwards;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(30px); }
        to   { opacity: 1; transform: translateY(0); }
    }
</style>