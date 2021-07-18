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
                            if ($edit ?? '') {
                                $link = str_replace('/', '&', $bookkeepingRes->no_induk);
                            }
                        @endphp
                        <form method="POST" @if ($edit ?? '') action="/admin/bookkeeping/edit/{{ $link }}"
                        @elseif($add ?? '') action="/admin/bookkeeping/new" @endif>
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>No. Induk</label>
                                        <input type="text"
                                            class="form-control{{ $errors->has('no_induk') ? ' is-invalid' : '' }}"
                                            name="no_induk" @if ($edit ?? '') value ="{{ $bookkeepingRes->no_induk }}"  @elseif ($add ?? '') value="{{ old('no_induk') }}" @endif required autofocus
                                            oninvalid="this.setCustomValidity('Data dibutuhkan')"
                                            oninput="this.setCustomValidity('')">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Sumber</label>
                                        <input type="text"
                                            class="form-control{{ $errors->has('sumber') ? ' is-invalid' : '' }}"
                                            name="sumber" @if ($edit ?? '') value = "{{ $bookkeepingRes->sumber }}" @elseif ($add ?? '') value="{{ old('sumber') }}" @endif required autofocus
                                            oninvalid="this.setCustomValidity('Data dibutuhkan')"
                                            oninput="this.setCustomValidity('')">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Tanggal Pembukuan</label>
                                        <input type="date"
                                            class="form-control{{ $errors->has('tanggal') ? ' is-invalid' : '' }}"
                                            name="tanggal" @if ($edit ?? '') value = "{{ $bookkeepingRes->tanggal }}" @elseif ($add ?? '') value="{{ old('tanggal') }}" @endif required autofocus
                                            oninvalid="this.setCustomValidity('Data dibutuhkan')"
                                            oninput="this.setCustomValidity('')">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group pull-right">
                                <button class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
