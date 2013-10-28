<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
	$(".group1").colorbox({iframe:true, width:"850px", height:"90%"});
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
      <div id="home_link">
        <form action="<? echo $_SERVER['PHP_SELF']; ?>" method="get" name="form2" id="form2">
          <table width="100%" cellspacing="0" cellpadding="0" border="0">
            <tbody>
              <tr>
                <td valign="top" align="right">
					<!-- comienza select de áreas -->
					<label>Área:
						<select onchange="load_programs(this.value);" id="id_discipline" name="id_discipline" class="contenido_diplo">
							<option value="0" selected="selected">Todas mis &aacute;reas</option>
							<? do{ 
							//query para obtener las areas a las que puede acceder el usuario logeado
							mysql_select_db($database_des_preinscritos, $des_preinscritos);
							$query_areas_select = "SELECT discipline FROM disciplines WHERE id_discipline = ".$row_disciplinas['id_discipline'];
							$areas_select = mysql_query($query_areas_select, $des_preinscritos) or die(mysql_error());
							$row_areas_select = mysql_fetch_assoc($areas_select);
							?>
							<option value="<? echo $row_disciplinas['id_discipline']; ?>" <? if($row_disciplinas['id_discipline'] == $_GET['id_discipline']){ echo 'selected="selected"'; }?>><? echo utf8_encode($row_areas_select['discipline']); ?></option>
							<? }while($row_disciplinas = mysql_fetch_assoc($disciplinas)); ?>
						  
						</select>
					  </label>
				  	<!-- termina select de areas -->
				</td>
              </tr>
              <tr>
			  	<!-- TD para desplegar el resultado del AJAX -->
                <td valign="top" align="right" id="td_programas">
				<select id="id_program" name="id_program" class="contenido_diplo" style="max-width:350px; width:350px;">
                    <option value="0">Todos los programas</option>
                    <option disabled="disabled">-------DIPLOMADOS-------</option>
					<? 
					$tipo_ant = 'diplomado';
					do{
						$tipo = $row_programas['program_type'];
						if($tipo != $tipo_ant){echo '<option disabled="disabled">-----CURSOS---</option>';}
						echo '<option value="'.$row_programas['id_program'].'"';
						if($row_programas['id_program'] == $_GET['id_program']){echo ' selected="selected"';}
						echo '>'.utf8_encode($row_programas['program_name']).'</option>';
						$tipo_ant = $tipo;
					} while($row_programas = mysql_fetch_assoc($programas)); ?>
                  </select>
				</td>
				<!-- finaliza TD -->
              </tr>
              <tr>
              	<td valign="top" align="right"><input type="submit" name="filtrar" id="filtrar" value="Filtrar" /></td>
              	</tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>
    <div class="espacio"> </div>
  </div>
<div class="sombra"> </div>
 
  <div id="menu">
	  <div id="menu_int">
		<ul>
		  <li><? if($_SERVER['PHP_SELF'] == '/s_preiniscritos/preinscritos.php'){ ?><span style="color:#F00;">Preinscritos</span><? }else{ ?><a href="preinscritos.php?<? echo $_SERVER['QUERY_STRING']?>">Preinscritos</a><? } ?></li>
		  <li><? if($_SERVER['PHP_SELF'] == '/s_preiniscritos/inscritos.php'){ ?><span style="color:#F00;">Inscritos</span><? }else{ ?><a href="inscritos.php?<? echo $_SERVER['QUERY_STRING']?>">Inscritos</a><? } ?></li>
		  <li><? if($_SERVER['PHP_SELF'] == '/s_preiniscritos/casos_cerrados.php'){ ?><span style="color:#F00;">Casos cerrados</span>
			<? }else{ ?><a href="casos_cerrados.php?<? echo $_SERVER['QUERY_STRING']?>">Casos cerrados</a><? } ?></li>
		  <li><? if($_SERVER['PHP_SELF'] == '/s_preiniscritos/casos_inconclusos.php'){ ?><span style="color:#F00;">Casos inconclusos</span>
			<? }else{ ?><a href="casos_inconclusos.php?<? echo $_SERVER['QUERY_STRING']?>">Casos inconclusos</a><? } ?></li>
		  <li><? if($_SERVER['PHP_SELF'] == '/s_preiniscritos/informes.php'){ ?><span style="color:#F00;">Informes</span>
			<? }else{ ?><a href="informes.php?<? echo $_SERVER['QUERY_STRING']?>">Informes</a><? } ?></li>
		</ul>
		</div>
		<div id="buscador">
		<form name="buscador" id="buscador" action="resultados_busqueda.php" method="get">
			<a href="../graficas/graficas_area_programa.php">Gr&aacute;ficas</a>
			<a href="../export_to_xls.php">Exportar a Excel</a>
			<input name="qs" type="text" id="qs" placeholder="Todas las &aacute;reas" value="" size="20" />
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
