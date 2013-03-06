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
$query_progs_diplos = "SELECT * FROM site_programs WHERE program_type = 'diplomado' AND cancelado = 0 AND id_discipline  = ".$_GET['id_discipline']." AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-00-00' AND periodo = 'p')  ORDER BY program_name ASC";
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
$query_progs_talleres = "SELECT * FROM site_programs WHERE program_type = 'taller' AND cancelado = 0 AND id_discipline = ".$_GET['id_discipline']." AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE periodo = 'p') ORDER BY idioma ASC, program_name ASC";
$progs_talleres = mysql_query($query_progs_talleres, $otono2011) or die(mysql_error());
$row_progs_talleres = mysql_fetch_assoc($progs_talleres);
$totalRows_progs_talleres = mysql_num_rows($progs_talleres);

//IDIOMAS
mysql_select_db($database_otono2011, $otono2011);
$query_progs_cursos_i = "SELECT * FROM site_programs WHERE program_type = 'curso' AND idioma = 1 AND cancelado = 0 AND id_discipline = ".$_GET['id_discipline']." AND id_program IN (SELECT id_program FROM site_fechas_idiomas WHERE inicio >= '2013-00-00' AND periodo = 'p') ORDER BY idioma ASC, program_name ASC";
$progs_cursos_i = mysql_query($query_progs_cursos_i, $otono2011) or die(mysql_error());
$row_progs_cursos_i = mysql_fetch_assoc($progs_cursos_i);
$totalRows_progs_cursos_i = mysql_num_rows($progs_cursos_i);

mysql_select_db($database_otono2011, $otono2011);
$query_programa = "SELECT * FROM site_programs WHERE cancelado = 0 AND id_program = ".$_GET['id_program'];
$programa = mysql_query($query_programa, $otono2011) or die(mysql_error());
$row_programa = mysql_fetch_assoc($programa);
$totalRows_programa = mysql_num_rows($programa);


mysql_select_db($database_otono2011, $otono2011);
$query_fecha_ini = "SELECT * FROM site_fechas_ini WHERE periodo = 'p' AND cancelado = 0 AND fecha >= '2013-00-00' AND id_program = ".$_GET['id_program'];
$fecha_ini = mysql_query($query_fecha_ini, $otono2011) or die(mysql_error());
//$row_fecha_ini = mysql_fetch_assoc($fecha_ini);
$totalRows_fecha_ini = mysql_num_rows($fecha_ini);


mysql_select_db($database_otono2011, $otono2011);
$query_temp = "SELECT discipline FROM disciplines WHERE id_discipline = ".$_GET['id_discipline'];
$temp = mysql_query($query_temp, $otono2011) or die(mysql_error());
$row_temp = mysql_fetch_assoc($temp);
$totalRows_temp = mysql_num_rows($temp);

mysql_select_db($database_otono2011, $otono2011);
$query_ad = "SELECT * FROM ads ORDER BY `date` DESC LIMIT 0, 1";
$ad = mysql_query($query_ad, $otono2011) or die(mysql_error());
$row_ad = mysql_fetch_assoc($ad);
$totalRows_ad = mysql_num_rows($ad);

//CODIGO PARA QUE ASIGNE FORMATO LOCAL A LAS FECHAS
setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
//++++++++++++++++++++
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/programas_index.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title><?php echo $row_temp['discipline'].' - '.$row_programa['program_name'];?></title>
<!-- InstanceEndEditable -->
<link href="css/estilos_dan.css" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
	$('.btn').click(function(){
		$('.galeria').hide();
		$('div#'+ $(this).attr('id')).show();
	});
});
</script>

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

<link href="pruebas/css/jquery.tweet.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script language="javascript" src="pruebas/js/jquery.tweet.js" type="text/javascript"></script>
<script type='text/javascript'>
    $(document).ready(function(){
        $(".tweet").tweet({
            username: "DiplomadosIbero",
            avatar_size: 20,
            count: 4,
            loading_text: "cargando tweets..."
        });
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
    <div id="logos"> <a href="http://uia.mx/" target="_blank"><img src="imagenes/logo_UIA.jpg" alt="logo" width="100" height="78" border="0" class="logo"/></a><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/index.php'"><img src="imagenes/logo_DEC.jpg" alt="DEC" width="90" height="78" border="0" /></a></div>
    <div id="primavera" style="margin-bottom:8px"></div>
    <div id="menu" style="float:none;width:1016px;text-align:center">
   	<a href="https://twitter.com/DiplomadosIbero" target="_blank"><div style="float:right;height:24px;width:33px;background-image: url(imagenes/twitter.png);border-left:3px;margin-left:11px;margin-right:13px"></div></a>
    <a href="http://www.facebook.com/diplomados.uia" target="_blank"><div style="float:right; height:24px;width:12px;background-image: url(imagenes/facebook.png);margin-left:10px"></div></a>
      <ul>
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
    <div id="slide_menu" style="display:none; width:190px; background: url(imagenes/sombrita_submenu.png) repeat-y; background-color:#D6D7D9; position:relative; left:189px; top:19px; z-index:1000; margin-bottom:-1000px">

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
          <p class="header_disciplinas"></p>
          <ul>
            <li><a href="#" class="discipline_1" onmouseover="showMenu(1)" onclick="showMenu(1)">Arquitectura</a></li>
            <li><a href="#" class="discipline_2" onmouseover="showMenu(2)" onclick="showMenu(2)">Arte</a></li>
            <li><a href="#" class="discipline_3" onmouseover="showMenu(3)" onclick="showMenu(3)">Diseño</a></li>
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
            <li><!--a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=23'">Oferta Académica</a--><a href="#" class="discipline_23" onmouseover="showMenu(23)" onclick="showMenu(23)">Oferta Académica</a></li>
          </ul>
          <h4>Centros de Atención Especializada</h4>
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
          <h4><br />
          </h4>
          <a href="#" onmouseover="show_search()"><p id="search_on" style="color:#EF353C; font-weight:bold; padding:10px">Busca tu programa de inter&eacute;s </p></a>
          <h4><br/></h4>
          <p style="color:#EF353C; font-weight:bold; padding:10px">Consulta cat&aacute;logo oferta primavera 2013</p>
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
  <div id="slide_search" style="border: 1px solid #E0E0E0; display:none; position:relative; margin-top:-102px; top:790px; left:190px; width:192px; height:100px; background-color:#FFF; z-index:1000;">
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
  <div id= "contenedor_irregular" style="float:left; margin-left:40px; width:795px">
    <div id= "type4" class="ancho_irregular" style="width:581px;margin-top:0px;margin-left: -19px;">
      <div class="textos">
        <table width="100%" border="0" align="left" cellpadding="5" cellspacing="10">
          <tr>
            <td><!-- InstanceBeginEditable name="contenido" -->
      	
      	<table width="100%" border="0" align="left" cellpadding="0" cellspacing="5">
      		<tr>
      			<td align="left" valign="top">
      			  <?php echo '<h1>'.$row_programa['program_name'].'</h1>';
				if($row_programa['program_colaboracion'] != NULL){
					echo '<p>(En colaboración con '.$row_programa['program_colaboracion'].')</p>';
				} 
				?>      			  <!-- - <a style="cursor:pointer; font-size:12px;" onclick="setActiveStyleSheet('img_templ_princ'); return false;">A</a> <a style="cursor:pointer; font-size:14px;" onclick="setActiveStyleSheet('img_templ_princ2'); return false;">A</a> <a style="cursor:pointer; font-size:16px;" onclick="setActiveStyleSheet('img_templ_princ3'); return false;">A</a> + --></td>
      			

          <td align="right">
          	<table border="0">
         	<tr>
                                             
                        <td colspan="2" align="right" valign="top" class="contenido_diploRojo" <?php if($_GET['id_discipline'] == 15 && $_GET['id_program'] == 401){ ?> style="display:none;" <? } ?>>
                        <?php if($_GET['id_discipline'] == 15 && $_GET['id_program'] == 401){ ?> <a href="#" onclick="parent.location='http://www.diplomados.uia.mx/extras.php'"><img src=
            "imagenes/icono_insc.gif" width="30" height="30" border=
            "0" /></a> <? }else{ ?>
            
                        <a href="#" onclick="parent.location='http://www.diplomados.uia.mx/preinscripcion.php'"><img src=
            "imagenes/icono_insc.gif" width="30" height="30" border=
            "0" /></a>
            <? } ?>
            </td>
                        <td width="20px" <?php if($_GET['id_discipline'] == 15 && $_GET['id_program'] == 401){ ?> style="display:none;" <? } ?>><? if($_GET['id_discipline']==21){ ?>
                          <a href="http://www.ibero-asuncion.mx/inscripciones.php" target="_blank">Formato de Preinscripci&oacute;n</a>
                          <?php }else if($_GET['id_discipline'] == 15 && $_GET['id_program'] == 401){ ?>
                           <a href="#" onclick="parent.location='http://www.diplomados.uia.mx/extras.php'">Formato de Preinscripci&oacute;n</a>
                          <? }else{ ?>
                          <a href="#" onclick="parent.location='http://www.diplomados.uia.mx/preinscripcion.php'">Formato de Preinscripci&oacute;n</a>
                          <? } ?></td>
                      </tr>
                  </table>

         </td>
      			</tr>
                                 <?php if($_GET['id_discipline'] == 15 && $_GET['id_program'] == 401){ ?>
                <tr><td><table>
                <tr><td colspan="2"><p><span style="color: red; font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 16px">(Exclusivo para  servidores públicos del Poder Judicial de la Federación)</span></p></td></tr>
                
                <tr>
                
                
                				<td width="10%" align="left" valign="top" class="contenido_diploRojo">
                        <?php if($_GET['id_discipline'] == 15 && $_GET['id_program'] == 401){ ?>  <? }else{ ?>
            
                        <a href="#" onclick="parent.location='http://www.diplomados.uia.mx/preinscripcion.php'"><img src=
            "imagenes/icono_insc.gif" width="30" height="30" border=
            "0" /></a>
            <? } ?>
            </td>
                        <td width="81%" align="left"><? if($_GET['id_discipline']==21){ ?>
                          <a href="http://www.ibero-asuncion.mx/inscripciones.php" target="_blank">Formato de Preinscripci&oacute;n</a>
                          <?php }else if($_GET['id_discipline'] == 15 && $_GET['id_program'] == 401){ ?>
                          <? }else{ ?>
                          <a href="#" onclick="parent.location='http://www.diplomados.uia.mx/preinscripcion.php'">Formato de Preinscripci&oacute;n</a>
                          <? } ?></td>
                
                </tr></table></td></tr>
                
                <? } ?>

      		<tr>
      			<td colspan="2" valign="top">
				
				<? if($row_programa['description'] != NULL){ ?>
      			  <h3>Rese&ntilde;a del Programa:</h3>
				  <? } ?>
    			    
      			  <p><?php echo $row_programa['description']; ?>
    				</p>
					<?php
					if($row_programa['id_maestro'] != NULL){
					$array_maestro = explode(',',$row_programa['id_maestro']);
					$array_size = sizeof($array_maestro);
					$titulo = 'Expositor';
					if($row_programa['program_type'] == 'programahp'){$titulo = 'Coordinador';} else {
					if($row_programa['program_type'] == 'diplomado'){$titulo = 'Coordinador';}else{$titulo = 'Expositor';}}
					
					if($array_size==1){
												
						mysql_select_db($database_otono2011, $otono2011);
						$query_maestro = "SELECT * FROM site_maestros WHERE id_maestro = ".$row_programa['id_maestro'];
						$maestro = mysql_query($query_maestro, $otono2011) or die(mysql_error());
						$row_maestro = mysql_fetch_assoc($maestro);
						$totalRows_maestro = mysql_num_rows($maestro); 
						?>
						<h3>
						  <?php if($row_maestro['sexo']=='F'){$titulo.='a:';}else{$titulo.=':';} echo $titulo;?>
						</h3>
      					<p>
						<?php if($row_maestro['titulo_maestro']!=NULL){echo $row_maestro['titulo_maestro'].'&nbsp;';} echo $row_maestro['nombre_maestro']?><br />
   					<?php
						if($row_maestro['telefono']!=NULL){echo 'Tel. '.$row_maestro['telefono'].'<br />';}
						if($row_maestro['mail']!=NULL){echo '<a href="mailto:'.$row_maestro['mail'].'">'.$row_maestro['mail'].'</a>';} ?></p>
						<?php if($row_maestro['cv'] != NULL){ ?>
							<h3>Curr&iacute;culum <?php if($row_maestro['sexo']=='F'){echo 'de la ';}else{echo 'del ';} echo $titulo;?></h3>
					<p><?php echo $row_maestro['cv']; ?></p>
						<?php } ?>
						
					<?php }else if($array_size>1){ 
					
						$null_count = 0;
					
						$titulo.= 'es:'; 
						
						$cv_maestros = ''; ?>
						
						<p><?php echo $titulo; ?></p>
					
						<p>
						  <?php for($i= 0; $i< $array_size; $i++){
						
							mysql_select_db($database_otono2011, $otono2011);
							$query_maestro = "SELECT * FROM site_maestros WHERE id_maestro = ".$array_maestro[$i];
							$maestro = mysql_query($query_maestro, $otono2011) or die(mysql_error());
							$row_maestro = mysql_fetch_assoc($maestro);
							$totalRows_maestro = mysql_num_rows($maestro); ?>
						  
			        </p>
						<p>
						  <?php if($row_maestro['titulo_maestro']!=NULL){echo $row_maestro['titulo_maestro'].'&nbsp;';} echo $row_maestro['nombre_maestro']; ?><br />
							
					<?php if($row_maestro['telefono']!=NULL){
								echo 'Tel. '.$row_maestro['telefono'].'<br />';
							}
							if($row_maestro['mail']!=NULL){
								echo '<a href="mailto:'.$row_maestro['mail'].'">'.$row_maestro['mail'].'</a>';
							} ?></p>
									
							<p>
								<?php if($row_maestro['cv'] != NULL){
									$cv_maestros .= '<p><em>'.$row_maestro['nombre_maestro'].'</em> .- '.$row_maestro['cv'].'</p><p>&nbsp;</p>';
								}else{
									$null_count++;
								}
							}
						
							if($null_count != $array_size){
								echo '<p><strong>Curr&iacute;culum de los '.$titulo.'</strong></p>';
								echo $cv_maestros;
							}
						
						} 
					}?>
					</p><p>
                    <? if($row_programa['observaciones']!=NULL){echo '<p>'.$row_programa['observaciones'].'</p>';} ?>
                    </p>
				  </td>
      			</tr>
      		
      		<tr>
      			<td colspan="2" valign="top">
      				<br><br>
				<table width="100%" border="0" align="center" cellpadding="3" valign="top"  cellspacing="0">
                      <tr>
                        <?php if(($row_programa['program_colaboracion'] != NULL)&&($row_programa['program_colaboracion_img'] != NULL)){ ?>
                        <td width="29%" align="right" valign="top" class="contenido_diploRojo">En colaboraci&oacute;n</td>
                        <td width="2%" rowspan="10" class="linea_separadora_g"></td>
                        <td width="70%"><? 
						if($row_programa['program_colaboracion_img'] != NULL){
							echo '<img src="imagenes/colaboradores/'.$row_programa['program_colaboracion_img'].'" />';
						} ?></td>
                        <?php } ?>
                      </tr>
                      <?php if($totalRows_fecha_ini != 0){ ?>
                      <tr>
                        <td align="right" valign="top" class="contenido_diploRojo">Inicio</td>
                        <?php if($row_programa['program_colaboracion'] == NULL || $row_programa['program_colaboracion_img'] == NULL){ ?>
                        <td width="2%" rowspan="9" class="linea_separadora_g"></td>
                        <? } ?>
                        <td><?php
							$num_fechas = 0;
							while($row_fecha_ini = mysql_fetch_assoc($fecha_ini)){
								if($row_fecha_ini['fecha']!='0000-00-00'){
								$num_fechas++;
								echo '';
								if($totalRows_fecha_ini > 1){echo '('.$num_fechas.') ';}
								echo strftime("%d de %B de %Y", strtotime($row_fecha_ini['fecha'])).'</br>';
								}else{
									echo 'Abierto';
								}
							}
							mysql_data_seek($fecha_ini, 0);?></td>
                      </tr>
                      <?php  } 
					if($row_programa['duration'] != NULL) {?>
                      <tr>
                        <td align="right" valign="top" class="contenido_diploRojo">Duraci&oacute;n</td>
                        <td><?php echo $row_programa['duration'];?></td>
                      </tr>
                      <? } 
					if($row_programa['costo_curso']!=NULL || $row_programa['cost_inscripcion']!=NULL || $row_programa['costo_modulo']!=NULL){?>
                      <tr>
                        <td align="right" valign="top" class="contenido_diploRojo">Costo</td>
                        <td><?php 
						if($totalRows_fecha_ini != 0){
							if($row_programa['program_type']=='curso'){
								echo $row_programa['costo_curso'];
							}else{
								if($row_programa['cost_inscripcion']==NULL){
									echo $row_programa['costo_curso'];
								}else{
									echo 'Inscripción: '.$row_programa['cost_inscripcion'].'</br>';
									echo 'Por módulo: '.$row_programa['costo_modulo'].'';
								}
							}
						}else{
							echo '-';
						}
					}?></td>
                      </tr>
                      <?php if($totalRows_fecha_ini != 0){ 
					$row_fecha_ini = mysql_fetch_assoc($fecha_ini);
					if($row_fecha_ini['horario'] != NULL){ ?>
                      <tr>
                        <td align="right" valign="top" class="contenido_diploRojo">Horario</td>
                        <td><?php
						if($totalRows_fecha_ini != 0){
							$num_horarios = 0;
							do{
								$num_horarios++;
								echo '';
								if($totalRows_fecha_ini > 1){echo '('.$num_horarios.') ';}
								echo $row_fecha_ini['horario'].'</br>';
							} while($row_fecha_ini = mysql_fetch_assoc($fecha_ini));
							mysql_data_seek($fecha_ini, 0);
						}
						?></td>
                      </tr>
                      <?php } }
					if($totalRows_fecha_ini != 0){
						$sede_not_null = 0;
						while($row_fecha_ini = mysql_fetch_assoc($fecha_ini)){
							if($row_fecha_ini['id_sede'] != NULL){$sede_not_null=1;}
						}
						mysql_data_seek($fecha_ini, 0);
						if($sede_not_null != 0){
						
					
						if($totalRows_fecha_ini != 0){
							$row_fecha_ini = mysql_fetch_assoc($fecha_ini);
							$num_sedes = 0; 
							if($totalRows_fecha_ini > 0){?>
                      <tr>
                        <td align="right" valign="top" class="contenido_diploRojo">Sede</td>
                        <td><?php
							do{
								$num_sedes++;
								echo '';
								echo '('.$num_sedes.') ';
								if($row_fecha_ini['id_sede'] == NULL){
									echo 'Ibero</p>';
								}else{
									mysql_select_db($database_otono2011, $otono2011);
									$query_sede = "SELECT nombre_sede FROM site_sedes WHERE id_sede = ".$row_fecha_ini['id_sede'];
									$sede = mysql_query($query_sede, $otono2011) or die(mysql_error());
									$row_sede = mysql_fetch_assoc($sede);
									$totalRows_sede = mysql_num_rows($sede);
									echo $row_sede['nombre_sede'].'</br>';
								}
							} while($row_fecha_ini = mysql_fetch_assoc($fecha_ini));
							mysql_data_seek($fecha_ini, 0);
						
						?></td>
                      </tr>
                      <tr>
                        <?php }}
						}
					} ?>
                        <td align="right" valign="top" class="contenido_diploRojo" <?php if($_GET['id_discipline'] == 15 && $_GET['id_program'] == 401){ ?> style="display:none;" <? } ?>>Informes</td>
                        <td<?php if($_GET['id_discipline'] == 15 && $_GET['id_program'] == 401){ ?> style="display:none;" <? } ?>><?php
							$array_encargado = explode(',',$row_programa['id_encargado']);
							$array_size_2 = sizeof($array_encargado);
							
							for($k = 0; $k < $array_size_2; $k++){
								mysql_select_db($database_otono2011, $otono2011);
								$query_encargado = "SELECT * FROM site_directory WHERE id_encargado = ".$array_encargado[$k];
								$encargado = mysql_query($query_encargado, $otono2011) or die(mysql_error());
								$row_encargado = mysql_fetch_assoc($encargado);
								$totalRows_encargado = mysql_num_rows($encargado);
								
								echo ''.$row_encargado['nombre'].'<br />';
								echo 'Tel. '.$row_encargado['telefono'];
								if ($row_encargado['extension']!=NULL) { echo ', Ext. '.$row_encargado['extension'].''; }
								echo '<br /><a href="mailto:'.$row_encargado['correo'].'">'.$row_encargado['correo'].'</a><br /> <br />';
							}
							?></td>
                      </tr>
                      <?php if($row_programa['program_pdf'] != NULL){ ?>
                     
                      
                        <?php } ?>
                   
            </td>
                       
                      </tr>
                  </table>
				  </td>
      			</tr>
      		
      		</table>
      <!-- InstanceEndEditable --></td>
          </tr>
          <tr>
            <td><!-- AddThis Button BEGIN -->
              
              <div class="addthis_toolbox addthis_default_style "> <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> <a class="addthis_button_tweet"></a> <a class="addthis_counter addthis_pill_style"></a> </div>
              <script type="text/javascript">var addthis_config = {"data_track_clickback":true};</script> 
              <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=pvazquezdiaz"></script> 
              <!-- AddThis Button END --></td>
          </tr>
        </table>
      </div>
      
    </div>
    <div id= "type4" class="rectangulo_irregular" style="margin-left:17px;">
      
      
      <?php if($_GET['id_discipline'] == 15 && $_GET['id_program'] == 401){ ?>
      <img class="img_seccion" src="imagenes/secciones/online_pjf.png" width="208" height="237" align="right" />
      <? }else{ ?>
      <img class="img_seccion" src="imagenes/secciones/<?php echo $imagen; ?>.png" width="198" height="237" align="right" /> 
      <? } ?></div>
    

<div style="width:25%; float:left; margin-left:22px; margin-top:18px">
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



<map name="Map2" id="Map2">
  <area shape="rect" coords="48,102,78,132" href="https://www.facebook.com/pages/Diplomados-Ibero/281228424828" target="_blank" />
  <area shape="rect" coords="80,102,107,133" href="http://twitter.com/DiplomadosIbero" target="_blank" />
</map>
<script>
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

	$('html:not("#slide_menu")').live('click', function(){

		if($('div#slide_menu:visible')){
				$('div#slide_menu').hide(50)
			}
	})

	function show_search(){

		$('div#slide_search').show();

	}

$(document).mouseup(function (e)
{
    var container = $("div#slide_search");

    if (container.has(e.target).length === 0)
    {
        container.hide();
    }
});


</script>
</body>
<!-- InstanceEnd --></html>
