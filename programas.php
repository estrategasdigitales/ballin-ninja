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

$id_program = mysql_real_escape_string($_GET['id_program']);
$id_discipline = mysql_real_escape_string($_GET['id_discipline']);
//TALLERES
/*
mysql_select_db($database_otono2011, $otono2011);
$query_progs_talleres = "SELECT * FROM site_programs WHERE program_type = 'taller' AND cancelado = 0 AND id_discipline = ".$_GET['id_discipline']." AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE periodo = 'p') ORDER BY idioma ASC, program_name ASC";
$progs_talleres = mysql_query($query_progs_talleres, $otono2011) or die(mysql_error());
$row_progs_talleres = mysql_fetch_assoc($progs_talleres);
$totalRows_progs_talleres = mysql_num_rows($progs_talleres);
*/
mysql_select_db($database_otono2011, $otono2011);
$query_programa = "SELECT * FROM site_programs WHERE cancelado = 0 AND id_program = ".$id_program;
$programa = mysql_query($query_programa, $otono2011) or die(mysql_error());
$row_programa = mysql_fetch_assoc($programa);
$totalRows_programa = mysql_num_rows($programa);

$query_fecha_ini = "SELECT * FROM site_fechas_ini WHERE cancelado = 0 AND id_program = ".$id_program;
$fecha_ini = mysql_query($query_fecha_ini, $otono2011) or die(mysql_error());
//$row_fecha_ini = mysql_fetch_assoc($fecha_ini);
$totalRows_fecha_ini = mysql_num_rows($fecha_ini);

$query_temp = "SELECT discipline FROM disciplines WHERE id_discipline = ".$id_discipline;
$temp = mysql_query($query_temp, $otono2011) or die(mysql_error());
$row_temp = mysql_fetch_assoc($temp);
$totalRows_temp = mysql_num_rows($temp);

//CODIGO PARA QUE ASIGNE FORMATO LOCAL A LAS FECHAS
setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
//++++++++++++++++++++
?>
<!DOCTYPE html>
<html><!-- InstanceBegin template="/Templates/index.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title><?php echo $row_temp['discipline'].' - '.$row_programa['program_name'];?></title>
<!-- InstanceEndEditable -->
<link href="css/estilos_dan.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="Scripts/jquery-ui.css" type="text/css" media="all" />
<link href="pruebas/css/jquery.tweet.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="Scripts/jquery.js"></script>
<script type="text/javascript" src="Scripts/menu3.js"></script>
<script src="Scripts/jquery-ui.js"></script>
<script language="javascript" src="pruebas/js/jquery.tweet.js" type="text/javascript"></script>
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

<script type='text/javascript'>
    $(document).ready(function(){
        $(".tweet").tweet({
            username: "DiplomadosIbero",
            avatar_size: 20,
            count: 4,
            loading_text: "cargando tweets..."
        });

        //resaltar disciplina en el menu dependiendo del programa o articulo
        var results = new RegExp('[\\?&amp;]id_discipline=([^&amp;#]*)').exec(window.location.href);
        $('.discipline_'+results[1]).css('background-color', '#D6D7D9')
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
	<li style="padding-bottom:10px;"><a href="http://www.dec-uia.com/temarios/politcas_cobranza.pdf" target="_blank">Pol&iacute;ticas cobranza</a></li>
	<li style="padding-bottom:10px;"><a href="tutorial_pagos.php">Tutorial pagos en l&iacute;nea</a></li></ul>
  </div>
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
            <li><a class="discipline_1" onclick="showMenu(1)">Arquitectura</a></li>
            <li><a class="discipline_2" onclick="showMenu(2)">Arte</a></li>
            <li><a class="discipline_3" onclick="showMenu(3)">Diseño</a></li>
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
          <h4>Centros de Atenci&oacute;n Especializada</h4>
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
          <p style="padding:0px 5px 5px 5px;"><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/catalogo.php'" style="color:#EF353C; font-weight:bold;">Consulta cat&aacute;logo oferta primavera 2013</a></p>
        </div>
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
									<option value="diseño">Dise&ntilde;o</option>
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
  <div id= "contenedor_irregular" style="float:left; margin-left:40px; width:795px">
    <div id= "type4" class="ancho_irregular" style="width:581px;margin-top:0px;margin-left: -19px;">
      <div class="textos">
        <table width="100%" border="0" align="left" cellpadding="5" cellspacing="10">
          <tr>
            <td><!-- InstanceBeginEditable name="contenido" -->

      	<table width="100%" border="0" align="left" cellpadding="0" cellspacing="5">
      		<tr>
      			<td align="left" valign="top" colspan="2" height="74">
      			  <?php echo '<h1 style="font-size:24px">'.ucfirst($row_programa['program_type'])	.'</h1>'; ?>
      			  <?php echo '<h1>'.$row_programa['program_name'].'</h1>';
				if($row_programa['program_colaboracion'] != NULL){
					echo '<p>(En colaboraci&oacute;n con '.$row_programa['program_colaboracion'].')</p>';
				}
				?>      			  <!-- - <a style="cursor:pointer; font-size:12px;" onclick="setActiveStyleSheet('img_templ_princ'); return false;">A</a> <a style="cursor:pointer; font-size:14px;" onclick="setActiveStyleSheet('img_templ_princ2'); return false;">A</a> <a style="cursor:pointer; font-size:16px;" onclick="setActiveStyleSheet('img_templ_princ3'); return false;">A</a> + --></td>


          <td align="right">
          	<table border="0">
          		<?php if($_GET['id_program'] != 397){ ?>
                               	<tr>

                        <td colspan="2" align="right" valign="top" class="contenido_diploRojo" <?php if($_GET['id_discipline'] == 15 && $_GET['id_program'] == 401){ ?> style="display:none;" <?php } ?>>
                        <?php if($_GET['id_discipline'] == 15 && $_GET['id_program'] == 401){ ?> <a href="#" onclick="parent.location='extras.php'"><img src=
            "imagenes/icono_insc.gif" width="30" height="30" border=
            "0" /></a> <?php }else{ ?>

                        <a href="#" onclick="parent.location='http://www.diplomados.uia.mx/preinscripcion.php'"><img src=
            "imagenes/icono_insc.gif" width="30" height="30" border=
            "0" /></a>
            <?php } ?>

            </td>

                        <td width="20px" <?php if($_GET['id_discipline'] == 15 && $_GET['id_program'] == 401){ ?> style="display:none;" <?php } ?>><?php if($_GET['id_discipline']==21){ ?>
                          <a href="http://www.diplomados.uia.mx/preinscripcion.php">Formato de Preinscripci&oacute;n</a>
                          <?php }else if($_GET['id_discipline'] == 15 && $_GET['id_program'] == 401){ ?>
                           <a href="#" onclick="parent.location='http://www.diplomados.uia.mx/preinscripcion.php'">Formato de Preinscripci&oacute;n</a>
                          <?php }else{ ?>
                          <a href="#" onclick="parent.location='http://www.diplomados.uia.mx/preinscripcion.php'">Formato de Preinscripci&oacute;n</a>
                          <?php } ?></td>

                      </tr>
                      <?php } ?>
                  </table>

         </td>
      			</tr>
                                 <?php if($_GET['id_discipline'] == 15 && $_GET['id_program'] == 401){ ?>
                <tr><td><table border="0">
                <tr><td colspan="2"><p><span style="color: red; font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 16px">(Exclusivo para  servidores públicos del Poder Judicial de la Federación)</span></p></td></tr>


                <tr>


                				<td width="10%" align="left" valign="top" class="contenido_diploRojo">
                        <?php if($_GET['id_discipline'] == 15 && $_GET['id_program'] == 401){ ?>  <?php }else{ ?>

                        <a href="#" onclick="parent.location='http://www.diplomados.uia.mx/preinscripcion.php'"><img src=
            "imagenes/icono_insc.gif" width="30" height="30" border=
            "0" /></a>
            <?php } ?>
            </td>
                        <td width="81%" align="left"><?php if($_GET['id_discipline']==21){ ?>
                          <a href="http://www.diplomados.uia.mx/preinscripcion.php">Formato de Preinscripci&oacute;n</a>
                          <?php }else if($_GET['id_discipline'] == 15 && $_GET['id_program'] == 401){ ?>
                          <?php }else{ ?>
                          <a href="#" onclick="parent.location='http://www.diplomados.uia.mx/preinscripcion.php'">Formato de Preinscripci&oacute;n</a>
                          <?php } ?></td>

                </tr></table></td></tr>

                <?php } ?>
                <?php if($row_programa['program_pdf'] != NULL){
	//header("Pragma: ");
	?>
                      <tr>
                      	<table width="100%" border="0">
                      		<!--<tr>
                        <td colspan="2" width="85%" align="right" valign="bottom" class="contenido_diploRojo">
                        <td  width="15%" align="left"><a href="temarios/<?php echo $row_programa['program_pdf']; ?>" target="_blank"> <img src="imagenes/icono_temario.gif" width="30" height="30" border="0" /></a><a href="temarios/<?php echo $row_programa['program_pdf']; ?>" target="_blank">Descargar<br>Temario</a></td></td>
                      		</tr>-->
                      </tr>
                         <?php } ?>
      		<tr>
      			<td colspan="2" valign="top">

				<?php if($row_programa['description'] != NULL){ ?>
      			  <h3>Rese&ntilde;a del Programa:</h3>
				  <?php } ?>

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
                    <?php if($row_programa['observaciones']!=NULL){echo '<p>'.$row_programa['observaciones'].'</p>';} ?>
                    </p>
				  </td>
				                          <td  width="22%" align="left" valign="top"><div style="margin-top: -25px;"><?php if($row_programa['program_pdf']!=""){?><a href="temarios/<?php echo $row_programa['program_pdf']; ?>" target="_blank" style="float:left"> <img src="imagenes/icono_temario.gif" width="30" height="30" border="0" / ></a><a href="temarios/<?php echo $row_programa['program_pdf']; ?>" target="_blank">Descargar<br>Temario</a><?php }?></div></td></td>

      			</tr>
      		</table>
      		<table width="100%" border="0" cellpadding="5" cellspacing="0">

      			      		<?php if($_GET['id_program'] != 397){ ?>
                      <tr>
                        <?php if(($row_programa['program_colaboracion'] != NULL)&&($row_programa['program_colaboracion_img'] != NULL)){ ?>
                        <td width="29%" align="right" valign="top" class="contenido_diploRojo">En colaboraci&oacute;n</td>
                        <td width="2%" rowspan="10" class="linea_separadora_g"></td>
                        <td width="70%"><?php
						if($row_programa['program_colaboracion_img'] != NULL){
							echo '<img src="imagenes/colaboradores/'.$row_programa['program_colaboracion_img'].'" />';
						} ?></td>
                        <?php } ?>
                      <?php if($totalRows_fecha_ini != 0){ ?>
                      </tr>
                      <tr>
                        <td align="right" valign="top" class="contenido_diploRojo">Inicio</td>
                        <?php if($row_programa['program_colaboracion'] == NULL || $row_programa['program_colaboracion_img'] == NULL){ ?>
                        <td width="2%" rowspan="9" class="linea_separadora_g"></td>
                        <?php } ?>
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
							<?php if($_GET['id_discipline'] == 15 && $_GET['id_program'] == 110){

							?><td align="left">
									<a onclick="parent.location='http://www.e-femxa.com/main.self'"><img src='imagenes/icons/image.jpeg' style="margin: 0px 80px -13px 0px;"></a>
							</td>
							<?php } ?>
                      </tr>
                      <?php  }
					if($row_programa['duration'] != NULL) {?>
                      <tr>
                        <td align="right" valign="top" class="contenido_diploRojo">Duraci&oacute;n</td>
                        <td><?php echo $row_programa['duration'];?></td>
                      </tr>
                      <?php }
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
									echo 'Inscripci&oacute;n: '.$row_programa['cost_inscripcion'].'</br>';
									echo 'Por m&oacute;dulo: '.$row_programa['costo_modulo'].'';
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
                      <?php } ?>

                        <?php }}
						}
					} ?>


					 <tr>
                       <td width="22%" align="right" valign="top" class="contenido_diploRojo" <?php if($_GET['id_discipline'] == 15 && $_GET['id_program'] == 401){ ?> style="display:none;" <?php } ?>>Informes</td>
                        <td<?php if($_GET['id_discipline'] == 15 && $_GET['id_program'] == 401){ ?> style="display:none;" <?php } ?>><?php
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



<tr>



                      	    <?php if($_GET['id_discipline'] != 10 && $_GET['id_program'] != 397){ ?>
      				 <td valign="top"></td>
      				 <!-- AddThis Button BEGIN -->
      				 <td valign="top">
		                <a href="#" onclick="parent.location='http://www.diplomados.uia.mx/preinscripcion.php'" style="float:left">
		                	<img src="imagenes/icono_insc.gif" width="30" height="30" border="0" />
		            	</a>
		            	<a href="#" onclick="parent.location='http://www.diplomados.uia.mx/preinscripcion.php'" >
		            			Formato de <br>Preinscripci&oacute;n
		            	</a>
		            	<br>
		            	</b>
            			</font>
            			<?php
            				if($row_programa['program_pdf']!=""){?>
            			<div style="margin-top: -31px;">
	            			<a href="temarios/<?php echo $row_programa['program_pdf']; ?>" target="_blank" style="margin-left:95px; float:left"> 
	              			<img src="imagenes/icono_temario.gif" width="30" height="30" border="0" />
	              			</a>
	              			<a href="temarios/<?php echo $row_programa['program_pdf']; ?>" target="_blank" >Descargar<br>Temario</a>
	              		</div>
	              		<?php
	              			}
	              		?>
            		</td>
            	<!-- -->
            	<!--<td colspan="2" width="85%" align="left" valign="bottom" class="contenido_diploRojo">
	              	<a href="#" onclick="parent.location='http://www.diplomados.uia.mx/preinscripcion.php'">
	              		<img src="imagenes/icono_insc.gif" width="30" height="30" border="0" />
	              	</a>
	                <td  width="15%" align="left"><a href="#" target="_blank" onclick="parent.location='http://www.diplomados.uia.mx/preinscripcion.php'" style="margin-left:-198px">Formato de <br>Preinscripci&oacute;n</a>
	                </td>
            	</td>-->
              <!-- AddThis Bu 																		ºtton END -->
            <!--<td colspan="2" width="85%" align="left" valign="bottom" class="contenido_diploRojo">
              	
                <!--<td  width="15%" align="left"><a href="temarios/<?php echo $row_programa['program_pdf']; ?>" target="_blank">Descargar<br>Temario</a>
                </td>--
            </td>-->
          </tr>
              <?php } ?>


                      <tr>
                      	<td>


                      	</td>
      				 <td><!-- AddThis Button BEGIN -->

              <div class="addthis_toolbox addthis_default_style "> <a class="addthis_counter addthis_pill_style"></a> </div>
              <script type="text/javascript">var addthis_config = {"data_track_clickback":true};</script>
              <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=pvazquezdiaz"></script>
              <!-- AddThis Button END --></td>
          </tr>




	</table>
      <!-- InstanceEndEditable --></td>
          </tr>
<tr><td colspan="2">



<!---Consulta de Subcategorias de los Idiomas de Ingles-->
						<?php if($_GET['id_discipline'] == 14 && $_GET['id_program'] == 101){
							?> <tr align="center"> <?php
						mysql_select_db($database_otono2011, $otono2011);
						$query1= "SELECT * FROM site_fechas_idiomas WHERE periodo = 'p' AND inicio >= '2013-01-01' AND id_program = ".$_GET['id_program'];
						$fecha_idioma1 = mysql_query($query1, $otono2011) or die(mysql_error());
						while($row1=mysql_fetch_array($fecha_idioma1))
							{
				              $nivel=$row1["nivel"];
				              $subnivel=$row1["subnivel"];
				              $inicio=$row1["inicio"];
				              $duracion=$row1["duracion"];
				              $horario = $row1["horario"];
								echo "<table border=0 width=60% align=center>";
								echo "<tr><td colspan=2 class=contenido_diploRojo><b>$nivel</b></td></tr>";
								echo "<tr><td colspan=2><b>$subnivel</b></td></tr>";
								echo "<tr><td><b>Inicio</b></td><td>$inicio</td></tr>";
								echo "<tr><td>Duraci&oacute;n</td><td>$duracion</td></tr>";
								echo "<tr><td>Horario</td><td>$horario</td></tr></table><br>";
							}
							?>

                      	</tr>
                      	<?php } ?>

<!---Consulta de Subcategorias de los Idiomas de Arabe-->
						<?php if($_GET['id_discipline'] == 14 && $_GET['id_program'] == 179){
							?> <tr align="center"> <?php
						mysql_select_db($database_otono2011, $otono2011);
						$query1= "SELECT * FROM site_fechas_idiomas WHERE periodo = 'p' AND inicio >= '2013-01-01' AND id_program = ".$_GET['id_program'];
						$fecha_idioma1 = mysql_query($query1, $otono2011) or die(mysql_error());
						while($row1=mysql_fetch_array($fecha_idioma1))
							{
				              $nivel=$row1["nivel"];
				              $subnivel=$row1["subnivel"];
				              $inicio=$row1["inicio"];
				              $duracion=$row1["duracion"];
				              $horario = $row1["horario"];
								echo "<table border=0 width=60% align=center>";
								echo "<tr><td colspan=2 class=contenido_diploRojo><b>$nivel</b></td></tr>";
								echo "<tr><td colspan=2><b>$subnivel</b></td></tr>";
								echo "<tr><td><b>Inicio</b></td><td>$inicio</td></tr>";
								echo "<tr><td>Duraci&oacute;n</td><td>$duracion</td></tr>";
								echo "<tr><td>Horario</td><td>$horario</td></tr></table><br>";
							}
							?>

                      	</tr>
                      	<?php } ?>

<!---Consulta de Subcategorias de los Idiomas de Chino Mandarin-->
						<?php if($_GET['id_discipline'] == 14 && $_GET['id_program'] == 174){
							?> <tr align="center"> <?php
						mysql_select_db($database_otono2011, $otono2011);
						$query1= "SELECT * FROM site_fechas_idiomas WHERE periodo = 'p' AND inicio >= '2013-01-01' AND id_program = ".$_GET['id_program'];
						$fecha_idioma1 = mysql_query($query1, $otono2011) or die(mysql_error());
						while($row1=mysql_fetch_array($fecha_idioma1))
							{
				              $nivel=$row1["nivel"];
				              $subnivel=$row1["subnivel"];
				              $inicio=$row1["inicio"];
				              $duracion=$row1["duracion"];
				              $horario = $row1["horario"];
								echo "<table border=0 width=60% align=center>";
								echo "<tr><td colspan=2 class=contenido_diploRojo><b>$nivel</b></td></tr>";
								echo "<tr><td colspan=2><b>$subnivel</b></td></tr>";
								echo "<tr><td><b>Inicio</b></td><td>$inicio</td></tr>";
								echo "<tr><td>Duraci&oacute;n</td><td>$duracion</td></tr>";
								echo "<tr><td>Horario</td><td>$horario</td></tr></table><br>";
							}
							?>

                      	</tr>
                      	<?php } ?>


<!---Consulta de Subcategorias de los Idiomas de Espanol-->
						<?php if($_GET['id_discipline'] == 14 && $_GET['id_program'] == 201){
							?> <tr align="center"> <?php
						mysql_select_db($database_otono2011, $otono2011);
						$query1= "SELECT * FROM site_fechas_idiomas WHERE periodo = 'p' AND inicio >= '2013-01-01' AND id_program = ".$_GET['id_program'];
						$fecha_idioma1 = mysql_query($query1, $otono2011) or die(mysql_error());
						while($row1=mysql_fetch_array($fecha_idioma1))
							{
				              $nivel=$row1["nivel"];
				              $subnivel=$row1["subnivel"];
				              $inicio=$row1["inicio"];
				              $duracion=$row1["duracion"];
				              $horario = $row1["horario"];
								echo "<table border=0 width=60% align=center>";
								echo "<tr><td colspan=2 class=contenido_diploRojo><b>$nivel</b></td></tr>";
								echo "<tr><td colspan=2><b>$subnivel</b></td></tr>";
								echo "<tr><td><b>Inicio</b></td><td>$inicio</td></tr>";
								echo "<tr><td>Duraci&oacute;n</td><td>$duracion</td></tr>";
								echo "<tr><td>Horario</td><td>$horario</td></tr></table><br>";
							}
							?>

                      	</tr>
                      	<?php } ?>

<!---Consulta de Subcategorias de los Idiomas de Espanol Extranjeros-->
						<?php if($_GET['id_discipline'] == 14 && $_GET['id_program'] == 202){
							?> <tr align="center"> <?php
						mysql_select_db($database_otono2011, $otono2011);
						$query1= "SELECT * FROM site_fechas_idiomas WHERE periodo = 'p' AND inicio >= '2013-01-01' AND id_program = ".$_GET['id_program'];
						$fecha_idioma1 = mysql_query($query1, $otono2011) or die(mysql_error());
						while($row1=mysql_fetch_array($fecha_idioma1))
							{
				              $nivel=$row1["nivel"];
				              $subnivel=$row1["subnivel"];
				              $inicio=$row1["inicio"];
				              $duracion=$row1["duracion"];
				              $horario = $row1["horario"];
								echo "<table border=0 width=60% align=center>";
								echo "<tr><td colspan=2 class=contenido_diploRojo><b>$nivel</b></td></tr>";
								echo "<tr><td colspan=2><b>$subnivel</b></td></tr>";
								echo "<tr><td><b>Inicio</b></td><td>$inicio</td></tr>";
								echo "<tr><td>Duraci&oacute;n</td><td>$duracion</td></tr>";
								echo "<tr><td>Horario</td><td>$horario</td></tr></table><br>";
							}
							?>

                      	</tr>
                      	<?php } ?>

<!---Consulta de Subcategorias de los Idiomas de Frances-->
						<?php if($_GET['id_discipline'] == 14 && $_GET['id_program'] == 177){
							?> <tr align="center"> <?php
						mysql_select_db($database_otono2011, $otono2011);
						$query1= "SELECT * FROM site_fechas_idiomas WHERE periodo = 'p' AND inicio >= '2013-01-01' AND id_program = ".$_GET['id_program'];
						$fecha_idioma1 = mysql_query($query1, $otono2011) or die(mysql_error());
						while($row1=mysql_fetch_array($fecha_idioma1))
							{
				              $nivel=$row1["nivel"];
				              $subnivel=$row1["subnivel"];
				              $inicio=$row1["inicio"];
				              $duracion=$row1["duracion"];
				              $horario = $row1["horario"];
								echo "<table border=0 width=60% align=center>";
								echo "<tr><td colspan=2 class=contenido_diploRojo><b>$nivel</b></td></tr>";
								echo "<tr><td colspan=2><b>$subnivel</b></td></tr>";
								echo "<tr><td><b>Inicio</b></td><td>$inicio</td></tr>";
								echo "<tr><td>Duraci&oacute;n</td><td>$duracion</td></tr>";
								echo "<tr><td>Horario</td><td>$horario</td></tr></table><br>";
							}
							?>

                      	</tr>
                      	<?php } ?>

<!---Consulta de Subcategorias de los Idiomas de Hebreo-->
						<?php if($_GET['id_discipline'] == 14 && $_GET['id_program'] == 180){
							?> <tr align="center"> <?php
						mysql_select_db($database_otono2011, $otono2011);
						$query1= "SELECT * FROM site_fechas_idiomas WHERE periodo = 'p' AND inicio >= '2013-01-01' AND id_program = ".$_GET['id_program'];
						$fecha_idioma1 = mysql_query($query1, $otono2011) or die(mysql_error());
						while($row1=mysql_fetch_array($fecha_idioma1))
							{
				              $nivel=$row1["nivel"];
				              $subnivel=$row1["subnivel"];
				              $inicio=$row1["inicio"];
				              $duracion=$row1["duracion"];
				              $horario = $row1["horario"];
								echo "<table border=0 width=60% align=center>";
								echo "<tr><td colspan=2 class=contenido_diploRojo><b>$nivel</b></td></tr>";
								echo "<tr><td colspan=2><b>$subnivel</b></td></tr>";
								echo "<tr><td><b>Inicio</b></td><td>$inicio</td></tr>";
								echo "<tr><td>Duraci&oacute;n</td><td>$duracion</td></tr>";
								echo "<tr><td>Horario</td><td>$horario</td></tr></table><br>";
							}
							?>

                      	</tr>
                      	<?php } ?>

<!---Consulta de Subcategorias de los Idiomas de Hindu-->
						<?php if($_GET['id_discipline'] == 14 && $_GET['id_program'] == 181){
							?> <tr align="center"> <?php
						mysql_select_db($database_otono2011, $otono2011);
						$query1= "SELECT * FROM site_fechas_idiomas WHERE periodo = 'p' AND inicio >= '2013-01-01' AND id_program = ".$_GET['id_program'];
						$fecha_idioma1 = mysql_query($query1, $otono2011) or die(mysql_error());
						while($row1=mysql_fetch_array($fecha_idioma1))
							{
				              $nivel=$row1["nivel"];
				              $subnivel=$row1["subnivel"];
				              $inicio=$row1["inicio"];
				              $duracion=$row1["duracion"];
				              $horario = $row1["horario"];
								echo "<table border=0 width=60% align=center>";
								echo "<tr><td colspan=2 class=contenido_diploRojo><b>$nivel</b></td></tr>";
								echo "<tr><td colspan=2><b>$subnivel</b></td></tr>";
								echo "<tr><td><b>Inicio</b></td><td>$inicio</td></tr>";
								echo "<tr><td>Duraci&oacute;n</td><td>$duracion</td></tr>";
								echo "<tr><td>Horario</td><td>$horario</td></tr></table><br>";
							}
							?>

                      	</tr>
                      	<?php } ?>

<!---Consulta de Subcategorias de los Idiomas de Intensivos Ingles-->
						<?php if($_GET['id_discipline'] == 14 && $_GET['id_program'] == 173){
							?> <tr align="center"> <?php
						mysql_select_db($database_otono2011, $otono2011);
						$query1= "SELECT * FROM site_fechas_idiomas WHERE periodo = 'p' AND inicio >= '2013-01-01' AND id_program = ".$_GET['id_program'];
						$fecha_idioma1 = mysql_query($query1, $otono2011) or die(mysql_error());
						while($row1=mysql_fetch_array($fecha_idioma1))
							{
				              $nivel=$row1["nivel"];
				              $subnivel=$row1["subnivel"];
				              $inicio=$row1["inicio"];
				              $duracion=$row1["duracion"];
				              $horario = $row1["horario"];
								echo "<table border=0 width=60% align=center>";
								echo "<tr><td colspan=2 class=contenido_diploRojo><b>$nivel</b></td></tr>";
								echo "<tr><td colspan=2><b>$subnivel</b></td></tr>";
								echo "<tr><td><b>Inicio</b></td><td>$inicio</td></tr>";
								echo "<tr><td>Duraci&oacute;n</td><td>$duracion</td></tr>";
								echo "<tr><td>Horario</td><td>$horario</td></tr></table><br>";
							}
							?>

                      	</tr>
                      	<?php } ?>

<!---Consulta de Subcategorias de los Idiomas de Italiano-->
						<?php if($_GET['id_discipline'] == 14 && $_GET['id_program'] == 176){
							?> <tr align="center"> <?php
						mysql_select_db($database_otono2011, $otono2011);
						$query1= "SELECT * FROM site_fechas_idiomas WHERE periodo = 'p' AND inicio >= '2013-01-01' AND id_program = ".$_GET['id_program'];
						$fecha_idioma1 = mysql_query($query1, $otono2011) or die(mysql_error());
						while($row1=mysql_fetch_array($fecha_idioma1))
							{
				              $nivel=$row1["nivel"];
				              $subnivel=$row1["subnivel"];
				              $inicio=$row1["inicio"];
				              $duracion=$row1["duracion"];
				              $horario = $row1["horario"];
								echo "<table border=0 width=60% align=center>";
								echo "<tr><td colspan=2 class=contenido_diploRojo><b>$nivel</b></td></tr>";
								echo "<tr><td colspan=2><b>$subnivel</b></td></tr>";
								echo "<tr><td><b>Inicio</b></td><td>$inicio</td></tr>";
								echo "<tr><td>Duraci&oacute;n</td><td>$duracion</td></tr>";
								echo "<tr><td>Horario</td><td>$horario</td></tr></table><br>";
							}
							?>

                      	</tr>
                      	<?php } ?>

<!---Consulta de Subcategorias de los Idiomas de Japones-->
						<?php if($_GET['id_discipline'] == 14 && $_GET['id_program'] == 182){
							?> <tr align="center"> <?php
						mysql_select_db($database_otono2011, $otono2011);
						$query1= "SELECT * FROM site_fechas_idiomas WHERE periodo = 'p' AND inicio >= '2013-01-01' AND id_program = ".$_GET['id_program'];
						$fecha_idioma1 = mysql_query($query1, $otono2011) or die(mysql_error());
						while($row1=mysql_fetch_array($fecha_idioma1))
							{
				              $nivel=$row1["nivel"];
				              $subnivel=$row1["subnivel"];
				              $inicio=$row1["inicio"];
				              $duracion=$row1["duracion"];
				              $horario = $row1["horario"];
								echo "<table border=0 width=60% align=center>";
								echo "<tr><td colspan=2 class=contenido_diploRojo><b>$nivel</b></td></tr>";
								echo "<tr><td colspan=2><b>$subnivel</b></td></tr>";
								echo "<tr><td><b>Inicio</b></td><td>$inicio</td></tr>";
								echo "<tr><td>Duraci&oacute;n</td><td>$duracion</td></tr>";
								echo "<tr><td>Horario</td><td>$horario</td></tr></table><br>";
							}
							?>

                      	</tr>
                      	<?php } ?>

<!---Consulta de Subcategorias de los Idiomas de Tlahuac-->
						<?php if($_GET['id_discipline'] == 14 && $_GET['id_program'] == 183){
							?> <tr align="center"> <?php
						mysql_select_db($database_otono2011, $otono2011);
						$query1= "SELECT * FROM site_fechas_idiomas WHERE periodo = 'p' AND inicio >= '2013-01-01' AND id_program = ".$_GET['id_program'];
						$fecha_idioma1 = mysql_query($query1, $otono2011) or die(mysql_error());
						while($row1=mysql_fetch_array($fecha_idioma1))
							{
				              $nivel=$row1["nivel"];
				              $subnivel=$row1["subnivel"];
				              $inicio=$row1["inicio"];
				              $duracion=$row1["duracion"];
				              $horario = $row1["horario"];
								echo "<table border=0 width=60% align=center>";
								echo "<tr><td colspan=2 class=contenido_diploRojo><b>$nivel</b></td></tr>";
								echo "<tr><td colspan=2><b>$subnivel</b></td></tr>";
								echo "<tr><td><b>Inicio</b></td><td>$inicio</td></tr>";
								echo "<tr><td>Duraci&oacute;n</td><td>$duracion</td></tr>";
								echo "<tr><td>Horario</td><td>$horario</td></tr></table><br>";
							}
							?>

                      	</tr>
                      	<?php } ?>

<!---Consulta de Subcategorias de los Idiomas de Portugues-->
						<?php if($_GET['id_discipline'] == 14 && $_GET['id_program'] == 178){
							?> <tr align="center"> <?php
						mysql_select_db($database_otono2011, $otono2011);
						$query1= "SELECT * FROM site_fechas_idiomas WHERE periodo = 'p' AND inicio >= '2013-01-01' AND id_program = ".$_GET['id_program'];
						$fecha_idioma1 = mysql_query($query1, $otono2011) or die(mysql_error());
						while($row1=mysql_fetch_array($fecha_idioma1))
							{
				              $nivel=$row1["nivel"];
				              $subnivel=$row1["subnivel"];
				              $inicio=$row1["inicio"];
				              $duracion=$row1["duracion"];
				              $horario = $row1["horario"];
								echo "<table border=0 width=60% align=center>";
								echo "<tr><td colspan=2 class=contenido_diploRojo><b>$nivel</b></td></tr>";
								echo "<tr><td colspan=2><b>$subnivel</b></td></tr>";
								echo "<tr><td><b>Inicio</b></td><td>$inicio</td></tr>";
								echo "<tr><td>Duraci&oacute;n</td><td>$duracion</td></tr>";
								echo "<tr><td>Horario</td><td>$horario</td></tr></table><br>";
							}
							?>

                      	</tr>
                      	<?php } ?>



                      	<!---Consulta de Subcategorias de los Idiomas de Turco-->
						<?php if($_GET['id_discipline'] == 14 && $_GET['id_program'] == 184){
							?> <tr align="center"> <?php
						mysql_select_db($database_otono2011, $otono2011);
						$query1= "SELECT * FROM site_fechas_idiomas WHERE periodo = 'p' AND inicio >= '2013-01-01' AND id_program = ".$_GET['id_program'];
						$fecha_idioma1 = mysql_query($query1, $otono2011) or die(mysql_error());
						while($row1=mysql_fetch_array($fecha_idioma1))
							{
				              $nivel=$row1["nivel"];
				              $subnivel=$row1["subnivel"];
				              $inicio=$row1["inicio"];
				              $duracion=$row1["duracion"];
				              $horario = $row1["horario"];
								echo "<table border=0 width=60% align=center>";
								echo "<tr><td colspan=2 class=contenido_diploRojo><b>$nivel</b></td></tr>";
								echo "<tr><td colspan=2><b>$subnivel</b></td></tr>";
								echo "<tr><td><b>Inicio</b></td><td>$inicio</td></tr>";
								echo "<tr><td>Duraci&oacute;n</td><td>$duracion</td></tr>";
								echo "<tr><td>Horario</td><td>$horario</td></tr></table><br>";
							}
							?>

                      	</tr>
                      	<?php } ?>



</td></tr>
        </table>





      </div>

    </div>
    <div id= "type4" class="rectangulo_irregular" style="margin-left:17px;">


      <?php if($_GET['id_discipline'] == 15 && $_GET['id_program'] == 401){ ?>
      <img class="img_seccion" src="imagenes/secciones/online_pjf.png" width="208" height="237" align="right" />
      <?php }else{ ?>
      <img class="img_seccion" src="imagenes/secciones/<?php echo $imagen; ?>.png" width="198" height="237" align="right" />
      <?php } ?></div>


<div style="width:25%; float:left; margin-left:22px; margin-top:18px">
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
  <area shape="rect" coords="48,102,78,132" href="https://www.facebook.com/pages/Diplomados-Ibero/281228424828" target="_blank" />
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
