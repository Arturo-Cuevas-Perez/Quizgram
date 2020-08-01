
<?php

  include('../secretInfo/conexion_BD.php');

  $id_alumno = $_GET['id'];
  $id_clase = $_GET['idc'];

  $actual = mysqli_fetch_array(mysqli_query($mysqli, "SELECT id_alumnos FROM clases WHERE id = '".$id_clase."'"));
  $separados = explode(";".";".$id_alumno, $actual['id_alumnos']);
  $despues = $separados[0].";".$separados[1];

  if (mysqli_query($mysqli, "UPDATE clases SET id_alumnos = '".$despues."' WHERE id = '".$id_clase."'"))
  {
    header('Location: ../clase.php?id='.$id_clase);
  }
  else
  {
    echo "Lo sentimos, pero ha ocurrido un error al sacar al intruso de clase";
  }

?>
