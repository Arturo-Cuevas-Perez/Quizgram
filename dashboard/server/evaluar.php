<?php

  include('../secretInfo/conexion_BD.php');

  $puntuacion = $_POST['puntuacion'];
  $id_respuesta = $_POST['id_respuesta'];

  if ($puntuacion == NULL)
  {
    $puntuacion = 100;
  }
  else if ($puntuacion > 100)
  {
    echo "Debes rellenar el campo de puntuación con un valor inferior o igual a 100. <a href='../respuesta.php?id=".$id_respuesta."'>Volver a intentar</a>";
  }
  else
  {
    if (mysqli_query($mysqli, "UPDATE respuestas SET puntuacion = '".$puntuacion."' WHERE id = '".$id_respuesta."'"))
    {
      $id_tarea = mysqli_fetch_array(mysqli_query($mysqli, "SELECT id_tarea FROM respuestas WHERE id = '".$id_respuesta."'"));
      $id_para = mysqli_fetch_array(mysqli_query($mysqli, "SELECT id_para FROM tareas WHERE id = '".$id_tarea['id_tarea']."'"));
      $intermedio = explode(";", $id_para['id_para']);
      $id_clase = substr($intermedio[0], 3);
      header('Location: ../clase.php?id='.$id_clase);
    }
  }
?>
