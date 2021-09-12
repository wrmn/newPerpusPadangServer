@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        @if (count($errors) > 0)
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ $error }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endforeach
                        @endif
                        <div class="row-element-set row-element-set-QRScanner">
                            <div class="qrscanner" id="scanner">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <table class="table">
                    <tr>
                        <th scope="row" width="20%">Nomor Anggota</th>
                        <td>
                            <input type="text" id="no_anggota" class="form-group" rows="3">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" width="20%">Nama Anggota</th>
                        <td>
                            <div id="nama_anggota"></div>
                        </td>
                    </tr>
                    </tr>
                    <tr>
                        <th scope="row" width="20%">No. Buku</th>
                        <td>
                            <input type="text" id="ddc_buku" class="form-group" rows="3">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" width="20%">Judul</th>
                        <td>
                            <div id="judul_buku"></div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        let bookId, memberNo;
        let memberNoField = document.getElementById("no_anggota");
        let memberNameField = document.getElementById("nama_anggota");
        let bookNoField = document.getElementById("ddc_buku");
        let bookNameField = document.getElementById("judul_buku");
        memberNoField.onchange = function() {
            data = capital(memberNoField.value);
            memberNoField.value = data;
            getMember();
        };
        bookNoField.onchange = function() {
            getBook();
        }

        async function getMember() {
            const response = await fetch(`{{ url('/api/member') }}/${memberNoField.value}`);
            var data = await response.json();
            if (data.code != 404) {
                memberNameField.innerHTML = capital(data.success.nama);
                memberNo = data.success.member_no;

                if (memberNo && bookId) {
                    window.setTimeout(function() {
                        var conf = confirm(`Tambahkan data peminjaman buku?`);
                        if (conf == true) {
                            window.location.href = `/admin/borrow/make/${memberNo}/${bookId}`;
                        }
                    }, 500);
                }
            } else {
                alert(data.fail);

                memberNameField.innerHTML = ``;
            }
        }

        async function getBook() {
            const result = bookNoField.value.split(".");
            const response = await fetch(`{{ url('/api/book/byddc') }}/${result[0]}/${result[1]}`);
            var data = await response.json();
            if (data.code != 404) {
                bookNameField.innerHTML = capital(data.success.judul);
                bookId = data.success.book_id;
                if (memberNo && bookId) {
                    window.setTimeout(function() {

                        var conf = confirm(`Tambahkan data peminjaman buku?`);
                        if (conf == true) {
                            window.location.href = `/admin/borrow/make/${memberNo}/${bookId}`;
                        }

                    }, 500);
                }

            } else {
                alert(data.fail);

                BookNameField.innerHTML = ``;
            }
        }
        async function onQRCodeScanned(scannedText) {
            const result = scannedText.split("+");

            if (result[0] == "book") {
                const response = await fetch(`{{ url('/api/book') }}/${result[1]}`);

                var data = await response.json();
                if (bookNoField && bookNameField) {
                    bookNoField.value = `${data.success.ddc}.${data.success.no}`;
                    bookNameField.innerHTML = capital(data.success.judul);
                }
                bookId = data.success.book_id;
                console.log(bookId)
            } else if (result[0] == "member") {
                const response = await fetch(`{{ url('/api/member') }}/${result[1]}`);

                var data = await response.json();
                if (memberNameField && memberNoField) {
                    memberNoField.value = data.success.member_no;
                    memberNameField.innerHTML = capital(data.success.nama);
                }
                memberNo = data.success.member_no;
                console.log(memberNo)
            }
            if (memberNo && bookId) {
                console.log(memberNo)
                console.log(bookId)
                window.location.href = `/admin/borrow/make/${memberNo}/${bookId}`;
            }
        }

        function capital(str) {
            return str
                .toLowerCase()
                .split(' ')
                .map(function(word) {
                    return word[0].toUpperCase() + word.substr(1);
                })
                .join(' ');
        }

        function provideVideo() {
            var n = navigator;

            if (n.mediaDevices && n.mediaDevices.getUserMedia) {
                return n.mediaDevices.getUserMedia({
                    video: {
                        facingMode: "environment"
                    },
                    audio: false
                });
            }

            return Promise.reject('Your browser does not support getUserMedia');
        }

        function provideVideoQQ() {
            return navigator.mediaDevices.enumerateDevices()
                .then(function(devices) {
                    var exCameras = [];
                    devices.forEach(function(device) {
                        if (device.kind === 'videoinput') {
                            exCameras.push(device.deviceId)
                        }
                    });

                    return Promise.resolve(exCameras);
                }).then(function(ids) {
                    if (ids.length === 0) {
                        return Promise.reject('Could not find a webcam');
                    }

                    return navigator.mediaDevices.getUserMedia({
                        video: {
                            'optional': [{
                                'sourceId': ids.length === 1 ? ids[0] : ids[
                                    1] //this way QQ browser opens the rear camera
                            }]
                        }
                    });
                });
        }

        //this function will be called when JsQRScanner is ready to use
        function JsQRScannerReady() {
            //create a new scanner passing to it a callback function that will be invoked when
            //the scanner succesfully scan a QR code
            var jbScanner = new JsQRScanner(onQRCodeScanned);
            //var jbScanner = new JsQRScanner(onQRCodeScanned, provideVideo);
            //reduce the size of analyzed image to increase performance on mobile devices
            jbScanner.setSnapImageMaxSize(300);
            var scannerParentElement = document.getElementById("scanner");
            if (scannerParentElement) {
                //append the jbScanner to an existing DOM element
                jbScanner.appendTo(scannerParentElement);
            }
        }
    </script>
@endsection
