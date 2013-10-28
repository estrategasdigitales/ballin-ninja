<?php 
session_start();
if(!isset($_SESSION['usuario']) && empty($_SESSION['usuario'])){
	header('Location: login_admin_pjf.php');	
	}

require_once('Connections/otono2011.php'); 
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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_Recordset2 = 100;
$pageNum_Recordset2 = 0;
if (isset($_GET['pageNum_Recordset2'])) {
  $pageNum_Recordset2 = $_GET['pageNum_Recordset2'];
}
$startRow_Recordset2 = $pageNum_Recordset2 * $maxRows_Recordset2;

mysql_select_db($database_otono2011, $otono2011);
$query_Recordset2 = "SELECT * FROM sp_preinscritos_pjf ORDER BY id_preinscrito DESC";
$query_limit_Recordset2 = sprintf("%s LIMIT %d, %d", $query_Recordset2, $startRow_Recordset2, $maxRows_Recordset2);
$Recordset2 = mysql_query($query_limit_Recordset2, $otono2011) or die(mysql_error());
//$row_Recordset2 = mysql_fetch_assoc($Recordset2);

if (isset($_GET['totalRows_Recordset2'])) {
  $totalRows_Recordset2 = $_GET['totalRows_Recordset2'];
} else {
  $all_Recordset2 = mysql_query($query_Recordset2);
  $totalRows_Recordset2 = mysql_num_rows($all_Recordset2);
}
$totalPages_Recordset2 = ceil($totalRows_Recordset2/$maxRows_Recordset2)-1;

$queryString_Recordset2 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset2") == false && 
        stristr($param, "totalRows_Recordset2") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset2 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset2 = sprintf("&totalRows_Recordset2=%d%s", $totalRows_Recordset2, $queryString_Recordset2);


if (isset($_GET['totalRows_Recordset2'])) {
  $totalRows_Recordset2 = $_GET['totalRows_Recordset2'];
} else {
  $all_Recordset2 = mysql_query($query_Recordset2);
  $totalRows_Recordset2 = mysql_num_rows($all_Recordset2);
}
$totalPages_Recordset2 = ceil($totalRows_Recordset2/$maxRows_Recordset2)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/estilos.css" rel="stylesheet" type="text/css" />
<script>
function confirmEliminar(){
	
var conf = confirm("¿De verdad deseas eliminar este registro? Esta acción es irreversible.")

if(conf == true){
	return true
	}
	else if(conf == false){
		return false
		}
	}


</script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
<table border="0" align="center">
  <tr>
    <td><?php if ($pageNum_Recordset2 > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_Recordset2=%d%s", $currentPage, 0, $queryString_Recordset2); ?>"><img src="imagenes/buttons/First.gif" /></a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_Recordset2 > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_Recordset2=%d%s", $currentPage, max(0, $pageNum_Recordset2 - 1), $queryString_Recordset2); ?>"><img src="imagenes/buttons/Previous.gif" /></a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_Recordset2 < $totalPages_Recordset2) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_Recordset2=%d%s", $currentPage, min($totalPages_Recordset2, $pageNum_Recordset2 + 1), $queryString_Recordset2); ?>"><img src="imagenes/buttons/Next.gif" /></a>
        <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_Recordset2 < $totalPages_Recordset2) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_Recordset2=%d%s", $currentPage, $totalPages_Recordset2, $queryString_Recordset2); ?>"><img src="imagenes/buttons/Last.gif" /></a>
        <?php } // Show if not last page ?></td>
        <td><?php $inicio = $startRow_Recordset2+1;$final = $startRow_Recordset2+100; echo " Est&aacute;s viendo del registro ".$inicio." al "; if ($pageNum_Recordset2 < $totalPages_Recordset2) {echo $final;}else{echo $totalRows_Recordset2;} echo " de ". $totalRows_Recordset2; ?></td>
  </tr>
</table>
<table width="800" border="0" align="center" cellpadding="5" cellspacing="0" class="tablas">
  <tr class="titulo_tabla">
    <td>Folio</td>
    <td>A Paterno</td>
    <td>A Materno</td>
    <td>Nombre</td>
    <td>N&uacute;mero de Expediente</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <?php while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)) { ?>
    <tr>
      <td><?php
				if($row_Recordset2['id_preinscrito'] < 10){
					echo "000".$row_Recordset2['id_preinscrito'];
				}elseif($row_Recordset2['id_preinscrito'] >= 10 && $row_Recordset2['id_preinscrito'] < 100){
					echo "00".$row_Recordset2['id_preinscrito'];
				}elseif($row_Recordset2['id_preinscrito'] >= 100 && $row_Recordset2['id_preinscrito'] < 1000){
					echo "0".$row_Recordset2['id_preinscrito'];
				}else{
					echo $row_Recordset2['id_preinscrito'];
				}
				?></td>
      <td><?php echo $row_Recordset2['a_paterno']; ?></td>
      <td><?php echo $row_Recordset2['a_materno']; ?></td>
      <td><?php echo $row_Recordset2['nombre']; ?></td>
      <td><?php echo $row_Recordset2['num_expediente']; ?></td>
      <td>
  <form method="post" action="editar_registro_pjf.php">
        	<input type="submit" name="editar" value="Editar"/>
            <input type="hidden" name="id_preinscrito" value="<?php echo $row_Recordset2['id_preinscrito']?>" />
      	</form>
      </td>
      <td>
  <form method="post" action="eliminar_registro_pjf.php" onsubmit="return confirmEliminar();">
        	<input type="submit" name="eliminar" value="Eliminar"/>
            <input type="hidden" name="id_preinscrito" value="<?php echo $row_Recordset2['id_preinscrito']?>" />
      	</form>
      </td>
    </tr>
    <?php } ?>
</table>
<div style="clear:both;">
</div>
<table border="0" align="center">
  <tr>
    <td><?php if ($pageNum_Recordset2 > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_Recordset2=%d%s", $currentPage, 0, $queryString_Recordset2); ?>"><img src="imagenes/buttons/First.gif" /></a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_Recordset2 > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_Recordset2=%d%s", $currentPage, max(0, $pageNum_Recordset2 - 1), $queryString_Recordset2); ?>"><img src="imagenes/buttons/Previous.gif" /></a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_Recordset2 < $totalPages_Recordset2) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_Recordset2=%d%s", $currentPage, min($totalPages_Recordset2, $pageNum_Recordset2 + 1), $queryString_Recordset2); ?>"><img src="imagenes/buttons/Next.gif" /></a>
        <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_Recordset2 < $totalPages_Recordset2) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_Recordset2=%d%s", $currentPage, $totalPages_Recordset2, $queryString_Recordset2); ?>"><img src="imagenes/buttons/Last.gif" /></a>
        <?php } // Show if not last page ?></td>
        <td><?php $inicio = $startRow_Recordset2+1;$final = $startRow_Recordset2+100; echo " Est&aacute;s viendo del registro ".$inicio." al "; if ($pageNum_Recordset2 < $totalPages_Recordset2) {echo $final;}else{echo $totalRows_Recordset2;} echo " de ". $totalRows_Recordset2; ?></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($Recordset2);
?>
