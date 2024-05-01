@extends('layouts.app')

@push('page-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">

    <style>
        .datepicker-modal {
            max-height: 465px !important;
        }

        .datepicker-date-display {
            background-color: #3B85FA;
        }
    </style>
@endpush

@section('header')
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Form Pengajuan</div>
        <div class="right"></div>
    </div>
@endsection

@section('content')
    <div class="row" style="margin-top: 70px">
        <div class="col">
            <form action="{{ route('submission.store') }}" method="post" id="form-create">
                @csrf

                <div class="form-group">
                    <label for="date">Tanggal*</label>
                    <input type="text" name="date" id="date" class="form-control datepicker"
                        placeholder="Tanggal" required>
                </div>

                <div class="form-group">
                    <label for="status">Jenis*</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="">Izin / Sakit</option>
                        <option value="i">Izin</option>
                        <option value="s">Sakit</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="description">Keterangan*</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control"
                        placeholder="Keterangan" required></textarea>
                </div>

                <div class="form-group">
                    <button class="btn btn-success w-100">Ajukan</button>
                </div>
            </form>
        </div>
    </div>
@endsection


@push('page-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>

    <script>
        var currYear = (new Date()).getFullYear();

        $(document).ready(function() {
            $(".datepicker").datepicker({
                format: "yyyy-mm-dd"
            });
        });
    </script>
@endpush
