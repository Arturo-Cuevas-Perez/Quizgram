<?php

  session_start();
  include('../secretInfo/conexion_BD.php');

  $id_clase = $_GET['id_clase'];
  $id = $_GET['id'];
  $autor = $_GET['autor'];

  $query = mysqli_query($mysqli, "DELETE FROM tareas WHERE id_autor = '".$autor."' and id_clase = '".$id_clase."' and id = '".$id."'");

  if ($query)
  {
    header('Location: ../clase.php?id='.$id_clase);
  }
  else
  {
    echo "ERROR: ".mysqli_error($mysqli);
  }

?>
