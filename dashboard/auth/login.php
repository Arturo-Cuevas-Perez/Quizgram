<?php

  require '../secretInfo/conexion_BD.php';
  require '../secretInfo/funciones.php';

	session_start();

	if(isset($_SESSION["id_usuario"]))
	{
		header("Location: /quizgram/dashboard/index.php"); //borra el quizgram goddady
	}

  $errors = array();

  if (!empty($_POST)) {
    $email = $mysqli->real_escape_string($_POST['email']);
    $password = $mysqli->real_escape_string($_POST['password']);

    if(isNullLogin($email, $password))
    {
      $errors[] = "Debe llenar todos los campos";
    }

    $errors[] = login($email, $password);
  }
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
    <title>Login | QuizGram</title>
		<link rel="stylesheet" href="../css/all.css">
	  <link rel="stylesheet" href="../css/bootstrap.css">
	  <link rel="stylesheet" href="../css/login.css">
	  <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
		<link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css'>
		<link rel="shortcut icon" href="../assets/img/quizgram.svg" type="image/x-icon">
		<link rel="icon" href="../assets/img/quizgram.svg" type="image/x-icon">

    <style type="text/css">
        ul {
          margin-bottom: 0rem !important;
        }
        .mt-5, .my-5
        {
          margin-top: 5rem !important;
        }
        .fa-question-circle
        {
          font-size: 1.8rem;
        }
        .btn-circle.btn-md {
            width: 50px;
            height: 50px;
            padding: 7px 10px;
            border-radius: 25px;
            position: absolute;
            top: 620px;
            right: 15px;
            float: right;
        }
        @media only screen and (min-width: 600px)
        {
          .btn-circle.btn-md {
              top: 670px;
          }
        }
    </style>

</head>
<body id="particles-js">

	<div class="animated bounceInDown">
    <div class="login-contenido">

			<?php if (isset($_GET['sesioncerrada'])): ?>
			<div class="sesion-cerrada alert alert-success alert-dismissible fade show mt-5" role="alert" style="position:absolute;">
				<strong>¡Adios!</strong> La sesión se ha cerrado correctamente. Esperamos verte muy pronto.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?php endif; ?>

			<?php if (isset($_GET['registro_ok'])): ?>
    	<div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
    		<strong>¡Genial!</strong> Para terminar el proceso de registro sigue las instrucciones que le hemos enviado a la direccion de correo electronico proporcionada.
    		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    			<span aria-hidden="true">&times;</span>
    		</button>
    	</div>
    	<?php endif; ?>

      <?php if (isset($_GET['restablecer_ok'])): ?>
    	<div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
    		<strong>¡Genial!</strong> Se envio a tu correo las intrucciones para el restablecimiento de tu contraseña.
    		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    			<span aria-hidden="true">&times;</span>
    		</button>
    	</div>
    	<?php endif; ?>

      <?php if (isset($_GET['restablecido_ok'])): ?>
    	<div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
    		<strong>¡Genial!</strong> Se a restablecido con exito tu nueva contraseña, ya puedes seguir disfrutando de QuizGram.
    		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    			<span aria-hidden="true">&times;</span>
    		</button>
    	</div>
    	<?php endif; ?>

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="img-login">
                <h1>¡Hola de Nuevo!</h1>
            </div>

            <div class="contenido-form">
                <div class="email">
                    <i class="fas fa-user"></i><input type="email" placeholder="Correo Electrónico" name="email" required>
                </div>
                <div class="contrasena">
                    <i class="fas fa-key"></i><input type="password" placeholder="Contraseña" name="password" id="pwd" required><i class="fas fa-eye" id="eye"></i>
                </div>
            </div>
						<label>
		          <input type="checkbox" name="recordar" checked>
		          <span></span>
		          <small class="recordar">Recuerdame</small>
		        </label>


            <button class="iniciar-sesion"type="submit">Iniciar Sesi&oacute;n</button>

            <div class="contenido-form" >
                <a href="registro.php"><button type="button" class="btn-cancelar">Registrarse</button></a>
                <span class="psw">¿Olvidaste tu<a href="olvido_pass.php"> contraseña</a>?</span>
            </div>
            <?php echo resultBlock($errors); ?>
        </form>

    </div>
      <button href="#" class="btn btn-secondary btn-circle btn-md" data-toggle="modal" data-target="#faqloginModal"><i class="fas fa-question-circle"></i></button>

	</div>


	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript" src="../javascript/scripts.js"></script>
	<script type="text/javascript" src="../javascript/bootstrap.min.js"></script>
	<script type="text/javascript" src="../javascript/particles.min.js"></script>
	<script type="text/javascript" src="../javascript/app.js"></script>

  <?php include_once '../includes/modals.php'; ?>
</body>
</html>
