@extends('layouts.print')

@section('content')
    <br>
    <center>
        <h1>Kartu Buku</h1>
    </center>
    <br>
    <div class="row">
        <div class="col-md-7">
            @php
                $dateB = new DateTime($bookRes->bookkeepingDetail->tanggal);
            @endphp
            <table class="table">
                <tr>
                    <th scope="row" width="40%">DDC - Nomor Buku</th>
                    <td>{{ $bookRes->ddc }}.{{ $bookRes->no }}</td>
                </tr>
                <tr>
                    <th scope="row">No. IK JK</th>
                    <td>{{ $bookRes->no_induk }}</td>
                </tr>
                <tr>
                    <th scope="row">Tanggal Dibukukan</th>
                    <td>{{ $dateB->format('d M Y') }}</td>
                </tr>
                <tr>
                    <th scope="row">Kategori</th>
                    <td>{{ $bookRes->ddcDetail->group }} - {{ $bookRes->ddcDetail->nama }} </td>
                </tr>
                <tr>
                    <th scope="row">Judul</th>
                    <td>{{ $bookRes->judul }}</td>
                </tr>
                <tr>
                    <th scope="row">Penulis</th>
                    <td>{{ $bookRes->penulis }}</td>
                </tr>
            </table>
        </div>
        <div class="col-md-2">
        </div>
        <div class="col-md-3">
            {!! QrCode::size(250)->generate("book+$bookRes->book_id+$bookRes->ddc.$bookRes->no") !!}
        </div>
    </div>
@endsection
