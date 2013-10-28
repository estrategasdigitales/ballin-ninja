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
//Para llenar lista de artículos semanales
	mysql_select_db($database_otono2011, $otono2011);
	$query_weekly = "SELECT * FROM weekly_articles ORDER BY date DESC";
	$weekly = mysql_query($query_weekly, $otono2011) or die(mysql_error());

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
<script type="text/javascript"> 
<!-- 
function change(frm)
{
	window.location="admin_discipline_articles.php?id_discipline=" + frm["id_discipline"].value;
}
// -->
</script>
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
    <a href="index.php"><img width="20px" height="20px" src="imagenes/home.png" style="float:left; clear:both; margin-left: 206px; margin-top:-13px;"></img></a>
    <div class="bannersuperior2" style="margin-left: 4px; width: 790px;"></div>
  </div>
  <div id="separador"></div>
  <div id="separador"></div>
<!-- LLamada a menú de secciones-->
<?php include('menu_secciones.php'); ?>
<!-- Termina llamada a menú de secciones-->
  <div id="contenedor_irregular_index" style="width:800px;"><!-- InstanceBeginEditable name="contenido" -->
            <h1>Artículos semanales
            </h1>
            <form name="form_weekly" id="form_weekly" method="get">
              <table width="800"  border="0" align="left" cellpadding="5" cellspacing="0" class="tablas">
      <tr class="titulo_tabla">
            <td width="79%" align="center">Título</td>
            <td colspan="2" align="center"><input name="agrega" type="button" value="Agregar Nuevo" title="Agregar Nuevo" onclick="window.location='insert_weekly.php'"/></td>
            </tr>
  		<?php while($row_weekly= mysql_fetch_assoc($weekly)){ ?>
  		<tr>
   			<td><?php echo $row_weekly['title'];?></td>
   			<td width="8%" align="center"><input name="edita" type="button" value="Editar"  onclick="window.location='update_weekly.php?id_article=<?php echo $row_weekly['id_article'];?>'"/></td>
    		<td width="13%" align="center">&nbsp;
            <input name="elimina" type="button" value="Eliminar"   onclick="window.location='delete_weekly.php?id_article=<?php echo $row_weekly['id_article'];?>'"/></td>
  		</tr>
  		<?php }?>
		</table>
        </form>
        <!-- InstanceEndEditable --></div>
  <div id="separador" style=" clear:both; height:20px;"></div>
  
</div>
</body>
<!-- InstanceEnd --></html>
