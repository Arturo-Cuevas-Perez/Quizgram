<?php

	// 	Validaciones de formularios
	function isNull($nombre, $user, $pass, $pass_con, $email)
	{
		if(strlen(trim($nombre)) < 1 || strlen(trim($user)) < 1 || strlen(trim($pass)) < 1 || strlen(trim($pass_con)) < 1 || strlen(trim($email)) < 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function isNullPass($pass, $pass_con)
	{
		if(strlen(strlen(trim($pass)) < 1 || strlen(trim($pass_con)) < 1))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function isEmail($email)
	{
		if (filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function validaPassword($var1, $var2)
	{
		if (strcmp($var1, $var2) !== 0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	function minMax($min, $max, $valor)
	{
		if(strlen(trim($valor)) < $min)
		{
			return true;
		}
		else if(strlen(trim($valor)) > $max)
		{
			return true;
		}
		else
		{
			return false;
		}
	}


	function usuarioExiste($usuario)
	{
		global $mysqli;

		$stmt = $mysqli->prepare("SELECT id FROM usuarios WHERE user = ? LIMIT 1");
		$stmt->bind_param("s", $nombre);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		$stmt->close();

		if ($num > 0)
		{
			return true;
		}
			else
		{
			return false;
		}
	}

	function emailExiste($email)
	{
		global $mysqli;

		$stmt = $mysqli->prepare("SELECT id FROM usuarios WHERE email = ? LIMIT 1");
		$stmt->bind_param("s", $email);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		$stmt->close();

		if ($num > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	// generar token
	function generateToken()
	{
		$gen = md5(uniqid(mt_rand(), false));
		return $gen;
	}

// Hashear contraseña
	function hashPassword($password)
	{
		$hash = password_hash($password, PASSWORD_DEFAULT);
		return $hash;
	}

	// Mostrar errores
	function resultBlock($errors)
	{
		if(count($errors) > 0)
		{
			echo "<div class='alert alert-danger alert-dismissible fade show mt-5' role='alert'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
					<span aria-hidden='true'>&times;</span>
					</button>
					<ul>";

			foreach($errors as $error)
			{
				echo "<strong>".$error."</strong>";
			}
			echo "</ul>";
			echo "</div>";
		}
	}

	// Registrar usuarios
	function registraUsuario($nombre, $pass_hash, $apellido, $email, $activo, $token, $tipo_usuario)
	{

		global $mysqli;

		$stmt = $mysqli->prepare("INSERT INTO usuarios (user, password, last_name, email, activacion, token, id_tipo) VALUES(?,?,?,?,?,?,?)");
		$stmt->bind_param('ssssisi', $nombre, $pass_hash, $apellido, $email, $activo, $token, $tipo_usuario);

		if ($stmt->execute())
		{
			return $mysqli->insert_id;
		}
		else
		{
			return 0;
		}
	}

	// Enviar email activacion
	function enviarEmail($email, $nombre, $asunto, $cuerpo){

		require_once '../PHPMailer/src/PHPMailer.php';
		require_once '../PHPMailer/src/SMTP.php';


		$mail = new \PHPMailer\PHPMailer\PHPMailer();
		$mail->isSMTP();
		//$mail->isMail();
		$mail->SMTPDebug = 1;
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'tls';
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = '587';

		$mail->Username = 'project.quizgram@gmail.com';
		$mail->Password = '@Quizgram1719';

		$mail->setFrom('project.quizgram@gmail.com', 'QuizGram');
		$mail->addAddress($email, $nombre);

		$mail->Subject = $asunto;
		$mail->Body    = $cuerpo;
		$mail->IsHTML(true);

		if($mail->send())
		return true;
		else
		return false;
	}


	function validaIdToken($id, $token){
		global $mysqli;

		$stmt = $mysqli->prepare("SELECT activacion FROM usuarios WHERE id = ? AND token = ? LIMIT 1");
		$stmt->bind_param("is", $id, $token);
		$stmt->execute();
		$stmt->store_result();
		$rows = $stmt->num_rows;

		if($rows > 0)
		{
			$stmt->bind_result($activacion);
			$stmt->fetch();

			if($activacion == 1)
			{
				$msg = "La cuenta ya se activo anteriormente.";
			}
			else
			{
				if(activarUsuario($id))
				{
					$msg = 'Cuenta activada.';
				}
					else
					{
						$msg = 'Error al Activar Cuenta';
					}
			}
		}
		else
		{
			$msg = 'No existe el registro para activar.';
		}
		return $msg;
	}

	function activarUsuario($id)
	{
		global $mysqli;

		$stmt = $mysqli->prepare("UPDATE usuarios SET activacion=1 WHERE id = ?");
		$stmt->bind_param('s', $id);
		$result = $stmt->execute();
		$stmt->close();
		return $result;
	}

//Login
	function isNullLogin($email, $password)
	{
		if(strlen(trim($email)) < 1 || strlen(trim($password)) < 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function login($email, $password)
	{
		global $mysqli;

		$stmt = $mysqli->prepare("SELECT id, id_tipo, password FROM usuarios WHERE user = ? || email = ? LIMIT 1");
		$stmt->bind_param("ss", $email, $email);
		$stmt->execute();
		$stmt->store_result();
		$rows = $stmt->num_rows;

		if($rows > 0)
		{
			if(isActivo($email))
			{

				$stmt->bind_result($id, $id_tipo, $passwd);
				$stmt->fetch();

				$validaPassw = password_verify($password, $passwd);

				if($validaPassw)
				{

						lastSession($id);
						$_SESSION['id_usuario'] = $id;
						$_SESSION['tipo_usuario'] = $id_tipo;

						header("location: ../index.php");
				}
					else
					{

						$errors = "La contrase&ntilde;a es incorrecta";
					}
				}
					else
					{
						$errors = 'El usuario no esta activo';
					}
		}
		else
		{
			$errors = "El correo electr&oacute;nico no existe";
		}
		return $errors;
	}

	// Ultima session
	function lastSession($id)
	{
		global $mysqli;

		$stmt = $mysqli->prepare("UPDATE usuarios SET last_session=NOW(), token_password='', password_request=1 WHERE id = ?");
		$stmt->bind_param('s', $id);
		$stmt->execute();
		$stmt->close();
	}
	// Mostrar hace tiempo del post
	function time_ago($timestamp)
	{

	  date_default_timezone_set("America/Mexico_City");
	  $time_ago        = strtotime($timestamp);
	  $current_time    = time();
	  $time_difference = $current_time - $time_ago;
	  $seconds         = $time_difference;

	  $minutes = round($seconds / 60); // value 60 is seconds
	  $hours   = round($seconds / 3600); //value 3600 is 60 minutes * 60 sec
	  $days    = round($seconds / 86400); //86400 = 24 * 60 * 60;
	  $weeks   = round($seconds / 604800); // 7*24*60*60;
	  $months  = round($seconds / 2629440); //((365+365+365+365+366)/5/12)*24*60*60
	  $years   = round($seconds / 31553280); //(365+365+365+365+366)/5 * 24 * 60 * 60

	  if ($seconds <= 60){

	    return "Justo ahora";

	  } else if ($minutes <= 60){

	    if ($minutes == 1){

	      return "Hace un minuto";

	    } else {

	      return "Hace $minutes minutos";

	    }

	  } else if ($hours <= 24){

	    if ($hours == 1){

	      return "Hace una hora";

	    } else {

	      return "Hace $hours horas";

	    }

	  } else if ($days <= 7){

	    if ($days == 1){

	      return "Ayer";

	    } else {

	      return "Hace $days dias";

	    }

	  } else if ($weeks <= 4.3){

	    if ($weeks == 1){

	      return "Hace una semana";

	    } else {

	      return "Hace $weeks semanas";

	    }

	  } else if ($months <= 12){

	    if ($months == 1){

	      return "Hace un mes";

	    } else {

	      return "Hace $months meses";

	    }

	  } else {

	    if ($years == 1){

	      return "Hace un año";

	    } else {

	      return "Hace $years años";

	    }
	  }
	}

	// Verificar si esta activo
	function isActivo($email)
	{
		global $mysqli;

		$stmt = $mysqli->prepare("SELECT activacion FROM usuarios WHERE user = ? || email = ? LIMIT 1");
		$stmt->bind_param('ss', $email, $email);
		$stmt->execute();
		$stmt->bind_result($activacion);
		$stmt->fetch();

		if ($activacion == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	//////////////////////////////////////////

	function generaTokenPass($user_id)
	{
		global $mysqli;

		$token = generateToken();

		$stmt = $mysqli->prepare("UPDATE usuarios SET token_password=?, password_request=1 WHERE id = ?");
		$stmt->bind_param('ss', $token, $user_id);
		$stmt->execute();
		$stmt->close();

		return $token;
	}

	function getValor($campo, $campoWhere, $valor)
	{
		global $mysqli;

		$stmt = $mysqli->prepare("SELECT $campo FROM usuarios WHERE $campoWhere = ? LIMIT 1");
		$stmt->bind_param('s', $valor);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;

		if ($num > 0)
		{
			$stmt->bind_result($_campo);
			$stmt->fetch();
			return $_campo;
		}
		else
		{
			return null;
		}
	}

	function getPasswordRequest($id)
	{
		global $mysqli;

		$stmt = $mysqli->prepare("SELECT password_request FROM usuarios WHERE id = ?");
		$stmt->bind_param('i', $id);
		$stmt->execute();
		$stmt->bind_result($_id);
		$stmt->fetch();

		if ($_id == 1)
		{
			return true;
		}
		else
		{
			return null;
		}
	}

	function verificaTokenPass($user_id, $token)
	{

		global $mysqli;

		$stmt = $mysqli->prepare("SELECT activacion FROM usuarios WHERE id = ? AND token_password = ? AND password_request = 1 LIMIT 1");
		$stmt->bind_param('is', $user_id, $token);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;

		if ($num > 0)
		{
			$stmt->bind_result($activacion);
			$stmt->fetch();
			if($activacion == 1)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}

	function cambiaPassword($password, $user_id, $token)
	{

		global $mysqli;

		$stmt = $mysqli->prepare("UPDATE usuarios SET password = ?, token_password='', password_request=0 WHERE id = ? AND token_password = ?");
		$stmt->bind_param('sis', $password, $user_id, $token);

		if($stmt->execute())
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function cambiaPasswordPerfil($password){

		global $mysqli;

		$stmt = $mysqli->prepare("UPDATE usuarios SET password = ? WHERE id = '".$_SESSION['id_usuario']."'");
		$stmt->bind_param('s', $password);

		if($stmt->execute())
		{
			return true;
			}
			else
			{
			return false;
		}
	}


	function normalizar ($cadena)
  {
    $cadena = str_replace(
    array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
    array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
    $cadena
    );

    //Reemplazamos la E y e
    $cadena = str_replace(
    array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
    array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
    $cadena );

    //Reemplazamos la I y i
    $cadena = str_replace(
    array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
    array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
    $cadena );

    //Reemplazamos la O y o
    $cadena = str_replace(
    array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
    array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
    $cadena );

    //Reemplazamos la U y u
    $cadena = str_replace(
    array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
    array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
    $cadena );

    //Reemplazamos la N, n, C y c
    $cadena = str_replace(
    array('Ñ', 'ñ', 'Ç', 'ç'),
    array('N', 'n', 'C', 'c'),
    $cadena );

    return $cadena;
  }

	function formatBytes($size, $precision = 2)
	{
	    $base = log($size, 1024);
	    $suffixes = array('', 'K', 'M', 'G', 'T');

	    return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
	}
