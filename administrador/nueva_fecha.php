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
  $insertSQL = sprintf("INSERT INTO site_fechas_ini (id_fecha, fecha, id_program, id_sede, horario, periodo) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_fecha'], "int"),
                       GetSQLValueString($_POST['fecha'], "date"),
                       GetSQLValueString($_POST['id_program'], "int"),
                       GetSQLValueString($_POST['id_sede'], "int"),
                       GetSQLValueString($_POST['horario'], "text"),
					   GetSQLValueString($_POST['periodo'], "text"));

  mysql_select_db($database_otono2011, $otono2011);
  $Result1 = mysql_query($insertSQL, $otono2011) or die(mysql_error());

  $insertGoTo = "fechas_home.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_otono2011, $otono2011);
$query_programa = "SELECT * FROM site_programs ORDER BY program_name ASC";
$programa = mysql_query($query_programa, $otono2011) or die(mysql_error());
$row_programa = mysql_fetch_assoc($programa);
$totalRows_programa = mysql_num_rows($programa);

mysql_select_db($database_otono2011, $otono2011);
$query_sede = "SELECT * FROM site_sedes";
$sede = mysql_query($query_sede, $otono2011) or die(mysql_error());
$row_sede = mysql_fetch_assoc($sede);
$totalRows_sede = mysql_num_rows($sede);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/temp_admin.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO 8859-1"
        />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Educaci�n Continua</title>
<!-- InstanceEndEditable -->
<link href="../css/estilos.css" rel="stylesheet"
        type="text/css" />
<!-- InstanceBeginEditable name="head" -->


<link rel="stylesheet" href="tigra_calendar/calendar.css" type="text/css">
<script language="JavaScript" src="tigra_calendar/calendar_db.js" type="text/javascript"></script>
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
          <h2>Art�culos</h2>
          <ul>
            <li><a href="admin_discipline_articles.php?id_discipline=1">Disciplinas</a> </li>
            <li><a href="admin_media_articles.php">La DEC en los Medios</a> </li>
            <li><a href="admin_opinions.php">La Comunidad Ibero Opina</a> </li>
            <li><a href="admin_weekly_articles.php">Art�culos semanales</a> </li>
          </ul>
          <p>&nbsp;</p>
        </div>
      </div>
    </div>
  </div>
  <div id="contenedor_irregular_index" style="width:800px;"><!-- InstanceBeginEditable name="contenido" -->
            <h1>Nueva Fecha </h1>
            <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
	<table border="0" align="left" cellpadding="5" cellspacing="0">
		<tr valign="baseline">
			<td nowrap="nowrap" align="right"><strong>Fecha:</strong></td>
			<td colspan="2"><input type="text" name="fecha" value="" size="32" placeholder="aaaa-mm-dd" />
			<script language="JavaScript">
	  		new tcal ({
				// form name
				'formname': 'form1',
				// input name
				'controlname': 'fecha'
				});
      		</script></td>
		</tr>
		<tr valign="baseline">
			<td nowrap="nowrap" align="right"><strong>Programa:</strong></td>
			<td colspan="2">
				<select name="id_program" id="id_program">
					<?php
					do {  
					?>
					<option value="<?php echo $row_programa['id_program']?>"><?php echo $row_programa['program_name']?></option>
					<?php
					} while ($row_programa = mysql_fetch_assoc($programa));
					  $rows = mysql_num_rows($programa);
					  if($rows > 0) {
						  mysql_data_seek($programa, 0);
						  $row_programa = mysql_fetch_assoc($programa);
					  }
					?>
				</select>
			</td>
		</tr>
		<tr valign="baseline">
			<td nowrap="nowrap" align="right"><strong>Sede:</strong></td>
			<td colspan="2">
				<select name="id_sede" id="id_sede">
					<option value="">N/A</option>
					<?php
					do {  
					?>
					<option value="<?php echo $row_sede['id_sede']?>"><?php echo $row_sede['nombre_sede']?></option>
					<?php
					} while ($row_sede = mysql_fetch_assoc($sede));
					  $rows = mysql_num_rows($sede);
					  if($rows > 0) {
						  mysql_data_seek($sede, 0);
						  $row_sede = mysql_fetch_assoc($sede);
					  }
					?>
				</select>
			</td>
		</tr>
		<tr valign="baseline">
			<td nowrap="nowrap" align="right"><strong>Horario:</strong></td>
			<td colspan="2"><input type="text" name="horario" value="" size="32" /></td>
		</tr>
		<tr valign="baseline">
			<td nowrap="nowrap" align="right"><strong>Periodo:</strong></td>
			<td colspan="2"><select name="periodo" id="periodo">
				<option value="p">Primavera</option>
				<option value="v">Verano</option>
				<option value="o">Oto&ntilde;o</option>
			</select></td>
		</tr>
		<tr valign="baseline">
			<td nowrap="nowrap" align="right"><strong></strong></td>
			<td><input name="Button" type="button" value="Cancelar" /></td>
			<td><input type="submit" value="Aceptar" /></td>
		</tr>
	</table>
	<input type="hidden" name="id_fecha" value="" />
	<input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
<!-- InstanceEndEditable --></div>
  <div id="separador" style=" clear:both; height:20px;"></div>
  
</div>
</body>
<!-- InstanceEnd --></html>