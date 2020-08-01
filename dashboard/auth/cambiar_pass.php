
<?php

  require '../secretInfo/conexion_BD.php';
  require '../secretInfo/funciones.php';

	if(empty($_GET['user_id'])){
		header('Location: index.php');
	}

	if(empty($_GET['token'])){
		header('Location: login.php');
	}

	$user_id = $mysqli->real_escape_string($_GET['user_id']);
	$token = $mysqli->real_escape_string($_GET['token']);

	if(!verificaTokenPass($user_id, $token))
	{
echo 'No se pudo verificar los Datos';
exit;
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
    <title>Cambiar contraseña | QuizMath</title>
		<link rel="stylesheet" href="../css/all.css">
	  <link rel="stylesheet" href="../css/bootstrap.css">
	  <link rel="stylesheet" href="../css/login.css">
	  <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
		<link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css'>
    <link rel="shortcut icon" href="../assets/img/quizgram.svg" type="image/x-icon">
		<link rel="icon" href="../assets/img/quizgram.svg" type="image/x-icon">
</head>
<body id="particles-js">
	<div class="animated bounceInDown">
    <div class="login-contenido">

      <?php if (isset($_GET['error'])): ?>
      <div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">
        <strong>¡Vaya!</strong> Parece que ha habido un error mientras guardábamos tus cambios comunicate a soporte QuizGram. Inténtalo de nuevo.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php endif; ?>

      <?php if (isset($_GET['errorCoinciden'])): ?>
      <div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">
        <strong>¡Vaya!</strong> No coinciden las contraseñas intenta de nuevo.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php endif; ?>

      <?php if (isset($_GET['errorFormVacio'])): ?>
      <div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">
        <strong>¡Vaya!</strong> Dejaste vacio los campos del formulario.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php endif; ?>

        <form id="loginform" class="form-horizontal" role="form" action="guardapass.php" method="POST" autocomplete="off">
            <div class="img-login">
                <h1>¡Cambia tu contraseña!</h1>
            </div>

            <input type="hidden" id="user_id" name="user_id" value ="<?php echo $user_id; ?>" />

						<input type="hidden" id="token" name="token" value ="<?php echo $token; ?>" />

            <div class="contenido-form">
                <div class="contrasena">
                    <i class="fas fa-key"></i><input type="password" placeholder="Contraseña" name="password" required>
                </div>
                <div class="contrasena">
                    <i class="fas fa-key"></i><input type="password" placeholder="Contraseña" name="r_password" required>
                </div>
            </div>


            <button class="iniciar-sesion"type="submit">Modificar</button>

            <div class="contenido-form" >

            </div>

        </form>
    </div>
	</div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script type="text/javascript" src="../javascript/scripts.js"></script>
  <script type="text/javascript" src="../javascript/bootstrap.min.js"></script>
  <script type="text/javascript" src="../javascript/particles.min.js"></script>
  <script type="text/javascript" src="../javascript/app.js"></script>
</body>
</html>
