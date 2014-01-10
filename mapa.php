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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/mapa.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Untitled Document</title>
<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
<script type="text/javascript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>

<!-- FUNCION PARA COOKIES -->
<script type="text/javascript">
function setCookie(c_name,value,expiredays)
{
var exdate=new Date();
exdate.setDate(exdate.getDate()+expiredays);
document.cookie=c_name+ "=" +escape(value)+
((expiredays==null) ? "" : ";expires="+exdate.toGMTString());
}
</script>
<script language="javascript">
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

var flags=new Array();
	 flags[1]=1;
	 flags[2]=0;
	 flags[3]=0;
	 flags[4]=0;
	 flags[5]=0;
     flags[6]=0;
	 flags[7]=0;
	 flags[8]=0;
	 
function activarMenutabla(n){
	if (flags[n]==0){
		document.getElementById("m1").style.display="none";
		document.getElementById("m2").style.display="none";
		document.getElementById("m3").style.display="none";
		document.getElementById("m4").style.display="none";
		document.getElementById("m5").style.display="none";
		document.getElementById("m6").style.display="none";
		document.getElementById("m7").style.display="none";
		document.getElementById("m8").style.display="none";
		flags[1]=0;
	 	flags[2]=0;
	 	flags[3]=0;
	 	flags[4]=0;
		flags[5]=0;
     	flags[6]=0;
		flags[7]=0;
	    flags[8]=0;
		document.getElementById("m"+n).style.display="block";
		flags[n]=1;
	}else{
		flags[1]=1;
	 	flags[2]=1;
	 	flags[3]=1;
	 	flags[4]=1;
		flags[5]=1;
     	flags[6]=1;
		flags[7]=1;
		flags[8]=1;
		flags[n]=0;
	}
}
//-->
</script>
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
		
		window.setInterval('resizeHelperIframe();',1000);
		
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
            <!--<li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=21&id_program=196'">Asunci&oacute;n Quer&eacute;taro</a></li>
           
            <!-- <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=22&id_program=92'">Atrio Espacio Cultural</a></li> -->
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
    <div id= "type4" class="cuadro_articulos_secciones">
      <div style="position:relative; float:left; z-index:12;"> <!-- InstanceBeginEditable name="header" -->
        <object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="730" height="415">
          <param name="movie" value="swf/mapa.swf" />
          <param name="quality" value="high" />
          <param name="wmode" value="opaque" />
          <param name="swfversion" value="9.0.45.0" />
          <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->
          <param name="expressinstall" value="Scripts/expressInstall.swf" />
          <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. --> 
          <!--[if !IE]>-->
          <object type="application/x-shockwave-flash" data="swf/mapa.swf" width="730" height="415">
            <!--<![endif]-->
            <param name="quality" value="high" />
            <param name="wmode" value="opaque" />
            <param name="swfversion" value="9.0.45.0" />
            <param name="expressinstall" value="Scripts/expressInstall.swf" />
            <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
            <div>
              <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
              <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p>
            </div>
            <!--[if !IE]>-->
          </object>
          <!--<![endif]-->
        </object>
        <script type="text/javascript">
swfobject.registerObject("FlashID");
	</script>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td align="left" valign="top"><table width="95%" align="center" class="mostrarMenu1" id="m1">
                <tr>
                  <td width="100%" height="100%" valign="top" class="miniTexto"><p>Estacionamiento,
                      con un <strong>Horario</strong> de servicio de 06:00 - 21:00 hrs. en todos los accesos.
                      Y con un servicio de 24 hrs. en la puerta 9. <strong><br />
                      </strong><br />
                    </p>
                    <table width="95%" border="0" cellspacing="0" cellpadding="2">
                      <tr>
                        <td width="5%"><img src="imagenes/imagenes_mapa/a1.gif" width="26" height="26" /></td>
                        <td width="10%"><p><strong>Puerta 1</strong></p></td>
                        <td width="2%" rowspan="10">&nbsp;</td>
                        <td width="2%"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="81%"><p>Acceso a
                            estacionamiento E1,
                            E2, E3, E4 por
                            Av. Prol. Paseo de la Reforma</p></td>
                      </tr>
                      <tr>
                        <td width="5%"><img src="imagenes/imagenes_mapa/a1.gif" width="26" height="26" /></td>
                        <td width="10%"><p><strong>Puerta 2</strong></p></td>
                        <td width="2%"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="81%"><p>Acceso a estacionamiento E1,
                            E2 por Prol. Paseo
                            de la Reforma</p></td>
                      </tr>
                      <tr>
                        <td width="5%"><img src="imagenes/imagenes_mapa/a1.gif" width="26" height="26" /></td>
                        <td width="10%"><p><strong>Puerta 3</strong></p></td>
                        <td width="2%"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="81%"><p>Acceso peatonal, llegada
                            y salida iberobus
                            Transporte UIA</p></td>
                      </tr>
                      <tr>
                        <td width="5%"><img src="imagenes/imagenes_mapa/a1.gif" width="26" height="26" /></td>
                        <td width="10%"><p><strong>Puerta 4</strong></p></td>
                        <td width="2%"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="81%"><p>Acceso peatonal por Prol.
                            Paseo de la Reforma</p></td>
                      </tr>
                      <tr>
                        <td width="5%"><img src="imagenes/imagenes_mapa/a2.gif" width="26" height="26" /></td>
                        <td width="10%"><p><strong>Puerta 5</strong></p></td>
                        <td width="2%"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="81%"><p>Acceso a profesores y
                            administrativos, estacionamiento E5, por Prol. Paseo de la Reforma</p></td>
                      </tr>
                      <tr>
                        <td width="5%"><img src="imagenes/imagenes_mapa/a3.gif" width="26" height="26" /></td>
                        <td width="10%"><p><strong>Puerta 6</strong></p></td>
                        <td width="2%"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="81%"><p>Acceso a estacionamiento E6,
                            E8, E10, E12 por
                            Av. Joaqu&iacute;n Gallo</p></td>
                      </tr>
                      <tr>
                        <td width="5%"><img src="imagenes/imagenes_mapa/a4.gif" width="26" height="26" /></td>
                        <td width="10%"><p><strong>Puerta 8</strong></p></td>
                        <td width="2%"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="81%"><p>Acceso a estacionamiento E8,
                            E7, E6, E10, E11 por
                            Av. Vasco de Qu&iacute;roga</p></td>
                      </tr>
                      <tr>
                        <td width="5%"><img src="imagenes/imagenes_mapa/a5.gif" width="26" height="26" /></td>
                        <td width="10%"><p><strong>Puerta 9</strong></p></td>
                        <td width="2%"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="81%"><p>Acceso peatonal y a estacionamiento E9,
                            E8, E6, E10, E11, E4, E3 por Av. Vasco de Qu&iacute;roga</p></td>
                      </tr>
                      <tr>
                        <td width="5%"><img src="imagenes/imagenes_mapa/a6.gif" width="26" height="26" /></td>
                        <td width="10%"><p><strong>Puerta 10</strong></p></td>
                        <td width="2%"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="81%"><p>Acceso peatonal por Av. Vasco
                            de Qu&iacute;roga</p></td>
                      </tr>
                    </table></td>
                </tr>
              </table>
              <br />
              <table width="98%" class="contenidoTablas" id="m2">
                <tr>
                  <td width="100%" height="100%" valign="top" class="miniTexto"><table width="95%" border="0" align="left" cellpadding="2" cellspacing="0">
                      <tr>
                        <td width="15%" align="right" valign="top"><p><strong>Biblioteca</strong></p></td>
                        <td width="2%" rowspan="13" valign="top">&nbsp;</td>
                        <td width="2%" valign="top"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="81%" align="left" valign="top"><p>Taller
                            de habilidades&nbsp; informativas,&nbsp; cine club,
                            c&iacute;rculo de lectura, pr&eacute;stamo interbibliotecario,
                            cub&iacute;culos de estudio, fotocopias de art&iacute;culos,
                            constancia de no adeudo, recepci&oacute;n de tesis,
                            desbloqueos para&nbsp; reinscripci&oacute;n.<br />
                            <strong><strong>Horario</strong></strong>: lunes a viernes
                            07:00 - 20:45 hrs. / s&aacute;bado 09:00 - 13:45 hrs. </p></td>
                      </tr>
                      <tr>
                        <td width="15%" align="right" valign="top"><p><strong>Bancos</strong></p></td>
                        <td width="2%" valign="top"><br />
                          <img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="81%" valign="top"><p><img src="imagenes/imagenes_mapa/bancos.jpg" width="214" height="24" /><br />
                            <strong>Banamex&nbsp; e Ixe</strong></p>
                          <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
                            <tr>
                              <td width="6%" align="right"><img src="imagenes/imagenes_mapa/bullet griss.gif" width="9" height="12" /></td>
                              <td width="92%"><p>Cajeros autom&aacute;ticos
                                  (Banamex, Ixe y Bancomer)</p></td>
                            </tr>
                            <tr>
                              <td align="right"><img src="imagenes/imagenes_mapa/bullet griss.gif" width="9" height="12" /></td>
                              <td><p><strong>Horario</strong> Banamex: lunes a viernes 09:00 - 17:00 hrs.</p></td>
                            </tr>
                            <tr>
                              <td align="right"><img src="imagenes/imagenes_mapa/bullet griss.gif" width="9" height="12" /></td>
                              <td><p><strong>Horario</strong> Ixe: lunes a viernes 08:30 - 18:00 hrs. </p></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                          </table>
                          <p> <br />
                          </p></td>
                      </tr>
                      <tr valign="top">
                        <td width="15%" align="right"><p><strong>Lumen</strong></p></td>
                        <td width="2%"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="81%"><p><img src="imagenes/imagenes_mapa/lumen.gif" width="74" height="27" /></p>
                          <p>Podr&aacute;s encontrar art&iacute;culos de papeler&iacute;a para tus clases.</p>
                          <p><strong>Horario</strong>: lunes a viernes 07:00 - 19:00 hrs.<br />
                          </p></td>
                      </tr>
                      <tr>
                        <td width="15%" align="right"><p><strong>MacStore</strong></p></td>
                        <td width="2%"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="81%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="7%"><img src="imagenes/imagenes_mapa/mac.gif" width="28" height="26" /></td>
                              <td width="93%" height="26"><p>Encontratr&aacute;s
                                  equipos mac y sus diversos accesorios, etc.</p></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td width="15%" align="right" valign="top"><p><strong>Gandhi</strong></p></td>
                        <td width="2%"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="81%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="13%"><img src="imagenes/imagenes_mapa/gandhi.gif" width="62" height="20" /></td>
                              <td width="87%"><p>Libros, discos,
                                  etc.</p></td>
                            </tr>
                          </table>
                          <p><strong>Horario</strong>: lunes a jueves 09:00 - 20:00 hrs. / viernes 09:00 - 19:00 hrs.
                            / s&aacute;bado 10:00 - 13:00 hrs.</p></td>
                      </tr>
                      <tr>
                        <td width="15%" align="right"><p><strong>&nbsp;&nbsp;Capilla</strong></p></td>
                        <td width="2%"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="81%"><p>Misas diarias a
                            las 08:45, 10:45 y 17:45 hrs.</p></td>
                      </tr>
                      <tr>
                        <td width="15%" align="right"><p><strong>Servicio M&eacute;dico</strong></p></td>
                        <td width="2%"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="81%"><p><strong>Horario</strong>: lunes
                            a viernes 07:00 - 22:00 hrs. y s&aacute;bado de 09:00 - 14:00 hrs.</p></td>
                      </tr>
                      <tr valign="top">
                        <td width="15%" align="right"><p><strong> Servicios Escolares</strong></p></td>
                        <td width="2%"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="81%"><p><strong>Horario</strong>: lunes
                            a viernes 09:00 - 17:45 hrs. en el mapa hay que marcarlo en
                            el edificio K.</p></td>
                      </tr>
                      <tr>
                        <td width="15%" align="right"><p><strong>Cajas Generales</strong></p></td>
                        <td width="2%"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="81%"><p><strong>Horario</strong>: lunes
                            a viernes 09:00 -18:00 hrs. en el mapa hay que marcarlo en el
                            edificio N.</p></td>
                      </tr>
                    </table></td>
                </tr>
              </table>
              <table width="98%" class="contenidoTablas" id="m3">
                <tr>
                  <td width="100%" height="100%" valign="top" class="miniTexto"><table width="95%" border="0" cellspacing="0" cellpadding="2">
                      <tr>
                        <td width="15%" align="right" valign="top"><p><strong>El
                            Tr&eacute;bol</strong></p></td>
                        <td width="2%" rowspan="11" class="linea_gris">&nbsp;</td>
                        <td width="2%" valign="top"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="81%" align="left" valign="top"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
                            <tr>
                              <td width="5" align="right" valign="top"><img src="imagenes/imagenes_mapa/bullet griss.gif" width="9" height="12" /></td>
                              <td width="97%" valign="top"><p><strong>Horario</strong> de 09:00 - 18:00 hrs.</p></td>
                            </tr>
                            <tr>
                              <td width="5" align="right" valign="top"><img src="imagenes/imagenes_mapa/bullet griss.gif" width="9" height="12" /></td>
                              <td valign="top"><p>Paquetes
                                  de desayunos, de $38 a $59 <br />
                                </p></td>
                            </tr>
                            <tr>
                              <td width="5" align="right" valign="top"><img src="imagenes/imagenes_mapa/bullet griss.gif" width="9" height="12" /></td>
                              <td valign="top"><p>Comidas
                                  corridas con un costo de $50.50 <br />
                                </p></td>
                            </tr>
                            <tr>
                              <td width="5" align="right" valign="top"><img src="imagenes/imagenes_mapa/bullet griss.gif" width="9" height="12" /></td>
                              <td valign="top"><p>Men&uacute; variado:
                                  sopas, ensaladas, s&aacute;ndwiches, y platos fuertes,
                                  de $22 a $70 <br />
                                </p></td>
                            </tr>
                            <tr>
                              <td width="5" align="right" valign="top"><img src="imagenes/imagenes_mapa/bullet griss.gif" width="9" height="12" /></td>
                              <td valign="top"><p>En
                                  esta misma &aacute;rea se encuentra <strong>Come
                                  m&aacute;s natural</strong>, barra de ensaladas,
                                  el precio var&iacute;a dependiendo el tama&ntilde;o
                                  de la ensalada, de $45 a $75 <br />
                                </p></td>
                            </tr>
                            <tr>
                              <td width="5" align="right" valign="top"><img src="imagenes/imagenes_mapa/bullet griss.gif" width="9" height="12" /></td>
                              <td valign="top"><p>Igualmente
                                  se encuentra el &aacute;rea de <strong>Caf&eacute;</strong>,
                                  donde ofrecen desde caf&eacute;s calientes y fr&iacute;os,
                                  t&eacute;s, infusiones, galletas, pasteles, entre
                                  otras cosas; de $17 a $38 pesos, con un <strong>Horario</strong> de
                                  servicio de 07:00 - 20:00 hrs.</p></td>
                            </tr>
                            <tr>
                              <td width="5" align="right" valign="top">&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td width="15%" align="right" valign="top"><p><strong>El
                            Cubo</strong></p></td>
                        <td valign="top"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="81%" align="left" valign="top"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
                            <tr>
                              <td width="20" align="right"><img src="imagenes/imagenes_mapa/bullet griss.gif" width="9" height="12" /></td>
                              <td width="97%"><p><strong>Horario</strong> de
                                  07:00 - 20:00 hrs.</p></td>
                            </tr>
                            <tr>
                              <td width="20" align="right"><img src="imagenes/imagenes_mapa/bullet griss.gif" width="9" height="12" /></td>
                              <td><p>Cuenta con varios locales,
                                  que ofrecen diferentes tipos de alimentos:</p></td>
                            </tr>
                            <tr>
                              <td width="20">&nbsp;</td>
                              <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="20" height="20" align="right" valign="top"><p><img src="imagenes/imagenes_mapa/bullet_2nivel.gif" width="7" height="15" /></p></td>
                                    <td valign="top"><p><strong>Tiendita</strong></p></td>
                                  </tr>
                                  <tr>
                                    <td width="20" height="20" align="right" valign="top"><img src="imagenes/imagenes_mapa/bullet_2nivel.gif" width="7" height="15" /></td>
                                    <td valign="top"><p><strong>Sushi</strong></p></td>
                                  </tr>
                                  <tr>
                                    <td width="20" align="right" valign="top"><img src="imagenes/imagenes_mapa/bullet_2nivel.gif" width="7" height="15" /></td>
                                    <td valign="top"><p><strong>Verde
                                        Lim&oacute;n</strong>: <br />
                                        fruta, licuados, jugos, chicharrones. De $12
                                        a $20 </p></td>
                                  </tr>
                                  <tr>
                                    <td width="20" align="right" valign="top"><img src="imagenes/imagenes_mapa/bullet_2nivel.gif" width="7" height="15" /></td>
                                    <td valign="top"><p><strong>Las
                                        Ensaladas</strong>: <br />
                                        con un precio de $45 Con surimi, jam&oacute;n,
                                        pollo o at&uacute;n el valor es de $50 </p></td>
                                  </tr>
                                  <tr>
                                    <td width="20" align="right" valign="top"><img src="imagenes/imagenes_mapa/bullet_2nivel.gif" width="7" height="15" /></td>
                                    <td valign="top"><p><strong>La
                                        Fondita</strong>: <br />
                                        quesadillas, flautas, molletes, sincronizadas;
                                        de $24 a $35 </p></td>
                                  </tr>
                                  <tr>
                                    <td width="20" align="right" valign="top"><img src="imagenes/imagenes_mapa/bullet_2nivel.gif" width="7" height="15" /></td>
                                    <td valign="top"><p><strong>El
                                        Canibalazo</strong>: <br />
                                        alimentos con cochinita: tacos, tortas, quesadillas;
                                        de $10 a $25. Paquetes (incluyen bebida) de $47
                                        a $67 </p></td>
                                  </tr>
                                  <tr>
                                    <td width="20" align="right" valign="top"><img src="imagenes/imagenes_mapa/bullet_2nivel.gif" width="7" height="15" /></td>
                                    <td valign="top"><p><strong>Plato
                                        Fuerte</strong>: <br />
                                        hamburguesas, hot dog, tortas, pizzas, paninis;
                                        de $15 a $40 </p></td>
                                  </tr>
                                  <tr>
                                    <td width="20" align="right" valign="top"><img src="imagenes/imagenes_mapa/bullet_2nivel.gif" width="7" height="15" /></td>
                                    <td valign="top"><p><strong>The
                                        Coffee Ring</strong>:<br />
                                        Caf&eacute;s calientes y fr&iacute;os, galletas,
                                        pasteler&iacute;a; de $12 a $42</p></td>
                                  </tr>
                                </table>
                                <br /></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td width="15%" align="right" valign="top"><p><strong>La
                            terraza</strong></p></td>
                        <td valign="top"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="81%" align="left" valign="top"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
                            <tr>
                              <td width="5" align="right"><img src="imagenes/imagenes_mapa/bullet griss.gif" width="9" height="12" /></td>
                              <td width="97%"><p><strong>Horario</strong> de
                                  07:30 - 20:00 hrs.</p></td>
                            </tr>
                            <tr>
                              <td width="5" align="right"><img src="imagenes/imagenes_mapa/bullet griss.gif" width="9" height="12" /></td>
                              <td><p>Desayunos, se sirven de
                                  07:30 - 12:00 hrs. con un costo de $42 pesos.</p></td>
                            </tr>
                            <tr>
                              <td width="5" align="right"><img src="imagenes/imagenes_mapa/bullet griss.gif" width="9" height="12" /></td>
                              <td><p>Comida Corrida, se sirven
                                  de 10:30 - 18:00 hrs. con un costo de $48 pesos.</p></td>
                            </tr>
                            <tr>
                              <td width="5" align="right"><img src="imagenes/imagenes_mapa/bullet griss.gif" width="9" height="12" /></td>
                              <td><p><strong>Taquer&iacute;a</strong>, <strong>Horario</strong> de servicio de 11:00 - 20:00 hrs. ; tacos por pieza,
                                  paquetes de $20 a $55 pesos.</p></td>
                            </tr>
                            <tr>
                              <td width="5" align="right"><img src="imagenes/imagenes_mapa/bullet griss.gif" width="9" height="12" /></td>
                              <td><p><strong>Crepas</strong>,
                                  dulces y saladas; de $25 a $40 pesos.</p></td>
                            </tr>
                            <tr>
                              <td width="5" align="right"><img src="imagenes/imagenes_mapa/bullet griss.gif" width="9" height="12" /></td>
                              <td><p>Tienda</p></td>
                            </tr>
                          </table>
                          <p>&nbsp;</p></td>
                      </tr>
                      <tr>
                        <td width="15%" align="right" valign="top"><p><strong>Tienda
                            del Sindicato de Trabajadores de la UIA</strong></p></td>
                        <td valign="top"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="81%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="98%"><p>Tienda del
                                  Sindicato de Trabajadores de la UIA, manejada por
                                  el Sindicato de Trabajadores de la Universidad, con
                                  un <strong>Horario</strong> de 08:15 - 17:30 hrs. , donde adem&aacute;s
                                  se encuentran cuatro locales que ofrecen:<br />
                                </p></td>
                            </tr>
                          </table>
                          <br />
                          <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
                            <tr>
                              <td width="3%" align="right" valign="top">&nbsp;</td>
                              <td width="5" align="right"><img src="imagenes/imagenes_mapa/bullet griss.gif" width="9" height="12" /></td>
                              <td width="94%"><p><strong>Chapatas</strong>,&nbsp; con
                                  un valor de $30 a $44, dependiendo los ingredientes.</p></td>
                            </tr>
                            <tr>
                              <td align="right" valign="top">&nbsp;</td>
                              <td width="5" align="right"><img src="imagenes/imagenes_mapa/bullet griss.gif" width="9" height="12" /></td>
                              <td valign="top"><p><strong>Do&ntilde;a
                                  Mode</strong>: quesadillas y gorditas, con un
                                  costo de $13 </p></td>
                            </tr>
                            <tr>
                              <td align="right" valign="top">&nbsp;</td>
                              <td width="5" align="right"><img src="imagenes/imagenes_mapa/bullet griss.gif" width="9" height="12" /></td>
                              <td valign="top"><p>Tacos
                                  de canasta</p></td>
                            </tr>
                            <tr>
                              <td align="right" valign="top">&nbsp;</td>
                              <td width="5" align="right"><img src="imagenes/imagenes_mapa/bullet griss.gif" width="9" height="12" /></td>
                              <td valign="top"><p>Ensaladas,
                                  fruta, jugo, licuados, aguas; de $10 a $30 </p></td>
                            </tr>
                            <tr>
                              <td colspan="3" align="left" valign="top"><p>Adem&aacute;s de estas cafeter&iacute;as y tienditas,
                                  la Universidad cuenta con 51 maquinas expendedoras
                                  de alimentos, bebidas y caf&eacute;s. </p></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                </tr>
              </table>
              <table width="98%" class="contenidoTablas" id="m4">
                <tr>
                  <td width="100%" height="100%" valign="top" class="miniTexto"><table width="95%" border="0" cellspacing="0" cellpadding="2">
                      <tr>
                        <td width="15%" align="right" valign="top"><p><strong>Gimnasio<br />
                            <span class="contenido_diploRojo">(gratuito)</span></strong></p></td>
                        <td width="2%" rowspan="10" class="linea_gris">&nbsp;</td>
                        <td width="2%" valign="top"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="81%" valign="top"><p>lunes
                            a viernes de 07:00 - 21:00 hrs.<br />
                            Pesas, yoga, aikido, kung fu, kick boxing, taebo, capoeira,
                            tae/kwon/do, spinning, pilates, tenis, acondicionamiento f&iacute;sico
                            y zumba.</p></td>
                      </tr>
                      <tr>
                        <td width="15%" align="right" valign="top"><p><strong>Talleres
                            Art&iacute;sticos<br />
                            <span class="contenido_diploRojo">(gratuito)</span></strong></p></td>
                        <td width="2%" valign="top"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="81%" valign="top"><p>Foto, escritura
                            creativa, flamenco para principiantes, bailes tropicales,
                            bailes de sal&oacute;n, expresi&oacute;n corporal ritmica,
                            Clown, t&eacute;cnica vocal, Teatro &ldquo;impro&rdquo;,
                            Producci&oacute;n art&iacute;stica, apreciaci&oacute;n
                            musical y guitarra b&aacute;sica.</p></td>
                      </tr>
                      <tr>
                        <td width="15%" align="right" valign="top"><p><strong>Torneos
                            Internos</strong></p></td>
                        <td width="2%" valign="top"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="81%" valign="top"><p>Futbol varonil
                            y femenil, softbol mixto, tenis singles y dobles, tercias
                            de b&aacute;squetbol, voleibol mixto y de playa.</p></td>
                      </tr>
                      <tr>
                        <td width="15%" align="right" valign="top"><p><strong>Sociedad
                            de alumnos</strong></p></td>
                        <td width="2%" valign="top"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="81%" valign="top"><p>Participa en las
                            actividades de la mesa directiva de tu carrera.</p></td>
                      </tr>
                    </table>
                    <br />
                    <table width="95%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td align="right"><p class="contenido_diploRojo"><strong>M&aacute;s
                            informaci&oacute;n y consulta de <strong>Horario</strong>s: www.uia.mx
                            Tel. 5950 4000 Ext. 462</strong></p></td>
                      </tr>
                    </table></td>
                </tr>
              </table>
              <table width="98%" class="contenidoTablas" id="m5">
                <tr>
                  <td width="100%" height="100%" align="center" valign="top" class="miniTexto"><table width="95%" border="0" align="left" cellpadding="2" cellspacing="0">
                      <tr>
                        <td width="15%" rowspan="11" align="right" valign="top"><p><strong>Auditorios</strong></p></td>
                        <td width="2%" rowspan="15" class="linea_gris">&nbsp;</td>
                        <td width="2%" align="left" valign="top"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="81%" align="left" valign="top">Aula
                          Magna San Ignacio de Loyola</td>
                      </tr>
                      <tr>
                        <td width="2%" align="left" valign="top"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="81%" align="left" valign="top"><p>Auditorio Xavier Scheifler y de Amézaga</p></td>
                      </tr>
                      <tr>
                        <td width="2%" align="left" valign="top"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="81%" align="left" valign="top"><p>Auditorio Ernesto Meneses Morales</p></td>
                      </tr>
                      <tr>
                        <td width="2%" align="left" valign="top"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="81%" align="left" valign="top"><p>Auditorio R.P. Fernando Bustos Barrena, S. J.</p></td>
                      </tr>
                      <tr>
                        <td width="2%" align="left" valign="top"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="81%" align="left" valign="top"><p> Auditorio Ángel Palerm Vich</p></td>
                      </tr>
                      <tr>
                        <td width="2%" align="left" valign="top"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="81%" align="left" valign="top"><p>Auditorio Crescencio Ballesteros    Ibarra</p></td>
                      </tr>
                      <tr>
                        <td width="2%" align="left" valign="top"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="81%" align="left" valign="top"><p>Auditorio Miguel    Villoro Toranzo</p></td>
                      </tr>
                      <tr>
                        <td width="2%" align="left" valign="top"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="81%" align="left" valign="top"><p>Auditorio Manuel    Borja Mart&iacute;nez</p></td>
                      </tr>
                      <tr>
                        <td width="2%" align="left" valign="top"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="81%" align="left" valign="top"><p> Auditorio José Sánchez Villaseñor</p></td>
                      </tr>
                      <tr>
                        <td width="2%" align="left" valign="top">&nbsp;</td>
                        <td width="81%" valign="top">&nbsp;</td>
                      </tr>
                    </table></td>
                </tr>
              </table>
              <table width="98%" class="contenidoTablas" id="m6">
                <tr>
                  <td width="100%" height="100%" valign="top" class="miniTexto"><table width="95%" border="0" cellspacing="0" cellpadding="2">
                      <tr>
                        <td width="20%" align="right" valign="top"><p><strong>Arquitectura</strong></p></td>
                        <td width="2%" rowspan="16">&nbsp;</td>
                        <td width="2%" valign="top"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="25%" height="60" valign="top"><p>Mtra.
                            Carolyn Aguilar Dubose<br />
                            <a href="mailto: carolyn.aguilar@uia.mx">carolyn.aguilar@uia.mx</a><br />
                            Tel. 59.50.42.85</p></td>
                        <td width="2%" valign="top">&nbsp;</td>
                        <td width="20%" align="right" valign="top" class="contenido_diplo"><p><strong>Estudios
                            Internacionales</strong></p></td>
                        <td width="2%" rowspan="16" valign="top" class="linea_gris">&nbsp;</td>
                        <td width="2%" valign="top"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="25%" valign="top"><p>Dr. David Mena Alemán<br />
                            <a href="mailto: david.mena@uia.mx">david.mena@uia.mx </a><br />
                            Tel. 59.50.41.31</a></p></td>
                      </tr>
                      <tr>
                        <td width="20%" align="right" valign="top"><p><strong>Arte</strong></p></td>
                        <td width="2%" valign="top"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="25%" height="60" valign="top"><p>Dr. Francisco López Ruiz<br />
                            <a href="mailto: francisco.lopez@uia.mx">francisco.lopez@uia.mx </a><br />
                            Tel. 59.50.40.32</p>
                          </a></td>
                        <td width="2%" valign="top">&nbsp;</td>
                        <td width="20%" align="right" valign="top" class="contenido_diplo"><p><strong>Filosof&iacute;a</strong></p></td>
                        <td width="2%" valign="top"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="25%" valign="top"><p>Dr. Luis Ignacio Guerrero Martínez<br />
                            <a href="mailto: luis.guerrero@uia.mx">luis.guerrero@uia.mx </a><br />
                            Tel.  59.50.40.43</p></td>
                      </tr>
                      <tr>
                        <td width="20%" align="right" valign="top"><p><strong>Ciencias
                            Religiosas<br />
                            </strong></p></td>
                        <td width="2%" valign="top"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="25%" height="60" valign="top"><p>Dr. Humberto José Sánchez Zariñaña, S. J.<br />
                            <a href="mailto: hjose.sanchez@uia.mx">hjose.sanchez@uia.mx </a><br />
                            Tel.  59.50.40.35</p></td>
                        <td width="2%" valign="top">&nbsp;</td>
                        <td width="20%" align="right" valign="top"><p><strong>F&iacute;sica
                            y matem&aacute;ticas</strong></p></td>
                        <td width="2%" valign="top"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="25%" valign="top"><p>Dr. Alfredo Sandoval Villalbazo<br />
                            <a href="mailto:alfredo.sandoval@uia.mx">alfredo.sandoval@uia.mx</a> <br />
                            Tel. 59.50.40.71</p></td>
                      </tr>
                      <tr>
                        <td width="20%" align="right" valign="top"><p><strong>Dise&ntilde;o</strong></p></td>
                        <td width="2%" valign="top"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="25%" height="60" valign="top"><p>Mtro. Jorge Meza Aguilar<br />
                            <a href="mailto:jorge.meza@uia.mx">jorge.meza@uia.mx</a> <br />
                            Tel. 59.50.40.94</p></td>
                        <td width="2%" valign="top">&nbsp;</td>
                        <td width="20%" align="right" valign="top" class="contenido_diplo"><p><strong>Historia</strong></p></td>
                        <td width="2%" valign="top"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="25%" valign="top"><p>Dra. Jane D&auml;le Lloyd Daley<br />
                            <a href="mailto:jane.dale@uia.mx">jane.dale@uia.mx</a> <br />
                            Tel.   59.50.40.44</p></td>
                      </tr>
                      <tr>
                        <td width="20%" align="right" valign="top"><p><strong>Comunicaci&oacute;n</strong></p></td>
                        <td width="2%" valign="top"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="25%" height="60" valign="top"><p>Dr. Manuel Alejandro Guerrero Mart&iacute;nez<br />
                            <a href="mailto:alejandro.guerrero@uia.mx">alejandro.guerrero@uia.mx</a> <br />
                            Tel.  59.50.40.37</p></td>
                        <td width="2%" valign="top">&nbsp;</td>
                        <td width="20%" align="right" valign="top" class="contenido_diplo"><p><strong>Ingenier&iacute;a
                            y Ciencias Quimicas</strong></p></td>
                        <td width="2%" valign="top"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="25%" valign="top"><p>Dr. Jorge Ib&aacute;&ntilde;ez Cornejo<br />
                            <a href="mailto:jorge.ibanez@uia.mx">jorge.ibanez@uia.mx</a> <br />
                            Tel. 59.50.41.68</p></td>
                      </tr>
                      <tr>
                        <td width="20%" align="right" valign="top"><p><strong>Econom&iacute;a</strong></p></td>
                        <td width="2%" valign="top"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="25%" height="60" valign="top"><p>Dr. Pablo Cotler Avalos<br />
                            <a href="mailto:pablo.cotler@uia.mx">pablo.cotler@uia.mx</a> <br />
                            Tel.   59.50.42.68</p></td>
                        <td width="2%" valign="top">&nbsp;</td>
                        <td width="20%" align="right" valign="top"><p><strong>Ingiener&iacute;as</strong></p></td>
                        <td width="2%" valign="top"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="25%" valign="top"><p>Mtro. Jorge Andr&eacute;s Mart&iacute;nez Alarc&oacute;n<br />
                            <a href="mailto:jorgea.martinez@uia.mx">jorgea.martinez@uia.mx</a><br />
                            Tel.   59.50.40.77</p></td>
                      </tr>
                      <tr>
                        <td width="20%" align="right" valign="top"><p><strong>Educaci&oacute;n</strong></p></td>
                        <td width="2%" valign="top"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="25%" height="60" valign="top"><p>Dr. Javier Loredo Enr&iacute;quez<br />
                            <a href="mailto:javier.loredo@uia.mx">javier.loredo@uia.mx</a><br />
                            Tel.  59.50.40.40</p></td>
                        <td width="2%" valign="top">&nbsp;</td>
                        <td width="20%" align="right" valign="top"><p><strong>Ciencias
                            Sociales y Politicas</strong></p></td>
                        <td width="2%" valign="top"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="25%" valign="top"><p>Dra. Helena Varela Guinot<br />
                            <a href="mailto:helena.varela@uia.mx">helena.varela@uia.mx</a> <br />
                            Tel.   59.50.40.36</p></td>
                      </tr>
                      <tr>
                        <td width="20%" align="right" valign="top"><p><strong>Estudios
                            Empresariales</strong></p></td>
                        <td width="2%" valign="top">&nbsp;</td>
                        <td width="25%" height="60" valign="top"><p>Mtro. Jorge Smeke Zwaiman<br />
                            <a href="mailto:jorge.smeke@uia.mx">jorge.smeke@uia.mx</a><br />
                            Tel.  59.50.42.50</p></td>
                        <td width="2%" valign="top">&nbsp;</td>
                        <td width="20%" align="right" valign="top"><p><strong>Derecho</strong></p></td>
                        <td width="2%" valign="top"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="25%" valign="top"><p>Dr. V&iacute;ctor M. Rojas Amandi<br />
                            <a href="mailto:victor.rojas@uia.mx">victor.rojas@uia.mx</a><br />
                            Tel. 59.50.42.46</p></td>
                      </tr>
                    </table></td>
                </tr>
              </table>
              <table width="98%" class="contenidoTablas" id="m7">
                <tr>
                  <td width="100%" height="100%" valign="top"><table width="95%" border="0" cellspacing="0" cellpadding="2">
                      <tr>
                        <td width="30%" align="right" valign="top"><p><strong>Rector&iacute;a</strong></p></td>
                        <td width="2%" rowspan="15" valign="top">&nbsp;</td>
                        <td width="2%" valign="top"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="66%" valign="top"><p>Dr.
                            Jos&eacute; Morales Orozco, S. J.<br />
                            <strong>Rector de la Universidad Iberoamericana Ciudad de M&eacute;xico</strong><br />
                            <a href="mailto: jose.morales@uia.mx">jose.morales@uia.mx</a><br />
                            Tel. 59.50.40.00  Ext. 4500</p></td>
                      </tr>
                      <tr>
                        <td width="30%" align="right" valign="top">&nbsp;</td>
                        <td width="2%" valign="top">&nbsp;</td>
                        <td width="66%" valign="top">&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="30%" align="right" valign="top"><p><strong>Vicerrector&iacute;a
                          Acad&eacute;mica</strong></p></td>
                        <td width="2%" valign="top"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="66%" valign="top"><p>Dr.
                            Javier Prado Gal&aacute;n, S. J.<br />
                            <strong>Vicerrector Acad&eacute;mico</strong><br />
                            <a href="mailto: javier.prado@uia.mx">javier.prado@uia.mx<br />
                            </a>Tel. 59.50.41.54</p></td>
                      </tr>
                      <tr>
                        <td width="30%" align="right" valign="top">&nbsp;</td>
                        <td width="2%" valign="top">&nbsp;</td>
                        <td width="66%" valign="top">&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="30%" align="right" valign="top"><p><strong>Direcci&oacute;n
                          General Admistrativa</strong></p></td>
                        <td width="2%" valign="top"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="66%" valign="top"><p>Mtro.
                            Jos&eacute; Luis Flores Rangel<br />
                            <strong>Director General Administrativo</strong><br />
                            <a href="mailto: josel.flores@uia.mx">josel.flores@uia.mx</a><br />
                            Tel. 59.50.42.58</p></td>
                      </tr>
                      <tr>
                        <td width="30%" align="right" valign="top">&nbsp;</td>
                        <td width="2%" valign="top">&nbsp;</td>
                        <td width="66%" valign="top">&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="30%" align="right" valign="top"><p><strong>Direcci&oacute;n
                          General del Medio Universitario</strong></p></td>
                        <td width="2%" valign="top"><img src="imagenes/imagenes_mapa/bullet_gris.gif" width="7" height="15" /></td>
                        <td width="66%" valign="top"><p>Mtra.
                            Genoveva Vergara Mendoza<br />
                            <strong>Directora General del Medio Universitario</strong><br />
                            <a href="mailto: genoveva.vergara@uia.mx">genoveva.vergara@uia.mx</a><br />
                            Tel. 59.50.41.82</p></td>
                      </tr>
                  </table></td>
                </tr>
              </table>
              <table width="98%" class="contenidoTablas" id="m8">
                <tr>
                  <td valign="top"><table width="95%" border="0" cellpadding="2" cellspacing="0">
                      <tr>
                        <td width="100%" height="100%" valign="top"><p class="contenido_diplo"><strong>&iquest;C&oacute;mo
                            llegar a la ibero en transporte p&uacute;blico?</strong><br />
                          </p>
                          <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
                            <tr>
                              <td width="6%" align="right" valign="top"><img src="imagenes/imagenes_mapa/bullet griss.gif" width="9" height="12" /></td>
                              <td width="92%" valign="top"><p>Jos&eacute; Mar&iacute;a
                                  Vigil esq. Jalisco, sale un <strong>RTP</strong> con
                                  un costo de $2.00 en direcci&oacute;n a Cuajimalpa,
                                  Santa Rosa, Coral, Centro Comercial Santa Fe, cualquiera
                                  de estos pasan por los accesos 8 - 9 - 10 de la Universidad
                                  Iberoamericana.</p></td>
                            </tr>
                            <tr>
                              <td align="right" valign="top"><img src="imagenes/imagenes_mapa/bullet griss.gif" width="9" height="12" /></td>
                              <td valign="top"><p>Desde
                                  este mismo punto salen <strong>taxis colectivos</strong> con
                                  un costo de $20.00 por persona.</p></td>
                            </tr>
                            <tr>
                              <td align="right" valign="top"><img src="imagenes/imagenes_mapa/bullet griss.gif" width="9" height="12" /></td>
                              <td valign="top"><p>Observatorio
                                  (l&iacute;nea 1) en la salida del &uacute;ltimo
                                  paradero frente a la Terminal de Autobuses Poniente,
                                  sale un <strong>microb&uacute;s</strong> con un
                                  costo de $5.00 en direcci&oacute;n a Santa Fe,
                                  el acceso m&aacute;s cercano a la parada es la
                                  puerta 3.</p></td>
                            </tr>
                            <tr>
                              <td align="right" valign="top"><img src="imagenes/imagenes_mapa/bullet griss.gif" width="9" height="12" /></td>
                              <td valign="top"><p>Del
                                metro Villa de Cortes (l&iacute;nea 2) en la salida
                                Plaza Victoria y Calzada de Tlalpan, sale un <strong>microb&uacute;s</strong> en
                                direcci&oacute;n al Centro Comercial Santa Fe.</p></td>
                            </tr>
                            <tr>
                              <td align="right" valign="top"><img src="imagenes/imagenes_mapa/bullet griss.gif" width="9" height="12" /></td>
                              <td valign="top"><p>Desde
                                  La Villa/Cantera, sale un <strong>RTP </strong>con
                                  un costo de $2.00 en direcci&oacute;n al Centro
                                  Comercial&nbsp; Santa Fe, tiene dos rutas, una
                                  por todo Reforma, y otra que va por Reforma y luego
                                  toma Palmas. El acceso al bajar de &eacute;ste
                                  es la puerta&nbsp; 1.</p></td>
                            </tr>
                            <tr>
                              <td align="right" valign="top"><img src="imagenes/imagenes_mapa/bullet griss.gif" width="9" height="12" /></td>
                              <td valign="top"><p>Desde
                                  Tlacuitlapa/PuertaGrande, sale un <strong>RTP</strong> con
                                  un costo de $2.00 en direcci&oacute;n al Centro
                                  Comercial Santa Fe, los accesos m&aacute;s cercanos
                                  son las puertas 8 - 9 - 10.</p></td>
                            </tr>
                            <tr>
                              <td align="right" valign="top"><img src="imagenes/imagenes_mapa/bullet griss.gif" width="9" height="12" /></td>
                              <td valign="top"><p>De
                                  Av. Insurgentes esquina con Filadelfia, pasa un <strong>microb&uacute;s</strong> con
                                  un costo de $5.00 en direcci&oacute;n al Centro
                                  Comercial Santa Fe. Pasando por los accesos 8 - 9 - 10.</p></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                </tr>
              </table>
              <link href="../../estilos.css" rel="stylesheet" type="text/css" />
              <script type="text/javascript" src="../compacta215/js/mootools.js"></script> 
              <script type="text/javascript" src="../compacta215/js/slimbox.js"></script>
              <link rel="stylesheet" href="../compacta215/css/slimbox.css" type="text/css" media="screen" />
              <link href="../estilos.css" rel="stylesheet" type="text/css" />
              <link href="file:///Macintosh HD/Users/JB/Sites/estilos.css" rel="stylesheet" type="text/css" /></td>
          </tr>
        </table>
        <!-- InstanceEndEditable --> </div>
      <div class="corner topLeft"></div>
      <div class="corner topRight"></div>
      <div class="corner bottomRight"></div>
      <div class="corner bottomLeft"></div>
    </div>
  </div>
  <div id="footer">
    <table width="1019" border="0" cellpadding="0" cellspacing="0" >
      <tr>
        <td width="810"><a onclick="_gaq.push(['_trackEvent', 'Banner footer', 'Click', 'Banner footer']); parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=14'" href="#"><img src="imagenes/banners/idiomas_otono.jpg" alt="Dos" width="804" height="142" border="0" /></a></td>
        <td width="209" align="center" valign="middle"><a onclick="_gaq.push(['_trackEvent', 'Banner mapa', 'Click', 'Banner mapa']); parent.location='http://www.diplomados.uia.mx/mapa.php'" href="#"><img width="173" height="152" border="0" align="middle" src="imagenes/banners/mapa_horizontal.png"></a></td>
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
</body>
<!-- InstanceEnd --></html>
