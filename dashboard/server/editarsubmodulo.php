<?php

  session_start();
  include('../secretInfo/conexion_BD.php');

  $titulo = $_POST['titulo'];
  $contenido = $_POST['contenido'];
  $id_modulo = $_POST['id_modulo'];
  $id_submodulo = $_POST['id_submodulo'];
  $ref = $_POST['ref'];

  if (mysqli_query($mysqli, "UPDATE submodulos SET titulo = '".$titulo."', contenido = '".$contenido."' WHERE id = '".$id_submodulo."' AND id_modulo = '".$id_modulo."'")) {
    header('Location: ../editarmodulo.php?editado&id='.$id_modulo);
  } else {
    echo "Vaya, hemos tenido un error al enviar los datos. Vuelve a intentarlo más tarde.";
  }
?>
