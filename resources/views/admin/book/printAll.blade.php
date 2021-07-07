@extends('layouts.print')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if ($ddcInfo ?? '')
                            <table class="table">
                                <tr>
                                    <th scope="row" width="20%">Ddc</th>
                                    <td>{{ $ddcInfo->ddc }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Group</th>
                                    <td>{{ $ddcInfo->group }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Kategori</th>
                                    <td>{{ $ddcInfo->nama }}</td>
                                </tr>
                            </table>
                        @elseif ($bookkeepingInfo ?? '')
                            @php
                                $date = new DateTime($bookkeepingInfo->tanggal);
                            @endphp
                            <table class="table">
                                <tr>
                                    <th scope="row" width="20%">No. IK JK</th>
                                    <td>{{ $bookkeepingInfo->no_ik_jk }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Tanggal</th>
                                    <td>{{ $date->format('d M Y') }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Sumber</th>
                                    <td>{{ $bookkeepingInfo->sumber }}</td>
                                </tr>
                            </table>
                        @endif
                        @if (count($booksRes) == 0)
                            Data empty
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Judul</th>
                                        <th scope="col">Penulis</th>
                                        <th scope="col">Tersedia</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($booksRes as $item)
                                        @php
                                            $caseName = ucwords($item->judul);
                                            $caseAuth = ucwords($item->penulis);
                                            $ddcNo = $item->ddc;
                                            
                                        @endphp
                                        <tr>
                                            <th scope="row">{{ $ddcNo }}.{{ $item->no }}</th>
                                            <td>{{ $caseName }}</td>
                                            <td>{{ $caseAuth }}</td>
                                            <td class="text-center">
                                                @if ($item->status)
                                                    <i class='fa fa-check'></i>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                        @endif
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
