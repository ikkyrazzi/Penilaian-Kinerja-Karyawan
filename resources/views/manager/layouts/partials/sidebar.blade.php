<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="/home">Penilaian Karyawan</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="/home">S</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard Manager</li>
        <li class="">
            <a class="nav-link" href="/home"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a>
        </li>

        <li class="menu-header">Kelola Data</li>
        <li class="">
            {{-- <a class="nav-link" href="{{ route('tampilan.books.index') }}"><i class="fa fa-book" aria-hidden="true"></i> <span>Data Buku</span></a> --}}
            <a class="nav-link" href="{{ route('manager.penilaians.create') }}"><i class="fa fa-file-alt" aria-hidden="true"></i> <span>Form Penilaian Pegawai</span></a>
        </li>
        <li class="">
            {{-- <a class="nav-link" href="{{ route('tampilan.apps.index') }}"><i class="fa fa-mobile" aria-hidden="true"></i> <span>Data Aplikasi</span></a> --}}
            <a class="nav-link" href="{{ route('manager.penilaians.index') }}"><i class="fa fa-chart-line" aria-hidden="true"></i> <span>Data Penilaian Pegawai</span></a>
        </li>

        {{-- <li class="menu-header">Kelola Serial</li>
        <li class="nav-item dropdown">
            <a href="/home" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-key" aria-hidden="true"></i> <span>Serial</span></a>
            <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('tampilan.serials.create') }}">Generate Serial</a></li>
                <li><a class="nav-link" href="{{ route('tampilan.serials.show', ['id_proses' => 'id_proses']) }}">Reset Serial</a></li>
                <li><a class="nav-link" href="{{ route('tampilan.serials.index') }}">Data Serial</a></li>
            </ul>
        </li> --}}
    </ul>

    <div class="mt-4 mb-4 p-3 hide-sidebar-mini" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <a href="{{ route('logout') }}" method="POST" class="btn btn-dark btn-lg btn-block btn-icon-split"> <i class="fa fa-sign-out" aria-hidden="true"></i> Log Out </a>
    </div>
</aside>
