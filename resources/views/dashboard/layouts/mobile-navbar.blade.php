<!-- Mobile Header -->
<div class="d-md-none d-flex justify-content-between align-items-center p-3 border-bottom border-secondary border-opacity-25 bg-black sticky-top">
    <a href="{{ url('/') }}" class="text-white text-decoration-none fw-bold fs-4 font-oswald">PAGETURN</a>
    <div class="d-flex align-items-center gap-3">
        @hasrole('user')
        <div class="dropdown">
            <button class="btn btn-dark position-relative border-0 p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-regular fa-bell fs-5 text-white"></i>
                @if(isset($globalOverdueNotifications) && $globalOverdueNotifications->isNotEmpty())
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger fs-06rem">{{ $globalOverdueNotifications->count() }}</span>
            @endif
        </button>
        <ul class="dropdown-menu dropdown-menu-end bg-dark border border-secondary border-opacity-25 shadow-lg rounded-0 p-0 w-300px">
                <li class="p-3 border-bottom border-secondary border-opacity-25">
                    <h6 class="mb-0 text-white fw-bold letter-spacing-1 text-uppercase fs-85">Notifikasi</h6>
                </li>
                @if(!isset($globalOverdueNotifications) || $globalOverdueNotifications->isEmpty())
                    <li class="p-4 text-center text-muted fs-85">Tidak ada pemberitahuan.</li>
                @else
                    @foreach($globalOverdueNotifications as $notif)
                        <li class="p-3 border-bottom border-secondary border-opacity-10 text-white">
                            <div class="d-flex gap-2">
                                <div class="text-danger mt-1"><i class="fa-solid fa-circle-exclamation"></i></div>
                                <div>
                                    <div class="fw-bold fs-85 mb-1">Buku Terlambat!</div>
                                    <div class="fs-80 text-secondary lh-sm">"{{ optional($notif->book)->title }}" — {{ $notif->return_date ? $notif->return_date->format('d M Y') : '-' }}</div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
        @endhasrole
        <button id="sidebarToggle" class="btn btn-link text-white p-0">
            <i class="fa-solid fa-bars fs-3"></i>
        </button>
    </div>
</div>
