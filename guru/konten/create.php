<?php
session_start();
require_once('../../config/koneksi.php');
require_once('../../config/function.php');
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}
$id_submateri = $_GET['id_submateri'];
?>
<form id="form">
    <input type="hidden" name="id_submateri" id="id_submateri" value="<?= $id_submateri ?>">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Konten</h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <label class="small mb-1" for="judul">Judul Konten</label>
                <input class="form-control" id="judul" name="judul" type="text" placeholder="Judul Materi">
            </div>
            <div class="col-md-12">
                <label class="small mb-1" for="file">File Konten</label>
                <input class="form-control" id="file" name="file" type="file" placeholder="File Materi">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="submit" id="tombol_submit">Simpan</button>
    </div>
</form>
<script>
    $('#form').submit(function(e) {
        e.preventDefault();
        var data = new FormData($('#form')[0]);
        data.append('action', 'tambah');
        $.ajax({
            type: 'POST',
            url: '<?= base_url('guru/konten/function.php') ?>',
            enctype: 'multipart/form-data',
            data: data,
            processData: false,
            contentType: false,
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
                        $('#modalListResult').modal('hide');
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
</script>