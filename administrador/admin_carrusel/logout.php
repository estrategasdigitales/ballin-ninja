<?php
session_start();
	
$_SESSION['sesion'] = NULL;
$_SESSION['usuario'] = NULL;
unset($_SESSION['sesion']);
unset($_SESSION['usuario']);
session_destroy();
header('Location: index.php');
?>