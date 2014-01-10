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
$query_ad = "SELECT * FROM ads ORDER BY `date` DESC LIMIT 0, 1";
$ad = mysql_query($query_ad, $otono2011) or die(mysql_error());
$row_ad = mysql_fetch_assoc($ad);
$totalRows_ad = mysql_num_rows($ad);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/programas_index.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Untitled Document</title>
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
        <?php if($_GET['id_discipline'] == 15 && $_GET['id_program'] == 401){ ?>
        
        <?php }else{ ?>
        <li> |</li>
        <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/preinscripcion.php'">Preinscripci&oacute;n</a></li>
        <? } ?>
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
                <h4>Harvard Graduate<br />School of 
Design<br />Executive Education <br />
Programs</h4>
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
            <td align="right" valign="top"><!-- InstanceBeginEditable name="programas" --><!-- InstanceEndEditable -->
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
      	<table width="100%" border="0" align="center" cellpadding="5" cellspacing="10">
      		<tr>
      			<td height="0" align="left" class="titulos_diplo">Ciencias Religiosas</td>
      			<td width="21%" align="left" valign="top">&nbsp;</td>
      			</tr>
      		
      		<tr>
      			<td colspan="2" align="left" valign="top"><p>* Profetas</p>
      			  <p>* Cartas cat&oacute;licas</p>
      			  <p>* Antropolog&iacute;a teol&oacute;gica</p>
      			  <p>La iglesia en la historia medieval</p>
      			  <p><strong>Inicio de cursos</strong>: 09 de enero<br />
      			    <strong>Fin de cursos</strong>: 17 de mayo</p>
    			  </p>
      				<p>* Estos cursos cuentan con el prerrequisito de Introducci&oacute;n a la Biblia</p>
      				<p><strong>Para informes comunicarse con</strong><br />
<strong>Coordinadora de Diplomados <br />
   					  Departamento de Ciencias  Religiosas:</strong></span><br />
      					Mtra. Christa P. God&iacute;nez&nbsp;  Mungu&iacute;a<br />
      					Tel: 59.50.40.00 Ext. 4155 <br />
				  <a href="mailto:christa.godinez@uia.mx">christa.godinez@uia.mx</a></p></td>
      			</tr>
      		<tr>
      			<td colspan="2" align="left" valign="top">&nbsp;</td>
      			</tr>
      		<tr>
      			<td colspan="2" align="left" valign="top"><table width="95%" border="0" align="center" cellpadding="3">
      				<tr>
      					<td align="right" valign="top" class="contenido_diploRojo"><strong>Requisitos</strong></td>
      					<td width="2%" rowspan="5" class="linea_separadora_g">&nbsp;</td>
      					<td ><p>Bachillerato o equivalente.<br />
      						Entrevista con la coordinadora <br />
   						  Mtra. Christa P. God&iacute;nez Mungu&iacute;a</p></td>
      					</tr>
      				
      				<tr>
      					<td width="24%" align="right" valign="top" class="contenido_diploRojo">Informes</td>
      					<td width="74%" ><p>Julio A. Mart&iacute;nez Castillo <br />
      						Tel: 59.50.40.00 Ext. 7249<br />
      						<a href="mailto:julio.martinez@uia.mx">julio.martinez@uia.mx</a></p>
      					  <p>Mtro. H&eacute;ctor de la O God&iacute;nez<br />
      						Tel: 59.50.40.00 Ext. 7601<br />
      						<a href="mailto:hector.delao@uia.mx">hector.delao@uia.mx</a></p></td>
      					</tr>
      				<tr>
      					<td align="right" valign="top" class="contenido_diploRojo"><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/formulario_preinscripcion.php'"><img src="imagenes/icono_insc.gif" width="30" height="30" border="0" /></a></td>
      					<td><p><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/preinscripcion.php'">Formato de Preinscripci&oacute;n</a></p></td>
      				</tr>
      				</table></td>
      			</tr>
      		<tr>
      			<td colspan="2" align="left" valign="top"></td>
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
      <div class="header_contenido" style="background:url(imagenes/headers_colores/photo_iframe_header_<?php echo $header; ?>.gif) right bottom no-repeat;"><!-- InstanceBeginEditable name="content_header" --><!-- InstanceEndEditable --></div>
      <div class="corner topRight"></div>
      <div class="corner bottomRight"></div>
      <?php if($_GET['id_discipline'] == 15 && $_GET['id_program'] == 401){ ?>
      <img class="img_seccion" src="imagenes/secciones/online_pjf.png" width="208" height="237" align="right" />
      <? }else{ ?>
      <img class="img_seccion" src="imagenes/secciones/<?php echo $imagen; ?>.png" width="208" height="237" align="right" /> 
      <? } ?></div>
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
            de M&eacute;xico. </strong><br>
          </p>
          <address>
          Prol. Paseo de la Reforma 880, edificio G, P.B.
          Lomas de Santa Fe, M&eacute;xico, C.P. 01219, Distrito Federal. <br>
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
