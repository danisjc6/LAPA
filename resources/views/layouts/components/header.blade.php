<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('titulo', config('app.name'))
    </title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">


    <!-- Tamanho da font do cookie acessibilidade -->
    <script src="{{ asset('js/font_size_acessibilidade.js') }}"></script>
    <!-- Styles -->
    {{-- <link href="{{ asset('css/style.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @livewireScripts
    <link href="{{ asset('css/clndr.css') }}" rel="stylesheet">
    <link href="{{ asset('css/simple-anime.css') }}" rel="stylesheet">

    <!-- Alto contraste -->
    {{-- <link href="{{ asset('css/style_contraste.css') }}" rel="stylesheet" id="css-contraste" disabled="true"> --}}
    <style>
        html[data-sidebar-open="false"] aside[data-sidebar] {
            display: none;
        }
        html[data-sidebar-open="true"] [data-sidebar-toggle] {
            display: none;
        }
    </style>
    <script>
        document.documentElement.dataset.sidebarOpen =
            localStorage.getItem('sidebarOpen') === 'false'
                ? 'false'
                : 'true';
    </script>

    <!-- include summernote css -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

    <script>document.documentElement.classList.add("js")</script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/pesquisa_atlas.js') }}"></script>
    <script src="{{ asset('js/pesquisa_materiais.js') }}"></script>

    <!-- Vlibras -->
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>new window.VLibras.Widget('https://vlibras.gov.br/app');</script>
</head>
