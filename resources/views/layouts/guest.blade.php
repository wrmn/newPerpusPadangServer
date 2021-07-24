<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dinas Perpustakaan Dan Kearsipan Kota Padang</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/JsQRScanner.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('js/qr/jsqrscanner.nocache.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.4.1/dist/chart.min.js"></script>

    <style>
        .demo {
            margin: 0 auto;
            padding-top: 64px;
            max-width: 640px;
            width: 94%;
        }

        .footer {
            position: absolute;
            right: 0;
            bottom: 0;
            left: 0;
            padding: 1rem;
            background-color: #efefef;
            text-align: center;
        }

        .content-table {
            overflow-y: scroll;
            height: 100%;
            display: block;
        }

        .content-table::-webkit-scrollbar {
            display: none;
        }

    </style>
</head>

<body style="overflow-y:hidden;background: radial-gradient(circle, rgba(158,251,251,1) 0%, rgba(190,234,236,1) 25%, rgba(230,255,254,1) 50%, rgba(202,236,245,1) 75%, rgba(162,239,255,1) 100%);
">
    <nav class="navbar navbar-dark" style="background: linear-gradient(167deg, rgba(0,11,93,0.7567401960784313) 27%, rgba(13,87,231,0.7511379551820728) 70%); width:25vw;
        ">

        <div class="d-md-flex d-block flex-row mx-md-auto mx-0">
            <h1><a class="text-light" href="#">Dinas Perpustakaan dan Kearsipan Kota Padang</a></h1>
        </div>
    </nav>
    <!-- Page Content-->
    <div class="container px-4 px-lg-5">
        @yield('content')

    </div>

    <!-- Footer-->

    <div class="py-3 bg-dark footer">
        <div class="container px-4 px-lg-5">
            <p class="m-0 text-center text-white">Copyright &copy; Dinas Perpustakaan Dan Kearsipan Kota Padang 2021</p>
        </div>
    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
</body>

</html>
