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

<link href="css/estilos_dan.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="Scripts/jquery-ui.css" type="text/css" media="all" />
<!------ Google Analytics ------>

<script type="text/javascript" src="Scripts/jquery.js"></script>
<script type="text/javascript" src="Scripts/menu2.js"></script>
<script type="text/javascript" src="jquery.carouFredSel-6.1.0.js"></script>
<script type="text/javascript" src="jquery.carouFredSel-6.1.0-packed.js"></script>
<script src="Scripts/jquery-ui.js"></script>

<script type="text/javascript">

  

  $(document).ready(function(){
    $(".foo5").carouFredSel({
      scroll      : {
            fx          : "crossfade"
        },
        items   : {
        visible   : 1,
        width   : 788,
        height    : "46%"

      },
      auto :      {
        duration    : 1200,
            timeoutDuration: 4000,

      },
      prev    : {
        button    : "#foo5_prev",
        key     : "left",
        items   : 1,
      
        duration  : 1200
      },
      next    : {
        button    : "#foo5_next",
        key     : "right",
        items   : 1,
      
        duration  : 1200
      },
      pagination : {
        container : "#foo5_pag",
        keys    : true,
        
        duration  : 1200
      } 
    })
  });
  


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
    
    resizeHelperIframe();
    
  }
    
</script>
<!-- InstanceBeginEditable name="head" -->
<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
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

          
a.prev:hover {    background-position: 0 0px; }
a.prev.disabled { background-position: 0 -100px !important;  }
a.next:hover {    background-position: 0px 0px; }
a.next.disabled { background-position: -50px -100px !important;  }
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
    <div id="slide_menu" style="display:none; width:190px; background: url(imagenes/sombrita_submenu.png) repeat-y; background-color:#D6D7D9; position:relative; left:189px; top:18px; z-index:1000; margin-bottom:-1000px">

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
        <div id="menu_areas">
          <p class="header_disciplinas"></p>
          <ul>
            <li><a class="discipline_1" onclick="showMenu(1)">Arquitectura</a></li>
            <li><a class="discipline_2" onclick="showMenu(2)">Arte</a></li>
            <li><a class="discipline_3" onclick="showMenu(3)">Dise�o</a></li>
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
          <h4>Centros de Atenci�n Especializada</h4>
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
          <p style="padding:0px 5px 5px 5px;"><a href="promociones.php"style="color:#EF353C; font-weight:bold;">Consulta cat&aacute;logo oferta primavera 2013</a></p>
        </div>
      </div>
    </div>
  </div>
<div id="espacio" style="width:5%;float:left"> 

</div>
  <div id= "contenedor_irregular_index" >
    <div id= "type4" class="cuadro_articulos_secciones" style="border:0px;padding:0px;width:828px">
      <div style="position:relative; float:left; z-index:12;"> <!-- InstanceBeginEditable name="header" -->
    <div style="margin-left:29px">
        <div class="textos" style="margin-left:0px;top:0px;height:277px;width:1500px;margin-bottom:9px;float:left">
        <div class="html_carousel" style="float:left;margin-left:0px;">
          </div>
          
          <div id="foo5" class="foo5">
                <div class="slide" id="parrafo1">
              <img src="http://www.dec-uia.com/otono_2011/imagenes/carrusel1/carrusel1.png" alt="carousel 2" width="788" height="265" />
            </div>
                 <div class="slide">
              <img src="http://www.dec-uia.com/otono_2011/imagenes/carrusel1/carrusel2.png" alt="carousel 2" width="788" height="265" />
            </div>
            <div class="slide">
              <img src="http://www.dec-uia.com/otono_2011/imagenes/carrusel1/carrusel3.png" alt="carousel 3" width="788" height="265" />
            </div>
            <div class="slide">
              <img src="http://www.dec-uia.com/otono_2011/imagenes/carrusel1/carrusel4.png" alt="carousel 4" width="788" height="265" />
            </div>
          </div>
          <div class="clearfix"></div>
              </div>
      </div>

      <!-- InstanceEndEditable --> </div>
     
    </div>

<div style="margin-left:29px">
<div style="width:69%;float:left;margin-left:0px">
  <div id="slide_search" style="border: 1px solid #E0E0E0; display:none; position:relative; margin-top:-202px; top:605px; left:-39px; width:192px; height:200px; background-color:#FFF; z-index:1000;">
  <form name="buscador" action="resultados.php" method="post">
    <label for="buscar"></label>
      <img src="imagenes/piquito_rojo_buscador.png">
      <input name="buscar" placeholder="�Qu� tema buscas?" type="text" id="buscar" style="margin:0 0 0 14px; width:150px; height:11px; padding:1px; border:1px solid #999999; font-size:11px;"  />
      <input name="search" type="submit" id="search" value="n" style="color:#D1D1D1; font-size:1px; width:49px; height:16px; background:url(imagenes/boton_buscar.jpg) top center no-repeat; border:none; margin: 10px 0px 0px 129px;" />
      <br />
    <table width="180" border="0" cellspacing="0" cellpadding="0" style="margin:10px 0 0 12px;">
        <thead>
          <tr colspan="3" style="text-align:left; height:20px;font-size:11px;">
            <th width="20px" colspan="3">B�squeda Avanzada (opcional)</th>
          </tr>
        </thead>
        <tr>
            <td colspan="3">
               <select name="sArea" id="sArea" style="margin:0px; width:167px; height:15px; border:1px solid #999999; line-height:0; font-size:11px;">
            <option disabled="disabled" value="0" selected="selected" >�Qu&eacute; &aacute;rea te interesa?</option>
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
            <option value="dise�o">Dise�o</option>
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
              �Cu&aacute;ndo quieres comenzar?
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
        <table width="95%" border="0" align="center" cellpadding="8" cellspacing="0">
          <tr>
            <td height="40" valign="bottom"><h1>Aviso de privacidad</h1>
              <p>&nbsp;</p>
              <p>La Direcci&oacute;n de Educaci&oacute;n Continua de la Universidad Iberoamericana Ciudad de M&eacute;xico con domicilio en Prolongaci&oacute;n Paseo de la Reforma 880, edificio G, P.B., Colonia Lomas de Santa Fe, Delegaci&oacute;n &Aacute;lvaro Obreg&oacute;n, C.P. 01219, M&eacute;xico, Distrito Federal. Tel. (55) 5950 4000 y 9177 4400 Lada nacional sin costo: 01 800 627 7615. En cumplimiento con lo establecido por la <strong>Ley Federal de Protecci&oacute;n de Datos Personales en Posesi&oacute;n de los Particulares</strong> aplicable al sitio: <a href="http://www.diplomados.uia.mx">http://www.diplomados.uia.mx</a>, le informa que los datos personales, entendiendo por estos, de manera enunciativa mas no limitativa: nombre, fecha de nacimiento, nacionalidad, direcci&oacute;n, correo electr&oacute;nico, n&uacute;mero de tel&eacute;fono, (&ldquo;datos personales&rdquo;) y dem&aacute;s informaci&oacute;n que pueda ser usada para identificarlo, otorgados por usted (&ldquo;Usuario&rdquo;) y recopilados directamente en nuestra base de datos ser&aacute;n usados para dar seguimiento al curso o diplomado que haya solicitado. Dicha informaci&oacute;n podr&aacute; ser utilizada para realizar an&aacute;lisis estad&iacute;sticos, investigaciones mercadol&oacute;gicas, publicitarias y otras actividades relacionadas. </p>
              <p>En caso de elegir suscripci&oacute;n a nuestro Newsletter recibir&aacute; informaci&oacute;n peri&oacute;dica sobre los programas y cursos que consideramos puedan interesarle.</p>
              <p>Los datos recabados ser&aacute;n utilizados &uacute;nicamente por empleados, directivos y proveedores de la DEC y no ser&aacute;n compartidas a terceros bajo ninguna otra circunstancia prevista en este aviso.</p>
              <p>Usted puede dejar de recibir mensajes promocionales en el momento que lo desee contact&aacute;ndonos a trav&eacute;s de los medios que aparecen en el sitio <a href="http://www.diplomados.uia.mx">http://www.diplomados.uia.mx</a>. Para conocer dichos procedimientos, los &nbsp;requisitos y plazos, se puede poner en contacto a trav&eacute;s de los tel&eacute;fonos y correos electr&oacute;nicos disponibles en la p&aacute;gina.</p>
              <p>Los datos personales han sido otorgados voluntariamente y la actualizaci&oacute;n y autenticidad de los mismos es responsabilidad del Usuario, por lo que el Usuario podr&aacute; tener acceso a sus datos para modificarlos o actualizarlos previa solicitud expresa a trav&eacute;s de nuestros medios de contacto.</p>
              <p>Los datos personales del Usuario podr&aacute;n ser proporcionados a la autoridad cuando &eacute;sta lo requiera y acredite estar debidamente facultada para ello.</p>
              <p>La Direcci&oacute;n de Educaci&oacute;n Continua de la Universidad Iberoamericana Ciudad de M&eacute;xico se reserva el derecho de realizar en cualquier momento modificaciones o actualizaciones al presente aviso de privacidad. Todo cambio en el aviso de privacidad lo podr&aacute; consultar en la p&aacute;gina: <a href="http://www.diplomados.uia.mx">http://www.diplomados.uia.mx</a></p></td>
          </tr>
        </table>
      <!-- InstanceEndEditable -->
        <table width="93%" border="0" align="center" cellpadding="5" cellspacing="10">
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
      
    </div>
    <div style="width:25%; float:left; margin-left:22px;margin-top:-3">
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
 <div id="footer" style="float:left;width:810px">
    <table border="0" cellpadding="0" cellspacing="0" >
      <tr>
        <td width="810"><a onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=20'" href="#"><img src="imagenes/banners/idiomas_otono.jpg" alt="Dos" width="804" height="142" border="0" /></a></td>
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

