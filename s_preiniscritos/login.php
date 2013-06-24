<?php require_once('Connections/des_preinscritos.php'); ?>
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
?>
<?php


if ((isset($_POST["MM_verify"])) && ($_POST["MM_verify"] == "verify_form")) {
	
	$colname_encargado = "-1";
	if (isset($_POST['username'])) {
	  $colname_encargado = $_POST['username'];
	}
	mysql_select_db($database_des_preinscritos, $des_preinscritos);
	$query_encargado = "SELECT * FROM ss_users WHERE username = '".$_POST['username']."'";
	$encargado = mysql_query($query_encargado, $des_preinscritos) or die(mysql_error());
	$row_encargado = mysql_fetch_assoc($encargado);
	$totalRows_encargado = mysql_num_rows($encargado);
	
	if($totalRows_encargado > 0){
		
		$user_temp = $row_encargado['id_user'];
		
		mysql_select_db($database_des_preinscritos, $des_preinscritos);
		$query_discipline = sprintf("SELECT * FROM ss_users_disciplines WHERE id_user = $user_temp");
		$discipline = mysql_query($query_discipline, $des_preinscritos) or die(mysql_error());
		$row_discipline = mysql_fetch_assoc($discipline);
		$totalRows_discipline = mysql_num_rows($discipline);
		
		if($row_encargado['password'] == $_POST['password']){
		
		  session_start();
		  $_SESSION['loggedin_username'] = $_POST['username'];
		  $_SESSION['loggedin_id_user'] = $row_encargado['id_user'];
		  $_SESSION['loggedin_id_access'] = $row_encargado['id_access'];
		  $_SESSION['loggedin_id_discipline'] = $row_discipline['id_discipline'];
		
		  switch($row_encargado['id_access']){
		  	case 1:	
				//echo "PERMISO";
				$goto = "preinscritos.php";
				break;
		  	case 2:	
				//echo "NO PERMISO";
				$goto = "preinscritos.php";
				break;
			case 3:
				$goto = "preinscritos.php";
				break;
			case 4:
				$goto = "decse.php";
				//echo "SOY 4";
				break;
			case 6:
				$goto = "preinscritos_lofft.php";
				//echo "SOY 4";
				break;
			  }

	  header(sprintf("Location: %s", $goto));
		  
		} else{
			$invalidUser = true;
			$goto = "index.php?invalidUser=true";
			header(sprintf("Location: %s", $goto));
		}
		
	} else {
		//echo "ADIOS2";
		$invalidUser = true;
		$goto = "index.php?invalidUser=true";
		header(sprintf("Location: %s", $goto));
	}
}
?>