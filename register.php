<?php
session_start();
require_once('config/koneksi.php');
require_once('config/function.php');
if (isset($_SESSION['user'])) {
    redirect($_SESSION['user']['role']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Register - SB Admin Pro</title>
    <link href="assets/css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
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
                                    <form>
                                        <!-- Form Row-->
                                        <!-- Form Group (name)-->
                                        <div class="mb-3">
                                            <label class="small mb-1" for="name">Nama</label>
                                            <input class="form-control" id="name" name="name" type="text" placeholder="Enter first name" />
                                        </div>
                                        <!-- Form Group (nisn)-->
                                        <div class="mb-3">
                                            <label class="small mb-1" for="nisn">NISN</label>
                                            <input class="form-control" id="nisn" name="nisn" type="text" placeholder="Enter NISN" />
                                        </div>
                                        <!-- Form Group (email)-->
                                        <div class="mb-3">
                                            <label class="small mb-1" for="email">Email</label>
                                            <input class="form-control" id="email" type="email" name="email" placeholder="Enter email address" />
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
                                                    <input class="form-control" id="confirm-password" type="password" name="confirm-password" placeholder="Confirm password" />
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Form Group (jenis kelamin)-->
                                        <div class="mb-3">
                                            <label class="small mb-1" for="jenis-kelamin">Jenis Kelamin</label>
                                            <select class="form-control" id="jenis-kelamin" name="jenis-kelamin">
                                                <option value="Laki-laki">Laki-laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                        <!-- Form Group (create account submit)-->
                                        <a class="btn btn-primary btn-block" href="auth-login-basic.html">Create Account</a>
                                    </form>
                                </div>
                                <div class="card-footer text-center">
                                    <div class="small"><a href="auth-login-basic.html">Have an account? Go to login</a></div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="assets/js/scripts.js"></script>
</body>

</html>