@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Pencarian
                        @if ($verif ?? '')
                            Member
                            @php
                                $stat = 'registered';
                            @endphp
                        @else
                            Pendaftaran
                            @php
                                $stat = 'unregistered';
                            @endphp
                        @endif
                    </div>

                    <div class="card-body">
                        @if (\Session::has('success'))
                            <div class="alert alert-success show">{!! \Session::get('success') !!}
                            </div>
                        @endif
                        <form method="GET" action="/admin/members/{{ $stat }}/search">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>No</label>
                                        <input type="number" class="form-control" name="no" @if (session('forms.no')) value="{{ session('forms.no') }}" @endif>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" class="form-control" name="nama" @if (session('forms.name')) value="{{ session('forms.name') }}" @endif>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group pull-right">
                                <button class="btn btn-primary">Cari</button>
                            </div>
                        </form>
                        @if (count($membersRes) == 0)
                            Data empty
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Kontak</th>
                                        <th scope="col">Act.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($membersRes as $item)
                                        @php
                                            $caseName = ucwords($item->nama);
                                        @endphp
                                        <tr>
                                            <th scope="row">{{ $item->member_no }}</th>
                                            <th>{{ $caseName }}</th>
                                            <td>{{ $item->telepon_no }}</td>
                                            <td width="20%">
                                                <a href="{{ url("/admin/member/$item->member_no/detail") }}"
                                                    class="btn btn-primary" data-toggle="tooltip" data-placement="bottom"
                                                    title="Lihat Member">
                                                    <i class="fa fa-eye">

                                                    </i>
                                                </a>
                                                <a href="{{ url("/admin/member/$item->member_no/edit") }}"
                                                    class="btn btn-primary" data-toggle="tooltip" data-placement="bottom"
                                                    title="Edit Member">
                                                    <i class="fa fa-pencil">

                                                    </i>
                                                </a>
                                                @if ($item->verivied != 1)
                                                    <a class="btn btn-danger"
                                                        onclick="return confirm('Hapus data {{ $caseName }}?')"
                                                        href="{{ url("/admin/member/$item->member_no/delete") }}"
                                                        data-toggle="tooltip" data-placement="bottom" title="Hapus Member">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                        @endif
                        </tbody>
                        </table>
                        {{ $membersRes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
