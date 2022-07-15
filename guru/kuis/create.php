<?php
session_start();
require_once('../../config/koneksi.php');
require_once('../../config/function.php');
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}
$sql = "SELECT * FROM tb_m_materi";
$query = $con->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
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
                            Tambah Kuis
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
            <div class="card-header">Detail Kuis</div>
            <div class="card-body">
                <form id="form">
                    <!-- Form Row-->
                    <div class="row gx-3 mb-3">
                        <!-- Form Group (judul)-->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Judul</label>
                                <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul">
                            </div>
                        </div>
                        <!-- Form Group (materi)-->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Materi</label>
                                <select class="form-control" name="materi" id="materi">
                                    <option value="">Pilih Materi</option>
                                    <?php foreach ($result as $row) { ?>
                                        <option value="<?= $row['id_materi'] ?>"><?= $row['judul'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <!-- Form Group (waktu)-->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Waktu</label>
                                <input type="time" class="form-control" name="waktu" id="waktu" placeholder="Waktu">
                            </div>
                        </div>
                        <!-- Form Group (jumlah soal)-->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Jumlah Soal</label>
                                <input type="text" class="form-control" name="jumlah_soal" id="jumlah_soal" placeholder="Jumlah Soal">
                            </div>
                        </div>
                        <!-- Form Group (tanggal)-->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Tanggal</label>
                                <input class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal">
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
        data += '&action=tambah';
        $.ajax({
            type: 'POST',
            url: '<?= base_url('guru/kuis/function.php') ?>',
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
                        load_list('<?= base_url('guru/kuis/list.php') ?>');
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