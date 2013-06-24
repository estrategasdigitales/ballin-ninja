<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<!-- TemplateBeginEditable name="doctitle" -->
<title>Untitled Document</title>
<!-- TemplateEndEditable -->
<link href="../estilos.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../colorbox/colorbox.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="../colorbox/jquery.colorbox.js"></script>
<script>
function confirmar(){
	return confirm('¿Está seguro/a que desea eliminar este registro? Toda la información y documentos asociados a este registro serán borrados.');
}
$(document).ready(function(){
	//Examples of how to assign the ColorBox event to elements
	$(".group1").colorbox({iframe:true, width:"540px", height:"80%"});
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
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
</head>

<body>
<div id="container">
  <div id="header">
    <div id="logos">
      <div style="float:left;"><a href="http://uia.mx/" target="_blank"><img src="../imagenes/logo_UIA.jpg" alt="logo" width="100" height="78" border="0" /></a> <a href="../preinscritos.php"><img src="../imagenes/logo_DEC.jpg" alt="DEC" width="90" height="78" border="0" /></a></div>
      <div style="float:left; margin:10px;" >
        <h1>Sistema de seguimiento de preinscripciones</h1>
        <h2>Administrador | <a href="../logout.php">Cerrar sesi&oacute;n</a></h2>
      </div>
      <div id="home_link"></div>
    </div>
    <div class="espacio"> </div>
  </div>
 <div class="sombra"> </div>
  <div id="menu">
	  <div id="menu_int">
		<ul>
		  <li><? if($_SERVER['PHP_SELF'] == '/s_preiniscritos/preinscritos.php'){ ?><span style="color:#F00;">Preinscritos</span><? }else{ ?><a href="../preinscritos.php?<? echo $_SERVER['QUERY_STRING']?>">Preinscritos</a><? } ?></li>
		  <li><? if($_SERVER['PHP_SELF'] == '/s_preiniscritos/inscritos.php'){ ?><span style="color:#F00;">Inscritos</span><? }else{ ?><a href="../inscritos.php?<? echo $_SERVER['QUERY_STRING']?>">Inscritos</a><? } ?></li>
		  <li><? if($_SERVER['PHP_SELF'] == '/s_preiniscritos/casos_cerrados.php'){ ?><span style="color:#F00;">Casos cerrados</span>
			<? }else{ ?><a href="../casos_cerrados.php?<? echo $_SERVER['QUERY_STRING']?>">Casos cerrados</a><? } ?></li>
		  <li><? if($_SERVER['PHP_SELF'] == '/s_preiniscritos/casos_inconclusos.php'){ ?><span style="color:#F00;">Casos inconclusos</span>
			<? }else{ ?><a href="../casos_inconclusos.php?<? echo $_SERVER['QUERY_STRING']?>">Casos inconclusos</a><? } ?></li>
		  <li><? if($_SERVER['PHP_SELF'] == '/s_preiniscritos/informes.php'){ ?><span style="color:#F00;">Informes</span>
			<? }else{ ?><a href="../informes.php?<? echo $_SERVER['QUERY_STRING']?>">Informes</a><? } ?></li>
		</ul>
		</div>
		<div id="buscador">
		<form name="buscador" id="buscador" action="resultados_busqueda.php" method="get">
			<a href="../graficas/graficas_area_programa.php">Gr&aacute;ficas</a>
			<a href="../export_to_xls.php">Exportar a Excel</a>
			<input name="qs" type="text" id="qs" value="" placeholder="Todas las &aacute;reas" />
			<input type="submit" name="enviar" id="enviar" value="Buscar">
		</form>
	  </div>
	</div>
    <div class="sombra"> </div>
	<div class="espacio"></div>
	
  <!-- TemplateBeginEditable name="contenido" -->
  
  <h3>Arquitectura + Diplomado Interiores + Preinscritos </h3>
  <table width="100%" border="0" cellpadding="5" cellspacing="0" class="tablas">
    <tr class="titulo_tabla">
      <td>Nombre</td>
      <td>Programa de inter&eacute;s </td>
      <td>Fecha de preinscripci&oacute;n</td>
      <td>Primer Contacto</td>
      <td>Negociaci&oacute;n acad&eacute;mica</td>
      <td>Documentos</td>
      <td>Env&iacute;o de claves</td>
      <td>Pago Realizado</td>
      <td>&nbsp;</td>
    </tr>
    <tr class="blanco_tabla">
      <td>Taylor Pressman, Maura Adrienne </td>
      <td>Diplomado - Dise&ntilde;o de espacios interiores </td>
      <td>10/ene/12</td>
      <td ><img src="../imagenes/greenBall.jpg" width="15" height="15" /></td>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td>&nbsp;</td>
      <td >&nbsp;</td>
      <td><input type="submit" name="eliminar" id="eliminar" value="Eliminar"></td>
    </tr>
    <tr class="gris_tabla">
      <td>Gomez, Pedro </td>
      <td>Diplomado - Dise&ntilde;o de espacios interiores </td>
      <td>10/ene/12</td>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td ><img src="../imagenes/greenBall.jpg" width="15" height="15" /></td>
      <td>&nbsp;</td>
      <td >&nbsp;</td>
      <td><input type="submit" name="eliminar" id="eliminar" value="Eliminar"></td>
    </tr>
    <tr class="blanco_tabla">
      <td>Taylor Pressman, Maura Adrienne </td>
      <td>Diplomado - Dise&ntilde;o de espacios interiores </td>
      <td>10/ene/12</td>
      <td ><img src="../imagenes/greenBall.jpg" width="15" height="15" /></td>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td>&nbsp;</td>
      <td >&nbsp;</td>
      <td><input type="submit" name="eliminar" id="eliminar" value="Eliminar"></td>
    </tr>
  </table>
  <div class="espacio"> </div>
  <ul id="pagination-flickr">
    <li class="previous-off">« Anterior</li>
    <li class="active">1</li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li><a href="#">6</a></li>
    <li><a href="#">7</a></li>
    <li class="next"><a href="#">Siguiente &raquo;</a></li>
  </ul>
  
  <!-- TemplateEndEditable -->
</div>
</body>
</html>
