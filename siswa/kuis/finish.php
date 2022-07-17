<?php
session_start();
require_once('../../config/koneksi.php');
require_once('../../config/function.php');
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}
$id_kuis = $_GET['id_kuis'];
$kuis = relation('tb_m_kuis', 'id_kuis', $id_kuis);
$sql = "SELECT * FROM tb_r_soal WHERE id_kuis = '$id_kuis'";
$query = $con->query($sql);
$query->execute();
$soal = $query->fetchAll(PDO::FETCH_ASSOC);
// ambil id soal terakhir dari tb_r_soal
$sql = "SELECT * FROM tb_r_soal WHERE id_kuis = '$id_kuis' ORDER BY id_soal DESC LIMIT 1";
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
            <!-- Main page content-->
            <div class="container-xl px-4 mt-4">
                <!-- Finish Kuis -->
                <div class="card invoice">
                    <div class="card-header p-4 p-md-5 border-bottom-0 bg-gradient-primary-to-secondary text-white-50">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-12 col-lg-auto mb-5 mb-lg-0 text-center text-lg-start">
                                <h1 class="h2 text-white">
                                    <span class="page-header-icon">
                                        <i class="fas fa-book"></i>
                                    </span>
                                    Kuis <?= $kuis['judul'] ?>
                                </h1>
                            </div>
                            <div class="col-12 col-lg-auto text-center text-lg-end">
                                <div class="h3 text-white"><?= getDay($kuis['waktu_mulai']) ?></div>
                            </div>
                        </div>
                        <div class="row justify-content-between align-items-center">
                            <div class="col-12 col-lg-auto mb-5 mb-lg-0 text-center text-lg-start">
                                <h3 class="h4 text-white mb-4">Materi : <span class="mb-4 text-white"><?= relation('tb_m_materi', 'id_materi', $kuis['id_materi'])['judul'] ?></span></h3>
                            </div>
                            <div class="col-12 col-lg-auto text-center text-lg-end">
                                <h3 class="h4 text-white mb-4">Waktu : <span class="mb-4"><?= getMinute($kuis['waktu']) ?> Menit</span></h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4 p-md-5">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($soal as $item) {
                                    ?>
                                        <tr>
                                            <td class="text-center">
                                                <?= $no++ ?>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                $jawaban = getJawaban($item['id_soal']);
                                                if (empty($jawaban)) {
                                                    echo '<span>Belum dijawab</span>';
                                                } else {
                                                    echo '<span>Sudah dijawab</span>';
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer p-4 p-lg-5 border-top-0 text-center">
                        <a href="<?php base_url('siswa/kuis/soal.php?id_kuis=' . $id_kuis . '&id_soal=' . $id_soal) ?>" class="btn btn-primary">Kembali Ke Soal</a>
                        <button class="btn btn-primary" type="button" onclick="finish()">Selesai</button>
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
        function finish() {
            Swal.fire({
                title: 'Yakin?',
                text: "Anda yakin ingin menyelesaikan kuis ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, selesai!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '<?php base_url('siswa/kuis/function.php'); ?>', // url tujuan
                        type: 'POST',
                        data: {
                            'action': 'selesai',
                            'id_kuis': <?= $id_kuis ?>
                        },
                        success: function(response) {
                            if (response.status == 'success') {
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: "Kuis berhasil diselesaikan",
                                    icon: 'success',
                                    confirmButtonText: 'Ok'
                                }).then((result) => {
                                    location.href = response.url;
                                });
                            } else {
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: "Kuis gagal diselesaikan",
                                    icon: 'error',
                                    confirmButtonText: 'Ok'
                                });
                            }
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Batal!',
                        text: "Kuis tidak diselesaikan",
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                }
            })
        }
    </script>
</body>

</html>