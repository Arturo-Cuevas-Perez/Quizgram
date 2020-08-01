<?php

  session_start();
  include('../secretInfo/conexion_BD.php');
  include('../secretInfo/funciones.php');


  if ($_POST['tipo'] == "ejercicio")
  {

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

    date_default_timezone_set("America/Mexico_City");
    $fecha_tarea = date("Y-m-d H:i:s");

    $enunciado = $_POST['enunciado'];
    $id_clase = $_POST['id_clase'];
    $alumnos = $_POST['alumno'];

    $para = "c: ".$id_clase."; ";

    foreach ($alumnos as $alumno)
    {
      $para = $para.",".$alumno;
    }
    if (mysqli_query($mysqli, "INSERT INTO tareas (id_clase, tipo, descripcion, id_autor, id_para, fecha_tarea, archivo, tamano) VALUES ('".$id_clase."', 'ejercicio', '".$enunciado."', '".$_SESSION['id_usuario']."', '".$para."', '".$fecha_tarea."', '".$final_file."', '".$fileSizeMB."')"))
    {
      //header('Location: ../clase.php?id='.$id_clase);
    }
    else
    {
      echo "Lo sentimos, pero ha sido imposible crear la tarea";
    }
  }
  else
  {
    date_default_timezone_set("America/Mexico_City");
    $fecha_tarea = date("Y-m-d H:i:s");

    $id_modulo = $_POST['id_modulo'];
    $id_clase = $_POST['id_clase'];
    $alumnos = $_POST['alumno'];

    $para = "c: ".$id_clase."; ";

    foreach ($alumnos as $alumno)
    {
      $para = $para.",".$alumno;
    }
    if (mysqli_query($mysqli, "INSERT INTO tareas (id_clase, tipo, id_modulo, id_autor, id_para, fecha_tarea) VALUES ('".$id_clase."', 'curso', '".$id_modulo."', '".$_SESSION['id_usuario']."', '".$para."', '".$fecha_tarea."')"))
    {
      header('Location: ../clase.php?id='.$id_clase);
    }
    else
    {
      echo "Lo sentimos, pero ha sido imposible crear la tarea";
    }
  }

?>
