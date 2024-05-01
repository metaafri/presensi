<div class="appBottomMenu">
    <a href="{{ route('dashboard') }}" class="item {{ request()->is('dashboard') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="home-outline"></ion-icon>
            <strong>Home</strong>
        </div>
    </a>
    <a href="{{ route('presensi.history') }}" class="item {{ request()->is('presensi/history') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="sync-outline" role="img" class="md hydrated" aria-label="sync outline"></ion-icon>
            <strong>Histori</strong>
        </div>
    </a>
    <a href="{{ route('presensi.index') }}" class="item">
        <div class="col">
            <div class="action-button large">
                <ion-icon name="camera" role="img" class="md hydrated" aria-label="add outline"></ion-icon>
            </div>
        </div>
    </a>
    <a href="{{ route('submission.index') }}" class="item {{ request()->is('submission') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="calendar-outline" role="img" class="md hydrated"
                aria-label="document text outline"></ion-icon>
            <strong>Pengajuan</strong>
        </div>
    </a>
    <a href="{{ route('employee.index') }}" class="item {{ request()->is('employee') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="people-outline" role="img" class="md hydrated" aria-label="people outline"></ion-icon>
            <strong>Profile</strong>
        </div>
    </a>
</div>
