@extends('layouts.print')

@section('content')
    <br>
    <center>
        <h1>Kartu Anggota</h1>
    </center>
    <br>
    <div class="row">
        <div class="col-md-4">
            <img src="{{ URL::to('/') }}/images/picture/{{$memberRes->foto_file}}" alt="Pas Photo"
                                    class="rounded mx-auto d-block" height="250px" width="250px">
        </div>
        <div class="col-md-4">
            @php
                $dateB = new DateTime($memberRes->tanggal_lahir);
            @endphp
            <table class="table">
                <tr>
                    <th scope="row" width="20%">Nomor Anggota</th>
                    <td>{{ $memberRes->member_no }}</td>
                </tr>
                <tr>
                    <th scope="row" width="20%">Nama</th>
                    <td>{{ $memberRes->nama }}</td>
                </tr>
                <tr>
                    <th scope="row">Tempat/Tanggal Lahir</th>
                    <td>{{ $memberRes->tempat_lahir }} / {{ $dateB->format('d M Y') }}</td>
                </tr>
                <tr>
                    <th scope="row">Alamat</th>
                    <td>{{ $memberRes->alamat }}</td>
                </tr>
                <tr>
                    <th scope="row">Pekerjaan</th>
                    <td>{{ $memberRes->jobDetail->pekerjaan }}</td>
                </tr>
                <tr>
                    <th scope="row">Instansi</th>
                    <td>{{ $memberRes->nama_instansi }}</td>
                </tr>
                <tr>
                    <th scope="row">Nomor Telepon</th>
                    <td>{{ $memberRes->telepon_no }}</td>
                </tr>
                <tr>
                    <th scope="row">Nomor Identitas</th>
                    <td>{{ $memberRes->identitas_no }}</td>
                </tr>
            </table>
        </div>
        <div class="col-md-4">
            @php
                $memberNo = $memberRes->member_no;
                while (strlen($memberNo) < 5) {
                    $memberNo="0$memberNo";
                }
            @endphp
            {!! QrCode::size(250)->generate("member+$memberNo$memberRes->identity_no") !!}
        </div>
    </div>
@endsection
