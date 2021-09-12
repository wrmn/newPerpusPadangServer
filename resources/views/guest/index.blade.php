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
            <h4 class="font-weight-light">Silahkan pilih metode Check-in</h4>
            <div class="row">
                <a href="{{ url('/member') }}" class="col-md-5 mx-2 btn btn-success btn-lg">
                    Anggota
                </a>
                <a href="{{ url('/guest') }}" class="col-md-5 btn btn-primary btn-lg">
                    Bukan Anggota
                </a>
            </div>
        </div>
    </div>
    <!-- Content Row-->
    <div class="row gx-4 gx-lg-5">
        <div class="col-md-6 ">
            <div class="card" style="height: 55vh">
                <div class="card-header">
                    <h4 class="card-title">Pengunjung Terbaru</h4>
                </div>
                <div class="card-body">
                    <table class="table content-table">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Status</th>
                                <th scope="col">Waktu Kunjungan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($visitorRes as $item)
                                @php
                                    $i++;
                                    $date = new DateTime($item->waktu_kunjungan);
                                @endphp
                                <tr>
                                    <th scope="row">{{ $i }}</th>
                                    <td>{{ ucwords($item->memberDetail->nama) }}</td>
                                    <td>
                                        @if ($item->memberDetail->status_terdaftar == 1)
                                            Anggota
                                        @else
                                            Bukan Anggota
                                        @endif
                                    </td>
                                    <td width="50%">{{ $date->format('H:i d-M-Y') }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card" style="height: 55vh">
                <canvas id="myChart" width="400" height="150"></canvas>
                <canvas id="myChart2" width="400" height="150"></canvas>
            </div>
        </div>
    </div>

    <div class="row gx-4 gx-lg-5 my-2 py-2">
        <div class="col-md-12 ">
            <div class="card">
                <h3 class="font-weight-light">Untuk pendaftaran anggota akses di localhost:8080/</h3>
            </div>
        </div>
    </div>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var ctx2 = document.getElementById('myChart2').getContext('2d');

        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($visitMonth) !!},
                datasets: [{
                        label: 'Anggota',
                        data: {!! json_encode($visitorData2) !!},
                        backgroundColor: 'rgba(255,100,10, 0.2)',
                        borderColor: 'rgba(0, 34, 236, 1)',
                        borderWidth: 1,
                        yAxisID: 'y',
                        fill: true,
                    },
                    {
                        label: 'Bukan Anggota',
                        data: {!! json_encode($visitorData) !!},
                        backgroundColor: 'rgba(100,255,10, 0.2)',
                        borderColor: 'rgba(255,2,255,1)',

                        borderWidth: 1,
                        yAxisID: 'y',
                        fill: true,
                    }
                ]
            },
            options: {
                responsive: true,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                stacked: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Rekap Pengunjung'
                    }
                },
                scales: {
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                    },

                }
            },
        });
        var myChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: {!! json_encode($titleData) !!},
                datasets: [{
                    label: 'Jumlah peminjaman',
                    data: {!! json_encode($borrowData) !!},
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1
                }]
            },
            options: {

                plugins: {
                    title: {
                        display: true,
                        text: 'Buku Yang sering Dipinjam'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value, index, values) {
                                if (Math.floor(value) === value) {
                                    return value;
                                }
                            }

                        }
                    },
                    x: {
                        ticks: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>
@endsection
