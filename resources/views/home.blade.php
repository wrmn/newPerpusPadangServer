@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card-box bg-green">
                            <div class="inner">
                                <h3> {{ $borrowToday->total }}</h3>
                                <p> Peminjaman Hari Ini </p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-address-book-o"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-box bg-blue">
                            <div class="inner">
                                <h3> {{ $memberTotal->total }}</h3>
                                <p> Total Anggota</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-user"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card-box bg-green">
                            <div class="inner">
                                <h3> {{ $bookTotal->total }}</h3>
                                <p> Total Buku </p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-book"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-box bg-blue">
                            <div class="inner">
                                <h3> {{ $visitorToday->total }} </h3>
                                <p> Total Kunjungan Hari Ini </p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-address-book-o"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <canvas id="myChart2" height="200"></canvas>
            </div>
            <div class="col-md-6">
                <canvas id="myChart" height="200"></canvas>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 invisible">
                <canvas id="myChart3" height="150"></canvas>
            </div>
            <div class="col-md-6 invisible">
                <canvas id="myChart4" height="150"></canvas>
            </div>
        </div>
    </div>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var ctx2 = document.getElementById('myChart2').getContext('2d');
        var ctx3 = document.getElementById('myChart3').getContext('2d');
        var ctx4 = document.getElementById('myChart4').getContext('2d');

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($visitMonth) !!},
                datasets: [{
                    label: 'Jumlah Peminjaman',
                    data: {!! json_encode($borrowData2) !!},
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                legend: {
                    display: false,
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
                    }
                },
            }
        });
        var myChart2 = new Chart(ctx2, {
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

                scales: {
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        beginAtZero: true,
                        ticks: {
                            callback: function(value, index, values) {
                                if (Math.floor(value) === value) {
                                    return value;
                                }
                            }
                        }
                    },
                }
            },
        });
        var myChart3 = new Chart(ctx3, {
            type: 'pie',
            data: {
                labels: {!! json_encode($jobName) !!},
                datasets: [{
                    label: '# of Votes',
                    data: {!! json_encode($memberCount) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(153, 102, 255, 0.5)',
                        'rgba(255, 159, 64, 0.5)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                legend: {
                    display: false
                },
                tooltips: {
                    enabled: false
                }
            }
        });
        var myChart4 = new Chart(ctx4, {
            type: 'pie',
            data: {
                labels: {!! json_encode($groupName) !!},
                datasets: [{
                    label: '# of Votes',
                    data: {!! json_encode($bookCount) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(153, 102, 255, 0.5)',
                        'rgba(255, 159, 64, 0.5)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                legend: {
                    display: false
                },
                tooltip: {
                    display: false
                }
            }
        });
    </script>
@endsection
