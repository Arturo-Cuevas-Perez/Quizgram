<?php

  session_start();
  include('../secretInfo/conexion_BD.php');

  $contenido = nl2br($_POST['contenido']);
  function aUrl($plain_text)
  {
    return preg_replace(
      '@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-~]*(\?\S+)?)?)?)@',
      '<a href=\"$1\">$1</a>', $plain_text);
  }

  $titulo = $_POST['titulo'];
  $contenido = aUrl($contenido);
  $id_modulo = $_POST['id_modulo'];
  $id_autor = $_SESSION['id_usuario'];


  if (mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM submodulos WHERE id_modulo = '".$id_modulo."'")))
  {
    $num = mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM submodulos WHERE id_modulo = '".$id_modulo."'")) + 1;
  }
  else
  {
    $num = 1;
  }

  $query_1 = mysqli_query($mysqli, "INSERT INTO submodulos (id_modulo, titulo, contenido, orden, id_autor) VALUES (".$id_modulo.",'".$titulo."','".$contenido."', ".$num.", ".$id_autor.")");
  if ($query_1 == true)
  {
    $query_2 = mysqli_query($mysqli, "INSERT INTO progresocursos (id_usuario, id_modulo) VALUES (".$id_autor.", ".$id_modulo.")");
  }
  if ($query_2 == true)
  {
    header('Location: ../crearsubmodulo.php?id='.$id_modulo);
  }
  else
  {
    echo "Vaya. Parece que no hemos podido agrgar tu modulo. Inténtalo de nuevo más tarde. <br>".mysqli_error($mysqli);
  }
?>
