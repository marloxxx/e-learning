<?php
session_start();
require_once('../../config/koneksi.php');
require_once('../../config/function.php');
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}
$id_kelas = $_SESSION['user']['id_kelas'];
$sql = "SELECT * FROM tb_m_mapel WHERE id_kelas = '$id_kelas'";
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
    <title>E-Learning | Mata Pelajaran</title>
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
                                    Mata Pelajaran
                                </h1>
                                <div class="page-header-subtitle">List Mata Pelajaran
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- Main page content-->
            <div class="container-xl px-4 mt-n10">
                <div class="card mb-4">
                    <div class="card-header">List Mata Pelajaran</div>
                    <div class="card-body">
                        <table id="datatables" class="table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Mata Pelajaran</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($result as $row) {
                                ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $row['nama']; ?></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="<?= base_url('siswa/materi/?id_mapel=' . $row['id_mapel']) ?>" class="btn btn-info">
                                                    <span class="symbol-btn-group me-2">
                                                        <i class="fas fa-eye"></i>
                                                    </span>
                                                    Lihat Materi
                                                </a>
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