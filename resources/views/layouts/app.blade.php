<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.components.header')
    <body class="d-flex flex-column min-vh-100" style="background-color: #f3f5fa">

        @include('layouts.components.nav')
        @include('layouts.components.messages')
        @include('layouts.')
        <main class="flex-grow-1" style="font-family: 'Roboto', sans-serif;">
            @yield('content')
        </main>
        @include('layouts.components.footer')

        @stack('scripts')
        <!-- Icones do Font Awesome -->
        <script src="https://kit.fontawesome.com/8eafe50798.js"></script>

        <!-- Mascaras -->
        <script defer type="text/javascript" src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
        <script defer type="text/javascript" src="{{ asset('js/jquery/jquery.inputmask.js') }}"></script>
        <script defer type="text/javascript" src="{{ asset('js/jquery/jquery.maskMoney.min.js') }}"></script>
        <script defer="true" src="{{ asset('js/masks.js') }}"></script>

        <!-- Datatable -->
        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
        <script src="{{ asset('js/datatables/datatables.js') }}"></script>

        <!-- include summernote js -->
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
        <script src="{{ asset('js/summernote_config.js') }}"></script>
        <script src="{{ asset('js/summernote_atlas_config.js') }}"></script>

        <!-- include summernote-PT-Br -->
        <script src="{{ asset('js/summernote/lang/summernote-pt-BR.js') }}"></script>

        <!-- include simple-anime library -->
        <script src="{{ asset('js/simple-anime.js') }}"></script>

        <!-- app scripts -->
        <script src="{{ asset('js/animation_config.js') }}"></script>

    </body>
</html>
