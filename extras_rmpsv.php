<?php //require_once('Connections/otono2011.php'); ?>
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

/*$query_media_articles = "SELECT id_article, title FROM media_articles ORDER BY date DESC LIMIT 0, 4";
$media_articles = mysql_query($query_media_articles, $otono2011) or die(mysql_error());*/
//$row_media_articles = mysql_fetch_assoc($media_articles);
//$totalRows_media_articles = mysql_num_rows($media_articles);

/*mysql_select_db($database_otono2011, $otono2011);
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
$totalRows_ad = mysql_num_rows($ad);*/

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
<title>Direcci&oacute;n de Educaci&oacute;n Continua | UIA</title>
<!-- InstanceEndEditable -->
<link href="css/estilos_dan.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="Scripts/jquery-ui.css" type="text/css" media="all" />
<!------ Google Analytics ------>

<script type="text/javascript" src="Scripts/jquery.js"></script>
<script type="text/javascript" src="Scripts/menu.js"></script>
<script type="text/javascript" src="jquery.carouFredSel-6.1.0.js"></script>
<script type="text/javascript" src="jquery.carouFredSel-6.1.0-packed.js"></script>
<script src="Scripts/jquery-ui.js"></script>

<script type="text/javascript">

	$(document).ready(function(){
		/*$(".foo5").carouFredSel({
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
		})*/
		if ($.browser.msie){
	        $("#menu ul").attr("style","margin-left:157px;")
	        $(".nombre_form").attr("style","margin-right:76px;")
	        $(".apellido_form").attr("style","margin-right:50px;")
	        $(".add_amigo").css("margin-left","313px")
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
<!--<div id="container" style="font-family: none;">-->
  <div id="header">
    <div id="logos"> <a href="http://uia.mx/" target="_blank"><img src="imagenes/logo_UIA.jpg" alt="logo" width="100" height="78" border="0" class="logo"/></a><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/index.php'"><img src="imagenes/logo_DEC.jpg" alt="DEC" width="90" height="78" border="0" /></a></div>
    <div id="primavera" style="margin-bottom:8px"></div>
    <div id="menu" style="float:none;width:1016px">
   	<a href="https://twitter.com/DiplomadosIbero" target="_blank"><div style="float:right;height:24px;width:33px;background-image: url(imagenes/twitter.png);border-left:3px;margin-left:11px;margin-right:13px"></div></a>
    <a href="http://www.facebook.com/diplomados.uia" target="_blank"><div style="float:right; height:24px;width:12px;background-image: url(imagenes/facebook.png);margin-left:10px"></div></a>
      <ul style="margin-left:187px;">
        <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/index.php'">Inicio</a></li>
        <li>|</li>
        <li><a href="#" onclick="parent.location='nosotros.php'">Nosotros</a></li>
        <li>|</li>
        <li><!--a href="http://enlinea.uia.mx/tes_dec/dec_login.cfm" target="_blank"--><a href="#" id="servicios_en_linea">Servicios y Pagos en l&iacute;nea</a></li>
        <li>|</li>
        <li><a href="#" onclick="parent.location='promociones.php'">Promociones</a></li>
        <li>|</li>
        <li><a href="#" onclick="parent.location='preinscripcion.php'">Preinscripci&oacute;n</a></li>
        <li>|</li>
        <li><a href="#" onclick="parent.location='directorio.php'">Directorio</a></li>
        <li>|</li>
        <li><a href="#" onclick="parent.location='contacto.php'">Informes</a></li>
      </ul>
     </div>
    <div class="bannersuperior2" style="width:706px"></div>
    <div id="slide_menu" style="display:none; width:190px; background: url(imagenes/sombrita_submenu.png) repeat-y; background-color:#D6D7D9; position:relative; left:189px; top:19px; z-index:1000; margin-bottom:-1000px">

  	 </div>
  </div>

  <div id="separador"></div>
    <div id="slide_servicios" style="display: none; width:131px; height:140px; padding-top:10px; background-color: #FFF; z-index: 1007; margin-top:-162px; position:relative; top:148px; left:372px; border:solid 1px #EFEFEF; float:left;">
<ul style="list-style:none; padding-left:16px; width:110px;">
<li style="padding-bottom:10px;"><a href="http://enlinea.uia.mx/tes_dec/dec_login.cfm" target="_blank">Servicios en l&iacute;nea</a></li>
<li style="padding-bottom:10px;"><a href="https://enlinea.uia.mx/sit/SitActividadesEsp.cfm" target="_blank">Pago de traducciones</a></li>
<li style="padding-bottom:10px;"><a href="temarios/politcas_cobranza.pdf" target="_blank">Pol&iacute;ticas cobranza</a></li>
<li style="padding-bottom:10px;"><a href="tutorial_pagos.php">Tutorial pagos en l&iacute;nea</a></li></ul>
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

<div id="espacio" style="width:5%;float:left">

</div>
	<script type="text/javascript">
	$(document).ready(function(){
            $(".add_amigo").live("click",function(){
                form_amigo()
            })
            $("#submit").click(validacion)

        })
		 num_amigo=2;
            function form_amigo(){
            	 $(".add_amigo").remove()
            	  //$("#submit").remove()
                if(num_amigo<4){
                    $("#contenedor_forms form .campos").append("<div id=amigo"+num_amigo+" style='margin-right: 10px'>")
                    $("#amigo"+num_amigo+"").prepend("<div class='datos'>")
                    $("#amigo"+num_amigo+" .datos").append("<span style='color:#ec1c23;font-size: 15px;'>Registra a tu amigo<br></span>")
                    $("#amigo"+num_amigo+" .datos").append("<label style='margin-right:60px' class='nomobre_form'>* Nombre(s):</label><label style='margin-right:32px' class='apellido_form'>* Apellido paterno</label><label>* E-mail</label><br>")
                    $("#amigo"+num_amigo+" .datos").append("<input type=text name=nombre_amigo"+num_amigo+" ><input type=text name=A_paterno_amigo"+num_amigo+"> <input type=text name=mail_amigo"+num_amigo+"><br>")
                    $("#amigo"+num_amigo+" .datos").append("<input type=button  class='add_amigo' style='background:url(imagenes/boton_registraotroamigo.png);width: 129px;border: 0px;height: 20px;margin-right: 10px; margin-left: 257px;margin-top: -24px;position: relative;'>")
                    //$("#amigo"+num_amigo+" .datos").append("<input type='image'  id='submit' src='imagenes/boton_finalizaregistro.png' style='margin-bottom: -9px;'>")
                    num_amigo+=1
                }
                if(num_amigo==4){
                    $(".add_amigo").remove()
                }
            }
            function validacion(){
                var emailreg = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
                if($("input[name=nombre]").val()==""){
                     $("input[name=nombre]").css("background","#eb1a1d")
                      $("input[name=nombre]").focus()
                      $("input[name=A_paterno]").css("background","white")
                       $("input[name=mail]").css("background","white")
                        $("input[name=mail]").css("background","white")
                         $("input[name=nombre_amigo1]").css("background","white")
                          $("input[name=A_paterno_amigo1]").css("background","white")
                           $("input[name=mail_amigo1]").css("background","white")
                    return false;
                }
                else if ($("input[name=A_paterno]").val()==""){
                     $("input[name=nombre]").css("background","white")
                       $("input[name=mail]").css("background","white")
                        $("input[name=mail]").css("background","white")
                         $("input[name=nombre_amigo1]").css("background","white")
                          $("input[name=A_paterno_amigo1]").css("background","white")
                           $("input[name=mail_amigo1]").css("background","white")
                     $("input[name=A_paterno]").css("background","#eb1a1d")
                      $("input[name=A_paterno]").focus()
                    return false;
                }
                else if($("input[name=mail]").val()==""){
                     $("input[name=A_paterno]").css("background","white")
                      $("input[name=nombre]").css("background","white")
                       $("input[name=mail]").css("background","white")
                         $("input[name=nombre_amigo1]").css("background","white")
                          $("input[name=A_paterno_amigo1]").css("background","white")
                           $("input[name=mail_amigo1]").css("background","white")
                     $("input[name=mail]").css("background","#eb1a1d")
                     $("input[name=mail]").focus()
                    return false;
                }
                else if(!emailreg.test($("input[name=mail]").val())){
                     $("input[name=mail]").css("background","white")
                      $("input[name=A_paterno]").css("background","white")
                      $("input[name=nombre]").css("background","white")
                       $("input[name=mail]").css("background","white")
                         $("input[name=nombre_amigo1]").css("background","white")
                          $("input[name=A_paterno_amigo1]").css("background","white")
                           $("input[name=mail_amigo1]").css("background","white")
                    $("input[name=mail]").css("background","#eb1a1d")
                     $("input[name=mail]").focus()
                    return false;
                }
                else if($("input[name=nombre_amigo1]").val()==""){
                     $("input[name=mail]").css("background","white")
                      $("input[name=A_paterno]").css("background","white")
                      $("input[name=nombre]").css("background","white")
                         $("input[name=nombre_amigo1]").css("background","white")
                          $("input[name=A_paterno_amigo1]").css("background","white")
                           $("input[name=mail_amigo1]").css("background","white")
                     $("input[name=nombre_amigo1]").css("background","#eb1a1d")
                      $("input[name=nombre_amigo1]").focus()
                    return false;
                }
                else if ($("input[name=A_paterno_amigo1]").val()==""){
                     $("input[name=mail]").css("background","white")
                      $("input[name=A_paterno]").css("background","white")
                      $("input[name=nombre]").css("background","white")
                         $("input[name=nombre_amigo1]").css("background","white")
                          $("input[name=A_paterno_amigo1]").css("background","white")
                           $("input[name=mail_amigo1]").css("background","white")
                     $("input[name=A_paterno_amigo1]").css("background","#eb1a1d")
                     $("input[name=A_paterno_amigo1]").focus()
                    return false;
                }
                else if($("input[name=mail_amigo1]").val()==""){
                     $("input[name=mail]").css("background","white")
                      $("input[name=A_paterno]").css("background","white")
                      $("input[name=nombre]").css("background","white")
                         $("input[name=nombre_amigo1]").css("background","white")
                          $("input[name=A_paterno_amigo1]").css("background","white")
                           $("input[name=mail_amigo1]").css("background","white")
                     $("input[name=mail_amigo1]").css("background","#eb1a1d")
                     $("input[name=mail_amigo1]").focus()
                    return false;
                }
                else if(!emailreg.test($("input[name=mail_amigo1]").val())){
                    $("input[name=mail]").css("background","white")
                      $("input[name=A_paterno]").css("background","white")
                      $("input[name=nombre]").css("background","white")
                         $("input[name=nombre_amigo1]").css("background","white")
                          $("input[name=A_paterno_amigo1]").css("background","white")
                           $("input[name=mail_amigo1]").css("background","white")
                    $("input[name=mail_amigo1]").css("background","#eb1a1d")
                    $("input[name=mail_amigo1]").focus()
                    return false;
                }
                else if($(".terminos:checked").length!=1){
                	$("input[name=mail]").css("background","white")
                      $("input[name=A_paterno]").css("background","white")
                      $("input[name=nombre]").css("background","white")
                         $("input[name=nombre_amigo1]").css("background","white")
                          $("input[name=A_paterno_amigo1]").css("background","white")
                           $("input[name=mail_amigo1]").css("background","white")
                	alert("No has aceptado los términos")
                	return false;

                }
                else{
                    return true;
                }
            }

	</script>

	<div id= "contenedor_irregular_index">
		<?php
			$alerta=$_GET["success"];
 			if($alerta==1){
		?>
			 <img style="margin-left:35px;" src="banner_pagina_formulario.png">
					      			<div class="body" style="width: 775px;height: 600px;margin-left: 34px;">
					      				<h1 style="font-size: 30px;margin-bottom: 20px;">¡Gracias!</h1>
					      				<span style="color: red;font-size: 17px;">Hemos recibido tu información exitosamente</span>
					      				<p style="font-size: 15px;">En breve recibirás en tu correo electrónico tu <span style="font-size: 15px;font-weight: bold;">código de promoción </span> y los pasos que deberás seguir para continuar con el proceso.</p>
					      			</p><span style="color: red;">* </span>Te recomendamos revisar la bandeja de correo no deseado.</p>

					      			</div>
 	<?php
 	}
 	else{
 ?>
	  <img style="margin-left:35px;" src="banner_pagina_formulario.png">
	  	<div id="contenedor_forms" style="width: 100%; top: 0px; position:relative; height: 215px;">

			<form action="../primavera2013/landing_snvalentin/get_data.php" method="post"  style="width: 100%;margin-left: 110px;height: auto; background-repeat: no-repeat;">
				<!--background:url(imagenes/preventivo_pagina.png);-->
				<div class="campos">
		  			<div id="usuario" style="margin-right: 10px">
							         	<div class="datos">
											<span style="color:#ec1c23;font-size: 20px;">Regístrate para asegurar tu lugar en la promoción.<br></span>
											<label style="margin-right:60px;" class="nombre_form">* Nombre(s):</label><label style="margin-right: 32px" class="apellido_form">* Apellido paterno</label><label>* E-mail</label><br>
											<input type="text" name="nombre" style="float:left">
											<input type="text" name="A_paterno">
											<input type="text" name="mail">
										</div>

					</div>
					<div id="amigo1" style="margin-right: 10px;margin-top: 25px;">
						         	<div class="datos">
										<span style="color:#ec1c23;font-size: 15px;">Registra a tu amigo.<br></span>
										<label style="margin-right:60px;" class="nombre_form">* Nombre(s):</label><label style="margin-right:32px" class="apellido_form">* Apellido paterno</label><label>* E-mail</label><br>
										<input type="text" name="nombre_amigo1">
										<input type="text" name="A_paterno_amigo1">
										<input type="text" name="mail_amigo1">
										<p>*Campo obligatorio</p><input type="button"  class="add_amigo" style="background:url(imagenes/boton_registraotroamigo.png);width: 129px;border: 0px;height: 20px;margin-right: 10px;margin-left: 257px;margin-top: -24px;position: relative;">

									</div>
					</div>
				</div>
					<div class="controles"><input type="checkbox" style=" position: relative;" class="terminos"><a id="bases" style="color:red;  cursor:pointer;top: 0px; position: relative;"> He leído y acepto las bases de la promoción </a><br> <input type="image"  id="submit" src="imagenes/boton_finalizaregistro.png" style='margin-bottom: 10px;margin-top: 10px;'><br><a href="http://dec-uia.com/primavera2013/politicas_privacidad.php" target="_blank" style="color:red;  cursor:pointer;top: 0px;left: 13px; position: relative;">*Ver políticas de privacidad</a></div>

			</form>
		</div>
		<div style="width:25%; float:right; margin-left:37px; margin-top:-213px">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
        	<td align="center"><a onclick="parent.location='promociones.php'" href="#"><img src="imagenes/banner_chiquito_valentin.png" width="181px" border="0"></a></td>
          	</tr>
          <tr>
          	<td align="right" valign="top">&nbsp;</td>
          	</tr>
          <tr>
            <td align="center"><a onclick="parent.location='propuestas_cursos.php'" href="#"><img src="imagenes/banner_solicitalo.png" width="181px" height="115" border="0"></a></td>
          </tr>

           <tr>
            <!--<td valign="bottom" width="191px" height="118" align="left" style="background: url(imagenes/banner_newsletter.png) no-repeat bottom transparent; width:191px;">
            	<form action="http://www.dec-uia.com/cgi-bin/dada/mail.cgi" method="post" target="_blank" name="form_news" id="form_news">
                <table width="170" border="0" align="center" cellpadding="5" cellspacing="0">
                  <tbody><tr>
                    <td width="62%" height="10"></td>
                    <td width="38%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="right"><!-- begin subscription_form_widget.tmpl --

                      <input type="hidden" name="list" value="newsDEC">
                      <input type="hidden" name="f" id="f_s" value="subscribe" checked="checked">
                      <input name="email" type="text" id="email" value="" size="15" class="news_input" placeholder="email" background="none"></td>
                    <td align="center"><input onclick="_gaq.push(['_trackEvent', 'Newsletter', 'Click', 'Registro al newsletter']);" type="submit" value="Enviar" class="processing" style="cursor:pointer;font-size:10px; border-radius:1px; color:#FFF; width:55px; border:0px; slid #FFF;"></td>
                  </tr>-->
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
			</table-->

        </tbody>
      </table>

</div>	<?php }?>
	</div>
	<div id="footer" style="float:left;width:810px">
	    <table border="0" cellpadding="0" cellspacing="0" >
	      <tr>
	        <td width="810"><a onclick="parent.location='articulos.php?id_discipline=20'" href="#"><img src="imagenes/banners/idiomas_otono.jpg" alt="Dos" width="804" height="142" border="0" /></a></td>
	        </tr>
	      <tr align="center" valign="middle">
	        <td colspan="2"><p><strong>&copy; Universidad Iberoamericana Ciudad
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
		<div class="bases" style="display:none; z-index:3; position:absolute; color:#000; top:20%; left:34%; width:500px; margin:auto; background-color:#FFF; border:1px solid #666; padding: 10px;">
		<p style="font-weight:bold;">Bases promoci&oacute;n San Valent&iacute;n.<br />
Educaci&oacute;n Continua Ibero.</p>

<p>&bull;&nbsp;&nbsp; &nbsp;Descuento no acumulable con otras promociones.<br /><br />
&bull;&nbsp;&nbsp; &nbsp;Los descuentos aplican para todos los programas ofertados en Primavera 2013 incluyendo los impartidos en sedes externas. Consulta la oferta completa en www.diplomados.uia.mx<br /><br />
&bull;&nbsp;&nbsp; &nbsp;Se deben inscribir al menos 2 personas con el mismo c&oacute;digo de promoci&oacute;n. Las personas pueden inscribirse a distintos programas y con fechas de apertura diferentes.<br /><br />
&bull;&nbsp;&nbsp; &nbsp;El descuento aplica sobre el valor total del programa. Es decir, en caso de diplomados este valor es la suma de la inscripci&oacute;n y todos los m&oacute;dulos.<br /><br />
&bull;&nbsp;&nbsp; &nbsp;Promoci&oacute;n v&aacute;lida del 11 de febrero a las 0.00 hs al 14 de febrero a las 23.59 hs. del a&ntilde;o en curso.<br /><br />
&bull;&nbsp;&nbsp; &nbsp;Cada uno de los integrantes del grupo debe cumplir 2 requisitos:&nbsp;<br /><br />
1) registrarse en la promoci&oacute;n y realizar la preinscripci&oacute;n al programa seleccionado en el periodo de la promoci&oacute;n&nbsp;<br /><br />
2) realizar el pago definido por la Direcci&oacute;n a m&aacute;s tardar en un plazo de 72 hs. despu&eacute;s de haber recibido las claves de pago por correo electr&oacute;nico. Se sugiere que los interesados revisen la bandeja de correo no deseado.<br /><br />
&bull;&nbsp;&nbsp; &nbsp;Si uno de los integrantes no cumpliera con estas condiciones, la promoci&oacute;n queda sin efecto para todo el grupo.<br /><br />
&bull;&nbsp;&nbsp; &nbsp;Los descuentos aplican exclusivamente para quienes cumplan los 2 requisitos en los tiempos definidos en la presente base. No aplica para inscripciones realizadas antes o despu&eacute;s de este periodo.<br /><br />
&bull;&nbsp;&nbsp; &nbsp;Cualquier situaci&oacute;n no contenida en la presente base ser&aacute; resuelta por la Direcci&oacute;n de Educaci&oacute;n Continua de la Universidad Iberoamericana y su soluci&oacute;n ser&oacute; inapelable.</p><br/><br/>
<p id="cerrar_overlay" style="cursor:pointer; color:red; font-weight:bold; width:55px;">[x] Cerrar</p>


	</div>
<map name="Map2" id="Map2">
  <area shape="rect" coords="48,104,79,133" href="https://www.facebook.com/diplomados.uia" target="_blank" />
  <area shape="rect" coords="82,104,107,133" href="http://twitter.com/DiplomadosIbero" target="_blank" />
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


		$(document).mouseup(function (e)
{
    var container = $("div.bases");

    if (container.has(e.target).length === 0)
    {
        $("div.bases").hide();
        $('#opacity').hide();
    }
});

	$('#bases').click(function(){
		$('#opacity').show()
		$('.bases').show()

	})

	$('#cerrar_overlay').click(function(){

		$('.bases').hide()

	})
</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-23217985-5']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript';
ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' :
'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0];
s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
<!-- InstanceEnd --></html>
