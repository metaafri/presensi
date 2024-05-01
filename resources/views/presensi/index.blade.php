@extends('layouts.app')

@section('header')
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">E-Presensi</div>
        <div class="right"></div>
    </div>
@endsection

@push('page-css')
    <style>
        .webcam-capture,
        .webcam-capture video {
            display: inline-block;
            width: 100% !important;
            height: auto !important;
            margin: auto;
            border-radius: 15px;
        }

        #map {
            height: 200px;
        }
    </style>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
@endpush

@section('content')
    <div class="row" style="margin-top: 70px;">
        <div class="col">
            <input type="hidden" name="lokasi" id="lokasi">
            <div class="webcam-capture"></div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            @if ($validate)
                <button id="absen" class="btn btn-danger btn-block">
                    <ion-icon name="camera-outline"></ion-icon>
                    Absen Pulang
                </button>
            @else
                <button id="absen" class="btn btn-primary btn-block">
                    <ion-icon name="camera-outline"></ion-icon>
                    Absen Masuk
                </button>
            @endif
        </div>
    </div>
    <div class="row mt-2">
        <div class="col">
            <div id="map"></div>
        </div>
    </div>

    <audio id="notif_in">
        <source src="{{ asset('assets/sound/in.mp3') }}" type="audio/mpeg">
    </audio>
    <audio id="notif_out">
        <source src="{{ asset('assets/sound/out.mp3') }}" type="audio/mpeg">
    </audio>
@endsection

@push('page-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>

    <script>
        var notifIn = document.getElementById('notif_in')
        var notifOut = document.getElementById('notif_out')

        Webcam.set({
            height: 480,
            width: 640,
            image_format: 'jpeg',
            jpeg_quality: 80
        })

        Webcam.attach('.webcam-capture')

        var lokasi = document.getElementById('lokasi');
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
        }

        function successCallback(position) {
            lokasi.value = position.coords.latitude + "," + position.coords.longitude;
            var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 18);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
            var marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);
            var circle = L.circle([-6.908361, 107.62674], {
                color: 'green',
                fillColor: '#4ade80',
                fillOpacity: 0.5,
                radius: 20
            }).addTo(map);
        }

        function errorCallback(error) {
            console.log(error)
        }

        $('#absen').click(function(e) {
            var lokasi = $('#lokasi').val()

            Webcam.snap(function(uri) {
                image = uri
            })

            $.ajax({
                type: 'POST',
                url: '/presensi',
                data: {
                    _token: "{{ csrf_token() }}",
                    image: image,
                    lokasi: lokasi
                },
                cache: false,
                success: function(res) {
                    res.type === 'in' ? notifIn.play() : notifOut.play();

                    Swal.fire({
                            title: 'Berhasil!',
                            text: res.message,
                            icon: 'success',
                            confirmButtonText: 'Lanjut'
                        })
                        .then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "/dashboard"
                            }
                        })
                },
                error: function(err) {
                    console.log(err)
                    Swal.fire({
                        title: 'Error!',
                        text: err.responseJSON.message,
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    })
                }
            })
        })
    </script>
@endpush
