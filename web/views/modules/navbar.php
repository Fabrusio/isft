<nav class="fixed-top main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button" title="Ocultar barra lateral"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <!-- Username con dropdown para "Mis datos" -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user mr-1"></i>
                <?php $data = UserController::sessionDataUser($_SESSION['id_user']) ?>
                <?php echo $data['name_user'] . " " . $data['last_name_user'] ?>
            </a>
            <?php if ($data['change_password'] != 0) : ?>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="index.php?pages=myData">
                        <i class="fas fa-id-card"></i> Mis datos
                    </a>
                <?php if($_SESSION['fk_rol_id'] == 4): ?>
                <a class="dropdown-item" href="#" download="">
                    <i class="fas fa-book"></i> Descargar manual de usuario
                </a>
                <?php endif;?>

                <?php if($_SESSION['fk_rol_id'] != 4): ?>
                    <a class="dropdown-item" href="/public/img/Manual de uso - ISFT 177.pdf" download="Manual de uso - ISFT 177">
                        <i class="fas fa-book"></i> Descargar manual de usuario
                    </a>
                <?php endif;?>
                    <a class="dropdown-item" href="index.php?pages=changePassword">
                        <i class="fas fa-key"></i> Cambiar contraseña
                    </a>
                    <?php if($_SESSION['fk_rol_id']==1):?>
                    <a class="dropdown-item" href="index.php?pages=autoEmail">
                    <i class="fas fa-cogs"></i> Configuración de email
                    </a>
                    <? endif;?>
                </div>
        </li>

        <!-- Botón de Cerrar Sesión con SweetAlert -->
        <li class="nav-item">
            <a class="nav-link btn btn-danger" id="logout-button" href="#" role="button" title="Cerrar sesión">
                <i class="text-white fas fa-power-off"></i>
            </a>
        </li>
    <?php endif; ?>
    </ul>

</nav>