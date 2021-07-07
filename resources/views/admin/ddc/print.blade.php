@extends('layouts.print')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Group</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Jumlah Buku</th>
                                    <th scope="col">Ditambahkan</th>
                                    <th scope="col">Diperbarui</th>
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
                                        <td>{{ $item->total }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->updated_at }}</td>
                                        
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
