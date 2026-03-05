<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    @include('layouts.components.header')
    <body class="flex flex-col min-h-screen bg-slate-100">

        @include('layouts.components.nav')
        @include('layouts.components.messages')
        <main class="flex-1">
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
