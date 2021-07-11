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
                <a href="{{ url('/member') }}" class="col-md-5 mx-2 btn btn-success btn-lg">
                    Member
                </a>
                <a href="{{ url('/guest') }}" class="col-md-5 btn btn-primary btn-lg">
                    Bukan Member
                </a>
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
                                <th scope="col">Status</th>
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
                                    <td>{{ ucwords($item->memberDetail->nama) }}</td>
                                    <td>
                                        @if ($item->memberDetail->status_terdaftar == 1)
                                            Member
                                        @else
                                            Bukan Member
                                        @endif
                                    </td>
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
                                    <td>{{ ucwords($item->nama) }}</td>
                                    <td>Rp {{ number_format($item->total, 0, '', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row gx-4 gx-lg-5 my-2 py-2">
        <div class="col-md-12 ">
            <div class="card">
                <h3 class="font-weight-light">Untuk pendaftaran member akses di localhost:8080/register</h3>
            </div>
        </div>
    </div>
@endsection
