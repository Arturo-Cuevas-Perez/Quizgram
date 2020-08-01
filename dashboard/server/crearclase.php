<?php

  session_start();
  include('../secretInfo/conexion_BD.php');


  $permitted_chars = "0123456789abcdefghijk0123456789lmnopqrstuvwx0123456789yzABCDEFGHIJK0123456789LMNOPQRSTUVWXYZ";

  function generate_string($input, $strength = 16)
  {
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++)
    {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
    return $random_string;
  }

  $nombreClase = $_POST['nombreClase'];
  $asignatura = $_POST['asignatura'];
  $curso = $_POST['curso'];
  $grupo = $_POST['grupo'];
  $id_tutor = $_SESSION['id_usuario'];
  $codigo = generate_string($permitted_chars, 6);

  while (mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM clases WHERE id = '".$codigo."'")) != 0)
  {
    $codigo = generate_string($permitted_chars, 6);
  }

  $query = mysqli_query($mysqli, "INSERT INTO clases (id, nombreClase, asignatura, curso, grupo, id_tutor, id_alumnos) VALUES ('".$codigo."', '".$nombreClase."', '".$asignatura."', '".$curso."', '".$grupo."', '".$id_tutor."', ';".$_SESSION['id_usuario'].";')");

  if ($query)
  {
    header('Location: ../clase.php?creado&id='.$codigo);
    echo "OK";
  }
  else
  {
    echo "ERROR: ".mysqli_error($mysqli);
  }

?>
