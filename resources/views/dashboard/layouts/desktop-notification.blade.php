@hasrole('user')
<!-- Desktop Notification Bell (Top Right) -->
<div class="d-none d-md-block position-fixed z-1050 desktop-notif">
    <div class="dropdown">
        <button class="btn btn-dark position-relative border border-secondary border-opacity-25 rounded-circle shadow w-48px h-48px" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-regular fa-bell fs-5"></i>
            @if(isset($globalOverdueNotifications) && $globalOverdueNotifications->isNotEmpty())
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger fs-06rem">{{ $globalOverdueNotifications->count() }}</span>
            @endif
        </button>
        <ul class="dropdown-menu dropdown-menu-end bg-dark-panel border border-secondary border-opacity-25 shadow-lg rounded-0 p-0 desktop-notif-menu">
            <li class="p-3 border-bottom border-secondary border-opacity-25 bg-dark sticky-top">
                <h6 class="mb-0 text-white fw-bold letter-spacing-1 text-uppercase fs-85">Notifikasi</h6>
            </li>
            @if(!isset($globalOverdueNotifications) || $globalOverdueNotifications->isEmpty())
                <li class="p-4 text-center fs-85 letter-spacing-1">
                    <i class="fa-regular fa-bell-slash fs-3 d-block mb-2 opacity-50"></i>
                    Tidak ada pemberitahuan baru.
                </li>
            @else
                @foreach($globalOverdueNotifications as $notif)
                    <li class="p-3 border-bottom border-secondary border-opacity-10 text-white notif-item">
                        <div class="d-flex gap-3">
                            <div class="text-danger mt-1"><i class="fa-solid fa-circle-exclamation fs-5"></i></div>
                            <div>
                                <div class="fw-bold fs-90 mb-1">Buku Terlambat!</div>
                                <div class="fs-85 text-secondary lh-sm mb-1">Buku <strong class="text-light">"{{ optional($notif->book)->title }}"</strong> telah melewati batas pengembalian ({{ $notif->return_date ? $notif->return_date->format('d M Y') : '-' }}).</div>
                                <div class="fs-80 text-danger fw-bold">{{ now()->diffInDays($notif->return_date) }} hari terlambat</div>
                            </div>
                        </div>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
</div>
@endhasrole
