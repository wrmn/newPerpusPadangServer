@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Ubah Deskripsi</div>
                    <div class="card-body">
                        @if (count($errors) > 0)
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ $error }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endforeach
                        @endif
                        @php
                            if ($ddcRes->ddc < 10) {
                                $id = "00{$ddcRes->ddc}";
                            } elseif ($ddcRes->ddc < 100) {
                                $id = "0{$ddcRes->ddc}";
                            } else {
                                $id = "{$ddcRes->ddc}";
                            }
                        @endphp

                        <form method="POST" action="/admin/ddc/edit/{{ $id }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>DDc</label>
                                        <input type="text" class="form-control" name="ddc" value="{{ $ddcRes->ddc }}"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Kategori</label>
                                        <input type="text" class="form-control" name="group" disabled
                                            value="{{ $ddcRes->group }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text"
                                            class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}"
                                            name="nama" value="{{ $ddcRes->nama }}" required autofocus
                                            oninvalid="this.setCustomValidity('Data dibutuhkan')"
                                            oninput="this.setCustomValidity('')">
                                    </div>
                                </div>
                            </div>
                            <div class=" form-group pull-right">
                                <button class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
