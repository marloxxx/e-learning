<?php
session_start();
require_once('../../config/koneksi.php');
require_once('../../config/function.php');
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}
$id_materi = $_GET['id_materi'];
?>
<form id="form">
    <input type="hidden" name="id_mapel" id="id_mapel" value="<?= $id_mapel ?>">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Sub Materi</h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <label class="small mb-1" for="status">Judul Sub Materi</label>
                <input class="form-control" id="judul" name="judul" type="text" placeholder="Judul Materi">
            </div>
            <div class="col-md-12">
                <label class="small mb-1" for="status">Deskripsi Sub Materi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" type="text" placeholder="Deskripsi Materi"></textarea>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="submit">Simpan</button>
    </div>
</form>
<script>
    $('#form').submit(function(e) {
        e.preventDefault();
        var data = $('#form').serialize();
        data += '&action=tambah';
        $.ajax({
            type: 'POST',
            url: '<?= base_url('guru/materi/function.php') ?>',
            data: data,
            dataType: 'json',
            beforeSend: function() {
                $('button').prop("disabled", true);
                $('button').text('Please wait...');
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
                        $('#modalListResult').modal('hide');
                        setTimeout(function() {
                            $('button').prop("disabled", false);
                            $('button').html('Simpan');
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
                        $('button').prop("disabled", false);
                        $('button').html('Simpan');
                    }, 2000);
                }
            }
        });
    });
</script>