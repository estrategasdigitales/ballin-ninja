<?php 
if(preg_match('/msie [2-7]/i', $_SERVER['HTTP_USER_AGENT'])) {
       header('Location: Scripts/ie_detect/update_browser.html');
}								
																				
require_once('Connections/otono2011.php'); ?>
<?php 	
						
													
	if (!function_exists("GetSQLValueString")) 
	{
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

	if(!isset($_GET['tipo']))
	{
		$_GET['tipo'] = "";
	}			

	$comentarios=$_GET["tipo"];
	if($comentarios==1){			
		registro_red($comentarios);
	}

							
	function registro_red($comentarios){
		$fecha=date("Y-m-d H:i:s");
		$base_datos="decuiaco_site";
		$servidor="localhost";
		$usuario="decuiaco";
		$password="aiOS..2x";
		$conex=mysql_connect($servidor, $usuario, $password) or die(mysql_error());
		mysql_select_db($base_datos, $conex);
		$sql="INSERT INTO landing_mailing (fecha) VALUES ('".$fecha."')";
		$result=mysql_query($sql);
		header('Location: http://www.diplomados.uia.mx/index.php');
	}
								
	mysql_select_db($database_otono2011, $otono2011);
	$query_weekly_article = "SELECT * FROM weekly_articles ORDER BY `date` DESC LIMIT 0, 1";
	$weekly_article = mysql_query($query_weekly_article, $otono2011) or die(mysql_error());
	$row_weekly_article = mysql_fetch_assoc($weekly_article);
	$totalRows_weekly_article = mysql_num_rows($weekly_article);

	$hoy = date('Ymd');


	mysql_select_db($database_otono2011, $otono2011);
	$query_programas_izq = "SELECT site_programs.id_discipline, site_programs.id_program, site_programs.imagen, site_programs.program_name AS programa, site_fechas_ini.fecha AS fecha_inicio FROM site_programs, site_fechas_ini WHERE site_programs.id_program=site_fechas_ini.id_program AND site_fechas_ini.publicado=1 ORDER BY RAND() LIMIT 2";
	$programas_izq = mysql_query($query_programas_izq, $otono2011) or die(mysql_error());
	$row_programas_izq = mysql_fetch_assoc($programas_izq);
	$totalRows_programas_izq = mysql_num_rows($programas_izq);

	mysql_select_db($database_otono2011, $otono2011);
	$query_programas_der = "SELECT site_fechas_idiomas.id_program AS id_program_idioma, site_fechas_idiomas.nivel, site_fechas_idiomas.inicio, (select site_programs.imagen FROM site_programs WHERE site_fechas_idiomas.id_program=site_programs.id_program) AS imagen_idioma FROM site_fechas_idiomas, site_programs WHERE site_fechas_idiomas.inicio > ".$hoy." ORDER BY RAND() LIMIT 2";
	$programas_der = mysql_query($query_programas_der, $otono2011) or die(mysql_error());
	$row_programas_der = mysql_fetch_assoc($programas_der);
	$totalRows_programas_der = mysql_num_rows($programas_der);

	mysql_select_db($database_otono2011, $otono2011);
	$query_programas_izqb = "SELECT site_programs.id_discipline, site_programs.id_program, site_programs.imagen, site_programs.program_name AS programa, site_fechas_ini.fecha AS fecha_inicio FROM site_programs, site_fechas_ini WHERE site_programs.id_program=site_fechas_ini.id_program AND site_fechas_ini.publicado=1 ORDER BY RAND() LIMIT 3";
	$programas_izqb = mysql_query($query_programas_izqb, $otono2011) or die(mysql_error());
	$row_programas_izqb = mysql_fetch_assoc($programas_izqb);
	$totalRows_programas_izqb = mysql_num_rows($programas_izqb);

	mysql_select_db($database_otono2011, $otono2011);
	$query_carrusel = "SELECT * FROM carrusel_index WHERE `visible`='SI' ORDER BY `orden` ASC";
	$carrusel = mysql_query($query_carrusel, $otono2011) or die(mysql_error());

	mysql_select_db($database_otono2011, $otono2011);
	$query_community_opinions_top3 = "SELECT * FROM community_opinions ORDER BY `date` DESC LIMIT 0, 5";
	$community_opinions_top3 = mysql_query($query_community_opinions_top3, $otono2011) or die(mysql_error());
			


	function WordLimiter($text,$limit,$word_count)
	{						
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

		if($dots){
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
<!DOCTYPE html>
<html><!-- InstanceBegin template="/Templates/index.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Direcci&oacute;n de Educaci&oacute;n Continua | UIA</title>
<!-- InstanceEndEditable -->
<link href="css/estilos_dan.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="Scripts/jquery-ui.css" type="text/css" media="all" />
<!------ Google Analytics ------>

<script type="text/javascript" src="Scripts/jquery.js"></script>
<script type="text/javascript" src="Scripts/menu.js"></script>
<script type="text/javascript" src="jquery.carouFredSel-6.1.0.js"></script>
<script type="text/javascript" src="jquery.carouFredSel-6.1.0-packed.js"></script>
<script src="Scripts/jquery-ui.js"></script>
<!--script src="Scripts/ie_detect.js"></script-->
<script type="text/javascript">

	$(document).ready(function(){
		$(".foo5").carouFredSel({
			scroll      : {
		        fx          : "crossfade"
		    },
				items		: {
				visible		: 1,
				width		: 775,
				height		: "46%"

			},
			auto : 		  {
				duration    : 1700,
		        timeoutDuration: 4000,

			},
			prev 		: {
				button		: "#foo5_prev",
				key			: "left",
				items		: 1,
			
				duration	: 1700
			},
			next 		: {
				button		: "#foo5_next",
				key			: "right",
				items		: 1,
			
				duration	: 1700
			},
			pagination : {
				container	: "#foo5_pag",
				keys		: true,
				
				duration	: 1700
			}	
		})
	});

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

					
a.prev:hover {		background-position: 0 0px; }
a.prev.disabled {	background-position: 0 -100px !important;  }
a.next:hover {		background-position: 0px 0px; }
a.next.disabled {	background-position: -50px -100px !important;  }
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
<div id="espacio" style="width:5%;float:left"> 

</div>	
  <div id= "contenedor_irregular_index">
    <div class="bannersuperior" style="margin-bottom:0px"><!-- InstanceBeginEditable name="weekly_articles" -->
    <?php /*$random=rand(1,2); ?>
    
      <table width="100%" border="0" cellspacing="10" cellpadding="0">
        <tr align="left"  valign="top" >        
         <?php
				if($random == 1){ ?>
        
        
        
          <td onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=<?php echo $row_programas_izq['id_discipline'];?>&id_program=<?php echo $row_programas_izq['id_program']; ?>'" valign="middle" style="background: url(imagenes/uploads/banner_prox/<?php echo $row_programas_izq['imagen']; ?>) no-repeat top left; cursor:pointer; width:155px; height:83px; padding-left:185px; margin-top:5px; padding-right:3px;"><h5><?php echo WordLimiter($row_programas_izq['programa'], 6); ?></h5>
          <strong>Inicio</strong>: <?php echo strftime("%d de %B", strtotime($row_programas_izq['fecha_inicio'])); ?> </td>
          
       <?php } else{
           if($row_programas_der != NULL){ ?>
           
          <td onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=<?php echo $row_programas_izq['id_discipline'];?>&id_program=<?php echo $row_programas_izq['id_program']; ?>'" valign="middle" style="background: url(imagenes/uploads/banner_prox/<?php echo $row_programas_der['imagen_idioma']; ?>) no-repeat top left; cursor:pointer; width:160px; height:83px; padding-left:181px; margin-top:5px; padding-right:3px;"><h5><?php echo ucfirst(strtolower($row_programas_der['nivel'])); ?></h5>
          <strong>Inicio</strong>: <?php echo strftime("%d de %B", strtotime($row_programas_der['inicio'])); ?> </td>
          
           <?php }else{ ?>
           
           <td onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=<?php echo $row_programas_izq['id_discipline'];?>&id_program=<?php echo $row_programas_izq['id_program']; ?>'" valign="middle"  style="background: url(imagenes/uploads/banner_prox/<?php echo $row_programas_izq['imagen']; ?>) no-repeat top left; cursor:pointer; width:155px; height:83px; padding-left:185px; margin-top:5px; padding-right:3px;"><h5><?php echo WordLimiter($row_programas_izq['programa'], 6); ?></h5>
          <strong>Inicio</strong>: <?php echo strftime("%d de %B", strtotime($row_programas_izq['fecha_inicio'])); ?> </td>
          
          <?php }} ?>	
           
          <?php if($random==1){
						if($row_programas_der != NULL){
						?>
          
         <td><h2>Próximos programas a iniciar</h2>
             <ul>
             <?php do { ?>
              <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=14&id_program=<?php echo $row_programas_der['id_program_idioma']; ?>'"><?php echo ucfirst(strtolower($row_programas_der['nivel'])); ?></a> <span class="contenido_diploRojo">/</span> <span class="contenido_diploRojo"> <?php echo strftime("%d de %B", strtotime($row_programas_der['inicio'])); ?></span></li>
              <?php $row_programas_izq = mysql_fetch_assoc($programas_izq) ?>
              <?php if ($row_programas_izq != NULL){?>
              <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=<?php echo $row_programas_izq['id_discipline'];?>&id_program=<?php echo $row_programas_izq['id_program']; ?>'"><?php echo WordLimiter($row_programas_izq['programa'], 6); ?></a> <span class="contenido_diploRojo">/</span> <span class="contenido_diploRojo"> <?php echo strftime("%d de %B", strtotime($row_programas_izq['fecha_inicio'])); ?></span><?php } ?></li>
              
              <?php } while ($row_programas_der = mysql_fetch_assoc($programas_der)); ?>
             </ul></td>
        </tr>
      </table>
      <?php }else{ ?>
      
      <td><h2>Próximos programas a iniciar</h2>
             <ul>
             <?php do { ?>
             
            <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=<?php echo $row_programas_izqb['id_discipline'];?>&id_program=<?php echo $row_programas_izqb['id_program']; ?>'"><?php echo WordLimiter($row_programas_izqb['programa'], 6); ?></a> <span class="contenido_diploRojo">/</span> <span class="contenido_diploRojo"> <?php echo strftime("%d de %B", strtotime($row_programas_izqb['fecha_inicio'])); ?></span></li>
             
              <!--a href="#" onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=14&id_program=<?php echo $row_programas_izqb['id_program_idioma']; ?>'"><?php echo ucfirst(strtolower($row_programas_izqb['nivel'])); ?></a> <span class="contenido_diploRojo">/</span> <span class="contenido_diploRojo"> <?php echo strftime("%d de %B", strtotime($row_programas_izqb['inicio'])); ?></span></li-->
             
              <?php } while ($row_programas_izqb = mysql_fetch_assoc($programas_izqb)); ?>
             </ul></td>
        </tr>
      </table>
      
          <?php }}else{ 
						if($row_programas_der != NULL){
					?>
          
         <td><h2>Próximos programas a iniciar</h2>
             <ul>
             <?php do { ?>
              <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=<?php echo $row_programas_izq['id_discipline'];?>&id_program=<?php echo $row_programas_izq['id_program']; ?>'"><?php echo WordLimiter($row_programas_izq['programa'], 6); ?></a> <span class="contenido_diploRojo">/</span> <span class="contenido_diploRojo"> <?php echo strftime("%d de %B", strtotime($row_programas_izq['fecha_inicio'])); ?></span></li>
              <?php $row_programas_der = mysql_fetch_assoc($programas_der) ?>
              <?php if ($row_programas_der != NULL){?>
                            <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=14&id_program=<?php echo $row_programas_der['id_program_idioma']; ?>'"><?php echo ucfirst(strtolower($row_programas_der['nivel'])); ?></a> <span class="contenido_diploRojo">/</span> <span class="contenido_diploRojo"> <?php echo strftime("%d de %B", strtotime($row_programas_der['inicio'])); ?></span><?php } ?></li>
              
              <?php } while ($row_programas_izq = mysql_fetch_assoc($programas_izq));
							
							}else{ 
							?>
              
              <td><h2>Próximos programas a iniciar</h2>
             <ul>
             <?php do {
							 ?>
              <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=<?php echo $row_programas_izqb['id_discipline'];?>&id_program=<?php echo $row_programas_izqb['id_program']; ?>'"><?php echo WordLimiter($row_programas_izqb['programa'], 6); ?></a> <span class="contenido_diploRojo">/</span> <span class="contenido_diploRojo"> <?php echo strftime("%d de %B", strtotime($row_programas_izqb['fecha_inicio'])); ?></span></li>
                                          
                            <?php } while ($row_programas_izqb = mysql_fetch_assoc($programas_izqb));
							
							}} ?>
              
             <!--li><span class="contenido_diploRojo">24 de marzo</span> / Espacio Público y Ciudades Seguras </li>
             <li><span class="contenido_diploRojo">24 de marzo</span> / Espacio Público y Ciudades Seguras </li-->
            </ul></td>
        </tr>
      </table> */ ?>
      <!-- InstanceEndEditable --> </div>
    <div id="slide_menu" style="display:none; width:190px; background: url(imagenes/sombrita_submenu.png) repeat-y; background-color:#D6D7D9; position:relative; left:-11px; z-index:1000; margin-bottom:-2000px; padding-bottom: 10px;">

  	</div>
 
	<div style="margin-left:29px">
   		<div class="textos" style="margin-left:0px;top:0px;height:295px;width:1500px;margin-bottom:9px;float:left">
			<div class="html_carousel" style="float:left;margin-left:0px;">
				<div class="pagination" id="foo5_pag" style="width:190px;float:right;display:block;margin-top:250px;margin-left:-219px;z-index:5;position:relative">
				</div>
				<div style="float:left;display:block;margin-top:288px;margin-left:1px;z-index:16;position:absolute">
					<a class="prev" id="foo5_prev" href="#"><span>prev</span></a>
					<a class="next" id="foo5_next" href="#"><span>next</span></a>
				</div>
				<div id="foo5" class="foo5">
					<!--div class="slide" id="parrafo1">
						<a href="#" onclick="parent.location='http://www.diplomados.uia.mx/extras.php'">
							<img src="imagenes/carrusel/carrusel_promo.png" alt="carousel 4" width="775" height="300" />
							<div style="width:172px";>
								<h4 align="center">Obt&eacute;n 40% de descuento si te inscribes con un amigo.</h4>
								<hr id="linea1" style="margin-left:10px">
								<p align="center">Aplica en cursos y diplomados</p>
							</div>
						</a>
	       				
					</div-->
					<?php while($row_carrusel = mysql_fetch_assoc($carrusel)){?>
	       			<div class="slide">
	       				<a href="#" onclick="parent.location='<?php echo $row_carrusel['destino']; ?>'">
							<img src="imagenes/carrusel/<?php echo $row_carrusel['imagen_carrusel']; ?>" alt="carousel 1" width="775" height="300" />
							<div style="width:172px">
								<h4 align="center"><?php echo $row_carrusel['titulo']; ?></h4>
								<hr id="linea1" style="margin-left:10px">
								<p align="center"><?php echo $row_carrusel['texto']; ?></p>
							</div>
						</a>
					</div>
					<?php } ?>
	      			 <!--div class="slide">
	      			 	<a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=20'">
							<img src="imagenes/carrusel/banner_carrusel_lofft.png" alt="carousel 2" width="775" height="300" />
							<div style="width:172px">
								<h4 align="center">&iquest;Ya conoces nuestra sede en el sur?</h4>
								<hr id="linea1" style="margin-left:10px">
								<p align="center">ESTUDIO LOFFT, otra forma de estudiar</p>
							</div>
						</a>
					</div>
					<div class="slide">
						<a href="#" onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=2&id_program=415'">
							<img src="imagenes/carrusel/carrusel2.jpg" alt="carousel 3" width="775" height="300" />
							<div style="width:172px">
								<h4 align="center">No hay imágenes inocentes</h4>
								<hr id="linea1" style="margin-left:10px">
								<p align="center">Curso Análisis y creación de la imagen pictórica</p>
							</div-->
						</a>
					</div>
				<div class="clearfix"></div>
            </div>
		</div>																												
        <div style="width:69%;float:left;margin-left:0px">
        	 <div id="slide_search" style="border: 1px solid #E0E0E0; display:none; position:relative; margin-top:-202px; top:580px; left:-39px; width:192px; height:200px; background-color:#FFF; z-index:1000;">
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
			  <?php  	

			  	mysql_query("SET lc_time_names = 'es_ES'");
				mysql_select_db($database_otono2011, $otono2011);																												
				$query_prog = "SELECT sp.program_name,sp.id_program,sp.program_new,date_format(sf.fecha,'%d') as dia,date_format(sf.fecha,'%M') as mes FROM site_programs as sp INNER JOIN site_fechas_ini as sf ON sp.id_program = sf.id_program where sp.program_new=1 ORDER BY RAND() limit 6";
				$prog = mysql_query($query_prog, $otono2011) or die(mysql_error());													
				$row_prog = mysql_fetch_assoc($prog);				
				$totalRows_prog = mysql_num_rows($prog);					

				?>
				
				
				<div id="programas_proximos">																																														
					<div id="pleca_gris"><div id="titulo_programas">Programas pr&oacute;ximos a abrir</div></div>
						<div class="cont_programas">				
					<?php while($row_prog = mysql_fetch_assoc($prog))
						  {													
					?>			
							<div class="fecha_ini">					 										
								<?php echo $row_prog['dia']; ?> de 	<?php echo $row_prog['mes']; ?>													
							</div>																																															
							<div class="name_program">
								<?php echo $row_prog['program_name']; ?>
								<?php 
									if($row_prog['program_new']==1){
								?>																							
									<div class="nuevo">Nuevo</div>						
								<?php			
									}												
								?>			
							</div>																																		
					<?php } ?>	
						</div>																																																									
					<div id="mas_programas"><a href="mas_programas_2013.php"><img src="imagenes/programas/boton_ver_mas.jpg"/></a></div>																						
				</div>	
				
				
				
				
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <!--tr>		
             		<td height="55" align="left" valign="bottom">
                		<img style="outline:none; border:none;" valign="bottom" src="imagenes/comunidad_ibero_opina.png" usemap="#planetmap">
                  		<<img src="imagenes/comunidad_ibero_participa.png" border="0" style="margin-bottom:4px; margin-right:15px; cursor:pointer;" onclick="parent.location='http://www.diplomados.uia.mx/participa.php';" /></td>	
                		<map name="planetmap">
							<area shape="rect" coords="452,13,535,30" href="participa.php" alt="Sun">
						</map>
				</tr-->
                <tr>
                	<td>&nbsp;</td>
                </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
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
                              <? 
							  $word_count = 0;
							  	$word_count += count_words($row_community_opinions_top3['degree']);
							  	$word_count += count_words($row_community_opinions_top3['job_position']);
								$word_count += count_words($row_community_opinions_top3['diploma_course']);
								?>
                              <!--<td><p><em><?php echo $row_community_opinions_top3['degree']; ?></em></p></td>-->
                            </tr>
                            <tr>
                              <td><p><strong><em><?php echo $row_community_opinions_top3['diploma_course']; ?></em></strong></p></td>
                            </tr>
                            <tr>
                              <td height="10"></td>
                            </tr>
                            <tr>
                              <td><p><?php echo WordLimiter($row_community_opinions_top3['opinion'], 35, $word_count); ?><br />
                                  <a onclick="parent.location='http://www.diplomados.uia.mx/community_opinions_detail.php?id_opinion=<?php echo $row_community_opinions_top3['id_opinion']; ?>'" style="cursor:pointer;"> <span class="avisos_mas">&gt; leer m&aacute;s</span></a></p></td>
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
                              <? 
							 	$word_count = 0;
							  	$word_count += count_words($row_community_opinions_top3['degree']);
							  	$word_count += count_words($row_community_opinions_top3['job_position']);
								$word_count += count_words($row_community_opinions_top3['diploma_course']);
								?>
                              <!--<td><p><em><?php echo $row_community_opinions_top3['degree']; ?></em></p></td>-->
                            </tr>
                           <tr>
                              <td><p><strong><em><?php echo $row_community_opinions_top3['diploma_course']; ?></em></strong></p></td>
                            </tr>
                            <tr>
                              <td height="10"></td>
                            </tr>
                            <tr>
                              <td><p><?php echo WordLimiter($row_community_opinions_top3['opinion'], 35, $word_count); ?><br />
                                  <a onclick="parent.location='community_opinions_detail.php?id_opinion=<?php echo $row_community_opinions_top3['id_opinion']; ?>'" style="cursor:pointer;"><span class="avisos_mas">&gt; leer m&aacute;s</span></a></p></td>
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
                              <? 
							 	$word_count = 0;
							  	$word_count += count_words($row_community_opinions_top3['degree']);
							  	$word_count += count_words($row_community_opinions_top3['job_position']);
								$word_count += count_words($row_community_opinions_top3['diploma_course']);
								?>
                              <!--<td><p><em><?php echo $row_community_opinions_top3['degree']; ?></em></p></td>-->
                            </tr>
                            
                            <tr>
                              <td><p><strong><em><?php echo $row_community_opinions_top3['diploma_course']; ?></em></strong></p></td>
                            </tr>
                            <tr>
                              <td height="10"></td>
                            </tr>
                            <tr>
                              <td><p><?php echo WordLimiter($row_community_opinions_top3['opinion'], 35, $word_count); ?><br />
                                  <a onclick="parent.location='community_opinions_detail.php?id_opinion=<?php echo $row_community_opinions_top3['id_opinion']; ?>'" style="cursor:pointer;"><span class="avisos_mas">&gt; leer m&aacute;s</span></a></p></td>
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
            	</td>
                </tr>
                <tr>
                  <td align="left"><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/community_opinions.php'"><img border="0" src="imagenes/buttons/historico_entrevistas.gif" onmouseover="this.src='imagenes/buttons/historico_entrevistas.gif';" onmouseout="this.src='imagenes/buttons/historico_entrevistas.gif';" /></a></td>
                </tr>
            </table>
       	</div>
              <!-- InstanceEndEditable -->
            <!--<tr>
            <td><!-- AddThis Button BEGIN
              
              <div class="addthis_toolbox addthis_default_style"
						addthis:url="http://www.diplomados.uia.mx/articulos.php?id_discipline=<? echo $_GET['id_discipline']; ?>"
						addthis:title="<?php echo $row_temp['discipline'].' - '.$row_disciplines['title'];?>"> <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> <a class="addthis_button_tweet"></a> <a class="addthis_counter addthis_pill_style"></a> </div>
              <script type="text/javascript">
					var addthis_config = {"data_track_clickback":true};
					</script> 
              <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=pvazquezdiaz"></script> 
              </td> -->
           
 

 <div style="width:25%; float:left; margin-left:37px; margin-top:18px">
      <table width="181px" border="0" cellspacing="0" cellpadding="0">
        <tbody>
		
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
<tr>		
          	<td  align="right" valign="top" >&nbsp;</td>
          	</tr>		   
            <td valign="bottom" width="181px" height="115" align="left" style="background: url(imagenes/ladec/banners/banners_laterales/newsletter.jpg) no-repeat bottom transparent; width:181px;">
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
                    <td align="center"><input onClick="_gaq.push(['_trackEvent', 'Newsletter', 'Click', 'Registro al newsletter']);" type="submit" value="" class="processing" ></td>		
	                  </tr>																				
                  <tr>																								
                    <td height="1"></td>
                  </tr>											
                </tbody></table>
              </form></td>
          </tr>
          <tr>
          	<td  align="right" valign="top" >&nbsp;</td>
          	</tr>			
          <!--
		  <tr>
          	<td align="center"><a href=" http://www.dec-uia.com/trivia2013/getbases.php?origin=ly5nhowK25"><img src="imagenes/d_banner_chiquito.jpg" height="300" width="180"></a></td>
          </tr>
          -->
		  
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
    </tr>
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
  <area shape="rect" coords="48,104,79,133" href="https://www.facebook.com/diplomados.uia" target="_blank" />
  <area shape="rect" coords="82,104,107,133" href="http://twitter.com/DiplomadosIbero" target="_blank" />
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