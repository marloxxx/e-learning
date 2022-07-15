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
                            Tambah Soal
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
                    <input type="hidden" name="id_kuis" value="<?= $result['id_kuis'] ?>">
                    <input type="hidden" name="id_soal" value="<?= $id ?>">
                    <!-- Form Row-->
                    <div class=" row gx-3 mb-3">
                        <!-- Form Group (pertanyaan)-->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Pertanyaan</label>
                                <textarea class="form-control" id="pertanyaan" name="pertanyaan" rows="3" placeholder="Pertanyaan"><?= $result['pertanyaan'] ?></textarea>
                            </div>
                        </div>
                        <!-- Form Group (opsi 1)-->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Opsi 1</label>
                                <textarea class="form-control" id="opsi_1" name="opsi_1" rows="3" placeholder="Opsi 1"><?= relation('tb_d_detail_soal', 'id_soal', $id)['opsi_1'] ?></textarea>
                            </div>
                        </div>
                        <!-- Form Group (nilai opsi 1)-->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Nilai Opsi 1</label>
                                <input type="number" class="form-control" id="nilai_opsi_1" name="nilai_opsi_1" placeholder="Nilai Opsi 1" value="<?= relation('tb_d_detail_soal', 'id_soal', $id)['nilai_opsi_1'] ?>">
                            </div>
                        </div>
                        <!-- Form Group (opsi 2)-->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Opsi 2</label>
                                <textarea class="form-control" id="opsi_2" name="opsi_2" rows="3" placeholder="Opsi 2"><?= relation('tb_d_detail_soal', 'id_soal', $id)['opsi_2'] ?></textarea>
                            </div>
                        </div>
                        <!-- Form Group (nilai opsi 2)-->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Nilai Opsi 2</label>
                                <input type="number" class="form-control" id="nilai_opsi_2" name="nilai_opsi_2" placeholder="Nilai Opsi 2" value="<?= relation('tb_d_detail_soal', 'id_soal', $id)['nilai_opsi_2'] ?>">
                            </div>
                        </div>
                        <!-- Form Group (opsi 3)-->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Opsi 3</label>
                                <textarea class="form-control" id="opsi_3" name="opsi_3" rows="3" placeholder="Opsi 3"><?= relation('tb_d_detail_soal', 'id_soal', $id)['opsi_3'] ?></textarea>
                            </div>
                        </div>
                        <!-- Form Group (nilai opsi 3)-->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Nilai Opsi 3</label>
                                <input type="number" class="form-control" id="nilai_opsi_3" name="nilai_opsi_3" placeholder="Nilai Opsi 3" value="<?= relation('tb_d_detail_soal', 'id_soal', $id)['nilai_opsi_3'] ?>">
                            </div>
                        </div>
                        <!-- Form Group (opsi 4)-->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Opsi 4</label>
                                <textarea class="form-control" id="opsi_4" name="opsi_4" rows="3" placeholder="Opsi 4"><?= relation('tb_d_detail_soal', 'id_soal', $id)['opsi_4'] ?></textarea>
                            </div>
                        </div>
                        <!-- Form Group (nilai opsi 4)-->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Nilai Opsi 4</label>
                                <input type="number" class="form-control" id="nilai_opsi_4" name="nilai_opsi_4" placeholder="Nilai Opsi 4" value="<?= relation('tb_d_detail_soal', 'id_soal', $id)['nilai_opsi_4'] ?>">
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit" id="tombol_submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</main>
<script>
    $('#form').submit(function(e) {
        e.preventDefault();
        var data = $('#form').serialize();
        data += '&action=edit';
        $.ajax({
            type: 'POST',
            url: '<?= base_url('guru/soal/function.php') ?>',
            data: data,
            dataType: 'json',
            beforeSend: function() {
                $('#tombol_submit').prop("disabled", true);
                $('#tombol_submit').text('Please wait...');
            },
            success: function(response) {
                if (response.status == "success") {
                    Swal.fire({
                        title: 'Success',
                        text: response.message,
                        icon: "success",
                        confirmButtonText: 'OK'
                    }).then(function() {
                        load_list(response.url);
                        $(form)[0].reset();
                        setTimeout(function() {
                            $('#tombol_submit').prop("disabled", false);
                            $('#tombol_submit').html('Simpan');
                            back();
                        }, 2000);
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: response.message,
                        icon: "error",
                        confirmButtonText: 'OK'
                    });
                    setTimeout(function() {
                        $('#tombol_submit').prop("disabled", false);
                        $('#tombol_submit').html('Simpan');
                    }, 2000);
                }
            }
        });
    });
    // time
    $('#waktu').flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true
    });
    // datetime
    $('#tanggal').flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        time_24hr: true,
        minDate: "today"
    });
</script>