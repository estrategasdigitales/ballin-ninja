<?php require_once('restrict_access.php'); ?>
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

function delete_directory($dirname) {
   if (is_dir($dirname))
      $dir_handle = opendir($dirname);
   if (!$dir_handle)
      return false;
   while($file = readdir($dir_handle)) {
      if ($file != "." && $file != "..") {
         if (!is_dir($dirname."/".$file))
            unlink($dirname."/".$file);
         else
            delete_directory($dirname.'/'.$file);    
      }
   }
   closedir($dir_handle);
   rmdir($dirname);
   return true;
}

if ((isset($_POST['id_preinscrito'])) && ($_POST['id_preinscrito'] != "")) {
	
	$directory = "uploads/documentos/preinscrito_".$_POST['id_preinscrito']."/";
	
	if(file_exists($directory)){
		delete_directory($directory);
	}
	
	$deleteSQL1 = "DELETE FROM sp_preinscritos WHERE id_preinscrito=".$_POST['id_preinscrito'];
	
	$deleteSQL2 = "DELETE FROM sp_pasos_status WHERE id_preinscrito=".$_POST['id_preinscrito'];
	
	$deleteSQL3 = "DELETE FROM sp_documentos WHERE id_preinscrito=".$_POST['id_preinscrito'];
	
	$deleteSQL4 = "DELETE FROM sp_comentarios WHERE id_preinscrito=".$_POST['id_preinscrito'];
	
	mysql_select_db($database_des_preinscritos, $des_preinscritos);
	$Result1 = mysql_query($deleteSQL1, $des_preinscritos) or die(mysql_error());
	$Result2 = mysql_query($deleteSQL2, $des_preinscritos) or die(mysql_error());
	$Result3 = mysql_query($deleteSQL3, $des_preinscritos) or die(mysql_error());
	$Result4 = mysql_query($deleteSQL4, $des_preinscritos) or die(mysql_error());
	
	header("Location: http://www.dec-uia.com".$_POST['url']);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>