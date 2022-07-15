<?php
session_start();
require_once('../../config/koneksi.php');
require_once('../../config/function.php');
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}
$id_mapel = $_GET['id_mapel'];
$id_materi = $_GET['id_materi'];
$id_submateri = $_GET['id_submateri'];
$sql = "SELECT * FROM tb_d_konten WHERE id_submateri = '$id_submateri'";
$query = $con->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
$judul_mapel = relation('tb_m_mapel', 'id_mapel', $_GET['id_mapel'])['nama'];
$submateri = relation('tb_r_submateri', 'id_submateri', $_GET['id_submateri']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Learning | Guru</title>
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
                                    <?= $judul_mapel ?>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- Main page content-->
            <div class="container-xl px-4 mt-n10">
                <div class="card h-100 mb-4">
                    <div class="card-body h-100 p-5">
                        <div class="row align-items-center">
                            <div class="col-xl-8 col-xxl-12">
                                <div class="text-center text-xl-start text-xxl-center mb-4 mb-xl-0 mb-xxl-4">
                                    <h1 class="text-primary"><?= $submateri['judul'] ?></h1>
                                    <p class="text-gray-700 mb-0"><?= $submateri['deskripsi'] ?></p>
                                </div>
                            </div>
                            <!-- <div class="col-xl-4 col-xxl-12 text-center"><img class="img-fluid" src="../../assets/img/illustrations/at-work.svg" style="max-width: 26rem"></div> -->
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">List Konten</div>
                    <div class="card-body">
                        <table id="datatables" class="table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Konten</th>
                                    <th>File</th>
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
                                        <td><?php echo $row['judul']; ?></td>
                                        <td><?= $row['file'] ?></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="<?= base_url('assets/file/' . $row['file']) ?>" target="_blank" class="btn btn-info">
                                                    <span class="symbol-btn-group me-2">
                                                        <i class="fas fa-solid fa-download"></i>
                                                    </span>
                                                    Unduh
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
    <script>
        load_list('<?php base_url("siswa/materi/list.php?id_mapel=" . $id); ?>');
    </script>
</body>

</html>