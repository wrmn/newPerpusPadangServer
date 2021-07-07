@extends('layouts.print')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No. Member</th>
                                    <th scope="col">Nama Member</th>
                                    <th scope="col">Pekerjaan</th>
                                    <th scope="col">Waktu Kunjungan</th>
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
                                            {{ $item->nama }}
                                        </td>
                                        <td>
                                            {{ $item->pekerjaan }}
                                        </td>
                                        <td>{{ $date->format('H:i d M Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
