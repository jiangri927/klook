<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Klook Travel-Activities') }}</title>
    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/fontAwesome/font-awesome.min.css')}}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/header.css') }}" rel="stylesheet">
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet">
    <link href="{{ asset('js/fancybox-master/dist/jquery.fancybox.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/icheck-material.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">
    <link href="{{asset('js/DataTables-1.10.22/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('js/DataTables-1.10.22/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{asset('js/RowReorder-1.2.7/css/rowReorder.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('js/Responsive-2.2.6/css/responsive.dataTables.min.css')}}" rel="stylesheet">

    <!--FavIcon-->
    <link rel="icon" href="{{asset('assets/icons/logo.png')}}" type="image/png">
    @yield('additional_css')
</head>
<body>
    <div id="app">
        @include('layouts.header')

        <main>
            @yield('content')
        </main>
        @include('layouts.footer')

    </div>
</body>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{asset('js/jquery-ui.js')}}"></script>
<script src="{{ asset('js/dropzone.js') }}"></script>
<script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('js/fancybox-master/dist/jquery.fancybox.min.js') }}" type="text/javascript"></script>
<script src="{{asset('js/DataTables-1.10.22/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/Responsive-2.2.6/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('js/RowReorder-1.2.7/js/dataTables.rowReorder.min.js')}}"></script>
@yield('additional_js')
</html>
