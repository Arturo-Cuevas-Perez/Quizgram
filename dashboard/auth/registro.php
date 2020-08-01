

<!--Evitar SQL INYECTION-->
<?php
  require '../secretInfo/conexion_BD.php';
  require '../secretInfo/funciones.php';

  $errors = array();

  if(!empty ($_POST))
  {
    $nombre = $mysqli->real_escape_string($_POST['nombre']);
    $apellido = $mysqli->real_escape_string($_POST['apellido']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $password = $mysqli->real_escape_string($_POST['password']);
    $r_password = $mysqli->real_escape_string($_POST['r_password']);

    $activo = 0;
    $tipo_usuario = $_POST['rol'];


    if(isNull($nombre, $apellido, $email, $password, $r_password))
		{
			$errors[] = "Debe llenar todos los campos";
		}

		if(!isEmail($email))
		{
			$errors[] = "Dirección de correo inválida";
		}

		if(!validaPassword($password, $r_password))
		{
			$errors[] = "Las contraseñas no coinciden";
		}

		if(usuarioExiste($nombre))
		{
			$errors[] = "El nombre de usuario $nombre ya existe";
		}

		if(emailExiste($email))
		{
			$errors[] = "El email $email ya existe";
		}

    if(count($errors) == 0)
    {
      $pass_hash = hashPassword($password);
      $token = generateToken();

      $registro = registraUsuario($nombre, $pass_hash, $apellido, $email, $activo, $token, $tipo_usuario);
      if($registro > 0)
      {
					$url = 'http://'.$_SERVER["SERVER_NAME"].'/dashboard/auth/activar.php?id='.$registro.'&val='.$token;

					$asunto = 'Activar Cuenta - QuizGram';
					$cuerpo = "Hola $nombre $apellido <br/><br/> Gracias por registrarte a QuizGram. Para finalizar el proceso de registro, es necesario dar click en el siguiente enlace: <a href='$url'>Activar Cuenta</a>";

					if(enviarEmail($email, $nombre, $asunto, $cuerpo))
          {
            header('Location: /quizgram/dashboard/auth/login.php?registro_ok'); // borrar quizgram en goddady
						exit;
					}
          else
          {
						$erros[] = "Error al enviar Email";
					}

			}
      else
      {
					$errors[] = "Error al Registrar";
			}

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
    <title>Registro | Quizgram</title>
    <link rel="stylesheet" href="../css/all.css">
	  <link rel="stylesheet" href="../css/bootstrap.css">
	  <link rel="stylesheet" href="../css/registro.css">
	  <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
		<link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css'>
    <link rel="shortcut icon" href="../assets/img/quizgram.svg" type="image/x-icon">
    <link rel="icon" href="../assets/img/quizgram.svg" type="image/x-icon">

		<style type="text/css">
        .mt-5, .my-5
        {
          margin-top: .5rem !important;
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
            top: 630px;
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
        <form action="" method="post">
            <div class="img-login">
                <h1>¡Crea tu Cuenta!</h1>
            </div>

            <div class="contenido-form">
                <div class="nombre-apellido">
                    <input type="text" placeholder="Nombre" name="nombre" required>
                    <input type="text" placeholder="Apellidos" name="apellido" required>
                </div>

                <div class="email">
                    <input type="email" placeholder="Correo Electrónico" name="email" required>
                </div>

                <div class="contrasena">
                    <input type="password" placeholder="Contraseña" name="password" required>
                    <input type="password" placeholder="Repite tu Contraseña" name="r_password" required>
                </div>

                <div class="form-group">
                  <div class="btn-group btn-group-toggle" style="width:100%;" data-toggle="buttons">
                    <label class="btn btn-info btn-lg active" style="font-size:0.8em; padding-top:0.9em; padding-bottom: 0.9em; border-top-left-radius:5rem; border-bottom-left-radius:5rem; border:none;">
                      <input type="radio" name="rol" value="2" autocomplete="off" checked> Soy alumno
                    </label>
                    <label class="btn btn-info btn-lg" style="font-size:0.8em; padding-top:0.9em; padding-bottom: 0.9em; border-top-right-radius:5rem; border-bottom-right-radius:5rem; border:none;">
                      <input type="radio" name="rol" value="1" autocomplete="off"> Soy profesor
                    </label>
                  </div>
                </div>

                <button class="iniciar-sesion" type="submit" name="submit" value="Registrarse">Registrarse</button>
            </div>

            <div class="contenido-form" >
                <a href="login.php"><button type="button" class="btn-cancelar">Cancelar</button></a>
                <span class="psw">¿Tienes una cuenta?<a href="login.php"> Inicia Sesión</a></span>
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
