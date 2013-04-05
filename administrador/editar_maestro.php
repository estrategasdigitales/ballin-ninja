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
  $insertSQL = sprintf("UPDATE site_maestros SET nombre_maestro='".$_POST['nombre_maestro']."', titulo_maestro='".$_POST['titulo_maestro']."', telefono='".$_POST['telefono']."', mail='".$_POST['mail']."', cv='".$_POST['cv']."', sexo='".$_POST['sexo']."' WHERE id_maestro=".$_POST['id_maestro']."");
                       
  mysql_select_db($database_otono2011, $otono2011);
  $Result1 = mysql_query($insertSQL, $otono2011) or die(mysql_error());

  $insertGoTo = "admin_dir_maestros.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_otono2011, $otono2011);
$sql = mysql_query("SELECT * FROM site_maestros WHERE id_maestro=".$_GET['id_maestro'], $otono2011);
$row_sql = mysql_fetch_assoc($sql);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/temp_admin.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO 8859-1"
        />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Educaci&oacute;n Continua</title>
<!-- InstanceEndEditable -->
<link href="../css/estilos.css" rel="stylesheet"
        type="text/css" />
<!-- InstanceBeginEditable name="head" -->


<link rel="stylesheet" href="tigra_calendar/calendar.css" type="text/css">
<script language="JavaScript" src="tigra_calendar/calendar_db.js" type="text/javascript"></script>
<!-- InstanceEndEditable -->
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript">
$(document).ready(function(){

CKEDITOR.replace( 'cv' );

})
</script>
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
            <li><a href="propuestas_progr_home.php">Propuestas Programas</a></li>
          </ul>
          <p>&nbsp;</p>
          <h2>Carrusel Index</h2>
          <ul>
            <li><a href="admin_carrusel/index.php">Banners</a></li>
          </ul>
          <p>&nbsp;</p>
          <h2>Art&iacute;culos</h2>
          <ul>
            <li><a href="admin_discipline_articles.php?id_discipline=1">Disciplinas</a> </li>
            <li><a href="admin_opinions.php">La Comunidad Ibero Opina</a> </li>            
            <li><a href="admin_weekly_articles.php">Art&iacute;culos semanales</a> </li>
            <!--li><a href="admin_media_articles.php">La DEC en los Medios</a> </li-->
          </ul>
          <p>&nbsp;</p>
          <h2>Sedes</h2>
          <ul>
            <li><a href="admin_sedes_home.php">Sedes</a></li>
          </ul>
          <p>&nbsp;</p>
          <h2>Directorio</h2>
          <ul>
            <li><a href="admin_dir_dec.php">DEC</a></li>
            <li><a href="admin_dir_maestros.php">Maestros</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div id="contenedor_irregular_index" style="width:800px;"><!-- InstanceBeginEditable name="contenido" -->
            <h1>Nuevo Maestro </h1>
            <form action="editar_maestro.php" method="post" name="form1" id="form1">
	<table border="0" align="left" cellpadding="5" cellspacing="0">
		<tr valign="baseline">
			<td nowrap="nowrap" align="right"><strong>Nombre Maestro:</strong></td>
			<td colspan="2"><input type="text" name="nombre_maestro" value="<?php echo $row_sql['nombre_maestro']; ?>" size="32"/>
		</tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>T&iacute;tulo:</strong></td>
      <td colspan="2"><input type="text" name="titulo_maestro" value="<?php echo $row_sql['titulo_maestro']; ?>" size="32"/>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Tel&eacute;fono:</strong></td>
      <td colspan="2"><input type="text" name="telefono" value="<?php echo $row_sql['telefono']; ?>" size="32"/>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Correo:</strong></td>
      <td colspan="2"><input type="text" name="mail" value="<?php echo $row_sql['mail']; ?>" size="32"/>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" valign="top"><strong>C.V.:</strong></td>
      <td colspan="2"><textarea name="cv" id="cv"><?php echo $row_sql['cv']; ?></textarea>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Sexo:</strong></td>
      <td colspan="2">
        <select name="sexo">
            <option <?php if($row_sql['sexo'] == "F"){echo 'selected="selected"';} ?> value="F">Femenino</option>
            <option <?php if($row_sql['sexo'] == "M"){echo 'selected="selected"';} ?> value="M">Masculino</option>
        </select>
    </tr>
    <tr align="center">
      <td colspan="3"><input type="button" value="Cancelar" onclick="javascript:window.location='admin_dir_maestros.php'"/><input type="submit" value="Enviar"/></td>
    </tr>
	</table>

	<input type="hidden" name="id_maestro" value="<?php echo $_GET['id_maestro'] ?>" />
	<input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
<!-- InstanceEndEditable --></div>
  <div id="separador" style=" clear:both; height:20px;"></div>
  
</div>
</body>
<!-- InstanceEnd --></html>