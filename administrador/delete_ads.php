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
if((isset($_GET['id_ad']) && ($_GET['id_ad']) != ""))
{
	//Para poner elemento a eliminar
	mysql_select_db($database_otono2011, $otono2011);;
	$query_ads =  sprintf("SELECT * FROM ads WHERE id_ad=%s", GetSQLValueString($_GET['id_ad'], "int"));
	$ads = mysql_query($query_ads, $otono2011) or die(mysql_error());
	$row_ads= mysql_fetch_assoc($ads);
	
	if((isset($_POST['delete']) && ($_POST['delete']) == "Eliminar"))
	{
	 //Para borrar de la base
	  $deleteSQL = sprintf("DELETE FROM ads WHERE id_ad=%s", GetSQLValueString($_GET['id_ad'], "int"));
	  mysql_select_db($database_otono2011, $otono2011);
	  $Result1 = mysql_query($deleteSQL, $otono2011) or die(mysql_error());
	 
	 $deleteGoTo = "admin_ads.php";
	 if (isset($_SERVER['QUERY_STRING'])) {
		$deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
		$deleteGoTo .= $_SERVER['QUERY_STRING'];
	  }
  	 header(sprintf("Location: %s", $deleteGoTo));
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/temp_admin.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO 8859-1"
        />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Educación Continua / Administrador</title>
<!-- InstanceEndEditable -->
<link href="../css/estilos.css" rel="stylesheet"
        type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>
<div id="container">
  <div id="header">
    <div id="logos">
      <h1><a href="http://uia.mx/" target="_blank"><img src="../imagenes/logo_UIA.jpg" alt="logo" width="100" height="78" border="0" class="logo"/></a><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/index.php'"><img src="../imagenes/logo_DEC.jpg" alt="DEC" width="90" height="78" border="0" /></a></h1>
    </div>
    <h1 style="float:left; margin:15px; color:#666;"> Administrador de Contenidos</h1>
  </div>
  <div id="separador"></div>
  <div id="separador"></div>
  <div id="menu_generos_interior_index">
    <div class="roundedBox_interior_index" id="type1"> 
      <!-- esquinas -->
      <div class="corner topLeft"></div>
      <div class="corner topRight"></div>
      <div class="corner bottomLeft"></div>
      <div class="corner bottomRight"></div>
      <!-- esquinas -->
      <div id="menu_desplega_index">
        <div id="menu_areas">
          <h2>Programas</h2>
          <ul>
            <li><a href="programas_home.php">Programas</a> </li>
            <li><a href="fechas_home.php">Fechas</a> </li>
            <li><a href="fechas_idiom_home.php">Fechas Idiomas</a> </li>
          </ul>
          <p>&nbsp;</p>
          <h2>Artículos</h2>
          <ul>
            <li><a href="admin_discipline_articles.php?id_discipline=1">Disciplinas</a> </li>
            <li><a href="admin_media_articles.php">La DEC en los Medios</a> </li>
            <li><a href="admin_opinions.php">La Comunidad Ibero Opina</a> </li>
            <li><a href="admin_weekly_articles.php">Artículos semanales</a> </li>
          </ul>
          <p>&nbsp;</p>
        </div>
      </div>
    </div>
  </div>
  <div id="contenedor_irregular_index" style="width:800px;"><!-- InstanceBeginEditable name="contenido" -->
	<form method="post" name="form1" id="form1" action="delete_ads.php?id_ad=<?php echo $_GET['id_ad'];?>">
        <table border="0" width="100%" align="center">
        <tr>
        	<td width="15%">&nbsp;</td>
        	<td width="36%">&nbsp;</td>
            <td width="34%">&nbsp;</td>
            <td width="15%">&nbsp;</td>
        </tr>
                <tr>
        	<td>&nbsp;</td>
        	<td colspan="2" align="center">¿ Seguro deseas eliminar el aviso: <?php echo $row_ads['content'];?> ?</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
        	<td>&nbsp;</td>
        	<td colspan="2">&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
        	<td>&nbsp;</td>
        	<td colspan="2" align="center">Esta acción será permanente e irreversibles</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
        	<td>&nbsp;</td>
        	<td colspan="2">&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
        	<td>&nbsp;</td>
        	<td align="center"><input type="button" name="cancel" id="cancel" value="Cancelar" onclick="javascript:history.back(1)" /></td>
            <td align="center"><input type="submit" name="delete" id="delete" value="Eliminar" /></td>
            <td>&nbsp;</td>
        </tr>
        </table>
	</form>
        <!-- InstanceEndEditable --></div>
  <div id="separador" style=" clear:both; height:20px;"></div>
  
</div>
</body>
<!-- InstanceEnd --></html>
