<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <div class="pcoded-navigatio-lavel"> </div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="">
                <a href="{{ route('wali.dashboard') }}">
                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
            </li>
        </ul>
        <ul class="pcoded-item pcoded-left-item">
            <li class="">
                <a href="{{ route('wali.pembayaran') }}">
                    <span class="pcoded-micon"><i class="feather icon-credit-card"></i></span>
                    <span class="pcoded-mtext">Iuran</span>
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