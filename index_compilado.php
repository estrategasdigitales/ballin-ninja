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

mysql_select_db($database_otono2011, $otono2011);
$query_media_articles = "SELECT id_article, title FROM media_articles ORDER BY date DESC LIMIT 0, 4";
$media_articles = mysql_query($query_media_articles, $otono2011) or die(mysql_error());
//$row_media_articles = mysql_fetch_assoc($media_articles);
//$totalRows_media_articles = mysql_num_rows($media_articles);

mysql_select_db($database_otono2011, $otono2011);
$query_weekly_article = "SELECT * FROM weekly_articles ORDER BY `date` DESC LIMIT 0, 1";
$weekly_article = mysql_query($query_weekly_article, $otono2011) or die(mysql_error());
$row_weekly_article = mysql_fetch_assoc($weekly_article);
$totalRows_weekly_article = mysql_num_rows($weekly_article);

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
$query_community_opinions_top3 = "SELECT * FROM community_opinions ORDER BY `date` DESC LIMIT 0, 5";
$community_opinions_top3 = mysql_query($query_community_opinions_top3, $otono2011) or die(mysql_error());
//$row_community_opinions_top3 = mysql_fetch_assoc($community_opinions_top3);
//$totalRows_community_opinions_top3 = mysql_num_rows($community_opinions_top3);

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
?>
<!DOCTYPE html>
<html><!-- InstanceBegin template="/Templates/index.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Untitled Document</title>
<!-- InstanceEndEditable -->
<link href="css/estilos_dan.css" rel="stylesheet" type="text/css" />
<!------ Google Analytics ------>

<script type="text/javascript" src="Scripts/jquery.js"></script>
<script type="text/javascript" src="jquery.carouFredSel-6.1.0.js"></script>
<script type="text/javascript" src="jquery.carouFredSel-6.1.0-packed.js"></script>

	<script type="text/javascript">
	$(document).ready(function(){
$(".foo5").carouFredSel({
	scroll      : {
        fx          : "crossfade"
    },
		items		: {
		visible		: 1,
		width		: 775,
		height		: "46%"

	},
	auto : 		  {
		duration    : 1200,
        timeoutDuration: 4000,

	},
	prev 		: {
		button		: "#foo5_prev",
		key			: "left",
		items		: 1,
	
		duration	: 1200
	},
	next 		: {
		button		: "#foo5_next",
		key			: "right",
		items		: 1,
	
		duration	: 1200
	},
	pagination : {
		container	: "#foo5_pag",
		keys		: true,
		
		duration	: 1200
	}	
})





	});

	
$(document).mouseup(function (e)
{
    var container = $("div#slide_search");

    if (container.has(e.target).length === 0)
    {
        container.hide();
    }
});

</script>


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

	function showMenu(discipline, program){
		$('#menu_areas > ul > li > a').css('background-color', '#EEEEEE')
		$('.discipline_'+discipline).css('background-color', '#D6D7D9')
		$.post('show_discipline.php', {disciplina : discipline, programa : program}, function(data){
			
			if($('div#slide_menu:visible')){
				$('div#slide_menu').hide(50)
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

    var container = $("div#slide_menu");

    if (container.has(e.target).length === 0)
    {
        container.hide();
    }
});



		
</script>
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->

<style type="text/css">


.html_carousel {
}


.html_carousel div.slide {
	position: relative;
	width: 750px;
}	

.html_carousel div.slide div {
	margin-left: 580px;
	width: 172px;
	height: 100%;
	display: block;
	position: absolute;
	bottom: 0;
}

hr#linea1{
	color: red;
	background-color: red;
	border: 0;
	height: 2px;
	width: 98%;
}

.html_carousel div.slide h4 {
	margin-top: 30px;
	font-size: 17px;
	width: 170px;
	color: red;
	line-height: 1;
	font-weight: bold;
	font-family: corbel;
	border-top: 0px;
	margin-bottom: 5px;
	text-align: center;
}


.html_carousel div.slide p {
	font-family: corbel;
	font-size: 15px;
	width: 145px;
	margin-left: 26px;
	text-align: center;
	margin-top: 5px;
}












.image_carousel {
	padding: 15px 0 15px 40px;
	
}
.image_carousel img {
	border: 1px solid #ccc;
	background-color: white;
	padding: 9px;
	margin: 7px;
	display: block;
	background-color: white;
	float: left;
}

a.prev {
	background: url(imagenes/flecha_izq.png) no-repeat transparent;
	width: 45px;
	height: 50px;
	display: block;
	position: relative;
	bottom: 47px;
	left: 25px;
	background-position: 0 0; }

a.next {
	background: url(imagenes/flecha_der.png) no-repeat transparent;
	width: 45px;
	height: 50px;
	display: block;
	position: relative;
	bottom: 98px;
	left: 531px;
	background-position: 0px 0;
}

					
a.prev:hover {		background-position: 0 0px; }
a.prev.disabled {	background-position: 0 -100px !important;  }
a.next:hover {		background-position: 0px 0px; }
a.next.disabled {	background-position: -50px -100px !important;  }
a.prev.disabled, a.next.disabled {
	cursor: default;
}

a.prev span, a.next span {
	display: none;
}
.pagination {
	text-align: center;
}
.pagination a {
	background: url(imagenes/punto_inactivo.png) no-repeat transparent;
	width: 12px;
	height: 12px;
	margin: 0 5px 0 0;
	display: inline-block;
}
.pagination a.selected {
	background: url(imagenes/punto_activo.png);
	cursor: default;
}
.pagination a span {
	display: none;
}
.clearfix {
	float: none;
	clear: both;
}
</style>

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
    <div id="menu" style="float:none;width:1016px;text-align:center">
   	<a href="https://twitter.com/DiplomadosIbero"><div style="float:right;height:24px;width:33px;background-image: url(imagenes/twitter.png);border-left:3px;margin-left:11px;margin-right:13px"></div></a>
    <a href="http://www.facebook.com/diplomados.uia"><div style="float:right; height:24px;width:12px;background-image: url(imagenes/facebook.png);margin-left:10px"></div></a>
      <ul style="margin-left:187px">
        <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/index.php'">Inicio</a></li>
        <li>|</li>
        <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/nosotros.php'">Nosotros</a></li>
        <li>|</li>
        <li><a href="http://enlinea.uia.mx/tes_dec/dec_login.cfm" target="_blank">Servicios en l&iacute;nea</a></li>
        <li>|</li>
        <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/promociones.php'">Promociones</a></li>
        <li>|</li>
        <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/preinscripcion.php'">Preinscripci&oacute;n</a></li>
        <li>|</li>
        <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/directorio.php'">Directorio</a></li>
        <li>|</li>
        <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/contacto.php'">Informes</a></li>
      </ul>
     </div>
    <div class="bannersuperior2" style="width:706px"></div>
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
          <p class="header_disciplinas"></p>
          <ul>
            <li><a href="#" class="discipline_1" onmouseover="showMenu(1)" onclick="showMenu(1)">Arquitectura</a></li>
            <li><a href="#" class="discipline_2" onmouseover="showMenu(2)" onclick="showMenu(2)">Arte</a></li>
            <li><a href="#" class="discipline_3" onmouseover="showMenu(3)" onclick="showMenu(3)">Dise�o</a></li>
            <li><a href="#" class="discipline_7" onmouseover="showMenu(7)" onclick="showMenu(7)">Pol&iacute;tica
              y Derecho</a></li>
            <li><a href="#" class="discipline_5" onmouseover="showMenu(5)" onclick="showMenu(5)">Desarrollo
              Humano</a></li>
            <li><a href="#" class="discipline_6" onmouseover="showMenu(6)" onclick="showMenu(6)">Salud</a></li>
            <!--li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=4'">Comunicaci&oacute;n</a><a href="#" onclick="showMenu(4)">Comunicaci&oacute;n</a></li-->
            <li><a href="#" class="discipline_8" onmouseover="showMenu(8)" onclick="showMenu(8)">Negocios</a></li>
            <li><a href="#" class="discipline_9" onmouseover="showMenu(9)" onclick="showMenu(9)">Tecnolog&iacute;a</a></li>
            <li><a href="#" class="discipline_10" onmouseover="showMenu(10)" onclick="showMenu(10)">Humanidades</a></li>
            <li><!--a href="#" onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=18&id_program=323'">Ciencias
              Religiosas</a--><a href="http://www.diplomados.uia.mx/programas.php?id_discipline=18&id_program=323">Ciencias Religiosas</a></li>
            <li><a href="#" class="discipline_11" onmouseover="showMenu(11)" onclick="showMenu(11)">Gastronom&iacute;a</a></li>
            <li><a href="#" class="discipline_12" onmouseover="showMenu(12)" onclick="showMenu(12)">Preparatoria Abierta</a></li>
          </ul>
         <h4>Programas impartidos <br />
                por Harvard University</h4>
          <ul>
            <li><!--a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=23'">Oferta Acad�mica</a--><a href="#" class="discipline_23" onmouseover="showMenu(23)" onclick="showMenu(23)">Oferta Acad�mica</a></li>
          </ul>
          <h4>Centros de Atenci�n Especializada</h4>
          <ul>
            <li><!--a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=14'">Idiomas</a--><a href="#" class="discipline_14" onmouseover="showMenu(14)" onclick="showMenu(14)">Idiomas</a></li>
            <li><!--a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=15'">Ibero Online</a--><a href="#" class="discipline_15" onmouseover="showMenu(15)" onclick="showMenu(15)">Ibero Online</a></li>
            <li><!--a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=16'">Atenci&oacute;n Integral
              a Empresas</a--><a href="#" class="discipline_16" onmouseover="showMenu(16)" onclick="showMenu(16)">Atenci&oacute;n Integral
              a Empresas</a></li>
            <li><!--a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=17'">Atenci&oacute;n Integral al Sector P&uacute;blico</a--><a href="#" class="discipline_17" onmouseover="showMenu(17)" onclick="showMenu(17)">Atenci&oacute;n Integral al Sector P&uacute;blico</a></li>
          </ul>
          <h4>Sedes Externas</h4>
          <ul>
            <li><!--a href="#" onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=20&id_program=195'">Sede sur: Estudio Lofft</a--><a href="#" class="discipline_20" onmouseover="showMenu(20)" onclick="showMenu(20)">Sede sur: Estudio Lofft</a></li>
            <li><!--a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=13'">Xochitla</a--><a href="#" class="discipline_13" onmouseover="showMenu(13)" onclick="showMenu(13)">Xochitla</a></li>
            <!-- <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=21&id_program=196'">Asunci&oacute;n Quer&eacute;taro</a--></li>
            
            <!-- <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=22'">Atrio Espacio Cultural</a--></li>
          </ul>
          <h4 style="padding-top: 0px;">
          </h4>
          <a href="#" onmouseover="show_search()"><p id="search_on" style="color:#EF353C; font-weight:bold; padding:10px">Busca tu programa de inter&eacute;s </p></a>
          <h4 style="padding-top: 0px;"></h4>
          <p style="color:#EF353C; font-weight:bold; padding:10px 10px 25px;">Consulta cat&aacute;logo oferta primavera 2013</p>
          <!--ul class="cobranzas">
            <li><a href="https://enlinea.uia.mx/sit/SitActividadesEsp.cfm " target="_blank">Pago
              de traducciones</a></li>
            <li><a href="http://www.dec-uia.com/otono_2012/temarios/politcas_cobranza.pdf" target="_blank"> Pol&iacute;ticas
              cobranza</a></li>
            <li><a href="#" onmouseover="showMenu()" onclick="parent.location='http://www.diplomados.uia.mx/tutorial_pagos.php'"> Tutorial pagos en l&iacute;nea </a></li>
          </ul-->
        </div>
      </div>
    </div>
  </div>
<div id="espacio" style="width:5%;float:left"> 

</div>
  <div id= "contenedor_irregular_index">
    <div class="bannersuperior" style="margin-bottom:0px"><!-- InstanceBeginEditable name="weekly_articles" -->
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
    	      <div class="textos" style="margin-left:0px;top:0px;height:295px;width:1500px;margin-bottom:9px;float:left">
		<div class="html_carousel" style="float:left;margin-left:0px;">
			<div class="pagination" id="foo5_pag" style="width:190px;float:right;display:block;margin-top:250px;margin-left:-219px;z-index:5;position:relative"></div>
			<div style="float:left;display:block;margin-top:288px;margin-left:1px;z-index:16;position:absolute">
			<a class="prev" id="foo5_prev" href="#"><span>prev</span></a>
			<a class="next" id="foo5_next" href="#"><span>next</span></a>
			</div>
			<div id="foo5" class="foo5">
       			<div class="slide" id="parrafo1">
					<img src="http://www.dec-uia.com/otono_2011/imagenes/carrusel/carrusel1.jpg" alt="carousel 2" width="775" height="300" />
					<div style="width:172px">
				<h4 align="center">La Ibero y Hewlett-Packard, m�s de 10 a�os sumando esfuerzos</h4>
				<hr id="linea1" style="margin-left:10px">
				<p align="center">En este periodo ofertamos seis programas en el �rea de Tecnolog�a.</p>

			</div>
		</div>
		       <div class="slide">
					<img src="http://www.dec-uia.com/otono_2011/imagenes/carrusel/carrusel2.jpg" alt="carousel 2" width="775" height="300" />
					<div style="width:172px">
				<h4 align="center">Harvard en la Ibero: programas de excelencia</h4>
				<hr id="linea1" style="margin-left:10px">
				<p align="center">�Para ser l�der,  no tienes que ser perfecto� Liderazgo en organizaciones y empresas </p>
			</div>
		</div>
				<div class="slide">
					<img src="http://www.dec-uia.com/otono_2011/imagenes/carrusel/carrusel3.jpg" alt="carousel 3" width="775" height="300" />
					<div style="width:172px";>
				<h4 align="center">�Donde la iluminaci�n, el espacio y el dise�o se encuentran�</h4>
				<hr id="linea1" style="margin-left:10px">
				<p align="center">Diplomado Dise�o y Luz, en colaboraci�n con Philips</p>
			</div>
		</div>
				<div class="slide">
					<img src="http://www.dec-uia.com/otono_2011/imagenes/carrusel/carrusel4.jpg" alt="carousel 4" width="775" height="300" />
					<div style="width:172px">
				<h4 align="center">Tenemos motivos para celebrar: clausura 2012</h4>
				<hr id="linea1" style="margin-left:10px">
				<p align="center">Gracias a nuestros alumnos por su empe�o y dedicaci�n</p>
			</div>
		</div>
			</div>
		<div class="clearfix"></div>
            
	  </div>


             </div>

              

                 	<div style="width:69%;float:left;margin-left:0px">
                 		<div id="slide_search" style="border: 1px solid #E0E0E0; display:none; position:relative; margin-top:-102px; top:478px; left:-39px; width:192px; height:100px; background-color:#FFF; z-index:1000;">
<form name="buscador" action="resultados.php" method="post">
                <table width="180" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="57" colspan="3">&nbsp;</td>
                  </tr>
                  <tr valign="middle">
                    <td width="11">&nbsp;</td>
                    <label for="buscar"></label>
                      <img src="imagenes/piquito_rojo_buscador.png">
                      <img src="imagenes/lupa_buscador.jpg">
                      <input name="buscar" placeholder="" type="text" id="buscar" style="margin:0px; width:115px; height:11px; padding:1px; border:1px solid #999999; line-height:0; font-size:11px;"  />
                      &nbsp;
                      <input name="search" type="submit" id="search" value="-" style="color:#D1D1D1; width:49px; height:16px; background:url(imagenes/boton_buscar.jpg) top center no-repeat; border:none; margin: 10px 0px 0px 100px;" />
                    <td width="11">&nbsp;</td>
                  </tr>
                </table>
              </form>
  	 					</div>
                 <table width="100%" border="0" cellpadding="0" cellspacing="0">
                		<tr>
                  			<td height="55" align="left" valign="bottom">
                  				<img style="outline:none; border:none;" valign="bottom" src="imagenes/comunidad_ibero_opina.png" usemap="#planetmap">
                  				<!--<img src="imagenes/comunidad_ibero_participa.png" border="0" style="margin-bottom:4px; margin-right:15px; cursor:pointer;" onclick="parent.location='http://www.diplomados.uia.mx/participa.php';" /></td>-->
                		
                		<map name="planetmap">
						<area shape="rect" coords="452,13,535,30" href="participa.php" alt="Sun">
						</map>

                		</tr>
                		<tr>
                 			<td>&nbsp;</td>
                		</tr>
                 </table>
                 <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td valign="top"><!-- //////////////////////////////////////////////////////////////////////////////// -->
                          
                          <?php $row_community_opinions_top3 = mysql_fetch_assoc($community_opinions_top3); ?>
                          <table width="160" border="0" cellspacing="0" cellpadding="0" align="left">
                            <tr>
                              <td height="20" bgcolor="#EFEFEF" class="comunidad_opina_headers"><?php echo $row_community_opinions_top3['short_name']; ?></td>
                            </tr>
                            <tr>
                              <td><img src="imagenes/uploads/community_opinions/<?php echo $row_community_opinions_top3['picture']; ?>" width="160" height="152" /></td>
                            </tr>
                            <tr>
                              <? 
							  $word_count = 0;
							  	$word_count += count_words($row_community_opinions_top3['degree']);
							  	$word_count += count_words($row_community_opinions_top3['job_position']);
								$word_count += count_words($row_community_opinions_top3['diploma_course']);
								?>
                              <!--<td><p><em><?php echo $row_community_opinions_top3['degree']; ?></em></p></td>-->
                            </tr>
                            <tr>
                              <td><p><em><?php echo $row_community_opinions_top3['job_position']; ?></em></p></td>
                            </tr>
                            <tr>
                              <td><p><strong><em><?php echo $row_community_opinions_top3['diploma_course']; ?></em></strong></p></td>
                            </tr>
                            <tr>
                              <td height="10"></td>
                            </tr>
                            <tr>
                              <td><p><?php echo WordLimiter($row_community_opinions_top3['opinion'], 35, $word_count); ?><br />
                                  <a onclick="parent.location='http://www.diplomados.uia.mx/community_opinions_detail.php?id_opinion=<?php echo $row_community_opinions_top3['id_opinion']; ?>'" style="cursor:pointer;"> <span class="avisos_mas">&gt; leer m�s</span></a></p></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td><!--a onclick="parent.location='http://www.diplomados.uia.mx/community_opinion_details_container.php?id_opinion=< ?php echo $row_community_opinions_top3['id_opinion']; ?>'" style="cursor:pointer;" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('img_readmore','','images/links/read_more_onhover.gif',1)"><img src="images/links/read_more.gif" name="img_readmore" id="img_readmore" border="0"></a--></td>
                            </tr>
                          </table>
                          
                          <!-- //////////////////////////////////////////////////////////////////////////////// --></td>
                        <td valign="top"><!-- //////////////////////////////////////////////////////////////////////////////// -->
                          
                          <?php $row_community_opinions_top3 = mysql_fetch_assoc($community_opinions_top3); ?>
                          <table width="160" border="0" cellspacing="0" cellpadding="0" align="center">
                            <tr>
                              <td height="20" bgcolor="#EFEFEF" class="comunidad_opina_headers"><?php echo $row_community_opinions_top3['short_name']; ?></td>
                            </tr>
                            <tr>
                              <td><img src="imagenes/uploads/community_opinions/<?php echo $row_community_opinions_top3['picture']; ?>" width="160" height="152" /></td>
                            </tr>
                           
                            <tr>
                              <? 
							 	$word_count = 0;
							  	$word_count += count_words($row_community_opinions_top3['degree']);
							  	$word_count += count_words($row_community_opinions_top3['job_position']);
								$word_count += count_words($row_community_opinions_top3['diploma_course']);
								?>
                              <!--<td><p><em><?php echo $row_community_opinions_top3['degree']; ?></em></p></td>-->
                            </tr>
                            <tr>
                              <td><p><em><?php echo $row_community_opinions_top3['job_position']; ?></em></p></td>
                            </tr>
                            <tr>
                              <td><p><strong><em><?php echo $row_community_opinions_top3['diploma_course']; ?></em></strong></p></td>
                            </tr>
                            <tr>
                              <td height="10"></td>
                            </tr>
                            <tr>
                              <td><p><?php echo WordLimiter($row_community_opinions_top3['opinion'], 35, $word_count); ?><br />
                                  <a onclick="parent.location='http://www.diplomados.uia.mx/community_opinions_detail.php?id_opinion=<?php echo $row_community_opinions_top3['id_opinion']; ?>'" style="cursor:pointer;"><span class="avisos_mas">&gt; leer m�s</span></a></p></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td><!--a onclick="parent.location='http://www.diplomados.uia.mx/community_opinion_details_container.php?id_opinion=< ?php echo $row_community_opinions_top3['id_opinion']; ?>'" style="cursor:pointer;" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('img_readmore','','images/links/read_more_onhover.gif',1)"><img src="images/links/read_more.gif" name="img_readmore" id="img_readmore" border="0"></a--></td>
                            </tr>
                          </table>
                          
                          <!-- //////////////////////////////////////////////////////////////////////////////// --></td>
                        <td valign="top"><!-- //////////////////////////////////////////////////////////////////////////////// -->
                          
                          <?php $row_community_opinions_top3 = mysql_fetch_assoc($community_opinions_top3); ?>
                          <table width="160" border="0" cellspacing="0" cellpadding="0" align="right">
                            <tr>
                              <td height="20" bgcolor="#EFEFEF" class="comunidad_opina_headers"><?php echo $row_community_opinions_top3['short_name']; ?></td>
                            </tr>
                            <tr>
                              <td><img src="imagenes/uploads/community_opinions/<?php echo $row_community_opinions_top3['picture']; ?>" width="160" height="152" /></td>
                            </tr>
                            
                            <tr>
                              <? 
							 	$word_count = 0;
							  	$word_count += count_words($row_community_opinions_top3['degree']);
							  	$word_count += count_words($row_community_opinions_top3['job_position']);
								$word_count += count_words($row_community_opinions_top3['diploma_course']);
								?>
                              <!--<td><p><em><?php echo $row_community_opinions_top3['degree']; ?></em></p></td>-->
                            </tr>
                            <tr>
                              <td><p><em><?php echo $row_community_opinions_top3['job_position']; ?></em></p></td>
                            </tr>
                            <tr>
                              <td><p><strong><em><?php echo $row_community_opinions_top3['diploma_course']; ?></em></strong></p></td>
                            </tr>
                            <tr>
                              <td height="10"></td>
                            </tr>
                            <tr>
                              <td><p><?php echo WordLimiter($row_community_opinions_top3['opinion'], 35, $word_count); ?><br />
                                  <a onclick="parent.location='http://www.diplomados.uia.mx/community_opinions_detail.php?id_opinion=<?php echo $row_community_opinions_top3['id_opinion']; ?>'" style="cursor:pointer;"><span class="avisos_mas">&gt; leer m�s</span></a></p></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td><!--a onclick="parent.location='http://www.diplomados.uia.mx/community_opinion_details_container.php?id_opinion=< ?php echo $row_community_opinions_top3['id_opinion']; ?>'" style="cursor:pointer;" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('img_readmore','','images/links/read_more_onhover.gif',1)"><img src="images/links/read_more.gif" name="img_readmore" id="img_readmore" border="0"></a--></td>
                            </tr>
                          </table>
                          
                          <!-- //////////////////////////////////////////////////////////////////////////////// --></td>
                      </tr>
                   </td>
                </tr>
                <tr>
                  <td align="right"><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/community_opinions.php'"><img border="0" src="imagenes/buttons/historico_entrevistas.jpg" onmouseover="this.src='imagenes/buttons/historico_entrevistas.jpg';" onmouseout="this.src='imagenes/buttons/historico_entrevistas.gif';" /></a></td>
                </tr>
              </table>
             </div>
              <!-- InstanceEndEditable -->
            <!--<tr>
            <td><!-- AddThis Button BEGIN
              
              <div class="addthis_toolbox addthis_default_style"
						addthis:url="http://www.diplomados.uia.mx/articulos.php?id_discipline=<? echo $_GET['id_discipline']; ?>"
						addthis:title="<?php echo $row_temp['discipline'].' - '.$row_disciplines['title'];?>"> <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> <a class="addthis_button_tweet"></a> <a class="addthis_counter addthis_pill_style"></a> </div>
              <script type="text/javascript">
					var addthis_config = {"data_track_clickback":true};
					</script> 
              <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=pvazquezdiaz"></script> 
              </td> -->
           
 

 <div style="width:25%; float:left; margin-left:37px; margin-top:18px">
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
            <td valign="bottom" width="191px" height="118" align="left" style="background: url(imagenes/banner_newsletter.png) no-repeat bottom transparent; width:191px;">
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
    </tr>
        </table>
   
  </div>
</div>
  <div id="footer" style="float:left;width:810px">
    <table border="0" cellpadding="0" cellspacing="0" >
      <tr>
        <td width="810"><a onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=14'" href="#"><img src="imagenes/banners/idiomas_otono.jpg" alt="Dos" width="804" height="142" border="0" /></a></td>
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
<script>

	function show_search(){

		$('div#slide_search').show();

	}

</script>
</body>
<!-- InstanceEnd --></html>
