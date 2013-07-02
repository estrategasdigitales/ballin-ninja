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

  session_start();
  
  if(!isset($_SESSION['usuario']) && ($_SESSION['usuario']) == NULL){
    header('Location: index.php');
  }


$currentPage = "fechas_home.php";

$maxRows_fechas = 50;
$pageNum_fechas = 0;
if (isset($_GET['pageNum_fechas'])) {
  $pageNum_fechas = $_GET['pageNum_fechas'];
}
$startRow_fechas = $pageNum_fechas * $maxRows_fechas;

mysql_select_db($database_otono2011, $otono2011);
$query_fechas = "SELECT * FROM site_fechas_ini ORDER BY fecha DESC";
$query_limit_fechas = sprintf("%s LIMIT %d, %d", $query_fechas, $startRow_fechas, $maxRows_fechas);
$fechas = mysql_query($query_limit_fechas, $otono2011) or die(mysql_error());
$row_fechas = mysql_fetch_assoc($fechas);

if (isset($_GET['totalRows_fechas'])) {
  $totalRows_fechas = $_GET['totalRows_fechas'];
} else {
  $all_fechas = mysql_query($query_fechas);
  $totalRows_fechas = mysql_num_rows($all_fechas);
}
$totalPages_fechas = ceil($totalRows_fechas/$maxRows_fechas)-1;

$queryString_fechas = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_fechas") == false && 
        stristr($param, "totalRows_fechas") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_fechas = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_fechas = sprintf("&totalRows_fechas=%d%s", $totalRows_fechas, $queryString_fechas);

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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>

function eliminar_fecha(id_fecha){
  var r = confirm('¿Estás seguro que deseas eliminar esta fecha?');
  if(r == true){
    window.location="fechas_eliminar.php?id_fecha="+id_fecha;
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
<h1>Fechas </h1>
<table border="0" cellpadding="5" cellspacing="0" class="tablas">
	<tr class="titulo_tabla">
		<td>Fecha</td>
		<td>Programa</td>
		<td>Sede</td>
		<td>Horario</td>
		<td>Cancelado</td>
		<td>Temario</td>
		<td colspan="2"><input type="button" value="Nueva fecha" onclick="javascript:window.location='nueva_fecha.php'"></td>
	  </tr>
	<?php 
	if($totalRows_fechas != 0){
	do { ?>
		<tr>
			<td><?php echo $row_fechas['fecha']; ?></td>
			<td>
			<?php
			mysql_select_db($database_otono2011, $otono2011);
			$query_programa = "SELECT * FROM site_programs WHERE id_program = ".$row_fechas['id_program'];
			$programa = mysql_query($query_programa, $otono2011) or die(mysql_error());
			$row_programa = mysql_fetch_assoc($programa);
			$totalRows_programa = mysql_num_rows($programa);
			echo '<a href="fechas_editar.php?id_fecha='.$row_fechas["id_fecha"].'">'.$row_programa["program_name"].'</a>';
			?>
			</td>
			<td>
				<?php
			if($row_fechas['id_sede']!=NULL){
				mysql_select_db($database_otono2011, $otono2011);
				$query_sede = "SELECT * FROM site_sedes WHERE id_sede = ".$row_fechas['id_sede'];
				$sede = mysql_query($query_sede, $otono2011) or die(mysql_error());
				$row_sede = mysql_fetch_assoc($sede);
				$totalRows_sede = mysql_num_rows($sede);
				echo $row_sede['nombre_sede'];
			}
			?>
			</td>
			<td><?php echo $row_fechas['horario']; ?></td>
			<td><?php if($row_fechas['cancelado'] == 1){echo "S&iacute;";}else{echo "No";} ?></td>
			<td><?php echo $row_programa['program_pdf']; ?></td>
			<td><a onclick="eliminar_fecha(<?php echo $row_fechas['id_fecha']; ?>);" href="#">Eliminar</a></td>
			<td><a href="fechas_editar.php?id_fecha=<?php echo $row_fechas['id_fecha']; ?>">Editar</a></td>
		</tr>
		<?php } while ($row_fechas = mysql_fetch_assoc($fechas)); 
	}?>
</table>
<table border="0" align="center">
	<tr>
		<td><?php if ($pageNum_fechas > 0) { // Show if not first page ?>
				<a href="<?php printf("%s?pageNum_fechas=%d%s", $currentPage, 0, $queryString_fechas); ?>"><img src="First.gif" border="0" /></a>
		<?php } // Show if not first page ?></td>
		<td><?php if ($pageNum_fechas > 0) { // Show if not first page ?>
				<a href="<?php printf("%s?pageNum_fechas=%d%s", $currentPage, max(0, $pageNum_fechas - 1), $queryString_fechas); ?>"><img src="Previous.gif" border="0" /></a>
		<?php } // Show if not first page ?></td>
		<td><?php if ($pageNum_fechas < $totalPages_fechas) { // Show if not last page ?>
				<a href="<?php printf("%s?pageNum_fechas=%d%s", $currentPage, min($totalPages_fechas, $pageNum_fechas + 1), $queryString_fechas); ?>"><img src="Next.gif" border="0" /></a>
		<?php } // Show if not last page ?></td>
		<td><?php if ($pageNum_fechas < $totalPages_fechas) { // Show if not last page ?>
				<a href="<?php printf("%s?pageNum_fechas=%d%s", $currentPage, $totalPages_fechas, $queryString_fechas); ?>"><img src="Last.gif" border="0" /></a>
		<?php } // Show if not last page ?></td>
	</tr>
</table>
<!-- InstanceEndEditable --></div>
  <div id="separador" style=" clear:both; height:20px;"></div>
  
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($fechas);

mysql_free_result($disciplinas);
?>
