@extends('layouts.guest')

@section('content')

    <section class="page-section bg-primary text-white mb-0" id="about">
        <div class="container">
            <h2 class="page-section-heading text-center text-uppercase text-white">Dinas Kearsipan dan Pembukuan Kota Padang
            </h2>
            <div class="divider-custom divider-light">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-book"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <div class="row">
                <div class="col-lg-4 ms-auto">
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
                <div class="col-lg-4 me-auto">
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
            <div class="row text-center">
                <div class="text-center col-lg-2">
                </div>
                <div class="text-center col-lg-4">
                    <a class="btn btn-xl btn-outline-light" href="{{ url('/guest/register') }}">
                        <i class="fas fa-user me-2"></i>
                        Daftar member
                    </a>
                </div>
                <div class="text-center col-lg-4">
                    <a class="btn btn-xl btn-outline-light" href="{{ url('/search') }}">
                        <i class="fas fa-book me-2"></i>
                        Cari buku
                    </a>
                </div>
                <div class="text-center col-lg-2">
                </div>
            </div>
        </div>
    </section>
@endsection
