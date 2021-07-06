<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dinas Perpustakaan Dan Kearsipan kota padang</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            color: #3d3e44;
            font-family: "Hind", "Helvetica Neue", "Helvetica", "Arial", sans-serif;
            -webkit-font-feature-settings: "kern", "liga", "pnum";
            font-feature-settings: "kern", "liga", "pnum";
            font-size: .9rem;
            line-height: 1.7;
            min-height: 100vh;
            min-width: 320px;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /*Typography*/
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6 {
            font-family: "Hind", "Calibre", "Helvetica Neue", "Helvetica", "Arial", sans-serif;
            -webkit-font-feature-settings: "kern", "liga", "pnum";
            font-feature-settings: "kern", "liga", "pnum";
            -webkit-font-smoothing: antialiased;
            color: #444;
        }

        /*Page Header*/
        .header-hero {
            position: relative;
            z-index: 2;
            height: 100vh;
            overflow: hidden;
            background-color: #212835;
        }

        .hero-wrapper {
            padding: 10px 0;
        }

        .header-hero .hero-bg {
            position: absolute;
            top: 0px;
            width: 100%;
            height: 110%;
            background-size: cover !important;
            background-repeat: no-repeat !important;
            background-position: center center !important;
            -webkit-transform: translateZ(0);
            transform: translateZ(0);
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            -webkit-perspective: 1000;
            perspective: 1000;
            z-index: -1;
        }

        .header-hero .overlay {
            position: absolute;
            top: 0px;
            left: 0px;
            width: 100%;
            height: 100%;
            background-image: -webkit-gradient(linear, left top, right bottom, from(#002f4b), to(#dc4225));
            background-image: linear-gradient(to bottom right, #4d4d4d, #1289AD);
            opacity: .9;
        }

        .header-hero .entry-header h1 {
            line-height: 70px;
            font-style: normal;
            color: #fff;
            font-size: 40px;
            padding-top: 3%;
        }

        .header-hero .entry-header p {
            font-size: 18px;
            color: #b7bde0;
            font-weight: 300;
            line-height: 1.55em;
            margin: 0px auto;
        }

    </style>
</head>

<body>
    <div class="wrapper">
        <section class="header-hero hfeed site">
            <div class="hero-wrapper">
                <div class="hero-bg"
                    style="background: url(https://1.bp.blogspot.com/-xjhWGEF2CcM/T4GYz7ukhFI/AAAAAAAAFj0/YBVn8Czp6Vc/s1600/LOGO+KOTA+PADANG.png">
                </div>
                <div class="overlay"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-2">
                            <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2F1.bp.blogspot.com%2F-xjhWGEF2CcM%2FT4GYz7ukhFI%2FAAAAAAAAFj0%2FYBVn8Czp6Vc%2Fs1600%2FLOGO%2BKOTA%2BPADANG.png&f=1&nofb=1"
                                class="rounded float-left" alt="Responsive image" height="120px">
                        </div>
                        <div class="col-md-10">
                            <header class="entry-header">
                                <h1 class="page-title">Dinas Perpustakaan dan Kearsipan Kota Padang</h1>
                            </header>
                        </div>
                    </div>
                </div>

                <div id="content">

                    <main class="py-4">
                        <div style="padding-top:15vh;">
                            @yield('content')
                        </div>
                    </main>
                </div>
            </div>
            <div class="breadcrumbs-wrapper-line"></div>
        </section>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });

    </script>
</body>

</html>
