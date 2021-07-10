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
            <h1 class="font-weight-heavy">Selamat Datang</h1>
            <h4 class="font-weight-light">Silahkan pilih metode Check-in</h4>
            <div class="row">
                <div class="col-md-5 mx-2 btn btn-success btn-lg">
                    <a href="{{ url('/member') }}">Member</a>
                </div>
                <div class="col-md-5 btn btn-primary btn-lg">
                    <a href="{{ url('/guest') }}">Bukan Member</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Row-->
    <div class="row gx-4 gx-lg-5">
        <div class="col-md-6 ">
            <div class="card" style="height: 50vh">
                <div class="card-header">
                    <h4 class="card-title">Pengunjung Terbaru</h4>
                </div>
                <div class="card-body">
                    <table class="table content-table">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Waktu Kunjungan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($visitorRes as $item)
                                @php
                                    $i++;
                                    $date = new DateTime($item->waktu_kunjungan);
                                @endphp
                                <tr>
                                    <th scope="row">{{ $i }}</th>
                                    <td>{{ $item->memberDetail->nama }}</td>
                                    <td width="50%">{{ $date->format('H:i d-M-Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card" style="height: 50vh">
                <div class="card-header">
                    <h4 class="card-title">Denda Member</h4>
                </div>
                <div class="card-body">
                    <table class="table content-table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">No. Member</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Denda</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($finesRes as $item)
                                @php
                                    $j++;
                                @endphp
                                <tr>
                                    <th scope="row">{{ $j }}</th>
                                    <td>{{ $item->member_no }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
