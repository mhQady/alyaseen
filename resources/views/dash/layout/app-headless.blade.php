<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ session('dir') }}">

    @include('dash.layout.head')

    <body class="g-sidenav-show  bg-gray-100 {{ session('dir') }}">

        <main class="main-content border-radius-lg">
            @yield('content')
        </main>

        @include('dash.layout.script')
    </body>

</html>