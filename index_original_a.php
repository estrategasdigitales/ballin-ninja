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

mysql_select_db($database_otono2011, $otono2011);
$query_programas_izq = "SELECT site_programs.id_discipline, site_programs.id_program, site_programs.imagen, site_programs.program_name AS programa, site_fechas_ini.fecha AS fecha_inicio FROM site_programs, site_fechas_ini WHERE site_programs.id_program=site_fechas_ini.id_program AND site_fechas_ini.publicado=1 ORDER BY RAND() LIMIT 4";
$programas_izq = mysql_query($query_programas_izq, $otono2011) or die(mysql_error());
$row_programas_izq = mysql_fetch_assoc($programas_izq);
$totalRows_programas_izq = mysql_num_rows($programas_izq);

mysql_select_db($database_otono2011, $otono2011);
$query_programas_der = "SELECT site_programs.program_name AS programa, site_fechas_ini.fecha AS fecha_inicio  FROM site_programs, site_fechas_ini WHERE site_programs.id_program=site_fechas_ini.id_program AND site_fechas_ini.publicado=1 ORDER BY RAND() LIMIT 3";
$programas_der = mysql_query($query_programas_der, $otono2011) or die(mysql_error());
$row_programas_der = mysql_fetch_assoc($programas_der);
$totalRows_programas_der = mysql_num_rows($programas_der);



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
          <p class="header_disciplinas">Oferta Académica </p>
          <ul>
            <li> <a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=1'">Arquitectura </a></li>
            <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=2'"> Arte</a></li>
            <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=3'"> Diseño</a></li>
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
         <h4>Programas impartidos <br />
                por Harvard University</h4>
          <ul>
            <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=23'">Oferta Académica</a></li>
          </ul>
          <h4>Centros de Atención Especializada</h4>
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
      <table width="100%" border="0" cellspacing="10" cellpadding="0">
        <tr align="left"  valign="top" >
          <td valign="middle"  style="background: url(imagenes/uploads/banner_prox/<?php echo $row_programas_izq['imagen']; ?>) no-repeat top left; width:155px; height:83px; padding-left:185px; margin-top:5px; padding-right:3px;"><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=<?php echo $row_programas_izq['id_discipline'];?>&id_program=<?php echo $row_programas_izq['id_program']; ?>'"><h5><?php echo $row_programas_izq['programa']; ?></h5></a>
          <strong>Inicio</strong>: <?php echo strftime("%d de %B", strtotime($row_programas_izq['fecha_inicio'])); ?> </td>
         <td><h2>Próximos programas a iniciar </h2>
             <ul><?php $row_programas_izq = mysql_fetch_assoc($programas_izq) ?>
             <?php do { ?>
              <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=<?php echo $row_programas_izq['id_discipline'];?>&id_program=<?php echo $row_programas_izq['id_program']; ?>'"><?php echo $row_programas_izq['programa']; ?></a> <span class="contenido_diploRojo">/</span> <span class="contenido_diploRojo"> <?php echo strftime("%d de %B", strtotime($row_programas_izq['fecha_inicio'])); ?></span></li>
              <?php } while ($row_programas_izq = mysql_fetch_assoc($programas_izq)); ?>
             <!--li><span class="contenido_diploRojo">24 de marzo</span> / Espacio Público y Ciudades Seguras </li>
             <li><span class="contenido_diploRojo">24 de marzo</span> / Espacio Público y Ciudades Seguras </li-->
            </ul></td>
        </tr>
      </table>
      <!-- InstanceEndEditable --> </div>
    <div id="separador"></div>
    <div id= "type4" class="rectangulo_abajo_index">
      <div class="textos">
        <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
          <tr>
            <td><!-- InstanceBeginEditable name="contenido" -->
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="left" valign="top" class="titulos_principales_grises"><?php echo $row_weekly_article['title']; ?></td>
                </tr>
                <tr>
                  <td align="left" valign="top"><p><?php echo $row_weekly_article['interviewee_name']; ?></p>
                    <p><img style="float:left; margin-right:10px; margin-top:3px; margin-bottom:20px;" src="imagenes/uploads/weekly_articles/big_pictures/<?php echo $row_weekly_article['big_picture']; ?>" width="356" height="220" align="left" /></p>
                    <p><?php echo WordLimiter($row_weekly_article['content'], 50); ?><br />
                      <a onclick="parent.location='http://www.diplomados.uia.mx/weekly_articles_detail.php?id_article=<?php echo $row_weekly_article['id_article']; ?>'" style="cursor:pointer;"><span class="avisos_mas" style="cursor:pointer"> &gt; leer m&aacute;s</span></a></p>
                    <p>&nbsp;</p>
                    <p><a onclick="parent.location='http://www.diplomados.uia.mx/weekly_articles.php'" style="cursor:pointer;"><img src="imagenes/buttons/historico_entrevistas.gif" onmouseover="this.src='imagenes/buttons/historico_entrevistas_onhover.gif'" onmouseout="this.src='imagenes/buttons/historico_entrevistas.gif'" name="img_readmore" id="img_readmore" border="0"></a></p></td>
                </tr>
              </table>
              <table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
                <tr>
                  <td height="55" style="background-image:url(imagenes/la_comunidad_ibero_opina.jpg); background-repeat:no-repeat; background-position:left center;" align="right" valign="bottom"><img src="imagenes/comunidad_ibero_participa.png" border="0" style="margin-bottom:4px; margin-right:15px; cursor:pointer;" onclick="parent.location='http://www.diplomados.uia.mx/participa.php';" /></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
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
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <? 
							  $word_count = 0;
							  	$word_count += count_words($row_community_opinions_top3['degree']);
							  	$word_count += count_words($row_community_opinions_top3['job_position']);
								$word_count += count_words($row_community_opinions_top3['diploma_course']);
								?>
                              <td><p><em><?php echo $row_community_opinions_top3['degree']; ?></em></p></td>
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
                                  <a onclick="parent.location='http://www.diplomados.uia.mx/community_opinions_detail.php?id_opinion=<?php echo $row_community_opinions_top3['id_opinion']; ?>'" style="cursor:pointer;"> <span class="avisos_mas">&gt; leer más</span></a></p></td>
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
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <? 
							 	$word_count = 0;
							  	$word_count += count_words($row_community_opinions_top3['degree']);
							  	$word_count += count_words($row_community_opinions_top3['job_position']);
								$word_count += count_words($row_community_opinions_top3['diploma_course']);
								?>
                              <td><p><em><?php echo $row_community_opinions_top3['degree']; ?></em></p></td>
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
                                  <a onclick="parent.location='http://www.diplomados.uia.mx/community_opinions_detail.php?id_opinion=<?php echo $row_community_opinions_top3['id_opinion']; ?>'" style="cursor:pointer;"><span class="avisos_mas">&gt; leer más</span></a></p></td>
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
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <? 
							 	$word_count = 0;
							  	$word_count += count_words($row_community_opinions_top3['degree']);
							  	$word_count += count_words($row_community_opinions_top3['job_position']);
								$word_count += count_words($row_community_opinions_top3['diploma_course']);
								?>
                              <td><p><em><?php echo $row_community_opinions_top3['degree']; ?></em></p></td>
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
                                  <a onclick="parent.location='http://www.diplomados.uia.mx/community_opinions_detail.php?id_opinion=<?php echo $row_community_opinions_top3['id_opinion']; ?>'" style="cursor:pointer;"><span class="avisos_mas">&gt; leer más</span></a></p></td>
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
                    </table></td>
                </tr>
                <tr>
                  <td align="right"><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/community_opinions.php'"><img border="0" src="imagenes/buttons/historico_entrevistas.gif" onmouseover="this.src='imagenes/buttons/historico_entrevistas_onhover.gif';" onmouseout="this.src='imagenes/buttons/historico_entrevistas.gif';" /></a></td>
                </tr>
              </table>
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
            <td align="center" valign="middle"><img src="imagenes/banners/redes.png" width="123" height="142" border="0" align="middle" usemap="#Map2"></td>
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
  <area shape="rect" coords="48,104,79,133" href="https://www.facebook.com/diplomados.uia" target="_blank" />
  <area shape="rect" coords="82,104,107,133" href="http://twitter.com/DiplomadosIbero" target="_blank" />
</map>
</body>
<!-- InstanceEnd --></html>
