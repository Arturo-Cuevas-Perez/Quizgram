<?php

  session_start();
  include('../secretInfo/conexion_BD.php');

  $descripcion = nl2br($_POST['descripcion']);
  function aUrl($plain_text)
  {
    return preg_replace(
      '@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-~]*(\?\S+)?)?)?)@',
      '<a href=\"$1\">$1</a>', $plain_text);
  }

  date_default_timezone_set("America/Mexico_City");
  $fecha = date("Y-m-d H:i:s");

  $descripcion = aUrl($descripcion);
  $id_usuario = $_SESSION['id_usuario'];
  $id_clase = $_POST['id_clase'];

  $query = mysqli_query($mysqli, "INSERT INTO publicaciones (id_clase, id_autor, descripcion, fecha) VALUES ('".$id_clase."', '".$id_usuario."', '".$descripcion."','".$fecha."')");

  if ($query)
  {
    header('Location: ../clase.php?id='.$id_clase);
  }
  else
  {
    echo "Vaya. Parece que no hemos podido publicar tu comentario. Inténtalo de nuevo más tarde. <br>".mysqli_error($mysqli);
  }

?>
