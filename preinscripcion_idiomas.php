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
$query_disciplines_names = "SELECT * FROM disciplines ORDER BY discipline ASC";
$disciplines_names = mysql_query($query_disciplines_names, $otono2011) or die(mysql_error());
$row_disciplines_names = mysql_fetch_assoc($disciplines_names);
$totalRows_disciplines_names = mysql_num_rows($disciplines_names);

if($_GET['discipline']==NULL || $_GET['discipline']==0){
	mysql_select_db($database_otono2011, $otono2011);
	$query_diplos_names = "SELECT * FROM site_programs WHERE program_type ='diplomado' ORDER BY program_name ASC";
	$diplos_names = mysql_query($query_diplos_names, $otono2011) or die(mysql_error());
	$row_diplos_names = mysql_fetch_assoc($diplos_names);
	$totalRows_diplos_names = mysql_num_rows($diplos_names);
	
	mysql_select_db($database_otono2011, $otono2011);
	$query_cursos_names = "SELECT * FROM site_programs WHERE program_type ='curso' ORDER BY program_name ASC";
	$cursos_names = mysql_query($query_cursos_names, $otono2011) or die(mysql_error());
	$row_cursos_names = mysql_fetch_assoc($cursos_names);
	$totalRows_cursos_names = mysql_num_rows($cursos_names);
}else{
	$area = $_GET['discipline'];
	mysql_select_db($database_otono2011, $otono2011);
	$query_diplos_names = "SELECT * FROM site_programs WHERE id_discipline = $area AND program_type ='diplomado' ORDER BY program_name ASC";
	$diplos_names = mysql_query($query_diplos_names, $otono2011) or die(mysql_error());
	$row_diplos_names = mysql_fetch_assoc($diplos_names);
	$totalRows_diplos_names = mysql_num_rows($diplos_names);
	
	mysql_select_db($database_otono2011, $otono2011);
	$query_diplos_names_2 = "SELECT * FROM site_programs WHERE id_discipline_alterna != 'NULL' AND program_type ='diplomado' ORDER BY program_name ASC";
	$diplos_names_2 = mysql_query($query_diplos_names_2, $otono2011) or die(mysql_error());
	$row_diplos_names_2 = mysql_fetch_assoc($diplos_names_2);
	$totalRows_diplos_names_2 = mysql_num_rows($diplos_names_2);
	
	mysql_select_db($database_otono2011, $otono2011);
	$query_cursos_names = "SELECT * FROM site_programs WHERE id_discipline = $area AND program_type ='curso' ORDER BY program_name ASC";
	$cursos_names = mysql_query($query_cursos_names, $otono2011) or die(mysql_error());
	$row_cursos_names = mysql_fetch_assoc($cursos_names);
	$totalRows_cursos_names = mysql_num_rows($cursos_names);
	
	mysql_select_db($database_otono2011, $otono2011);
	$query_cursos_names_2 = "SELECT * FROM site_programs WHERE id_discipline_alterna != 'NULL' AND program_type ='curso' ORDER BY program_name ASC";
	$cursos_names_2 = mysql_query($query_cursos_names_2, $otono2011) or die(mysql_error());
	$row_cursos_names_2 = mysql_fetch_assoc($cursos_names_2);
	$totalRows_cursos_names_2 = mysql_num_rows($cursos_names_2);
}

mysql_select_db($database_otono2011, $otono2011);
$query_ad = "SELECT * FROM ads ORDER BY `date` DESC LIMIT 0, 1";
$ad = mysql_query($query_ad, $otono2011) or die(mysql_error());
$row_ad = mysql_fetch_assoc($ad);
$totalRows_ad = mysql_num_rows($ad);

//CODIGO PARA QUE ASIGNE FORMATO LOCAL A LAS FECHAS
setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
//++++++++++++++++++++
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/secciones.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Untitled Document</title>
<script language="javascript" type="text/javascript">

function isEmpty(text) {
		 for ( i = 0; i < text.length; i++ ) {  
				 if ( text.charAt(i) != " " ) {  
						 return false  
				 }  
		 }  
		 return true
 }  

function validate(form){
		
	//Si al menos una de todas los opciones del "checkbox group" fue seleccionada, entonces el resultado será 1 y ya NO entrará al if de faltan campos requeridos.
	comoSeEnteroDelPrograma = true;
	comoSeEnteroDelPrograma = ((form.comoSeEnteroDelPrograma_0.checked != false) ||
								(form.comoSeEnteroDelPrograma_1.checked != false) ||
								(form.comoSeEnteroDelPrograma_2.checked != false) ||
								(form.comoSeEnteroDelPrograma_3.checked != false) ||
								(form.comoSeEnteroDelPrograma_4.checked != false) ||
								(form.comoSeEnteroDelPrograma_5.checked != false) ||
								(isEmpty(form.otromedio.value) == false));
			
	//Si alguno de los campos requeridos de la sección de información personal están en NULL, entonces el resultado será 1 y entrará al if de faltan campos requeridos.
	info_personal = true;
	info_personal = ((isEmpty(form.nivel_idioma.value) == true) ||
					 (isEmpty(form.horario_idioma.value) == true) ||
					 (isEmpty(form.a_paterno.value) == true) ||
					 (isEmpty(form.a_materno.value) == true) ||
					 (isEmpty(form.nombre.value) == true) ||
					 (isEmpty(form.domicilio.value) == true) ||
					 (isEmpty(form.colonia.value) == true) ||
					 (isEmpty(form.del_mpo_pob.value) == true) ||
					 (isEmpty(form.cp.value) == true) ||
					 (isEmpty(form.ciudad.value) == true) ||
					 (isEmpty(form.estado.value) == true) ||
					 (isEmpty(form.rfc.value) == true) ||
					 (isEmpty(form.rfc2.value) == true) ||
					 (isEmpty(form.tel_casa.value) == true) ||
					 (isEmpty(form.email.value) == true) ||
					 (isEmpty(form.nacionalidad.value) == true));	

	//Si alguno de los campos requeridos de la sección de información académidca están en NULL, entonces el resultado será 1 y entrará al if de faltan campos requeridos.
	info_academica = true;
	info_academica = (((form.gradoAcademico_0.checked == false) && (form.gradoAcademico_1.checked == false) && (form.gradoAcademico_2.checked == false) && (form.gradoAcademico_3.checked == false)) ||
					  (isEmpty(form.inst_estudios.value) == true) ||
					  ((form.exAlumnoUIA_0.checked == false) && (form.exAlumnoUIA_1.checked == false)));

	//Si el usuario NO introdujo información a alguno de los campos requeridos.
	if(isEmpty(form.nombre_programa.value) == true || comoSeEnteroDelPrograma == false || info_personal == true || info_academica == true){
		
	   requiredFieldsAlertMsg = "Los siguientes campos son requeridos:\n\n";
	   if(isEmpty(form.nombre_programa.value) == true)
		   requiredFieldsAlertMsg += "* Nombre del Programa\n";
	   if(comoSeEnteroDelPrograma == false)
		   requiredFieldsAlertMsg += "* Cómo se enteró del Programa\n";
	   
	   if(info_personal == true){
		 if(isEmpty(form.nivel_idioma.value) == true)
			requiredFieldsAlertMsg += "* Nivel\n";
		 if(isEmpty(form.horario_idioma.value) == true)
			requiredFieldsAlertMsg += "* Horario\n";
		 if(isEmpty(form.a_paterno.value) == true)
			requiredFieldsAlertMsg += "* Apellido Paterno\n";
		 if(isEmpty(form.a_materno.value) == true)
			requiredFieldsAlertMsg += "* Apellido Materno\n";
		 if(isEmpty(form.nombre.value) == true)
			requiredFieldsAlertMsg += "* Nombre(s)\n";
		 if(isEmpty(form.domicilio.value) == true)
			requiredFieldsAlertMsg += "* Domicilio\n";
		 if(isEmpty(form.colonia.value) == true)
			requiredFieldsAlertMsg += "* Colonia\n";
		 if(isEmpty(form.del_mpo_pob.value) == true)
			requiredFieldsAlertMsg += "* Del./Mpo./Pob.\n";
		 if(isEmpty(form.cp.value) == true)
			requiredFieldsAlertMsg += "* C.P.\n";
		 if(isEmpty(form.ciudad.value) == true)
			requiredFieldsAlertMsg += "* Ciudad\n";
		 if(isEmpty(form.estado.value) == true)
			requiredFieldsAlertMsg += "* Estado\n";
		 if(isEmpty(form.rfc.value) == true)
			requiredFieldsAlertMsg += "* RFC\n";
		 if(isEmpty(form.rfc2.value) == true)
			requiredFieldsAlertMsg += "* RFC: fecha de nacimiento\n";
		 if(isEmpty(form.tel_casa.value) == true)
			requiredFieldsAlertMsg += "* Tel. Casa\n";
		 if(isEmpty(form.email.value) == true)
			requiredFieldsAlertMsg += "* Email\n";
		 if(isEmpty(form.nacionalidad.value) == true)			   
			requiredFieldsAlertMsg += "* Nacionalidad\n";
	   }
	   
	   if(info_academica == true){
			if((form.gradoAcademico_0.checked == false) && (form.gradoAcademico_1.checked == false) && (form.gradoAcademico_2.checked == false) && (form.gradoAcademico_3.checked == false))
				requiredFieldsAlertMsg += "* Grado Académico\n";
			if(isEmpty(form.inst_estudios.value) == true)
				requiredFieldsAlertMsg += "* Institución de Estudios\n";
			if((form.exAlumnoUIA_0.checked == false) && (form.exAlumnoUIA_1.checked == false))
				requiredFieldsAlertMsg += "* Ex alumno UIA\n";
	   }
		
	   alert(requiredFieldsAlertMsg);		  
	   
	   form.nombre_programa.focus();
	   
	   var rfc_field_check = isAlphabet();
	   var rfc_field_check2 = isNumeric();
	   //alert("rfc_field_check: "+rfc_field_check);
	   //alert("rfc_field_check2: "+rfc_field_check2);
	   if(rfc_field_check == false || rfc_field_check2 == false){
		   //alert("alguno de rfc_field_check 1 o 2 regresan false");
		   return false;
		   //return true;
	   }
	   //return false;
		
	}else{
	   //return false;
	   return true;
	   
	}		
}

function isNumeric(){
	var campo = document.getElementById('rfc2');
	var numericExpression = /^[0-9]+$/;
	var data = lengthRestriction(campo);
	if((campo.value.match(numericExpression))&&(data == true)){
		return true;
	}else{
		alert("Ingresa los 6 números de tu fecha de nacimiento (AAMMDD) en la segunda casilla del RFC. Gracias.");
		return false;
	}
}
function isAlphabet(){
	var campo = document.getElementById('rfc');
	var alphaExp = /^[a-zA-Z]+$/;
	var data = lengthRestriction(campo);
	if((campo.value.match(alphaExp))&&(data == true)){
		return true;
	}else{
		alert("Ingresa las dos primera letras de tu apellido paterno, la inicial de tu apellido materno y la inicial de tu nombre en la primer casilla del RFC. Gracias");
		return false;
	}
}
function lengthRestriction(elem){
	var uInput = elem.value;
	if(uInput.length == 4){
		return true;
	}else{
		//alert("Se requieren 4 cracteres.");
		return false;
	}
}	
</script>
<script type="text/JavaScript">
function MM_jumpMenu(targ, selObj, restore){ //v3.0
	//alert("ENTRÉ");
  //eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if(selObj.options[selObj.selectedIndex].value != ""){
	  //alert("ENTRÉ AL IF");
	  eval("location='"+selObj.options[selObj.selectedIndex].value+"'");
	  //alert("location='"+selObj.options[selObj.selectedIndex].value+"'");
	  // lo que necesitamos es hacer la actualización en la misma ventana y no en el parent.
	  if (restore) selObj.selectedIndex=0;
  }
  
}
//-->
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
		  			<td width="71%" height="50" valign="bottom"><p>Formato
		        de Preinscripci&oacute;n</p></td>
	  			  <td width="25%" align="right" valign="top"> - <a style="cursor:pointer; font-size:12px;" onclick="setActiveStyleSheet('img_templ_princ'); return false;">A</a> <a style="cursor:pointer; font-size:14px;" onclick="setActiveStyleSheet('img_templ_princ2'); return false;">A</a> <a style="cursor:pointer; font-size:16px;" onclick="setActiveStyleSheet('img_templ_princ3'); return false;">A</a> + </td>
		  			<td width="4%" rowspan="2">&nbsp;</td>
	  			</tr>
		  		<tr>
		  			<td colspan="2"><p>A trav&eacute;s de este formulario podr&aacute;s iniciar tu proceso de inscripci&oacute;n desde la comodidad de tu casa y/o oficina. Una vez llenado el formato, te contactaremos a la brevedad para darte los pasos a seguir y quedar inscrito en el programa de tu inter&eacute;s.</p></td>
	  			</tr>
		  		<tr>
		  			<td colspan="3">
					<table width="100%" border="0" align="left" cellpadding="2" style="float:left">
<tr>
<td width="90%" height="30" align="left" valign="middle"><p>Si
  deseas pedir informaci&oacute;n sobre alg&uacute;n curso o diplomado, haz click <a style="font-family: Helvetica, Arial, sans-serif; font-size: 12px; color: #F00; text-decoration:none; cursor:pointer;" href="informes.php">aqu&iacute;</a></p></td>
</tr>
<tr>
  <td height="30" align="left" valign="middle" style="font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: #F00; text-decoration:none;"><p><strong>Preinscripci&oacute;n</strong></p></td>
  </tr>
</table>
<!--COMEINZA FORMA DE PRE INSCRIPCION-->
<form id="form1" name="form1" method="post" onsubmit="return validate(this);" action="preinscripcion_exitosa.php">
<!--form id="form1" name="form1" method="post" onsubmit="return validate(this);" action="http://www.dec-uia.com/site/forma_preinscripcion_envia_mail_ss.php"-->
  <table width="100%" border="0" align="left" cellpadding="2" name="pre_table" id="pre_table" style="float:left">
    <tr>
      <td colspan="2" align="left"><p><strong>Nombre del Programa*</strong></p></td>
    </tr>
    <tr>
      <td colspan="2"><label>Área:
        <br />
        <select class="contenido_diplo" name="area_programa_x" id="area_programa_x" onchange="MM_jumpMenu('parent', this, 0);">
          <option value="preinscripcion.php?discipline=0">Todas la áreas</option>
          <?php
        do {  
        ?>
          <option value="preinscripcion.php?discipline=<?php echo $row_disciplines_names['id_discipline']?>" <?php if($row_disciplines_names['id_discipline']==$_GET['discipline']) { ?>selected="selected" <? } ?>><?php echo $row_disciplines_names['discipline']?></option>
          <?php
        } while ($row_disciplines_names = mysql_fetch_assoc($disciplines_names));
          $rows = mysql_num_rows($disciplines_names);
          if($rows > 0) {
              mysql_data_seek($disciplines_names, 0);
              $row_disciplines_names = mysql_fetch_assoc($disciplines_names);
          }
        ?>
          </select>
      </label></td>
    </tr>
    <tr>
      <td colspan="2"><label>Programa:
          <br />
        <select class="contenido_diplo" name="nombre_programa" id="nombre_programa" onchange="MM_jumpMenu('parent', this, 0);">
			<option value="0" selected="selected" disabled="disabled">Selecciona un programa</option>
          <?php
			if($totalRows_diplos_names != 0){ ?>
          <option disabled="disabled">---------------DIPLOMADOS---------------</option>
          <?php do { ?>
          <option value="preinscripcion_idiomas.php?discipline=<?php echo $_GET['discipline']?>&id_program=<?php echo $row_diplos_names['id_program']?>" <? if($_GET['id_program']==$row_diplos_names['id_program']){echo 'selected="selected"';} ?>><?php echo $row_diplos_names['program_name']; ?></option>
          <?php
			} while ($row_diplos_names = mysql_fetch_assoc($diplos_names));
			  $rows_diplos = mysql_num_rows($diplos_names);
			  if($rows_diplos > 0) {
				  mysql_data_seek($diplos_names, 0);
				  $row_diplos_names = mysql_fetch_assoc($diplos_names);
			  }
        }
		if(($totalRows_diplos_names_2 != 0)&&($totalRows_diplos_names == 0)){ ?>
          <option disabled="disabled">---------------DIPLOMADOS---------------</option>
          <? } 
		if($totalRows_diplos_names_2 != 0){
			
			?>
          
          <?php do { 
			
				//Nuevo codigo
				$diplos_disc_alter_array = explode(',',$row_diplos_names_2['id_discipline_alterna']);
			
				for($i = 0; $i < sizeof($diplos_disc_alter_array); $i++){
				
					if($area == $diplos_disc_alter_array[$i]){ ?>
          
          <option value="preinscripcion_idiomas.php?discipline=<?php echo $_GET['discipline']?>&id_program=<?php echo $row_diplos_names_2['id_program']?>" <? if($_GET['id_program']==$row_diplos_names_2['id_program']){echo 'selected="selected"';} ?>><?php echo $row_diplos_names_2['program_name']; ?></option>
          <?php
						}
					}
				} while ($row_diplos_names_2 = mysql_fetch_assoc($diplos_names_2));
				  /*$rows_diplos_2 = mysql_num_rows($diplos_names_2);
				  if($rows_diplos_2 > 0) {
					  mysql_data_seek($diplos_names_2, 0);
					  $row_diplos_names_2 = mysql_fetch_assoc($diplos_names_2);
				  }*/
        }
		if($totalRows_cursos_names != 0){ ?>
          <option disabled="disabled">-----------------CURSOS--------------------</option>
          <?php do { ?>
          <option value="preinscripcion_idiomas.php?discipline=<?php echo $_GET['discipline']?>&id_program=<?php echo $row_cursos_names['id_program']?>" <? if($_GET['id_program']==$row_cursos_names['id_program']){echo 'selected="selected"';} ?>><?php echo $row_cursos_names['program_name']; ?></option>
          <?php
        } while ($row_cursos_names = mysql_fetch_assoc($cursos_names));
          $rows_cursos = mysql_num_rows($cursos_names);
          if($rows_cursos > 0) {
              mysql_data_seek($cursos_names, 0);
              $row_cursos_names = mysql_fetch_assoc($cursos_names);
          }
		}
		if(($totalRows_cursos_names_2 != 0)&&($totalRows_cursos_names == 0)){ ?>
          <option disabled="disabled">-----------------CURSOS--------------------</option>
          <?php }
		if($totalRows_cursos_names_2 != 0){
			do { 
				
				//Nuevo codigo
				$cursos_disc_alter_array = explode(',',$row_cursos_names_2['id_discipline_alterna']);
			
				for($i = 0; $i < sizeof($cursos_disc_alter_array); $i++){
				
					if($area == $cursos_disc_alter_array[$i]){ ?>
          
          <option value="preinscripcion_idiomas.php?discipline=<?php echo $_GET['discipline']?>&id_program=<?php echo $row_cursos_names_2['id_program']?>" <? if($_GET['id_program']==$row_cursos_names_2['id_program']){echo 'selected="selected"';} ?>><?php echo $row_cursos_names_2['program_name']; ?></option>
          <?php
					}
				}
			} while ($row_cursos_names_2 = mysql_fetch_assoc($cursos_names_2));
			  $rows_cursos_2 = mysql_num_rows($cursos_names_2);
			  if($rows_cursos_2 > 0) {
				  mysql_data_seek($cursos_names_2, 0);
				  $row_cursos_names_2 = mysql_fetch_assoc($cursos_names_2);
			  }
			}
        ?>
          </select>
      </label></td>
    </tr>
	<? if($_GET['id_program']!=NULL){ ?>
    <tr>
    	<td colspan="2">
			<label>Nivel:
			  <br />
				<?
				mysql_select_db($database_otono2011, $otono2011);
				$query_fechas_ini = "SELECT id_fecha_idioma, nivel, inicio FROM site_fechas_idiomas WHERE id_program = ".$_GET['id_program'];
				$fechas_ini = mysql_query($query_fechas_ini, $otono2011) or die(mysql_error());
				$row_fechas_ini = mysql_fetch_assoc($fechas_ini);
				$totalRows_fechas_ini = mysql_num_rows($fechas_ini);
				?>
				<select name="nivel_idioma" id="nivel_idioma" onchange="MM_jumpMenu('parent', this, 0);">
					<option value="">Selecciona el nivel</option>
					<? do { ?> 
						<option value="preinscripcion_idiomas.php?discipline=14&id_program=<? echo $_GET['id_program'];?>&id_fecha_idioma=<?php echo $row_fechas_ini['id_fecha_idioma']?>" <? if($row_fechas_ini['id_fecha_idioma'] == $_GET['id_fecha_idioma']){echo 'selected="selected"';}?>><?php echo $row_fechas_ini['nivel'].'. Inicio: '.strftime("%d-%b-%Y", strtotime($row_fechas_ini['inicio'])); ?></option>
						<?php
						
				} while ($row_fechas_ini = mysql_fetch_assoc($fechas_ini)); ?>
				</select>
			</label>
		</td>
    </tr>
    <? } ?>
	<? if($_GET['id_fecha_idioma']!=NULL){ ?>
    <tr>
    	<td colspan="2">
			<label>Horario:
			  <br />
				<?
				mysql_select_db($database_otono2011, $otono2011);
				$query_horario = "SELECT id_fecha_idioma, horario, horario2, horario_mat, horario_vesp FROM site_fechas_idiomas WHERE id_fecha_idioma = ".$_GET['id_fecha_idioma'];
				$horario = mysql_query($query_horario, $otono2011) or die(mysql_error());
				$row_horario = mysql_fetch_assoc($horario);
				$totalRows_horario = mysql_num_rows($horario);
				?>
				<select name="horario_idioma" id="horario_idioma">
					<option value="">Selecciona el horario</option>
					<? if($row_horario['horario']!=NULL){?><option value="<?php echo $_GET['id_program'].','.$row_horario['id_fecha_idioma'].',h1';?>"><?php echo $row_horario['horario']; ?></option><? }?>
					<? if($row_horario['horario2']!=NULL){?><option value="<?php echo $_GET['id_program'].','.$row_horario['id_fecha_idioma'].',h2';?>"><?php echo $row_horario['horario2']; ?></option><? }?>
					<? if($row_horario['horario_mat']!=NULL){?><option value="<?php echo $_GET['id_program'].','.$row_horario['id_fecha_idioma'].',h3';?>"><?php echo $row_horario['horario_mat']; ?></option><? }?>
					<? if($row_horario['horario_vesp']!=NULL){?><option value="<?php echo $_GET['id_program'].','.$row_horario['id_fecha_idioma'].',h4';?>"><?php echo $row_horario['horario_vesp']; ?></option><? }?>
				</select>
			</label>
		</td>
    </tr>
    <? } ?>
	<tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td width="30%" align="right"><p class="contenido_diplo">¿Cómo se enteró del programa? *</p></td>
      <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="50%"><p>
            <label>
              <input type="checkbox" name="comoSeEnteroDelPrograma_0" value="Catálogo" id="comoSeEnteroDelPrograma_0" />
              Cat&aacute;logo</label>
          </p></td>
          <td width="50%"><p>
            <label>
              <input type="checkbox" name="comoSeEnteroDelPrograma_1" value="Internet" id="comoSeEnteroDelPrograma_1" />
              Internet</label>
          </p></td>
        </tr>
        <tr>
          <td width="50%"><p>
            <label>
              <input type="checkbox" name="comoSeEnteroDelPrograma_2" value="Periódico" id="comoSeEnteroDelPrograma_2" />
              Peri&oacute;dico</label>
          </p></td>
          <td width="50%"><p>
            <label>
              <input type="checkbox" name="comoSeEnteroDelPrograma_3" value="Revista" id="comoSeEnteroDelPrograma_3" />
              Revista</label>
          </p></td>
        </tr>
        <tr>
          <td width="50%"><label>
            <input type="checkbox" name="comoSeEnteroDelPrograma_4" value="Recomendación" id="comoSeEnteroDelPrograma_4" />
            Recomendaci&oacute;n
          </label></td>
          <td width="50%"><p>
            <label>
              <input type="checkbox" name="comoSeEnteroDelPrograma_5" value="Email" id="comoSeEnteroDelPrograma_5" />
              Email</label>
          </p></td>
        </tr>
        <tr>
          <td colspan="2"><span class="contenido_diplo">
            <label>Otro:
              <input name="otromedio" type="text" id="otromedio" size="26" />
            </label>
          </span></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="50" colspan="2" align="center"><p><strong>Informaci&oacute;n
        Personal</strong></p></td>
    </tr>
    <tr>
      <td width="30%" align="right"><p>A. Paterno *</p></td>
      <td><input name="a_paterno" type="text" id="a_paterno" size="30" /></td>
    </tr>
    <tr>
      <td width="30%" align="right"><p>A. Materno *</p></td>
      <td><input name="a_materno" type="text" id="a_materno" size="30" /></td>
    </tr>
    <tr>
      <td width="30%" align="right"><p>Nombre(s) *</p></td>
      <td><input name="nombre" type="text" id="nombre" size="30" /></td>
    </tr>
    <tr>
      <td width="30%" align="right"><p>Domicilio *</p></td>
      <td><input name="domicilio" type="text" id="domicilio" size="30" /></td>
    </tr>
    <tr>
      <td width="30%" align="right"><p> Colonia *</p></td>
      <td><input name="colonia" type="text" id="colonia" size="30" /></td>
    </tr>
    <tr>
      <td width="30%" align="right"><p>Del./ Mpo. / Poblaci&oacute;n
          *</p></td>
      <td><input name="del_mpo_pob" type="text" id="del_mpo_pob" size="30" /></td>
    </tr>
    <tr>
      <td width="30%" align="right"><p>C.P. *</p></td>
      <td><input name="cp" type="text" id="cp" size="30" /></td>
    </tr>
    <tr>
      <td width="30%" align="right"><p>Ciudad *</p></td>
      <td><input name="ciudad" type="text" id="ciudad" size="30" /></td>
    </tr>
    <tr>
      <td width="30%" align="right"><p>Estado *</p></td>
      <td><input name="estado" type="text" id="estado" size="30" /></td>
    </tr>
    <tr>
      <td width="30%" align="right" valign="top"><p>RFC personal *</p></td>
      <td><p>
        <input name="rfc" type="text" id="rfc" size="4" maxlength="4" />
        <input name="rfc2" type="text" id="rfc2" size="6" maxlength="6" />
        <input name="rfc3" type="text" id="rfc3" size="3" maxlength="3" /> 
        <br />*Si cuentas con homoclave, favor de proporcionarla. Gracias.</p></td>
    </tr>
    <tr>
      <td width="30%" align="right"><p>Tel. casa *</p></td>
      <td><input name="tel_casa" type="text" id="tel_casa" size="30" /></td>
    </tr>
    <tr>
      <td width="30%" align="right"><p>Fax</p></td>
      <td><input name="fax" type="text" id="fax" size="30" /></td>
    </tr>
    <tr>
      <td width="30%" align="right"><p>Celular</p></td>
      <td><input name="cel" type="text" id="cel" size="30" /></td>
    </tr>
    <tr>
      <td width="30%" align="right"><p>E-Mail *</p></td>
      <td><input name="email" type="text" id="email" size="30" /></td>
    </tr>
    <tr>
      <td width="30%" align="right"><p>Nacionalidad *</p></td>
      <td><input name="nacionalidad" type="text" id="nacionalidad" size="30" /></td>
    </tr>
    <tr>
      <td width="30%" align="right"><p>Estado civil</p></td>
      <td><input name="edo_civil" type="text" id="edo_civil" size="30" /></td>
    </tr>
    <tr>
      <td height="50" colspan="2" align="center"><p><strong>Informaci&oacute;n
          Acad&eacute;mica</strong></p></td>
    </tr>
    <tr>
      <td align="right"><p>Nivel acad&eacute;mico
          *</p></td>
      <td><table width="100%">
        <tr>
          <td><p>
            <label>
              <input type="radio" name="gradoAcademico" value="Preparatoria" id="gradoAcademico_0" />
              Preparatoria</label>
          </p></td>
          <td><p>
            <label>
              <input type="radio" name="gradoAcademico" value="Maestría" id="gradoAcademico_1" />
              Maestr&iacute;a</label>
          </p></td>
        </tr>
        <tr>
          <td><p>
            <label>
              <input type="radio" name="gradoAcademico" value="Licenciatura" id="gradoAcademico_2" />
              Licenciatura</label>
          </p></td>
          <td><p>
            <label>
              <input type="radio" name="gradoAcademico" value="Doctorado" id="gradoAcademico_3" />
              Doctorado</label>
          </p></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td align="right"><p>Instituci&oacute;n de estudios *</p></td>
      <td><input name="inst_estudios" type="text" id="inst_estudios" size="30" /></td>
    </tr>
    <tr>
      <td align="right"><p>¿Porqué elegiste a la Ibero?</p></td>
      <td><textarea name="porque_elegiste_a_la_ibero" id="porque_elegiste_a_la_ibero" cols="30" rows="5"></textarea></td>
    </tr>
    <tr>
      <td align="right"><p>¿Ex alumno UIA? *</p></td>
      <td><table width="200">
        <tr>
          <td><label>
            <input type="radio" name="exAlumnoUIA" value="Si" id="exAlumnoUIA_0" />
            Si</label></td>
        </tr>
        <tr>
          <td><label>
            <input type="radio" name="exAlumnoUIA" value="No" id="exAlumnoUIA_1" />
            No</label></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="50" colspan="2" align="center"><p>Informaci&oacute;n
          Laboral</p></td>
    </tr>
    <tr>
      <td align="right"><p>Empresa</p></td>
      <td><input name="empresa" type="text" id="empresa" size="30" /></td>
    </tr>
    <tr>
      <td align="right"><p>Depto.</p></td>
      <td><input name="empresa_depto" type="text" id="empresa_depto" size="30" /></td>
    </tr>
    <tr>
      <td align="right"><p>Puesto</p></td>
      <td><input name="empresa_puesto" type="text" id="empresa_puesto" size="30" /></td>
    </tr>
    <tr>
      <td align="right"><p>Direcci&oacute;n</p></td>
      <td><input name="empresa_direccion" type="text" id="empresa_direccion" size="30" /></td>
    </tr>
    <tr>
      <td align="right"><p>Colonia</p></td>
      <td><input name="empresa_colonia" type="text" id="empresa_colonia" size="30" /></td>
    </tr>
    <tr>
      <td align="right"><p>Del. / Mpo. / Poblaci&oacute;n</p></td>
      <td><input name="empresa_del_mpo_pob" type="text" id="empresa_del_mpo_pob" size="30" /></td>
    </tr>
    <tr>
      <td align="right"><p>C.P.</p></td>
      <td><input name="empresa_cp" type="text" id="empresa_cp" size="30" /></td>
    </tr>
    <tr>
      <td align="right"><p>Ciudad</p></td>
      <td><input name="empresa_ciudad" type="text" id="empresa_ciudad" size="30" /></td>
    </tr>
    <tr>
      <td align="right"><p>Estado</p></td>
      <td><input name="empresa_estado" type="text" id="empresa_estado" size="30" /></td>
    </tr>
    <tr>
      <td align="right"><p>Tel&eacute;fono</p></td>
      <td><input name="empresa_tel" type="text" id="empresa_tel" size="30" /></td>
    </tr>
    <tr>
      <td align="right"><p>Fax</p></td>
      <td><input name="empresa_fax" type="text" id="empresa_fax" size="30" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="left">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="left"><input type="submit" name="enviar" id="enviar" value="Enviar" onclick="document.body.style.cursor='wait';" /></td>
    </tr>
  </table>
  <input type="hidden" name="area_programa" id="area_programa" value="<?php echo $area; ?>" />
</form>
<!--FINALIZA FORMA DE PREINSCRIPCION-->
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
