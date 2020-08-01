
<?php
  require '../secretInfo/conexion_BD.php';
  require '../secretInfo/funciones.php';

	if(isset($_GET["id"]) AND isset($_GET['val']))
	{
		$idUsuario = $_GET['id'];
		$token = $_GET['val'];

		$mensaje = validaIdToken($idUsuario, $token);
	}
?>
<html>
	<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Arturo Cuevas">
    <meta name="description" content="Plataforma Educativa">
    <meta name="keywords" content="educacion, plataforma, web">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Activacion | QuizGram</title>
    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css'>
    <link rel="shortcut icon" href="../assets/img/quizgram.svg" type="image/x-icon">
		<link rel="icon" href="../assets/img/quizgram.svg" type="image/x-icon">

	</head>

	<body>
    <div class="animated bounceInDown">
      <div class="login-contenido">
        <div class="container">
          <div class="jumbotron" style="margin-top: 20rem; padding-top: 2rem; padding-bottom: 1.5rem;">

            <h1 class="text-center"><?php echo $mensaje; ?></h1>
            <br>
            <div class="col text-center">
              <p><a class="btn btn-primary btn-lg" href="login.php" role="button">Iniciar Sesi&oacute;n</a></p>
            </div>


          </div>

        </div>

      </div>
  	</div>

    <script type="text/javascript" src="../javascript/bootstrap.min.js"></script>
	</body>
</html>
