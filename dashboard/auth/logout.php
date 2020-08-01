<?php
    session_start(); //Iniciar una nueva sesión o reanudar la existente
    if (session_destroy()) { //Destruye la sesión
      header('Location: login.php?sesioncerrada');
    } else {
      echo "Ha surgido un problema durante el cierre de la sesión. Lo sentimos.<br>Si el problema persiste, ponte en contacto con el administrador.";
    }
?>
