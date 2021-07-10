@extends('layouts.guest')

@section('content')
    @php
    $i = $j = 0;
    @endphp
    <div class="row gx-4 gx-lg-5 align-items-center my-4">
        <div class="col-lg-2">
            <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2F1.bp.blogspot.com%2F-xjhWGEF2CcM%2FT4GYz7ukhFI%2FAAAAAAAAFj0%2FYBVn8Czp6Vc%2Fs1600%2FLOGO%2BKOTA%2BPADANG.png&f=1&nofb=1"
                class="img-fluid rounded mb-4 mb-lg-0" alt="Responsive image">
        </div>

        <div class="col-lg-10">
            <h1 class="font-weight-heavy">Selamat Datang {{ $name }}</h1>
            <h4 class="font-weight-light">Jangan Lupa Menaati peraturan yang ada</h4>
        </div>
    </div>
    <!-- Content Row-->
    <div class="row gx-4 gx-lg-5">
        <div class="row">
            <div class="col-lg-6 ms-auto">
                <h3>Persyaratan Anggota</h3>
                <ul>
                    <li>Berdomisili kota Padang</li>
                    <li>Mengisi formulir Pendaftaran</li>
                    <li>Melampirkan photocopy kartu identitas yang masih berlaku</li>
                    <li>Kartu keanggotaan hanya berlaku bagi pemilik</li>
                    <li>Maksimal meminjam 3 buku</li>
                    <li>Mengganti buku yang hilang ketika dipinjam</li>
                </ul>
            </div>
            <div class="col-lg-6 me-auto">
                <h3>Tata Tertib Pengunjung</h3>
                <ul>
                    <li>Mengisi formulir tamu</li>
                    <li>Menitipkan barang bawaan pada locker yang telah disediakan dan harap dikunci</li>
                    <li>Dilarang membawa jaket, tas, topi, dan helm</li>
                    <li>Tidak diizinkan makan, minum, dan merokok</li>
                    <li>Tidak diizinkan mencoret, melipat, menstabilo dan merobek koleksi perpustakaan</li>
                    <li>Meletakkan kembali buku yang telah dibaca sesuai dengan kode klasifikasinya</li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        window.setTimeout(function() {

            // Move to a new location or you can do something else
            window.location.href = "{{ url('/') }}";

        }, 5000);
    </script>
@endsection
