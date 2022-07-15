<?php
session_start();
require_once('../../config/koneksi.php');
require_once('../../config/function.php');
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}
$id = $_GET['id'];
$sql = "SELECT * FROM tb_m_guru WHERE id_guru = '$id'";
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
                            Edit Guru
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
            <div class="card-header">Account Details</div>
            <div class="card-body">
                <form id="form">
                    <!-- Form Row-->
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <div class="row gx-3 mb-3">
                        <!-- Form Group (nama)-->
                        <div class="col-md-12">
                            <label class="small mb-1" for="nama">Nama</label>
                            <input class="form-control" id="nama" name="nama" type="text" placeholder="Nama" value="<?= $result['nama']; ?>" />
                        </div>
                        <!-- Form Group (username)-->
                        <div class="col-md-12">
                            <label class="small mb-1" for="username">Username</label>
                            <input class="form-control" id="username" name="username" type="text" placeholder="Username" value="<?= $result['username']; ?>" />
                        </div>
                        <!-- Form Group (nip)-->
                        <div class="col-md-12">
                            <label class="small mb-1" for="nip">NIP</label>
                            <input class="form-control" id="nip" name="nip" type="text" placeholder="NIP" value="<?= $result['nip']; ?>" />
                        </div>
                        <!-- Form Group (email)-->
                        <div class="col-md-12">
                            <label class="small mb-1" for="email">Email</label>
                            <input class="form-control" id="email" name="email" type="email" placeholder="Email" value="<?= $result['email']; ?>" />
                        </div>
                        <!-- Form Group (password)-->
                        <div class="col-md-12">
                            <label class="small mb-1" for="password">Password</label>
                            <input class="form-control" id="password" name="password" type="password" placeholder="Password" />
                        </div>
                        <!-- Form Group (password)-->
                        <div class="col-md-12">
                            <label class="small mb-1" for="password">Konfirmasi Password</label>
                            <input class="form-control" id="confirm_password" name="confirm_password" type="password" placeholder="Konfirmasi Password" />
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit" id="tombol_submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</main>
<script>
    $(document).ready(function() {
        $('#form').submit(function(e) {
            e.preventDefault();
            var data = $(this).serialize();
            data += '&action=edit';
            $.ajax({
                type: 'POST',
                url: '<?= base_url('admin/guru/function.php') ?>',
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
                            load_list('<?= base_url('admin/guru/list.php') ?>');
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
    });
</script>