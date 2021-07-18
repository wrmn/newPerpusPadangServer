@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <a @if ($ddcInfo ?? '') @php
                                    
                                    if ($ddcInfo->ddc < 10) {
                                        $id = "00{$ddcInfo->ddc}";
                                    } elseif ($ddcInfo->ddc < 100) {
                                        $id = "0{$ddcInfo->ddc}";
                                    } else {
                                        $id = "{$ddcInfo->ddc}";
                                    }
                                @endphp
                                                                            href="{{ url("/admin/ddc/print/$id") }}" 
                                                                
                                            @elseif ($bookkeepingInfo ?? '') 
                                                                    @php
                                                                        $date = new DateTime($bookkeepingInfo->tanggal);
                                                                        $link = str_replace('/', '&', $bookkeepingInfo->no_induk);
                                                                    @endphp
                                                                    href="{{ url("/admin/bookkeeping/print/$link") }}" 
                                                        @else
                                                                                    href="{{ url('/admin/books/print') }}" @endif
                                    class="btn btn-primary"> <i class="fa fa-file"></i>
                                    Cetak
                                    Laporan</a>
                            </div>
                            <div class="col text-right">

                                @if ($ddcInfo ?? '')
                                    <a href="{{ url("/admin/book/new/ddc/$id") }}" class="btn btn-success">

                                    @elseif ($bookkeepingInfo ?? '')
                                        <a class="btn btn-success" hidden>
                                        @else
                                            <a href="{{ url('/admin/book/new') }}" class="btn btn-success">
                                @endif
                                <i class="fa fa-plus"></i>Tambah
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if (\Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show">{!! \Session::get('success') !!}
                            </div>
                        @endif
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

                            <table class="table">
                                <tr>
                                    <th scope="row" width="20%">No. Induk</th>
                                    <td>{{ $bookkeepingInfo->no_induk }}</td>
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
                        @else
                            <form method="GET" action="/admin/books/search">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Judul</label>
                                            <input type="text" class="form-control" name="title" @if (session('forms.title')) value="{{ session('forms.title') }}" @endif>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Pengarang</label>
                                            <input type="text" class="form-control" name="author" @if (session('forms.author')) value="{{ session('forms.author') }}" @endif>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ddcForm">DDC </label>
                                        <select class="form-control" id="ddcForm" name="ddc">
                                            <option value="10" @if (session('forms.ddc') == 10) selected="selected" @endif>
                                                Semua Kategori
                                            </option>
                                            @php
                                                $lists = ['000-099 Karya Umum', '100-199 Filsafat', '200-299 Agama', '300-399 Ilmu Sosial', '400-499 Bahasa', '500-599 Ilmu Murni', '600-699 Ilmu Terapan', '700-799 Seni dan Olahraga', '800-899 Kesusastraan', '900-999 Sejarah dan Geografi'];
                                                $i = 0;
                                            @endphp
                                            @foreach ($lists as $item)
                                                <option value="{{ $i }}" @if (session('forms.ddc') == $i) selected="selected" @endif>
                                                    {{ $item }}
                                                </option>
                                                @php
                                                    $i++;
                                                @endphp
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group pull-right">
                                    <button class="btn btn-primary">Cari</button>
                                </div>

                            </form>
                        @endif
                        @if (count($booksRes) == 0)
                            Data empty
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No Induk</th>
                                        <th scope="col">DDC</th>
                                        <th scope="col">Judul</th>
                                        <th scope="col">Penulis</th>
                                        <th scope="col">Tersedia</th>
                                        <th scope="col">Act.</th>
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
                                            <th scope="row">{{ $item->book_id }}/{{ $item->no_induk }}</th>
                                            <th scope="row">{{ $ddcNo }}.{{ $item->no }}</th>
                                            <td>{{ $caseName }}</td>
                                            <td>{{ $caseAuth }}</td>
                                            <td class="text-center">
                                                @if ($item->status)
                                                    <i class='fa fa-check'></i>
                                                @endif
                                            </td>
                                            <td width="20%" class="text-center">
                                                <a href="{{ url("/admin/book/$item->book_id/detail") }}"
                                                    class="btn btn-primary" data-toggle="tooltip" data-placement="bottom"
                                                    title="Lihat Buku">
                                                    <i class="fa fa-eye">

                                                    </i>
                                                </a>
                                                <a href="{{ url("/admin/book/edit/$item->book_id") }}"
                                                    class="btn btn-primary" data-toggle="tooltip" data-placement="bottom"
                                                    title="Edit Buku">
                                                    <i class="fa fa-pencil">

                                                    </i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                        @endif
                        </tbody>
                        </table>
                        {{ $booksRes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
