<?php

  include('../secretInfo/conexion_BD.php');
  session_start();


  $codigo = $_POST['codigo'];

  if (mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM clases WHERE id = '".$codigo."' AND id_alumnos LIKE '%; ".$_SESSION['id_usuario']."%'")) == 0)
  {
    $antes = mysqli_fetch_array(mysqli_query($mysqli, "SELECT id_alumnos FROM clases WHERE id = '".$codigo."'"));
    $despues = $antes['id_alumnos']."; ".$_SESSION['id_usuario'];
    if (mysqli_query($mysqli, "UPDATE clases SET id_alumnos = '".$despues."' WHERE id = '".$codigo."'"))
    {
      header('Location: ../clase.php?id='.$codigo);
    }
    else
    {
      echo "No hemos podido inscribirte";
    }
  }
  else
  {
    header('Location: ../clases.php?error');
  }

?>
