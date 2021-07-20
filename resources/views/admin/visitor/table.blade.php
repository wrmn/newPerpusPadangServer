@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Pencarian</h4>
                        <form method="GET" action="/admin/visitors/search">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor Anggota</label>
                                        <input type="number" class="form-control" name="no">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tipe</label>
                                        <select name="type" class="form-control">
                                            <option value="1">All</option>
                                            <option value="2">Member</option>
                                            <option value="3">Bukan Member</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="bulan">Bulan Kunjungan</label>
                                    <input type="month" class="form-control" id="bulan" name="bulan">
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
                                    <th scope="col">Status</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Waktu Kunjungan</th>
                                    <th scope="col">Act.</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($visitorsRes as $item)

                                    @if (($stats == 'mem' && $item->memberDetail->status_terdaftar) || ($stats == 'nme' && !$item->memberDetail->status_terdaftar) || $stats == 'all')
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
                                                @if ($item->memberDetail->status_terdaftar)
                                                    Member
                                                @else
                                                    Non-Member
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url("/admin/member/$item->member_no/detail") }}">
                                                    {{ ucwords($item->memberDetail->nama) }}
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
                                    @endif
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
