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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_all_community_opinions_details = 4;
$pageNum_all_community_opinions_details = 0;
if (isset($_GET['pageNum_all_community_opinions_details'])) {
  $pageNum_all_community_opinions_details = $_GET['pageNum_all_community_opinions_details'];
}
$startRow_all_community_opinions_details = $pageNum_all_community_opinions_details * $maxRows_all_community_opinions_details;

mysql_select_db($database_otono2011, $otono2011);
//$query_all_community_opinions_details = "SELECT * FROM community_opinions ORDER BY `date` DESC";

$query_all_community_opinions_details = "

SELECT 'community_opinions' as source, id_opinion, date, short_name, full_name, age, degree, job_position, diploma_course, opinion, picture, thumbnail FROM community_opinions /* ORDER BY `date` DESC */

UNION

SELECT 'weekly_articles' as source, id_article as id_opinion, date, NULL as short_name, interviewee_name as full_name, NULL as age, title as degree, NULL as job_position, diploma_course, content as opinion, picture, thumbnail FROM weekly_articles WHERE type = 2

ORDER BY `date` DESC

";

$query_limit_all_community_opinions_details = sprintf("%s LIMIT %d, %d", $query_all_community_opinions_details, $startRow_all_community_opinions_details, $maxRows_all_community_opinions_details);
$all_community_opinions_details = mysql_query($query_limit_all_community_opinions_details, $otono2011) or die(mysql_error());
$row_all_community_opinions_details = mysql_fetch_assoc($all_community_opinions_details);

if (isset($_GET['totalRows_all_community_opinions_details'])) {
  $totalRows_all_community_opinions_details = $_GET['totalRows_all_community_opinions_details'];
} else {
  $all_all_community_opinions_details = mysql_query($query_all_community_opinions_details);
  $totalRows_all_community_opinions_details = mysql_num_rows($all_all_community_opinions_details);
}
$totalPages_all_community_opinions_details = ceil($totalRows_all_community_opinions_details/$maxRows_all_community_opinions_details)-1;

$queryString_all_community_opinions_details = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_all_community_opinions_details") == false && 
        stristr($param, "totalRows_all_community_opinions_details") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_all_community_opinions_details = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_all_community_opinions_details = sprintf("&totalRows_all_community_opinions_details=%d%s", $totalRows_all_community_opinions_details, $queryString_all_community_opinions_details);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/mapa.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Direcci&oacute;n de Educaci&oacute;n Continua | UIA</title>
<link rel="stylesheet" href="Scripts/jquery-ui.css" type="text/css" media="all" />
<script type="text/javascript" src="Scripts/jquery.js"></script>
<script type="text/javascript" src="Scripts/menu2.js"></script>
<script src="Scripts/jquery-ui.js"></script>
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
<!-- InstanceEndEditable -->
<link href="css/estilos_dan.css" rel="stylesheet" type="text/css" />
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
      <li style="padding-bottom:10px;"><a href="http://www.diplomados.uia.mx/temarios/politcas_cobranza.pdf" target="_blank">Pol&iacute;ticas cobranza</a></li>
      <li style="padding-bottom:10px;"><a href="http://www.diplomados.uia.mx/tutorial_pagos.php">Tutorial pagos en l&iacute;nea</a></li></ul>
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
      <div id="caja" style="width:788px; border:1px;height:265px;background-image: url(imagenes/m_comunidad_ibero.jpg);margin-left:26px;position:relative; float:left; z-index:12;"> <!-- InstanceBeginEditable name="header" -->
                  
    </div>
    <div style="margin-left:24px">
    <div style="width:69%;float:left;margin-left:0px">
           <div id="slide_search" style="border: 1px solid #E0E0E0; display:none; position:relative; margin-top:-202px; top:625px; left:-39px; width:192px; height:200px; background-color:#FFF; z-index:1000;">
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
                     <select name="sArea" id="sArea" style="margin:0px; width:138px; height:15px; border:1px solid #999999; line-height:0; font-size:11px;">
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
                  <td width="63px">
                    <input type="text" id="datepickerI" name="datepickerI" style="margin:0px; width:55px; height:11px; padding:1px; border:1px solid #999999; line-height:0; font-size:11px;"/> 
                    <img src="imagenes/calendario.jpg">
                  </td>
                    <td  width="63px">
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
  
    <div id= "type4" class="rectangulo_abajo_secciones" style="border:0px;float:left;width:572px;margin-left:0px;left:0px;top:0px">
     
	<table width="100%" align="center" cellpadding="0">
		
		
		<tr>
			<td>&nbsp;</td>
		</tr>
	</table>
	<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php do { ?>
    <tr>
      <td width="120" valign="top">

        <a onmouseover="MM_swapImage('img_readmore','','images/links/read_more_onhover.gif',1)" onmouseout="MM_swapImgRestore()" style="cursor: pointer;" onclick="parent.location='http://www.diplomados.uia.mx/community_opinions_detail.php?id_opinion=<?php echo $row_all_community_opinions_details['id_opinion'] ?>&amp;source=<?php echo $row_all_community_opinions_details['source'] ?>'">
      
	  <?php if($row_all_community_opinions_details['source'] == 'community_opinions') { ?>
      
          <img src="imagenes/uploads/community_opinions/<?php echo $row_all_community_opinions_details['picture']; ?>" width="120" height="114" />

	  <?php } else { ?>
    
          <img src="imagenes/uploads/weekly_articles/thumbnails/<?php echo $row_all_community_opinions_details['picture']; ?>" width="120" height="114" />
    
      <?php } ?>
      
      </a>
      
      </td>
      <td style="padding-left:20px;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>
            	<p><strong>
					<?php if($row_all_community_opinions_details['full_name'] != NULL){ echo $row_all_community_opinions_details['full_name'] . ', '; } ?>
					<?php if($row_all_community_opinions_details['age'] != NULL){ echo $row_all_community_opinions_details['age'] . ' a&ntilde;os'; } ?>
                </strong></p>
            </td>
          </tr>
          <tr>
            <td>
            	<p><strong>
					<?php if($row_all_community_opinions_details['degree'] != NULL){ echo $row_all_community_opinions_details['degree'] . ', '; } ?>
                    <?php echo $row_all_community_opinions_details['job_position']; ?>
                </strong></p>
            </td>
          </tr>
          <tr>
            <td class="contenido_diploRojo"><strong><a style="cursor: pointer;" onclick="parent.location='http://www.diplomados.uia.mx/community_opinions_detail.php?id_opinion=<?php echo $row_all_community_opinions_details['id_opinion'] ?>'"><?php echo $row_all_community_opinions_details['diploma_course']; ?></strong></a></td>
          </tr>
          <tr>
            <td height="10"></td>
          </tr>
          <tr>
            <td><p><?php echo substr($row_all_community_opinions_details['opinion'], 0, 300); ?>...<a style="cursor: pointer;" onclick="parent.location='http://www.diplomados.uia.mx/community_opinions_detail.php?id_opinion=<?php echo $row_all_community_opinions_details['id_opinion'] ?>'"><br />
<span class="avisos_mas" style="cursor:pointer"> &gt; leer m&aacute;s</span></a></p></td>
          </tr>
          
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table></td>
    </tr>
    <tr>
    	<td colspan="2" style="border-top: 1px solid #CCC;">&nbsp;</td>
    </tr>
  <?php } while ($row_all_community_opinions_details = mysql_fetch_assoc($all_community_opinions_details)); ?>
  <tr>
    <td colspan="2" align="center">
      <table border="0">
        <tr>
          <td><?php if ($pageNum_all_community_opinions_details > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_all_community_opinions_details=%d%s", $currentPage, 0, $queryString_all_community_opinions_details); ?>"><img src="imagenes/buttons/First.gif" border="0" /></a>
              <?php } // Show if not first page ?></td>
          <td><?php if ($pageNum_all_community_opinions_details > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_all_community_opinions_details=%d%s", $currentPage, max(0, $pageNum_all_community_opinions_details - 1), $queryString_all_community_opinions_details); ?>"><img src="imagenes/buttons/Previous.gif" border="0" /></a>
              <?php } // Show if not first page ?></td>
          <td><?php if ($pageNum_all_community_opinions_details < $totalPages_all_community_opinions_details) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_all_community_opinions_details=%d%s", $currentPage, min($totalPages_all_community_opinions_details, $pageNum_all_community_opinions_details + 1), $queryString_all_community_opinions_details); ?>"><img src="imagenes/buttons/Next.gif" border="0" /></a>
              <?php } // Show if not last page ?></td>
          <td><?php if ($pageNum_all_community_opinions_details < $totalPages_all_community_opinions_details) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_all_community_opinions_details=%d%s", $currentPage, $totalPages_all_community_opinions_details, $queryString_all_community_opinions_details); ?>"><img src="imagenes/buttons/Last.gif" border="0" /></a>
              <?php } // Show if not last page ?></td>
        </tr>
    </table>
    </td>
  </tr>
</table>
<!-- InstanceEndEditable --> </div>
     <div style="width:25%; float:left; margin-left:18px; margin-top:18px">
      <table width="181px" border="0" cellspacing="0" cellpadding="0" align="center">
        <tbody>                                   
          <!--<tr>
      		  <td align="center"><a onclick="parent.location=''" href="#"><img src="imagenes/banner_chiquito_cierre_trivia.png" height="300" width="180"></a></td>
          </tr>-->
		  <tr>          
	        <td align="center"><a href="http://dec-uia.com/landing_catalogo/" target="_blank"><img src="imagenes/ladec/banners/banners_laterales/banner_lateral_catalogo.jpg" width="181px" border="0" /></a></td>
	        </tr>
			<tr>		
          	<td  align="right" valign="top" >&nbsp;</td>
          	</tr>
          <tr>          
          <td align="center"><a onclick="parent.location='http://www.diplomados.uia.mx/promociones.php'" href="#"><img src="imagenes/ladec/banners/banners_laterales/descuentos.jpg" width="181px" border="0" /></a></td>
            </tr>
          <tr>
            <td  align="right" valign="top" >&nbsp;</td>
            </tr>
          <tr>
            <td align="center"><a onclick="parent.location='http://www.diplomados.uia.mx/propuestas_cursos.php'" href="#"><img src="imagenes/ladec/banners/banners_laterales/solicitalo.jpg" width="181px" height="115" border="0" /></a></td>
          </tr>

          <tr>    
            <td  align="right" valign="top" >&nbsp;</td>
          </tr>                       
          
           <tr>
            <td valign="bottom" width="191px" height="120" align="left" style="background: url(imagenes/ladec/banners/banners_laterales/newsletter.jpg) no-repeat bottom transparent; width:191px;">
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
                    <td align="center"><input onClick="_gaq.push(['_trackEvent', 'Newsletter', 'Click', 'Registro al newsletter']);" type="submit" value="" class="processing"></td>
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
