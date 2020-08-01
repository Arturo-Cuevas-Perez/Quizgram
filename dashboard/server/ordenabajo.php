<?php

  include('../secretInfo/conexion_BD.php');
  $id_modulo = $_GET['idm'];
  $id_submodulo = $_GET['ids'];
  $ref = $_GET['ref'];
  if ($ref == "editar") {
    $id_submodulo_editando = $_GET['isub'];
  }

  $orden_actual = mysqli_fetch_array(mysqli_query($mysqli, "SELECT orden FROM submodulos WHERE id = '".$id_submodulo."'"));
  $sub_anterior = mysqli_fetch_array(mysqli_query($mysqli, "SELECT id FROM submodulos WHERE id_modulo = '".$id_modulo."' AND orden = '".($orden_actual['orden'] + 1)."'"));

  if (mysqli_query($mysqli, "UPDATE submodulos SET orden = '".($orden_actual['orden'] + 1)."' WHERE id = '".$id_submodulo."'") && mysqli_query($mysqli, "UPDATE submodulos SET orden = '".$orden_actual['orden']."' WHERE id = '".$sub_anterior['id']."'")) {
    if ($ref == "editar") {
      header('Location: ../editarsubmodulo.php?idm='.$id_modulo.'&ids='.$id_submodulo);
    } else if ($ref == "crearsubmodulo") {
      header('Location: ../crearsubmodulo.php');
    } else {
      header('Location: ../editarmodulo.php?id='.$id_modulo);
    }
  }

?>
