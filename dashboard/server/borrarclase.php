<?php

  session_start();
  include('../secretInfo/conexion_BD.php');

  $id_clase = $_POST['btn_borrar'];

  $query = mysqli_query($mysqli, "DELETE FROM clases WHERE id = '".$id_clase."'");
  $query = mysqli_query($mysqli, "DELETE FROM publicaciones WHERE id_clase = '".$id_clase."'");
  $query = mysqli_query($mysqli, "DELETE FROM tareas WHERE id_clase = '".$id_clase."'");

  if ($query)
  {
    header('Location: ../index.php?claseBorrada&='.$id_clase);
    echo "OK";
  }
  else
  {
    echo "ERROR: ".mysqli_error($mysqli);
  }

?>
