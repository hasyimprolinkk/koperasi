<div class="header py-4" style="background-color: #D6EAF8;">
    <div class="container">
        <div class="d-flex">
            <a class="header-brand" href="./index.html">
                Koperasi Reza Jaya
            </a>
            <div class="d-flex order-lg-2 ml-auto">
                <div class="dropdown">
                    <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                    <span class="avatar">
                        <img src="{{ url('images/photo.jpg') }}" class="avatar" alt="">
                    </span>
                    <span class="ml-2 d-none d-lg-block">
                        <span class="text-default">{{ Auth::user()->name }}</span>
                        @if(Auth::user()->roles == "admin")
                            <small class="text-muted d-block mt-1">Administrator</small>
                        @else
                            <small class="text-muted d-block mt-1">Karyawan</small>
                        @endif
                    </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item" href="{{ url('profile') }}">
                            <i class="dropdown-icon fe fe-user"></i> Profile
                        </a>
                    </div>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item" href="{{ url('profile') }}">
                            <i class="dropdown-icon fe fe-print"></i> Cetak
                        </a>
                    </div>
                </div>
            </div>
            <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                <span class="header-toggler-icon"></span>
            </a>
        </div>
    </div>
</div>

<div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-3 ml-auto">
            </div>
            <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link"><i class="fe fe-home"></i> Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('members.index') }}" class="nav-link"><i class="fe fe-users"></i> Anggota</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('pinjaman.index') }}" class="nav-link"><i class="fe fe-dollar-sign"></i> Peminjaman</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('kredit.index') }}" class="nav-link"><i class="fe fe-dollar-sign"></i> Kredit Barang</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('profile') }}" class="nav-link"><i class="fe fe-user"></i> Profile</a>
                    </li>
                    @if(Auth::user()->roles == "admin")
                    <li class="nav-item">
                        <a href="{{ url('users') }}" class="nav-link"><i class="fe fe-user"></i> Pegawai</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fe fe-log-out"></i> Keluar</a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>