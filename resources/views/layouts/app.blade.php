<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- fontawesome --}}
    <link rel="stylesheet" href="/fontawesome/css/all.css">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    {{-- mycss --}}
    <link rel="stylesheet" href="style.css">
    <style>
        /* font */
        @import url('https://fonts.googleapis.com/css2?family=Merriweather:wght@300&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Merriweather:wght@300&family=Titillium+Web&display=swap');



        /* brand */
        .navbar-brand {
            font-family: 'Merriweather', serif;
            font-weight: 700;
            font-size: 25px;

        }

        /* navbar-nav */
        .navbar-nav,
        .nav-item {
            font-family: 'Titillium Web', sans-serif;
            font-size: 17px;
            font-weight: 800;
        }

        .kartu {
            padding-bottom: 10px;
        }

        /* tombol */
        .tombol {
            border-radius: 20px;
        }

        /* for desktop device */
        @media (min-width: 992px) {

            .navbar-nav,
            .nav-item {
                font-family: 'Titillium Web', sans-serif;
                font-size: 17px;
                font-weight: 800;
                padding-left: 29px;

            }

            .nav-item,
            .na-link,
            .out {
                padding-left: -29px;
            }
        }

    </style>
</head>

<body class="bg-light">
    <div id="app">
        <x-navbar></x-navbar>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
</body>

</html>
