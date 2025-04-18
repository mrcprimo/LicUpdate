@include('includes.head')
@include('includes.script')
@include('includes.style')

<body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle">
            <i class='bx bx-menu' id="header-toggle"></i>
        </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                <a href="/" class="nav_logo">
                    <i class='bx bxs-cloud nav_logo-icon'></i>
                    <span class="nav_logo-name">LICUPDATE</span>
                </a>
                <div class="nav_list">
                    <a href="/" class="nav_link {{ Request::is('/') ? 'active' : '' }}">
                        <i class='bx bxs-home nav_icon'></i>
                        <span class="nav_name">Dashboard</span>
                    </a>
                    <a href="/history" class="nav_link {{ Request::is('history') ? 'active' : '' }}">
                        <i class='bx bx-history nav_icon'></i>
                        <span class="nav_name">History</span>
                    </a>
                    <a href="/precData" class="nav_link {{ Request::is('precData') ? 'active' : '' }}">
                        <i class='bx bxs-droplet nav_icon'></i>
                        <span class="nav_name">Precipitation Data</span>
                    </a>
                    <a href="/contact" class="nav_link {{ Request::is('contact') ? 'active' : '' }}">
                        <i class='bx bxs-phone nav_icon'></i>
                        <span class="nav_name">Contact Us</span>
                    </a>
                    <a href="/about" class="nav_link {{ Request::is('about') ? 'active' : '' }}">
                        <i class='bx bxs-info-circle nav_icon'></i>
                        <span class="nav_name">About</span>
                    </a>
                </div>
            </div>
        </nav>
    </div>
</body>