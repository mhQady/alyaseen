<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ session('dir') }}">
    @include('dash.layout.head')

    <body class="g-sidenav-show  bg-gray-100 {{ session('dir') }}">

        @include('dash.layout.aside')

        <main class="main-content border-radius-lg">

            @include('dash.layout.header')

            <div class="container-fluid py-4" style="min-height: 83vh">

                @yield('content')


            </div>
            @include('dash.layout.footer')
        </main>

        @include('dash.layout.script')
    </body>

</html>