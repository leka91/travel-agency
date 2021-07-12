<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico"> --}}

        <title>Admin | @yield('title')</title>

        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
        <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />

        @yield('links')
        
    </head>
    <body>
        @include('auth.partials._admin-navbar')

        <div class="container-fluid">
            <div class="row">

                @include('auth.partials._admin-sidebar')

                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    @yield('content')
                </div>
            </div>
        </div>

        <script src="{{ asset('js/vendor/jquery-1.11.0.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.js') }}"></script>
        <script src="{{ asset('js/plugins.js') }}"></script>
        <script src="{{ asset('js/admin.js') }}"></script>
        @yield('scripts')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

        <script>
        const inputElement = document.querySelector('input[id="hero_image"]');
        const pond = FilePond.create(inputElement);

        FilePond.setOptions({
            server: {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
                },
                process: {
                    url: '/upload'
                },
                revert: {
                    url: '/upload-remove',
                }
            }
        });
        </script>

        @yield('scripts')
    </body>
</html>