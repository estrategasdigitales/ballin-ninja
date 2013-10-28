<?
session_start();
	
$_SESSION['loggedin_username'] = NULL;
$_SESSION['loggedin_id_user'] = NULL;
$_SESSION['loggedin_id_access'] = NULL;
unset($_SESSION['loggedin_username']);
unset($_SESSION['loggedin_id_user']);
unset($_SESSION['loggedin_id_access']);
session_destroy();
header ("Expires: Thu, 27 Mar 1980 23:59:00 GMT"); //la pagina expira en una fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache"); 
header('Location: index.php');
?>