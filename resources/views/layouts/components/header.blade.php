<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>
            @yield('titulo') | LAPA - UFAPE
        </title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;1,300;1,400;1,600&display=swap" rel="stylesheet">
        {{-- <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet"> --}}

        <!-- Tamanho da font do cookie acessibilidade -->
        <script src="{{ asset('js/font_size_acessibilidade.js') }}"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
        <!-- Styles -->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/nav.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <link href="{{ asset('css/clndr.css') }}" rel="stylesheet">
        <link href="{{ asset('css/simple-anime.css') }}" rel="stylesheet">

        <!-- Alto contraste -->
        <link href="{{ asset('css/style_contraste.css') }}" rel="stylesheet" id="css-contraste" disabled="true">
        <script>
            var linkCssContraste = document.getElementById("css-contraste");
            if( localStorage.getItem("contraste") === "true" ) {
                linkCssContraste.removeAttribute('disabled');
            }
        </script>

        <!-- Bootstrap Datepicker -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.standalone.min.css">

        <!-- Datatable -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

        <!-- include summernote css -->
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

        <script>document.documentElement.classList.add("js")</script>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/pesquisa_atlas.js') }}"></script>
        <script src="{{ asset('js/pesquisa_materiais.js') }}"></script>

        <!-- reCAPTCHA-->
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <!-- Vlibras -->
        <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
        <script>new window.VLibras.Widget('https://vlibras.gov.br/app');</script>
        <!-- br barra-->
        <script defer="defer" src="//barra.brasil.gov.br/barra_2.0.js" type="text/javascript"></script>
    </head>
    <body>
    @include('layouts.components.barra_gov')
    @include('layouts.components.barra_acessibilidade')

    <!-- contraste cookies -->
    <script src="{{ asset('js/contraste_cookies.js') }}"></script>


