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
          <p class="header_disciplinas">Oferta Acad�mica </p>
          <ul>
            <li> <a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=1'">Arquitectura </a></li>
            <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=2'"> Arte</a></li>
            <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=3'"> Dise�o</a></li>
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
            <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=23'">Oferta Acad�mica</a></li>
          </ul>
          <h4>Centros de Atenci�n Especializada</h4>
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
		  <?php
                    
			//La validaci�n se realiz� en el cliente, al llegar aqu� ya solo se prepara y env�a el mail
		
			//Informaci�n del Programa	
			mysql_select_db($database_otono2011, $otono2011);
			$query_diplos_names = "SELECT * FROM site_programs WHERE id_program = ".$_POST['nombre_programa'];
			$diplos_names = mysql_query($query_diplos_names, $otono2011) or die(mysql_error());
			$row_diplos_names = mysql_fetch_assoc($diplos_names);
			$totalRows_diplos_names = mysql_num_rows($diplos_names);
			
			if($_POST['area_programa']==0){
				$area_programa = $row_diplos_names['id_discipline'];
			}else{
				$area_programa = $_POST['area_programa'];
			}
			mysql_select_db($database_otono2011, $otono2011);
			$query_disciplines_names = "SELECT * FROM disciplines WHERE id_discipline = $area_programa";
			$disciplines_names = mysql_query($query_disciplines_names, $otono2011) or die(mysql_error());
			$row_disciplines_names = mysql_fetch_assoc($disciplines_names);
			$totalRows_disciplines_names = mysql_num_rows($disciplines_names);
			
			mysql_select_db($database_otono2011, $otono2011);
			$query_coord_mails = "SELECT * FROM ss_users WHERE id_user IN(SELECT id_user FROM ss_users_disciplines WHERE id_discipline = $area_programa) AND id_access = 3";
			$coord_mails = mysql_query($query_coord_mails, $otono2011) or die(mysql_error());
			$row_coord_mails = mysql_fetch_assoc($coord_mails);
			$totalRows_coord_mails = mysql_num_rows($coord_mails);
			
			$area_programa=$row_disciplines_names['discipline'];
			$nombre_programa=$row_diplos_names['program_type']." - ".$row_diplos_names['program_name'];
			$how="";
			$comoSeEnteroDelPrograma_0=$_POST['comoSeEnteroDelPrograma_0'];
			$comoSeEnteroDelPrograma_1=$_POST['comoSeEnteroDelPrograma_1'];
			$comoSeEnteroDelPrograma_2=$_POST['comoSeEnteroDelPrograma_2'];
			$comoSeEnteroDelPrograma_3=$_POST['comoSeEnteroDelPrograma_3'];
			$comoSeEnteroDelPrograma_4=$_POST['comoSeEnteroDelPrograma_4'];
			$comoSeEnteroDelPrograma_5=$_POST['comoSeEnteroDelPrograma_5'];
			$otro_medio=$_POST['otromedio'];
			
			//Informaci�n Personal
			
			$a_paterno=$_POST['a_paterno'];
			$a_materno=$_POST['a_materno'];
			$nombre=$_POST['nombre'];
			$domicilio=$_POST['domicilio'];
			$colonia=$_POST['colonia'];
			$del_mpo_pob=$_POST['del_mpo_pob'];
			$cp=$_POST['cp'];
			$ciudad=$_POST['ciudad'];
			$estado=$_POST['estado'];
			$rfc=$_POST['rfc'].$_POST['rfc2'].$_POST['rfc3'];
			$tel_casa=$_POST['tel_casa'];
			$fax=$_POST['fax'];
			$cel=$_POST['cel'];
			$email=$_POST['email'];
			$nacionalidad=$_POST['nacionalidad'];
			$edo_civil=$_POST['edo_civil'];
			
			//Informaci�n Acad�mica
			
			$gradoAcademico=$_POST['gradoAcademico'];
			$inst_estudios=$_POST['inst_estudios'];
			$porque_elegiste_a_la_ibero=$_POST['porque_elegiste_a_la_ibero'];
			$exAlumnoUIA=$_POST['exAlumnoUIA'];
			
			//Informacion Laboral
			
			$empresa=$_POST['empresa'];
			$empresa_depto=$_POST['empresa_depto'];
			$empresa_puesto=$_POST['empresa_puesto'];
			$empresa_direccion=$_POST['empresa_direccion'];
			$empresa_colonia=$_POST['empresa_colonia'];
			$empresa_del_mpo_pob=$_POST['empresa_del_mpo_pob'];
			$empresa_cp=$_POST['empresa_cp'];
			$empresa_ciudad=$_POST['empresa_ciudad'];
			$empresa_estado=$_POST['empresa_estado'];
			$empresa_tel=$_POST['empresa_tel'];
			$empresa_fax=$_POST['empresa_fax'];
		
			/*CONSTRUCCION DEL MENSJAE PARA ENVIAR EN EL MAIL*/
		
			$mensaje="<b>&Aacute;rea:</b> $area_programa<br />";
			$mensaje.="<b>Nombre del programa:</b> $nombre_programa<br />";
			$mensaje.="<b>Se enter� del programa atrav�s de:</b><br />";
			
			if($comoSeEnteroDelPrograma_0 != NULL)
			{
				$mensaje.="* $comoSeEnteroDelPrograma_0<br />";
				$how .= " " . $comoSeEnteroDelPrograma_0;
			}	
			if($comoSeEnteroDelPrograma_1 != NULL) 
			{
				$mensaje.="* $comoSeEnteroDelPrograma_1<br />";
				$how .= " " . $comoSeEnteroDelPrograma_1;
			}
			if($comoSeEnteroDelPrograma_2 != NULL) 
			{
				$mensaje.="* $comoSeEnteroDelPrograma_2<br />";
				$how .= " " . $comoSeEnteroDelPrograma_2;
			}
			if($comoSeEnteroDelPrograma_3 != NULL) 
			{
				$mensaje.="* $comoSeEnteroDelPrograma_3<br />";
				$how .= " " . $comoSeEnteroDelPrograma_3;
			}
			if($comoSeEnteroDelPrograma_4 != NULL) 
			{
				$mensaje.="* $comoSeEnteroDelPrograma_4<br />";
				$how .= " " . $comoSeEnteroDelPrograma_4;
			}
			if($comoSeEnteroDelPrograma_5 != NULL) 
			{
				$mensaje.="* $comoSeEnteroDelPrograma_5<br />";
				$how .= " " . $comoSeEnteroDelPrograma_5;
			}
			if($otro_medio != NULL) 
			{
				$mensaje.="* $otro_medio<br />";
				$how .= " " . $otro_medio;
			}
			$mensaje.="<br /><b>Informaci�n Personal:</b><br /><br />";
			$mensaje.="<b>A. Paterno:</b> $a_paterno<br />";
			$mensaje.="<b>A. Materno:</b> $a_materno<br />";
			$mensaje.="<b>Nombre:</b> $nombre<br />";
			$mensaje.="<b>Domicilio:</b> $domicilio<br />";
			$mensaje.="<b>Colonia:</b> $colonia<br />";
			$mensaje.="<b>Del./Mpo./Poblaci�n:</b> $del_mpo_pob<br />";
			$mensaje.="<b>C.P.:</b> $cp<br />";
			$mensaje.="<b>Ciudad:</b> $ciudad<br />";
			$mensaje.="<b>Estado:</b> $estado<br />";
			$mensaje.="<b>RFC:</b> $rfc<br />";
			$mensaje.="<b>Tel. casa:</b> $tel_casa<br />";
			$mensaje.="<b>fax:</b> $fax<br />";
			$mensaje.="<b>Cel:</b> $cel<br />";
			$mensaje.="<b>Email:</b> $email<br />";
			$mensaje.="<b>Nacionalidad:</b> $nacionalidad<br />";
			$mensaje.="<b>Edo. Civil:</b> $edo_civil<br />";
			
			$mensaje.="<br /><b>Informaci�n Acad�mica:</b><br /><br />";
			$mensaje.="<b>Grado acad�mico:</b> $gradoAcademico<br />";
			$mensaje.="<b>Instituci�n de estudios:</b> $inst_estudios<br />";
			$mensaje.="<b>Porqu� eligi� a la Ibero:</b> $porque_elegiste_a_la_ibero<br />";
			$mensaje.="<b>Ex Alumno UIA:</b> $exAlumnoUIA<br />";
			
			$mensaje.="<br /><b>Informaci�n Laboral:</b><br /><br />";
			$mensaje.="<b>Empresa:</b> $empresa<br />";
			$mensaje.="<b>Depto.:</b> $empresa_depto<br />";
			$mensaje.="<b>Puesto:</b> $empresa_puesto<br />";
			$mensaje.="<b>Direcci�n:</b> $empresa_direccion<br />";
			$mensaje.="<b>Del./Mpo./Poblaci�n:</b> $empresa_del_mpo_pob<br />";
			$mensaje.="<b>C.P.:</b> $empresa_cp<br />";
			$mensaje.="<b>Ciudad:</b> $empresa_ciudad<br />";
			$mensaje.="<b>Estado:</b> $empresa_estado<br />";
			$mensaje.="<b>Tel�fono:</b> $empresa_tel<br />";
			$mensaje.="<b>Fax:</b> $empresa_fax<br /><br /><br />";
			$mensaje.="<b>Como:</b> $how<br /><br /><br />";
			
			$headers = "From: " . strip_tags($email) . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";					
			
			//echo "ANTES: " . $mensaje;
		
			$mensaje = str_replace("�", "&aacute;", $mensaje);
			$mensaje = str_replace("�", "&eacute;", $mensaje);
			$mensaje = str_replace("�", "&iacute;", $mensaje);
			$mensaje = str_replace("�", "&oacute;", $mensaje);
			$mensaje = str_replace("�", "&uacute;", $mensaje);
			$mensaje = str_replace("�", "&ntilde;", $mensaje);
			$mensaje = str_replace("�", "&Ntilde;", $mensaje);
		
			//echo "DESPUES: " . $mensaje;
			
			$mail_title = "DEC - Preinscripci�n";
								
			//mail("pvazquezdiaz@gmail.com", $mail_title, $mensaje, $headers);
			//mail("erika.medina@uia.mx", $mail_title, $mensaje, $headers);
			//mail("jorge@estrategasdigitales.com", $mail_title, $mensaje, $headers);
			//mail("jlaa2774@hotmail.com", utf8_decode($mail_title), $mensaje, $headers);
			do {
			$to_coord = $row_coord_mails['email'];
			$mensaje_coord .= "<br /><br />";
			$mensaje_coord = "Tienes un nuevo preinscrito en el <strong>".$nombre_programa."</strong>";
			$mensaje_coord .= "<br /><br />";
			$mensaje_coord .= "Para darle seguimiento visita la siguiente liga:";
			$mensaje_coord .= "<br /><br />";
			$mensaje_coord .= "<a href='http://www.dec-uia.com/s_seguimiento/' target='_blank'>http://www.dec-uia.com/s_seguimiento/</a>";
			$mensaje_coord .= "<br /><br />donde podr�s llevar paso a paso el proceso de inscripci�n y tener un f�cil acceso a la informaci�n del usuario.";
			$mensaje_coord .= "<br /><br />Tu nombre de usuario es: <strong>".$row_coord_mails['username']."</strong>";
			$mensaje_coord .= "<br /><br />Tu contrase�a: <strong>".$row_coord_mails['password']."</strong>";
			mail($to_coord, $mail_title, $mensaje_coord, $headers);
			} while($row_coord_mails = mysql_fetch_assoc($coord_mails));
			
			$mensaje_lic .= "<br /><br />";
			$mensaje_lic = "Tienes un nuevo preinscrito en el <strong>".$nombre_programa."</strong>";
			$mensaje_lic .= "<br /><br />";
			$mensaje_lic .= "Para darle seguimiento visita la siguiente liga:";
			$mensaje_lic .= "<br /><br />";
			$mensaje_lic .= "<a href='http://www.dec-uia.com/s_seguimiento/' target='_blank'>http://www.dec-uia.com/s_seguimiento/</a>";
			$mensaje_lic .= "<br /><br />donde podr�s llevar paso a paso el proceso de inscripci�n y tener un f�cil acceso a la informaci�n del usuario.";
			$mensaje_lic .= "<br /><br />Tu nombre de usuario es: <strong>master_admin</strong>";
			$mensaje_lic .= "<br /><br />Tu contrase�a: <strong>SS_dec_uia2011</strong>";
			//mail("pavel@estrategasdigitales.com", $mail_title, $mensaje_lic, $headers);
			//mail("erika.medina@uia.mx", $mail_title, $mensaje_temp, $headers);
			$mensaje_user = 'Tu preinscripci�n al '.$nombre_programa.' ha sido recibida';
			$mensaje_user .= '<br /><br />En breve nos comunicaremos contigo.';
			$mensaje_user .= '<br /><br />Gracias.';
			$mensaje_user .= '<br /><br />';
			$mensaje_user .= '<br /><br />Direcci�n de Educaci�n Continua - Universidad Iberoamericana Campus Santa Fe.';
			$headers = "From: " . strip_tags($to_coord) . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			mail($email, 'Te has preinscrito exitosamente.', $mensaje_user, $headers);
			//mail("pavel@estrategasdigitales.com", $mail_title, $mensaje_user, $headers);
			
			
			
			$insertSQL = sprintf("INSERT INTO ss_preregistration (id_program, how_you_know, paternal_last_name, maternal_last_name, first_name, address, neighborhood, delegation, zip_code, city, `state`, rfc, home_phone, fax, cell_phone, email, nationality, civil_status, degree, school, name_in_diploma, old_student, company, company_dep, company_job_position, company_address, company_neighborhood, company_area, company_zip_code, company_city, company_state, company_phone, company_fax) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
							   GetSQLValueString($_POST['nombre_programa'], "int"),
							   GetSQLValueString($how, "text"),
							   GetSQLValueString($a_paterno, "text"),
							   GetSQLValueString($a_materno, "text"),
							   GetSQLValueString($nombre, "text"),
							   GetSQLValueString($domicilio, "text"),
							   GetSQLValueString($colonia, "text"),
							   GetSQLValueString($del_mpo_pob, "text"),
							   GetSQLValueString($cp, "int"),
							   GetSQLValueString($ciudad, "text"),
							   GetSQLValueString($estado, "text"),
							   GetSQLValueString($rfc, "text"),
							   GetSQLValueString($tel_casa, "text"),
							   GetSQLValueString($fax, "text"),
							   GetSQLValueString($cel, "text"),
							   GetSQLValueString($email, "text"),
							   GetSQLValueString($nacionalidad, "text"),
							   GetSQLValueString($edo_civil, "text"),
							   GetSQLValueString($gradoAcademico, "text"),
							   GetSQLValueString($inst_estudios, "text"),
							   GetSQLValueString($porque_elegiste_a_la_ibero, "text"),
							   GetSQLValueString($exAlumnoUIA, "text"),
							   GetSQLValueString($empresa, "text"),
							   GetSQLValueString($empresa_depto, "text"),
							   GetSQLValueString($empresa_puesto, "text"),
							   GetSQLValueString($empresa_direccion, "text"),
							   GetSQLValueString($empresa_colonia, "text"),
							   GetSQLValueString($empresa_del_mpo_pob, "text"),
							   GetSQLValueString($empresa_cp, "int"),
							   GetSQLValueString($empresa_ciudad, "text"),
							   GetSQLValueString($empresa_estado, "text"),
							   GetSQLValueString($empresa_tel, "text"),
							   GetSQLValueString($empresa_fax, "text"));
		
			  
		  mysql_select_db($database_otono2011, $otono2011);
		  $Result1 = mysql_query($insertSQL, $otono2011) or die(mysql_error());
			//para mandar el mail en texto plano.
			//mail("erika.medina@uia.mx", "DEC - Preinscripci�n", $mensaje, "FROM:$email");
		?>
		<table width="94%" border="0" align="center" cellpadding="4" cellspacing="0">
		  <tr>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td align="center"><p>Gracias, hemos recibido tu informaci&oacute;n
			  satisfactoriamente, <br />
			  a la brevedad  te estaremos contactando.</p>
			  <p>Te enviaremos la informaci&oacute;n pertinente para completar tu proceso
			  de inscripci&oacute;n a tu correo electr&oacute;nico,<br />
			  no olvides revisar tu carpeta de SPAM o Correo no deseado.</p>
			  <p>&nbsp;</p>
			  <p><input type="button" onclick="window.location='http://www.dec-uia.com/otono_2011/preinscripcion.php'" value="Regresar" /></p></td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
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
            de M�xico. </strong><br>
          </p>
          <address>
          Prol. Paseo de la Reforma 880, edificio G, P.B.
          Lomas de Santa Fe, M�xico, C.P. 01219, Distrito Federal. <br>
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