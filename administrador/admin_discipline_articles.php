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
//Para llenar lista de disciplinas en el select
	mysql_select_db($database_otono2011, $otono2011);
	$sel_discipline = "SELECT * FROM disciplines";
	$disc = mysql_query($sel_discipline, $otono2011) or die(mysql_error());
	$row_disc= mysql_fetch_assoc($disc);

//Para llenar lista se articulos/entrevistas en disciplinas
	mysql_select_db($database_otono2011, $otono2011);
	$query_disciplines = sprintf("SELECT * FROM discipline_articles WHERE id_discipline=%s ORDER BY date DESC", GetSQLValueString($_GET['id_discipline'], "int"));
	$disciplines = mysql_query($query_disciplines, $otono2011) or die(mysql_error());
	//$row_ads= mysql_fetch_assoc($ads);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/temp_admin.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO 8859-1"
        />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Educación Continua / Administrador</title>
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
.titulo_tablas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	color:#333;
	padding-left:5px;
}
-->
</style>
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
          <h2>Carrusel Index</h2>
          <ul>
            <li><a href="#">Banners</a></li>
          </ul>
          <p>&nbsp;</p>
          <h2>Art&iacute;culos</h2>
          <ul>
            <li><a href="admin_discipline_articles.php?id_discipline=1">Disciplinas</a> </li>
            <li><a href="admin_opinions.php">La Comunidad Ibero Opina</a> </li>            
            <li><a href="admin_weekly_articles.php">Art&iacute;culos semanales</a> </li>
            <li><a href="admin_media_articles.php">La DEC en los Medios</a> </li>
          </ul>
          <p>&nbsp;</p>
        </div>
      </div>
    </div>
  </div>
  <div id="contenedor_irregular_index" style="width:800px;"><!-- InstanceBeginEditable name="contenido" -->
    <h1>Artículos - Disciplinas </h1>
    <form name="form_disciplines" id="form_disciplines" method="get">
      <table width="79%" border="0" align="left">
        <tr>
          <td width="87%">Selecciona una disciplina:
            <select name="id_discipline" id="id_discipline" onchange="change(this.form);">
              <?php do{?>
              <option value="<?php echo $row_disc['id_discipline'];?>" <?php if($row_disc['id_discipline'] == $_GET['id_discipline']) echo "selected";?>><?php echo $row_disc['discipline'];?></option>
              <?php } while($row_disc = mysql_fetch_assoc($disc));?>
            </select></td>
          <td width="13%" align="center">&nbsp;</td>
        </tr>
      </table>
      <table width="700" border="0" align="left" cellpadding="5" cellspacing="0" class="tablas">
        <tr class="titulo_tabla">
          <td width="544" align="center">Título</td>
          <td colspan="2" align="center"><input name="agrega" type="button" value="Agregar Nuevo" title="Agregar Nuevo"  onclick="window.location='insert_discipline.php'"/></td>
        </tr>
        <?php while($row_disciplines= mysql_fetch_assoc($disciplines)){ ?>
        <tr>
          <td><?php echo $row_disciplines['title'];?></td>
          <td width="56" align="center"><input name="edita" type="button" value="Editar" onclick="window.location='update_discipline.php?id_article=<?php echo $row_disciplines['id_article'];?>'"/></td>
          <td width="68" align="center"><input name="elimina" type="button" value="Eliminar"  onclick="window.location='delete_discipline.php?id_article=<?php echo $row_disciplines['id_article'];?>'"/></td>
        </tr>
        <?php }?>
      </table>
    </form>
    <!-- InstanceEndEditable --></div>
  <div id="separador" style=" clear:both; height:20px;"></div>
  
</div>
</body>
<!-- InstanceEnd --></html>
