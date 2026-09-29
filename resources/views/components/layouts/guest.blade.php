@props([
    'title' => 'LAPA',
])

<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="scroll-smooth"
>
    @include('layouts.components.header')

    <body class="flex min-h-screen flex-col bg-slate-100">

        @include('layouts.components.barra_gov')

        @include('layouts.components.messages')

        <main
            class="
                flex flex-1 items-center justify-center
                px-4 py-10 sm:px-6 lg:py-16
            "
        >
            <div class="w-full max-w-md">
                {{ $slot }}
            </div>
        </main>

        @include('layouts.components.footer')

        @stack('scripts')

        {{-- Font Awesome --}}
        <script src="https://kit.fontawesome.com/8eafe50798.js"></script>

        {{-- Máscaras --}}
        <script
            defer
            src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"
        ></script>

        <script
            defer
            src="{{ asset('js/jquery/jquery.inputmask.js') }}"
        ></script>

        <script
            defer
            src="{{ asset('js/jquery/jquery.maskMoney.min.js') }}"
        ></script>

        <script
            defer
            src="{{ asset('js/masks.js') }}"
        ></script>

        {{-- Contraste e cookies --}}
        <script src="{{ asset('js/contraste_cookies.js') }}"></script>

        {{-- Barra Gov.br --}}
        <script>
            window.addEventListener('load', () => {
                const script = document.createElement('script');

                script.src = 'https://barra.brasil.gov.br/barra_2.0.js';
                script.type = 'text/javascript';

                script.onerror = () => {
                    console.warn('Falha ao carregar a barra gov.br.');
                };

                document.body.appendChild(script);
            });
        </script>

    </body>
</html>
