<?php

	$mysqli = new mysqli("localhost:3308","root","","pmodular"); //servidor, usuario de base de datos, contraseña del usuario, nombre de base de datos
	$mysqli->set_charset("utf8");

	if(mysqli_connect_errno())
	{
		echo 'Conexion Fallida: ', mysqli_connect_error();
		exit();
	}

?>
