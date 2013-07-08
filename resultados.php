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

// mysql_select_db($database_otono2011, $otono2011);
// $query_ad = "SELECT * FROM ads ORDER BY `date` DESC LIMIT 0, 1";
// $ad = mysql_query($query_ad, $otono2011) or die(mysql_error());
// $row_ad = mysql_fetch_assoc($ad);
// $totalRows_ad = mysql_num_rows($ad);

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
if($_POST['search'] == "a"){
	$query_search ="SELECT
	  site_programs.*,
	  disciplines.discipline,
	  site_fechas_ini1.fecha,
	  site_fechas_ini1.periodo
	FROM
	  site_fechas_ini site_fechas_ini1 INNER JOIN
	  site_programs ON site_programs.id_program =
	    site_fechas_ini1.id_program INNER JOIN
	  disciplines ON site_programs.id_discipline =
	    disciplines.id_discipline
	Where
	  discipline LIKE '%".$_POST['sArea']."%' 
	  AND fecha BETWEEN '".$_POST['datepickerI']."' AND '".$_POST['datepickerF']."' 
	  AND cost_inscripcion IS NOT NULL 
	  AND site_programs.cancelado = 0 
	  AND site_programs.periodo = 'o' 
	  ORDER BY program_name ASC LIMIT 0,20";
}else{
	$query_search = "SELECT * FROM site_programs WHERE program_name LIKE '%".htmlentities($_POST['buscar'])."%' OR description LIKE '%".htmlentities($_POST['buscar'])."%' OR id_discipline IN (SELECT id_discipline FROM disciplines WHERE discipline LIKE '%".htmlentities($_POST['buscar'])."%') AND cancelado = 0 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE periodo = 'o') ORDER BY program_name ASC LIMIT 0,20";
}

$search = mysql_query($query_search, $otono2011) or die(mysql_error());
$row_search = mysql_fetch_assoc($search);
$totalRows_search = mysql_num_rows($search);
?>
<!DOCTYPE html>
<html><!-- InstanceBegin template="/Templates/index.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Untitled Document</title>
<!-- InstanceEndEditable -->
<link href="css/estilos_dan.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="Scripts/jquery-ui.css" type="text/css" media="all" />
<script type="text/javascript" src="Scripts/jquery.js"></script>
<script src="Scripts/jquery-ui.js"></script>
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

	$(function() {
	    $( "#datepickerI" ).datepicker({ dateFormat: 'yy-mm-dd' });
	    $( "#datepickerF" ).datepicker({ dateFormat: 'yy-mm-dd' });
	  });

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

	function show_search(){

		$('div#slide_search').show();

	}

	function showMenu(discipline, program){
		$('#menu_areas > ul > li > a').css('background-color', '#EEEEEE')
		$('.discipline_'+discipline).css('background-color', '#D6D7D9')
		$.post('show_discipline.php', {disciplina : discipline, programa : program}, function(data){
			
			if($('div#slide_menu:visible')){
				$('div#slide_menu').hide(50)
			}

			switch(discipline){
				case 12: 
					$('div#slide_menu').css('top', '202px')
				break;
				case 13: 
					$('div#slide_menu').css('top', '305px')
				break;
				case 16: 
					$('div#slide_menu').css('top', '37px')
				break;
				case 17: 
					$('div#slide_menu').css('top', '444px')
				break;
				case 20: 
					$('div#slide_menu').css('top', '6px')
				break;
				case 23: 
					$('div#slide_menu').css('top', '239px')
				break;
				default: 
					$('div#slide_menu').css('top', '0px')
			}

			$('div#slide_menu').empty().toggle(25).append(data)
		})
	}

	$(document).find('a#close_slider_menu').live("click", function(){

		$('div#slide_menu').hide(25)	
		$('#menu_areas > ul > li > a').css('background-color', '#EEEEEE')
	})
$(document).mouseup(function (e)
{
    var container = $("div#slide_search");


    if (container.has(e.target).length === 0)
    {
    	if($("div#ui-datepicker-div").css('display')=='none'){
   	        container.hide();
    	}

    }
});

$(document).mouseup(function (e)
{

    var container = $("div#slide_menu");

    if (container.has(e.target).length === 0)
    {
        container.hide();
    }
});
		
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
    <div id="primavera" style="margin-bottom:8px"></div>
    <div id="menu" style="float:none;width:1016px">
   	<a href="https://twitter.com/DiplomadosIbero"><div style="float:right;height:24px;width:33px;background-image: url(imagenes/twitter.png);border-left:3px;margin-left:11px;margin-right:13px"></div></a>
    <a href="http://www.facebook.com/diplomados.uia"><div style="float:right; height:24px;width:12px;background-image: url(imagenes/facebook.png);margin-left:10px"></div></a>
      <ul style="margin-left:187px">
           <li ><a style="font-size:11px" href="#" onclick="parent.location='http://www.diplomados.uia.mx/index.php'">Inicio</a></li>
        <li>|</li>
        <li><a style="font-size:11px" font-size='11px' href="#" onclick="parent.location='http://www.diplomados.uia.mx/nosotros.php'">Nosotros</a></li>
        <li>|</li>
        <li><!--a href="http://enlinea.uia.mx/tes_dec/dec_login.cfm" target="_blank"--><a style="font-size:11px" href="#" id="servicios_en_linea">Servicios y Pagos en l&iacute;nea</a></li>
        <li>|</li>
        <li><a style="font-size:11px" font-size='11px' href="#" onclick="parent.location='http://www.diplomados.uia.mx/promociones.php'">Promociones</a></li>
        <li>|</li>
        <li><a style="font-size:11px" href="#" onclick="parent.location='http://www.diplomados.uia.mx/preinscripcion.php'">Preinscripci&oacute;n</a></li>
        <li>|</li>
        <li><a style="font-size:11px" href="#" onclick="parent.location='http://www.diplomados.uia.mx/directorio.php'">Directorio</a></li>
        <li>|</li>
        <li><a style="font-size:11px" href="#" onclick="parent.location='http://www.diplomados.uia.mx/contacto.php'">Informes</a></li>
      </ul>
     </div>
    <div class="bannersuperior2" style="width:706px;margin-bottom:0px"></div>
  </div>
  <div id="separador"></div>
  <div id="slide_servicios" style="display: none; width:131px; height:140px; padding-top:10px; background-color: #FFF; z-index: 1007; margin-top:-162px; position:relative; top:148px; left:372px; border:solid 1px #EFEFEF; float:left;">
	<ul style="list-style:none; padding-left:16px; width:110px;">
	<li style="padding-bottom:10px;"><a href="http://enlinea.uia.mx/tes_dec/dec_login.cfm" target="_blank">Servicios en l&iacute;nea</a></li>
	<li style="padding-bottom:10px;"><a href="https://enlinea.uia.mx/sit/SitActividadesEsp.cfm" target="_blank">Pago de traducciones</a></li>
	<li style="padding-bottom:10px;"><a href="http://www.dec-uia.com/primavera2013/temarios/politcas_cobranza.pdf" target="_blank">Pol&iacute;ticas cobranza</a></li>
	<li style="padding-bottom:10px;"><a href="http://www.diplomados.uia.mx/tutorial_pagos.php">Tutorial pagos en l&iacute;nea</a></li></ul>
  </div>
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
          <p class="header_disciplinas"></p>
          <ul>
            <li><a class="discipline_1" onclick="showMenu(1)">Arquitectura</a></li>
            <li><a class="discipline_2" onclick="showMenu(2)">Arte</a></li>
            <li><a class="discipline_3" onclick="showMenu(3)">Dise�o</a></li>
            <li><a class="discipline_7" onclick="showMenu(7)">Pol&iacute;tica y Derecho</a></li>
            <li><a class="discipline_5" onclick="showMenu(5)">Desarrollo Humano</a></li>
            <li><a class="discipline_6" onclick="showMenu(6)">Salud</a></li>     
            <li><a class="discipline_8" onclick="showMenu(8)">Negocios</a></li>
            <li><a class="discipline_9" onclick="showMenu(9)">Tecnolog&iacute;a</a></li>
            <li><a class="discipline_10" onclick="showMenu(10)">Humanidades</a></li>
            <li><a href="programas.php?id_discipline=18&id_program=323">Ciencias Religiosas</a></li>
            <li><a class="discipline_11" onclick="showMenu(11)">Gastronom&iacute;a</a></li>
            <li><a class="discipline_12" onclick="showMenu(12)">Preparatoria Abierta</a></li>
            <li><a class="discipline_14" onclick="showMenu(14)">Idiomas</a></li>
          </ul>
         <h4>Programas ejecutivos</h4>
          <ul>
            <li><a class="discipline_23" onclick="showMenu(23)">Programas impartidos por Harvard University</a></li>
          </ul>
          <h4>Centros de Atenci�n Especializada</h4>
          <ul>
            <li><a class="discipline_15" onclick="showMenu(15)">Ibero Online</a></li>
            <li><a class="discipline_16" onclick="showMenu(16)">Atenci&oacute;n Integral a Empresas</a></li>
            <li><a class="discipline_17" onclick="showMenu(17)">Atenci&oacute;n Integral al Sector P&uacute;blico</a></li>
          </ul>
          <h4>Sedes Externas</h4>
          <ul>
            <li><a class="discipline_20" onclick="showMenu(20)">Sede sur: Estudio Lofft</a></li>
            <li><a class="discipline_13" onclick="showMenu(13)">Xochitla</a></li>
          </ul>
          <h4 style="padding-top: 0px;"></h4>
          <p id="search_on" style="padding:5px"><a onclick="show_search()" style="color:#EF353C; font-weight:bold;">Busca tu programa de inter&eacute;s </p></a>
          <h4 style="padding-top: 0px;"></h4>
          <p style="padding:0px 5px 5px 5px;"><a href="catalogo.php"style="color:#EF353C; font-weight:bold;">Consulta cat&aacute;logo oferta primavera 2013</a></p>
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
    <div id="slide_menu" style="display:none; width:190px; background: url(imagenes/sombrita_submenu.png) repeat-y; background-color:#D6D7D9; position:relative; left:-11px; z-index:1000; margin-bottom:-2000px; padding-bottom: 10px;">

  	</div>
  	<div style="margin-left:29px">
  	<div style="width:69%;float:left;margin-left:0px">
		<div id="slide_search" style="border: 1px solid #E0E0E0; display:none; position:relative; margin-top:-202px; top:875px; left:-39px; width:192px; height:200px; background-color:#FFF; z-index:1000;">
				<form name="buscador" action="resultados.php" method="post">
					<label for="buscar"></label>
				    <img src="imagenes/piquito_rojo_buscador.png">
				    <input name="buscar" placeholder="�Qu� tema buscas?" type="text" id="buscar" style="margin:0 0 0 14px; width:150px; height:11px; padding:1px; border:1px solid #999999; font-size:11px;"  />
				    <input name="search" type="submit" id="search" value="n" style="color:#D1D1D1; font-size:1px; width:49px; height:16px; background:url(imagenes/boton_buscar.jpg) top center no-repeat; border:none; margin: 10px 0px 0px 129px;" />
				    <br />
					<table width="180" border="0" cellspacing="0" cellpadding="0" style="margin:10px 0 0 12px;">
				    	<thead>
				    		<tr colspan="3" style="text-align:left; height:20px;font-size:11px;">
				    			<th width="20px" colspan="3">B�squeda Avanzada (opcional)</th>
				    		</tr>
				    	</thead>
				    	<tr>
				        	<td colspan="3">
				        		 <select name="sArea" id="sArea" style="margin:0px; width:167px; height:15px; border:1px solid #999999; line-height:0; font-size:11px;">
									<option disabled="disabled" value="0" selected="selected" >�Qu&eacute; &aacute;rea te interesa?</option>
									<option value="arquitectura">Arquitectura</option>
									<option value="arte">Arte</option>
									<option value="asuncion">Asunci&oacute;on Quer&eacute;taro</option>
									<option value="integral a empresas">Atenci&oacute;n Integral a Empresas</option>
									<option value="sector publico">Atenci&oacute;n Integral al Sector P&uacute;blico</option>
									<option value="atrio">Atrio Espacio Cultural</option>
									<option value="barragan">Casa Barrag&aacute;n</option>
									<option value="religiosas">Ciencias Religiosas</option>
									<option value="comunicacion">Comunicaci&oacute;n</option>
									<option value="desarrollo">Desarrollo Humano</option>
									<option value="dise�o">Dise�o</option>
									<option value="gastronomia">Gastronom&iacute;a</option>
									<option value="humanidades">Humanidades</option>
									<option value="ibero online">Ibero Online</option>
									<option value="idiomas">Idiomas</option>
									<option value="lofft">Lofft</option>
									<option value="negocios">Negocios</option>
									<option value="politica">Pol&iacute;tica y Derecho</option>
									<option value="preparatoria">Preparatoria Abierta</option>
									<option value="educacion ejecutiva">Programas de Educaci&oacute;n Ejecutiva</option>
									<option value="salud">Salud</option>
									<option value="tecnologia">Tencolog&iacute;a</option>
									<option value="xochitla">Xochitla</option>
								</select>
							</td>
				        </tr>
				        <tr>
				        	<td colspan="3" height="30px" valign="bottom">
					        	�Cu&aacute;ndo quieres comenzar?
					        </td>
				        </tr>
				        <tr>
				        	<td colspan="3" style="font-size:9px;">
					        	Escoge una fecha precisa o un periodo
					        </td>
				        </tr>
				        
				        <tr style="margin-top:10px;"valign="middle">
				        	<td width="75px">
				        		<input type="text" id="datepickerI" name="datepickerI" style="margin:0px; width:55px; height:11px; padding:1px; border:1px solid #999999; line-height:0; font-size:11px;"/>	
				        		<img src="imagenes/calendario.jpg">
				        	</td>
				            <td  width="75px">
				            	<input type="text" id="datepickerF" name="datepickerF" style="margin:0px; width:55px; height:11px; padding:1px; border:1px solid #999999; line-height:0; font-size:11px;"/>
				            	<img src="imagenes/calendario.jpg">
				            </td>
				        </tr>
				        <tr>
				        	<td colspan="3" style="text-align:right;">
				          		<input name="search" type="submit" id="search" value="a" style="color:#D1D1D1; font-size:1px; width:49px; height:16px; background:url(imagenes/boton_buscar.jpg) top center no-repeat; border:none; margin: 15px;" />
				 			</td>
						</tr>
				   </table>
			    </form>
			  </div>
  	 	</div>
  	</div>
<div id= "contenedor_irregular" style="float:left; margin-left:29px; width:795px" >
    <div id= "type4" class="cuadro_articulos"> <img class="articulos_img" src="imagenes/m_resultados_busqueda.jpg" width="770" /> 
    </div>
    <div id= "type4" class="rectangulo_abajo">

    <div id="separador"></div>
    <div id= "type4" class="rectangulo_abajo_index" style="width:541px;margin-top:0px;padding: 0px 0px 0px 0px;border:0px">
      <div class="textos">
        <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
          <tr>
            <td><!-- InstanceBeginEditable name="contenido" -->
            	
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
						addthis:title="<?php echo $row_temp['discipline'].' - '.$row_disciplines['title'];?>"> <a class="addthis_counter addthis_pill_style"></a> </div>
              <script type="text/javascript">
					var addthis_config = {"data_track_clickback":true};
					</script> 
              <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=pvazquezdiaz"></script> 
              <!-- AddThis Button END --></td>
          </tr>
        </table>
      </div>
    </div>
</div>

     <div style="width:25%; float:left; margin-left:26px; margin-top:18px">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>          
          <td align="center"><a onclick="parent.location='http://www.diplomados.uia.mx/catalogo.php'" href="#"><img src="imagenes/banner_descuentos.png" width="181px" border="0" /></a></td>
            </tr>
          <tr>
            <td  align="right" valign="top" >&nbsp;</td>
            </tr>
          <tr>
            <td align="center"><a onclick="parent.location='http://www.diplomados.uia.mx/propuestas_cursos.php'" href="#"><img src="imagenes/banner_solicitalo.png" width="181px" height="115" border="0" /></a></td>
          </tr>
          
           <tr>
            <td valign="bottom" width="191px" height="120" align="left" style="background: url(imagenes/banner_newsletter.png) no-repeat bottom transparent; width:191px;">
              <form action="http://www.dec-uia.com/cgi-bin/dada/mail.cgi" method="post" target="_blank" name="form_news" id="form_news">
                <table width="170" border="0" align="center" cellpadding="5" cellspacing="0">
                  <tbody><tr>
                    <td width="62%" height="10"></td>
                    <td width="38%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="right"><!-- begin subscription_form_widget.tmpl -->
                      
                      <input type="hidden" name="list" value="newsDEC">
                      <input type="hidden" name="f" id="f_s" value="subscribe" checked="checked">
                      <input name="email" type="text" id="email" value="" size="15" class="news_input" placeholder="email" background="none"></td>
                    <td align="center"><input onClick="_gaq.push(['_trackEvent', 'Newsletter', 'Click', 'Registro al newsletter']);" type="submit" value="Enviar" class="processing" style="cursor:pointer;font-size:10px; border-radius:1px; color:#FFF; width:55px; border:0px; slid #FFF;"></td>
                  </tr>
                  <tr>
                    <td height="1"></td>
                  </tr>
                </tbody></table>
              </form></td>
          </tr>
              
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
</div>
 <div id="footer" style="float:left;width:810px">
    <table border="0" cellpadding="0" cellspacing="0" >
      <tr>
        <td width="810"><a onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=20'" href="#"><img src="imagenes/banners/idiomas_otono.jpg" alt="Dos" width="804" height="142" border="0" /></a></td>
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
  <area shape="rect" coords="49,104,76,133" href="https://www.facebook.com/diplomados.uia" target="_blank" />
  <area shape="rect" coords="77,103,109,134" href="http://twitter.com/DiplomadosIbero" target="_blank" />
</map>
<script>

  $('#servicios_en_linea').click(function(){


    $('#slide_servicios').toggle()

  })

  $(document).mouseup(function (e)
{
    var container = $("div#slide_servicios");

    if (container.has(e.target).length === 0)
    {
        container.hide();
    }
});
</script>
</body>
<!-- InstanceEnd --></html>

