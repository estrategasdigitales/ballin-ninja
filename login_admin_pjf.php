<?php require_once('Connections/otono2011.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

if(isset($_POST['form']) && !empty($_POST['form']) && !empty($_POST['usuario']) && !empty($_POST['password'])){

$usuario = $_POST['usuario'];
$password = $_POST['password'];

mysql_select_db($database_otono2011, $otono2011);
$query_login = "SELECT * FROM sp_preinscritos_pjf_user WHERE user = '$usuario' AND password = '$password'";
$login = mysql_query($query_login, $otono2011) or die(mysql_error());
$row_login = mysql_fetch_assoc($login);
$totalRows_login = mysql_num_rows($login);

if($totalRows_login == 1){
	
	session_start();
	$_SESSION['usuario'] = $usuario;
	header('Location: admin_pjf.php');	
	}
elseif($totalRows_login != 1){
	header('Location: login_admin_pjf.php');	
	}
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<link rel="stylesheet" href="css/estilos.css" type="text/css" />
</head>

<body>
<form action="login_admin_pjf.php" method="post">
<table width="0" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td>Usuario:</td>
    <td><input type="text" name="usuario" /></td>
  </tr>
  <tr>
    <td>Contraseña:</td>
    <td><input type="password" name="password" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" value="Entrar" />
    <input type="hidden" name="form" value="form" /></td>
  </tr>
</table>
</form>

</body>
</html>
<?php
mysql_free_result($login);
?>
