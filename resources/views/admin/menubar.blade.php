<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <div class="pcoded-navigatio-lavel"> </div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="">
                <a href="{{ route('admin.dashboard') }}">
                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
            </li>
        </ul>
        <ul class="pcoded-item pcoded-left-item">
            <li class="">
                <a href="{{ route('guru.index') }}">
                    <span class="pcoded-micon"><i class="feather icon-credit-card"></i></span>
                    <span class="pcoded-mtext">Guru</span>
                </a>
            </li>
        </ul>
        <ul class="pcoded-item pcoded-left-item">
            <li class="">
                <a href="{{ route('wali.index') }}">
                    <span class="pcoded-micon"><i class="feather icon-users"></i></span>
                    <span class="pcoded-mtext">Wali</span>
                </a>
            </li>
        </ul>
        <ul class="pcoded-item pcoded-left-item">
            <li class="">
                <a href="{{ route('siswa.index') }}">
                    <span class="pcoded-micon"><i class="feather icon-briefcase"></i></span>
                    <span class="pcoded-mtext">Murid</span>
                </a>
            </li>
        </ul>
        <ul class="pcoded-item pcoded-left-item">
            <li class="">
                <a href="{{ route('pembayaran.index') }}">
                    <span class="pcoded-micon"><i class="feather icon-tv"></i></span>
                    <span class="pcoded-mtext">Pembayaran</span>
                </a>
            </li>
        </ul>
        <ul class="pcoded-item pcoded-left-item">
            <li class="">
                <a href="{{ route('munaqasah.index') }}">
                    <span class="pcoded-micon"><i class="feather icon-film"></i></span>
                    <span class="pcoded-mtext">Munaqasyah</span>
                </a>
            </li>
        </ul>
        <ul class="pcoded-item pcoded-left-item">
            <li class="">
                <a href="{{ route('logout') }}">
                    <span class="pcoded-micon"><i class="feather icon-globe"></i></span>
                    <span class="pcoded-mtext">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</nav>