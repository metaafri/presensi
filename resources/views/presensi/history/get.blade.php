@if ($histories->isEmpty())
    <div class="alert alert-warning">
        <p>Data Belum Ada</p>
    </div>
@endif
@foreach ($histories as $item)
    <ul class="listview image-listview">
        <li>
            <div class="item">
                @php
                    $path = Storage::url('uploads/absensi/' . $item->picture_in);
                @endphp

                <img src="{{ url($path) }}" class="image img-fluid">
                <div class="in">
                    <div>
                        <b>{{ date('d-m-Y', strtotime($item->created_at)) }}</b><br>
                    </div>
                    <div class="d-block">
                        <div class="py-1">
                            <span class="badge {{ $item->jam_in < '07:00' ? 'bg-success' : 'bg-warning' }}">
                                {{ $item->jam_in }}
                            </span>
                        </div>
                        <div class="py-1">
                            <span class="badge bg-danger">{{ $item->jam_out }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
@endforeach
