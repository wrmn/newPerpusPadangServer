@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">

                        <a href="{{ url('/visitors/print') }}" class="btn btn-primary"> <i class="fa fa-file"></i> Cetak
                            Laporan</a>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="/admin/visitors/search">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dari tanggal</label>
                                        <input type="date" class="form-control" name="from">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Hingga Tanggal</label>
                                        <input type="date" class="form-control" name="to">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group pull-right">
                                <button class="btn btn-primary">Cari</button>
                            </div>
                        </form>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No. Member</th>
                                    <th scope="col">Nama Member</th>
                                    <th scope="col">Waktu Kunjungan</th>
                                    <th scope="col">Act.</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp

                                @foreach ($visitorsRes as $item)
                                    @php
                                        $date = new DateTime($item->waktu_kunjungan);
                                    @endphp
                                    <tr>
                                        <th>
                                            @if ($item->memberDetail->status_terdaftar)
                                                <a href="{{ url("/admin/member/$item->member_no/detail") }}">
                                                    {{ $item->member_no }}
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </th>
                                        <td>
                                            <a href="{{ url("/admin/member/$item->member_no/detail") }}">
                                                {{ $item->memberDetail->nama }}
                                            </a>
                                        </td>
                                        <td>{{ $date->format('H:i d M Y') }}</td>
                                        <td width="10%">
                                            <a href="{{ url("/member/$item->member_no") }}" class="btn btn-primary"
                                                data-toggle="tooltip" data-placement="bottom" title="Lihat Member">
                                                <i class="fa fa-eye">

                                                </i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $visitorsRes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
