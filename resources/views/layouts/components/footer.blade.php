<!-- Footer -->
<footer class="mt-5 footer-bottom">
    <div class="flex items-center gap-10 p-8 bg-linear-to-b from-white via-slate-100 to-green-100">
        <div class="text-center">
            <a href="http://ufape.edu.br/">
                <img src="{{ asset('img/logo_ufape_principal.png') }}" style="width: 40px;">
            </a>
        </div>
        <div class="">
            <p class="font-semibold">
                LAPA | Laboratório de Anatomia e Patologia Animal
            </p>
            <address class="m-0">Avenida Bom Pastor, s/n.º - Bairro Boa Vista CEP: 55292-270 - Garanhuns - PE
            </address>
        </div>
        <div class="">

            @php($contato = App\Models\Contato::latest('updated_at')->first())
            @isset($contato->email)
                <p>Email:
                    <a href="mailto:{{ $contato->email ?? '' }}">{{ $contato->email ?? '' }}</a>
                </p>
            @endisset

            @isset($contato->telefone)
                <p>Telefone:
                    <a href="tel:{{ $contato->telefone ?? '' }}">{{ $contato->telefone ?? '' }}</a>
                </p>
            @endisset

            <!-- Facebook -->
            @isset($contato->facebook)
                <a class="facebook-icone" href="{{ isset($contato->facebook) ? $contato->facebook : '#' }}" target="_blank">
                    <i class="fab fa-facebook-f fa-lg white-text"></i>
                </a>
            @endisset

            <!-- Twitter -->
            @isset($contato->twitter)
                <a class="twitter-icone" href="{{ isset($contato->twitter) ? $contato->twitter : '#' }}" target="_blank">
                    <i class="fab fa-twitter fa-lg white-text"></i>
                </a>
            @endisset

            <!-- Instagram -->
            @isset($contato->instagram)
                <a class="instagram-icone" href="{{ isset($contato->instagram) ? $contato->instagram : '#' }}"
                    target="_blank">
                    <i class="fab fa-instagram fa-lg white-text"></i>
                </a>
            @endisset

        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 p-6 bg-linear-to-r from-green-800 to-green-700 text-gray-300">
        <div class="flex flex-col">
            <h6 class="font-bold">Anatomia 3D</h6>

            <a href="#" class="">Osteologia equina</a>
            <a href="#" class="">Cão</a>

        </div>
        <div class="flex flex-col">
            <h6 class="font-bold">Navegação</h6>

            <a href="{{ route('site.atlas.index') }}">Atlas Iterativo</a>
            <a href="{{ route('site.visita.busca') }}">Agendar Visitas</a>
            <a href="{{ route('site.contato.index') }}">Sobre</a>

        </div>
        <div class="flex flex-col">
            <h6 class="font-bold">Conta</h6>

            @guest
                <a href="{{ route('login') }}">Acesso</a>
            @endguest

        </div>
    </div>
    </div>

</footer>

<style>
    .footer-bottom {
        animation: fadeIn 1s ease forwards;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
