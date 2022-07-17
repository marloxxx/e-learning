<?php
session_start();
require_once('../../config/koneksi.php');
require_once('../../config/function.php');
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}
$id_kuis = $_GET['id_kuis'];
$sql = "SELECT * FROM tb_m_kuis WHERE id_kuis = '$id_kuis'";
$query = $con->prepare($sql);
$query->execute();
$result = $query->fetch(PDO::FETCH_ASSOC);
// ambil id soal pertama
$sql = "SELECT * FROM tb_r_soal WHERE id_kuis = '$id_kuis' ORDER BY id_soal ASC LIMIT 1";
$query = $con->prepare($sql);
$query->execute();
$id_soal = $query->fetch(PDO::FETCH_ASSOC)['id_soal'];
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
            <div class="container-xl px-4">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between pt-3">
                        <div class="col-auto mb-3">

                        </div>
                        <div class="col-12 col-xl-auto mb-3">
                            <a class="btn btn-sm btn-light text-primary" href="<?php base_url('siswa/kuis'); ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left me-1">
                                    <line x1="19" y1="12" x2="5" y2="12"></line>
                                    <polyline points="12 19 5 12 12 5"></polyline>
                                </svg>
                                Back to Users List
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-xl px-4">
                <div class="card border-0">
                    <div class="card-header bg-transparent justify-content-center py-4">
                        <h5 class="text-primary mb-0">Kuis <?= $result['judul']; ?></h5>
                    </div>
                    <div class="card-body">
                        <h5 class="text-primary">Detail Kuis</h5>
                        <p>
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Distinctio, enim molestiae? Illum magni nulla consequuntur omnis delectus molestiae sequi nihil. Ad aperiam cupiditate hic maxime quod dicta labore obcaecati commodi.
                        </p>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped mb-0">
                            <tr>
                                <td style="width: 150px;">Jumlah Soal</td>
                                <td style="width: 10px;">:</td>
                                <td><?= $result['jumlah_soal']; ?></td>
                            </tr>
                            <tr>
                                <td>Waktu</td>
                                <td>:</td>
                                <td><?= getMinute($result['waktu']); ?> Menit</td>
                            </tr>
                        </table>
                    </div>
                    <a class="card-footer d-flex align-items-center justify-content-center" href="<?php base_url('siswa/kuis/soal.php?id_kuis=' . $id_kuis . '&id_soal=' . $id_soal); ?>">
                        Start now
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right ms-2">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
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