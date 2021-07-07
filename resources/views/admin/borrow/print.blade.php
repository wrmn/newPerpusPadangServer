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
                                    <th scope="col">Buku</th>
                                    <th scope="col">Terdenda</th>
                                    <th scope="col">Terbayar</th>
                                    <th scope="col">Tanggal Pinjam</th>
                                    <th scope="col">Tanggal Kembali</th>
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
