<?php
session_start();
require_once('../../config/koneksi.php');
require_once('../../config/function.php');
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Learning | Guru</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
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
        <?php
        require_once('../../config/koneksi.php');
        require_once('../../config/function.php');
        $sql = "SELECT * FROM tb_m_admin";
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
                                    <div class="page-header-icon"><i data-feather="user"></i></div>
                                    Account Settings - Profile
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- Main page content-->
            <div class="container-xl px-4 mt-4">
                <!-- Account page navigation-->
                <nav class="nav nav-borders">
                    <a class="nav-link active ms-0" href="javascript:;">Profile</a>
                </nav>
                <hr class="mt-0 mb-4" />
                <div class="row">
                    <div class="col-xl-4">
                        <form id="image">
                            <!-- Profile picture card-->
                            <div class="card mb-4 mb-xl-0">
                                <div class="card-header">Profile Picture</div>
                                <div class="card-body text-center">
                                    <!-- Profile picture image-->
                                    <?php
                                    if (empty($_SESSION['user']['photo'])) {
                                        echo '<img class="img-account-profile rounded-circle mb-2" src="../../assets/img/illustrations/profiles/profile-1.png" alt="" />';
                                    } else {
                                        echo '<img class="img-account-profile rounded-circle mb-2" src="../../assets/img/profile/' . $_SESSION['user']['photo'] . '" alt="" />';
                                    }
                                    ?>
                                    <input type="file" name="photo" id="photo" class="d-none" placeholder="Pilih Gambar">
                                    <!-- Profile picture help block-->
                                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                                    <!-- Profile picture upload button-->
                                    <button class="btn btn-primary" id="upload" type="button">Upload foto baru</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-xl-8">
                        <!-- Account details card-->
                        <div class="card mb-4">
                            <div class="card-header">Account Details</div>
                            <div class="card-body">
                                <form id="profile">
                                    <!-- Form Group (nama)-->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="nama">Nama</label>
                                        <input class="form-control" id="nama" type="text" name="nama" placeholder="Nama" value="<?php echo $_SESSION['user']['nama']; ?>" />
                                    </div>
                                    <!-- Form Group (username)-->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="username">Username</label>
                                        <input class="form-control" id="username" type="text" name="username" placeholder="Username" value="<?php echo $_SESSION['user']['username']; ?>" />
                                    </div>
                                    <!-- Form Group (email)-->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="email">Email</label>
                                        <input class="form-control" id="email" type="email" name="email" placeholder="Email" value="<?php echo $_SESSION['user']['email']; ?>" />
                                    </div>
                                    <!-- Form Group (password)-->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="password">Password</label>
                                        <input class="form-control" id="password" type="password" name="password" placeholder="Password" />
                                    </div>
                                    <!-- Form Group (confirm password)-->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="confirm_password">Confirm Password</label>
                                        <input class="form-control" id="confirm_password" type="password" name="confirm_password" placeholder="Confirm Password" />
                                    </div>
                                    <!-- Save changes button-->
                                    <button class="btn btn-primary" type="submit">Simpan</button>
                                </form>
                            </div>
                        </div>
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
        $(document).ready(function() {
            $('#upload').click(function() {
                $('#photo').trigger('click');
            });
            $('#photo').change(function() {
                $('#image').submit();
            });
        });
        $('#image').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            formData.append('action', 'upload');
            $.ajax({
                type: 'POST',
                url: '<?= base_url('admin/profile/function.php') ?>',
                enctype: 'multipart/form-data',
                data: formData,
                processData: false,
                contentType: false,
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
                            location.reload();
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
        $('#profile').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            data += '&action=profile';
            $.ajax({
                type: 'POST',
                url: '<?= base_url('admin/profile/function.php') ?>',
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
                            location.reload();
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
</body>

</html>