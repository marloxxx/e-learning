<?php
session_start();
require_once('config/koneksi.php');
require_once('config/function.php');
global $con;
if (isset($_SESSION['user'])) {
    redirect($_SESSION['user']['role']);
}
$sql = "SELECT * FROM tb_m_kelas";
$query = $con->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Register - E-Learning</title>
    <link href="assets/css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/sweetalert.css" type="text/css" />
    <link rel="stylesheet" href="assets/css/toastr.css" type="text/css" />
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container-xl px-4">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <!-- Basic registration form-->
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header justify-content-center">
                                    <h3 class="fw-light my-4">Create Account</h3>
                                </div>
                                <div class="card-body">
                                    <!-- Registration form-->
                                    <form id="form_register">
                                        <!-- Form Row-->
                                        <!-- Form Group (name)-->
                                        <div class="mb-3">
                                            <label class="small mb-1" for="name">Nama</label>
                                            <input class="form-control" id="nama" name="nama" type="text" placeholder="Enter first name" />
                                        </div>
                                        <!-- Form Group (username)-->
                                        <div class="mb-3">
                                            <label class="small mb-1" for="username">Username</label>
                                            <input class="form-control" id="username" name="username" type="text" placeholder="Enter username" />
                                        </div>
                                        <!-- Form Group (nisn)-->

                                        <!-- Form Group (email)-->
                                        <div class="mb-3">
                                            <label class="small mb-1" for="email">Email</label>
                                            <input class="form-control" id="email" type="email" name="email" placeholder="Enter email address" />
                                        </div>
                                        <div class="row gx-3">
                                            <div class="col-md-6">
                                                <!-- Form Group (jenis kelamin)-->
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="nisn">NISN</label>
                                                    <input class="form-control" id="nisn" name="nisn" type="text" placeholder="Enter NISN" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="kelas">Kelas</label>
                                                    <select class="form-control" id="kelas" name="kelas">
                                                        <option value="">Pilih Kelas</option>
                                                        <?php
                                                        foreach ($result as $row) {
                                                            echo '<option value="' . $row['id_kelas'] . '">' . $row['nama'] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Form Row    -->
                                        <div class="row gx-3">
                                            <div class="col-md-6">
                                                <!-- Form Group (password)-->
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="password">Password</label>
                                                    <input class="form-control" id="password" type="password" name="password" placeholder="Enter password" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <!-- Form Group (confirm password)-->
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="confirm-password">Confirm Password</label>
                                                    <input class="form-control" id="confirm_password" type="password" name="confirm_password" placeholder="Confirm password" />
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Form Group (create account submit)-->
                                        <div class="d-flex align-items-center justify-content-center">
                                            <!-- <a class="small" href="forget.php">Forgot Password?</a> -->
                                            <button type="submit" class="btn btn-primary">Daftar</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center">
                                    <div class="small"><a href="index.php">Have an account? Go to login</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="footer-admin mt-auto footer-dark">
                <div class="container-xl px-4">
                    <div class="row">
                        <div class="col-md-6 small">Copyright &copy; Your Website 2021</div>
                        <div class="col-md-6 text-md-end small">
                            <a href="#!">Privacy Policy</a>
                            &middot;
                            <a href="#!">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="assets/js/scripts.js"></script>
    <script src="assets/js/toastr.js"></script>
    <script src="assets/js/sweetalert.js"></script>
    <script>
        $('#form_register').on('submit', function(e) {
            e.preventDefault();
            var data = $(this).serialize();
            $.post('config/register.php', data, function(response) {
                if (response.status == 'success') {
                    Swal.fire({
                        text: response.message,
                        icon: "success",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, Mengerti!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    }).then(function() {
                        location.href = response.url;
                    });
                } else {
                    Swal.fire({
                        text: response.message,
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, Mengerti!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>