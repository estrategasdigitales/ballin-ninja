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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE site_fechas_ini SET fecha=%s, horario=%s, cancelado=%s, cont_cancelaciones=%s, cont_cambio_fecha=%s WHERE id_fecha=%s",
                       GetSQLValueString($_POST['fecha'], "date"),
                       GetSQLValueString($_POST['horario'], "text"),
                       GetSQLValueString(isset($_POST['cancelado']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['cont_cancelaciones'], "int"),
                       GetSQLValueString($_POST['cont_cambio_fecha'], "int"),
                       GetSQLValueString($_POST['id_fecha'], "int"));

  mysql_select_db($database_otono2011, $otono2011);
  $Result1 = mysql_query($updateSQL, $otono2011) or die(mysql_error());
  
  header('Location:fechas_home.php');
}

$colname_fechas = "-1";
if (isset($_GET['id_fecha'])) {
  $colname_fechas = $_GET['id_fecha'];
}
mysql_select_db($database_otono2011, $otono2011);
$query_fechas = sprintf("SELECT * FROM site_fechas_ini WHERE id_fecha = %s", GetSQLValueString($colname_fechas, "int"));
$fechas = mysql_query($query_fechas, $otono2011) or die(mysql_error());
$row_fechas = mysql_fetch_assoc($fechas);
$totalRows_fechas = mysql_num_rows($fechas);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/temp_admin.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO 8859-1"
        />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Educación Continua</title>
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
    <div class="bannersuperior2" style="margin-left: 4px"></div>
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
              <h1>Editar Fechas
			</h1>
              <form action="fechas_editar.php" method="post" name="form1" id="form1">
			  <table border="0" align="left" cellpadding="5" cellspacing="0">
						<tr valign="baseline">
							<td align="right" valign="middle" nowrap="nowrap"><strong>Fecha:</strong></td>
							<td valign="baseline"><input type="text" name="fecha" value="<?php echo $row_fechas['fecha']; ?>" size="32" /></td>
						</tr>
						<tr valign="baseline">
							<td align="right" valign="middle" nowrap="nowrap"><strong>Programa:</strong></td>
							<td valign="baseline">
							<?php
							mysql_select_db($database_otono2011, $otono2011);
							$query_programa = "SELECT * FROM site_programs WHERE id_program = ".$row_fechas['id_program'];
							$programa = mysql_query($query_programa, $otono2011) or die(mysql_error());
							$row_programa = mysql_fetch_assoc($programa);
							$totalRows_programa = mysql_num_rows($programa);
							echo $row_programa['program_name'];
							?></td>
						</tr>
						<tr valign="baseline">
							<td align="right" valign="middle" nowrap="nowrap"><strong>Sede:</strong></td>
							<td valign="baseline">
							<?php
							if($row_fechas['id_sede']!=NULL){
								mysql_select_db($database_otono2011, $otono2011);
								$query_sede = "SELECT * FROM site_sedes WHERE id_sede = ".$row_fechas['id_sede'];
								$sede = mysql_query($query_sede, $otono2011) or die(mysql_error());
								$row_sede = mysql_fetch_assoc($sede);
								$totalRows_sede = mysql_num_rows($sede);
								echo $row_sede['nombre_sede'];
							}?></td>
						</tr>
						<tr valign="baseline">
							<td align="right" valign="middle" nowrap="nowrap"><strong>Horario:</strong></td>
							<td valign="baseline"><input type="text" name="horario" value="<?php echo $row_fechas['horario']; ?>" size="32" /></td>
						</tr>
						<tr valign="baseline">
							<td align="right" valign="middle" nowrap="nowrap"><strong>Cancelado:</strong></td>
							<td valign="baseline"><input type="checkbox" name="cancelado" value=""  <?php if (!(strcmp($row_fechas['cancelado'],1))) {echo "checked=\"checked\"";} ?> /></td>
						</tr>
						<tr valign="baseline">
							<td align="right" valign="middle" nowrap="nowrap">&nbsp;</td>
							<td valign="baseline"><input name="Button" type="button" value="Cancelar" onClick="parent.location='fechas_home.php'" />
								<input type="submit" value="Actualizar" /></td>
						</tr>
					</table>
<input type="hidden" name="id_fecha" value="<?php echo $row_fechas['id_fecha']; ?>" />
					<input type="hidden" name="cont_cancelaciones" value="<?php echo $row_fechas['cont_cancelaciones']; ?>" />
					<input type="hidden" name="cont_cambio_fecha" value="<?php echo $row_fechas['cont_cambio_fecha']; ?>" />
					<input type="hidden" name="MM_update" value="form1" />
					<input type="hidden" name="id_fecha" value="<?php echo $row_fechas['id_fecha']; ?>" />
				</form>
				<p>&nbsp;</p>
		<!-- InstanceEndEditable --></div>
  <div id="separador" style=" clear:both; height:20px;"></div>
  
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($fechas);
?>
