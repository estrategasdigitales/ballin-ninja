<?php require_once('Connections/otono2011.php'); ?>
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

$hoy = date('Ymd');


mysql_select_db($database_otono2011, $otono2011);
$query_programas_izq = "SELECT site_programs.id_discipline, site_programs.id_program, site_programs.imagen, site_programs.program_name AS programa, site_fechas_ini.fecha AS fecha_inicio FROM site_programs, site_fechas_ini WHERE site_programs.id_program=site_fechas_ini.id_program AND site_fechas_ini.publicado=1 ORDER BY RAND() LIMIT 2";
$programas_izq = mysql_query($query_programas_izq, $otono2011) or die(mysql_error());
$row_programas_izq = mysql_fetch_assoc($programas_izq);
$totalRows_programas_izq = mysql_num_rows($programas_izq);

mysql_select_db($database_otono2011, $otono2011);
$query_programas_der = "SELECT site_fechas_idiomas.id_program AS id_program_idioma, site_fechas_idiomas.nivel, site_fechas_idiomas.inicio, (select site_programs.imagen FROM site_programs WHERE site_fechas_idiomas.id_program=site_programs.id_program) AS imagen_idioma FROM site_fechas_idiomas, site_programs WHERE site_fechas_idiomas.inicio > ".$hoy." ORDER BY RAND() LIMIT 2";
$programas_der = mysql_query($query_programas_der, $otono2011) or die(mysql_error());
$row_programas_der = mysql_fetch_assoc($programas_der);
$totalRows_programas_der = mysql_num_rows($programas_der);

mysql_select_db($database_otono2011, $otono2011);
$query_programas_izqb = "SELECT site_programs.id_discipline, site_programs.id_program, site_programs.imagen, site_programs.program_name AS programa, site_fechas_ini.fecha AS fecha_inicio FROM site_programs, site_fechas_ini WHERE site_programs.id_program=site_fechas_ini.id_program AND site_fechas_ini.publicado=1 ORDER BY RAND() LIMIT 3";
$programas_izqb = mysql_query($query_programas_izqb, $otono2011) or die(mysql_error());
$row_programas_izqb = mysql_fetch_assoc($programas_izqb);
$totalRows_programas_izqb = mysql_num_rows($programas_izqb);

mysql_select_db($database_otono2011, $otono2011);
$query_ad = "SELECT * FROM ads ORDER BY `date` DESC LIMIT 0, 1";
$ad = mysql_query($query_ad, $otono2011) or die(mysql_error());
$row_ad = mysql_fetch_assoc($ad);
$totalRows_ad = mysql_num_rows($ad);

function WordLimiter($text,$limit,$word_count){
	$limit = $limit - $word_count;
	$explode = explode(' ',$text);
	$string  = '';
	$dots = '...';
	if(count($explode) <= $limit){
		$dots = '';
		}
	for($i=0;$i<$limit;$i++){
		$string .= $explode[$i]." ";
	}
	if ($dots) {
		$string = substr($string, 0, strlen($string));
		}
	return $string.$dots;
}

$word_count = 0;
function count_words($str) 
{
	$no = count(explode(" ",$str));
	return $no;
}
setlocale(LC_ALL,"es_ES@euro","es_ES","esp");

mysql_select_db($database_otono2011, $otono2011);
$query_search = "SELECT * FROM site_programs WHERE program_name LIKE '%".$_POST['buscar']."%' OR description LIKE '%".$_POST['buscar']."%' OR id_discipline IN (SELECT id_discipline FROM disciplines WHERE discipline LIKE '%".$_POST['buscar']."%') AND cost_inscripcion IS NOT NULL AND cancelado = 0 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE periodo = 'o') ORDER BY program_name ASC LIMIT 0,20";
$search = mysql_query($query_search, $otono2011) or die(mysql_error());
$row_search = mysql_fetch_assoc($search);
$totalRows_search = mysql_num_rows($search);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/index.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Untitled Document</title>
<!-- InstanceEndEditable -->
<link href="css/estilos.css" rel="stylesheet" type="text/css" />
<!------ Google Analytics ------>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-23217985-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<script type="text/javascript">

	var lastHeight = 0;

	function resizeHelperIframe()
	{	
		// Gets the new page height
		var newHeight = document.body.offsetHeight; //document.body.scrollHeight;
		
		if(lastHeight != newHeight){
			
			// New height is going to the parent through the helperIframe.
			var helperIframe = document.getElementById('helperIframe');
			helperIframe.contentWindow.location.replace('http://www.diplomados.uia.mx/helper.html#' + newHeight);
			
			lastHeight = newHeight;
		}
	}
	
	window.onload = function(event) {
		
		resizeHelperIframe();
		
	}
		
</script>
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>
<body>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<iframe id="helperIframe" src='http://www.diplomados.uia.mx/helper.html#1000' height='0' width='0' frameborder='0'></iframe>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<?php switch($_GET['id_discipline']){
		 case 1:
		 $imagen = 'arquitectura';
		 $header = 'verde';
		 $descargable = 'arquitectura';
		 break;
		 case 2:
		 $imagen = 'arte';
		 $header = 'verde';
		 $descargable = 'arte';
		 break;
		 case 3:
		 $imagen = 'diseno';
		 $header = 'verde';
		 $descargable = 'diseno';
		 break;
		 case 4:
		 $imagen = 'comunicacion';
		 $header = 'gris';
		 $descargable = 'comunicacion';
		 break;
		 case 5:
		 $imagen = 'desarrollohumano';
		 $header = 'gris';
		 $descargable = 'dh';
		 break;
		 case 6:
		 $imagen = 'salud';
		 $header = 'gris';
		 $descargable = 'salud';
		 break;
		 case 7:
		 $imagen = 'politica';
		 $header = 'gris';
		 $descargable = 'politica';
		 break;
		 case 8:
		 $imagen = 'negocios';
		 $header = 'turquesa';
		 $descargable = 'negocios';
		 break;
		 case 9:
		 $imagen = 'tecnologia';
		 $header = 'turquesa';
		 $descargable = 'tecnologia';
		 break;
		 case 10:
		 $imagen = 'humanidades';
		 $header = 'morado';
		 $descargable = 'humanidades';
		 break;
		 case 11:
		 $imagen = 'gastronomia';
		 $header = 'amarillo';
		 $descargable = 'gastronomia';
		 break;
		 case 12:
		 $imagen = 'prepaAbierta';
		 $header = 'rojo';
		 $descargable = 'prepa';
		 break;
		 case 13:
		 $imagen = 'xochitla';
		 $header = 'vc';
		 $descargable = 'xochitla';
		 break;
		 case 14:
		 $imagen = 'idiomas';
		 $header = 'rosa';
		 $descargable = 'idiomas';
		 break;
		 case 15:
		 $imagen = 'online';
		 $header = 'azul';
		 $descargable = 'online';
		 break;
		 case 16:
		 $imagen = 'atencionIntgralEmpresas';
		 $header = 'vc';
		 $descargable = 'empresas';
		 break;
		 case 17:
		 $imagen = 'atencionSectorPub';
		 $header = 'naranja';
		 $descargable = 'sP';
		 break;
		 case 18:
		 $imagen = 'creliogiosas';
		 $header = 'morado';
		 $descargable = 'cR';
		 break;
		 case 19:
		 $imagen = 'casabarragan';
		 $header = 'verde';
		 $descargable = 'casa_barragan';
		 break; 
		  case 20:
		 $imagen = 'lofft';
		 $header = 'rojo';
		 $descargable = 'casa_barragan';
		 break;
		 case 23:
		 $imagen = 'harvard';
		 $header = 'vino';
		 $descargable = 'hv';
		 break;
	  }?>
<div id="container">
  <div id="header">
    <div id="logos"> <a href="http://uia.mx/" target="_blank"><img src="imagenes/logo_UIA.jpg" alt="logo" width="100" height="78" border="0" class="logo"/></a><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/index.php'"><img src="imagenes/logo_DEC.jpg" alt="DEC" width="90" height="78" border="0" /></a></div>
    <div id="primavera"></div>
    <div id="menu">
      <ul style="margin-left:187px">
        <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/index.php'">Inicio</a></li>
        <li> | </li>
        <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/nosotros.php'">Nosotros</a></li>
        <li> | </li>
        <li><a href="http://enlinea.uia.mx/tes_dec/dec_login.cfm" target="_blank">Servicios en l&iacute;nea</a></li>
        <li> |</li>
        <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/promociones.php'">Promociones</a></li>
        <li> |</li>
        <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/preinscripcion.php'">Preinscripci&oacute;n</a></li>
        <li> |</li>
        <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/directorio.php'">Directorio</a></li>
        <li> |</li>
        <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/contacto.php'">Informes</a></li>
      </ul>
    </div>
  </div>
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
          <p class="header_disciplinas">Oferta Acad�mica </p>
          <ul>
            <li> <a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=1'">Arquitectura </a></li>
            <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=2'"> Arte</a></li>
            <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=3'"> Dise�o</a></li>
            <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=7'">Pol&iacute;tica
              y Derecho</a></li>
            <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=5'">Desarrollo
              Humano</a></li>
            <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=6'">Salud</a></li>
            <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=4'">Comunicaci&oacute;n</a></li>
            <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=8'">Negocios</a></li>
            <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=9'">Tecnolog&iacute;a</a></li>
            <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=10'">Humanidades</a></li>
            <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=18&id_program=323'">Ciencias
              Religiosas</a></li>
            <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=11'">Gastronom&iacute;a</a></li>
            <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=12'">Preparatoria
              Abierta</a></li>
          </ul>
         <h4>Harvard Graduate<br />School of 
Design<br />Executive Education <br />
Programs</h4>
          <ul>
            <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=23'">Oferta Acad�mica</a></li>
          </ul>
          <h4>Centros de Atenci�n Especializada</h4>
          <ul>
            <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=14'">Idiomas</a></li>
            <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=15'">Ibero Online</a></li>
            <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=16'">Atenci&oacute;n Integral
              a Empresas</a></li>
            <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=17'">Atenci&oacute;n Integral al Sector P&uacute;blico</a></li>
          </ul>
          <h4>Sedes Externas</h4>
          <ul>
            <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=20&id_program=195'">Sede sur: Estudio Lofft</a></li>
            <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=13'">Xochitla</a></li>
            <!-- <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=21&id_program=196'">Asunci&oacute;n Quer&eacute;taro</a></li>
            
            <!-- <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=22'">Atrio Espacio Cultural</a></li> -->
          </ul>
          <h4><br />
          </h4>
          <ul class="cobranzas">
            <li><a href="https://enlinea.uia.mx/sit/SitActividadesEsp.cfm " target="_blank">Pago
              de traducciones</a></li>
            <li><a href="http://www.dec-uia.com/otono_2012/temarios/politcas_cobranza.pdf" target="_blank"> Pol&iacute;ticas
              cobranza</a></li>
            <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/tutorial_pagos.php'"> Tutorial pagos en l&iacute;nea </a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div id= "contenedor_irregular_index" >
    <div class="bannersuperior"><!-- InstanceBeginEditable name="weekly_articles" -->
    <?php /*$random=rand(1,2); ?>
    
      <table width="100%" border="0" cellspacing="10" cellpadding="0">
        <tr align="left"  valign="top" >        
         <?php
				if($random == 1){ ?>
        
        
        
          <td onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=<?php echo $row_programas_izq['id_discipline'];?>&id_program=<?php echo $row_programas_izq['id_program']; ?>'" valign="middle" style="background: url(imagenes/uploads/banner_prox/<?php echo $row_programas_izq['imagen']; ?>) no-repeat top left; cursor:pointer; width:155px; height:83px; padding-left:185px; margin-top:5px; padding-right:3px;"><h5><?php echo WordLimiter($row_programas_izq['programa'], 6); ?></h5>
          <strong>Inicio</strong>: <?php echo strftime("%d de %B", strtotime($row_programas_izq['fecha_inicio'])); ?> </td>
          
       <?php } else{
           if($row_programas_der != NULL){ ?>
           
          <td onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=<?php echo $row_programas_izq['id_discipline'];?>&id_program=<?php echo $row_programas_izq['id_program']; ?>'" valign="middle" style="background: url(imagenes/uploads/banner_prox/<?php echo $row_programas_der['imagen_idioma']; ?>) no-repeat top left; cursor:pointer; width:160px; height:83px; padding-left:181px; margin-top:5px; padding-right:3px;"><h5><?php echo ucfirst(strtolower($row_programas_der['nivel'])); ?></h5>
          <strong>Inicio</strong>: <?php echo strftime("%d de %B", strtotime($row_programas_der['inicio'])); ?> </td>
          
           <?php }else{ ?>
           
           <td onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=<?php echo $row_programas_izq['id_discipline'];?>&id_program=<?php echo $row_programas_izq['id_program']; ?>'" valign="middle"  style="background: url(imagenes/uploads/banner_prox/<?php echo $row_programas_izq['imagen']; ?>) no-repeat top left; cursor:pointer; width:155px; height:83px; padding-left:185px; margin-top:5px; padding-right:3px;"><h5><?php echo WordLimiter($row_programas_izq['programa'], 6); ?></h5>
          <strong>Inicio</strong>: <?php echo strftime("%d de %B", strtotime($row_programas_izq['fecha_inicio'])); ?> </td>
          
          <?php }} ?>	
           
          <?php if($random==1){
						if($row_programas_der != NULL){
						?>
          
         <td><h2>Pr�ximos programas a iniciar</h2>
             <ul>
             <?php do { ?>
              <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=14&id_program=<?php echo $row_programas_der['id_program_idioma']; ?>'"><?php echo ucfirst(strtolower($row_programas_der['nivel'])); ?></a> <span class="contenido_diploRojo">/</span> <span class="contenido_diploRojo"> <?php echo strftime("%d de %B", strtotime($row_programas_der['inicio'])); ?></span></li>
              <?php $row_programas_izq = mysql_fetch_assoc($programas_izq) ?>
              <?php if ($row_programas_izq != NULL){?>
              <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=<?php echo $row_programas_izq['id_discipline'];?>&id_program=<?php echo $row_programas_izq['id_program']; ?>'"><?php echo WordLimiter($row_programas_izq['programa'], 6); ?></a> <span class="contenido_diploRojo">/</span> <span class="contenido_diploRojo"> <?php echo strftime("%d de %B", strtotime($row_programas_izq['fecha_inicio'])); ?></span><?php } ?></li>
              
              <?php } while ($row_programas_der = mysql_fetch_assoc($programas_der)); ?>
             </ul></td>
        </tr>
      </table>
      <?php }else{ ?>
      
      <td><h2>Pr�ximos programas a iniciar</h2>
             <ul>
             <?php do { ?>
             
            <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=<?php echo $row_programas_izqb['id_discipline'];?>&id_program=<?php echo $row_programas_izqb['id_program']; ?>'"><?php echo WordLimiter($row_programas_izqb['programa'], 6); ?></a> <span class="contenido_diploRojo">/</span> <span class="contenido_diploRojo"> <?php echo strftime("%d de %B", strtotime($row_programas_izqb['fecha_inicio'])); ?></span></li>
             
              <!--a href="#" onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=14&id_program=<?php echo $row_programas_izqb['id_program_idioma']; ?>'"><?php echo ucfirst(strtolower($row_programas_izqb['nivel'])); ?></a> <span class="contenido_diploRojo">/</span> <span class="contenido_diploRojo"> <?php echo strftime("%d de %B", strtotime($row_programas_izqb['inicio'])); ?></span></li-->
             
              <?php } while ($row_programas_izqb = mysql_fetch_assoc($programas_izqb)); ?>
             </ul></td>
        </tr>
      </table>
      
          <?php }}else{ 
						if($row_programas_der != NULL){
					?>
          
         <td><h2>Pr�ximos programas a iniciar</h2>
             <ul>
             <?php do { ?>
              <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=<?php echo $row_programas_izq['id_discipline'];?>&id_program=<?php echo $row_programas_izq['id_program']; ?>'"><?php echo WordLimiter($row_programas_izq['programa'], 6); ?></a> <span class="contenido_diploRojo">/</span> <span class="contenido_diploRojo"> <?php echo strftime("%d de %B", strtotime($row_programas_izq['fecha_inicio'])); ?></span></li>
              <?php $row_programas_der = mysql_fetch_assoc($programas_der) ?>
              <?php if ($row_programas_der != NULL){?>
                            <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=14&id_program=<?php echo $row_programas_der['id_program_idioma']; ?>'"><?php echo ucfirst(strtolower($row_programas_der['nivel'])); ?></a> <span class="contenido_diploRojo">/</span> <span class="contenido_diploRojo"> <?php echo strftime("%d de %B", strtotime($row_programas_der['inicio'])); ?></span><?php } ?></li>
              
              <?php } while ($row_programas_izq = mysql_fetch_assoc($programas_izq));
							
							}else{ 
							?>
              
              <td><h2>Pr�ximos programas a iniciar</h2>
             <ul>
             <?php do {
							 ?>
              <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=<?php echo $row_programas_izqb['id_discipline'];?>&id_program=<?php echo $row_programas_izqb['id_program']; ?>'"><?php echo WordLimiter($row_programas_izqb['programa'], 6); ?></a> <span class="contenido_diploRojo">/</span> <span class="contenido_diploRojo"> <?php echo strftime("%d de %B", strtotime($row_programas_izqb['fecha_inicio'])); ?></span></li>
                                          
                            <?php } while ($row_programas_izqb = mysql_fetch_assoc($programas_izqb));
							
							}} ?>
              
             <!--li><span class="contenido_diploRojo">24 de marzo</span> / Espacio P�blico y Ciudades Seguras </li>
             <li><span class="contenido_diploRojo">24 de marzo</span> / Espacio P�blico y Ciudades Seguras </li-->
            </ul></td>
        </tr>
      </table> */ ?>
      <!-- InstanceEndEditable --> </div>
    <div id="separador"></div>
    <div id= "type4" class="rectangulo_abajo_index">
      <div class="textos">
        <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
          <tr>
            <td><!-- InstanceBeginEditable name="contenido" -->
            	<p><img src="imagenes/buscador_header.jpg" width="550" height="150" /></p>
            	<p>&nbsp;</p>
            	<h1>Cursos y diplomados</h1>
				<p>&nbsp;</p>
				<? do{ ?>
					<p><a style="cursor:pointer;" onclick="javascript:parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=<? echo $row_search['id_discipline']; ?>&id_program=<? echo $row_search['id_program']; ?>&titulo=<? echo $row_search['program_name']; ?>'"><strong><? echo $row_search['program_name']; ?></strong></a><br/><? echo WordLimiter($row_search['description'],20); ?></p>
					<p>&nbsp;</p>
				<? }while($row_search = mysql_fetch_assoc($search)); ?>
				<p>&nbsp;</p>
            <!-- InstanceEndEditable --></td>
          </tr>
          <tr>
            <td><!-- AddThis Button BEGIN -->
              
              <div class="addthis_toolbox addthis_default_style"
						addthis:url="http://www.diplomados.uia.mx/articulos.php?id_discipline=<? echo $_GET['id_discipline']; ?>"
						addthis:title="<?php echo $row_temp['discipline'].' - '.$row_disciplines['title'];?>"> <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> <a class="addthis_button_tweet"></a> <a class="addthis_counter addthis_pill_style"></a> </div>
              <script type="text/javascript">
					var addthis_config = {"data_track_clickback":true};
					</script> 
              <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=pvazquezdiaz"></script> 
              <!-- AddThis Button END --></td>
          </tr>
        </table>
      </div>
    </div>
    <div class="avisos">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td height="100" align="center" valign="top" style="background:url(imagenes/buscador_bg.jpg) top center no-repeat;"><form name="buscador" action="resultados.php" method="post">
                <table width="180" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="57" colspan="3">&nbsp;</td>
                  </tr>
                  <tr valign="middle">
                    <td width="11">&nbsp;</td>
                    <td bgcolor="#FF0000" style="padding:5px;"><label for="buscar"></label>
                      <input name="buscar" placeholder="" type="text" id="buscar" style="margin:0px; width:115px; height:11px; padding:1px; border:1px solid #999999; line-height:0; font-size:11px;"  />
                      &nbsp;
                      <input name="search" type="submit" id="search" value="-" style="color:#D1D1D1; width:15px; height:15px; background:url(imagenes/buscador_lupa.png) top center no-repeat; border:none;" /></td>
                    <td width="11">&nbsp;</td>
                  </tr>
                </table>
              </form></td>
          </tr>
          <tr>
            <td valign="middle" align="center"><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=15&id_program=394&titulo=Los_4_inconmensurables:_Desde_el_sufrimiento,_enviar_felicidad'"><!--img src="../imagenes/banners/banner_rompope_optimizado.jpg" width="191" height="131" /--></a></td>
          </tr>
          <tr>
            <td  align="right" valign="top" >&nbsp;</td>
          </tr>
          <tr>
        	<? mysql_select_db($database_otono2011, $otono2011);
$query_banners = "SELECT * FROM banners_lat ORDER BY rand() LIMIT 1";
$banners = mysql_query($query_banners, $otono2011) or die(mysql_error());
$row_banners = mysql_fetch_assoc($banners);?>
        	<td  align="center" valign="top" ><a href="#" onclick="parent.location='<? echo $row_banners['destino']; ?>'"><img src="imagenes/banners/<? echo $row_banners['img_banner']; ?>" width="191" border="0" align="middle" /></a></td>
          	</tr>
          <tr>
          	<td  align="right" valign="top" >&nbsp;</td>
          	</tr>
          <tr align="center">
            <td ><a onclick="parent.location='http://www.diplomados.uia.mx/propuestas_cursos.php'" href="#"><img src="imagenes/banners/banner_proppuestas.jpg" width="191" height="115" border="0" /></a></td>
          </tr>
          <tr>
            <td  align="right" valign="top" >&nbsp;</td>
          </tr>
          <tr>
            <td valign="bottom" height="130" align="center" style="background: url(imagenes/newsletter.jpg) no-repeat scroll center bottom transparent; "><form action="http://www.dec-uia.com/cgi-bin/dada/mail.cgi" method="post" target="_blank" name="form_news" id="form_news">
                <table width="170" border="0" align="center" cellpadding="5" cellspacing="0">
                  <tbody><tr>
                    <td width="62%" height="82"></td>
                    <td width="38%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="right"><!-- begin subscription_form_widget.tmpl -->
                      
                      <input type="hidden" name="list" value="newsDEC">
                      <input type="hidden" name="f" id="f_s" value="subscribe" checked="checked">
                      <input name="email" type="text" id="email" value="" size="15" class="news_input" placeholder="email"></td>
                    <td align="center"><input onClick="_gaq.push(['_trackEvent', 'Newsletter', 'Click', 'Registro al newsletter']);" type="submit" value="Enviar" class="processing" style="font-size:10px; background:#666; border-radius:5px; color:#FFF; width:50px; border:0px slid #FFF; width:50px;"></td>
                  </tr>
                  <tr>
                    <td height="1"></td>
                  </tr>
                </tbody></table>
              </form></td>
          </tr>
          <tr>
            <td valign="middle" align="center"></td>
          </tr>
          <tr>
            <td align="center" valign="middle"><a onclick="parent.location='http://www.diplomados.uia.mx/promociones.php'" href="#"><img width="116" height="139" border="0" align="middle" src="imagenes/banners/promociones.png"></a></td>
          </tr>
          <tr>
            <td align="center" valign="middle"><a href="http://www.compueducacion.mx/ads/Mexico_First/Ibero/" target="_blank"><img width="116" height="117" border="0" align="middle" src="imagenes/banners/ibero-compueducacion.jpg"></a></td>
          </tr>
          <tr>
            <td align="center" valign="middle"><br>
              
              <!--table width="80%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td>
			<form action="http://www.dec-uia.com/cgi-bin/dada/mail.cgi" method="post">
			Suscr&iacute;bete e nuestro bolet&iacute;n<br /><br />
				<input type="hidden" name="list" value="newsDEC" />
			 Correo:<input name="email" type="text" id="email" value="" size="15" /><br />
				<input type="hidden" name="f" id="f_s" value="subscribe" checked="checked" />
				<input type="hidden" name="f"  id="f_u"  value="unsubscribe"  />
			<input type="submit" value="Aceptar" class="processing" />
			</form> 
					</td>
				</tr>
			</table--></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div id="footer">
    <table width="1019" border="0" cellpadding="0" cellspacing="0" >
      <tr>
        <td width="810"><a onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=14'" href="#"><img src="imagenes/banners/idiomas_otono.jpg" alt="Dos" width="804" height="142" border="0" /></a></td>
        <td width="209" align="center" valign="middle"><a onclick="parent.location='http://www.diplomados.uia.mx/mapa.php'" href="#"><img width="173" height="152" border="0" align="middle" src="imagenes/banners/mapa_horizontal.png"></a></td>
      </tr>
      <tr align="center" valign="middle">
        <td colspan="2"><p><strong>&copy; Universidad Iberoamericana Ciudad
            de M�xico. </strong><br>
          </p>
          <address>
          Prol. Paseo de la Reforma 880, edificio G, P.B.
          Lomas de Santa Fe, M�xico, C.P. 01219, Distrito Federal. <br>
          Tel. (55) 59.50.40.00
          y 91.77.44.00 Lada nacional sin costo: 01 800 627 7615
          </address></td>
      </tr>
    </table>
  </div>
</div>
<map name="Map2" id="Map2">
  <area shape="rect" coords="48,104,79,133" href="https://www.facebook.com/diplomados.uia" target="_blank" />
  <area shape="rect" coords="82,104,107,133" href="http://twitter.com/DiplomadosIbero" target="_blank" />
</map>
</body>
<!-- InstanceEnd --></html>
