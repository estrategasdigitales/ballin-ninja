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
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/secciones.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Untitled Document</title>
<!-- InstanceEndEditable -->
<link href="css/estilos.css" rel="stylesheet" type="text/css" />
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
<!-- InstanceBeginEditable name="head" -->
<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
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
	  }?>
<div id="container">
  <div id="header">
    <div id="logos"> <a href="http://uia.mx/" target="_blank"><img src="imagenes/logo_UIA.jpg" alt="logo" width="100" height="78" border="0" class="logo"/></a><a href="index.php"><img src="imagenes/logo_DEC.jpg" alt="DEC" width="90" height="78" border="0" /></a></div>
    <div id="primavera"></div>
    <div id="menu">
      <ul>
        <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/index.php'">Inicio</a></li>
        <li> | </li>
        <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/nosotros.php'">Nosotros</a></li>
        <li> | </li>
        <li><a href="http://www.uia.mx/servicios/pagosdec.html" target="_blank">Servicios en l&iacute;nea</a></li>
        <li> |</li>
        <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/promociones.php'">Promociones</a></li>
        <li> |</li>
        <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/preinscripcion.php'">Preinscripci&oacute;n</a></li>
        <li> |</li>
        <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/directorio.php'">Directorio</a></li>
        <li> |</li>
        <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/contacto.php'">Contacto</a></li>
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
            <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/c_religiosas.php'">Ciencias
              Religiosas</a></li>
            <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=11'">Gastronom&iacute;a</a></li>
            <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=12'">Preparatoria
              Abierta</a></li>
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
            <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=13'">Xochitla</a></li>
            <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=21&id_program=196'">Asunci&oacute;n Quer&eacute;taro</a></li>
            <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=20&id_program=195'">Estudio Lofft</a></li>
            <!--<li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=22&id_program=92'">Atrio Espacio Cultural</a></li>-->
          </ul>
          <h4><br />
          </h4>
          <ul class="cobranzas">
            <li><a href="https://enlinea5.uia.mx/sit/SitActividadesEsp.cfm" target="_blank">Pago
              de traducciones</a></li>
            <li><a href="temarios/politcas_cobranza.pdf" target="_blank"> Pol&iacute;ticas
              cobranza</a></li>
            <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/tutorial_pagos.php'"> Tutorial pagos en l&iacute;nea </a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div id= "contenedor_irregular_index" >
    <div id= "type4" class="cuadro_articulos_secciones">
      <div style="position:relative; float:left; z-index:12;"> <!-- InstanceBeginEditable name="header" -->
    	<object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="788" height="265">
    		<param name="movie" value="swf/galeria.swf" />
    		<param name="quality" value="high" />
    		<param name="wmode" value="opaque" />
    		<param name="swfversion" value="8.0.35.0" />
    		<!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don�t want users to see the prompt. -->
    		<param name="expressinstall" value="Scripts/expressInstall.swf" />
    		<!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
    		<!--[if !IE]>-->
    		<object type="application/x-shockwave-flash" data="swf/galeria.swf" width="788" height="265">
    			<!--<![endif]-->
    			<param name="quality" value="high" />
    			<param name="wmode" value="opaque" />
    			<param name="swfversion" value="8.0.35.0" />
    			<param name="expressinstall" value="Scripts/expressInstall.swf" />
    			<!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
    			<div>
    				<h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
    				<p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p>
    			<!--[if !IE]>-->
    			</object>
    		<!--<![endif]-->
    		</object>
			<script type="text/javascript">
swfobject.registerObject("FlashID");
			</script>
            
    	<!-- InstanceEndEditable --> </div>
      <div class="corner topLeft"></div>
      <div class="corner topRight"></div>
      <div class="corner bottomRight"></div>
    </div>
    <div id= "type4" class="rectangulo_abajo_secciones">
      <div class="textos"><!-- InstanceBeginEditable name="contenido" -->
		  <table width="95%" border="0" align="center" cellpadding="8" cellspacing="0">
                  
                  <tr>
                    <td height="40" valign="bottom"><p><span class="titulos_diplo">Promociones</span></p>
                      <p>Recuerda que tenemos los mejores descuentos pensados especialmente
                      para ti </p></td>
                  </tr>
                  <tr>
                    <td align="center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center"><p>
                      <script type="text/javascript">
// Popup window code
function newPopup(url) {
	popupWindow = window.open(
		url,'popUpWindow','height=450,width=550,left=10,top=10,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no,status=yes')
}
                          </script>
                      <!-- aqu&iacute; va el url de la imagen .jpg del promocional -->                      <img src="imagenes/banners/descuentos.jpg" width="381" height="292" /></p></td>
                  </tr>
                  <tr>
                    <td align="center" valign="top"><p>* Los descuentos no son acumulables
                      </p>
                      <p>En nuestra oferta de idiomas solamente aplica el 20% de descuento para alumnos y exalumnos</p></td>
                  </tr>
                </table>
		  	
		  <!-- InstanceEndEditable -->
        <table width="93%" border="0" align="center" cellpadding="5" cellspacing="10">
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
      <div class="corner bottomLeft"></div>
      <div class="corner bottomRight"></div>
    </div>
    <div class="avisos">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td valign="middle" align="center">&nbsp;</td>
          </tr>
            <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td height="157" align="right" valign="top" style="background:url(imagenes/newsletter.jpg) no-repeat 100% 50%; padding-right:10px;"><form action="http://www.dec-uia.com/cgi-bin/dada/mail.cgi" method="post" target="_blank" name="form_news" id="form_news">
                <table width="170" border="0" align="right" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="62%" height="120">&nbsp;</td>
                    <td width="38%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="right"><!-- begin subscription_form_widget.tmpl -->
                      
                      <input type="hidden" name="list" value="newsDEC" />
                      <input type="hidden" name="f" id="f_s" value="subscribe" checked="checked" />
                      <input name="email" type="text" id="email" value="" size="15" class="news_input" placeholder="email" /></td>
                    <td align="center"><input type="submit" value="Enviar" class="processing" style="font-size:10px; background:#666; border-radius:5px; color:#FFF; width:50px; border:0px slid #FFF; width:50px;" /></td>
                  </tr>
                </table>
              </form></td>
          </tr>
          <tr>
            <td valign="middle" align="center"><a onclick="parent.location='http://www.diplomados.uia.mx/catalogo.php'" href="#"><img width="126" height="153" border="0" align="middle" src="imagenes/banners/oferta_academica.jpg"></a></td>
          </tr>
          <tr>
            <td align="center" valign="middle"><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/participa.php'"><img src="imagenes/banners/redes.png" width="123" height="142" border="0" align="middle" usemap="#Map2" class="banner_bottom" /></a></td>
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
        <td width="810"><a onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=20&id_program=195'" href="#"><img src="imagenes/banners/lofft.png" alt="Dos" width="810" height="144" border="0" /></a></td>
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
          </address> </td>
      </tr>
    </table>
  </div>
</div>

<map name="Map2" id="Map2">
  <area shape="rect" coords="49,104,76,133" href="https://www.facebook.com/diplomados.uia" target="_blank" />
  <area shape="rect" coords="77,103,109,134" href="http://twitter.com/DiplomadosIbero" target="_blank" />
</map>
</body>
<!-- InstanceEnd --></html>