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
                        <a href="{{ url('/admin/bookkeepings/print') }}" class="btn btn-primary"> <i class="fa fa-file"></i>
                            Cetak Laporan</a>
                        <div class="pull-right">
                            <a href="{{ url('/admin/bookkeeping/new') }}" class="btn btn-success">
                                <i class="fa fa-plus">
                                </i>
                                &nbsp;Tambah
                            </a>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">No. Induk</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Sumber</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Act.</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($bookkeepingsRes as $item)
                                    @php
                                        $i++;
                                        $date = new DateTime($item->tanggal);
                                        $link = str_replace('/', '&', $item->no_induk);
                                        
                                    @endphp
                                    <tr>
                                        <th scope="row">{{ $i }}</th>
                                        <th>{{ $item->no_induk }}</th>
                                        <td>{{ $date->format('d M Y') }} </td>
                                        <td>{{ $item->sumber }}</td>
                                        <td>{{ $item->count }}</td>
                                        <td width="20%">
                                            <a href="{{ url("/admin/bookkeeping/book/$link") }}"
                                                class="btn btn-primary" data-toggle="tooltip" data-placement="bottom"
                                                title="Lihat Buku">
                                                <i class="fa fa-book">
                                                </i>
                                            </a>
                                            <a href="{{ url("/admin/bookkeeping/edit/$link") }}" class="btn btn-primary"
                                                data-toggle="tooltip" data-placement="bottom" title="Edit Data">
                                                <i class="fa fa-pencil">
                                                </i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $bookkeepingsRes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
