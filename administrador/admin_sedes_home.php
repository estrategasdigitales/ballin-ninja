<?php require_once('../Connections/otono2011.php');

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

$currentPage = "admin_sedes_home.php";

$maxRows_programas = 20;
$pageNum_programas = 0;
if (isset($_GET['pageNum_programas'])) {
  $pageNum_programas = $_GET['pageNum_programas'];
}
$startRow_programas = $pageNum_programas * $maxRows_programas;  

mysql_select_db($database_otono2011, $otono2011);
$sql = mysql_query('SELECT * FROM site_sedes ORDER BY id_sede', $otono2011);
$row_sql = mysql_fetch_assoc($sql);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/temp_admin.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO 8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Educaci&oacute;n Continua</title>
<!-- InstanceEndEditable -->
<link href="../css/estilos.css" rel="stylesheet"
        type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>

function eliminar_prog(id_programa){
  var r = confirm('\u00BFEst\u00E1s seguro que deseas eliminar este programa?');
  if(r == true){
    window.location="delete_sede.php?id_sede="+id_programa;
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

 <h1> Sedes </h1>
<table  border="0" cellpadding="5" cellspacing="0" class="tablas" align="center">
	<tr class="titulo_tabla">
		<td>Sede</td>
		<td colspan="2">
        <input type="button" value="Nueva Sede" onclick="javascript:window.location='sede_nueva.php'">
    </td>
	  </tr>
	<?php $cont = 0; do { $cont++; ?>
		<tr>
			<td><?php echo $row_sql['nombre_sede']; ?></td>
			<td><a href="edit_sede.php?id_sede=<?php echo $row_sql['id_sede']; ?>">Editar</a></td>
			<td><a onclick="eliminar_prog(<?php echo $row_sql['id_sede']; ?>);" href="#">Eliminar</a></td>
		</tr>
		<?php } while ($row_sql = mysql_fetch_assoc($sql)); ?>
</table>
<!--table border="0" align="center">
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
</table-->
<!-- InstanceEndEditable --></div>
  <div id="separador" style=" clear:both; height:20px;"></div>
  
</div>
</body>
<!-- InstanceEnd --></html>