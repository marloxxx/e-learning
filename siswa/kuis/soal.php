<?php
session_start();
require_once('../../config/koneksi.php');
require_once('../../config/function.php');
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}
$id_kuis = $_GET['id_kuis'];
$id_soal = $_GET['id_soal'];
$kuis = relation('tb_m_kuis', $id_kuis, 'id_kuis');
// ambil data seluruh soal berdasarkan id_kuis
$semua_soal = $con->query("SELECT * FROM tb_r_soal WHERE id_kuis = '$id_kuis'");
$query = $con->query("SELECT * FROM tb_r_soal WHERE id_soal = '$id_soal'");
$soal_pagination = $query->fetch(PDO::FETCH_ASSOC);
// soal berikutnya
$soal_berikutnya = $con->query("SELECT * FROM tb_r_soal WHERE id_kuis = '$id_kuis' AND id_soal > '$id_soal' LIMIT 1");
$soal_berikutnya = $soal_berikutnya->fetch(PDO::FETCH_ASSOC);
// soal sebelumnya
$soal_sebelumnya = $con->query("SELECT * FROM tb_r_soal WHERE id_kuis = '$id_kuis' AND id_soal < '$id_soal' ORDER BY id_soal DESC LIMIT 1");
$soal_sebelumnya = $soal_sebelumnya->fetch(PDO::FETCH_ASSOC);
// Ambil nomor soal
$nomor_soal = 1;
foreach ($semua_soal as $soal) {
    if ($soal['id_soal'] == $id_soal) {
        break;
    }
    $nomor_soal++;
}
// ambil jawaban siswa
$sql = "SELECT * FROM tb_d_jawaban WHERE id_soal = '$id_soal' AND id_siswa = " . $_SESSION['user']['id'];
$query = $con->prepare($sql);
$query->execute();
$jawaban_siswa = $query->fetch(PDO::FETCH_ASSOC);
$semua_soal = $con->query("SELECT * FROM tb_r_soal WHERE id_kuis = '$id_kuis'");
// ambil durasi kuis dan ubah ke detik
$durasi = date_parse($kuis['waktu']);
$durasi = $durasi['hour'] * 3600 + $durasi['minute'] * 60 + $durasi['second'];
// ambil waktu mulai kuis dan tambah waktu mulai kuis dengan durasi kuis
$waktu_mulai = strtotime($kuis['waktu_mulai']);
$waktu_mulai = $waktu_mulai + $durasi;
$waktu_selesai = date('Y-m-d H:i:s', $waktu_mulai);
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
            <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
                <div class="container-fluid px-4">
                    <div class="page-header-content">
                        <div class="row align-items-center justify-content-between pt-3">
                            <div class="col-auto mb-3">
                                <h1 class="page-header-title">
                                    <div class="page-header-icon">
                                        <i data-feather="file-text"></i>
                                    </div>
                                    Kuis <?php echo relation('tb_m_kuis', 'id_kuis', $id_kuis)['judul']; ?>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- Main page content-->
            <div class="container-fluid px-4">
                <form id="soal">
                    <div class="row gx-4">
                        <div class="col-lg-8">
                            <div class="card card-header-actions mb-4">
                                <div class="card-header">
                                    Soal
                                    <i class="text-muted" data-feather="info" data-bs-toggle="tooltip" data-bs-placement="left" title="The post preview text shows below the post title, and is the post summary on blog pages."></i>
                                </div>
                                <div class="card-body">
                                    <!-- List soal dan pilihan jawaban -->
                                    <div class="form-group mb-3">
                                        <label for="soal">Soal <?= $nomor_soal ?></label>
                                        <div><?php echo $soal_pagination['pertanyaan']; ?></div>
                                        <!-- Form check untuk jawaban -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jawaban[<?php echo $soal_pagination['id_soal']; ?>]" value="1" <?php
                                                                                                                                                                if (!empty($jawaban_siswa)) {
                                                                                                                                                                    if ($jawaban_siswa['jawaban'] == 1) {
                                                                                                                                                                        echo 'checked';
                                                                                                                                                                    }
                                                                                                                                                                }
                                                                                                                                                                ?>>
                                            <label class="form-check-label" for="opsi_1">
                                                <?php echo relation('tb_d_detail_soal', 'id_soal', $soal_pagination['id_soal'])['opsi_1']; ?>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jawaban[<?php echo $soal_pagination['id_soal']; ?>]" value="2" <?php
                                                                                                                                                                if (!empty($jawaban_siswa)) {
                                                                                                                                                                    if ($jawaban_siswa['jawaban'] == 2) {
                                                                                                                                                                        echo 'checked';
                                                                                                                                                                    }
                                                                                                                                                                }
                                                                                                                                                                ?>>
                                            <label class="form-check-label" for="opsi_2">
                                                <?php echo relation('tb_d_detail_soal', 'id_soal', $soal_pagination['id_soal'])['opsi_2']; ?>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jawaban[<?php echo $soal['id_soal']; ?>]" value="3" <?php
                                                                                                                                                    if (!empty($jawaban_siswa)) {
                                                                                                                                                        if ($jawaban_siswa['jawaban'] == 3) {
                                                                                                                                                            echo 'checked';
                                                                                                                                                        }
                                                                                                                                                    }
                                                                                                                                                    ?>>
                                            <label class="form-check-label" for="opsi_3">
                                                <?php echo relation('tb_d_detail_soal', 'id_soal', $soal_pagination['id_soal'])['opsi_3']; ?>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jawaban[<?php echo $soal['id_soal']; ?>]" value="4" <?php
                                                                                                                                                    if (!empty($jawaban_siswa)) {
                                                                                                                                                        if ($jawaban_siswa['jawaban'] == 4) {
                                                                                                                                                            echo 'checked';
                                                                                                                                                        }
                                                                                                                                                    }
                                                                                                                                                    ?>>
                                            <label class="form-check-label" for="opsi_4">
                                                <?php echo relation('tb_d_detail_soal', 'id_soal', $soal_pagination['id_soal'])['opsi_4']; ?>
                                            </label>
                                        </div>
                                        <a href="javascript:;" id="reset">Reset Jawaban</a>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <?php
                                        if (empty($soal_sebelumnya)) {
                                        ?>
                                            <a href="javascript:;" class="btn btn-outline-primary disabled">Sebelumnya</a>
                                        <?php
                                        } else {
                                        ?>
                                            <a href="soal.php?id_kuis=<?php echo $id_kuis; ?>&id_soal=<?php echo $soal_sebelumnya['id_soal']; ?>" class="btn btn-outline-primary">Sebelumnya</a>
                                        <?php
                                        }
                                        ?>

                                        <!-- Tombol Soal Berikutnya -->
                                        <?php
                                        if (empty($soal_berikutnya)) {
                                        ?>
                                            <a href="<?php base_url('siswa/kuis/finish.php?id_kuis=' . $id_kuis); ?>" class="btn btn-primary">Selesai</a>
                                        <?php
                                        } else {
                                        ?>
                                            <a href="soal.php?id_kuis=<?php echo $id_kuis; ?>&id_soal=<?php echo $soal_berikutnya['id_soal']; ?>" class="btn btn-primary">Berikutnya</a>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4" style="position: sticky; top: 0;">
                            <div class="card card-header-actions">
                                <div class="card-header">
                                    Publish
                                    <i class="text-muted" data-feather="info" data-bs-toggle="tooltip" data-bs-placement="left" title="After submitting, your post will be published once it is approved by a moderator."></i>
                                </div>
                                <div class="card-body">
                                    <!-- Menampilkan Daftar Link Soal -->
                                    <div class="form-group mb-3">
                                        <label for="soal">Daftar Soal</label>
                                        <div>
                                            <?php
                                            $no = 1;
                                            foreach ($semua_soal as $row) {
                                                if ($id_soal == $row['id_soal']) {
                                            ?>
                                                    <a href="javascript:;"><span class="btn btn-sm btn-light disabled"><?php echo $no++; ?></span></a>
                                                <?php
                                                } else {
                                                ?>
                                                    <a href="soal.php?id_kuis=<?php echo $id_kuis; ?>&id_soal=<?php echo $row['id_soal']; ?>"><span class="btn btn-sm btn-primary"><?php echo $no++; ?></span></a>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-grid mb-3">
                                        <label>Sisa Waktu</label>
                                        <span id="countdown"></span>
                                    </div>
                                    <div class="d-grid">
                                        <a href="<?php base_url('siswa/kuis/finish.php?id_kuis=' . $id_kuis); ?>" class="btn btn-primary">Selesai</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
        // ketika jawaban dipilih maka kirim data ke server
        $('input[type="radio"]').on('click', function() {
            var id_soal = '<?php echo $soal_pagination['id_soal']; ?>';
            var jawaban = $(this).val();
            $.ajax({
                url: '<?php base_url('siswa/kuis/function.php'); ?>', // url tujuan
                type: 'POST',
                data: {
                    'id_soal': id_soal,
                    'jawaban': jawaban,
                    'action': 'jawab'
                },
                success: function(data) {
                    console.log(data);
                }
            });
        });
        $('#reset').on('click', function() {
            $('input[type="radio"]').prop('checked', false);
        });
        // inisialisasi countdown timer
        var countDownDate = new Date("<?= $waktu_selesai ?>").getTime();
        var x = setInterval(function() {
            var now = new Date().getTime();
            var distance = countDownDate - now;
            //    tampilkan dalam bentuk menit dan detik
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            document.getElementById("countdown").innerHTML = minutes + ":" + seconds;
            if (distance < 0) {
                clearInterval(x);
                $.ajax({
                    url: '<?php base_url('siswa/kuis/function.php'); ?>', // url tujuan
                    type: 'POST',
                    data: {
                        id_kuis: <?= $id_kuis ?>,
                        action: 'selesai'
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            location.href = response.url;
                        } else {
                            alert('Kuis gagal disubmit');
                        }
                    }
                });
            }
        }, 1000);
    </script>
</body>

</html>