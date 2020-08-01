<?php

  include('../secretInfo/conexion_BD.php');

  $id = $_POST['id_curso'];
  $titulo = $_POST['titulo'];
  $tema = $_POST['tema'];
  $descripcion = $_POST['descripcion'];

  if (isset($_POST['publicado']))
  {
    $publicado = 1;
  }
  else
  {
    $publicado = 0;
  }



  if (mysqli_query($mysqli, "UPDATE modulos SET titulo = '".$titulo."', tema = '".$tema."', descripcion = '".$descripcion."', publicado = '".$publicado."' WHERE id = '".$id."'")) {
    header('Location: ../editarmodulo.php?editado&id='.$id);
  }
  else
  {
    echo "Vaya, hemos tenido un error al enviar los datos. Vuelve a intentarlo más tarde.";
  }

?>
