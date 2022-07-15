<?php
session_start();
require_once('../../config/koneksi.php');
require_once('../../config/function.php');
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}
$id_materi = $_GET['id_materi'];
$id = $_GET['id'];
$sql = "SELECT * FROM tb_r_submateri WHERE id_submateri = '$id'";
$query = $con->prepare($sql);
$query->execute();
$result = $query->fetch(PDO::FETCH_ASSOC);
?>
<form id="form">
    <input type="hidden" name="id_materi" value="<?= $id_materi ?>">
    <input type="hidden" name="id" value="<?= $id ?>">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Mata Pelajaran</h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <label class="small mb-1" for="status">Judul Sub Materi</label>
                <input class="form-control" id="judul" name="judul" type="text" placeholder="Judul Materi" value="<?= $result['judul'] ?>">
            </div>
            <div class="col-md-12">
                <label class="small mb-1" for="status">Deskripsi Sub Materi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" type="text" placeholder="Deskripsi Materi"><?= $result['deskripsi'] ?></textarea>
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
        var data = $('#form').serialize();
        data += '&action=edit';
        $.ajax({
            type: 'POST',
            url: '<?= base_url('guru/submateri/function.php') ?>',
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