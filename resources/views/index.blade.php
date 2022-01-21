<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        {{-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> --}}
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel @yield('title')</title>

        <!-- Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800,700,600,300' rel='stylesheet' type='text/css'>
        
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
        <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
        <link rel="stylesheet" href="{{ asset('css/templatemo_misc.css') }}">
        <link rel="stylesheet" href="{{ asset('css/templatemo_style.css') }}">
        @yield('links')
    </head>
    <body>
        
        @include('partials._header')

        @yield('content')

		@include('partials._partnerlist')

        @include('partials._footer')

        <script src="{{ asset('js/vendor/jquery-1.11.0.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.js') }}"></script>
        <script src="{{ asset('js/plugins.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
        @yield('scripts')
    </body>
</html>
