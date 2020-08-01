

<?php

  session_start();

  include('../secretInfo/conexion_BD.php');
  include('../secretInfo/funciones.php');


	$password = $mysqli->real_escape_string($_POST['password']);
	$r_password = $mysqli->real_escape_string($_POST['r_password']);

  if(isNullPass($password, $r_password))
	{
    header('Location: ../perfil.php?errorFormVacio');
  }
  else
  {
  	if(validaPassword($password, $r_password))
  	{
  		$pass_hash = hashPassword($password);

  		if(cambiaPasswordPerfil($pass_hash))
  		{
  			header('Location: ../perfil.php?cambios_ok');
  		}
      else
      {
  			header('Location: ../perfil.php?error');
  		}

  	}
    else
    {
      header('Location: ../perfil.php?errorCoinciden');
  	}
  }


?>
