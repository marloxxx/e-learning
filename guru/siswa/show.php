<?php
require_once('../../config/koneksi.php');
require_once('../../config/function.php');
$id_siswa = $_GET['id_siswa'];
$sql = "SELECT * FROM tb_m_siswa WHERE id_siswa = '$id_siswa'";
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
                            Detail Siswa
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
        <div class="row">
            <div class="col-xl-4">
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Profile Picture</div>
                    <div class="card-body text-center">
                        <!-- Profile picture image-->
                        <?php
                        if (empty($result['photo'])) {
                            echo '<img class="img-account-profile rounded-circle mb-2" src="../../assets/img/illustrations/profiles/profile-1.png" alt="" />';
                        } else {
                            echo '<img class="img-account-profile rounded-circle mb-2" src="../../assets/img/profile/' . $result['photo'] . '" alt="" />';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">Account Details</div>
                    <div class="card-body">
                        <!-- Form Group (nama)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="nama">Nama</label>
                            <input class="form-control" id="nama" name="nama" placeholder="Nama" value="<?= $result['nama'] ?>" required>
                        </div>
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="username">Username</label>
                            <input class="form-control" id="username" name="username" placeholder="Username" value="<?= $result['username'] ?>" required>
                        </div>
                        <!-- Form Group (nisn)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="nisn">NISN</label>
                            <input class="form-control" id="nisn" name="nisn" placeholder="NISN" value="<?= $result['nisn'] ?>" required>
                        </div>
                        <!-- Form Group (email)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="email">Email</label>
                            <input class="form-control" id="email" name="email" placeholder="Email" value="<?= $result['email'] ?>" required>
                        </div>
                        <!-- Form Group (kelas)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="kelas">Kelas</label>
                            <input class="form-control" id="kelas" name="kelas" placeholder="Kelas" value="<?= relation('tb_m_kelas', 'id_kelas', $result['id_kelas'])['nama']; ?>" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</main>