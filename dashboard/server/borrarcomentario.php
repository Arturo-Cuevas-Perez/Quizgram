<?php

  session_start();
  include('../secretInfo/conexion_BD.php');

  $id_clase = $_GET['id'];
  $llave = $_GET['llave'];
  $autor = $_GET['autor'];

  $query = mysqli_query($mysqli, "DELETE FROM publicaciones WHERE id_autor = '".$autor."' and id_clase = '".$id_clase."' and llave = '".$llave."'");

  if ($query)
  {
    header('Location: ../clase.php?id='.$id_clase);
  }
  else
  {
    echo "ERROR: ".mysqli_error($mysqli);
  }

?>
