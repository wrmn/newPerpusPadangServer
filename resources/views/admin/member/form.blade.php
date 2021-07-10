@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
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
                        <form method="POST" action="/admin/member/{{ $memberRes->member_no }}/edit"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" class="form-control" name="nama" value="{{ $memberRes->nama }}"
                                            required autofocus oninvalid="this.setCustomValidity('Data dibutuhkan')"
                                            oninput="this.setCustomValidity('')">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Tempat Lahir</label>
                                        <input type="text" class="form-control" name="tempat_lahir"
                                            value="{{ $memberRes->tempat_lahir }}" required autofocus
                                            oninvalid="this.setCustomValidity('Data dibutuhkan')"
                                            oninput="this.setCustomValidity('')">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Tanggal Lahir</label>
                                        <input type="date" class="form-control" name="tanggal_lahir"
                                            value="{{ $memberRes->tanggal_lahir }}" required autofocus
                                            oninvalid="this.setCustomValidity('Data dibutuhkan')"
                                            oninput="this.setCustomValidity('')">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <input type="text" class="form-control" name="alamat"
                                            value="{{ $memberRes->alamat }}" required autofocus
                                            oninvalid="this.setCustomValidity('Data dibutuhkan')"
                                            oninput="this.setCustomValidity('')">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pekerjaan</label>
                                        <select id="bookkeepingForm" class="form-control" name="pekerjaan">
                                            @foreach ($jobsRes as $job)
                                                <option value="{{ $job->job_id }}" @if (old('pekerjaan') == $job->job_id || $memberRes->job_id == $job->job_id) selected="selected" @endif>
                                                    {{ $job->pekerjaan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Instansi</label>
                                        <input type="text" class="form-control" name="nama_instansi"
                                            value="{{ $memberRes->nama_instansi }}" required autofocus
                                            oninvalid="this.setCustomValidity('Data dibutuhkan')"
                                            oninput="this.setCustomValidity('')">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor Telepon</label>
                                        <input type="text" class="form-control" name="telepon_no"
                                            value="{{ $memberRes->telepon_no }}" required autofocus
                                            oninvalid="this.setCustomValidity('Data dibutuhkan')"
                                            oninput="this.setCustomValidity('')">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor Identitas</label>
                                        <input type="text" class="form-control" name="identitas_no"
                                            value="{{ $memberRes->identitas_no }}" required autofocus
                                            oninvalid="this.setCustomValidity('Data dibutuhkan')"
                                            oninput="this.setCustomValidity('')">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Pas Foto</label>
                                    <input type="file" name="foto_file" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label>Identitas</label>
                                    <input type="file" name="identitas_file" class="form-control">
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
