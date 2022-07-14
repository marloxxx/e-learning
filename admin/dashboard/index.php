<?php
session_start();
require_once('../../config/koneksi.php');
require_once('../../config/function.php');
if (!isset($_SESSION['user'])) {
    header('location: ' . base_url('login.php'));
}
$sql = "SELECT * FROM tb_m_guru";
$query = $con->prepare($sql);
$query->execute();
$guru = $query->rowCount();
$sql = "SELECT * FROM tb_m_siswa";
$query = $con->prepare($sql);
$query->execute();
$siswa = $query->rowCount();
$sql = "SELECT * FROM tb_m_kelas";
$query = $con->prepare($sql);
$query->execute();
$kelas = $query->rowCount();
$sql = "SELECT * FROM tb_m_mapel";
$query = $con->prepare($sql);
$query->execute();
$mapel = $query->rowCount();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Learning | Dashboard</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
    <?php
    require_once('../include/head.php');
    ?>

</head>

<body>
    <?php
    require_once('../include/header.php');
    require_once('../include/sidebar.php');
    ?>
    <div id="layoutSidenav_content">
        <main>
            <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
                <div class="container-xl px-4">
                    <div class="page-header-content pt-4">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-auto mt-4">
                                <h1 class="page-header-title">
                                    <div class="page-header-icon">
                                        <i data-feather="home"></i>
                                    </div>
                                    Dashboard
                                </h1>
                                <div class="page-header-subtitle">Selamat Datang di E-Learning
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- Main page content-->
            <div class="container-xl px-4 mt-n10">
                <!-- Example Colored Cards for Dashboard Demo-->
                <div class="row">
                    <div class="col-lg-6 col-xl-3 mb-4">
                        <div class="card bg-primary text-white h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="me-3">
                                        <div class="text-white-75 small">Total Guru</div>
                                        <div class="text-lg fw-bold"><?= $guru ?></div>
                                    </div>
                                    <i class="feather-xl text-white-50" data-feather="users"></i>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between small">
                                <div class="text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-3 mb-4">
                        <div class="card bg-warning text-white h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="me-3">
                                        <div class="text-white-75 small">Total Siswa</div>
                                        <div class="text-lg fw-bold"><?= $siswa ?></div>
                                    </div>
                                    <i class="feather-xl text-white-50" data-feather="users"></i>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between small">
                                <div class="text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-3 mb-4">
                        <div class="card bg-success text-white h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="me-3">
                                        <div class="text-white-75 small">Total Mata Pelajaran</div>
                                        <div class="text-lg fw-bold"><?= $mapel ?></div>
                                    </div>
                                    <i class="feather-xl text-white-50" data-feather="book"></i>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between small">
                                <div class="text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-3 mb-4">
                        <div class="card bg-danger text-white h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="me-3">
                                        <div class="text-white-75 small">Total Kelas</div>
                                        <div class="text-lg fw-bold"><?= $kelas ?></div>
                                    </div>
                                    <i class="feather-xl text-white-50" data-feather="home"></i>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between small">
                                <div class="text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php
        require_once('../include/footer.php');
        ?>
    </div>
    <?php
    require_once('../include/modal.php');
    require_once('../include/script.php');
    ?>
</body>

</html>