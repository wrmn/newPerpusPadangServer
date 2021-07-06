@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ url('/ddcs/print/all') }}" class="btn btn-primary"> <i class="fa fa-file"></i> Cetak
                            Laporan</a>
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
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($ddcGroups as $item)
                                    @php
                                        $case = ucwords($item->group);
                                        $j = $i*100;
                                        $k = $j + 99;
                                        $group = "$j - $k";
                                        $i++;
                                    @endphp
                                    <tr>
                                        <th scope="row">{{ $i }}</th>
                                        <td>{{ $case }}</td>
                                        <td>{{ $group }}</td>
                                        <td>
                                            <a href="{{ url("/admin/ddcs/$i") }}" class="btn btn-primary" data-toggle="tooltip"
                                                data-placement="bottom" title="Lihat DDC">
                                                <i class="fa fa-eye">

                                                </i>
                                            </a>
                                            <a href="{{ url("/ddcs/print/num/$i") }}" class="btn btn-primary"
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
