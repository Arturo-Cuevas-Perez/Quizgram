<?php
    session_start();

    include('../secretInfo/conexion_BD.php');
    include('../secretInfo/funciones.php');

    $stmt = $mysqli -> prepare("UPDATE usuarios SET user = ?, last_name = ? WHERE id = '".$_SESSION['id_usuario']."'");

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];

    if
    (
      $stmt &&
      $stmt -> bind_param('ss', $nombre, $apellido) &&
      $stmt -> execute())
    {
    	header('Location: ../perfil.php?cambios_ok');
    }
    else
    {
      echo "Error guardando los datos";
    	header('Location: ../perfil.php?error');
    }
    $stmt->close();
?>
