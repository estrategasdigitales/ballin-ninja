<?php require_once('restrict_access.php'); ?>
<?php require_once('Connections/des_preinscritos.php'); ?>
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

$maxRows_preinscritos = 20;
$pageNum_preinscritos = 0;
if (isset($_GET['pageNum_preinscritos'])) {
  $pageNum_preinscritos = $_GET['pageNum_preinscritos'];
}
$startRow_preinscritos = $pageNum_preinscritos * $maxRows_preinscritos;

//query para obtener el total de preinscritos
mysql_select_db($database_des_preinscritos, $des_preinscritos);	
$query_preinscritos = "SELECT * FROM sp_preinscritos WHERE id_preinscrito IN
(SELECT id_preinscrito FROM sp_pasos_status WHERE sp_preinscritos.id_preinscrito = sp_pasos_status.id_preinscrito AND sp_pasos_status.pago_realizado = 0 AND sp_pasos_status.caso_cerrado = 0 AND sp_pasos_status.caso_inconcluso = 0 AND sp_pasos_status.informes = 0 AND sp_pasos_status.envio_decse = 1 AND sp_pasos_status.envio_claves = 1)  ORDER BY sp_preinscritos.fecha_envio_decse DESC";
$query_limit_preinscritos = sprintf("%s LIMIT %d, %d", $query_preinscritos, $startRow_preinscritos, $maxRows_preinscritos);
$preinscritos = mysql_query($query_limit_preinscritos, $des_preinscritos) or die(mysql_error());
$row_preinscritos = mysql_fetch_assoc($preinscritos);

if (isset($_GET['totalRows_preinscritos'])) {
  $totalRows_preinscritos = $_GET['totalRows_preinscritos'];
} else {
  $all_preinscritos = mysql_query($query_preinscritos);
  $totalRows_preinscritos = mysql_num_rows($all_preinscritos);
}
$totalPages_preinscritos = ceil($totalRows_preinscritos/$maxRows_preinscritos)-1;

$queryString_preinscritos = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_preinscritos") == false && 
        stristr($param, "totalRows_preinscritos") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_preinscritos = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_preinscritos = sprintf("&totalRows_preinscritos=%d%s", $totalRows_preinscritos, $queryString_preinscritos);


//CODIGO PARA QUE ASIGNE FORMATO LOCAL A LAS FECHAS
setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
//++++++++++++++++++++
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/main_decse.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Sistema de Seguimiento - Inscritos</title>
<!-- InstanceEndEditable -->
<link href="estilos.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="colorbox/colorbox.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="colorbox/jquery.colorbox.js"></script>
<script>
function confirmar(){
	return confirm('¿Está seguro/a que desea eliminar este registro? Toda la información y documentos asociados a este registro serán borrados.');
}
$(document).ready(function(){
	//Examples of how to assign the ColorBox event to elements
	$(".group1").colorbox({iframe:true, width:"850px", height:"80%"});
});
			
function load_programs(id_discipline)
{
	//alert(id_discipline);
	$('td#td_programas').html('Cargando...');
if (id_discipline=="")
  {
  document.getElementById('td_programas').innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    //document.getElementById(div).innerHTML=xmlhttp.responseText;
	//alert(xmlhttp.responseText);
	$('td#td_programas').html(xmlhttp.responseText);		
	
    }
  }
xmlhttp.open("GET",'ajax_programas.php?id_discipline='+id_discipline,true);
xmlhttp.send();
}
</script>
</script>
<!-- InstanceBeginEditable name="head" -->
<script>
function simple_tooltip(target_items, name){
 $(target_items).each(function(i){
		$("body").append("<div class='"+name+"' id='"+name+i+"'><p>"+$(this).attr('title')+"</p></div>");
		var my_tooltip = $("#"+name+i);

		$(this).removeAttr("title").mouseover(function(){
				my_tooltip.css({opacity:1.0, display:"none"}).fadeIn(400);
		}).mousemove(function(kmouse){
				my_tooltip.css({left:kmouse.pageX+10, top:kmouse.pageY+10});
		}).mouseout(function(){
				my_tooltip.fadeOut(200);
		});
	});
}
$(document).ready(function() {
	
	simple_tooltip("a.tooltip_a","tooltip");

});
</script>
<style>
.tooltip{
    position:absolute;
    z-index:999;
    left:-9999px;
    background-color:#dedede;
    padding:2px;
    border:1px solid #fff;
	border-radius:5px;
	width:200px;
}

.tooltip p{
    margin:0;
    padding:0;
    color:#fff;
    background-color:#F00;
    padding:5px;
	border-radius:5px;
}
</style>
<!-- InstanceEndEditable -->
</head>

<body>
<div id="container">
  <div id="header">
    <div id="logos">
      <div style="float:left;"><a href="http://uia.mx/" target="_blank"><img src="imagenes/logo_UIA.jpg" alt="logo" width="100" height="78" border="0" /></a> <a href="preinscritos.php"><img src="imagenes/logo_DEC.jpg" alt="DEC" width="90" height="78" border="0" /></a></div>
      <div style="float:left; margin:10px;" >
        <h1>Sistema de seguimiento de preinscripciones</h1>
        <h2>Administrador DECSE | <a href="logout.php">Cerrar sesi&oacute;n</a></h2>
      </div>
      <div id="home_link"></div>
    </div>
    <div class="espacio"> </div>
  </div>
  <div class="sombra"> </div> 
  <div id="menu">
	  <div id="menu_int">
		<ul>
		  <li><? if($_SERVER['PHP_SELF'] == '/s_preiniscritos/decse.php'){ ?><span style="color:#F00;">Preinscritos</span><? }else{ ?><a href="decse.php?<? echo $_SERVER['QUERY_STRING']?>">Preinscritos</a><? } ?></li>
		  <li><? if($_SERVER['PHP_SELF'] == '/s_preiniscritos/decse_inscritos.php'){ ?><span style="color:#F00;">Inscritos</span><? }else{ ?><a href="decse_inscritos.php?<? echo $_SERVER['QUERY_STRING']?>">Inscritos</a><? } ?></li>
		</ul>
	  </div>
	  <div id="buscador">
		<form name="buscador" id="buscador" action="decse_resultados_busqueda.php" method="get">
			<input name="qs" type="text" id="qs" placeholder="Todas las &aacute;reas" value="" size="20" />
			<input type="submit" name="enviar" id="enviar" value="Buscar">
		</form>
	  </div>
	</div>
    <div class="sombra"> </div>
	<div class="espacio"></div>
  <!-- InstanceBeginEditable name="contenido" -->
  
<table width="100%" border="0" cellpadding="5" cellspacing="0" class="tablas">
	<tr class="titulo_tabla">
		<td align="center" valign="middle" class="celdas">Nombre</td>
		<td align="center" valign="middle" class="celdas">Programa de interés</td>
		<td align="center" valign="middle" class="celdas">Fecha de registro</td>
		<td align="center" valign="middle" class="celdas">Primer contacto</td>
		<td align="center" valign="middle" class="celdas">Documentos</td>
		<td align="center" valign="middle" class="celdas">Envío de claves</td>
		<td align="center" valign="middle" class="celdas">Pago realizado</td>
		</tr>
	<?php 
	
	$cont = 0;
	
	do { 
	
		//query para obtener el nombre del programa
		mysql_select_db($database_des_preinscritos, $des_preinscritos);
		$query_programa = "SELECT program_name, program_type FROM site_programs WHERE id_program = ".$row_preinscritos['id_program'];
		$programa = mysql_query($query_programa, $des_preinscritos) or die(mysql_error());
		$row_programa = mysql_fetch_assoc($programa);
		//query para sacar el paso y el comentario donde se encuentra el interesado		
		mysql_select_db($database_des_preinscritos, $des_preinscritos);
		$query_paso = "SELECT * FROM sp_pasos_status WHERE id_preinscrito = ".$row_preinscritos['id_preinscrito'];
		$paso = mysql_query($query_paso, $des_preinscritos) or die(mysql_error());
		$row_paso = mysql_fetch_assoc($paso);
		//query para sacar los comentarios por paso	
		//mysql_select_db($database_des_preinscritos, $des_preinscritos);
		$query_comment_paso = "SELECT * FROM sp_comentarios WHERE id_preinscrito = ".$row_preinscritos['id_preinscrito'];
		$comment_paso = mysql_query($query_comment_paso, $des_preinscritos) or die(mysql_error());
		$row_comment_paso = mysql_fetch_assoc($comment_paso);
	
		$comment_1 = '';
		$comment_2 = '';
		$comment_3 = '';
		$comment_4 = '';
		
		do{
			switch($row_comment_paso['id_paso']){
				case 1:
					$comment_1 = $row_comment_paso['comentario'];
				break;
				case 2:
					$comment_2 = $row_comment_paso['comentario'];
				break;
				case 3:
					$comment_3 = $row_comment_paso['comentario'];
				break;
				case 4:
					$comment_4 = $row_comment_paso['comentario'];
				break;
			}
		}while($row_comment_paso = mysql_fetch_assoc($comment_paso));
		//--------
		if($cont % 2){$bg='bgcolor="#F1F1F1"';}else{$bg = '';}
		?>
		
		<tr <? echo $bg; ?>>
			<td align="left" valign="middle" class="celdas"><strong>
				<? if($row_paso['comentario_general'] != ''){echo '<a href="#" title="'.$row_paso['comentario_general'].'" class="tooltip_a">||</a> ';} ?>
				<a class="group1" href="preinscrito_detalle_decse_a.php?id_preinscrito=<?php echo $row_preinscritos['id_preinscrito']; ?>"><?php echo $row_preinscritos['a_paterno'] .' '. $row_preinscritos['a_materno'] .', '. $row_preinscritos['nombre']; ?></a></strong></td>
			<td align="left" valign="middle" class="celdas"><?php echo $row_programa['program_type'].' - '.$row_programa['program_name']; ?></td>
			<td align="center" valign="middle" class="celdas"><? echo strftime("%d.%B.%Y", strtotime($row_preinscritos['fecha_registro'])); ?></td>
			<td align="center" valign="middle" class="celdas"><? if($row_paso['primer_contacto'] == 1){echo 'x';} if($comment_1 != ''){echo ' <a href="#" title="'.$comment_1.'" class="tooltip_a">||</a>';} ?></td>
			<td align="center" valign="middle" class="celdas"><? if($row_paso['documentos'] == 1){echo 'x';} if($comment_2 != ''){echo ' <a href="#" title="'.$comment_2.'" class="tooltip_a">||</a>';} ?></td>
			<td align="center" valign="middle" class="celdas"><? if($row_paso['envio_claves'] == 1){echo 'x';} if($comment_3 != ''){echo ' <a href="#" title="'.$comment_3.'" class="tooltip_a">||</a>';} ?></td>
			<td align="center" valign="middle" class="celdas"><? if($row_paso['pago_realizado'] == 1){echo 'x';} if($comment_4 != ''){echo ' <a href="#" title="'.$comment_4.'" class="tooltip_a">||</a>';} ?></td>
		</tr>
	<?php 
	
	$cont++;
	
	} while ($row_preinscritos = mysql_fetch_assoc($preinscritos)); ?>
</table>
<table width="100%" border="0">
	<tr>
		<td align="right" valign="middle"><strong>
			Registros <?php echo ($startRow_preinscritos + 1) ?> al <?php echo min($startRow_preinscritos + $maxRows_preinscritos, $totalRows_preinscritos) ?> de <?php echo $totalRows_preinscritos ?>
		</strong></td>
		<td align="right" valign="middle"><?php if ($pageNum_preinscritos > 0) { // Show if not first page ?>
				<a href="<?php printf("%s?pageNum_preinscritos=%d%s", $currentPage, 0, $queryString_preinscritos); ?>"><img src="First.gif" border="0" /></a>
			<?php } // Show if not first page ?></td>
		<td align="right" valign="middle"><?php if ($pageNum_preinscritos > 0) { // Show if not first page ?>
				<a href="<?php printf("%s?pageNum_preinscritos=%d%s", $currentPage, max(0, $pageNum_preinscritos - 1), $queryString_preinscritos); ?>"><img src="Previous.gif" border="0" /></a>
			<?php } // Show if not first page ?></td>
		<td align="right" valign="middle"><?php if ($pageNum_preinscritos < $totalPages_preinscritos) { // Show if not last page ?>
				<a href="<?php printf("%s?pageNum_preinscritos=%d%s", $currentPage, min($totalPages_preinscritos, $pageNum_preinscritos + 1), $queryString_preinscritos); ?>"><img src="Next.gif" border="0" /></a>
			<?php } // Show if not last page ?></td>
		<td align="right" valign="middle"><?php if ($pageNum_preinscritos < $totalPages_preinscritos) { // Show if not last page ?>
				<a href="<?php printf("%s?pageNum_preinscritos=%d%s", $currentPage, $totalPages_preinscritos, $queryString_preinscritos); ?>"><img src="Last.gif" border="0" /></a>
			<?php } // Show if not last page ?></td>
	</tr>
</table>
<!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($preinscritos);
?>
