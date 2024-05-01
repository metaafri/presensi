@extends('layouts.app')

@section('header')
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Histori Presensi</div>
        <div class="right"></div>
    </div>
@endsection

@section('content')
    <div class="row" style="margin-top: 70px">
        <div class="col">
            <div class="row">

                <div class="col-12">
                    <div class="form-group">
                        <select name="month" id="month" class="form-control">
                            <option value="">Bulan</option>
                            @foreach ($month as $key => $value)
                                <option value={{ $key + 1 }} {{ date('m') == $key + 1 ? 'selected' : '' }}>
                                    {{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <select name="year" id="year" class="form-control">
                            <option value="">Tahun</option>
                            @php
                                $yearStart = 2022;
                                $yearNow = date('Y');
                            @endphp
                            @for ($year = $yearStart; $year <= $yearNow; $year++)
                                <option value={{ $year }} {{ date('Y') == $year ? 'selected' : '' }}>
                                    {{ $year }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" id="search-data">
                            <ion-icon name="search-outline"></ion-icon>
                            Cari
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col" id="show-history"></div>
    </div>
@endsection

@push('page-script')
    <script>
        $(function() {
            $('#search-data').on('click', function() {
                var month = $('#month').val()
                var year = $('#year').val()
                $.ajax({
                    type: 'POST',
                    url: '/presensi/history',
                    data: {
                        _token: "{{ csrf_token() }}",
                        month: month,
                        year: year
                    },
                    cache: false,
                    success: function(res) {
                        $('#show-history').html(res)
                    },
                    error: function(err) {
                        console.log(err)
                    }
                })
            })
        })
    </script>
@endpush
