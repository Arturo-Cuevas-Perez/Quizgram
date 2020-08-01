<?php
	session_start();

	require 'secretInfo/conexion_BD.php';
	require 'secretInfo/funciones.php';

	if(!isset($_SESSION["id_usuario"]))
	{
		header("Location: auth/login.php");
	}

	$idUsuario = $_SESSION['id_usuario'];

	$sql = "SELECT id, user, last_name, email, password, id_tipo FROM usuarios WHERE id = '$idUsuario'";
	$result = $mysqli->query($sql);

	$row = $result->fetch_assoc();
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="author" content="Arturo Cuevas">
	<meta name="description" content="Plataforma Educativa">
	<meta name="keywords" content="educacion, plataforma, web">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Dashboard | Quizgram</title>
  <link rel="stylesheet" href="css/all.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.css" rel="stylesheet">

	<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.4.0/umd/popper.min.js"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.js"></script>

	<link rel="shortcut icon" href="../assets/img/quizgram.svg" type="image/x-icon">
	<link rel="icon" href="../assets/img/quizgram.svg" type="image/x-icon">

</head>

<body class="sb-nav-fixed">
  <nav class="sb-topnav navbar navbar-expand navbar-light bg-light border-bottom">
    <a class="navbar-brand text-center" href="index.php"><img class="logo" src="assets\img\quizgram.svg" alt="Plataforma Educativa" style="width:auto;height:50px;"></a>

    <button id="sidebarToggle" class="btn navbar-toggler d-block third-button" type="button" data-toggle="collapse" data-target="#navbarSupportedContent22" aria-controls="navbarSupportedContent22" aria-expanded="false" aria-label="Toggle navigation">
      <div class="animated-icon3">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
				<?php if ($row['id_tipo'] == "1"): ?>
		      <li class="nav-item dropdown no-arrow d-none d-sm-inline-block">
		        <a class="nav-link " href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		          <i class="fas fa-briefcase"></i>
		        </a>
		        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
		          <h6 class="dropdown-header font-weight-bold">Clases</h6>
		          <a href="#" class="dropdown-item" data-toggle="modal" data-target="#crearClaseModal">
		            <i class="fas fa-plus" style="font-size:15px;"></i>
		            Crear nueva clase
		          </a>
		          <div class="dropdown-divider"></div>
		          <h6 class="dropdown-header font-weight-bold">Cursos</h6>
		          <a href="#" class="dropdown-item" data-toggle="modal" data-target="#crearCursoModal">
		            <i class="fas fa-plus" style="font-size:1em;"></i>
		            Crear nuevo curso
		          </a>
		          <a href="#" class="dropdown-item" data-toggle="modal" data-target="#editarCursoModal">
		            <i class="fas fa-edit" style="font-size:1em;"></i>
		            Editar un curso existente
		          </a>
		        </div>
		      </li>
		    <?php else: ?>
					<li class="nav-item">
						<a href="#" class="nav-link no-arrow d-none d-sm-inline-block" data-toggle="modal" data-target="#unirClaseModal"><i class="fas fa-link"></i></a>
					</li>
		    <?php endif; ?>

				<span class="divider-vertical no-arrow d-none d-sm-inline-block"></span>
        <li class="nav-item dropdown no-arrow d-none d-sm-inline-block">
          <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="perfil.php"><i class="fas fa-user"></i> &nbsp; Mi Perfil</a>
            <a class="dropdown-item" href="#"><i class="fas fa-envelope"></i> &nbsp; Mensajes</a>
            <a class="dropdown-item" href="configuracion.php"><i class="fas fa-cog"></i> &nbsp; Configuración</a>
          </div>
        </li>
        <li class="nav-item no-arrow d-none d-sm-inline-block">
          <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-sign-out-alt"></i></a>
        </li>

				<!-- Menu three dots -->

				<li class="nav-item dropdown no-arrow d-block d-sm-none">
					<a class="nav-link " href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fas fa-ellipsis-v" style="font-size:21px;"></i>
					</a>

					<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
						<?php if ($row['id_tipo'] == "1"): ?>
						<h6 class="dropdown-header font-weight-bold">Clases</h6>
						<a href="#" class="dropdown-item" data-toggle="modal" data-target="#crearClaseModal">
							<i class="fas fa-plus" style="font-size:15px;"></i>
							Crear nueva clase
						</a>
						<div class="dropdown-divider"></div>
						<h6 class="dropdown-header font-weight-bold">Cursos</h6>
						<a href="#" class="dropdown-item" data-toggle="modal" data-target="#crearCursoModal">
							<i class="fas fa-plus" style="font-size:1em;"></i>
							Crear nuevo curso
						</a>
						<a href="#" class="dropdown-item" data-toggle="modal" data-target="#editarCursoModal">
							<i class="fas fa-edit" style="font-size:1em;"></i>
							Editar un curso existente
						</a>
						<div class="dropdown-divider"></div>
						<h6 class="dropdown-header font-weight-bold">Ajustes</h6>
						<a class="dropdown-item" href="perfil.php"><i class="fas fa-user"></i> Mi Perfil</a>
            <a class="dropdown-item" href="#"><i class="fas fa-envelope"></i> Mensajes</a>
            <a class="dropdown-item" href="configuracion.php"><i class="fas fa-cog"></i> Configuración</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
					<?php else: ?>
						<a href="#" class="dropdown-item" data-toggle="modal" data-target="#unirClaseModal"><i class="fas fa-link"></i> Unirte a una clase</a>
						<div class="dropdown-divider"></div>
						<h6 class="dropdown-header font-weight-bold">Ajustes</h6>
						<a class="dropdown-item" href="perfil.php"><i class="fas fa-user"></i> Mi Perfil</a>
            <a class="dropdown-item" href="#"><i class="fas fa-envelope"></i> Mensajes</a>
            <a class="dropdown-item" href="configuracion.php"><i class="fas fa-cog"></i> Configuración</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
					<?php endif; ?>
					</div>
				</li>

      </ul>
    </div>
  </nav>
