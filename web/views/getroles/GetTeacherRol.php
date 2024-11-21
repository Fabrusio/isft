<?php

if (
      ($_GET['pages'] == "home") ||
      # links administracion de carreras
      ($_GET['pages'] == "") ||
      ($_GET['pages'] == "") ||
      ($_GET['pages'] == "") ||
      ($_GET['pages'] == "") ||
          
      ($_GET['pages'] == "") ||
      ($_GET['pages'] == "") ||
      ($_GET['pages'] == "") ||
      ($_GET['pages'] == "") ||
         
      ($_GET['pages'] == "") ||
      ($_GET['pages'] == "") ||
      # links administracion de Usuarios    
      ($_GET['pages'] == "myData") ||
      ($_GET['pages'] == "changedPasswordStart") ||
      ($_GET['pages'] == "") ||
      ($_GET['pages'] == "") || 
# links simples
      ($_GET['pages'] == "changePassword") 
    ) { 
      include "views/pages/".$_GET['pages'].".php";    
    } elseif ($_GET['pages'] == "logout") {
      include "views/pages/logout.php";   
    } else {
      include "views/pages/error404.php";   
    }
