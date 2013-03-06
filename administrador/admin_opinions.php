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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_opinions = 6;
$pageNum_opinions = 0;
if (isset($_GET['pageNum_opinions'])) {
  $pageNum_opinions = $_GET['pageNum_opinions'];
}
$startRow_opinions = $pageNum_opinions * $maxRows_opinions;

mysql_select_db($database_otono2011, $otono2011);
$query_opinions = "SELECT * FROM community_opinions ORDER BY date DESC";
$query_limit_opinions = sprintf("%s LIMIT %d, %d", $query_opinions, $startRow_opinions, $maxRows_opinions);
$opinions = mysql_query($query_limit_opinions, $otono2011) or die(mysql_error());
$row_opinions = mysql_fetch_assoc($opinions);

if (isset($_GET['totalRows_opinions'])) {
  $totalRows_opinions = $_GET['totalRows_opinions'];
} else {
  $all_opinions = mysql_query($query_opinions);
  $totalRows_opinions = mysql_num_rows($all_opinions);
}
$totalPages_opinions = ceil($totalRows_opinions/$maxRows_opinions)-1;

$queryString_opinions = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_opinions") == false && 
        stristr($param, "totalRows_opinions") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_opinions = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_opinions = sprintf("&totalRows_opinions=%d%s", $totalRows_opinions, $queryString_opinions);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/temp_admin.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO 8859-1"
        />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Educación Continua / Administrador</title>
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
.titulo_tablas{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	color:#333;
	padding-left:5px;
}
-->
</style>
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
          <h2>Artículos</h2>
          <ul>
            <li><a href="admin_discipline_articles.php?id_discipline=1">Disciplinas</a> </li>
            <li><a href="admin_media_articles.php">La DEC en los Medios</a> </li>
            <li><a href="admin_opinions.php">La Comunidad Ibero Opina</a> </li>
            <li><a href="admin_weekly_articles.php">Artículos semanales</a> </li>
          </ul>
          <p>&nbsp;</p>
        </div>
      </div>
    </div>
  </div>
  <div id="contenedor_irregular_index" style="width:800px;"><!-- InstanceBeginEditable name="contenido" -->
            <h1>Artículos - La comunidad Ibero Opina
            </h1>
            <form name="form_opinions" id="form_opinions" method="get">
          <table width="800" border="0" align="left" cellpadding="5" cellspacing="0" class="tablas">
        <tr class="titulo_tabla">
          <td colspan="2" align="center"> Opiniones <?php echo ($startRow_opinions + 1) ?> - <?php echo min($startRow_opinions + $maxRows_opinions, $totalRows_opinions) ?> de <?php echo $totalRows_opinions ?></td>
          <td colspan="2" align="center"><input name="agrega" type="button" value="Agregar Nuevo" title="Agregar Nuevo"  onclick="window.location='insert_opinion.php'"/></td>
          </tr>
        <?php do { ?>
          <tr>
    <td width="83" height="70" align="center" valign="middle"><img src="../imagenes/uploads/community_opinions/thumbnails/<?php echo $row_opinions['thumbnail'];?>" width="60" /></td>
    <td width="510"><?php echo $row_opinions['full_name'];?><br />
      <?php echo $row_opinions['job_position'];?></td>
    <td width="65" align="center"><input name="edita" type="button" value="Editar" onclick="window.location='update_opinion.php?id_opinion=<?php echo $row_opinions['id_opinion'];?>'"/></td>
    <td width="65" align="center">
    <input name="elimina" type="button" value="Eliminar"   onclick="window.location='delete_opinions.php?id_opinion=<?php echo $row_opinions['id_opinion'];?>'"/> 
      </td>
  </tr>
          <?php } while ($row_opinions = mysql_fetch_assoc($opinions)); ?>
       </table>
        </form><p>&nbsp;</p>
        <table border="0" align="left">
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><?php if ($pageNum_opinions > 0) { // Show if not first page ?>
                      <a href="<?php printf("%s?pageNum_opinions=%d%s", $currentPage, 0, $queryString_opinions); ?>"><img src="First.gif" border="0" /></a>
                  <?php } // Show if not first page ?></td>
                  <td><?php if ($pageNum_opinions > 0) { // Show if not first page ?>
                      <a href="<?php printf("%s?pageNum_opinions=%d%s", $currentPage, max(0, $pageNum_opinions - 1), $queryString_opinions); ?>"><img src="Previous.gif" border="0" /></a>
                  <?php } // Show if not first page ?></td>
                  <td><?php if ($pageNum_opinions < $totalPages_opinions) { // Show if not last page ?>
                      <a href="<?php printf("%s?pageNum_opinions=%d%s", $currentPage, min($totalPages_opinions, $pageNum_opinions + 1), $queryString_opinions); ?>"><img src="Next.gif" border="0" /></a>
                  <?php } // Show if not last page ?></td>
                  <td><?php if ($pageNum_opinions < $totalPages_opinions) { // Show if not last page ?>
                      <a href="<?php printf("%s?pageNum_opinions=%d%s", $currentPage, $totalPages_opinions, $queryString_opinions); ?>"><img src="Last.gif" border="0" /></a>
                  <?php } // Show if not last page ?></td>
                </tr>
        </table>
        <!-- InstanceEndEditable --></div>
  <div id="separador" style=" clear:both; height:20px;"></div>
  
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($opinions);
?>
