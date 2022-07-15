<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sidenav shadow-right sidenav-light">
            <div class="sidenav-menu">
                <div class="nav accordion" id="accordionSidenav">
                    <!-- Sidenav Menu Heading (Core)-->
                    <div class="sidenav-menu-heading">Main</div>
                    <!-- Sidenav Link (Dashboard)-->
                    <a class="nav-link" href="<?php base_url('guru/dashboard'); ?>">
                        <div class="nav-link-icon">
                            <i data-feather="home"></i>
                        </div>
                        Dashboards
                    </a>
                    <!-- Sidenav Link (Kelas)-->
                    <a class="nav-link" href="<?php base_url('guru/kelas'); ?>">
                        <div class="nav-link-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        Kelas
                    </a>
                    <!-- Sidenav Link (Mata Pelajaran)-->
                    <a class="nav-link" href="<?php base_url('guru/mapel'); ?>">
                        <div class="nav-link-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        Mata Pelajaran
                    </a>
                    <!-- Sidenav Link (Kuis)-->
                    <a class="nav-link" href="<?php base_url('guru/kuis'); ?>">
                        <div class="nav-link-icon">
                            <i class="fas fa-question-circle"></i>
                        </div>
                        Kuis
                    </a>
                    <!-- Sidenav Link (Siswa)-->
                    <a class="nav-link" href="<?php base_url('guru/siswa'); ?>">
                        <div class="nav-link-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        Siswa
                    </a>
                </div>
            </div>
            <!-- Sidenav Footer-->
            <div class="sidenav-footer">
                <div class="sidenav-footer-content">
                    <div class="sidenav-footer-subtitle">Logged in as:</div>
                    <div class="sidenav-footer-title">
                        <?php echo $_SESSION['user']['nama']; ?>
                    </div>
                </div>
            </div>
        </nav>
    </div>