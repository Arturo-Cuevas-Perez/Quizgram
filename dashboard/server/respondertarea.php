<?php

  session_start();
  include('../secretInfo/conexion_BD.php');
  include('../secretInfo/funciones.php');

  $path = '../uploads/';

  if($_FILES['file']['name'] != null)
  {
    $namefile = normalizar($_FILES['file']['name']);
    $filelower = strtolower($namefile);
    $final_file = rand(1000,1000000).$filelower;
    $temp=$_FILES['file']['tmp_name'];
    $size = $_FILES['file']['size'];
    $fileSizeMB = formatBytes($size);

    move_uploaded_file($temp, $path.$final_file);
  }

  $respuesta = nl2br($_POST['respuesta']);
  function aUrl($plain_text)
  {
    return preg_replace(
      '@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-~]*(\?\S+)?)?)?)@',
      '<a href=\"$1\">$1</a>', $plain_text);
  }

  $respuesta = aUrl($respuesta);
  $id_tarea = $_POST['id_tarea'];


  $query = mysqli_query($mysqli, "INSERT INTO respuestas (id_tarea, respuesta, id_alumno, archivo_respuesta, tamano_respuesta) VALUES ('".$id_tarea."', '".$respuesta."', '".$_SESSION['id_usuario']."', '".$final_file."', '".$fileSizeMB."')");

  if ($query)
  {
    header('Location: ../clase.php?id='.$_POST['id_clase']);
  }
  else
  {
    echo "Error en el envío".mysqli_error($mysqli);
  }

?>
