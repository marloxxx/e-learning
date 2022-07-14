<nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
    <!-- Sidenav Toggle Button-->
    <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="sidebarToggle">
        <i data-feather="menu"></i>
    </button>
    <!-- Navbar Brand-->
    <!-- * * Tip * * You can use text or an image for your navbar brand.-->
    <!-- * * * * * * When using an image, we recommend the SVG format.-->
    <!-- * * * * * * Dimensions: Maximum height: 32px, maximum width: 240px-->
    <a class="navbar-brand pe-3 ps-4 ps-lg-2" href="<?php base_url('admin/dashboard/index.php') ?>">E-Learning</a>
    <!-- Navbar Items-->
    <ul class="navbar-nav align-items-center ms-auto">
        <!-- User Dropdown-->
        <li class="nav-item dropdown no-caret dropdown-user me-3 me-lg-4">
            <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php
                if (empty($_SESSION['user']['photo'])) {
                    echo '<img class="img-fluid" src="../../assets/img/illustrations/profiles/profile-1.png" alt="...">';
                } else {
                    '<img class="img-fluid" src="../../assets/img/profile/' . $_SESSION['user']['photo'] . '" alt="...">';
                }
                ?>
            </a>
            <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                <h6 class="dropdown-header d-flex align-items-center">
                    <?php
                    if (empty($_SESSION['user']['photo'])) {
                        echo '<img class="dropdown-user-img" src="../../assets/img/illustrations/profiles/profile-1.png" />';
                    } else {
                        '<img class="dropdown-user-img" src="../../assets/img/profile/' . $_SESSION['user']['photo'] . '" />';
                    }
                    ?>
                    <div class="dropdown-user-details">
                        <div class="dropdown-user-details-name"><?= $_SESSION['user']['nama'] ?></div>
                        <div class="dropdown-user-details-email"><?= $_SESSION['user']['email'] ?></div>
                    </div>
                </h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php base_url('logout.php'); ?>">
                    <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>