@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <h4> Laporan Pengunjung</h4>
                                <form method="GET" action="/admin/visitor/print">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="bulan">Bulan Kunjungan</label>
                                            <input type="month" class="form-control" id="bulan" name="bulan" required>
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn btn-primary">Cetak</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <h4> Laporan Peminjaman</h4>
                                <form method="GET" action="/admin/borrows/print">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="bulan">Bulan Peminjaman</label>
                                            <input type="month" class="form-control" id="bulan" name="bulan" required>
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn btn-primary">Cetak</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
