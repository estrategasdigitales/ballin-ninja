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

if(!isset($_SESSION['usuario']))
{
  session_start();
  
  if(!isset($_SESSION['usuario']))
  {
    $goto="index.php";
    header(sprintf("Location: %s", $goto));
    exit;
  }
}

$currentPage = "fechas_idiom_home.php";

$maxRows_fecha_idioma = 20;
$pageNum_fecha_idioma = 0;
if (isset($_GET['pageNum_fecha_idioma'])) {
  $pageNum_fecha_idioma = $_GET['pageNum_fecha_idioma'];
}
$startRow_fecha_idioma = $pageNum_fecha_idioma * $maxRows_fecha_idioma;

mysql_select_db($database_otono2011, $otono2011);
$query_fecha_idioma = "SELECT * FROM site_fechas_idiomas ORDER BY id_program ASC";
$query_limit_fecha_idioma = sprintf("%s LIMIT %d, %d", $query_fecha_idioma, $startRow_fecha_idioma, $maxRows_fecha_idioma);
$fecha_idioma = mysql_query($query_limit_fecha_idioma, $otono2011) or die(mysql_error());
$row_fecha_idioma = mysql_fetch_assoc($fecha_idioma);

if (isset($_GET['totalRows_fecha_idioma'])) {
  $totalRows_fecha_idioma = $_GET['totalRows_fecha_idioma'];
} else {
  $all_fecha_idioma = mysql_query($query_fecha_idioma);
  $totalRows_fecha_idioma = mysql_num_rows($all_fecha_idioma);
}
$totalPages_fecha_idioma = ceil($totalRows_fecha_idioma/$maxRows_fecha_idioma)-1;

$queryString_fecha_idioma = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_fecha_idioma") == false && 
        stristr($param, "totalRows_fecha_idioma") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_fecha_idioma = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_fecha_idioma = sprintf("&totalRows_fecha_idioma=%d%s", $totalRows_fecha_idioma, $queryString_fecha_idioma);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/temp_admin.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO 8859-1"
        />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Educación Continua</title>
<!-- InstanceEndEditable -->
<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<script>

function eliminar_fecha(id_fecha){
  var r = confirm('¿Estás seguro que deseas eliminar esta fecha?');
  if(r == true){
    window.location="fechas_idiom_eliminar.php?id_fecha_idioma="+id_fecha;
  }if(r == false){
    //
  }
}
</script>
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
    <h1>Fechas Idiomas </h1>
    <table border="0" cellpadding="5" cellspacing="0" class="tablas">
      <tr class="titulo_tabla">
        <td>Programa</td>
        <td>Nivel</td>
        <td>Subnivel</td>
        <td>Inicio</td>
        <td>Duraci&oacute;n</td>
        <td>Horario</td>
        <td colspan="2">
        <input type="button" value="Nuevo nivel" onclick="javascript:window.location='fechas_idiom_nuevo.php'">
        </td>
      </tr>
      <?php 
	if($totalRows_fecha_idioma != 0){
		do { ?>
      <tr>
        <td><?php
				mysql_select_db($database_otono2011, $otono2011);
				$query_programa = "SELECT program_name FROM site_programs WHERE id_program = ".$row_fecha_idioma['id_program'];
				$programa = mysql_query($query_programa, $otono2011) or die(mysql_error());
				$row_programa = mysql_fetch_assoc($programa);
				$totalRows_programa = mysql_num_rows($programa);
				echo $row_programa['program_name'];
				?></td>
        <td><?php echo $row_fecha_idioma['nivel']; ?></td>
        <td><?php echo $row_fecha_idioma['subnivel']; ?></td>
        <td><?php echo $row_fecha_idioma['inicio']; ?></td>
        <td><?php echo $row_fecha_idioma['duracion']; ?></td>
        <td><?php echo $row_fecha_idioma['horario']; ?></td>
        <!--td>Editar</td-->
        <td><a onclick="eliminar_fecha(<?php echo $row_fecha_idioma['id_fecha_idioma']; ?>);" href="#">Eliminar</a></td>
      </tr>
      <?php } while ($row_fecha_idioma = mysql_fetch_assoc($fecha_idioma)); 
		}?>
    </table>
    <table border="0" align="center">
      <tr>
        <td><?php if ($pageNum_fecha_idioma > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_fecha_idioma=%d%s", $currentPage, 0, $queryString_fecha_idioma); ?>"><img src="First.gif" border="0" /></a>
            <?php } // Show if not first page ?></td>
        <td><?php if ($pageNum_fecha_idioma > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_fecha_idioma=%d%s", $currentPage, max(0, $pageNum_fecha_idioma - 1), $queryString_fecha_idioma); ?>"><img src="Previous.gif" border="0" /></a>
            <?php } // Show if not first page ?></td>
        <td><?php if ($pageNum_fecha_idioma < $totalPages_fecha_idioma) { // Show if not last page ?>
            <a href="<?php printf("%s?pageNum_fecha_idioma=%d%s", $currentPage, min($totalPages_fecha_idioma, $pageNum_fecha_idioma + 1), $queryString_fecha_idioma); ?>"><img src="Next.gif" border="0" /></a>
            <?php } // Show if not last page ?></td>
        <td><?php if ($pageNum_fecha_idioma < $totalPages_fecha_idioma) { // Show if not last page ?>
            <a href="<?php printf("%s?pageNum_fecha_idioma=%d%s", $currentPage, $totalPages_fecha_idioma, $queryString_fecha_idioma); ?>"><img src="Last.gif" border="0" /></a>
            <?php } // Show if not last page ?></td>
      </tr>
    </table>
    <!-- InstanceEndEditable --></div>
  <div id="separador" style=" clear:both; height:20px;"></div>
  
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($fecha_idioma);
?>