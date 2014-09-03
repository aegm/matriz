<?php
	session_start();
	require_once("lib/clases/usuario.class.php");
	$usuario = new usuario;
	$usuario->cerrar_session();
	header("Location: index.php");
?>