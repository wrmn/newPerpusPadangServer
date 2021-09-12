@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <h3>Peminjaman</h3>
                    </div>
                    <div class="card-body">
                        @if (\Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show">{!! \Session::get('success') !!}
                            </div>
                        @endif
                        <h4>Pencarian</h4>
                        <form method="GET" action="/admin/borrows/search">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor Anggota</label>
                                        <input type="text" class="form-control" name="no">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="bulan">Bulan Peminjaman</label>
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
                                    <th scope="col">No. Anggota</th>
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
                                @foreach ($borrowsRes as $item)
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
                                                    class="btn btn-success" data-toggle="tooltip" data-placement="bottom"
                                                    title="Pengembalian Buku">
                                                    <i class="fa fa-check">

                                                    </i>
                                                </a>
                                            @endif
                                            @if ($item->status_denda && $datePayment == '')
                                                <a href="{{ url("/admin/borrow/$item->borrow_id/pay") }}"
                                                    class="btn btn-primary" data-toggle="tooltip" data-placement="bottom"
                                                    title="Bayar Denda">
                                                    <i class="fa fa-money">

                                                    </i>
                                                </a>
                                            @endif
                                            @if (!$item->status_denda && $dateReturn == '')
                                                <a href="{{ url("/admin/borrow/$item->borrow_id/fine") }}"
                                                    class="btn btn-danger" data-toggle="tooltip" data-placement="bottom"
                                                    title="Pemberian Denda">
                                                    <i class="fa fa-money">

                                                    </i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $borrowsRes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
