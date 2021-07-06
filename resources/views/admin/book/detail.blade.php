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
                                <img src="{{ URL::to('/') }}/images/book/{{ $bookRes->cover }}"
                                    class="rounded mx-auto d-block" height="150px">
                            </div>
                        </div>
                        <table class="table">
                            <tr>
                                <th scope="row" width="20%">DDC - Nomor Buku</th>
                                <td>{{ $bookRes->ddc }}.{{ $bookRes->no }}</td>
                            </tr>
                            <tr>
                                <th scope="row">No IK JK</th>
                                <td>{{ $bookRes->no_ik_jk }}</td>
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
                            <tr>
                                <th scope="row">Status</th>
                                @if ($bookRes->status)
                                    <td>Tersedia</td>
                                @else
                                    <td>Tidak Tersedia</td>
                                @endif
                            </tr>
                            <tr>
                                <th scope="row">Harga</th>
                                <td>Rp. {{ $bookRes->harga }}</td>
                            </tr>
                        </table>
                        <div class="row">
                            <div class="col-lg-6">

                            </div>

                            <div class="col-lg-2 col-md-4">
                                <a href="{{ url("/admin/book/$bookRes->book_id/print") }}" class="btn btn-success w-100">
                                    <i class="fa fa-book"></i>
                                    Cetak
                                </a>
                            </div>
                            <div class="col-lg-2 col-md-4">
                                <a href="{{ url("/admin/book/edit/$bookRes->book_id") }}" class="btn btn-primary w-100">
                                    <i class="fa fa-pencil"></i>
                                    Edit
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
