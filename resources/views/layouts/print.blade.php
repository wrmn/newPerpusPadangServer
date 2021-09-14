<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dinas Perpustakaan dan Kearsipan Kota Padang</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Styles -->
    <style>
        body {
            font-family: TimesNewRoman, "Times New Roman";
            width: 1190px;
        }

    </style>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body style="font-family:'Times New Roman'">
    <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-2">
            <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2F1.bp.blogspot.com%2F-xjhWGEF2CcM%2FT4GYz7ukhFI%2FAAAAAAAAFj0%2FYBVn8Czp6Vc%2Fs1600%2FLOGO%2BKOTA%2BPADANG.png&f=1&nofb=1"
                class="rounded float-left" alt="Responsive image" height="120px">
        </div>
        <div class="col-md-6 text-center">
            <h3>Pemerintah Kota Padang</h3>
            <h2>Dinas Perpustakaan dan Kearsipan Kota Padang</h2>
            <div style="font-family:'Times New Roman'; font-size:12px;color:black;">Jalan Jendral. Sudirman No.1 Padang
                25111 Telp (0751)-8950251 / Fax (0751)-811413</div>
            <div style="font-family:'Times New Roman'; font-size:10px;color:red;">e-mail :
                dns.perpustakaan.kearsipan.pdg@gmail.com website: www.padang.go.id</div>
        </div>
    </div>
    <hr style="height:2px;border-width:4px;color:black;background-color:black">
    @yield('content')
    <div class="row">

        <div class="col-md-1">
        </div>
        <div class="col-md-3">
            <br>
            Kepala Dinas Perpustakaan dan Kearsipan,
            <br> <br> <br> <br>
            ___________________
        </div>
        <div class="col-md-5">
        </div>
        <div class="col-md-3">
            Padang, {{ date_format(now(), 'd F Y') }}<br>
            Pustakawan Mahir,
            <br> <br> <br> <br>
            ___________________
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
    function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }
    window.onload = async function() {
        await sleep(3000);
        window.print();
    }
</script>

</html>
