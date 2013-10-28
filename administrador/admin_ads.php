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

if(!isset($_SESSION))
{
	session_start();
	
	if(!isset($_SESSION['usuario']))
	{
		$goto ="index.php";
		header(sprintf("Location: %s", $goto));
		exit;
	}
}
//Para llenar lista de avisos
	mysql_select_db($database_otono2011, $otono2011);;
	$query_ads = "SELECT * FROM ads ORDER BY date DESC";
	$ads = mysql_query($query_ads, $otono2011) or die(mysql_error());
	//$row_ads= mysql_fetch_assoc($ads);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/temp_admin.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO 8859-1"
        />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Educación Continua / Administrador</title>
<style type="text/css">
<!--
.titulos {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 16px;
	color:#961616;
	text-decoration: underline;
}
.contenido {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color:#999;
	padding-left:5px;
}
.titulo_tablas{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	color:#333;
	padding-left:5px;
}

-->
</style>
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
        <form name="form_ads" id="form_ads" method="get">
        <table width="100%" border="0">
        <tr>
            <td width="87%" align="center" class="titulos"><strong>Administrador de Avisos</strong></td>
            <td width="13%" align="center">&nbsp;</td>
  		</tr>
        <tr>
            <td width="87%">&nbsp;</td>
            <td width="13%" align="center">&nbsp;</td>
  		</tr>
        </table>
        <table width="79%" height="109" border="1" align="center">
        <tr>
            <td width="88%" align="center" class="titulo_tablas">Título</td>
            <td width="12%" align="center" class="titulo_tablas">Acciones</td>
  		</tr>
        <tr>
            <td width="88%">&nbsp;</td>
            <td width="12%" align="center"><input name="agrega" type="button" value="&nbsp;" title="Agregar Nuevo" style="background-color:transparent; border:0; background-image:url(imagenes/agregar.gif); background-repeat:no-repeat; width:25px; height:25px; cursor:pointer; outline:none;" onclick="window.location='insert_ads.php'"/></td>
  		</tr>
  		<?php while($row_ads= mysql_fetch_assoc($ads)){ ?>
  		<tr>
   			<td  class="contenido"><?php echo $row_ads['content'];?></td>
    		<td align="center"><input name="edita" type="button" value="&nbsp;" style="background-color:transparent; border:0; background-image:url(imagenes/editar.gif); background-repeat:no-repeat; width:25px; height:24px; cursor:pointer; outline:none" onclick="window.location='update_ads.php?id_ad=<?php echo $row_ads['id_ad'];?>'"/> &nbsp;
            <input name="elimina" type="button" value="&nbsp;" style="background-color:transparent; border:0; background-image:url(imagenes/eliminar.gif); background-repeat:no-repeat; width:20px; height:20px; cursor:pointer; outline:none"  onclick="window.location='delete_ads.php?id_ad=<?php echo $row_ads['id_ad'];?>'"/></td>
  		</tr>
  		<?php }?>
		</table>
        </form>
        <!-- InstanceEndEditable --></div>
  <div id="separador" style=" clear:both; height:20px;"></div>
  
</div>
</body>
<!-- InstanceEnd --></html>
