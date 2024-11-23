<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index.php" class="brand-link">
        <img src="public/img/isft177_logo_chico.png" alt="logo isft177" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">ISFT Nº 177</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="public/img/usr_login.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block font-weight-bold"> <?php $data = UserController::sessionDataUser($_SESSION['id_user']) ?>
                    <?php echo $data['name_rol'] ?></a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <?php if ($data['change_password'] != 0) : ?>

                    <li class="nav-item mb-1">
                        <a href="index.php?pages=home" class="nav-link">
                            <i class="fas fa-home nav-icon"></i>
                            <p>Inicio</p>
                        </a>
                    </li>
                <?php endif; ?>
                <?php

                if ($_SESSION['fk_rol_id'] == 1) {
                    include_once "sidebarAdmin.php";
                }
                ?>
                <?php
                if ($_SESSION['fk_rol_id'] == 2) {
                    include_once "sidebarPreceptor.php";
                }
                ?>
                <?php
                if ($_SESSION['fk_rol_id'] == 4) {
                    include_once "sidebarTeacher.php";
                }

                ?>

                <?php if ($_SESSION['change_password'] === 0) : ?>
                    <li class="nav-item">
                        <a href="index.php?pages=changedPasswordStart" class="nav-link">
                            <i class="nav-icon fas fa-user-cog"></i>
                            <p>Cambio por primera vez</p>
                        </a>
                    </li>
                <?php endif; ?>



            </ul>
        </nav>
    </div>
</aside>