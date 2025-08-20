<nav class="navbar header-navbar pcoded-header">
    <div class="navbar-wrapper">

        <div class="navbar-logo" style="background-color:#ffffff !important">
            <a class="mobile-menu" id="mobile-collapse" href="#!" style="color: #404E67 !important">
                <i class="feather icon-menu"></i>
            </a>
            {{-- <a href="index-1.htm">
                <img class="img-fluid" src="{{ asset('assets\images\logo_menu.png') }}" alt="Theme-Logo">
            </a> --}}
            <a class="mobile-options">
                <i class="feather icon-more-horizontal"></i>
            </a>
        </div>

        <div class="navbar-container container-fluid">
            <ul class="nav-left">
                <li>
                    <a href="#!" onclick="javascript:toggleFullScreen()">
                        <i class="feather icon-maximize full-screen"></i>
                    </a>
                </li>
            </ul>
            <ul class="nav-right">
                <li class="user-profile header-notification">
                    <div class="dropdown-primary dropdown">
                        <div class="dropdown-toggle" data-toggle="dropdown">
                            <span>{{ session('user.nama') }}</span>
                            <i class="feather icon-chevron-down"></i>
                        </div>
                        <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                            <li>
                                <a href="{{ route('logout') }}">
                                    <i class="feather icon-log-out"></i> Logout
                                </a>
                            </li>
                        </ul>

                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>