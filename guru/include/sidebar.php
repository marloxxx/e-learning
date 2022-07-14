<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sidenav shadow-right sidenav-light">
            <div class="sidenav-menu">
                <div class="nav accordion" id="accordionSidenav">
                    <!-- Sidenav Menu Heading (Core)-->
                    <div class="sidenav-menu-heading">Main</div>
                    <!-- Sidenav Link (Dashboard)-->
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                        <div class="nav-link-icon">
                            <i data-feather="home"></i>
                        </div>
                        Dashboards
                    </a>
                    <!-- Sidenav Link (Server)-->
                    <a class="nav-link" href="{{ route('admin.server.index') }}">
                        <div class="nav-link-icon">
                            <i data-feather="server"></i>
                        </div>
                        Server
                    </a>
                    <!-- Sidenav Link (Site)-->
                    <a class="nav-link" href="{{ route('admin.site') }}">
                        <div class="nav-link-icon">
                            <i data-feather="globe"></i>
                        </div>
                        Site
                    </a>
                </div>
            </div>
            <!-- Sidenav Footer-->
            <div class="sidenav-footer">
                <div class="sidenav-footer-content">
                    <div class="sidenav-footer-subtitle">Logged in as:</div>
                    <div class="sidenav-footer-title"></div>
                </div>
            </div>
        </nav>
    </div>
</div>