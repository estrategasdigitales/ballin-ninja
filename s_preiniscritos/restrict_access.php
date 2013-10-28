<?php
session_start();
if($_SESSION['loggedin_username'] == NULL || empty($_SESSION['loggedin_username'])){
	$_SESSION['loggedin_username'] = NULL;
	$_SESSION['loggedin_id_user'] = NULL;
	$_SESSION['loggedin_id_access'] = NULL;
	unset($_SESSION['loggedin_username']);
	unset($_SESSION['loggedin_id_user']);
	unset($_SESSION['loggedin_id_access']);
	session_destroy();
	header('Location: http://www.dec-uia.com/s_preiniscritos');
}
?>