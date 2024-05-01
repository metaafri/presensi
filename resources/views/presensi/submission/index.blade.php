@extends('layouts.app')

@section('header')
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Pengajuan</div>
        <div class="right"></div>
    </div>
@endsection

@section('content')
    <div class="row" style="margin-top: 70px;">
        <div class="col">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    {{ $message }}
                </div>
            @endif
        </div>
    </div>

    @foreach ($submissions as $item)
        <div class="row">
            <div class="col">
                <ul class="listview image-listview">
                    <li>
                        <div class="item">
                            <div class="in">
                                <div>
                                    <b>{{ date('d-m-Y', strtotime($item->created_at)) }}
                                        ({{ $item->status === 's' ? 'Sakit' : 'Izin' }})
                                    </b><br>
                                    <small class="text-muted">{{ $item->description }}</small>
                                </div>
                                @switch($item->approve)
                                    @case(0)
                                        <span style="font-size: 27px;" class="text-warning">
                                            <ion-icon name="time-outline"></ion-icon>
                                        </span>
                                    @break

                                    @case(1)
                                        <span style="font-size: 27px;" class="text-success">
                                            <ion-icon name="checkmark-circle-outline"></ion-icon>
                                        </span>
                                    @break

                                    @case(2)
                                        <span style="font-size: 27px;" class="text-danger">
                                            <ion-icon name="close-circle-outline"></ion-icon>
                                        </span>
                                    @break

                                    @default
                                @endswitch
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    @endforeach

    <div class="fab-button bottom-right" style="margin-bottom: 70px;">
        <a href="{{ route('submission.create') }}" class="fab">
            <ion-icon name="add-outline"></ion-icon>
        </a>
    </div>
@endsection
