@extends('layouts.guest')

@section('content')
    <div class="row gx-4 gx-lg-5 align-items-center my-4">
        <div class="col-lg-2">
            <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2F1.bp.blogspot.com%2F-xjhWGEF2CcM%2FT4GYz7ukhFI%2FAAAAAAAAFj0%2FYBVn8Czp6Vc%2Fs1600%2FLOGO%2BKOTA%2BPADANG.png&f=1&nofb=1"
                class="img-fluid rounded mb-4 mb-lg-0" alt="Responsive image">
        </div>

        <div class="col-lg-10">
            <h1 class="font-weight-heavy">Selamat Datang</h1>
            <h4 class="font-weight-light">Silahkan Scan Kartu Anggota Anda</h4>
            <h6 class="font-weight-light">atau masukkan nomor anggota anda</h6>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <a class="btn btn-danger" href="{{ url('/') }}">
                <i class="fa fa-times"></i>
                Kembali
            </a>
        </div>
        <div class="card-body">
            @if (count($errors) > 0)
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger fade show" role="alert">
                        {{ $error }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endforeach
            @endif
            <div class="row">
                <div class="col-md-8">
                    <div class="row-element-set row-element-set-QRScanner">
                        <div class="qrscanner" id="scanner">
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    No. Anggota :
                    <input type="text" class="form-control" name="member_no" id="member_no" value="M.">
                    <button class="btn btn-success" id="checkin">
                        <i class="fa fa-check"></i>
                        Check-in
                    </button>
                </div>
            </div>
            <div class="col-md-4">
            </div>
        </div>
    </div>
    </div>
    </div>
    <script type="text/javascript">
        document.getElementById("checkin").addEventListener("click", checkin);
        let fieldNo = document.getElementById("member_no");
        fieldNo.addEventListener("keyup", function(event) {
            if (event.key === "Enter") {
                checkin();
            }
        });

        function checkin() {
            window.location.href = `member/${fieldNo.value}/checkin`;
        }

        function onQRCodeScanned(scannedText) {
            const result = scannedText.split("+");

            if (result[0] == "member") {
                window.location.href = `member/${result[1]}/checkin`;
            }
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
    </div>
@endsection
