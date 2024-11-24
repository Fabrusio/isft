<?php

if (
      ($_GET['pages'] == "home") ||
      # links administracion de materias
      ($_GET['pages'] == "mySubjects") ||
      ($_GET['pages'] == "manageStudentSubject") ||
      # links administracion de Usuarios    
      ($_GET['pages'] == "myData") ||
      ($_GET['pages'] == "changedPasswordStart") ||
# links simples
      ($_GET['pages'] == "changePassword") 
    ) { 
      include "views/pages/".$_GET['pages'].".php";    
    } elseif ($_GET['pages'] == "logout") {
      include "views/pages/logout.php";   
    } else {
      include "views/pages/error404.php";   
    }
