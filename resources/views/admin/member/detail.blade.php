@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if (\Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show">{!! \Session::get('success') !!}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-lg-6 md-12">
                                @if ($memberRes->status_terdaftar)
                                    <img src="{{ URL::to('/') }}/images/picture/{{ $memberRes->foto_file }}"
                                        alt="Pas Photo" class="rounded mx-auto d-block" height="150px">
                                @endif
                            </div>
                            <div class="col-lg-6 col-md-12">
                                @if ($memberRes->status_terdaftar)
                                    <img src="{{ URL::to('/') }}/images/identity/{{ $memberRes->identitas_file }}"
                                        alt="Foto Identitas" class="rounded mx-auto d-block" height="150px">
                                @endif
                            </div>
                        </div>
                        @php
                            $dateB = new DateTime($memberRes->tanggal_lahir);
                        @endphp
                        <table class="table">
                            <tr>
                                <th scope="row" width="20%">Nomor Anggota</th>
                                <td>
                                    @if ($memberRes->status_terdaftar)
                                        {{ $memberRes->member_no }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" width="20%">Nama</th>
                                <td>{{ $memberRes->nama }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Tempat/Tanggal Lahir</th>
                                <td>
                                    @if ($memberRes->status_terdaftar)
                                        {{ $memberRes->tempat_lahir }} / {{ $dateB->format('d M Y') }}
                                    @else
                                        -
                                    @endif
                                </td>
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
                                <td>
                                    @if ($memberRes->status_terdaftar)
                                        {{ $memberRes->telepon_no }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Nomor Identitas</th>
                                <td>
                                    @if ($memberRes->status_terdaftar)
                                        {{ $memberRes->identitas_no }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        </table>
                        <div class="row">
                            <div class="col-lg-4">

                            </div>
                            @if (!$memberRes->verivied && $memberRes->status_terdaftar)
                                <div class="col-lg-2 col-md-4">
                                    <a class="btn btn-success w-100"
                                        onclick="return confirm('Verifikasi data {{ $memberRes->nama }}?')"
                                        href="{{ url("/admin/member/$memberRes->member_no/accept") }}">
                                        <i class="fa fa-check"></i>
                                        Accept
                                    </a>
                                </div>
                            @else
                                <div class="col-lg-2">

                                </div>
                            @endif
                            @if ($memberRes->status_terdaftar)
                                @if ($memberRes->verivied == 1)
                                    <div class="col-lg-2 col-md-4">
                                        <a href="{{ url("/admin/member/$memberRes->member_no/print") }}"
                                            class="btn btn-primary w-100">
                                            <i class="fa fa-file-text"></i>
                                            Cetak
                                        </a>
                                    </div>
                                @endif
                                <div class="col-lg-2 col-md-4">
                                    <a href="{{ url("/admin/member/$memberRes->member_no/edit") }}"
                                        class="btn btn-primary w-100">
                                        <i class="fa fa-pencil"></i>
                                        Edit
                                    </a>
                                </div>
                                @if ($memberRes->verivied == 0)
                                    <div class="col-lg-2 col-md-4">
                                        <a class="btn btn-danger w-100"
                                            onclick="return confirm('Hapus data {{ $memberRes->nama }}?')"
                                            href="{{ url("/admin/member/$memberRes->member_no/delete") }}">
                                            <i class="fa fa-close"></i>
                                            Delete
                                        </a>
                                    </div>
                                @endif
                            @endif
                        </div>
                        @if ($memberRes->verivied == 1)
                            @if (count($borrowRes) != 0)
                                <h3>Peminjaman</h3>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">No. Member</th>
                                            <th scope="col">Buku</th>
                                            <th scope="col">Terdenda</th>
                                            <th scope="col">Terbayar</th>
                                            <th scope="col">Tanggal Pinjam</th>
                                            <th scope="col">Tanggal Kembali</th>
                                            <th scope="col">Act.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($borrowRes as $item)
                                            @php
                                                $dateBorrow = new DateTime($item->tanggal_peminjaman);
                                                $dateReturn = '';
                                                $datePayment = '';
                                                
                                                if ($item->tanggal_pengembalian != '') {
                                                    $dateReturn = new DateTime($item->tanggal_pengembalian);
                                                }
                                                if ($item->tanggal_pembayaran != '') {
                                                    $datePayment = new DateTime($item->tanggal_pembayaran);
                                                }
                                            @endphp
                                            <tr>
                                                <th scope="row">
                                                    <a href="{{ url("/admin/member/$item->member_no/detail") }}">{{ $item->member_no }}
                                                    </a>
                                                </th>
                                                <td>
                                                    <a href="{{ url("/admin/book/$item->book_id/detail") }}">
                                                        {{ $item->bookDetail->ddc }}.{{ $item->bookDetail->no }}
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    @if ($item->status_denda)
                                                        <i class='fa fa-check'></i>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($item->tanggal_pembayaran != '' && $item->status_denda == true)
                                                        <i class='fa fa-check'></i>
                                                    @endif
                                                </td>
                                                <td>{{ $dateBorrow->format('d M Y') }}</td>
                                                <td>
                                                    @if ($dateReturn != '')
                                                        {{ $dateReturn->format('d M Y') }}
                                                    @endif
                                                </td>
                                                <td width="20%">
                                                    @if ($dateReturn == '' && ($datePayment != '' || !$item->status_denda))
                                                        <a href="{{ url("/admin/borrow/$item->borrow_id/return") }}"
                                                            class="btn btn-success" data-toggle="tooltip"
                                                            data-placement="bottom" title="Pengembalii
                                                                    i
                                                                    </i>
                                                                </a>
                                                              @endif
                                                            @if ($item->status_denda && $datePayment == '')
                                                                <a href="{{ url("/admin/borrow/$item->borrow_id/pay") }}"
                                                                    class="btn btn-primary" data-toggle="tooltip"
                                                                    data-placement="bottom" title="Bayar Denda">
                                                                    <i class="fa fa-money">

                                                                    </i>
                                                                </a>
                                                            @endif
                                                            @if (!$item->status_denda && $dateReturn == '')
                                                                <a href="{{ url("/admin/borrow/$item->borrow_id/fine") }}"
                                                                    class="btn btn-danger" data-toggle="tooltip"
                                                                    data-placement="bottom" title="Pemberian Denda">
                                                                    <i class="fa fa-money">

                                                                    </i>
                                                                </a>
                                                            @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif

                            @if (count($visitRes) != 0)
                                <h3>Kunjungan</h3>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">No. Member</th>
                                            <th scope="col">Nama Member</th>
                                            <th scope="col">Waktu Kunjungan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 0;
                                        @endphp

                                        @foreach ($visitRes as $item)
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
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
