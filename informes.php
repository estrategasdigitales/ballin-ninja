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
	$query_coord_mails = "SELECT * FROM ss_users WHERE id_user IN(SELECT id_user FROM ss_users_disciplines WHERE id_discipline = $id_discipline) AND id_access = 3";
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

	$mensaje="<strong>&Aacute;rea:</strong> ".$nombre_area."<br />";
	$mensaje.="<strong>Nombre del programa:</strong> ".$nombre_programa."<br />";
	
	
	$mensaje.="<br /><strong>Información Personal:</strong><br /><br />";
	$mensaje.="<strong>A. Paterno:</strong> ".$a_paterno."<br />";
	$mensaje.="<strong>A. Materno:</strong> ".$a_materno."<br />";
	$mensaje.="<strong>Nombre:</strong> ".$nombre."<br />";
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
	
	mail('pvazquezdiaz@gmail.com', $mail_title, $mensaje_coord, $headers);
	
	header('Location: informes_solicitud_envio.php');
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/secciones.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Untitled Document</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.0/jquery.js"></script>
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
    <div id="primavera"></div>
    <div id="menu">
      <ul>
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
            <!--<li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=4'">Comunicaci&oacute;n</a></li>-->
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
           <!-- <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=21&id_program=196'">Asunci&oacute;n Quer&eacute;taro</a></li>
           
            <!--<li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=22&id_program=92'">Atrio Espacio Cultural</a></li>-->
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
	<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="788" height="265" align="middle" id="FlashID">
		  		<param name="movie" value="swf/galeria.swf" />
		  		<param name="quality" value="high" />
		  		<param name="wmode" value="opaque" />
		  		<param name="swfversion" value="8.0.35.0" />
		  		<!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don't want users to see the prompt. -->
		  		<param name="expressinstall" value="Scripts/expressInstall.swf" />
		  		<!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
		  		<!--[if !IE]>-->
		  		<object data="swf/galeria.swf" type="application/x-shockwave-flash" width="788" height="265" align="middle">
		  			<!--<![endif]-->
		  			<param name="quality" value="high" />
		  			<param name="wmode" value="opaque" />
		  			<param name="swfversion" value="8.0.35.0" />
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
	<!-- InstanceEndEditable --> </div>
      <div class="corner topLeft"></div>
      <div class="corner topRight"></div>
      <div class="corner bottomRight"></div>
    </div>
    <div id= "type4" class="rectangulo_abajo_secciones">
      <div class="textos"><!-- InstanceBeginEditable name="contenido" -->
		  	<table width="95%" border="0" align="center" cellpadding="10" cellspacing="0">
		  		<tr>
		  			<td width="71%" height="50" valign="bottom" class="contenido_diploBold"><p>Formato
			      de Informes</p></td>
		  			<td width="25%" align="right" valign="top"> - <a style="cursor:pointer; font-size:12px;" onclick="setActiveStyleSheet('img_templ_princ'); return false;">A</a> <a style="cursor:pointer; font-size:14px;" onclick="setActiveStyleSheet('img_templ_princ2'); return false;">A</a> <a style="cursor:pointer; font-size:16px;" onclick="setActiveStyleSheet('img_templ_princ3'); return false;">A</a> + </td>
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
<form id="form_inf" name="form_inf" method="post" onsubmit="return validate();" action="informes_nuevo.php">
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
			<td colspan="2" align="center"><a href="politicas_privacidad.php" target="_blank" style="color:#ff0000;"><strong>He leido y acepto el Aviso de Privacidad</strong></a></td>
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
        <tr>
          <td height="5">&nbsp;</td>
        </tr>
        <tr>
            <td valign="middle" align="center"><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=15&amp;id_program=394&amp;titulo=Los_4_inconmensurables:_Desde_el_sufrimiento,_enviar_felicidad'"><!--img src="../imagenes/banners/banner_rompope_optimizado.jpg" alt="" width="191" height="131" /--></a><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/extras.php'"></a></td>
          </tr>
          <tr>
            <td  align="right" valign="top" >&nbsp;</td>
          </tr>
          <tr>
          <? mysql_select_db($database_otono2011, $otono2011);
$query_banners = "SELECT * FROM banners_lat ORDER BY rand() LIMIT 1";
$banners = mysql_query($query_banners, $otono2011) or die(mysql_error());
$row_banners = mysql_fetch_assoc($banners);?>
        	<td  align="center" valign="top" ><a href="#" onclick="parent.location='<? echo $row_banners['destino']; ?>'"><img src="imagenes/banners/<? echo $row_banners['img_banner']; ?>" width="191" height="131" border="0" align="middle" /></a></td>
          	</tr>
          <tr>
          	<td  align="right" valign="top" >&nbsp;</td>
          	</tr>
          <tr align="center">
            <td ><a onclick="parent.location='http://www.diplomados.uia.mx/propuestas_cursos.php'" href="#"><img src="imagenes/banners/banner_proppuestas.jpg" width="191" height="115" border="0" /></a></td>
          </tr>
          <tr>
            <td  align="right" valign="top" >&nbsp;</td>
          </tr>
        <tr>
            <td valign="bottom" height="130" align="center" style="background: url(imagenes/newsletter.jpg) no-repeat scroll center bottom transparent; "><form action="http://www.dec-uia.com/cgi-bin/dada/mail.cgi" method="post" target="_blank" name="form_news" id="form_news">
                <table width="170" border="0" align="center" cellpadding="5" cellspacing="0">
                  <tbody><tr>
                    <td width="62%" height="82"></td>
                    <td width="38%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="right"><!-- begin subscription_form_widget.tmpl -->
                      
                      <input type="hidden" name="list" value="newsDEC">
                      <input type="hidden" name="f" id="f_s" value="subscribe" checked="checked">
                      <input name="email" type="text" id="email" value="" size="15" class="news_input" placeholder="email"></td>
                    <td align="center"><input onClick="_gaq.push(['_trackEvent', 'Newsletter', 'Click', 'Registro al newsletter']);" type="submit" value="Enviar" class="processing" style="font-size:10px; background:#666; border-radius:5px; color:#FFF; width:50px; border:0px slid #FFF; width:50px;"></td>
                  </tr>
                  <tr>
                    <td height="1"></td>
                  </tr>
                </tbody></table>
              </form></td>
          </tr>
        
      </table>
    </div>
  </div>
  <div id="footer">
    <table width="1019" border="0" cellpadding="0" cellspacing="0" >
      <tr>
        <td width="810"><a onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=14'" href="#"><img src="imagenes/banners/idiomas_otono.jpg" alt="Dos" width="804" height="142" border="0" /></a></td>
        <td width="209" align="center" valign="middle"><a onclick="parent.location='http://www.diplomados.uia.mx/mapa.php'" href="#"><img width="173" height="152" border="0" align="middle" src="imagenes/banners/mapa_horizontal.png"></a></td>
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