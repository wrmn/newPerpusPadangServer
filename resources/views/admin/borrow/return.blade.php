@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <h3>Scan Kartu Anggota Peminjam</h3>
                    </div>
                    <div class="card-body">
                        <div class="row-element-set row-element-set-QRScanner">
                            <div class="qrscanner" id="scanner">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function onQRCodeScanned(scannedText) {
            const result = scannedText.split("+");

            if (result[0] == "member") {
                window.location.href = `member/${result[1]}/detail`;
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
