<?php require_once('../Connections/otono2011.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	
	
//para cargar fotos ***********************************************
  include('SimpleImage.php');
  //PICTURE
  $IMAGE_FILE = $_FILES['imagen']['tmp_name'];
  $IMAGE_FILE_NAME = $_FILES['imagen']['name'];
  
  if($IMAGE_FILE != NULL)
  {
  	$photosDir="../imagenes/banners";
	$img_filename = str_replace(" ","_",$IMAGE_FILE_NAME);
	$photo = new SimpleImage();
	$photo->load($IMAGE_FILE);
  	$photo->save($photosDir."/".$img_filename);
  }
  
  //para cargar fotos *********************************** 
		
  $insertSQL = sprintf("INSERT INTO banners_lat (id_banner, img_banner, destino) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['id_banner'], "int"),
                       GetSQLValueString($img_filename, "text"),
                       GetSQLValueString($_POST['destino'], "text"));

  mysql_select_db($database_otono2011, $otono2011);
  $Result1 = mysql_query($insertSQL, $otono2011) or die(mysql_error());

  $insertGoTo = "admin_banners_lat.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
<title>Documento sin título</title>
</head>

<body>

<form action="<?php echo $editFormAction; ?>" onsubmit="return checkFields();" method="post" name="form1" id="form1" enctype="multipart/form-data">
<table border="0" align="center" cellpadding="5" cellspacing="0">
       <tr>
            <td colspan="3" align="center" class="titulo_interno"><strong>Nuevo Banner</strong></td>
       </tr>
       <tr>
      		 <td>* Imagen:</td>
             <td><input type="file" name="imagen" id="imagen" /></td>
       </tr>
       <tr>
       		<td>* Destino:</td>
            <td><input type="text" name="destino" size="60" placeholder="Ej: http://www.diplomados.uia.mx/programas.php?id_discipline=4&id_program=392"/></td>
       </tr>
       <tr>
       		<td colspan="3">&nbsp;</td>
       </tr>
       <tr>	<td></td>
       		<td><input type="button" value="Cancelar" onclick="javascript:window.location='admin_banners_lat.php'" /></td>
       		<td><input type="submit" value="Insertar" /></td>
       </tr>
    </table>
  <input type="hidden" name="id_banner" value="" />
  <input type="hidden" name="MM_insert" value="form1" />
</form>

<script>
function checkFields(){

	
if($('input#imagen').val() == ""){
	alert('El campo imagen es obligatorio')
	return false
	}
else if($('input[name="destino"]').val() == ""){
	alert('El campo destino es obligatorio')
	return false
	}
	return true
}
</script>
</body>
</html>