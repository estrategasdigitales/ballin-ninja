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

$colname_progs_diplos = "-1";
if (isset($_GET['id_discipline'])) {
  $colname_progs_diplos = $_GET['id_discipline'];
}

//DIPLOS
mysql_select_db($database_otono2011, $otono2011);
$query_progs_diplos = "SELECT * FROM site_programs WHERE program_type = 'diplomado' AND cancelado = 0 AND id_discipline  = ".$_GET['id_discipline']." AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-00-00' AND periodo = 'p') ORDER BY program_name ASC";
$progs_diplos = mysql_query($query_progs_diplos, $otono2011) or die(mysql_error());    
$row_progs_diplos = mysql_fetch_assoc($progs_diplos);
$totalRows_progs_diplos = mysql_num_rows($progs_diplos);

mysql_select_db($database_otono2011, $otono2011);
$query_progs_diplos_2 = "SELECT * FROM site_programs WHERE program_type = 'diplomado' AND cancelado = 0 AND id_discipline_alterna  = ".$_GET['id_discipline']." AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-00-00' AND periodo = 'p') ORDER BY program_name ASC";
$progs_diplos_2 = mysql_query($query_progs_diplos_2, $otono2011) or die(mysql_error());
$row_progs_diplos_2 = mysql_fetch_assoc($progs_diplos_2);
$totalRows_progs_diplos_2 = mysql_num_rows($progs_diplos_2);

mysql_select_db($database_otono2011, $otono2011);
$query_progs_diplos_3 = "SELECT * FROM site_programs WHERE program_type = 'diplomado' AND cancelado = 0 AND id_discipline_alterna_2  = ".$_GET['id_discipline']." AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-00-00' AND periodo = 'p') ORDER BY program_name ASC";
$progs_diplos_3 = mysql_query($query_progs_diplos_3, $otono2011) or die(mysql_error());
$row_progs_diplos_3 = mysql_fetch_assoc($progs_diplos_3);
$totalRows_progs_diplos_3 = mysql_num_rows($progs_diplos_3);

//CURSOS
mysql_select_db($database_otono2011, $otono2011);
$query_progs_cursos = "SELECT * FROM site_programs WHERE program_type = 'curso' AND cancelado = 0 AND cancelado = 0 AND id_discipline = ".$_GET['id_discipline']." AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2012-12-06' AND periodo = 'p') ORDER BY idioma ASC, program_name ASC";
$progs_cursos = mysql_query($query_progs_cursos, $otono2011) or die(mysql_error());
$row_progs_cursos = mysql_fetch_assoc($progs_cursos);
$totalRows_progs_cursos = mysql_num_rows($progs_cursos);

mysql_select_db($database_otono2011, $otono2011);
$query_progs_cursos_2 = "SELECT * FROM site_programs WHERE program_type = 'curso' AND cancelado = 0 AND cancelado = 0 AND id_discipline_alterna  = ".$_GET['id_discipline']." AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE  fecha >= '2012-12-06' AND periodo = 'p') ORDER BY idioma ASC, program_name ASC";
$progs_cursos_2 = mysql_query($query_progs_cursos_2, $otono2011) or die(mysql_error());
$row_progs_cursos_2 = mysql_fetch_assoc($progs_cursos_2);
$totalRows_progs_cursos_2 = mysql_num_rows($progs_cursos_2);

mysql_select_db($database_otono2011, $otono2011);
$query_progs_cursos_3 = "SELECT * FROM site_programs WHERE program_type = 'curso' AND cancelado = 0 AND cancelado = 0 AND id_discipline_alterna_2  = ".$_GET['id_discipline']." AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2012-12-06' AND periodo = 'p') ORDER BY idioma ASC, program_name ASC";
$progs_cursos_3 = mysql_query($query_progs_cursos_3, $otono2011) or die(mysql_error());
$row_progs_cursos_3 = mysql_fetch_assoc($progs_cursos_3);
$totalRows_progs_cursos_3 = mysql_num_rows($progs_cursos_3);

//PROGRAMAS HP
mysql_select_db($database_otono2011, $otono2011);
$query_progs_hp = "SELECT * FROM site_programs WHERE program_type = 'programahp'  AND cancelado = 0 AND id_discipline_alterna = ".$_GET['id_discipline']." AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-00-00' AND periodo = 'p') ORDER BY idioma ASC, program_name ASC";
$progs_hp = mysql_query($query_progs_hp, $otono2011) or die(mysql_error());
$row_progs_hp = mysql_fetch_assoc($progs_hp);
$totalRows_progs_hp = mysql_num_rows($progs_hp);

//PROGRAMAS
mysql_select_db($database_otono2011, $otono2011);
$query_progs_progs = "SELECT * FROM site_programs WHERE program_type = 'programa' AND cancelado = 0 AND id_discipline = ".$_GET['id_discipline']." AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2012-12-06' AND periodo = 'p') ORDER BY idioma ASC, program_name ASC";
$progs_progs = mysql_query($query_progs_progs, $otono2011) or die(mysql_error());
$row_progs_progs = mysql_fetch_assoc($progs_progs);
$totalRows_progs_progs = mysql_num_rows($progs_progs);

//TALLERES
mysql_select_db($database_otono2011, $otono2011);
$query_progs_talleres = "SELECT * FROM site_programs WHERE program_type = 'taller' AND cancelado = 0 AND cancelado = 0 AND id_discipline = ".$_GET['id_discipline']." AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE periodo = 'p') ORDER BY idioma ASC, program_name ASC";
$progs_talleres = mysql_query($query_progs_talleres, $otono2011) or die(mysql_error());
$row_progs_talleres = mysql_fetch_assoc($progs_talleres);
$totalRows_progs_talleres = mysql_num_rows($progs_talleres);

//IDIOMAS
mysql_select_db($database_otono2011, $otono2011);
$query_progs_cursos_i = "SELECT * FROM site_programs WHERE program_type = 'curso' AND cancelado = 0 AND idioma = 1 AND cancelado = 0 AND id_discipline = ".$_GET['id_discipline']." AND id_program IN (SELECT id_program FROM site_fechas_idiomas WHERE inicio >= '2013-00-00' AND periodo = 'p') ORDER BY idioma ASC, program_name ASC";
$progs_cursos_i = mysql_query($query_progs_cursos_i, $otono2011) or die(mysql_error());
$row_progs_cursos_i = mysql_fetch_assoc($progs_cursos_i);
$totalRows_progs_cursos_i = mysql_num_rows($progs_cursos_i);	

//Query articulos
if($_GET['id_article'] == NULL || $_GET['id_article'] == ''){
	mysql_select_db($database_otono2011, $otono2011);
	$query_pictures = "SELECT picture FROM discipline_articles WHERE id_discipline = ".$_GET['id_discipline']." ORDER BY date DESC LIMIT 0,1";
	$pictures = mysql_query($query_pictures, $otono2011) or die(mysql_error());
	$row_pictures = mysql_fetch_assoc($pictures);
	$totalRows_pictures = mysql_num_rows($pictures);
	
	mysql_select_db($database_otono2011, $otono2011);
	$query_disciplines = "SELECT * FROM discipline_articles WHERE id_discipline = ".$_GET['id_discipline']." ORDER BY date DESC LIMIT 0,1";
	$disciplines = mysql_query($query_disciplines, $otono2011) or die(mysql_error());
	$row_disciplines = mysql_fetch_assoc($disciplines);
	$totalRows_disciplines = mysql_num_rows($disciplines);
}else{
	mysql_select_db($database_otono2011, $otono2011);
	$query_pictures = "SELECT picture FROM discipline_articles WHERE id_article = ".$_GET['id_article']." AND id_discipline = ".$_GET['id_discipline']." ORDER BY date DESC LIMIT 0,1";
	$pictures = mysql_query($query_pictures, $otono2011) or die(mysql_error());
	$row_pictures = mysql_fetch_assoc($pictures);
	$totalRows_pictures = mysql_num_rows($pictures);
	
	mysql_select_db($database_otono2011, $otono2011);
	$query_disciplines = "SELECT * FROM discipline_articles WHERE id_article = ".$_GET['id_article']." AND  id_discipline = ".$_GET['id_discipline']." ORDER BY date DESC LIMIT 0,1";
	$disciplines = mysql_query($query_disciplines, $otono2011) or die(mysql_error());
	$row_disciplines = mysql_fetch_assoc($disciplines);
	$totalRows_disciplines = mysql_num_rows($disciplines);
}

mysql_select_db($database_otono2011, $otono2011);
$query_temp = "SELECT discipline FROM disciplines WHERE id_discipline = ".$_GET['id_discipline'];
$temp = mysql_query($query_temp, $otono2011) or die(mysql_error());
$row_temp = mysql_fetch_assoc($temp);
$totalRows_temp = mysql_num_rows($temp);

/*
mysql_select_db($database_otono2011, $otono2011);
$query_ad = "SELECT * FROM ads ORDER BY `date` DESC LIMIT 0, 1";
$ad = mysql_query($query_ad, $otono2011) or die(mysql_error());
$row_ad = mysql_fetch_assoc($ad);
$totalRows_ad = mysql_num_rows($ad);
*/
//CODIGO PARA QUE ASIGNE FORMATO LOCAL A LAS FECHAS
setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
//++++++++++++++++++++

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/programas_articulos.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title><?php echo $row_temp['discipline'].' - '.$row_disciplines['title'];?></title>
<!-- InstanceEndEditable -->
<link href="css/estilos_dan.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="Scripts/jquery-ui.css" type="text/css" media="all" />
<link href="pruebas/css/jquery.tweet.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="Scripts/jquery.js"></script>
<script type="text/javascript" src="Scripts/menu2.js"></script>
<script src="Scripts/jquery-ui.js"></script>
<script language="javascript" src="pruebas/js/jquery.tweet.js" type="text/javascript"></script>
<!------ Google Analytics ------>
<script type="text/javascript">

 var _gaq = _gaq || [];
 _gaq.push(['_setAccount', 'UA-24531403-1']);
 _gaq.push(['_trackPageview']);

 (function() {
   var ga = document.createElement('script'); ga.type =
'text/javascript'; ga.async = true;
   ga.src = ('https:' == document.location.protocol ? 'https://ssl' :
'http://www') + '.google-analytics.com/ga.js';
   var s = document.getElementsByTagName('script')[0];
s.parentNode.insertBefore(ga, s);
 })();

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

</script>

<!-- widget twitter -->

<script type='text/javascript'>
    $(document).ready(function(){
        $(".tweet").tweet({
            username: "DiplomadosIbero",
            avatar_size: 20,
            count: 4,
            loading_text: "cargando tweets..."
        });

		//resaltar disciplina en el menu dependiendo del programa o articulo
        var results = new RegExp('[\\?&amp;]id_discipline=([^&amp;#]*)').exec(window.location.href);
        $('.discipline_'+results[1]).css('background-color', '#D6D7D9')
        
    });
</script>

<!-- widget twitter -->

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
  <div id="header" style="margin-top:16px">
    <div id="logos"> <a href="http://uia.mx/" target="_blank"><img src="imagenes/logo_UIA.jpg" alt="logo" width="100" height="78" border="0" class="logo"/></a><a href="#" onclick="parent.location='http://www.dec-uia.com/primavera2013/index.php'"><img src="imagenes/logo_DEC.jpg" alt="DEC" width="90" height="78" border="0" /></a></div>
    <div id="primavera" style="margin-bottom:8px"></div>
    <div id="menu" style="float:none;width:1016px">
   	<a href="https://twitter.com/DiplomadosIbero" target="_blank"><div style="float:right;height:24px;width:33px;background-image: url(imagenes/twitter.png);border-left:3px;margin-left:11px;margin-right:13px"></div></a>
    <a href="http://www.facebook.com/diplomados.uia" target="_blank"><div style="float:right; height:24px;width:12px;background-image: url(imagenes/facebook.png);margin-left:10px"></div></a>
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
    <div class="bannersuperior2" style="width:706px"></div>
    <br />
    <div id="slide_menu" style="display:none; width:190px; background: url(imagenes/sombrita_submenu.png) repeat-y; background-color:#D6D7D9; position:relative; left:189px; top:19px; z-index:1000; margin-bottom:-1000px">

   </div>
  </div>
  <div id="separador"></div>
    <div id="slide_servicios" style="display: none; width:131px; height:140px; padding-top:10px; background-color: #FFF; z-index: 1007; margin-top:-162px; position:relative; top:148px; left:372px; border:solid 1px #EFEFEF; float:left;">
	<ul style="list-style:none; padding-left:16px; width:110px;">
	<li style="padding-bottom:10px;"><a href="http://enlinea.uia.mx/tes_dec/dec_login.cfm" target="_blank">Servicios en l&iacute;nea</a></li>
	<li style="padding-bottom:10px;"><a href="https://enlinea.uia.mx/sit/SitActividadesEsp.cfm" target="_blank">Pago de traducciones</a></li>
	<li style="padding-bottom:10px;"><a href="http://www.dec-uia.com/primavera2013/temarios/politcas_cobranza.pdf" target="_blank">Pol&iacute;ticas cobranza</a></li>
	<li style="padding-bottom:10px;"><a href="http://www.www.dec-uia.com/primavera2013/tutorial_pagos.php">Tutorial pagos en l&iacute;nea</a></li></ul>
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
            <li><a class="discipline_3" onclick="showMenu(3)">Diseño</a></li>
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
          <h4>Centros de Atención Especializada</h4>
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

 <div style="margin-left:29px">
 <div style="width:69%;float:left;margin-left:0px">
 <div id="slide_search" style="border: 1px solid #E0E0E0; display:none; position:relative; margin-top:-202px; top:890px; left:0px; width:192px; height:200px; background-color:#FFF; z-index:1000;">
	<form name="buscador" action="resultados.php" method="post">
		<label for="buscar"></label>
	    <img src="imagenes/piquito_rojo_buscador.png">
	    <input name="buscar" placeholder="¿Qué tema buscas?" type="text" id="buscar" style="margin:0 0 0 14px; width:150px; height:11px; padding:1px; border:1px solid #999999; font-size:11px;"  />
	    <input name="search" type="submit" id="search" value="n" style="color:#D1D1D1; font-size:1px; width:49px; height:16px; background:url(imagenes/boton_buscar.jpg) top center no-repeat; border:none; margin: 10px 0px 0px 129px;" />
	    <br />
		<table width="180" border="0" cellspacing="0" cellpadding="0" style="margin:10px 0 0 12px;">
	    	<thead>
	    		<tr colspan="3" style="text-align:left; height:20px;font-size:11px;">
	    			<th width="20px" colspan="3">Búsqueda Avanzada (opcional)</th>
	    		</tr>
	    	</thead>
	    	<tr>
	        	<td colspan="3">
	        		 <select name="sArea" id="sArea" style="margin:0px; width:138px; height:15px; border:1px solid #999999; line-height:0; font-size:11px;">
						<option disabled="disabled" value="0" selected="selected" >¿Qu&eacute; &aacute;rea te interesa?</option>
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
						<option value="diseño">Diseño</option>
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
		        	¿Cu&aacute;ndo quieres comenzar?
		        </td>
	        </tr>
	        <tr>
	        	<td colspan="3" style="font-size:9px;">
		        	Escoge una fecha precisa o un periodo
		        </td>
	        </tr>
	        
	        <tr style="margin-top:10px;"valign="middle">
	        	<td width="63px">
	        		<input type="text" id="datepickerI" name="datepickerI" style="margin:0px; width:55px; height:11px; padding:1px; border:1px solid #999999; line-height:0; font-size:11px;"/>	
	        		<img src="imagenes/calendario.jpg">
	        	</td>
	            <td  width="63px">
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

  <div id= "contenedor_irregular" style="float:left; margin-left:36px; width:795px" >
<?php
    if($_GET['id_discipline']== 14 && $_GET['id_article']==269){ ?>
    <div id= "type4" class="cuadro_articulos"> <img class="articulos_img" src="imagenes/uploads/discipline_articles/idiomas.jpg" width="790" height="266" /> 
    </div>
		<?php
	}elseif($_GET['id_discipline']== 1 && $_GET['id_article']==260){ ?>
		<div id= "type4" class="cuadro_articulos"> <img class="articulos_img" src="imagenes/uploads/discipline_articles/arquitectura.jpg" width="790" height="266" /> 
		</div>

			<?php
		}elseif($_GET['id_discipline']== 3 && $_GET['id_article']==279){ ?>
			<div id= "type4" class="cuadro_articulos"> <img class="articulos_img" src="imagenes/uploads/discipline_articles/diseno.jpg" width="790" height="266" /> 
			</div>

				<?php
			}elseif($_GET['id_discipline']== 7 && $_GET['id_article']==277){ ?>
				<div id= "type4" class="cuadro_articulos"> <img class="articulos_img" src="imagenes/uploads/discipline_articles/derecho.jpg" width="790" height="266" /> 
				</div>

					<?php
				}elseif($_GET['id_discipline']== 5 && $_GET['id_article']==271){ ?>
					<div id= "type4" class="cuadro_articulos"> <img class="articulos_img" src="imagenes/uploads/discipline_articles/deshumano.jpg" width="790" height="266" /> 
					</div>

						<?php
					}elseif($_GET['id_discipline']== 6 && $_GET['id_article']==280){ ?>
						<div id= "type4" class="cuadro_articulos"> <img class="articulos_img" src="imagenes/uploads/discipline_articles/salud1.jpg" width="790" height="266" /> 
						</div>

							<?php
						}elseif($_GET['id_discipline']== 8 && $_GET['id_article']==268){ ?>
							<div id= "type4" class="cuadro_articulos"> <img class="articulos_img" src="imagenes/uploads/discipline_articles/negocios.jpg" width="790" height="266" /> 
							</div>

								<?php
							}elseif($_GET['id_discipline']== 9 && $_GET['id_article']==278){ ?>
								<div id= "type4" class="cuadro_articulos"> <img class="articulos_img" src="imagenes/uploads/discipline_articles/tecnologia.jpg" width="790" height="266" /> 
								</div>

										<?php
										}elseif($_GET['id_discipline']== 10 && $_GET['id_article']==266){ ?>
										<div id= "type4" class="cuadro_articulos"> <img class="articulos_img" src="imagenes/uploads/discipline_articles/humanidades.jpg" width="790" height="266" /> 
										</div>

												<?php
												}elseif($_GET['id_discipline']== 11 && $_GET['id_article']==274){ ?>
												<div id= "type4" class="cuadro_articulos"> <img class="articulos_img" src="imagenes/uploads/discipline_articles/profe-gastronomia.jpg" width="790" height="266" /> 
												</div>

													<?php
													}elseif($_GET['id_discipline']== 12 && $_GET['id_article']==275){ ?>
													<div id= "type4" class="cuadro_articulos"> <img class="articulos_img" src="imagenes/uploads/discipline_articles/prepa2.jpg" width="790" height="266" /> 
													</div>

														<?php
														}elseif($_GET['id_discipline']== 15 && $_GET['id_article']==270){ ?>
														<div id= "type4" class="cuadro_articulos"> <img class="articulos_img" src="imagenes/uploads/discipline_articles/online.jpg" width="790" height="266" /> 
														</div>

														<?php
														}elseif($_GET['id_discipline']== 16 && $_GET['id_article']==273){ ?>
														<div id= "type4" class="cuadro_articulos"> <img class="articulos_img" src="imagenes/uploads/discipline_articles/empresas.jpg" width="790" height="266" /> 
														</div>
								<?php
								
									}
								
 else {
	?>
    <div id= "type4" class="cuadro_articulos"> <img class="articulos_img" src="imagenes/uploads/discipline_articles/<?php echo $row_pictures['picture']; ?>" width="790" height="266" /> 
    </div>
    <?php
}
?>
    <div id= "type4" class="rectangulo_abajo">
    	      <div class="textos" style="margin-left:7px"><!-- InstanceBeginEditable name="contenido" -->
    	      	<br>
        <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
          <tr>
            
          <table>
         	<tr>
				<td width="17%" rowspan="2" valign="top">
					<img src="imagenes/uploads/discipline_articles/thumbnails/<?php echo $row_disciplines['thumbnail'];?>" width="120" height="114" border="0" />
				</a></td>
				<td width="2%" rowspan="2">&nbsp;</td>
				<td colspan="2"><p class="contenido_diploRojo"><strong><span><?php echo $row_disciplines['title'];?></strong></span></p>
					<p><strong><em><?php echo $row_disciplines['interviewee_name'];?></em></strong>
				  <p>
				    <?php 
				echo strftime("%d de %B de %Y", strtotime($row_disciplines['date']));
				?>
			      </td>
			  </tr>
		  </table>


          <tr>
            <td colspan="2" valign="top">
            <br>             
               
              </p>
              <p te>
                <?php 
					  
					  echo $row_disciplines['content']
					  ;?>
              </p>
              
              
            </td>
          </tr>
          <?php if($row_disciplines['id_program'] != NULL){ ?>
          <tr>
            <td colspan="2" valign="top">
            
            
            
            
            <p>
                <?php
					mysql_select_db($database_otono2011, $otono2011);
					$query_progs = sprintf("SELECT program_type, id_discipline, program_name, id_encargado, idioma FROM site_programs WHERE id_program = %s", 
						GetSQLValueString($row_disciplines['id_program'] , "int"));
					$prog_tipo = mysql_query($query_progs, $otono2011) or die(mysql_error());
					$row_prog_tipo = mysql_fetch_assoc($prog_tipo);
					echo ucfirst($row_prog_tipo['program_type']);
					if ($row_prog_tipo ["idioma"] ==1) {
						
					?>
                    <a onclick="parent.location='http://www.dec-uia.com/primavera2013/idiomas.php?id_discipline=<?php echo $row_prog_tipo['id_discipline'];?>&id_program=<?php echo $row_disciplines['id_program'];?>'" href="http://www.dec-uia.com/primavera2013/idiomas.php?id_discipline=<?php echo $row_prog_tipo['id_discipline'];?>&id_program=<?php echo $row_disciplines['id_program'];?>" > <strong><?php echo $row_prog_tipo['program_name'];?></strong></a>
                    <?php } else { ?>
					
                <a onclick="parent.location='http://www.dec-uia.com/primavera2013/programas.php?id_discipline=<?php echo $row_prog_tipo['id_discipline'];?>&id_program=<?php echo $row_disciplines['id_program'];?>'" href="http://www.dec-uia.com/primavera2013/programas.php?id_discipline=<?php echo $row_prog_tipo['id_discipline'];?>&id_program=<?php echo $row_disciplines['id_program'];?>" > <strong><?php echo $row_prog_tipo['program_name'];?></strong></a> </p>
                
                <?php }   ?>
                
              <p>Para mayores informes e inscripciones</p>
              <p>
              	<table width="450px">
              		<tr>

                <?php
						$enc = explode(',', $row_prog_tipo['id_encargado']);
						$num = sizeof($enc);
						for ($i=0; $i<$num; $i++)
						{
							mysql_select_db($database_otono2011, $otono2011);
							$query_enc = sprintf("SELECT * FROM site_directory WHERE id_encargado = %s", 
												 GetSQLValueString($enc[$i] , "int"));
							$prog_enc = mysql_query($query_enc, $otono2011) or die(mysql_error());
							$row_prog_enc = mysql_fetch_assoc($prog_enc);
							echo "<td>";
							echo $row_prog_enc['nombre']; ?>
                <br />
                Tel. <?php echo $row_prog_enc['telefono']; ?>, ext. <?php echo $row_prog_enc['extension']; ?> <br />
                <a href="mailto:<?php echo $row_prog_enc['correo']; ?>"><?php echo $row_prog_enc['correo']; ?> </a> <br />
              </p>
          </td>
              <?php  }?>
          </tr></table>
              </p></td>
          </tr>
          <?php } ?>
          <tr>
          	<td width="20%" height="18" valign="top" class="titulos_diplo"><p class="ruta"><a onclick="parent.location='discipline_articles.php?id_discipline=<?php echo $_GET['id_discipline']; ?>'"><img src="imagenes/buttons/historico_entrevistas.gif" style="cursor:pointer" width="124" height="26" /></a></p></td>
          </tr>
        </table>
        <!-- InstanceEndEditable -->
        <table width="100%" border="0" align="left">
          <tr>
            <td><!-- AddThis Button BEGIN -->
              
              <div class="addthis_toolbox addthis_default_style"
						addthis:url="articulos.php?id_discipline=<? echo $_GET['id_discipline']; ?>"
						addthis:title="<?php echo $row_temp['discipline'].' - '.$row_disciplines['title'];?>"> <a class="addthis_counter addthis_pill_style"></a> </div>
              <script type="text/javascript">
					var addthis_config = {"data_track_clickback":true};
					</script> 
              <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=pvazquezdiaz"></script> 
              <!-- AddThis Button END --></td>
          </tr>
        </table>
      </div>
      <div class="corner bottomLeft"></div>
      <!--div class="corner bottomRight"></div-->
    </div>
    

<div style="width:25%; float:left; margin-left:43px; margin-top:18px">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>        	
        	<td align="center"><a onclick="parent.location='http://www.diplomados.uia.mx/promociones.php'" href="#"><img src="imagenes/banner_descuentos.png" width="181px" border="0" /></a></td>
          	</tr>
          
          <tr>
            <td align="center"><a onclick="parent.location='http://www.diplomados.uia.mx/propuestas_cursos.php'" href="#"><img src="imagenes/banner_solicitalo.png" width="181px" height="115" border="0" /></a></td>
          </tr>
          
           <tr>
            <td valign="bottom" width="191px" height="120" align="left" style="background: url(imagenes/banner_newsletter.png) no-repeat bottom transparent; width:191px;">
            	<form action="http://www.diplomados.uia.mx/cgi-bin/dada/mail.cgi" method="post" target="_blank" name="form_news" id="form_news">
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

  <div id="footer" style="float:left">
    <table width="810" border="0" cellpadding="0" cellspacing="0" >
      <tr>
        <td width="810"><a onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=20'" href="#"><img src="imagenes/banners/idiomas_otono.jpg" alt="Dos" width="804" height="142" border="0" /></a></td>
         </tr>
      <tr align="center" valign="middle">
        <td><p><strong>&copy; Universidad Iberoamericana Ciudad
            de México. </strong><br>
          </p>
          <address>
          Prol. Paseo de la Reforma 880, edificio G, P.B.
          Lomas de Santa Fe, México, C.P. 01219, Distrito Federal. <br>
          Tel. (55) 59.50.40.00
          y 91.77.44.00 Lada nacional sin costo: 01 800 627 7615
          </address></td>
      </tr>
    </table>
  </div>
</div>
<map name="Map2" id="Map2">
  <area shape="rect" coords="48,102,78,135" href="https://www.facebook.com/diplomados.uia" target="_blank" />
  <area shape="rect" coords="80,102,107,133" href="http://twitter.com/DiplomadosIbero" target="_blank" />
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
<?php
mysql_free_result($progs_diplos);

mysql_free_result($pictures);

mysql_free_result($disciplines);
?>
