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

if((isset($_POST['send_form'])) && ($_POST['send_form']==1)){

	$id_program = $_POST['id_program'];
	$fecha_registro = date('Y-m-d H:i:s');
	
	mysql_select_db($database_otono2011, $otono2011);
	$query_diplos_names = "SELECT *, (SELECT discipline FROM disciplines WHERE disciplines.id_discipline = site_programs.id_discipline) AS discipline, (SELECT id_discipline FROM disciplines WHERE disciplines.id_discipline = site_programs.id_discipline) AS id_discipline FROM site_programs WHERE id_program = '".$id_program."'";
	$diplos_names = mysql_query($query_diplos_names, $otono2011) or die(mysql_error());
	$row_diplos_names = mysql_fetch_assoc($diplos_names);
	//$totalRows_diplos_names = mysql_num_rows($diplos_names);
	
	$id_discipline = $row_diplos_names['id_discipline'];
	
	mysql_select_db($database_otono2011, $otono2011);
	$query_coord_mails = "SELECT * FROM ss_users WHERE id_user IN(SELECT id_user FROM ss_users_disciplines WHERE id_discipline = '$id_discipline') AND id_access = 3";
	$coord_mails = mysql_query($query_coord_mails, $otono2011) or die(mysql_error());
	$row_coord_mails = mysql_fetch_assoc($coord_mails);
	$totalRows_coord_mails = mysql_num_rows($coord_mails);
	
	//Informacion del curso seleccionado
	
	$nombre_area = $row_diplos_names['discipline'];
	$nombre_programa = $row_diplos_names['program_type']." - ".$row_diplos_names['program_name'];
	
	//Información Personal
	$email = $_POST['correo'];
	$a_paterno = $_POST['a_paterno'];
	$a_materno = $_POST['a_materno'];
	$nombre = $_POST['nombre'];
	$correo = $_POST['correo'];
	
	$insertSQL = "INSERT INTO sp_preinscritos (
	id_discipline,
	id_program,
	fecha_registro,
	como_se_entero,
	a_paterno,
	a_materno,
	nombre,
	correo)
	VALUES (
	'$id_discipline',
	'$id_program',
	'$fecha_registro',
	'$como_se_entero',
	'$a_paterno',
	'$a_materno',
	'$nombre',
	'$correo'
	)";
	
	  
	mysql_select_db($database_otono2011, $otono2011);


	
	$Result1 = mysql_query($insertSQL, $otono2011) or die(mysql_error());
	
	mysql_select_db($database_otono2011, $otono2011);
	$query_last_p = "SELECT id_preinscrito FROM sp_preinscritos ORDER BY id_preinscrito DESC";
	$last_p = mysql_query($query_last_p, $otono2011) or die(mysql_error());
	$row_last_p = mysql_fetch_assoc($last_p);
	
	$insertSQL = "INSERT INTO sp_pasos_status (id_preinscrito, informes, comentario_general) VALUES (".$row_last_p['id_preinscrito'].",1,'".$_POST['comentario']."')";
	
	$Result1 = mysql_query($insertSQL, $otono2011) or die(mysql_error());
	
	/*CONSTRUCCION DEL MENSJAE PARA ENVIAR EN EL MAIL*/
    $mensaje.="<br /><strong>Han solicitado Informaci&oacute;n:</strong><br /><br />";
	$mensaje="<strong>&Aacute;rea:</strong> ".$nombre_area."<br />";
	$mensaje.="<strong>Nombre del programa:</strong> ".$nombre_programa."<br />";
	
	
	$mensaje.="<br /><strong>Información Personal:</strong><br /><br />";
	$mensaje.="<strong>Apellido Paterno:</strong> ".$a_paterno."<br />";
	$mensaje.="<strong>Apellido Materno:</strong> ".$a_materno."<br />";
	$mensaje.="<strong>Nombre:</strong> ".$nombre."<br />";
	$mensaje.="<strong>Correo:</strong> ".$correo."<br />";
	$mensaje.="<strong>Comentario:</strong> ".$_POST['comentario'];;
	
	
	$headers = "From: " . strip_tags($email) . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";	
	$headers .= 'Cc: webmaster@dec-uia.com' . "\r\n";				
	
	//echo "ANTES: " . $mensaje;
	
	$mensaje = str_replace("á", "&aacute;", $mensaje);
	$mensaje = str_replace("é", "&eacute;", $mensaje);
	$mensaje = str_replace("í", "&iacute;", $mensaje);
	$mensaje = str_replace("ó", "&oacute;", $mensaje);
	$mensaje = str_replace("ú", "&uacute;", $mensaje);
	$mensaje = str_replace("ñ", "&ntilde;", $mensaje);
	$mensaje = str_replace("Ñ", "&Ntilde;", $mensaje);
	
	//echo "DESPUES: " . $mensaje;
	
	$mail_title = "DEC - Solicitud de informes";
	
					
	mail("dec.ibero@gmail.com", $mail_title, $mensaje, $headers);
	//mail("erika.medina@uia.mx", $mail_title, $mensaje, $headers);
	//mail("jorge@estrategasdigitales.com", $mail_title, $mensaje, $headers);
	//mail("jlaa2774@hotmail.com", utf8_decode($mail_title), $mensaje, $headers);
	do {
		//$to_coord = $row_coord_mails['email'];
		$to_coord_b = $row_coord_mails['email_b'];
		$mensaje_coord .= "<br /><br />";
		$mensaje_coord = "Hay una nueva solicitud de informes para el <strong>".$nombre_programa."</strong>";
		$mensaje_coord .= "<br /><br />";
		$mensaje_coord .= "Para darle seguimiento visita la siguiente liga:";
		$mensaje_coord .= "<br /><br />";
		$mensaje_coord .= "<a href='http://www.dec-uia.com/s_preiniscritos/' target='_blank'>http://www.dec-uia.com/s_preiniscritos/</a>";
		$mensaje_coord .= "<br /><br />donde podrás llevar paso a paso el proceso de inscripción y tener un fácil acceso a la información del usuario.";
		$mensaje_coord .= "<br /><br />Tu nombre de usuario es: <strong>".$row_coord_mails['username']."</strong>";
		$mensaje_coord .= "<br /><br />Tu contraseña: <strong>".$row_coord_mails['password']."</strong>";
		//mail($to_coord, $mail_title, $mensaje_coord, $headers);
		mail($to_coord_b, $mail_title, $mensaje_coord, $headers);
		
	}while($row_coord_mails = mysql_fetch_assoc($coord_mails));
	
	//mail('pvazquezdiaz@gmail.com', $mail_title, $mensaje_coord, $headers);
?>	

<script type="text/javascript">
alert("Sus Datos han sido enviado satisfactoriamente");
window.location = "index.php";
</script>

<?php

	//header('Location: index.php');
	//para mandar el mail en texto plano.

}

mysql_select_db($database_otono2011, $otono2011);
$query_disciplines_names = "SELECT * FROM disciplines WHERE id_discipline != 22 AND id_discipline != 19 ORDER BY discipline ASC";
$disciplines_names = mysql_query($query_disciplines_names, $otono2011) or die(mysql_error());
$row_disciplines_names = mysql_fetch_assoc($disciplines_names);
//$totalRows_disciplines_names = mysql_num_rows($disciplines_names);

//mysql_select_db($database_otono2011, $otono2011);
$query_programas = "SELECT id_program, program_type, program_name FROM site_programs WHERE cancelado = 0 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE periodo = 'o') ORDER BY program_type DESC, program_name ASC";
$programas = mysql_query($query_programas, $otono2011) or die(mysql_error());
$row_programas = mysql_fetch_assoc($programas);

//mysql_select_db($database_otono2011, $otono2011);
$query_ad = "SELECT * FROM ads ORDER BY `date` DESC LIMIT 0, 1";
$ad = mysql_query($query_ad, $otono2011) or die(mysql_error());
$row_ad = mysql_fetch_assoc($ad);
$totalRows_ad = mysql_num_rows($ad);
?>
<!DOCTYPE html>
<html><!-- InstanceBegin template="/Templates/index.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Untitled Document</title>
<link rel="stylesheet" href="Scripts/jquery-ui.css" type="text/css" media="all" />
<script type="text/javascript" src="Scripts/jquery.js"></script>
<script type="text/javascript" src="Scripts/menu2.js"></script>
<script src="Scripts/jquery-ui.js"></script>
<script type="text/JavaScript">
//-->
function validate(){
	   
	   //___ NUEVO CODIGO ---
	   
	    var requiredFieldsAlertMsg = "Los siguientes campos son requeridos:\n\n";
		var cont = 0;
		  
		  if($('select#id_program').val()==0){
			  requiredFieldsAlertMsg += "* Programa\n";
				cont++;
		  }
		 
		 if ($('input[name=como_se_entero]:radio').is(':checked')) {
			 //--
		 }else{
			 if($('input#otromedio').val()==''){
				requiredFieldsAlertMsg += "* ¿Cómo se enteró?\n";
				cont++;
			}
		}
		
		if($('input#a_paterno').val()==''){
			requiredFieldsAlertMsg += "* Apellido paterno\n";
			cont++;
		}
		if($('input#a_materno').val()==''){
			requiredFieldsAlertMsg += "* Apellido materno\n";
			cont++;
		}
		if($('input#nombre').val()==''){
			requiredFieldsAlertMsg += "* Nombre(s)\n";
			cont++;
		}
		
	   
		if(cont>0){
			alert(requiredFieldsAlertMsg);
			return false;
		}else{
			return true;
		}		
}

function load_programs(id_discipline)
{
	$('td#td_programas').html('Cargando...');
if (id_discipline=="")
  {
  document.getElementById('td_programas').innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    //document.getElementById(div).innerHTML=xmlhttp.responseText;
	//alert(xmlhttp.responseText);
	$('td#td_programas').html(xmlhttp.responseText);		
	
    }
  }
xmlhttp.open("GET",'ajax_programas.php?id_discipline='+id_discipline,true);
xmlhttp.send();
}


function count_char(){
	var total_letras = 200;
	$('#comentario').keyup(function() {
			var longitud = $(this).val().length;
			var resto = total_letras - longitud;
			$('#numero').html(resto);
			if(resto <= 0){
					$('#comentario').attr("maxlength", 200);
			}
	});
}

</script>
<!-- InstanceEndEditable -->
<link href="css/estilos_dan.css" rel="stylesheet" type="text/css" />
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
    <div id="slide_menu" style="display:none; width:190px; background: url(imagenes/sombrita_submenu.png) repeat-y; background-color:#D6D7D9; position:relative; left:189px;z-index:1000; margin-bottom:-1000px">

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
            <li><a class="discipline_3" onclick="showMenu(3)">Dise&ntilde;o</a></li>
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
          <p style="padding:0px 5px 5px 5px;"><a href="catalogo.php"style="color:#EF353C; font-weight:bold;">Consulta cat&aacute;logo oferta primavera 2013</a></p>
        </div>
      </div>
    </div>
  </div>
  <div id= "contenedor_irregular_index" >
    <div id= "type4" class="cuadro_articulos_secciones" style="border:0px;width:816px;padding:0px">
      <div id="caja" style="width:788px; border:1px;height:265px;background-image: url(imagenes/banner_informes.png);margin-left:26px;position:relative; float:left; z-index:12;"> <!-- InstanceBeginEditable name="header" -->
    				      
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
		  	<table width="95%" border="0" align="center" cellpadding="10" cellspacing="0">
		  		<tr>
		  			<td width="71%" height="50" valign="bottom" class="contenido_diploBold"><p>Formato
			      de Informes</p></td>
		  			<td width="25%" align="right" valign="top"></td>
		  			<td width="4%" rowspan="2">&nbsp;</td>
	  			</tr>
		  		<tr>
		  			<td colspan="2"><p>La direcci&oacute;n de educaci&oacute;n
		  				continua preocupada en&nbsp; la agilizaci&oacute;n de tr&aacute;mites,
		  				presenta a continuaci&oacute;n un formato de preinscripci&oacute;n
		  				que nos ayudar&aacute; a conocer mejor tus necesidades
		  				y los datos necesarios para informarte sobre tu proceso
	  				  de inscripci&oacute;n.</p></td>
	  			</tr>
		  		<tr>
		  			<td colspan="3"><table width="90%" border="0" align="left" cellpadding="2">
<tr>
<td height="30" align="left" valign="middle" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px; color: #666;"><p>Si
  deseas preinscribirte a alg&uacute;n curso o diplomado,
  haz click <a style="font-family: Helvetica, Arial, sans-serif; font-size: 12px; color: #F00; text-decoration:none; cursor:pointer;" href="preinscripcion.php">aqu&iacute;</a></p></td>
</tr>
<tr>
  <td height="30" align="left" valign="middle"style="font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: #F00; text-decoration:none;"><strong>Informes</strong></td>
</tr>
</table>
<div style="clear:both; height:20px;"></div>
<!--COMEIENZA FORMA DE INFORMES-->
<form id="form_inf" name="form_inf" method="post" onsubmit="return validate();" action="contacto.php">
	<table width="500" border="0" cellspacing="0" cellpadding="5">
		<tr>
			<td colspan="2" valign="top"><label for="id_discipline"></label>
				<select onchange="load_programs(this.value);" name="id_discipline" id="id_discipline">
					<option value="0" selected="selected">Todas las &aacute;reas</option>
					<? do { ?>
					<option value="<? echo $row_disciplines_names['id_discipline']; ?>"8><? echo $row_disciplines_names['discipline']; ?></option>
					<? } while($row_disciplines_names = mysql_fetch_assoc($disciplines_names)); ?>
				</select></td>
		</tr>
		<tr>
			<td colspan="2" valign="top" id="td_programas"><select name="id_program" id="id_program" style="width:540px; max-width:540px;">
				<option value="0" selected="selected" disabled="disabled">Selecciona un programa</option>
				<option disabled="disabled">-----DIPLOMADOS---</option>
				<? 
							$tipo_ant = 'diplomado';
							do{
								$tipo = $row_programas['program_type'];
								if($tipo != $tipo_ant){echo '<option disabled="disabled">-----CURSOS---</option>';}
								echo '<option value="'.$row_programas['id_program'].'">'.$row_programas['program_name'].'</option>';
								$tipo_ant = $tipo;
							} while($row_programas = mysql_fetch_assoc($programas)); ?>
			</select></td>
		</tr>
		<tr>
			<td colspan="2" align="center">&nbsp;</td>
		</tr>
		<tr>
			<td width="148" align="right" valign="top">* A. Paterno</td>
			<td width="332" valign="top"><label for="a_paterno"></label>
				<input name="a_paterno" type="text" id="a_paterno" onchange="populate_rfc_name()" size="30" /></td>
		</tr>
		<tr>
			<td align="right" valign="top">* A. Materno</td>
			<td valign="top"><label for="a_materno"></label>
				<input name="a_materno" type="text" id="a_materno" onchange="populate_rfc_name()" size="30" /></td>
		</tr>
		<tr>
			<td align="right" valign="top">* Nombre(s)</td>
			<td valign="top"><label for="nombre"></label>
				<input name="nombre" type="text" id="nombre" onchange="populate_rfc_name()" size="30" /></td>
		</tr>
		<tr>
			<td align="right" valign="top">* E-mail</td>
			<td valign="top"><label for="correo"></label>
				<input name="correo" type="text" id="correo" size="30" /></td>
		</tr>
		<tr>
			<td align="right" valign="top">Comentario:</td>
			<td><label for="telefono_empresa"></label>
				<textarea name="comentario" cols="30" rows="5" id="comentario" onkeydown="count_char();"></textarea></td>
		</tr>
		<tr>
			<td align="right" valign="top">&nbsp;</td>
			<td><span id="numero">200</span> caracteres restantes</p></td>
		</tr>
		<tr>
			<td valign="top">&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type="submit" name="enviar" id="enviar" value="Enviar" /></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><a href="politicas_privacidad.php" target="_blank" style="color:#ff0000;"><input type="checkbox" name="option2" value="Butter" checked disabled><strong> He leido y acepto el Aviso de Privacidad</strong></a></td>
		</tr>
	</table>
	<input type="hidden" name="send_form" id="send_form" value="1" />
</form>
<!--FINALIZA FORMA DE INFORMES-->
					</td>
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
</body>
<!-- InstanceEnd --></html>

