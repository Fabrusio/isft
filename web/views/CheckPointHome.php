<?php ob_start();?>
<!DOCTYPE html>
<html lang="es">
<head>
<?php 
//   head
    include_once "modules/head.php";
?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
<?php 
//  <!-- Navbar -->
include_once "modules/navbar.php";
?>        
<?php 
//  <!-- Main Sidebar Container -->
    include_once "modules/sidebar.php";
?>
<div class="py-4 mb-2"></div>
<div class="content-wrapper">
<?php
/* AQUI DEBEN IR LOS FILTROS DE ROL PARA HABILITAR LAS OPCIONES CORRESPONDIENTES, CON $_SESSION */
    if( (isset($_GET['pages'])) && (isset($_SESSION['fk_rol_id'])) ) {

        switch ($_SESSION['fk_rol_id']) {
            case 1:
                include_once "getroles/GetAdminRol.php";
                break;
            case 2:
                include_once "getroles/GetPreceptoryRol.php";
                break;
            case 4:
                include_once "getroles/GetTeacherRol.php";
                break;
        }
    } else {
        include "views/pages/home.php";     
    }       
?>    
</div>
<?php  
/*
*  <!-- Main Footer -->
*/
include_once "modules/footer.php";
?>
</div>
<?php 
/*
* <!-- SCRIPTS JS -->
*/
include_once "modules/scripts.php";
?>
</body>
</html>
