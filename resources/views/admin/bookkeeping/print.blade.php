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
                                    <th scope="col">No.</th>
                                    <th scope="col">No. IK JK</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Sumber</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Dibuat</th>
                                    <th scope="col">Diperbaru</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($bookkeepingsRes as $item)
                                    @php
                                        $i++;
                                        $date = new DateTime($item->tanggal);
                                        $dateC = new DateTime($item->created_at);
                                        $dateU = new DateTime($item->updated_at);
                                        $link = str_replace('/', '&', $item->no_induk);
                                        
                                    @endphp
                                    <tr>
                                        <th scope="row">{{ $i }}</th>
                                        <th>{{ $item->no_induk }}</th>
                                        <td>{{ $date->format('d M Y') }} </td>
                                        <td>{{ $item->sumber }}</td>
                                        <td>{{ $item->count }}</td>
                                        <td>{{ $dateC->format('d-M-Y H:i') }}</td>
                                        <td>{{ $dateU->format('d-M-Y H:i') }}</td>

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
