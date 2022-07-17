<?php
session_start();
require_once('../../config/koneksi.php');
require_once('../../config/function.php');
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}
if (isset($_GET['id_materi'])) {
    $id_materi = $_GET['id_materi'];
    $sql = "SELECT * FROM tb_m_kuis WHERE id_materi = '$id_materi'";
} else {
    $sql = "SELECT * FROM tb_m_kuis";
}
$query = $con->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Learning | Kuis</title>
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.png" />
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
                                        <i class="fas fa-book"></i>
                                    </div>
                                    Kuis
                                </h1>
                                <div class="page-header-subtitle">List Kuis
                                </div>
                            </div>
                            <div class="col-12 col-xl-auto mt-4">

                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- Main page content-->
            <div class="container-xl px-4 mt-n10">
                <div class="card mb-4">
                    <div class="card-header">List Kuis</div>
                    <div class="card-body">
                        <table id="datatables" class="table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Kuis</th>
                                    <th>Judul Materi</th>
                                    <th>Jumlah Soal</th>
                                    <th>Waktu</th>
                                    <th>Waktu Mulai</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($result as $row) {
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row['judul']; ?></td>
                                        <td><?= relation('tb_m_materi', 'id_materi', $row['id_materi'])['judul']; ?></td>
                                        <td><?= $row['jumlah_soal']; ?></td>
                                        <td><?= $row['waktu']; ?></td>
                                        <td><?= $row['waktu_mulai']; ?></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <?php
                                                $now = date('Y-m-d H:i:s');
                                                // ambil durasi kuis dan ubah ke detik
                                                $durasi = date_parse($row['waktu']);
                                                $durasi = $durasi['hour'] * 3600 + $durasi['minute'] * 60 + $durasi['second'];
                                                // ambil waktu mulai kuis dan tambah waktu mulai kuis dengan durasi kuis
                                                $waktu_mulai = strtotime($row['waktu_mulai']);
                                                $waktu_mulai = $waktu_mulai + $durasi;
                                                $waktu_selesai = date('Y-m-d H:i:s', $waktu_mulai);
                                                $nilai = relation('tb_d_nilai', 'id_kuis', $row['id_kuis']);
                                                if ($waktu_selesai >= $now && empty($nilai)) {
                                                ?>
                                                    <!-- Masuk Kuis -->
                                                    <a href="start.php?id_kuis=<?= $row['id_kuis']; ?>" class="btn btn-sm btn-primary">Masuk Kuis</a>
                                                <?php
                                                } else {
                                                ?>
                                                    <!-- Sudah Selesai -->
                                                    <a href="detail.php?id_kuis=<?= $row['id_kuis']; ?>" class="btn btn-sm btn-secondary">Detail Kuis</a>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
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