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

$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_otono2011, $otono2011);
$query_Recordset1 = "SELECT * FROM carrusel_index ORDER BY id_carrusel_index DESC";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $otono2011) or die(mysql_error());
//$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/estilos.css" rel="stylesheet"
        type="text/css" />
<title>Documento sin título</title>
<script>

function confirmDeletion(){

var conf = confirm("¿De verdad deseas eliminar este banner? Esta acción es definitiva e irreversible.")

if(conf == true){
	return true;
	}
else if(conf == false){
	return false;
	}
}
</script>
</head>

<body>
<table width="700" border="0" align="center" cellpadding="5" cellspacing="0" class="tablas">
  <tr class="titulo_tabla">
    <td width="211">Imagen</td>
    <td width="211">Titular</td>
    <td width="211">Texto</td>
    <td width="326">Destino</td>
    <td width="131"><input type="button" onclick="javascript:window.location='insert_carrusel.php'" value="Agregar Nuevo"/></td>
  </tr>
  <?php while($row_Recordset1 = mysql_fetch_assoc($Recordset1)) { ?>
    <tr>
      <td><img src="../imagenes/carrusel/<?php echo $row_Recordset1['imagen_carrusel']; ?>" width="100"/></td>
      <td><?php echo utf8_encode($row_Recordset1['titulo']); ?></td>
      <td><?php echo utf8_encode($row_Recordset1['texto']); ?></td>
      <td><?php echo $row_Recordset1['destino']; ?></td>
      <td align="center">
          <form action="banner_eliminar.php" onsubmit="return confirmDeletion();" method="post">
             <input type="submit" value="Eliminar"/>
             <input type="hidden" name="imagen" value="<?php echo $row_Recordset1['img_banner']; ?>"/>
             <input type="hidden" name="id_banner" value="<?php echo $row_Recordset1['id_banner']; ?>"/>
          </form>
      </td>
    </tr>
    <?php }?>
</table>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>