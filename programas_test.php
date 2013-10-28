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
mysql_select_db($database_otono2011, $otono2011);
$query_progs_diplos = sprintf("SELECT * FROM site_programs WHERE description IS NOT NULL AND cost_inscripcion IS NOT NULL AND program_type = 'diplomado' AND cancelado = 0 AND periodo = 'o' AND id_discipline = %s AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE periodo = 'o') ORDER BY program_name ASC", GetSQLValueString($colname_progs_diplos, "int"));
$progs_diplos = mysql_query($query_progs_diplos, $otono2011) or die(mysql_error());
$row_progs_diplos = mysql_fetch_assoc($progs_diplos);
$totalRows_progs_diplos = mysql_num_rows($progs_diplos);

mysql_select_db($database_otono2011, $otono2011);
$query_progs_diplos_2 = "SELECT * FROM site_programs WHERE description IS NOT NULL AND cost_inscripcion IS NOT NULL AND program_type = 'diplomado' AND cancelado = 0 AND periodo = 'o' AND id_discipline_alterna  != 'NULL' AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE periodo = 'o') ORDER BY program_name ASC";
$progs_diplos_2 = mysql_query($query_progs_diplos_2, $otono2011) or die(mysql_error());
$row_progs_diplos_2 = mysql_fetch_assoc($progs_diplos_2);
$totalRows_progs_diplos_2 = mysql_num_rows($progs_diplos_2);

$colname_progs_cursos = "-1";
if (isset($_GET['id_discipline'])) {
  $colname_progs_cursos = $_GET['id_discipline'];
}

mysql_select_db($database_otono2011, $otono2011);
$query_progs_cursos = sprintf("SELECT * FROM site_programs WHERE description IS NOT NULL AND costo_curso IS NOT NULL AND program_type = 'curso' AND cancelado = 0 AND periodo = 'o' AND id_discipline = %s AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE periodo = 'o') ORDER BY idioma ASC, program_name ASC", GetSQLValueString($colname_progs_cursos, "int"));
$progs_cursos = mysql_query($query_progs_cursos, $otono2011) or die(mysql_error());
$row_progs_cursos = mysql_fetch_assoc($progs_cursos);
$totalRows_progs_cursos = mysql_num_rows($progs_cursos);

mysql_select_db($database_otono2011, $otono2011);
$query_progs_cursos_2 = "SELECT * FROM site_programs WHERE description IS NOT NULL AND costo_curso IS NOT NULL AND program_type = 'curso' AND cancelado = 0 AND periodo = 'o' AND id_discipline_alterna != 'NULL' AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE periodo = 'o') ORDER BY idioma ASC, program_name ASC";
$progs_cursos_2 = mysql_query($query_progs_cursos_2, $otono2011) or die(mysql_error());
$row_progs_cursos_2 = mysql_fetch_assoc($progs_cursos_2);
$totalRows_progs_cursos_2 = mysql_num_rows($progs_cursos_2);

mysql_select_db($database_otono2011, $otono2011);
$query_progs_cursos_i = "SELECT * FROM site_programs WHERE description IS NOT NULL AND costo_curso IS NOT NULL AND program_type = 'curso' AND idioma = 1 AND cancelado = 0 AND id_discipline = ".$_GET['id_discipline']." AND id_program IN (SELECT id_program FROM site_fechas_idiomas WHERE periodo = 'o') ORDER BY idioma ASC, program_name ASC";
$progs_cursos_i = mysql_query($query_progs_cursos_i, $otono2011) or die(mysql_error());
$row_progs_cursos_i = mysql_fetch_assoc($progs_cursos_i);
$totalRows_progs_cursos_i = mysql_num_rows($progs_cursos_i);

mysql_select_db($database_otono2011, $otono2011);
$query_programa = "SELECT * FROM site_programs WHERE cancelado = 0 AND id_program = ".$_GET['id_program'];
$programa = mysql_query($query_programa, $otono2011) or die(mysql_error());
$row_programa = mysql_fetch_assoc($programa);
$totalRows_programa = mysql_num_rows($programa);

mysql_select_db($database_otono2011, $otono2011);
$query_fecha_ini = "SELECT * FROM site_fechas_ini WHERE periodo = 'o' AND cancelado = 0 AND id_program = ".$_GET['id_program'];
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
<link href="css/estilos.css" rel="stylesheet" type="text/css" />
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
  <div id="menu_generos_interior">
    <div class="roundedBox_interior" id="type1"> 
      <!-- esquinas -->
      <div class="corner topLeft"></div>
      <div class="corner topRight"></div>
      <div class="corner bottomLeft"></div>
      <div class="corner bottomRight"></div>
      <!-- esquinas -->
      <div id="menu_desplega">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td align="left" valign="top"><div id="menu_areas">
                <p class="header_disciplinas">Oferta Académica </p>
                <ul>
                  <li> <a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=1'" <? if($_GET['id_discipline']==1){echo 'style="color: #333; background: #fff;"';}?>>Arquitectura </a></li>
                  <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=2'" <? if($_GET['id_discipline']==2){echo 'style="color: #333; background: #fff;"';}?>> Arte</a></li>
                  <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=3'" <? if($_GET['id_discipline']==3){echo 'style="color: #333; background: #fff;"';}?>> Diseño</a></li>
                  <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=7'" <? if($_GET['id_discipline']==7){echo 'style="color: #333; background: #fff;"';}?>>Pol&iacute;tica
                    y Derecho</a></li>
                  <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=5'" <? if($_GET['id_discipline']==5){echo 'style="color: #333; background: #fff;"';}?>>Desarrollo
                    Humano</a></li>
                  <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=6'" <? if($_GET['id_discipline']==6){echo 'style="color: #333; background: #fff;"';}?>>Salud</a></li>
                  <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=4'" <? if($_GET['id_discipline']==4){echo 'style="color: #333; background: #fff;"';}?>>Comunicaci&oacute;n</a></li>
                  <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=8'" <? if($_GET['id_discipline']==8){echo 'style="color: #333; background: #fff;"';}?>>Negocios</a></li>
                  <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=9'" <? if($_GET['id_discipline']==9){echo 'style="color: #333; background: #fff;"';}?>>Tecnolog&iacute;a</a></li>
                  <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=10'" <? if($_GET['id_discipline']==10){echo 'style="color: #333; background: #fff;"';}?>>Humanidades</a></li>
                  <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=18&id_program=323'" <? if($_GET['id_discipline']==18){echo 'style="color: #333; background: #fff;"';}?>>Ciencias
                    Religiosas</a></li>
                  <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=11'" <? if($_GET['id_discipline']==11){echo 'style="color: #333; background: #fff;"';}?>>Gastronom&iacute;a</a></li>
                  <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=12'" <? if($_GET['id_discipline']==12){echo 'style="color: #333; background: #fff;"';}?>>Preparatoria
                    Abierta</a></li>
                </ul>
                <h4>Programas impartidos <br />
                por Harvard University</h4>
                <ul>
                  <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=23'" <? if($_GET['id_discipline']==23){echo 'style="color: #333; background: #fff;"';}?>>Oferta Académica</a></li>
                </ul>
                <h4>Centros de Atención Especializada</h4>
                <ul>
                  <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=14'" <? if($_GET['id_discipline']==14){echo 'style="color: #333; background: #fff;"';}?>>Idiomas</a></li>
                  <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=15'" <? if($_GET['id_discipline']==15){echo 'style="color: #333; background: #fff;"';}?>>Ibero Online</a></li>
                  <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=16'" <? if($_GET['id_discipline']==16){echo 'style="color: #333; background: #fff;"';}?>>Atenci&oacute;n Integral
                    a Empresas</a></li>
                  <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=17'" <? if($_GET['id_discipline']==17){echo 'style="color: #333; background: #fff;"';}?>>Atenci&oacute;n Integral al Sector P&uacute;blico</a></li>
                </ul>
                <h4>Sedes Externas</h4>
                <ul>
                  <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=20&id_program=195'" <? if($_GET['id_discipline']==20){echo 'style="color: #333; background: #fff;"';}?>>Sede sur: Estudio Lofft</a></li>
                  <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=13'" <? if($_GET['id_discipline']==13){echo 'style="color: #333; background: #fff;"';}?>>Xochitla</a></li>
                  <!-- <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=21&id_program=196'" <? if($_GET['id_discipline']==21){echo 'style="color: #333; background: #fff;"';}?>>Asunci&oacute;n Quer&eacute;taro</a></li>
                  
                  <!--<li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=22'" <? if($_GET['id_discipline']==22){echo 'style="color: #333; background: #fff;"';}?>>Atrio Espacio Cultural</a></li> -->
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
              </div></td>
            <td width="6" align="right" valign="top">&nbsp;</td>
            <td align="right" valign="top"><!-- InstanceBeginEditable name="programas" -->
			<div id="menu_programas">
                <p class="header_programas">Diplomados</p>
                <ul class="lista_programas">
                  <?php do {
								$no_n = str_replace('ñ', 'n', $row_progs_diplos['program_name']);
								$no_a = str_replace('á', 'a', $no_n);
								$no_e = str_replace('é', 'e', $no_a);
								$no_i = str_replace('í', 'i', $no_e);
								$no_o = str_replace('ó', 'o', $no_i);
								$no_u = str_replace('ú', 'u', $no_o);
								$titulo = str_replace(' ', '_', $no_u); ?>
                  <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=<?php echo $_GET['id_discipline']; ?>&amp;id_program=<?php echo $row_progs_diplos['id_program']; ?>&titulo=<? echo $titulo; ?>'"><?php echo $row_progs_diplos['program_name']; ?>  <? if($row_progs_diplos['program_new']==1){echo '<span class="contenido_diploRojo"> Nuevo </span> ';}else if($row_progs_diplos['program_new']==2){echo '<span class="contenido_diploRojo"> Nueva versión </span> ';}?> </a></li>
                  <?php } while ($row_progs_diplos = mysql_fetch_assoc($progs_diplos)); 
							
							do { 
							$diplos_disc_alter_array = explode(',',$row_progs_diplos_2['id_discipline_alterna']);
							
							for($i = 0; $i < 4; $i++){
																
								if($_GET['id_discipline'] == $diplos_disc_alter_array[$i]){ ?>
                  <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=<? echo $_GET['id_discipline']; ?>&id_program=<? echo $row_progs_diplos_2['id_program']; ?>'">*<? echo $row_progs_diplos_2['program_name'];  ?>  <? if($row_progs_diplos_2['program_new']==1){echo '<span class="contenido_diploRojo"> Nuevo </span> ';}else if($row_progs_diplos_2['program_new']==2){echo '<span class="contenido_diploRojo"> Nueva versión </span> ';}?> </a></li>
                  <?php } } } while ($row_progs_diplos_2 = mysql_fetch_assoc($progs_diplos_2));
							if($totalRows_progs_cursos != 0 || $totalRows_progs_cursos_2 != 0){?>
                </ul>
                <p class="header_programas_cursos">Cursos</p>
                <ul class="lista_programas">
                <?php do { ?>
                  
                    <li >
                      <?php if($row_progs_cursos['idioma'] == NULL){ ?>
                      <a href="#" onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=<? echo $_GET['id_discipline']; ?>&id_program=<? echo $row_progs_cursos['id_program']; ?>'"><? echo $row_progs_cursos['program_name'];  ?>  <? if($row_progs_diplos['program_new']==1){echo '<span class="contenido_diploRojo"> Nuevo </span> ';}?> </a> </li>
                    
                    <? } ?>
                    <?php } while ($row_progs_cursos = mysql_fetch_assoc($progs_cursos));
							 } 
							 do { 
							 $cursos_disc_alter_array = explode(',',$row_progs_cursos_2['id_discipline_alterna']);
							
							 for($k = 0; $k < 4; $k++){
								
								 if($cursos_disc_alter_array[$k] == $_GET['id_discipline']){?>
                    <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=<? echo $_GET['id_discipline']; ?>&id_program=<? echo $row_progs_cursos_2['id_program']; ?>'">*<? echo $row_progs_cursos_2['program_name'];  ?>  <? if($row_progs_diplos['program_new']==1){echo '<span class="contenido_diploRojo"> Nuevo </span> ';}?> </a></li>
                  
                  <?php } } } while ($row_progs_cursos_2 = mysql_fetch_assoc($progs_cursos_2)); ?>
				  <? do {?>
					<li>
				  <a href="#" onclick="parent.location='http://www.diplomados.uia.mx/idiomas.php?id_discipline=<? echo $_GET['id_discipline']; ?>&id_program=<? echo $row_progs_cursos_i['id_program']; ?>'"><? echo $row_progs_cursos_i['program_name']; ?></a></li>
				  <? } while($row_progs_cursos_i = mysql_fetch_assoc($progs_cursos_i)); ?>
              	</ul> &nbsp;
              </div><!-- InstanceEndEditable -->
              <table border="0" align="right" cellpadding="0" cellspacing="0">
                <tr>
                  <td height="10"></td>
                </tr>
                <tr>
                  <td><p> 
                      <!--img src="../imagenes/banners/descargar_catalogo/<?php //echo $descargable; ?>.jpg" width="190" height="70" /--> 
                    </p></td>
                </tr>
              </table></td>
          </tr>
        </table>
      </div>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="20"></td>
        </tr>
        <tr>
          <td height="130" class="fondoBanners"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="34%" height="130" align="center" valign="top"><img src="imagenes/banners/redes.png" width="123" height="142" border="0" align="left" usemap="#Map2" class="banner_bottom" /></td>
                <td width="34%" height="130" align="center" valign="top"><a onclick="parent.location='http://www.diplomados.uia.mx/catalogo.php'" href="#"><img width="126" height="142" border="0" align="middle" src="imagenes/banners/oferta-educativa.png"></a></td>
                <td width="32%" height="130" align="center" valign="top"><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/promociones.php'"><img class="banner_bottom" src="imagenes/banners/promociones.png" width="116" height="139" border="0" align="top" /></a></td>
              </tr>
            </table></td>
        </tr>
      </table>
    </div>
  </div>
  <div id= "contenedor_irregular" >
    <div id= "type4" class="ancho_irregular">
      <div class="textos">
        <table width="100%" border="0" align="left" cellpadding="5" cellspacing="10">
          <tr>
            <td><!-- InstanceBeginEditable name="contenido" -->
      	<p>&nbsp;</p>
      	<table width="100%" border="0" align="left" cellpadding="0" cellspacing="5">
      		<tr>
      			<td width="80%" align="left" valign="top">
				<?php echo '<h1>'.$row_programa['program_name'].'</h1>';
				if($row_programa['program_colaboracion'] != NULL){
					echo '<p>(En colaboración con '.$row_programa['program_colaboracion'].')</p>';
				} 
				?>
				</td>
      			<td width="21%" align="left" valign="top"><!-- - <a style="cursor:pointer; font-size:12px;" onclick="setActiveStyleSheet('img_templ_princ'); return false;">A</a> <a style="cursor:pointer; font-size:14px;" onclick="setActiveStyleSheet('img_templ_princ2'); return false;">A</a> <a style="cursor:pointer; font-size:16px;" onclick="setActiveStyleSheet('img_templ_princ3'); return false;">A</a> + --></td>
      		</tr>
      		<tr>
      			<td colspan="2" valign="top"><? if($row_programa['description'] != NULL){ ?>
      			  <h3>Rese&ntilde;a del Programa:</h3>
				  <? } ?>
    			    
      			  <p><?php echo $row_programa['description']; ?>
    				</p>
					<?php
					if($row_programa['id_maestro'] != NULL){
					$array_maestro = explode(',',$row_programa['id_maestro']);
					$array_size = sizeof($array_maestro);
					$titulo = 'Expositor';
					
					if($row_programa['program_type'] == 'diplomado'){$titulo = 'Coordinador';}else{$titulo = 'Expositor';}
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
					<p>
                    <? if($row_programa['observaciones']!=NULL){echo '<p>'.$row_programa['observaciones'].'</p>';} ?>
                    </p>
				  </td>
      			</tr>
      		
      		<tr>
      			<td colspan="2" valign="top">
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
								echo '<p>';
								if($totalRows_fecha_ini > 1){echo '('.$num_fechas.') ';}
								echo strftime("%d de %B de %Y", strtotime($row_fecha_ini['fecha'])).'</p>';
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
									echo '<p>Inscripción: '.$row_programa['cost_inscripcion'].'</p>';
									echo '<p>Por módulo: '.$row_programa['costo_modulo'].'</p>';
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
								echo '<p>';
								if($totalRows_fecha_ini > 1){echo '('.$num_horarios.') ';}
								echo $row_fecha_ini['horario'].'</p>';
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
								echo '<p>';
								echo '('.$num_sedes.') ';
								if($row_fecha_ini['id_sede'] == NULL){
									echo 'Ibero</p>';
								}else{
									mysql_select_db($database_otono2011, $otono2011);
									$query_sede = "SELECT nombre_sede FROM site_sedes WHERE id_sede = ".$row_fecha_ini['id_sede'];
									$sede = mysql_query($query_sede, $otono2011) or die(mysql_error());
									$row_sede = mysql_fetch_assoc($sede);
									$totalRows_sede = mysql_num_rows($sede);
									echo $row_sede['nombre_sede'].'</p>';
								}
							} while($row_fecha_ini = mysql_fetch_assoc($fecha_ini));
							mysql_data_seek($fecha_ini, 0);
						
						?></td>
                      </tr>
                      <tr>
                        <?php }}
						}
					} ?>
                        <td align="right" valign="top" class="contenido_diploRojo">Informes</td>
                        <td><?php
							$array_encargado = explode(',',$row_programa['id_encargado']);
							$array_size_2 = sizeof($array_encargado);
							
							for($k = 0; $k < $array_size_2; $k++){
								mysql_select_db($database_otono2011, $otono2011);
								$query_encargado = "SELECT * FROM site_directory WHERE id_encargado = ".$array_encargado[$k];
								$encargado = mysql_query($query_encargado, $otono2011) or die(mysql_error());
								$row_encargado = mysql_fetch_assoc($encargado);
								$totalRows_encargado = mysql_num_rows($encargado);
								
								echo '<p>'.$row_encargado['nombre'].'<br />';
								echo 'Tel. '.$row_encargado['telefono'].', Ext. '.$row_encargado['extension'].'<br />';
								echo '<a href="mailto:'.$row_encargado['correo'].'">'.$row_encargado['correo'].'</a></p>';
							}
							?></td>
                      </tr>
                      <?php if($row_programa['program_pdf'] != NULL){ ?>
                      <tr>
                        <td align="right" valign="top" class="contenido_diploRojo"><a href="temarios/<?php echo $row_programa['program_pdf']; ?>" target="_blank"> <img src="imagenes/icono_temario.gif" width="30" height="30" border="0" /></a></td>
                        <td><a href="temarios/<?php echo $row_programa['program_pdf']; ?>" target="_blank">Descargar Temario</a></td>
                      </tr>
                      <tr>
                        <?php } ?>
                        <td align="right" valign="top" class="contenido_diploRojo"><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/preinscripcion.php'"><img src=
            "imagenes/icono_insc.gif" width="30" height="30" border=
            "0" /></a></td>
                        <td><? if($_GET['id_discipline']==21){ ?>
                          <a href="http://www.ibero-asuncion.mx/inscripciones.php" target="_blank">Formato de Preinscripci&oacute;n</a>
                          <? }else{ ?>
                          <a href="#" onclick="parent.location='http://www.diplomados.uia.mx/preinscripcion.php'">Formato de Preinscripci&oacute;n</a>
                          <? } ?></td>
                      </tr>
                  </table>
				  </td>
      			</tr>
      		<tr>
      			<td colspan="2" valign="top">
				<? if($row_programa['banner']!=NULL){echo '<a href="'.$row_programa['banner_url'].'" target="_blank"><img src="imagenes/banners/programas_banners/'.$row_programa['banner'].'" /></a>';} ?>
				</td>
      		</tr>
			<tr>
				<td>
				<?
					mysql_select_db($database_otono2011, $otono2011);
					$query_community_op = "SELECT id_opinion, short_name, degree, job_position, date FROM  community_opinions WHERE id_program = ".$_GET['id_program']." ORDER BY id_opinion DESC LIMIT 0, 1";
					$community_op = mysql_query($query_community_op, $otono2011) or die(mysql_error());
					$row_community_op = mysql_fetch_assoc($community_op);
					$totalRows_community_op = mysql_num_rows($community_op);
					
					mysql_select_db($database_otono2011, $otono2011);
					$query_discipline_art = "SELECT id_article, id_discipline, interviewee_name, date, title FROM  discipline_articles WHERE id_program = ".$_GET['id_program']." AND type = 0 ORDER BY id_article DESC LIMIT 0, 2";
					$discipline_art = mysql_query($query_discipline_art, $otono2011) or die(mysql_error());
					$row_discipline_art = mysql_fetch_assoc($discipline_art);
					$totalRows_discipline_art = mysql_num_rows($discipline_art);
					
					mysql_select_db($database_otono2011, $otono2011);
					$query_weekly_art = "SELECT id_article, interviewee_name, date, title FROM weekly_articles WHERE id_program = ".$_GET['id_program']." ORDER BY id_article DESC LIMIT 0, 1";
					$weekly_art = mysql_query($query_weekly_art, $otono2011) or die(mysql_error());
					$row_weekly_art = mysql_fetch_assoc($weekly_art);
					$totalRows_weekly_art = mysql_num_rows($weekly_art);
					
					mysql_select_db($database_otono2011, $otono2011);
					$query_media_art = "SELECT id_article, id_program, title, date FROM media_articles WHERE id_program = ".$_GET['id_program']." ORDER BY id_article DESC LIMIT 0, 2";
					$media_art = mysql_query($query_media_art, $otono2011) or die(mysql_error());
					$row_media_art = mysql_fetch_assoc($media_art);
					$totalRows_media_art = mysql_num_rows($media_art);
					
					$total_interviews = $totalRows_community_op+$totalRows_discipline_art+$totalRows_weekly_art+$totalRows_media_art;
					
					if($total_interviews!=0){echo '<img src="imagenes/entrevistas.jpg" width="334" height="38" />'; 
						if($totalRows_weekly_art!=0){?>
							<p>
							<? 
								echo '<a href="#" onclick="parent.location=\'http://www.diplomados.uia.mx/weekly_articles_detail.php?id_article='.$row_weekly_art['id_article'].'\'"><strong>'.$row_weekly_art['title'].'</strong>';
								if($row_weekly_art['interviewee_name']!=NULL){
								echo ' - '.$row_weekly_art['interviewee_name']; 
								echo ' '. strftime("%d-%m-%Y", strtotime($row_weekly_art['date']));
							
							}
							echo '</a>';?>
							</p>
						<? } 
						if($totalRows_discipline_art!=0){
							if($row_discipline_art['title'] != $row_weekly_art['title']){ 
								//$row_discipline_art = mysql_fetch_assoc($discipline_art);
							//} ?>
							<p>
							<? 
								echo '<a href="#" onclick="parent.location=\'http://www.diplomados.uia.mx/articulos.php?id_discipline='.$row_discipline_art['id_discipline'].'&id_article='.$row_discipline_art['id_article'].'\'"><strong>'.$row_discipline_art['title'].'</strong> - '.$row_discipline_art['interviewee_name'];
							echo ' '. strftime("%d-%m-%Y", strtotime($row_discipline_art['date']));
							
							echo '</a>';?>
							</p>
							<?
							}else if($totalRows_discipline_art>1){
								$row_discipline_art = mysql_fetch_assoc($discipline_art);
								echo '<a href="#" onclick="parent.location=\'http://www.diplomados.uia.mx/articulos.php?id_discipline='.$row_discipline_art['id_discipline'].'&id_article='.$row_discipline_art['id_article'].'\'"><strong>'.$row_discipline_art['title'].'</strong> - '.$row_discipline_art['interviewee_name'];
								echo ' '. strftime("%d-%m-%Y", strtotime($row_discipline_art['date']));
								
								echo '</a>';?>
								
							<? }
				
						}
						 if($totalRows_media_art!=0){ 
							 if($row_media_art['title'] != $row_weekly_art['title']){
							 	//$row_media_art = mysql_fetch_assoc($media_art);
							 ?>			
							<p>
							<? echo '<a href="#" onclick="parent.location=\'http://www.diplomados.uia.mx/media_articles_detail.php?id_article='.$row_media_art['id_article'].'&source=media_articles\'"><strong>';
							echo $row_media_art['title'].'</strong>';
							echo ' '. strftime("%d-%m-%Y", strtotime($row_media_art['date']));
							echo '</a>';?>
							</p>
						<? } else if($totalRows_media_art>1){
							$row_media_art = mysql_fetch_assoc($media_art); ?> 
						<p>
							<? echo '<a href="#" onclick="parent.location=\'http://www.diplomados.uia.mx/media_articles_detail.php?id_article='.$row_media_art['id_article'].'&source=media_articles\'"><strong>';
							echo $row_media_art['title'].'</strong>';
							echo ' '. strftime("%d-%m-%Y", strtotime($row_media_art['date']));
							echo '</a>';?>
					</p>
						<? }
						 }
						if($totalRows_community_op!=0){ ?>
							<p>
								<? echo '<a href="#" onclick="parent.location=\'http://www.diplomados.uia.mx/community_opinions_detail.php?id_opinion='.$row_community_op['id_opinion'].'\'"><strong>La comunidad Ibero opina - </strong>'.$row_community_op['short_name'].' ';
							if($row_community_op['job_position']!=NULL){
								echo ' '.$row_community_op['job_position'].' ';
							}
							/*if($row_community_op['degree']!=NULL){
								echo ' '.$row_community_op['degree'].'.';
							}*/
							echo ' '. strftime("%d-%m-%Y", strtotime($row_community_op['date']));
							echo '</a>';
						}
					}?>
						</p>
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
      <div class="corner topLeft"></div>
      <div class="corner bottomLeft"></div>
      <div class="corner bottomRight"></div>
    </div>
    <div id= "type4" class="rectangulo_irregular">
      <div class="header_contenido" style="background:url(imagenes/headers_colores/photo_iframe_header_<?php echo $header; ?>.gif) right bottom no-repeat;"><!-- InstanceBeginEditable name="content_header" -->
	<?php
		echo ucfirst($row_programa['program_type']);
	?>
	<!-- InstanceEndEditable --></div>
      <div class="corner topRight"></div>
      <div class="corner bottomRight"></div>
      <img class="img_seccion" src="imagenes/secciones/<?php echo $imagen; ?>.png" width="208" height="237" align="right" /> </div>
    <div class="avisos">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="5">&nbsp;</td>
        </tr>
        <tr>
            <td valign="middle" align="center"><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=15&amp;id_program=394&amp;titulo=Los_4_inconmensurables:_Desde_el_sufrimiento,_enviar_felicidad'"><!--img src="../imagenes/banners/banner_rompope_optimizado.jpg" alt="" width="191" height="131" /--></a><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/extras.php'"></a></td>
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
  <area shape="rect" coords="48,102,78,132" href="https://www.facebook.com/pages/Diplomados-Ibero/281228424828" target="_blank" />
  <area shape="rect" coords="80,102,107,133" href="http://twitter.com/DiplomadosIbero" target="_blank" />
</map>
</body>
<!-- InstanceEnd --></html>
