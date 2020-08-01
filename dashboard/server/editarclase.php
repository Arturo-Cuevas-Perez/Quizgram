<?php

  session_start();
  include('../secretInfo/conexion_BD.php');

  $nombre = $_POST['nombreClase'];
  $asignatura = $_POST['asignatura'];
  $curso = $_POST['curso'];
  $grupo = $_POST['grupo'];
  $id_clase = $_POST['btn_editar'];

  $query = mysqli_query($mysqli, "UPDATE clases SET nombreClase = '".$nombre."', asignatura = '".$asignatura."', curso = '".$curso."', grupo = '".$grupo."' WHERE id = '".$id_clase."'");

  if ($query)
  {
    header('Location: ../clase.php?editado&id='.$id_clase);
    echo "OK";
  }
  else
  {
    echo "ERROR: ".mysqli_error($mysqli);
  }

?>
