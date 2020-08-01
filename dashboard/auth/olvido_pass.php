
 <?php

 require '../secretInfo/conexion_BD.php';
 require '../secretInfo/funciones.php';

	session_start();

	if(isset($_SESSION["id_usuario"])){
		header("Location: login.php");
	}

	$errors = array();

	if(!empty($_POST))
	{
		$email = $mysqli->real_escape_string($_POST['email']);

		if(!isEmail($email))
		{
			$errors[] = "Debe ingresar un correo electronico valido";
		}

		if(emailExiste($email))
		{
  			$user_id = getValor('id', 'email', $email);
  			$nombre = getValor('user', 'email', $email);

  			$token = generaTokenPass($user_id);

  			$url = 'http://'.$_SERVER["SERVER_NAME"].'/quizgram/dashboard/auth/cambiar_pass.php?user_id='.$user_id.'&token='.$token;

  			$asunto = 'Restablecer Password - QuizGram';
  			$cuerpo = "Hola $nombre: <br /><br />Se ha solicitado un restablecimiento de contrase&ntilde;a. <br/><br/>Para continuar con el proceso visita la siguiente direcci&oacute;n: <a href='$url'>$url</a>";

  			if(enviarEmail($email, $nombre, $asunto, $cuerpo))
        {
  				header('Location: login.php?restablecer_ok');
  				exit;
  			}
			}
      else
      {
			$errors[] = "La direccion de correo electronico no existe";
		  }
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
    <title>Recuperar Contraseña | QuizGram</title>
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

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="img-login">
                <h1>¡Recupera tu contraseña!</h1>
                <p>Se le enviara un correo con las intrucciones para recuperar su contraseña. No olvides checar en tu correo spam.</p>
            </div>

            <div class="contenido-form">
                <div class="email">
                    <i class="fas fa-user"></i><input id="email" type="email" placeholder="Correo Electrónico" name="email" required>
                </div>
            </div>

            <button class="iniciar-sesion"type="submit">Enviar</button>

            <div class="contenido-form" >
                <a href="login.php"><button type="button" class="btn-cancelar">Cancelar</button></a>
                <span class="psw">¿Necesitas una cuenta<a href="registro.php"> Registrate</a>?</span>
            </div>
            <?php echo resultBlock($errors); ?>
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
