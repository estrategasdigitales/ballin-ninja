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
/*
mysql_select_db($database_otono2011, $otono2011);
$query_ad = "SELECT * FROM ads ORDER BY `date` DESC LIMIT 0, 1";
$ad = mysql_query($query_ad, $otono2011) or die(mysql_error());
$row_ad = mysql_fetch_assoc($ad);
$totalRows_ad = mysql_num_rows($ad);
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/secciones.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Untitled Document</title>
<!-- InstanceEndEditable -->
<link href="css/estilos_dan.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="Scripts/jquery-ui.css" type="text/css" media="all" />
<script type="text/javascript" src="Scripts/jquery.js"></script>
<script type="text/javascript" src="Scripts/menu2.js"></script>
<script src="Scripts/jquery-ui.js"></script>
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
<div id="container">
  <div id="header" style="margin-top:16px">
    <div id="logos"> <a href="http://uia.mx/" target="_blank"><img src="imagenes/logo_UIA.jpg" alt="logo" width="100" height="78" border="0" class="logo"/></a><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/index.php'"><img src="imagenes/logo_DEC.jpg" alt="DEC" width="90" height="78" border="0" /></a></div>
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
<li style="padding-bottom:10px;"><a href="temarios/politcas_cobranza.pdf" target="_blank">Pol&iacute;ticas cobranza</a></li>
<li style="padding-bottom:10px;"><a href="tutorial_pagos.php">Tutorial pagos en l&iacute;nea</a></li></ul>
  </div>
  <div id="menu_generos_interior_index">
    <div class="roundedBox_interior_index" id="type1"> 
      <!-- esquinas -->
      <!-- esquinas -->
      <div id="menu_desplega_index">
      	<?php include('menu_disciplines.php'); ?>
      </div>
    </div>
  </div>
  <div id= "contenedor_irregular_index" >
    <div id= "type4" class="cuadro_articulos_secciones" style="border:0px;width:816px;padding:0px">
    <div id="caja" style="width:788px; border:1px;height:265px;background-image: url(imagenes/m_directorio.jpg);margin-left:26px;position:relative; float:left; z-index:12;"> <!-- InstanceBeginEditable name="header" -->
    				      
    </div>
    
    <div style="margin-left:24px">
	<div style="width:69%;float:left;margin-left:0px">
	    <div id="slide_search" style="border: 1px solid #E0E0E0; display:none; position:relative; margin-top:-202px; top:625px; left:-39px; width:192px; height:200px; background-color:#FFF; z-index:1000;">
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
				        		 <select name="sArea" id="sArea" style="margin:0px; width:167px; height:15px; border:1px solid #999999; line-height:0; font-size:11px;">
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
    <div id= "type4" class="rectangulo_abajo_secciones" style="border:0px">
      <div class="textos"><!-- InstanceBeginEditable name="contenido" -->
		  	<table width="95%" border="0" align="center" cellpadding="3" cellspacing="0">
		  		<tr>
		  			<td colspan="5" valign="top"><p>Nuestro
		  				personal altamente capacitado y comprometido en el cumplimiento
		  				de nuestra misi&oacute;n queda a sus &oacute;rdenes para
			      brindarle un servicio oportuno y especializado.</p></td>
	  			</tr>
		  		<tr>
		  			<td colspan="5" valign="top">&nbsp;</td>
	  			</tr>
		  		<tr>
		  			<td width="28%" height="50" align="right" valign="top"><p><strong>Director</strong></p></td>
		  			<td width="1%" valign="top" class="linea_separadora_g">&nbsp;</td>
		  			<td width="35%" valign="top"><p>Mtro. Jos&eacute;   Luis Cort&eacute;s
		  				Delgado<br />
	  				  Tel. 59.50.40.00 <br />
	  				  Ext.4143&nbsp; <br />
			        <a href="mailto:joseluis.cortes@ibero.mx">joseluis.cortes@ibero.mx</a></p></td>
		  			<td width="1%" valign="top">&nbsp;</td>
		  			<td width="35%" valign="top">&nbsp;</td>
	  			</tr>
		  		<tr>
		  			<td width="28%" height="50" align="right" valign="top"><p><strong>Subdirector
			      Acad&eacute;mico</strong></p></td>
		  			<td width="1%" valign="top" class="linea_separadora_g">&nbsp;</td>
		  			<td width="35%" valign="top"><p>Mtro. Luis de Villafranca Andrade&nbsp; <br />
		  				Tel. 59.50.40.00 <br />
		  				Ext.4224 <br />
			      <a href="mailto:luis.devillafranca@ibero.mx">luis.devillafranca@ibero.mx</a></p></td>
		  			<td width="1%" valign="top">&nbsp;</td>
		  			<td width="35%" valign="top">&nbsp;</td>
	  			</tr>
		  		<tr>
		  			<td width="28%" height="50" align="right" valign="top"><p><strong>Asistente
		        de Direcci&oacute;n</strong></p></td>
		  			<td width="1%" valign="top" class="linea_separadora_g">&nbsp;</td>
		  			<td width="35%" valign="top"><p>Yholintzin Ba&ntilde;os Ledesma&nbsp;		  			  &nbsp; <br />
		  			  Tel. 59.50.40.00 &nbsp; <br />
		  			  Ext. 4143<br />
          <a href="mailto:norma.alvarez@ibero.mx">direccion.dec@ibero.mx</a></p></td>
		  			<td width="1%" valign="top">&nbsp;</td>
		  			<td width="35%" valign="top">&nbsp;</td>
	  			</tr>
		  		
		  		<tr>
		  			<td height="40" colspan="5" valign="top">&nbsp;</td>
	  			</tr>
		  		<tr>
		  			<td width="28%" height="40" valign="top">&nbsp;</td>
		  			<td width="1%" height="40" valign="top">&nbsp;</td>
		  			<td width="35%" height="40" align="center" valign="middle"><p><strong class="contenido_diploRojo">Coordinador</strong></p></td>
		  			<td width="1%" height="40" valign="top">&nbsp;</td>
		  			<td width="35%" height="40" align="center" valign="middle"><p><strong class="contenido_diploRojo">Informes</strong></p></td>
	  			</tr>
		  		<tr>
		  			<td width="28%" align="right" valign="top"><p><strong>Arquitectura,
		        Arte y Dise&ntilde;o</strong></p></td>
		  			<td width="1%" rowspan="11" valign="top" class="linea_separadora_g">&nbsp;</td>
		  			<td width="35%" valign="top"><p>Mirna Arzate Cienfuegos<br />
		  				Tel. 59.50.40.00<br />
		  				Ext. 4626<br />
			      <a href="mailto:mirna.arzate@ibero.mx">mirna.arzate@ibero.mx</a></p></td>
		  			<td width="1%" rowspan="11" valign="top" class="linea_separadora_g">&nbsp;</td>
		  			<td width="35%" height="30" valign="top"><p>Lizbeth Ochoa Reyes<br />
		  				Tel. 59.50.40.00<br />
		  				Ext. 7615<br />
	  				  <a href="mailto:asistente.dec03@ibero.mx">asistente.dec03@ibero.mx</a></p></td>
	  			</tr>
		  		<tr>
		  			<td width="28%" align="right" valign="top"><p><strong>Ciencias Sociales</strong></p></td>
		  			<td width="35%" valign="top"><p>Lic. M&oacute;nica Reyes Castro <br />
		  				Tel. 59.50.40.00 <br />
		  				Ext. 7602&nbsp;&nbsp; <a href="mailto:monica.reyes@ibero.mx"><br />
			      monica.reyes@ibero.mx</a></p></td>
		  			<td width="35%" height="30" valign="top"><p>Alger Huitr&oacute;n S&aacute;nchez<br />
		  			  Tel. 59.50.40.00<br />
		  			  Ext. 7614<br />
<a href="mailto:alger.huitron@ibero.mx">alger.huitron@ibero.mx</a></p></td>
	  			</tr>
		  		<tr>
		  			<td width="28%" align="right" valign="top"><p><strong>Negocios y Tecnolog&iacute;a</strong></p></td>
		  			<td width="35%" valign="top"><p>Mirna Arzate Cienfuegos<br />
		  				Tel. 59.50.40.00<br />
		  				Ext. 4626<br />
			      <a href="mailto:mirna.arzate@ibero.mx">mirna.arzate@ibero.mx</a></p></td>
		  			<td width="35%" height="30" valign="top"> <p>Nayeli Cruz Tapia<br />
		  				Tel. 59.50.40.00<br />
		  				Ext. 4808 y 7615<br />
	  				  <a href="mailto:nayeli.cruz@ibero.mx ">nayeli.cruz@ibero.mx </a></p></td>
	  			</tr>
	  			<tr>
		  			<td width="28%" align="right" valign="top"><p><strong>Humanidades</strong></p></td>
		  			<td width="35%" valign="top"><p>Lic. M&oacute;nica Reyes Castro <br />
		  				Tel. 59.50.40.00 <br />
		  				Ext. 7602&nbsp;&nbsp; <a href="mailto:monica.reyes@ibero.mx"><br />
			      monica.reyes@ibero.mx</a></p></td>
		  			<td width="35%" height="30" valign="top"><p>Alger Huitr&oacute;n S&aacute;nchez<br />
		  			  Tel. 59.50.40.00<br />
		  			  Ext. 7614<br />
<a href="mailto:alger.huitron@ibero.mx">alger.huitron@ibero.mx</a></p></td>
	  			</tr>
		  		<!-- <tr>
		  			<td width="28%" align="right" valign="top"><p><strong>Humanidades</strong></p></td>
		  			<td width="35%" valign="top"><p>Mtro. H&eacute;ctor de la O
		  				God&iacute;nez<br />
		  				Tel. 59.50.40.00<br />
		  				Ext. 7601<br />
			      <a href="mailto:hector.delao@ibero.mx">hector.delao@ibero.mx</a></p></td>
		  			<td width="35%" height="30" valign="top"><p>Julio A. Mart&iacute;nez
		  				Castillo <br />
		  				Tel: 59.50.40.00<br />
		  				Ext. 7249<br />
	  				  <a href="mailto:julio.martinez@ibero.mx">julio.martinez@ibero.mx</a></p></td>
	  			</tr> -->
		  		<tr>
		  			<td width="28%" align="right" valign="top"><p><strong>Gastronom&iacute;a</strong></p></td>
		  			<td width="35%" valign="top"><p>Mtro. H&eacute;ctor de la O
		  				God&iacute;nez<br />
		  				Tel. 59.50.40.00<br />
		  				Ext. 7601<br />
			      <a href="mailto:hector.delao@ibero.mx">hector.delao@ibero.mx</a></p></td>
		  			<td width="35%" height="30" valign="top"><p>Julio A. Mart&iacute;nez
		  				Castillo <br />
		  				Tel: 59.50.40.00<br />
		  				Ext. 7249<br />
	  				  <a href="mailto:julio.martinez@ibero.mx">julio.martinez@ibero.mx</a></p></td>
	  			</tr>
		  		<tr>
		  			<td width="28%" align="right" valign="top"><p><strong>Idiomas</strong></p></td>
		  			<td width="35%" valign="top"><p>Mtra. Leticia Cavazos Garza<br />
		  				Tel. 59.50.40.00<br />
		  				Ext. 7629<br />
			      <a href="mailto:leticia.cavazos@ibero.mx">leticia.cavazos@ibero.mx</a></p></td>
		  			<td width="35%" height="30" valign="top"><!--p>Bibiana Prado Aguilar&nbsp;<br />
		  			  Tel. 59.50.40.00, <br />
		  			  Ext. 7383 y 7497&nbsp;<br />
		  			  <a href="mailto:asistente.dec01@uia.mx">asistente.dec01@uia.mx&nbsp;</a> <br />
		  			</p--></td>
	  			</tr>
				<tr>
		  			<td width="28%" align="right" valign="top"><p><strong>Preparatoria Abierta</strong></p></td>
		  			<td width="35%" valign="top"><p>Mtro. H&eacute;ctor de la O
		  				God&iacute;nez<br />
		  				Tel. 59.50.40.00<br />
		  				Ext. 7601<br />
			      <a href="mailto:hector.delao@ibero.mx">hector.delao@ibero.mx</a></p></td>
		  			<td width="35%" height="30" valign="top"><p>Julio A. Mart&iacute;nez
		  				Castillo <br />
		  				Tel: 59.50.40.00<br />
		  				Ext. 7249<br />
	  				  <a href="mailto:julio.martinez@ibero.mx">julio.martinez@ibero.mx</a></p></td>
	  			</tr>
		  		<!-- <tr>
		  			<td width="28%" align="right" valign="top"><p><strong>Preparatoria Abierta</strong></p></td>
		  			<td width="35%" valign="top"><p>Lic. M&oacute;nica Reyes Castro <br />
		  				Tel. 59.50.40.00 <br />
		  				Ext. 7602&nbsp;&nbsp; <a href="mailto:monica.reyes@ibero.mx"><br />
			      monica.reyes@ibero.mx</a></p></td>
		  			<td width="35%" height="30" valign="top"><p>Julio A. Mart&iacute;nez Castillo<br />
		  			  Tel. 59.50.40.00<br />
		  			  E
		  			  xt. 7249, 7614, 7602<br />
<a href="mailto:julio.martinez@ibero.mx">julio.martinez@ibero.mx</a></p></td>
	  			</tr> -->
		  		<tr>
		  			<td width="28%" align="right" valign="top"><p><strong>Online</strong></p></td>
		  			<td width="35%" valign="top"><p>&nbsp;</p></td>
		  			<td width="35%" height="30" valign="top"><p>Abraham Valverde<br />
		  				Tel. 59.50.40.00<br />
		  				Ext. 7160<br />
	  				  <a href="mailto:ec.online@ibero.mx">ec.online@ibero.mx</a></p></td>
	  			</tr>
		  		<tr>
		  			<td width="28%" align="right" valign="top"><p><strong>Atenci&oacute;n
		        Integral a Empresas</strong></p></td>
		  			<td width="35%" valign="top"><p>Mtro. Guillermo G&oacute;mez
		  				Abascal<br />
		  				Tel. 59.50.40.00<br />
		  				Ext. 7626<br />
			      <a href="mailto:guillermo.gomez@ibero.mx">guillermo.gomez@ibero.mx</a></p></td>
		  			<td width="35%" height="30" valign="top"><p>Lic. Diana San Mart&iacute;n
		  				Laguna <br />
		  				Tel. 59.50.40.00<br />
		  				Ext. 7426<br />
	  				  <a href="mailto:atencioncorporativa@ibero.mx">atencioncorporativa@ibero.mx</a></p></td>
	  			</tr>
		  		<tr>
		  			<td width="28%" align="right" valign="top">&nbsp;</td>
		  			<td width="35%" valign="top">&nbsp;</td>
		  			<td width="35%" height="30" valign="top"><p>Lic. Mar&iacute;a
		  				Fernanda Rivadeneyra N&uacute;&ntilde;ez<br />
		  				Tel. 59.50.40.00<br />
		  				Ext. 7488<br />
		  				<a href="mailto:dec.01@ibero.mx">dec.01@ibero.mx</a><br />
  			        </p></td>
	  			</tr>
		  		<tr>
		  			<td width="28%" align="right" valign="top"><p><strong>Atenci&oacute;n
			      Integral al Sector P&uacute;blico</strong></p></td>
		  			<td width="35%" valign="top">&nbsp;</td>
		  			<td width="35%" height="30" valign="top"><p>Lic. Claudia Ram&iacute;rez Lona<br />
		  			  Tel. 59.50.40.00, Ext. 4328<br />
	  			    <a href="mailto:claudia.ramirez@ibero.mx">claudia.ramirez@ibero.mx</a></p></td>
	  			</tr>
    </table>
		  <!-- InstanceEndEditable -->
        <table width="93%" border="0" align="center" cellpadding="5" cellspacing="10">
          <tr>
            <td><!-- AddThis Button BEGIN -->
              
              <div class="addthis_toolbox addthis_default_style"
						addthis:url="articulos.php?id_discipline=<? echo $_GET['id_discipline']; ?>"
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
    
<div style="width:25%; float:left; margin-left:18px; margin-top:18px">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>          
          <td align="center"><a onclick="parent.location='http://www.diplomados.uia.mx/promociones.php'" href="#"><img src="imagenes/banner_descuentos.png" width="181px" border="0" /></a></td>
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
</div>
</div>
 <div id="footer" style="float:left;width:810px">
    <table border="0" cellpadding="0" cellspacing="0" >
      <tr>
        <td width="810"><a onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=20'" href="#"><img src="imagenes/banners/idiomas_otono.jpg" alt="Dos" width="804" height="142" border="0" /></a></td>
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

