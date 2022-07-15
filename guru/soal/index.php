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
if (empty($result) == true) {
    header('Location: ../include/404.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Learning | Guru</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
        <div id="content_list">
            <main>
                <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
                    <div class="container-xl px-4">
                        <div class="page-header-content pt-4">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto mt-4">
                                    <h1 class="page-header-title">
                                        <div class="page-header-icon">
                                            <i data-feather="users"></i>
                                        </div>
                                        Soal
                                    </h1>
                                    <div class="page-header-subtitle">List Soal
                                    </div>
                                </div>
                                <div class="col-12 col-xl-auto mt-4">
                                    <div class="btn-group">
                                        <a href="javascript:;" onclick="load_input('<?php base_url('guru/soal/create.php?id_kuis=' . $id_kuis) ?>');" class="btn btn-white">Tambah Soal</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                <!-- Main page content-->
                <div class="container-xl px-4 mt-n10" id="list_result">

                </div>
            </main>
        </div>
        <div id="content_input">

        </div>
        <div id="content_detail">

        </div>
        <?php
        require_once('../include/footer.php');
        ?>
    </div>
    <?php
    require_once('../include/modal.php');
    require_once('../include/script.php');
    ?>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        load_list('<?php base_url("guru/soal/list.php?id_kuis=$id_kuis") ?>');
    </script>
</body>

</html>