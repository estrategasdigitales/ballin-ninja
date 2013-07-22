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
	info_personal = ((isEmpty(form.a_paterno.value) == true) ||
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
	  }?>
<div id="container">
  <div id="header">
    <div id="logos"> <a href="http://uia.mx/" target="_blank"><img src="imagenes/logo_UIA.jpg" alt="logo" width="100" height="78" border="0" class="logo"/></a><a href="ind