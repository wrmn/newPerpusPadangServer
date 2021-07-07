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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar">
            <ul class="list-unstyled components">
                <li>
                    <a href="{{ url('/admin') }}">Dashboard</a>
                </li>
                <li>
                    <div>Buku</div>
                    <ul class="show collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="{{ url('/admin/ddcs') }}">DDC</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/bookkeepings') }}">Pembukuan</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/books') }}">List Buku</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <div>Peminjaman</div>
                    <ul class="show collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="{{ url('/borrows') }}">Peminjaman</a>
                        </li>
                        <li>
                            <a href="{{ url('/borrows/fines') }}">Pengembalian</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/borrows') }}">List Peminjaman</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <div>Member</div>
                    <ul class="show collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="{{ url('/admin/members/unregistered') }}">Pendaftaran</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/members/registered') }}">List Member</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/visitors') }}">Kunjungan</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ url('/admin/report') }}">Laporan</a>
                </li>
                <li>
                    <a href="{{ route('logout') }}"> Logout </a>
                </li>
            </ul>

        </nav>
        <div id="content">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <button type="button" id="sidebarCollapse" class="btn btn-danger">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <br>
                    <a href="javascript:history.back()" class="btn btn-outline-primary">
                        <-- </a>
                            &nbsp;&nbsp
                            <a class="navbar-brand" href="{{ url('/') }}">
                                Dinas Perpustakaan Dan Kearsipan Kota Padang
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <!-- Left Side Of Navbar -->
                                <ul class="navbar-nav mr-auto">

                                </ul>

                                <!-- Right Side Of Navbar -->
                                <ul class="navbar-nav ml-auto">
                                    <!-- Authentication Links -->
                                    @guest
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                        </li>
                                        @if (Route::has('register'))
                                            <li class="nav-item">
                                                <a class="nav-link"
                                                    href="{{ route('register') }}">{{ __('Register') }}</a>
                                            </li>
                                        @endif
                                    @else
                                    @endguest
                                </ul>
                            </div>
                </div>
            </nav>

            <main class="py-4">
                @yield('content')
            </main>
        </div>
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
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</body>

</html>
