@extends('layouts.guest')

@section('content')
    @php
    $i = $j = 0;
    @endphp
    <div class="row gx-4 gx-lg-5 align-items-center my-4">
        <div class="col-lg-2">
            <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2F1.bp.blogspot.com%2F-xjhWGEF2CcM%2FT4GYz7ukhFI%2FAAAAAAAAFj0%2FYBVn8Czp6Vc%2Fs1600%2FLOGO%2BKOTA%2BPADANG.png&f=1&nofb=1"
                class="img-fluid rounded mb-4 mb-lg-0" alt="Responsive image">
        </div>

        <div class="col-lg-10">
            <h1 class="font-weight-heavy">Selamat Datang</h1>
            <h4 class="font-weight-light">Silahkan Masukkan Data Anda Untuk Check-In</h4>
        </div>
    </div>
    <!-- Content Row-->
    <div class="row gx-4 gx-lg-5">

        <div class="card">
            <div class="card-body">
                @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger fade show" role="alert">
                            {{ $error }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endforeach
                @endif
                <form method="POST" action="/guest" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="nama" value="{{ old('nama') }}" required
                                    autofocus oninvalid="this.setCustomValidity('Data dibutuhkan')"
                                    oninput="this.setCustomValidity('')">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" class="form-control" name="alamat" value="{{ old('alamat') }}" required
                                    autofocus oninvalid="this.setCustomValidity('Data dibutuhkan')"
                                    oninput="this.setCustomValidity('')">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pekerjaan</label>
                                <select id="bookkeepingForm" class="form-control" name="pekerjaan">
                                    <option value="">
                                        ---Pilih Pekerjaan---</option>
                                    @foreach ($jobsRes as $job)
                                        <option value="{{ $job->job_id }}" @if (old('pekerjaan') == $job->job_id) selected="selected" @endif>
                                            {{ $job->pekerjaan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Instansi</label>
                                <input type="text" class="form-control" name="nama_instansi"
                                    value="{{ old('nama_instansi') }}" required autofocus
                                    oninvalid="this.setCustomValidity('Data dibutuhkan')"
                                    oninput="this.setCustomValidity('')">
                            </div>
                        </div>
                    </div>
                    <div class="form-group pull-right">
                        <a class="btn btn-danger" href="{{ url('/') }}">
                            <i class="fa fa-times"></i>
                            Kembali
                        </a>
                        <button class="btn btn-success">
                            <i class="fa fa-check"></i>
                            Check-in
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
