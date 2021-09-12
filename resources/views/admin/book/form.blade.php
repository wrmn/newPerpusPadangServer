@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <form method="POST" @if ($edit ?? '')
                            action="/admin/book/edit/{{ $bookRes->book_id }}"
                        @elseif($add ?? '') action="/admin/book/new" @endif
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ddcForm">DDC / Kategori / Sub-kategori</label>

                                        <input type="number" name="ddc" list="ddcForm" class="form-control" @if ($edit ?? '') value = "{{ $bookRes->ddc }}"
                                    @elseif ($add ?? '')
                                        @if ($ddc ?? '')
                                            value="{{ $ddc }}"
                                        @else
                                            value="{{ old('ddc') }}" @endif
                                        @endif
                                        required autofocus
                                        oninvalid="this.setCustomValidity('Data dibutuhkan')"
                                        oninput="this.setCustomValidity('')">
                                        <datalist id="ddcForm">
                                            @foreach ($ddcs as $ddc)
                                                @php
                                                    if ($ddc->ddc < 10) {
                                                        $id = "00{$ddc->ddc}";
                                                    } elseif ($ddc->ddc < 100) {
                                                        $id = "0{$ddc->ddc}";
                                                    } else {
                                                        $id = "{$ddc->ddc}";
                                                    }
                                                @endphp
                                                <option value="{{ $id }}">
                                                    {{ $ddc->group }} / {{ $ddc->nama }} </option>
                                            @endforeach
                                        </datalist>
                                    </div>
                                </div>
                                @if ($add ?? '')
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Jumlah Buku</label>
                                            <input type="number" class="form-control" name="total" value="1" required
                                                autofocus oninvalid="this.setCustomValidity('Data dibutuhkan')"
                                                oninput="this.setCustomValidity('')">
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="bookkeepingForm">No Induk</label>
                                        <select id="bookkeepingForm" class="form-control" name="no_induk">
                                            @if ($edit ?? '')
                                                <option value="{{ $bookRes->no_induk }}" selected="selected">
                                                    {{ $bookRes->no_induk }}</option>
                                            @else
                                                @if ($bookkpng ?? '')
                                                    @php
                                                        $link = str_replace('&', '/', $bookkpng);
                                                    @endphp

                                                    <option value="{{ $link }}" selected="selected">
                                                        {{ $link }}</option>
                                                @else
                                                    @foreach ($bookkeepings as $bookkeeping)
                                                        <option value="{{ $bookkeeping->no_induk }}"
                                                            @if (old('no_induk') == $bookkeeping->no_induk) selected="selected" @endif>
                                                            {{ $bookkeeping->no_induk }}</option>
                                                    @endforeach
                                                @endif
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Judul</label>
                                        <input type="text" class="form-control" name="judul" @if ($edit ?? '') value = "{{ $bookRes->judul }}" @elseif ($add ?? '') value="{{ old('judul') }}" @endif
                                            required autofocus oninvalid="this.setCustomValidity('Data dibutuhkan')"
                                            oninput="this.setCustomValidity('')">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Penulis</label>
                                        <input type="text" class="form-control" name="penulis" @if ($edit ?? '') value = "{{ $bookRes->penulis }}" @elseif ($add ?? '') value="{{ old('penulis') }}" @endif
                                            required autofocus oninvalid="this.setCustomValidity('Data dibutuhkan')"
                                            oninput="this.setCustomValidity('')">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Harga (Rp.)</label>
                                        <input type="number" class="form-control" name="harga" @if ($edit ?? '') value = "{{ $bookRes->harga }}" @elseif ($add ?? '') value="{{ old('harga') }}" @endif
                                            required autofocus oninvalid="this.setCustomValidity('Data dibutuhkan')"
                                            oninput="this.setCustomValidity('')">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Cover</label>
                                    <input type="file" name="cover" class="form-control">
                                </div>
                            </div>

                            <div class="form-group pull-right">
                                <button class="btn btn-success">
                                    <i class="fa fa-check"></i>
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
