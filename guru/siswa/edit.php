<?php
session_start();
require_once('../../config/koneksi.php');
require_once('../../config/function.php');
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}
$id_siswa = $_GET['id_siswa'];
$sql = "SELECT * FROM tb_m_siswa WHERE id_siswa = '$id_siswa'";
$query = $con->prepare($sql);
$query->execute();
$result = $query->fetch(PDO::FETCH_ASSOC);
?>
<form id="form">
    <input type="hidden" name="id_siswa" value="<?= $result['id_siswa'] ?>">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Status Siswa</h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <label class="small mb-1" for="status">Status</label>
        <select class="form-control" id="status" name="status">
            <option value="">Pilih Status</option>
            <option value="aktif" <?php if ($result['status'] == 'aktif') {
                                        echo 'selected';
                                    } ?>>Aktif</option>
            <option value="nonaktif" <?php if ($result['status'] == 'nonaktif') {
                                            echo 'selected';
                                        } ?>>Non Aktif</option>

        </select>
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
        data += '&action=update';
        $.ajax({
            type: 'POST',
            url: '<?= base_url('guru/siswa/function.php') ?>',
            data: data,
            dataType: 'json',
            beforeSend: function() {
                $('tombol_submit').prop("disabled", true);
                $('tombol_submit').text('Please wait...');
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
                            $('tombol_submit').prop("disabled", false);
                            $('tombol_submit').html('Simpan');
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
                        $('tombol_submit').prop("disabled", false);
                        $('tombol_submit').html('Simpan');
                    }, 2000);
                }
            }
        });
    });
</script>