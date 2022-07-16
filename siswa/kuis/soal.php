<?php
session_start();
require_once('../../config/koneksi.php');
require_once('../../config/function.php');
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}
$id_kuis = $_GET['id_kuis'];
$sql = "SELECT * FROM tb_r_soal WHERE id_kuis = '$id_kuis'";
$query = $con->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Learning | Guru</title>
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.png" />
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
        <main>
            <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
                <div class="container-fluid px-4">
                    <div class="page-header-content">
                        <div class="row align-items-center justify-content-between pt-3">
                            <div class="col-auto mb-3">
                                <h1 class="page-header-title">
                                    <div class="page-header-icon"><i data-feather="file-plus"></i></div>
                                    Create Post
                                </h1>
                            </div>
                            <div class="col-12 col-xl-auto mb-3">
                                <a class="btn btn-sm btn-light text-primary" href="blog-management-posts-list.html">
                                    <i class="me-1" data-feather="arrow-left"></i>
                                    Back to All Posts
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- Main page content-->
            <div class="container-fluid px-4">
                <div class="row gx-4">
                    <div class="col-lg-8">
                        <div class="card card-header-actions mb-4">
                            <div class="card-header">
                                Soal
                                <i class="text-muted" data-feather="info" data-bs-toggle="tooltip" data-bs-placement="left" title="The post preview text shows below the post title, and is the post summary on blog pages."></i>
                            </div>
                            <div class="card-body">
                                <?php
                                $no = 1;
                                foreach ($result as $row) {
                                ?>
                                    <label><?= $no++ ?></label>
                                    <textarea class="lh-base form-control" type="text" placeholder="Enter your post preview text..." rows="4" style="background: transparent; border: none; resize: none;"><?php echo $row['pertanyaan']; ?></textarea>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4" style="position: sticky; top: 0;">
                        <div class="card card-header-actions">
                            <div class="card-header">
                                Publish
                                <i class="text-muted" data-feather="info" data-bs-toggle="tooltip" data-bs-placement="left" title="After submitting, your post will be published once it is approved by a moderator."></i>
                            </div>
                            <div class="card-body">
                                <div class="d-grid mb-3">
                                    <button class="fw-500 btn btn-primary-soft text-primary">Save as Draft</button>
                                </div>
                                <div class="d-grid">
                                    <button class="fw-500 btn btn-primary">Submit for Approval</button>
                                </div>
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
</body>

</html>