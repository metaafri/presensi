@extends('layouts.admin.template')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="col-lg-12 mb-4 col-md-12">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title mb-0">Statistics</h5>
                <small class="text-muted">Update Per Hari Ini</small>
            </div>
            <div class="card-body pt-2">
                <div class="row gy-3">
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-success me-3 p-2">
                                <i class="ti ti-fingerprint ti-sm"></i>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0">{{ empty($rekapAbsen->total_absen) ? 0 : $rekapAbsen->total_absen }}</h5>
                                <small>Hadir</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-info me-3 p-2">
                                <i class="ti ti-file-text ti-sm"></i>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0">
                                    {{ empty($recapSubmmission->total_izin) ? 0 : $recapSubmmission->total_izin }}</h5>
                                <small>Izin</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-warning me-3 p-2">
                                <i class="ti ti-mood-sick ti-sm"></i>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0">
                                    {{ empty($recapSubmmission->total_sakit) ? 0 : $recapSubmmission->total_sakit }}</h5>
                                <small>Sakit</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-danger me-3 p-2">
                                <i class="ti ti-clock ti-sm"></i>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0">
                                    {{ empty($rekapAbsen->total_absen_terlambat) ? 0 : $rekapAbsen->total_absen_terlambat }}
                                </h5>
                                <small>Terlambat</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="card-title mb-0">
                        <h5 class="mb-0 me-2">123</h5>
                        <small>Jumlah Karyawan</small>
                    </div>
                    <div class="card-icon">
                        <span class="badge bg-label-primary rounded-pill p-2">
                            <i class="ti ti-users ti-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
