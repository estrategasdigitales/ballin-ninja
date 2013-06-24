<?php
session_start();

if(isset($_SESSION['sesion'])){
  $sesion = 1;
}else{
  $sesion = 0;
  header("Location:index.php");
}
if($_SERVER['PHP_SELF'] == "admin_carrusel_home.php"){

header("Location:admin_carrusel_home.php");

}

if(isset($_GET['logout'])){
session_unset();
session_destroy();

header("Location:index.php");

}

require_once('../../Connections/otono2011.php'); ?>
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

$maxRows_Recordset1 = 100;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_otono2011, $otono2011);
$query_Recordset1 = "SELECT * FROM carrusel_index ORDER BY orden ASC";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $otono2011) or die(mysql_error());

$query_max_min_order = mysql_query("SELECT MAX(orden) AS maximo_orden, MIN(orden) AS minimo_orden FROM carrusel_index", $otono2011);
$row_max_min_order = mysql_fetch_assoc($query_max_min_order);

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
<link href="../../css/estilos.css" rel="stylesheet" type="text/css" />
<title>Administrador Carrusel - Index</title>
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
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

function order_change(order, id, direction){
  
  $.post("change_order.php", {orden : order, id: id, direction: direction}, function(data){
    if(data == "success"){
      location.reload();
    } 
   // 
  })
}

</script>
</head>

<body>
  <table align="center" border="0" width="80%">
    <tr>
      <td align="center" width="85%">
        <p style="font-size:17px">Administrador Carrusel</p>
      </td>
      <td width="15%" align="right">
          <a href="logout.php"><FONT COLOR="red"><b>Cerrar Sesion</b></font></a>
      </td>
    </tr>
  </table>
  <br>
<table width="55%" border="0" align="center" cellpadding="5" cellspacing="0" class="tablas">
  <tr class="titulo_tabla">
    <td width="3%">Orden</td>
    <td width="211">Imagen</td>
    <td width="211">Titular</td>
    <td width="326">Destino</td>
    <td width="3%">Visible</td>
    <td width="10%" colspan="3"><input type="button" onclick="javascript:window.location='insert_carrusel.php'" value="Agregar Nuevo"/></td>
  </tr>
  <?php while($row_Recordset1 = mysql_fetch_assoc($Recordset1)){ ?>
    <tr>
      <td align="center"><?php if($row_Recordset1['orden'] != $row_max_min_order['minimo_orden']){ ?><a href="#" onclick="order_change(<?php echo $row_Recordset1['orden']; ?>, <?php echo $row_Recordset1['id_carrusel_index']; ?>, 0)">&#x25B2;</a><?php } ?><br /><?php echo $row_Recordset1['orden']; ?><br /><?php if($row_Recordset1['orden'] != $row_max_min_order['maximo_orden']){ ?><a href="#" onclick="order_change(<?php echo $row_Recordset1['orden']; ?>, <?php echo $row_Recordset1['id_carrusel_index']; ?>, 1)">&#x25BC;</a><?php } ?></td>
      <td width="25%"><img src="../../otono_2011/imagenes/carrusel/<?php echo $row_Recordset1['imagen_carrusel']; ?>" width="100%"/></td>
      <td><?php echo utf8_encode($row_Recordset1['titulo']); ?></td>
      <td><a href="<?php echo $row_Recordset1['destino']; ?>" target="_blank"><?php echo $row_Recordset1['destino']; ?></a></td>
      <td align="center"><font color="red"><b><?php echo $row_Recordset1['visible']; ?></b></font></td>
      <td align="center" width="5%">
        <form action="editar.php" method="post">
          <input type="submit" value="Editar"/>
          <input type="hidden" name="id" value="<?php echo $row_Recordset1['id_carrusel_index']; ?>"/>
        </form>

      <td align="center" width="5%">
        <form action="borra1.php" onsubmit="return confirmDeletion();" method="post">
             <input type="submit" value="Eliminar"/>
             <input type="hidden" name="imagen" value="<?php echo $row_Recordset1['imagen_carrusel']; ?>"/>
             <input type="hidden" name="id" value="<?php echo $row_Recordset1['id_carrusel_index']; ?>"/>
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