<?php $data = UserController::sessionDataUser($_SESSION['id_user']) ?>
<?php if ($data['change_password'] != 0) : ?>
    <li class="nav-item mb-1">
        <a href="index.php?pages=mySubjects" class="nav-link">
            <i class="fas fa-graduation-cap nav-icon"></i>
            <p>Gestionar materias</p>
        </a>
    </li>
<?php endif ?>


   
