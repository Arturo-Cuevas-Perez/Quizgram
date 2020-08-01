
<?php

  session_start();
  include('../secretInfo/conexion_BD.php');

  $titulo = $_POST['titulo'];
  $tema = $_POST['tema'];
  $descripcion = $_POST['descripcion'];
  $id_autor = $_SESSION['id_usuario'];

  $repetido = mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM modulos WHERE titulo = '".$titulo."' AND id_autor = '".$id_autor."' LIMIT 1"));
  if($repetido == 1)
  {
    header('Location: ../index.php?errorTitulo');
  }

  else if (mysqli_query($mysqli, "INSERT INTO modulos (titulo, tema, descripcion, id_autor, publicado) VALUES ('".$titulo."','".$tema."','".$descripcion."', '".$id_autor."', 0)"))
  {
    $sql = mysqli_query($mysqli, "SELECT id FROM modulos WHERE titulo = '".$titulo."' AND id_autor = '".$id_autor."'");
    $row = mysqli_fetch_array($sql);
    header('Location: ../crearsubmodulo.php?id='.$row['id']);
  }
  else
  {
    echo "Error";
  }
?>
