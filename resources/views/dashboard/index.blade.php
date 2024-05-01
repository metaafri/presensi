@extends('layouts.app')

@section('content')
    <div class="section" id="user-section">
        <div id="user-detail">
            <div class="avatar">
                @if (!empty(Auth::guard('employee')->user()->photo))
                    <img src="{{ url(Storage::url('uploads/employees/' . Auth::guard('employee')->user()->photo)) }}"
                        alt="avatar" class="imaged w64 rounded">
                @else
                    <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w64 rounded img-fluid">
                @endif
            </div>
            <div id="user-info">
                <h2 id="user-name">{{ Auth::guard('employee')->user()->name }}</h2>
                <span id="user-role">{{ Auth::guard('employee')->user()->position }}</span>
            </div>
        </div>
    </div>

    <div class="section" id="menu-section">
        <div class="card">
            <div class="card-body text-center">
                <div class="list-menu">
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="{{ route('employee.index') }}" class="green" style="font-size: 40px;">
                                <ion-icon name="person-sharp"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Profil</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="{{ route('submission.index') }}" class="danger" style="font-size: 40px;">
                                <ion-icon name="calendar-number"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Pengajuan</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="{{ route('presensi.history') }}" class="warning" style="font-size: 40px;">
                                <ion-icon name="document-text"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Histori</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="" class="orange" style="font-size: 40px;">
                                <ion-icon name="location"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            Lokasi
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section mt-2" id="presence-section">
        <div class="todaypresence">
            <div class="row">
                <div class="col-6">
                    <div class="card gradasigreen">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence">
                                    @if ($presensiToday)
                                        <img src="{{ url(Storage::url('uploads/absensi/' . $presensiToday->picture_in)) }}"
                                            class="imaged w48 img-fluid">
                                    @else
                                        <ion-icon name="camera"></ion-icon>
                                    @endif
                                </div>
                                <div class="presencedetail">
                                    <h4 class="presencetitle">Masuk</h4>
                                    <span
                                        style="font-size: 13px">{{ $presensiToday ? $presensiToday->jam_in : 'Belum Absen' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card gradasired">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence">
                                    @if ($presensiToday && $presensiToday->picture_out)
                                        <img src="{{ url(Storage::url('uploads/absensi/' . $presensiToday->picture_out)) }}"
                                            class="imaged w48 img-fluid">
                                    @else
                                        <ion-icon name="camera"></ion-icon>
                                    @endif
                                </div>
                                <div class="presencedetail">
                                    <h4 class="presencetitle">Pulang</h4>
                                    <span
                                        style="font-size: 13px">{{ $presensiToday && $presensiToday->jam_out ? $presensiToday->jam_out : 'Belum Absen' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="rekappresence" class="rekappresence">
            <h4>Rekap Absensi Bulan Ini</h4>
            <div class="row">

                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding: 12px 12px !important">
                            <span class="badge bg-danger"
                                style="position: absolute; top: 3px; right: 10px; font-size: 0.6rem; z-index: 999">{{ empty($rekapAbsen->total_absen) ? 0 : $rekapAbsen->total_absen }}</span>
                            <ion-icon name="accessibility-outline" style="font-size: 1.6rem;"
                                class="text-primary"></ion-icon>
                            <br>
                            <span style="font-size: 0.8rem; font-weight: 500">Hadir</span>
                        </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding: 12px 12px !important">
                            <span class="badge bg-danger"
                                style="position: absolute; top: 3px; right: 10px; font-size: 0.6rem; z-index: 999">{{ empty($recapSubmmission->total_izin) ? 0 : $recapSubmmission->total_izin }}</span>
                            <ion-icon name="newspaper-outline" style="font-size: 1.6rem;" class="text-success"></ion-icon>
                            <br>
                            <span style="font-size: 0.8rem; font-weight: 500">Izin</span>
                        </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding: 12px 12px !important">
                            <span class="badge bg-danger"
                                style="position: absolute; top: 3px; right: 10px; font-size: 0.6rem; z-index: 999">{{ empty($recapSubmmission->total_sakit) ? 0 : $recapSubmmission->total_sakit }}</span>
                            <ion-icon name="medkit-outline" style="font-size: 1.6rem;" class="text-warning"></ion-icon>
                            <br>
                            <span style="font-size: 0.8rem; font-weight: 500">Sakit</span>
                        </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding: 12px 12px !important">
                            <span class="badge bg-danger"
                                style="position: absolute; top: 3px; right: 10px; font-size: 0.6rem; z-index: 999">{{ empty($rekapAbsen->total_absen_terlambat) ? 0 : $rekapAbsen->total_absen_terlambat }}</span>
                            <ion-icon name="alarm-outline" style="font-size: 1.6rem;" class="text-danger"></ion-icon>
                            <br>
                            <span style="font-size: 0.8rem; font-weight: 500">Telat</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="presencetab mt-2">
            <div class="tab-pane fade show active" id="pilled" role="tabpanel">
                <ul class="nav nav-tabs style1" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                            Bulan Ini
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                            Leaderboard
                        </a>
                    </li>
                </ul>
            </div>
            <div class="tab-content mt-2" style="margin-bottom:100px;">
                <div class="tab-pane fade show active" id="home" role="tabpanel">
                    <ul class="listview image-listview">
                        @foreach ($presensiMonth as $item)
                            <li>
                                <div class="item">
                                    <img src="{{ url(Storage::url('uploads/absensi/' . $item->picture_in)) }}"
                                        class="imaged w64 img-fluid mr-2">
                                    <div class="in">
                                        <div style="font-size: 14px;">{{ date('d-M-Y', strtotime($item->created_at)) }}
                                        </div>
                                        <div class="d-block">
                                            <div class="py-1">
                                                <span class="badge badge-success"
                                                    style="font-size: 10px;">{{ $item->jam_in }}</span>
                                            </div>
                                            <div class="py-1">
                                                <span class="badge badge-danger"
                                                    style="font-size: 10px;">{{ $item->jam_out }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel">
                    <ul class="listview image-listview">
                        @foreach ($leaderboards as $item)
                            <li>
                                <div class="item">
                                    <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                                    <div class="in">
                                        <div style="font-size: 14px">
                                            <b>{{ $item->name }}</b>
                                            <br>
                                            <small class="text-muted">{{ $item->position }}</small>
                                        </div>
                                        <div class="d-block">
                                            <div class="py-1">
                                                <span
                                                    class="badge {{ $item->jam_in > '07:00' ? 'bg-warning' : 'bg-success' }}"
                                                    style="font-size: 10px;">
                                                    {{ $item->jam_in }}
                                                </span>
                                            </div>
                                            @if ($item->jam_out)
                                                <div class="py-1">
                                                    <span class="badge bg-danger" style="font-size: 10px;">
                                                        {{ $item->jam_out }}
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>
@endsection
