
<?php

  session_start();

  include('../secretInfo/conexion_BD.php');
  include('../secretInfo/funciones.php');

	$user_id = $mysqli->real_escape_string($_POST['user_id']);
	$token = $mysqli->real_escape_string($_POST['token']);
	$password = $mysqli->real_escape_string($_POST['password']);
	$r_password = $mysqli->real_escape_string($_POST['r_password']);

  if(isNullPass($password, $r_password))
	{
    header('Location: ./cambiar_pass.php?user_id='.$user_id.'&token='.$token);
  }

  else
  {

  	if(validaPassword($password, $r_password))
  	{

  		$pass_hash = hashPassword($password);

  		if(cambiaPassword($pass_hash, $user_id, $token))
  		{
  			header('Location: ./login.php?restablecido_ok');
  		}
  		else
  		{
  			header('Location: ./cambiar_pass.php?user_id='.$user_id.'&token='.$token);
  		}
  	}
  	else
  	{
  		header('Location: ./cambiar_pass.php?user_id='.$user_id.'&token='.$token);
  	}
  }
?>
