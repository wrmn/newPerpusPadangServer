@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
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
                            <input type="text" id="no_anggota" class="form-group" rows="3" readonly="">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" width="20%">Nama Anggota</th>
                        <td>
                            <input type="text" id="nama_anggota" class="form-group" rows="3" readonly="">
                        </td>
                    </tr>
                    </tr>
                    <tr>
                        <th scope="row" width="20%">No. Buku</th>
                        <td>
                            <input type="text" id="ddc_buku" class="form-group" rows="3" readonly="">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" width="20%">Judul</th>
                        <td>
                            <input type="text" id="judul_buku" class="form-group" rows="3" readonly="">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        async function onQRCodeScanned(scannedText) {
            const result = scannedText.split("+");

            if (result[0] == "book") {
                const response = await fetch(`{{ url('/api/book') }}/${result[1]}`);

                var data = await response.json();
                console.log(data);
                var ddcField = document.getElementById("ddc_buku");
                var titleField = document.getElementById("judul_buku");
                if (ddcField && titleField) {
                    ddcField.value = `${data.ddc}.${data.no}`;
                    titleField.value = capital(data.judul);
                }
            } else if (result[0] == "member") {
                const response = await fetch(`{{ url('/api/member') }}/${result[1]}`);

                var data = await response.json();
                console.log(data);
                var noField = document.getElementById("no_anggota");
                var nameField = document.getElementById("nama_anggota");
                if (nameField && noField) {
                    noField.value = data.member_no;
                    nameField.value = capital(data.nama);
                }
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
