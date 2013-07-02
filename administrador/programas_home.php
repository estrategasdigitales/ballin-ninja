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

$currentPage = "programas_home.php";
$maxRows_programas = 20;
$pageNum_programas = 0;
if (isset($_GET['pageNum_programas'])) {
  $pageNum_programas = $_GET['pageNum_programas'];
}
$startRow_programas = $pageNum_programas * $maxRows_programas;

mysql_select_db($database_otono2011, $otono2011);
$query_programas = "SELECT site_programs.id_program, site_programs.program_name, site_programs.program_type, site_programs.program_new, site_programs.cancelado, site_programs.id_discipline, site_programs.id_discipline_alterna, disciplines.discipline, disciplines.id_discipline FROM site_programs, disciplines WHERE site_programs.id_discipline = disciplines.id_discipline ORDER BY id_program DESC";
$query_limit_programas = sprintf("%s LIMIT %d, %d", $query_programas, $startRow_programas, $maxRows_programas);
$programas = mysql_query($query_limit_programas, $otono2011) or die(mysql_error());
$row_programas = mysql_fetch_assoc($programas);

if (isset($_GET['totalRows_programas'])) {
  $totalRows_programas = $_GET['totalRows_programas'];
} else {
  $all_programas = mysql_query($query_programas);
  $totalRows_programas = mysql_num_rows($all_programas);
}
$totalPages_programas = ceil($totalRows_programas/$maxRows_programas)-1;

$queryString_programas = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_programas") == false && 
        stristr($param, "totalRows_programas") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_programas = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_programas = sprintf("&totalRows_programas=%d%s", $totalRows_programas, $queryString_programas);
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

function eliminar_prog(id_programa){
  var r = confirm('¿Estás seguro que deseas eliminar este programa?');
  if(r == true){
    window.location="programas_eliminar.php?id_program="+id_programa;
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

 <h1> Programas </h1>
<table  border="0" cellpadding="5" cellspacing="0" class="tablas">
	<tr class="titulo_tabla">
		<td>Programa</td>
		<td>Disciplina</td>
		<td>Disciplina alterna</td>
		<td>Tipo</td>
		<td>Nuevo</td>
		<td>Cancelado</td>
		<td colspan="2">
        <input type="button" value="Nuevo Programa" onclick="javascript:window.location='programas_nuevo.php'">
        </td>
	  </tr>
	<?php $cont = 0; do { $cont++; ?>
		<tr>
			<td><a href="programas_editar.php?id_program=<?php echo $row_programas['id_program']; ?>"><?php echo $row_programas['program_name']; ?></a></td>
			<td><?php echo $row_programas['discipline']; ?></td>
			<td><?php echo $row_programas['id_discipline_alterna']; ?></td>
			<td><?php echo $row_programas['program_type']; ?></td>
			<td><?php if($row_programas['program_new'] == 1){ echo 'S&iacute;';}else{echo 'No'; } ?></td>
			<td><?php if($row_programas['cancelado'] == 1){ echo "S&iacute;";}else{echo "No";} ?></td>
			<td><a href="programas_editar.php?id_program=<?php echo $row_programas['id_program']; ?>">Editar</a></td>
			<td><a onclick="eliminar_prog(<?php echo $row_programas['id_program']; ?>);" href="#">Eliminar</a></td>
		</tr>
		<?php } while ($row_programas = mysql_fetch_assoc($programas)); ?>
</table>
<table border="0" align="center">
	<tr>
    <td><?php echo "Del programa ".($startRow_programas + 1)." al ".($startRow_programas + $cont); ?></td>
		<td><?php if ($pageNum_programas > 0) { // Show if not first page ?>
				<a href="<?php printf("%s?pageNum_programas=%d%s", $currentPage, 0, $queryString_programas); ?>"><img src="First.gif" border="0" /></a>
		<?php } // Show if not first page ?></td>
		<td><?php if ($pageNum_programas > 0) { // Show if not first page ?>
				<a href="<?php printf("%s?pageNum_programas=%d%s", $currentPage, max(0, $pageNum_programas - 1), $queryString_programas); ?>"><img src="Previous.gif" border="0" /></a>
		<?php } // Show if not first page ?></td>
		<td><?php if ($pageNum_programas < $totalPages_programas) { // Show if not last page ?>
				<a href="<?php printf("%s?pageNum_programas=%d%s", $currentPage, min($totalPages_programas, $pageNum_programas + 1), $queryString_programas); ?>"><img src="Next.gif" border="0" /></a>
		<?php } // Show if not last page ?></td>
		<td><?php if ($pageNum_programas < $totalPages_programas) { // Show if not last page ?>
				<a href="<?php printf("%s?pageNum_programas=%d%s", $currentPage, $totalPages_programas, $queryString_programas); ?>"><img src="Last.gif" border="0" /></a>
		<?php } // Show if not last page ?></td>
	</tr>
</table>
<!-- InstanceEndEditable --></div>
  <div id="separador" style=" clear:both; height:20px;"></div>
  
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($programas);
?>
