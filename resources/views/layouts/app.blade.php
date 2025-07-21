<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.components.header')
    <body class="d-flex flex-column min-vh-100" style="background-color: #f3f5fa">

        @include('layouts.components.nav')

        <main class="flex-grow-1">
            @yield('content')
        </main>
        @include('layouts.components.footer')

        @yield('scripts')

    </body>
</html>
