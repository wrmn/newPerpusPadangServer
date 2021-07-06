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
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Group</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Act.</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ddcList as $item)
                                    @php
                                        $caseName = ucwords($item->nama);
                                        $caseDesc = ucwords($item->group);
                                        
                                        if ($item->ddc < 10) {
                                            $id = "00{$item->ddc}";
                                        } elseif ($item->ddc < 100) {
                                            $id = "0{$item->ddc}";
                                        } else {
                                            $id = "{$item->ddc}";
                                        }
                                    @endphp
                                    <tr>
                                        <th scope="row">{{ $id }}</th>
                                        <td>{{ $caseDesc }}</td>
                                        <td>{{ $caseName }}</td>
                                        <td width="20%">
                                            <a href="{{ url("/books/ddc/$id ") }}" class="btn btn-primary"
                                                data-toggle="tooltip" data-placement="bottom" title="Lihat Buku">
                                                <i class="fa fa-book">

                                                </i>
                                            </a>
                                            <a href="{{ url("/admin/ddc/edit/$id ") }}" class="btn btn-primary"
                                                data-toggle="tooltip" data-placement="bottom" title="Edit">
                                                <i class="fa fa-pencil">

                                                </i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $ddcList->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
