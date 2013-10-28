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
	//La validación se realizò en el cliente, al llegar aquí ya solo se prepara y envía el mail
//Informaciòn del Programa	
if($_POST['fechas_ini']!=NULL){
	$fecha_temp = explode(',',$_POST['fechas_ini']);
	$id_program = $_POST['id_program'];
	$fecha_ini = $fecha_temp[1];
}else{
	$fecha_ini = $_POST['fechas_ini'];
	$id_program = $_POST['id_program'];
}

if($_POST['horario_idioma']!=NULL){
	$idioma_temp = explode(',',$_POST['horario_idioma']);
	$id_program = $_POST['id_program'];
	$nivel_idioma = $idioma_temp[1];
	$horario_idioma = $idioma_temp[2];
}else{
	$id_program = $_POST['id_program'];
}

$id_program = $_POST['id_program'];

mysql_select_db($database_otono2011, $otono2011);
$query_diplos_names = "SELECT * FROM site_programs WHERE id_program = '".$id_program."'";
$diplos_names = mysql_query($query_diplos_names, $otono2011) or die(mysql_error());
$row_diplos_names = mysql_fetch_assoc($diplos_names);
$totalRows_diplos_names = mysql_num_rows($diplos_names);

//if($_POST['area_programa']==0 || $_POST['area_programa']==NULL){
$area_programa = $row_diplos_names['id_discipline'];
//}else{
	//$area_programa = $_POST['area_programa'];
//}
mysql_select_db($database_otono2011, $otono2011);
$query_disciplines_names = "SELECT * FROM disciplines WHERE id_discipline = '".$area_programa."'";
$disciplines_names = mysql_query($query_disciplines_names, $otono2011) or die(mysql_error());
$row_disciplines_names = mysql_fetch_assoc($disciplines_names);
$totalRows_disciplines_names = mysql_num_rows($disciplines_names);

mysql_select_db($database_otono2011, $otono2011);
$query_coord_mails = "SELECT * FROM ss_users WHERE id_user IN(SELECT id_user FROM ss_users_disciplines WHERE id_discipline = '".$area_programa."') AND id_access = 3";
$coord_mails = mysql_query($query_coord_mails, $otono2011) or die(mysql_error());
$row_coord_mails = mysql_fetch_assoc($coord_mails);
$totalRows_coord_mails = mysql_num_rows($coord_mails);

//Informacion del curso seleccionado

$nombre_area = $row_disciplines_names['discipline'];
$nombre_programa = $row_diplos_names['program_type']." - ".$row_diplos_names['program_name'];

if($_POST['how_you_know']==NULL){
	$how = $_POST['otromedio'];
}else{
	$how = $_POST['how_you_know'];
}

/*$comoSeEnteroDelPrograma_0=$_POST['comoSeEnteroDelPrograma_0'];
$comoSeEnteroDelPrograma_1=$_POST['comoSeEnteroDelPrograma_1'];
$comoSeEnteroDelPrograma_2=$_POST['comoSeEnteroDelPrograma_2'];
$comoSeEnteroDelPrograma_3=$_POST['comoSeEnteroDelPrograma_3'];
$comoSeEnteroDelPrograma_4=$_POST['comoSeEnteroDelPrograma_4'];
$comoSeEnteroDelPrograma_5=$_POST['comoSeEnteroDelPrograma_5'];*/

//Información Personal

$a_paterno = $_POST['a_paterno'];
$a_materno = $_POST['a_materno'];
$nombre = $_POST['nombre'];
$domicilio = $_POST['domicilio'];
$colonia = $_POST['colonia'];
$del_mpo_pob = $_POST['del_mpo_pob'];
$cp = $_POST['cp'];
$ciudad = $_POST['ciudad'];
$estado = $_POST['estado'];
$rfc = $_POST['rfc'].$_POST['rfc2'].$_POST['rfc3'];
$tel_casa = $_POST['tel_casa'];
$fax = $_POST['fax'];
$cel = $_POST['cel'];
$email = $_POST['email'];
$nacionalidad = $_POST['nacionalidad'];
$edo_civil = $_POST['edo_civil'];

//Información Académica

$gradoAcademico = $_POST['gradoAcademico'];
$inst_estudios = $_POST['inst_estudios'];
$porque_elegiste_a_la_ibero = $_POST['porque_elegiste_a_la_ibero'];
$exAlumnoUIA = $_POST['exAlumnoUIA'];

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



$insertSQL = sprintf("INSERT INTO ss_preregistration (
id_program,
id_fecha,
id_fecha_idioma,
fecha_idioma_hor,
how_you_know,
paternal_last_name,
maternal_last_name,
first_name,
address,
neighborhood,
delegation,
zip_code,
city,
state,
rfc,
home_phone,
fax,
cell_phone,
email,
nationality,
civil_status,
degree,
school,
name_in_diploma,
old_student,
company,
company_dep,
company_job_position,
company_address,
company_neighborhood,
company_area,
company_zip_code,
company_city,
company_state,
company_phone,
company_fax)
VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
   GetSQLValueString($id_program, "int"),
   GetSQLValueString($fecha_ini, "int"),
   GetSQLValueString($nivel_idioma, "int"),
   GetSQLValueString($horario_idioma, "text"),
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

try{
	
	$Result1 = mysql_query($insertSQL, $otono2011);
	
	/*CONSTRUCCION DEL MENSJAE PARA ENVIAR EN EL MAIL*/

	$mensaje="<strong>&Aacute;rea:</strong> ".$nombre_area."<br />";
	$mensaje.="<strong>Nombre del programa:</strong> ".$nombre_programa."<br />";
	$mensaje.="<strong>Se enteró del programa através de:</strong><br />";
	
	if($how != NULL)
	{
		$mensaje.= $how."<br />";
	}
	
	if($otro_medio != NULL) 
	{
		$mensaje.="Otro medio: ".$otro_medio."<br />";
	}
	
	$mensaje.="<br /><strong>Información Personal:</strong><br /><br />";
	$mensaje.="<strong>A. Paterno:</strong> ".$a_paterno."<br />";
	$mensaje.="<strong>A. Materno:</strong> ".$a_materno."<br />";
	$mensaje.="<strong>Nombre:</strong> ".$nombre."<br />";
	$mensaje.="<strong>Fecha de nacimiento:</strong> ".$_POST['dia_nac']."-".$_POST['mes_nac']."-".$_POST['anio_nac']."<br />";
	$mensaje.="<strong>Domicilio:</strong> ".$domicilio."<br />";
	$mensaje.="<strong>Colonia:</strong> ".$colonia."<br />";
	$mensaje.="<strong>Del./Mpo./Población:</strong> ".$del_mpo_pob."<br />";
	$mensaje.="<strong>C.P.:</strong> ".$cp."<br />";
	$mensaje.="<strong>Ciudad:</strong> ".$ciudad."<br />";
	$mensaje.="<strong>Estado:</strong> ".$estado."<br />";
	$mensaje.="<strong>RFC:</strong> ".$rfc."<br />";
	$mensaje.="<strong>Tel. casa:</strong> ".$tel_casa."<br />";
	$mensaje.="<strong>fax:</strong> ".$fax."<br />";
	$mensaje.="<strong>Cel:</strong> ".$cel."<br />";
	$mensaje.="<strong>Email:</strong> ".$email."<br />";
	$mensaje.="<strong>Nacionalidad:</strong> ".$nacionalidad."<br />";
	$mensaje.="<strong>Edo. Civil:</strong> ".$edo_civil."<br />";
	
	$mensaje.="<br /><strong>Información Académica:</strong><br /><br />";
	$mensaje.="<strong>Grado académico:</strong> ".$gradoAcademico."<br />";
	$mensaje.="<strong>Institución de estudios:</strong> ".$inst_estudios."<br />";
	$mensaje.="<strong>Porqué eligió a la Ibero:</strong> ".$porque_elegiste_a_la_ibero."<br />";
	$mensaje.="<strong>Ex Alumno UIA:</strong> ".$exAlumnoUIA."<br />";
	
	$mensaje.="<br /><strong>Información Laboral:</strong><br /><br />";
	$mensaje.="<strong>Empresa:</strong> ".$empresa."<br />";
	$mensaje.="<strong>Depto.:</strong> ".$empresa_depto."<br />";
	$mensaje.="<strong>Puesto:</strong> ".$empresa_puesto."<br />";
	$mensaje.="<strong>Dirección:</strong> ".$empresa_direccion."<br />";
	$mensaje.="<strong>Del./Mpo./Población:</strong> ".$empresa_del_mpo_pob."<br />";
	$mensaje.="<strong>C.P.:</strong> ".$empresa_cp."<br />";
	$mensaje.="<strong>Ciudad:</strong> ".$empresa_ciudad."<br />";
	$mensaje.="<strong>Estado:</strong> ".$empresa_estado."<br />";
	$mensaje.="<strong>Teléfono:</strong> ".$empresa_tel."<br />";
	$mensaje.="<strong>Fax:</strong> ".$empresa_fax."<br /><br /><br />";
	
	$headers = "From: " . strip_tags($email) . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";	
	$headers .= 'Cc: pavel@estrategasdigitales.com, webmaster@dec-uia.com' . "\r\n";				
	
	//echo "ANTES: " . $mensaje;
	
	$mensaje = str_replace("á", "&aacute;", $mensaje);
	$mensaje = str_replace("é", "&eacute;", $mensaje);
	$mensaje = str_replace("í", "&iacute;", $mensaje);
	$mensaje = str_replace("ó", "&oacute;", $mensaje);
	$mensaje = str_replace("ú", "&uacute;", $mensaje);
	$mensaje = str_replace("ñ", "&ntilde;", $mensaje);
	$mensaje = str_replace("Ñ", "&Ntilde;", $mensaje);
	
	//echo "DESPUES: " . $mensaje;
	
	$mail_title = "DEC - Preinscripción";
						
	mail("dec.ibero@gmail.com", $mail_title, $mensaje, $headers);
	//mail("erika.medina@uia.mx", $mail_title, $mensaje, $headers);
	//mail("jorge@estrategasdigitales.com", $mail_title, $mensaje, $headers);
	//mail("jlaa2774@hotmail.com", utf8_decode($mail_title), $mensaje, $headers);
	do {
		//$to_coord = $row_coord_mails['email'];
		$to_coord_b = $row_coord_mails['email_b'];
		$mensaje_coord .= "<br /><br />";
		$mensaje_coord = "Tienes un nuevo preinscrito en el <strong>".$nombre_programa."</strong>";
		$mensaje_coord .= "<br /><br />";
		$mensaje_coord .= "Para darle seguimiento visita la siguiente liga:";
		$mensaje_coord .= "<br /><br />";
		$mensaje_coord .= "<a href='http://www.dec-uia.com/s_seguimiento/' target='_blank'>http://www.dec-uia.com/s_seguimiento/</a>";
		$mensaje_coord .= "<br /><br />donde podrás llevar paso a paso el proceso de inscripción y tener un fácil acceso a la información del usuario.";
		$mensaje_coord .= "<br /><br />Tu nombre de usuario es: <strong>".$row_coord_mails['username']."</strong>";
		$mensaje_coord .= "<br /><br />Tu contraseña: <strong>".$row_coord_mails['password']."</strong>";
		//mail($to_coord, $mail_title, $mensaje_coord, $headers);
		mail($to_coord_b, $mail_title, $mensaje_coord, $headers);
		
	}while($row_coord_mails = mysql_fetch_assoc($coord_mails));
	//mail('pvazquezdiaz@gmail.com', $mail_title, $mensaje_coord, $headers);
	/*$mensaje_lic .= "<br /><br />";
	$mensaje_lic = "Tienes un nuevo preinscrito en el <strong>".$nombre_programa."</strong>";
	$mensaje_lic .= "<br /><br />";
	$mensaje_lic .= "Para darle seguimiento visita la siguiente liga:";
	$mensaje_lic .= "<br /><br />";
	$mensaje_lic .= "<a href='http://www.dec-uia.com/s_seguimiento/' target='_blank'>http://www.dec-uia.com/s_seguimiento/</a>";
	$mensaje_lic .= "<br /><br />donde podrás llevar paso a paso el proceso de inscripción y tener un fácil acceso a la información del usuario.";
	$mensaje_lic .= "<br /><br />Tu nombre de usuario es: <strong>master_admin</strong>";
	$mensaje_lic .= "<br /><br />Tu contraseña: <strong>SS_dec_uia2011</strong>";*/
	//mail("pavel@estrategasdigitales.com", $mail_title, $mensaje_lic, $headers);
	//mail("erika.medina@uia.mx", $mail_title, $mensaje_temp, $headers);
	$mensaje_user = 'Tu preinscripción al '.$nombre_programa.' ha sido recibida';
	$mensaje_user .= '<br /><br />En breve nos comunicaremos contigo.';
	$mensaje_user .= '<br /><br />Gracias.';
	$mensaje_user .= '<br /><br />';
	$mensaje_user .= '<br /><br />Dirección de Educación Continua - Universidad Iberoamericana Campus Santa Fe.';
	$headers = "From: " . strip_tags($to_coord) . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	mail($email, 'Te has preinscrito exitosamente.', $mensaje_user, $headers);
	//mail("pavel@estrategasdigitales.com", $mail_title, $mensaje_user, $headers);
	
	header('Location: preinscripcion_exitosa_P.php?reg_news='.$_POST['reg_news'].'&email='.$_POST['email']);
	//para mandar el mail en texto plano.
	//mail("erika.medina@uia.mx", "DEC - Preinscripción", $mensaje, "FROM:$email");


} catch (Exception $e){
	
	$error_var = 'Excepción capturada: '.  $e->getMessage(). "\n";
	$headers = "From: webmaster@dec-uia.com\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";	
	$headers .= 'Cc: pavel@estrategasdigitales.com' . "\r\n";
	
	mail('webmaster@dec-uia.com','Error en preinscripción', $error_var, $headers);
	
	header('Location: preinscripcion_fallida.php');
	
}

}

mysql_select_db($database_otono2011, $otono2011);
$query_disciplines_names = "SELECT * FROM disciplines WHERE id_discipline != 22 AND id_discipline != 19 ORDER BY discipline ASC";
$disciplines_names = mysql_query($query_disciplines_names, $otono2011) or die(mysql_error());
$row_disciplines_names = mysql_fetch_assoc($disciplines_names);
$totalRows_disciplines_names = mysql_num_rows($disciplines_names);

if($_GET['discipline']==NULL || $_GET['discipline']==0){
	mysql_select_db($database_otono2011, $otono2011);
	$query_diplos_names = "SELECT * FROM site_programs WHERE program_type ='diplomado' AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE periodo = 'p') ORDER BY program_name ASC";
	$diplos_names = mysql_query($query_diplos_names, $otono2011) or die(mysql_error());
	$row_diplos_names = mysql_fetch_assoc($diplos_names);
	$totalRows_diplos_names = mysql_num_rows($diplos_names);
	
	mysql_select_db($database_otono2011, $otono2011);
	$query_cursos_names = "SELECT * FROM site_programs WHERE program_type ='curso' AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE periodo = 'p') ORDER BY program_name ASC";
	$cursos_names = mysql_query($query_cursos_names, $otono2011) or die(mysql_error());
	$row_cursos_names = mysql_fetch_assoc($cursos_names);
	$totalRows_cursos_names = mysql_num_rows($cursos_names);
}else{
	$area = $_GET['discipline'];
	mysql_select_db($database_otono2011, $otono2011);
	$query_diplos_names = "SELECT * FROM site_programs WHERE id_discipline = $area AND program_type ='diplomado' AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE periodo = 'p') ORDER BY program_name ASC";
	$diplos_names = mysql_query($query_diplos_names, $otono2011) or die(mysql_error());
	$row_diplos_names = mysql_fetch_assoc($diplos_names);
	$totalRows_diplos_names = mysql_num_rows($diplos_names);
	
	mysql_select_db($database_otono2011, $otono2011);
	$query_diplos_names_2 = "SELECT * FROM site_programs WHERE id_discipline_alterna != 'NULL' AND program_type ='diplomado' AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE periodo = 'p') ORDER BY program_name ASC";
	$diplos_names_2 = mysql_query($query_diplos_names_2, $otono2011) or die(mysql_error());
	$row_diplos_names_2 = mysql_fetch_assoc($diplos_names_2);
	$totalRows_diplos_names_2 = mysql_num_rows($diplos_names_2);
	
	mysql_select_db($database_otono2011, $otono2011);
	$query_cursos_names = "SELECT * FROM site_programs WHERE id_discipline = $area AND program_type ='curso' AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE periodo = 'p') ORDER BY program_name ASC";
	$cursos_names = mysql_query($query_cursos_names, $otono2011) or die(mysql_error());
	$row_cursos_names = mysql_fetch_assoc($cursos_names);
	$totalRows_cursos_names = mysql_num_rows($cursos_names);
	
	mysql_select_db($database_otono2011, $otono2011);
	$query_cursos_names_2 = "SELECT * FROM site_programs WHERE id_discipline_alterna != 'NULL' AND program_type ='curso' AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE periodo = 'p') ORDER BY program_name ASC";
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.0/jquery.js"></script>
<script>
var anio_f=00;
var mes_f=00;
var dia_f=00;
function populate_month(dia){
		if(dia==31){
		$('select#mes_nac').html('<option selected="selected" disabled="disabled">- Mes -</option><option value="01">Enero</option><option value="03">Marzo</option><option value="05">Mayo</option><option value="07">Julio</option><option value="08">Agosto</option><option value="10">Octubre</option><option value="12">Diciembre</option>');
		}else if(dia==30){
		$('select#mes_nac').html('<option selected="selected" disabled="disabled">- Mes -</option><option value="01">Enero</option><option value="03">Marzo</option><option value="04">Abril</option><option value="05">Mayo</option><option value="06">Junio</option><option value="07">Julio</option><option value="08">Agosto</option><option value="09">Septiembre</option><option value="10">Octubre</option><option value="11">Noviembre</option><option value="12">Diciembre</option>');
		}else{
		$('select#mes_nac').html('<option selected="selected" disabled="disabled">- Mes -</option><option value="01">Enero</option><option value="02">Febrero</option><option value="03">Marzo</option><option value="04">Abril</option><option value="05">Mayo</option><option value="06">Junio</option><option value="07">Julio</option><option value="08">Agosto</option><option value="09">Septiembre</option><option value="10">Octubre</option><option value="11">Noviembre</option><option value="12">Diciembre</option>');
		}
		dia_f=dia;
}
function populate_year(mes){
	if(($('select#dia_nac').val()==29)&&(mes==02)){
		$('select#anio_nac').html('<option value="08">2008</option><option value="04">2004</option><option value="00">2000</option><option value="96">1996</option><option value="92">1992</option><option value="88">1988</option><option value="84">1984</option><option value="80">1980</option><option value="76">1976</option><option value="72">1972</option><option value="68">1968</option><option value="64">1964</option><option value="60">1960</option><option value="56">1956</option><option value="52">1952</option><option value="48">1948</option><option value="44">1944</option><option value="40">1940</option><option value="36">1936</option><option value="32">1932</option><option value="28">1928</option><option value="24">1924</option><option value="20">1920</option><option value="16">1916</option><option value="12">1912</option><option value="08">1908</option><option value="04">1904</option><option value="00">1900</option>');
	}else{
		$('select#anio_nac').html('<option selected="selected" disabled="disabled">- Año -</option><option value="11">2011</option><option value="10">2010</option><option value="09">2009</option><option value="08">2008</option><option value="07">2007</option><option value="06">2006</option><option value="05">2005</option><option value="04">2004</option><option value="03">2003</option><option value="02">2002</option><option value="01">2001</option><option value="00">2000</option><option value="99">1999</option><option value="98">1998</option><option value="97">1997</option><option value="96">1996</option><option value="95">1995</option><option value="94">1994</option><option value="93">1993</option><option value="92">1992</option><option value="91">1991</option><option value="90">1990</option><option value="89">1989</option><option value="88">1988</option><option value="87">1987</option><option value="86">1986</option><option value="85">1985</option><option value="84">1984</option><option value="83">1983</option><option value="82">1982</option><option value="81">1981</option><option value="80">1980</option><option value="79">1979</option><option value="78">1978</option><option value="77">1977</option><option value="76">1976</option><option value="75">1975</option><option value="74">1974</option><option value="73">1973</option><option value="72">1972</option><option value="71">1971</option><option value="70">1970</option><option value="69">1969</option><option value="68">1968</option><option value="67">1967</option><option value="66">1966</option><option value="65">1965</option><option value="64">1964</option><option value="63">1963</option><option value="62">1962</option><option value="61">1961</option><option value="60">1960</option><option value="59">1959</option><option value="58">1958</option><option value="57">1957</option><option value="56">1956</option><option value="55">1955</option><option value="54">1954</option><option value="53">1953</option><option value="52">1952</option><option value="51">1951</option><option value="50">1950</option><option value="49">1949</option><option value="48">1948</option><option value="47">1947</option><option value="46">1946</option><option value="45">1945</option><option value="44">1944</option><option value="43">1943</option><option value="42">1942</option><option value="41">1941</option><option value="40">1940</option><option value="39">1939</option><option value="38">1938</option><option value="37">1937</option><option value="36">1936</option><option value="35">1935</option><option value="34">1934</option><option value="33">1933</option><option value="32">1932</option><option value="31">1931</option><option value="30">1930</option><option value="29">1929</option><option value="28">1928</option><option value="27">1927</option><option value="26">1926</option><option value="25">1925</option><option value="24">1924</option><option value="23">1923</option><option value="22">1922</option><option value="21">1921</option><option value="20">1920</option><option value="19">1919</option><option value="18">1918</option><option value="17">1917</option><option value="16">1916</option><option value="15">1915</option><option value="14">1914</option><option value="13">1913</option><option value="12">1912</option><option value="11">1911</option><option value="10">1910</option><option value="09">1909</option><option value="08">1908</option><option value="07">1907</option><option value="06">1906</option><option value="05">1905</option><option value="04">1904</option><option value="03">1903</option><option value="02">1902</option><option value="01">1901</option><option value="00">1900</option>');
	}
	mes_f=mes;
}
function populate_rfc_name(){
	var pat = $('input#a_paterno').val().substr(0,2);
	var mat = $('input#a_materno').val().substr(0,1);
	var nom = $('input#nombre').val().substr(0,1);
	var rfc_siglas = pat.toUpperCase()+mat.toUpperCase()+nom.toUpperCase();
	
	//alert(rfc_siglas);
	
	rfc_siglas = rfc_siglas.replace('Á', 'A');
	rfc_siglas = rfc_siglas.replace('É', 'E');
	rfc_siglas = rfc_siglas.replace('Í', 'I');
	rfc_siglas = rfc_siglas.replace('Ó', 'O');
	rfc_siglas = rfc_siglas.replace('Ú', 'U');
	rfc_siglas = rfc_siglas.replace('Ñ', 'N');
	//alert(rfc_siglas);
	$('input#rfc').attr('value',rfc_siglas);
}
function populate_rfc(anio){
	var rfc_numbers = anio+mes_f+dia_f;
	$('input#rfc2').attr('value',rfc_numbers);
}
function unpopulate_rfc(){
	//$('input#rfc').attr('value','');
	$('input#rfc2').attr('value','');
}
</script>
<script>

/*function isEmpty(text) {
		 for ( i = 0; i < text.length; i++ ) {  
				 if ( text.charAt(i) != " " ) {  
						 return false  
				 }  
		 }  
		 return true
}*/  

function validate(){
	   
	   //___ NUEVO CODIGO ---
	   
	    var requiredFieldsAlertMsg = "Los siguientes campos son requeridos:\n\n";
		var cont = 0;
		  
		  if($('select#nombre_programa').val()==0){
			  requiredFieldsAlertMsg += "* Programa\n";
				cont++;
		  }
		  
		  if($('select#fechas_ini').val()==0){
			  requiredFieldsAlertMsg += "* Horario\n";
				cont++;
		  }
		 
		 if ($('input[name=how_you_know]:radio').is(':checked')) {
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
		if($('input#domicilio').val()==''){
			requiredFieldsAlertMsg += "* Domicilio\n";
			cont++;
		}
		if($('input#colonia').val()==''){
			requiredFieldsAlertMsg += "* Colonia\n";
			cont++;
		}
		if($('input#del_mpo_pob').val()==''){
			requiredFieldsAlertMsg += "* Delegación o  municipio\n";
			cont++;
		}
		if($('input#cp').val()==''){
			requiredFieldsAlertMsg += "* Código postal\n";
			cont++;
		}
		if($('input#ciudad').val()==''){
			requiredFieldsAlertMsg += "* Ciudad\n";
			cont++;
		}
		if($('input#estado').val()==''){
			requiredFieldsAlertMsg += "* Estado\n";
			cont++;
		}
		if($('input#rfc').val()==''){
			requiredFieldsAlertMsg += "* RFC\n";
			cont++;
		}else if($('input#rfc2').val()==''){
			requiredFieldsAlertMsg += "* RFC\n";
			cont++;
		}
		if($('input#tel_casa').val()==''){
			requiredFieldsAlertMsg += "* Teléfono\n";
			cont++;
		}
		if($('input#email').val()==''){
			requiredFieldsAlertMsg += "* E-mail\n";
			cont++;
		}else{
			var a = $('input#email').val();
		    var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
			if(filter.test(a)){
				//NADA
			}
			else{
				requiredFieldsAlertMsg += '* La dirección de correo no es válida\n';
				cont++;
			}
		}
		if($('select#nacionalidad').val()==0){
			requiredFieldsAlertMsg += "* Nacionalidad\n";
			cont++;
		}
		
		/*if(($('input#gradoAcademico_0').is(':checked')) && ($('input#gradoAcademico_1').is(':checked')) && ($('input#gradoAcademico_2').is(':checked')) && ($('input#gradoAcademico_3').is(':checked'))){
			requiredFieldsAlertMsg += "* Grado académico\n";
			cont++;
		}*/
		
		if($('input#inst_estudios').val()==''){
			requiredFieldsAlertMsg += "* Institución de estudios\n";
			cont++;
		}
		if ($('input[name=exAlumnoUIA]:radio').is(':checked')) {
			 //--
		 }else{
			requiredFieldsAlertMsg += "* ¿Ex alumno UIA?\n";
			cont++;
		}
	   
	   //var rfc_field_check = isAlphabet();
	   //var rfc_field_check2 = isNumeric();
	   //alert("rfc_field_check: "+rfc_field_check);
	   //alert("rfc_field_check2: "+rfc_field_check2);
	   //if(rfc_field_check == false || rfc_field_check2 == false){
		   //alert("alguno de rfc_field_check 1 o 2 regresan false");
		   //return false;
		   //return true;
	   //}
	   //return false;
		if(cont>0){
			alert(requiredFieldsAlertMsg);
			return false;
	}else{
	   //return false;
	   if($('form#form_news_2 input#f_s').is(':checked')){
		$('form#form_news_2 input#email_news').attr('value',$('form#form1 input#email').val());
			document.forms.form_news_2.submit();
		}
	   
	   return confirm('Los datos proporcionados serán utilizados unicamente para continuar con tu proceso de inscripción. Da clic en "Aceptar" si los datos son correctos, de lo contrario da clic en "Cancelar". Gracias.');

	}		
}

function clear_radios(){
	//alert('-');
	$('input#comoSeEnteroDelPrograma_0').attr('checked',false);
	$('input#comoSeEnteroDelPrograma_1').attr('checked',false);
	$('input#comoSeEnteroDelPrograma_2').attr('checked',false);
	$('input#comoSeEnteroDelPrograma_3').attr('checked',false);
	$('input#comoSeEnteroDelPrograma_4').attr('checked',false);
	$('input#comoSeEnteroDelPrograma_5').attr('checked',false);
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
		  			<td colspan="2"><p>La direcci&oacute;n de educaci&oacute;n
		  				continua preocupada en&nbsp; la agilizaci&oacute;n de tr&aacute;mites,
		  				presenta a continuaci&oacute;n un formato de preinscripci&oacute;n
		  				que nos ayudar&aacute; a conocer mejor tus necesidades
		  				y los datos necesarios para informarte sobre tu proceso
	  				  de inscripci&oacute;n.</p></td>
	  			</tr>
		  		<tr>
		  			<td colspan="3">
					<table width="100%" border="0" align="left" cellpadding="2">
<tr>
<td width="90%" height="30" align="left" valign="middle" >Si
  deseas pedir informaci&oacute;n sobre alg&uacute;n curso o diplomado, haz click <a href="informes.php">aqu&iacute;</a></td>
</tr>
<tr>
  <td height="30" align="left" valign="middle" class="titulos_diplo"><strong>Preinscripci&oacute;n</strong></td>
  </tr>
<tr>
	<td height="30" align="left" valign="middle">
	<form id="form1" name="form1" method="post" action="preinscripcion_P.php" onsubmit="return validate();">
	<input type="hidden" name="send_form" value="1" />
  <table width="100%" border="0" align="left" cellpadding="2" name="pre_table" id="pre_table">
    <tr>
      <td colspan="2" align="left"><p><strong>Nombre del Programa*</strong></p></td>
    </tr>
    <tr>
      <td colspan="2"><p>
        <label>Área:<br />
		<select name="area_programa_x" id="area_programa_x" onchange="MM_jumpMenu('parent', this, 0);">
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
      </label></p></td>
    </tr>
    <tr>
      <td colspan="2"><p><label>Programa:
        <br />
        <select name="nombre_programa" id="nombre_programa" onchange="MM_jumpMenu('parent', this, 0);" style="max-width:520px; width:520px;">
          <?php
			if($totalRows_diplos_names != 0){ 
			?>
          <option value="0" disabled="disabled">---------------DIPLOMADOS---------------</option>
          <?php do { 
			if($row_diplos_names['idioma']!=1){
				$value = 'preinscripcion.php?discipline='.$_GET['discipline'].'&id_program='.$row_diplos_names['id_program']; 
			}else{
				$value = 'preinscripcion_idiomas.php?discipline=14&id_program='.$row_diplos_names['id_program']; 
			}
			?>
          <option value="<?php echo $value; ?>" <? if($_GET['id_program']==$row_diplos_names['id_program']){echo 'selected="selected"';} ?>><?php echo $row_diplos_names['program_name']; ?></option>
          <?php
			} while ($row_diplos_names = mysql_fetch_assoc($diplos_names));
			  $rows_diplos = mysql_num_rows($diplos_names);
			  if($rows_diplos > 0) {
				  mysql_data_seek($diplos_names, 0);
				  $row_diplos_names = mysql_fetch_assoc($diplos_names);
			  }
        }
		if(($totalRows_diplos_names_2 != 0)&&($totalRows_diplos_names == 0)){ ?>
          <option value="0" disabled="disabled">---------------DIPLOMADOS---------------</option>
          <? } 
		if($totalRows_diplos_names_2 != 0){
			
			?>
          
          <?php do { 
			
				//Nuevo codigo
				$diplos_disc_alter_array = explode(',',$row_diplos_names_2['id_discipline_alterna']);
			
				for($i = 0; $i < sizeof($diplos_disc_alter_array); $i++){
				
					if($area == $diplos_disc_alter_array[$i]){ 
						if($row_diplos_names_2['idioma']!=1){
							$value = 'preinscripcion.php?discipline='.$_GET['discipline'].'&id_program='.$row_diplos_names_2['id_program']; 
						}else{
							$value = 'preinscripcion_idiomas.php?discipline=14&id_program='.$row_diplos_names_2['id_program']; 
						}?>
          
          <option value="<?php echo $value; ?>" <? if($_GET['id_program']==$row_diplos_names_2['id_program']){echo 'selected="selected"';} ?>><?php echo $row_diplos_names_2['program_name']; ?></option>
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
          <option value="0" disabled="disabled">-----------------CURSOS--------------------</option>
          <?php do { 
		
			if($row_cursos_names['idioma']!=1){
				$value = 'preinscripcion.php?discipline='.$_GET['discipline'].'&id_program='.$row_cursos_names['id_program']; 
			}else{
				$value = 'preinscripcion_idiomas.php?discipline=14&id_program='.$row_cursos_names['id_program']; 
			}?>
          <option value="<?php echo $value; ?>" <? if($_GET['id_program']==$row_cursos_names['id_program']){echo 'selected="selected"';} ?>><?php echo $row_cursos_names['program_name']; ?></option>
          <?php
        } while ($row_cursos_names = mysql_fetch_assoc($cursos_names));
          $rows_cursos = mysql_num_rows($cursos_names);
          if($rows_cursos > 0) {
              mysql_data_seek($cursos_names, 0);
              $row_cursos_names = mysql_fetch_assoc($cursos_names);
          }
		}
		if(($totalRows_cursos_names_2 != 0)&&($totalRows_cursos_names == 0)){ ?>
          <option value="0" disabled="disabled">-----------------CURSOS--------------------</option>
          <?php }
		if($totalRows_cursos_names_2 != 0){
			do { 
				
				//Nuevo codigo
				$cursos_disc_alter_array = explode(',',$row_cursos_names_2['id_discipline_alterna']);
			
				for($i = 0; $i < sizeof($cursos_disc_alter_array); $i++){
				
					if($area == $cursos_disc_alter_array[$i]){ 
					
					if($row_cursos_names_2['idioma']!=1){
						$value = 'preinscripcion.php?discipline='.$_GET['discipline'].'&id_program='.$row_cursos_names_2['id_program']; 
					}else{
						$value = 'preinscripcion_idiomas.php?discipline=14&id_program='.$row_cursos_names_2['id_program']; 
					}?>
          
          <option value="<?php echo $value; ?>" <? if($_GET['id_program']==$row_cursos_names_2['id_program']){echo 'selected="selected"';} ?>><?php echo $row_cursos_names_2['program_name']; ?></option>
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
      </label></p></td>
    </tr>
	<? if($_GET['id_program']!=NULL){ ?>
    <tr>
    	<td colspan="2">
			<p><label>Horario:<br />
				<?
				mysql_select_db($database_otono2011, $otono2011);
				$query_fechas_ini = "SELECT id_fecha, fecha, (SELECT nombre_sede FROM site_sedes WHERE site_sedes.id_sede = site_fechas_ini.id_sede) AS sede, horario FROM site_fechas_ini WHERE cancelado = 0 AND id_program = ".$_GET['id_program']." AND fecha > '2011-12-31'";
				$fechas_ini = mysql_query($query_fechas_ini, $otono2011) or die(mysql_error());
				$row_fechas_ini = mysql_fetch_assoc($fechas_ini);
				$totalRows_fechas_ini = mysql_num_rows($fechas_ini);
				?>
				<select name="fechas_ini" id="fechas_ini">
					<? do { ?> 
											
						<option value="<?php echo $_GET['id_program'].','.$row_fechas_ini['id_fecha']?>">
						
						<?php if($row_fechas_ini['horario']==NULL){echo 'N/A';}else{echo $row_fechas_ini['horario']; ?> <? if($row_fechas_ini['sede']!=NULL){echo 'Sede: '.$row_fechas_ini['sede']; }}?>
						
						</option>
						<?php
						
				} while ($row_fechas_ini = mysql_fetch_assoc($fechas_ini));
				  /*$rows_cursos_2 = mysql_num_rows($cursos_names_2);
				  if($rows_cursos_2 > 0) {
					  mysql_data_seek($cursos_names_2, 0);
					  $row_cursos_names_2 = mysql_fetch_assoc($cursos_names_2);
				  } */?>
				</select>
			</label></p>
		</td>
    </tr>
    <? } ?>
	<tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td width="30%" align="right">¿Cómo se enteró del programa? *</td>
      <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="50%"><p>
            <label>
              <input type="radio" name="how_you_know" value="Catálogo" id="comoSeEnteroDelPrograma_0" />
Cat&aacute;logo</label>
          </p></td>
          <td width="50%"><p>
            <label>
              <input type="radio" name="how_you_know" value="Internet" id="comoSeEnteroDelPrograma_1" />
              Internet</label>
          </p></td>
        </tr>
        <tr>
          <td width="50%"><p>
            <label>
              <input type="radio" name="how_you_know" value="Periódico" id="comoSeEnteroDelPrograma_2" />
Peri&oacute;dico</label>
          </p></td>
          <td width="50%"><p>
            <label>
              <input type="radio" name="how_you_know" value="Revista" id="comoSeEnteroDelPrograma_3" />
              Revista</label>
          </p></td>
        </tr>
        <tr>
          <td width="50%"><p>
            <label>
              <input type="radio" name="how_you_know" value="Recomendación" id="comoSeEnteroDelPrograma_4" />
Recomendaci&oacute;n</label>
          </p></td>
          <td width="50%"><p>
            <label>
              <input type="radio" name="how_you_know" value="Email" id="comoSeEnteroDelPrograma_5" />
              Email</label>
          </p></td>
        </tr>
        <tr>
          <td colspan="2"><p>
            <label>Otro:
              <input name="otromedio" type="text" id="otromedio" size="26" onkeyup="clear_radios();" />
            </label>
          </p></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="50" colspan="2" align="center"><p>Informaci&oacute;n
      Personal</p></td>
    </tr>
    <tr>
      <td width="30%" align="right"><p>A. Paterno *</p></td>
      <td><input name="a_paterno" type="text" id="a_paterno" size="30" onchange="populate_rfc_name()" /></td>
    </tr>
    <tr>
      <td width="30%" align="right"><p>A. Materno *</p></td>
      <td><input name="a_materno" type="text" id="a_materno" size="30" onchange="populate_rfc_name()" /></td>
    </tr>
    <tr>
      <td width="30%" align="right"><p>Nombre(s) *</p></td>
      <td><input name="nombre" type="text" id="nombre" size="30" onchange="populate_rfc_name()" /></td>
    </tr>
    <tr>
    	<td width="30%" align="right"><p>Fecha de Nacimiento*</p></td>
    	<td><table width="211" border="0" cellspacing="0" cellpadding="0">
    		<tr>
    			<td width="75" align="center"><select name="dia_nac" id="dia_nac" onchange="populate_month(this.value); unpopulate_rfc();">
    				<option selected="selected" disabled="disabled">- D&iacute;a -</option>
    				<option value="01">1</option>
    				<option value="02">2</option>
    				<option value="03">3</option>
    				<option value="04">4</option>
    				<option value="05">5</option>
    				<option value="06">6</option>
    				<option value="07">7</option>
    				<option value="08">8</option>
    				<option value="09">9</option>
    				<option value="10">10</option>
    				<option value="11">11</option>
    				<option value="12">12</option>
    				<option value="13">13</option>
    				<option value="14">14</option>
    				<option value="15">15</option>
    				<option value="16">16</option>
    				<option value="17">17</option>
    				<option value="18">18</option>
    				<option value="19">19</option>
    				<option value="20">20</option>
    				<option value="21">21</option>
    				<option value="22">22</option>
    				<option value="23">23</option>
    				<option value="24">24</option>
    				<option value="25">25</option>
    				<option value="26">26</option>
    				<option value="27">27</option>
    				<option value="28">28</option>
    				<option value="29">29</option>
    				<option value="30">30</option>
    				<option value="31">31</option>
    				</select></td>
    			<td width="67" align="center"><select name="mes_nac" id="mes_nac" onchange="populate_year(this.value); unpopulate_rfc();">
    				</select></td>
    			<td width="69" align="center"><select name="anio_nac" id="anio_nac" onchange="populate_rfc(this.value);">
    				</select></td>
    			</tr>
    		</table></td>
    	</tr>
    <tr>
      <td width="30%" align="right"><p>Domicilio *</p></td>
      <td><input name="domicilio" type="text" id="domicilio" size="30" /></td>
    </tr>
    <tr>
      <td width="30%" align="right"><p>Colonia *</p></td>
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
        </p>
        <p>*<strong>Favor de revisar que el RFC sea correcto.</strong><br />Si cuentas con homoclave, favor de proporcionarla. Gracias.</p></td>
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
      <td>
	  	<select name="nacionalidad" id="nacionalidad">
			<option value="0" disabled="disabled">Selecciona un país</option>
			<option value="MX - México" selected="selected">México</option> 
			<option value="" disabled="disabled">-------------------</option> 
			<option value="AF - Afganistán">Afganistán</option>
			<option value="AL - Albania">Albania</option> 
			<option value="DE - Alemania">Alemania</option> 
			<option value="AD - Andorra">Andorra</option> 
			<option value="AO - Angola">Angola</option> 
			<option value="AI - Anguilla">Anguilla</option> 
			<option value="AQ - Antártida">Antártida</option> 
			<option value="AG - Antigua y Barbuda">Antigua y Barbuda</option> 
			<option value="AN - Antillas Holandesas">Antillas Holandesas</option> 
			<option value="SA - Arabia Saudí">Arabia Saudí</option> 
			<option value="DZ - Argelia">Argelia</option> 
			<option value="AR - Argentina">Argentina</option> 
			<option value="AM - Armenia">Armenia</option> 
			<option value="AW - Aruba">Aruba</option> 
			<option value="AU - Australia">Australia</option> 
			<option value="AT - Austria">Austria</option>  
			<option value="AZ - Azerbaiyán">Azerbaiyán</option>  
			<option value="BS - Bahamas">Bahamas</option>  
			<option value="BH - Bahrein">Bahrein</option>  
			<option value="BD - Bangladesh">Bangladesh</option>  
			<option value="BB - Barbados">Barbados</option>  
			<option value="BE - Bélgica">Bélgica</option>  
			<option value="BZ - Belice">Belice</option>  
			<option value="BJ - Benin">Benin</option>  
			<option value="BM - Bermudas">Bermudas</option>  
			<option value="BY - Bielorrusia">Bielorrusia</option>  
			<option value="MM - Birmania">Birmania</option>  
			<option value="BO - Bolivia">Bolivia</option>  
			<option value="BA - Bosnia y Herzegovina">Bosnia y Herzegovina</option>  
			<option value="BW - Botswana">Botswana</option>  
			<option value="BR - Brasil">Brasil</option>  
			<option value="BN - Brunei">Brunei</option>  
			<option value="BG - Bulgaria">Bulgaria</option>  
			<option value="BF - Burkina Faso">Burkina Faso</option>  
			<option value="BI - Burundi">Burundi</option>  
			<option value="BT - Bután">Bután</option>  
			<option value="CV - Cabo Verde">Cabo Verde</option>  
			<option value="KH - Camboya">Camboya</option>  
			<option value="CM - Camerún">Camerún</option>  
			<option value="CA - Canadá">Canadá</option>  
			<option value="TD - Chad">Chad</option>  
			<option value="CL - Chile">Chile</option>  
			<option value="CN - China">China</option>  
			<option value="CY - Chipre">Chipre</option>  
			<option value="VA - Ciudad del Vaticano (Santa Sede)">Ciudad del Vaticano (Santa Sede)</option>  
			<option value="CO - Colombia">Colombia</option>  
			<option value="KM - Comores">Comores</option>  
			<option value="CG - Congo">Congo</option>  
			<option value="CD - Congo, República Democrática del">Congo, República Democrática del</option>  
			<option value="KR - Corea">Corea</option>  
			<option value="KP - Corea del Norte">Corea del Norte</option>  
			<option value="CI - Costa de Marfíl">Costa de Marfíl</option>  
			<option value="CR - Costa Rica">Costa Rica</option>  
			<option value="HR - Croacia (Hrvatska)">Croacia (Hrvatska)</option>  
			<option value="CU - Cuba">Cuba</option>  
			<option value="DK - Dinamarca">Dinamarca</option>  
			<option value="DJ - Djibouti">Djibouti</option>  
			<option value="DM - Dominica">Dominica</option>  
			<option value="EC - Ecuador">Ecuador</option>  
			<option value="EG - Egipto">Egipto</option>  
			<option value="SV - El Salvador">El Salvador</option>  
			<option value="AE - Emiratos Árabes Unidos">Emiratos Árabes Unidos</option>  
			<option value="ER - Eritrea">Eritrea</option>  
			<option value="SI - Eslovenia">Eslovenia</option>  
			<option value="ES - España">España</option>  
			<option value="US - Estados Unidos">Estados Unidos</option>  
			<option value="EE - Estonia">Estonia</option>  
			<option value="ET - Etiopía">Etiopía</option>  
			<option value="FJ - Fiji">Fiji</option>  
			<option value="PH - Filipinas">Filipinas</option>  
			<option value="FI - Finlandia">Finlandia</option>  
			<option value="FR - Francia">Francia</option>  
			<option value="GA - Gabón">Gabón</option>  
			<option value="GM - Gambia">Gambia</option>  
			<option value="GE - Georgia">Georgia</option>  
			<option value="GH - Ghana">Ghana</option>  
			<option value="GI - Gibraltar">Gibraltar</option>  
			<option value="GD - Granada">Granada</option>  
			<option value="GR - Grecia">Grecia</option>  
			<option value="GL - Groenlandia">Groenlandia</option>  
			<option value="GP - Guadalupe">Guadalupe</option>  
			<option value="GU - Guam">Guam</option>  
			<option value="GT - Guatemala">Guatemala</option>  
			<option value="GY - Guayana">Guayana</option>  
			<option value="GF - Guayana Francesa">Guayana Francesa</option>  
			<option value="GN - Guinea">Guinea</option>  
			<option value="GQ - Guinea Ecuatorial">Guinea Ecuatorial</option>  
			<option value="GW - Guinea-Bissau">Guinea-Bissau</option>  
			<option value="HT - Haití">Haití</option>  
			<option value="HN - Honduras">Honduras</option>  
			<option value="HU - Hungría">Hungría</option>  
			<option value="IN - India">India</option>  
			<option value="ID - Indonesia">Indonesia</option>  
			<option value="IQ - Irak">Irak</option>  
			<option value="IR - Irán">Irán</option>  
			<option value="IE - Irlanda">Irlanda</option>  
			<option value="IS - Islandia">Islandia</option>  
			<option value="KY - Islas Caimán">Islas Caimán</option>   
			<option value="IL - Israel">Israel</option>  
			<option value="IT - Italia">Italia</option>  
			<option value="JM - Jamaica">Jamaica</option>  
			<option value="JP - Japón">Japón</option>  
			<option value="JO - Jordania">Jordania</option>  
			<option value="KZ - Kazajistán">Kazajistán</option>  
			<option value="KE - Kenia">Kenia</option>  
			<option value="KG - Kirguizistán">Kirguizistán</option>  
			<option value="KI - Kiribati">Kiribati</option>  
			<option value="KW - Kuwait">Kuwait</option>  
			<option value="LA - Laos">Laos</option>  
			<option value="LS - Lesotho">Lesotho</option>  
			<option value="LV - Letonia">Letonia</option>  
			<option value="LB - Líbano">Líbano</option>  
			<option value="LR - Liberia">Liberia</option>  
			<option value="LY - Libia">Libia</option>  
			<option value="LI - Liechtenstein">Liechtenstein</option>  
			<option value="LT - Lituania">Lituania</option>  
			<option value="LU - Luxemburgo">Luxemburgo</option>  
			<option value="MK - Macedonia, Ex-República Yugoslava de">Macedonia, Ex-República Yugoslava de</option>  
			<option value="MG - Madagascar">Madagascar</option>  
			<option value="MY - Malasia">Malasia</option>  
			<option value="MW - Malawi">Malawi</option>  
			<option value="MV - Maldivas">Maldivas</option>  
			<option value="ML - Malí">Malí</option>  
			<option value="MT - Malta">Malta</option>  
			<option value="MA - Marruecos">Marruecos</option>  
			<option value="MQ - Martinica">Martinica</option>  
			<option value="MU - Mauricio">Mauricio</option>  
			<option value="MR - Mauritania">Mauritania</option>  
			<option value="YT - Mayotte">Mayotte</option>  
			<option value="FM - Micronesia">Micronesia</option>  
			<option value="MD - Moldavia">Moldavia</option>  
			<option value="MC - Mónaco">Mónaco</option>  
			<option value="MN - Mongolia">Mongolia</option>  
			<option value="MS - Montserrat">Montserrat</option>  
			<option value="MZ - Mozambique">Mozambique</option>  
			<option value="NA - Namibia">Namibia</option>  
			<option value="NR - Nauru">Nauru</option>  
			<option value="NP - Nepal">Nepal</option>  
			<option value="NI - Nicaragua">Nicaragua</option>  
			<option value="NE - Níger">Níger</option>  
			<option value="NG - Nigeria">Nigeria</option>  
			<option value="NU - Niue">Niue</option>  
			<option value="NF - Norfolk">Norfolk</option>  
			<option value="NO - Noruega">Noruega</option>  
			<option value="NC - Nueva Caledonia">Nueva Caledonia</option>  
			<option value="NZ - Nueva Zelanda">Nueva Zelanda</option>  
			<option value="OM - Omán">Omán</option>  
			<option value="NL - Países Bajos">Países Bajos</option>  
			<option value="PA - Panamá">Panamá</option>  
			<option value="PG - Papúa Nueva Guinea">Papúa Nueva Guinea</option>  
			<option value="PK - aquistán">Paquistán</option>  
			<option value="PY - Paraguay">Paraguay</option>  
			<option value="PE - Perú">Perú</option>  
			<option value="PN - Pitcairn">Pitcairn</option>  
			<option value="PF - Polinesia Francesa">Polinesia Francesa</option>  
			<option value="PL - Polonia">Polonia</option>  
			<option value="PT - Portugal">Portugal</option>  
			<option value="PR - Puerto Rico">Puerto Rico</option>  
			<option value="QA - Qatar">Qatar</option>  
			<option value="UK - Reino Unido">Reino Unido</option>  
			<option value="CF - República Centroafricana">República Centroafricana</option>  
			<option value="CZ - República Checa">República Checa</option>  
			<option value="ZA - República de Sudáfrica">República de Sudáfrica</option>  
			<option value="DO - República Dominicana">República Dominicana</option>  
			<option value="SK - República Eslovaca">República Eslovaca</option>  
			<option value="RE - Reunión">Reunión</option>  
			<option value="RW - Ruanda">Ruanda</option>  
			<option value="RO - Rumania">Rumania</option>  
			<option value="RU - Rusia">Rusia</option>  
			<option value="WS - Samoa">Samoa</option>  
			<option value="SM - San Marino">San Marino</option>  
			<option value="VC - San Vicente y Granadinas">San Vicente y Granadinas</option>  
			<option value="SH - Santa Helena">Santa Helena</option>  
			<option value="LC - Santa Lucía">Santa Lucía</option>  
			<option value="ST - Santo Tomé y Príncipe">Santo Tomé y Príncipe</option>  
			<option value="SN - Senegal">Senegal</option>  
			<option value="SC - Seychelles">Seychelles</option>  
			<option value="SL - Sierra Leona">Sierra Leona</option>  
			<option value="SG - Singapur">Singapur</option>  
			<option value="SY - Siria">Siria</option>  
			<option value="SO - Somalia">Somalia</option>  
			<option value="LK - Sri Lanka">Sri Lanka</option>  
			<option value="SZ - Suazilandia">Suazilandia</option>  
			<option value="SD - Sudán">Sudán</option>  
			<option value="SE - Suecia">Suecia</option>  
			<option value="CH - Suiza">Suiza</option>  
			<option value="SR - Surinam">Surinam</option>  
			<option value="TH - Tailandia">Tailandia</option>  
			<option value="TW - Taiwán">Taiwán</option>  
			<option value="TZ - Tanzania">Tanzania</option>  
			<option value="TJ - Tayikistán">Tayikistán</option>  
			<option value="TG - Togo">Togo</option>  
			<option value="TO - Tonga">Tonga</option>  
			<option value="TT - Trinidad y Tobago">Trinidad y Tobago</option>  
			<option value="TN - Túnez">Túnez</option>  
			<option value="TM - Turkmenistán">Turkmenistán</option>  
			<option value="TR - Turquía">Turquía</option>  
			<option value="TV - Tuvalu">Tuvalu</option>  
			<option value="UA - Ucrania">Ucrania</option>  
			<option value="UG - Uganda">Uganda</option>  
			<option value="UY - Uruguay">Uruguay</option>  
			<option value="UZ - Uzbekistán">Uzbekistán</option>  
			<option value="VU - Vanuatu">Vanuatu</option>  
			<option value="VE - Venezuela">Venezuela</option>  
			<option value="VN - Vietnam">Vietnam</option>  
			<option value="YE - Yemen">Yemen</option>  
			<option value="YU - Yugoslavia">Yugoslavia</option>  
			<option value="ZM - Zambia">Zambia</option>  
			<option value="ZW - Zimbabue">Zimbabue</option>
		</select>
	  </td>
    </tr>
    <tr>
      <td width="30%" align="right"><p>Estado civil</p></td>
      <td><input name="edo_civil" type="text" id="edo_civil" size="30" /></td>
    </tr>
    <tr>
      <td height="50" colspan="2" align="center"><p>Informaci&oacute;n
          Acad&eacute;mica</p></td>
    </tr>
    <tr>
      <td align="right"><p>Nivel acad&eacute;mico
          *</p></td>
      <td><table width="100%">
        <tr>
          <td><p><label>
            <input type="radio" name="gradoAcademico" value="Preparatoria" id="gradoAcademico_0" />
            Preparatoria
          </label></p></td>
          <td><p><label>
            <input type="radio" name="gradoAcademico" value="Maestría" id="gradoAcademico_1" />
            Maestr&iacute;a</label></p></td>
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
          <td>
            <p>
              <label>
                <input type="radio" name="exAlumnoUIA" value="Si" id="exAlumnoUIA_0" />
                Si</label>
            </p></td>
        </tr>
        <tr>
          <td>
            <p>
              <label>
                <input type="radio" name="exAlumnoUIA" value="No" id="exAlumnoUIA_1" />
                No</label>
            </p></td>
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
    	<td align="right">Deseo recibir noticias<br />sobre los programas de<br />la Direcci&oacute;n de Educaci&oacute;n Continua</td>
    	<td align="left"><table width="200">
    		<tr>
    			<td><label>
    				<input type="radio" name="reg_news" value="1" id="reg_news_0" checked="checked" />
    				Si</label></td>
    			</tr>
    		<tr>
    			<td><input type="radio" name="reg_news" value="0" id="reg_news_1" />
No</td>
    			</tr>
    		<tr></tr>
    		</table></td>
    	</tr>
    <tr>
    	<td>&nbsp;</td>
    	<td align="left">&nbsp;</td>
    	</tr>
    <tr>
      <td colspan="2" align="center">
      	
      	<input type="submit" name="enviar" id="enviar" value="Enviar" />
      	<!--input type="submit" name="enviar" id="enviar" value="Enviar" onclick="document.body.style.cursor='wait';" /-->      	</td>
      </tr>
    <tr>
    	<td colspan="2" align="center"><a href="politicas_privacidad.php" target="_blank" style="color:#ff0000;"><strong>He leido y acepto el Aviso de Privacidad</strong></a></td>
    	</tr>
  </table>
  <input type="hidden" name="area_programa" id="area_programa" value="<?php echo $area; ?>" />
  <input type="hidden" name="id_program" id="id_program" value="<?php echo $_GET['id_program']; ?>" />
</form>

<!--form action="http://www.dec-uia.com/cgi-bin/dada/mail.cgi" method="post" target="_blank" name="form_news_2" id="form_news_2">
  <table width="100%" border="0" cellspacing="0" cellpadding="2">
  	<tr>
  		<td width="30%" align="right">&iquest;Suscribirse al Newsletter?</td>
  		<td width="70%" align="left">
		
		
			<table width="170" border="0" align="left" cellpadding="0" cellspacing="0">
			  <tr>
			  	<td align="left">
			  		<input type="checkbox" name="f" id="f_s" value="subscribe" checked="checked" />
			  		<input type="hidden" name="list" value="newsDEC" />
			  		
			  		<input name="email" type="hidden" id="email_news" value="" size="15" class="news_input" placeholder="email" /></td>
			  	</tr>
			</table>
		 
				
		</td>
  	</tr>
  	<!--tr>
  		<td align="right">&nbsp;</td>
  		<td align="left">&nbsp;</td>
  		</tr>
  	<tr>
  		<td align="right">&nbsp;</td>
  		<td align="left"><input type="button" value="Enviar" class="processing" onclick="validate();" /></td>
  		</tr-->
  	<!--/table>
	 </form-->

 	</td>
</tr>
</table>

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
