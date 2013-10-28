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
<title>C&aacute;talogo</title>
<!-- InstanceEndEditable -->
<link href="css/estilos_dan.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="Scripts/jquery-ui.css" type="text/css" media="all" />
<script type="text/javascript" src="Scripts/jquery.js"></script>
<script type="text/javascript" src="Scripts/menu2.js"></script>
<script src="Scripts/jquery-ui.js"></script>
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
<style type="text/css" media="screen">
html, body {
	height:100%;
	background-color: #ffffff;
}
body {
	margin:0;
	padding:0;

}
#flashContent {
	width:100%;
	height:100%;
}
</style>
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
    <li style="padding-bottom:10px;"><a href="emarios/politcas_cobranza.pdf" target="_blank">Pol&iacute;ticas cobranza</a></li>
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
  <div id= "contenedor_irregular" style="float:left; margin-left:36px; width:795px;border:0px;margin-top:21px" >
    <div>
      <div style="position:relative; float:left; z-index:12;"> <!-- InstanceBeginEditable name="header" -->
        <table width="780" cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td align="center">
            <div>
                <object style="width:780px;height:500px" >
                  <param name="movie" value="http://static.issuu.com/webembed/viewers/style1/v2/IssuuReader.swf?mode=mini&amp;embedBackground=%23000000&amp;backgroundColor=%23222222&amp;documentId=130603185935-e1300bc8dc275df97a69f4fba05c78ae" />
                  <param name="allowfullscreen" value="true"/>
                  <param name="menu" value="false"/>
                  <param name="wmode" value="transparent"/>
                  <embed src="http://static.issuu.com/webembed/viewers/style1/v2/IssuuReader.swf" type="application/x-shockwave-flash" allowfullscreen="true" menu="false" wmode="transparent" style="width:780px;height:500px" flashvars="mode=mini&amp;backgroundColor=%23222222&amp;documentId=130603185935-e1300bc8dc275df97a69f4fba05c78ae" />
                </object>  
                <div style="width:780px;text-align:left;">
                  <h2 style="text-align:center;"><a href="http://issuu.com/diplomados-ibero/docs/catalogo_por_pagina/1?e=3466234/2950957" target="_blank">Abrir publicación</a></h2>
                </div>
              </div>
              </td>
          </tr>
          <tr>
            <td align="center"><a href="temarios/otono_2013.pdf" target="_blank"><img src="imagenes/descargar_catalogo.png" alt="Descargar c&aacute;talogo" width="204" height="48" border="0" /></a></td>
           </tr>
        </table>
        <!-- InstanceEndEditable --> </div>
      <div class="corner topLeft"></div>
      <div class="corner topRight"></div>
      <div class="corner bottomRight"></div>
      <div class="corner bottomLeft"></div>
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