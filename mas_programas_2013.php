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
    </div>

    <div id="slide_menu" style="display:none; width:190px; background: url(imagenes/sombrita_submenu.png) repeat-y; background-color:#D6D7D9; position:relative; left:-11px; z-index:1000; margin-bottom:-2000px; padding-bottom: 10px;">
  	</div>
 									
	<div style="margin-left:29px">
																																																									
        <div style="width:69%;float:left;margin-left:0px">
        	 <?php  	
        	 	$fecha_hoy = date("Y-m-d");																																
			  	$fecha1 = strtotime('+1 day',strtotime($fecha_hoy));
				$fecha1 = date('Y-m-d',$fecha1);																							

				$fecha2 = strtotime('+15 day',strtotime($fecha1));
				$fecha2 = date('Y-m-d',$fecha2);																																																																	
																
			  	mysql_query("SET lc_time_names = 'es_ES'");
				mysql_select_db($database_otono2011, $otono2011);																												
				$query_prog = "SELECT sp.program_name,sp.id_program,sp.program_type,sp.id_discipline,sp.id_program,sp.program_new,date_format(sf.fecha,'%d') as dia,date_format(sf.fecha,'%M') as mes FROM site_programs as sp INNER JOIN site_fechas_ini as sf ON sp.id_program = sf.id_program where sp.program_new=1 AND date_format(sf.fecha,'%Y-%m-%d') BETWEEN '$fecha1' AND '$fecha2' AND sf.cancelado=0";
				$prog = mysql_query($query_prog, $otono2011) or die(mysql_error());											
				$row_prog = mysql_fetch_assoc($prog);																						
				$totalRows_prog = mysql_num_rows($prog);					

				?>						
				<div>																																																																		
					<div id="pleca_gris_mas"><div id="titulo_programas_mas">Programas pr&oacute;ximos a abrir</div></div>						
					<?php  														 																			
						$x = 1;															
						while($row_prog = mysql_fetch_assoc($prog))
						{																																																			
						  	$class = "cont_programas_".$x;	

					?>		<div class="<?php echo $class; ?>">																															
								<div class="fecha_ini_mas">													 										
									<?php echo $row_prog['dia']; ?> de 	<?php echo $row_prog['mes']; ?>													
								</div>																																																																																															
								<div class="name_program_mas">																													
									<div class="program_type"><?php echo $row_prog['program_type']; ?></div>
									<?php echo $row_prog['program_name']; ?>														
									<a href="programas.php?id_discipline=<?php echo $row_prog['id_discipline']; ?>&id_program=<?php echo $row_prog['id_program']; ?>"><img src="imagenes/programas/bt_ver_mas.png"/></a>																																																																															
								</div>											
							</div>																				
				  <?php 													
				  			$x = ($x==0)?1:0;
						}				
				  ?>																				
				</div>					
       	</div>
            
 <div style="width:25%; float:left; margin-left:37px; margin-top:18px">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
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
            <td valign="bottom" width="191px" height="118" align="left" style="background: url(imagenes/ladec/banners/banners_laterales/newsletter.jpg) no-repeat bottom transparent; width:191px;">
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
          <tr>
          	<td align="center"><a href=" http://www.dec-uia.com/trivia2013/getbases.php?origin=ly5nhowK25"><img src="imagenes/d_banner_chiquito.jpg" height="300" width="180"></a></td>
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