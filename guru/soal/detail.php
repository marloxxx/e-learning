<?php
session_start();
require_once('../../config/koneksi.php');
require_once('../../config/function.php');
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}
$id = $_GET['id_soal'];
$sql = "SELECT * FROM tb_r_soal WHERE id_soal = '$id'";
$query = $con->prepare($sql);
$query->execute();
$result = $query->fetch(PDO::FETCH_ASSOC);
?>
<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="8.5" cy="7" r="4"></circle>
                                    <line x1="20" y1="8" x2="20" y2="14"></line>
                                    <line x1="23" y1="11" x2="17" y2="11"></line>
                                </svg></div>
                            Detail Soal
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="javascript:;" onclick="back();">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left me-1">
                                <line x1="19" y1="12" x2="5" y2="12"></line>
                                <polyline points="12 19 5 12 12 5"></polyline>
                            </svg>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-4">
        <!-- Account details card-->
        <div class="card mb-4">
            <div class="card-header">Detail Soal</div>
            <div class="card-body">
                <form id="form">
                    <input type="hidden" name="id_kuis" value="<?= $id_kuis ?>">
                    <!-- Form Row-->
                    <div class=" row gx-3 mb-3">
                        <!-- Form Group (pertanyaan)-->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Pertanyaan</label>
                                <textarea class="form-control" rows="3" readonly><?= $result['pertanyaan'] ?></textarea>
                            </div>
                        </div>
                        <!-- Form Group (opsi 1)-->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Opsi 1</label>
                                <textarea class="form-control" rows="3" readonly><?= relation('tb_d_detail_soal', 'id_soal', $id)['opsi_1'] ?></textarea>
                            </div>
                        </div>
                        <!-- Form Group (nilai opsi 1)-->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Nilai Opsi 1</label>
                                <input type="number" class="form-control" readonly value="<?= relation('tb_d_detail_soal', 'id_soal', $id)['nilai_opsi_1'] ?>">
                            </div>
                        </div>
                        <!-- Form Group (opsi 2)-->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Opsi 2</label>
                                <textarea class="form-control" rows="3" readonly><?= relation('tb_d_detail_soal', 'id_soal', $id)['opsi_2'] ?></textarea>
                            </div>
                        </div>
                        <!-- Form Group (nilai opsi 2)-->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Nilai Opsi 2</label>
                                <input type="number" class="form-control" readonly value="<?= relation('tb_d_detail_soal', 'id_soal', $id)['nilai_opsi_2'] ?>">
                            </div>
                        </div>
                        <!-- Form Group (opsi 3)-->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Opsi 3</label>
                                <textarea class="form-control" rows="3" readonly><?= relation('tb_d_detail_soal', 'id_soal', $id)['opsi_3'] ?></textarea>
                            </div>
                        </div>
                        <!-- Form Group (nilai opsi 3)-->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Nilai Opsi 3</label>
                                <input type="number" class="form-control" readonly value="<?= relation('tb_d_detail_soal', 'id_soal', $id)['nilai_opsi_3'] ?>">
                            </div>
                        </div>
                        <!-- Form Group (opsi 4)-->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Opsi 4</label>
                                <textarea class="form-control" rows="3" readonly><?= relation('tb_d_detail_soal', 'id_soal', $id)['opsi_4'] ?></textarea>
                            </div>
                        </div>
                        <!-- Form Group (nilai opsi 4)-->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Nilai Opsi 4</label>
                                <input type="number" class="form-control" readonly value="<?= relation('tb_d_detail_soal', 'id_soal', $id)['nilai_opsi_4'] ?>">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>