@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        {{-- <a href="{{ url('/ddcs/print/all') }}" class="btn btn-primary"> <i class="fa fa-file"></i> Cetak
                            Laporan</a> --}}
                        <form method="GET" action="/admin/ddc/search">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ddcForm">DDC / Kategori / Sub-kategori</label>

                                        <input type="number" name="ddc" list="ddcForm" class="form-control" @if ($edit ?? '') value = "{{ $bookRes->ddc }}" @elseif ($add ?? '') value="{{ old('ddc') }}" @endif required autofocus
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
                            </div>
                            <div class="form-group pull-right">
                                <button class="btn btn-primary">Cari</button>
                            </div>

                        </form>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Group</th>
                                    <th scope="col">Act.</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">0</th>
                                    <td>All</td>
                                    <td></td>
                                    <td>
                                        <a href="{{ url('/admin/ddcs/0') }}" class="btn btn-primary" data-toggle="tooltip"
                                            data-placement="bottom" title="Lihat">
                                            <i class="fa fa-eye">
                                            </i>
                                        </a>
                                        <a href="{{ url('/admin/ddcs/0/print') }}" class="btn btn-primary"
                                            data-toggle="tooltip" data-placement="bottom" title="Cetak Laporan">
                                            <i class="fa fa-file">
                                            </i>
                                        </a>
                                    </td>
                                </tr>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($ddcGroups as $item)
                                    @php
                                        $case = ucwords($item->group);
                                        $j = $i * 100;
                                        $k = $j + 99;
                                        $group = "$j - $k";
                                        $i++;
                                    @endphp
                                    <tr>
                                        <th scope="row">{{ $i }}</th>
                                        <td>{{ $case }}</td>
                                        <td>{{ $group }}</td>
                                        <td>
                                            <a href="{{ url("/admin/ddcs/$i") }}" class="btn btn-primary"
                                                data-toggle="tooltip" data-placement="bottom" title="Lihat DDC">
                                                <i class="fa fa-eye">
                                                </i>
                                            </a>
                                            <a href="{{ url("/admin/ddcs/$i/print") }}" class="btn btn-primary"
                                                data-toggle="tooltip" data-placement="bottom" title="Cetak Laporan">
                                                <i class="fa fa-file">
                                                </i>
                                            </a>
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
