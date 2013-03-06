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
/*if($_POST['fechas_ini']!=NULL){
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
}*/

$id_program = $_POST['id_program'];
$fecha_registro = date('Y-m-d H:i:s');
$modalidad = $_POST['modalidad'];

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

if($_POST['como_se_entero']==NULL){
	$como_se_entero = $_POST['otromedio'];
}else{
	$como_se_entero = $_POST['como_se_entero'];
}


switch($_POST['genero']){
	case "F":
	$genero = "Femenino";
	break;
	case "M";
	$genero = "Masculino";
	break;	
	}
	
switch($_POST['propuesta']){
	case 0:
	$propuesta = "No";
	break;
	case 1:
	$propuesta = "Si";
	break;
	}

//Información Personal
$email = $_POST['correo'];
$a_paterno = $_POST['a_paterno'];
$a_materno = $_POST['a_materno'];
$nombre = $_POST['nombre'];
$ciudad = $_POST['ciudad'];
$estado = $_POST['estado'];
//$genero = $_POST['genero'];
$rfc = $_POST['rfc'].$_POST['rfc2'].$_POST['rfc3'];

$special_char_strip = array(" ", "/", "-", "(", ")", "_");

$extension = $_POST['ext'];

$telefono = $_POST['telefono']." - ".$extension;
$celular = $_POST['celular'];
$correo = $_POST['correo'];
$nacionalidad = $_POST['nacionalidad'];

$fecha_nacimiento = $_POST['anio_nac']."-".$_POST['mes_nac']."-".$_POST['dia_nac'];

//Informacion Laboral

$puesto=$_POST['puesto'];
$num_expediente=$_POST['num_expediente'];
$organo=$_POST['organo'];
$nombre_propuesta = $_POST['nombre_propuesta'];
$cargo_propuesta = $_POST['cargo_propuesta'];


if(isset($_POST['send_form']) && $_POST['send_form'] == 1){


$insertSQL = "INSERT INTO sp_preinscritos_pjf (
fecha_registro,
modalidad,
a_paterno,
a_materno,
nombre,
genero,
fecha_nac,
ciudad,
estado,
rfc,
telefono,
correo,
puesto,
num_expediente,
organo_adscripcion,
recibio_propuesta,
nombre_propuesta,
cargo_propuesta)
VALUES (
'$fecha_registro',
'$modalidad',
'$a_paterno',
'$a_materno',
'$nombre',
'$genero',
'$fecha_nacimiento',
'$ciudad',
'$estado',
'$rfc',
'$telefono',
'$correo',
'$puesto',
$num_expediente,
'$organo',
'$propuesta',
'$nombre_propuesta',
'$cargo_propuesta'
)";



mysql_select_db($database_otono2011, $otono2011);
$Result1 = mysql_query($insertSQL, $otono2011) or die(mysql_error());

}

try{
	
	/*CONSTRUCCION DEL MENSJAE PARA ENVIAR EN EL MAIL*/

$mensaje="<strong>&Aacute;rea:</strong> ".$nombre_area."<br />";
$mensaje.="<strong>Nombre del programa:</strong> ".$nombre_programa."<br />";
/*$mensaje.="<strong>Se enteró del programa através de:</strong><br />";

if($how != NULL)
{
	$mensaje.= $how."<br />";
}

if($otro_medio != NULL) 
{
	$mensaje.="Otro medio: ".$otro_medio."<br />";
}*/

$mensaje.="<br /><strong>Información Personal:</strong><br /><br />";
$mensaje.="<strong>Modalidad elegida:</strong> ".$modalidad."<br />";
$mensaje.="<strong>A. Paterno:</strong> ".$a_paterno."<br />";
$mensaje.="<strong>A. Materno:</strong> ".$a_materno."<br />";
$mensaje.="<strong>Nombre:</strong> ".$nombre."<br />";
$mensaje.="<strong>Género:</strong> ".$genero."<br />";
$mensaje.="<strong>Fecha de nacimiento:</strong> ".$_POST['dia_nac']."-".$_POST['mes_nac']."-".$_POST['anio_nac']."<br />";
/*$mensaje.="<strong>Domicilio:</strong> ".$calle_numero."<br />";
$mensaje.="<strong>Colonia:</strong> ".$colonia."<br />";
$mensaje.="<strong>Del./Mpo./Población:</strong> ".$del_mpo."<br />";
$mensaje.="<strong>C.P.:</strong> ".$cp."<br />";*/
$mensaje.="<strong>Estado de residencia:</strong> ".$estado."<br />";
$mensaje.="<strong>Ciudad de residencia:</strong> ".$ciudad."<br />";
$mensaje.="<strong>RFC:</strong> ".$rfc."<br />";
$mensaje.="<strong>Tel. oficina:</strong> ".$_POST['telefono']."<br />";
if(isset($extension) && $extension != NULL){
$mensaje.="<strong>Extensión:</strong> ".$extension."<br />";	
	}
//$mensaje.="<strong>Cel:</strong> ".$celular."<br />";
$mensaje.="<strong>Email:</strong> ".$correo."<br />";
$mensaje.="<strong>Número de expediente (PJF):</strong> ".$num_expediente."<br />";
$mensaje.="<strong>Cargo:</strong> ".$puesto."<br />";
$mensaje.="<strong>Órgano de adscripción:</strong> ".$puesto."<br />";



/*$mensaje.="<br /><strong>Información Académica:</strong><br /><br />";
$mensaje.="<strong>Grado académico:</strong> ".$grado_academico."<br />";
$mensaje.="<strong>Institución de estudios:</strong> ".$institucion_estudios."<br />";
$mensaje.="<strong>Porqué eligió a la Ibero:</strong> ".$porque_la_ibero."<br />";
$mensaje.="<strong>Ex Alumno UIA:</strong> ".$exalumno."<br />";

$mensaje.="<br /><strong>Información Laboral:</strong><br /><br />";
$mensaje.="<strong>Empresa:</strong> ".$empresa."<br />";
$mensaje.="<strong>Teléfono:</strong> ".$telefono_empresa."<br />";
$mensaje.="<strong>Fax:</strong> ".$direccion_empresa."<br /><br /><br />";*/

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

$mail_title = "DEC - Preinscripción";
		mail("daniel.garcia@estrategasdigitales.com", $mail_title, $mensaje, $headers);
//mail("ec.online@ibero.mx", $mail_title, $mensaje, $headers);
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
/*	mail($to_coord_b, $mail_title, $mensaje_coord, $headers);*/
	
}while($row_coord_mails = mysql_fetch_assoc($coord_mails));

//mail('pvazquezdiaz@gmail.com', $mail_title, $mensaje_coord, $headers);

$mensaje_user = 'Tu preinscripción al '.$nombre_programa.' ha sido recibida';
$mensaje_user .= '<br /><br />La lista de admitidos se publicará en las páginas electrónicas del Instituto de la Judicatura Federal y de las Reformas Penal, de Juicio de Amparo y Derechos Humanos, el 31 de octubre de 2012.';
$mensaje_user .= '<br /><br />Gracias.';
$mensaje_user .= '<br /><br />';
$mensaje_user .= '<br /><br />Dirección de Educación Continua - Universidad Iberoamericana Campus Santa Fe.';
$headers = "From: " . strip_tags($to_coord) . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
mail($email, 'Te has preinscrito exitosamente.', $mensaje_user, $headers);

mysql_select_db($database_otono2011, $otono2011);
$query_ult_preinscrito = "SELECT id_preinscrito FROM sp_preinscritos_pjf WHERE num_expediente=".$num_expediente;
$ult_preinscrito = mysql_query($query_ult_preinscrito, $otono2011) or die(mysql_error());
$row_ult_preinscrito = mysql_fetch_assoc($ult_preinscrito);


mysql_select_db($database_otono2011, $otono2011);
$query_ult_preinscrito = "SELECT id_preinscrito FROM sp_preinscritos_pjf WHERE num_expediente=".$num_expediente;
$ult_preinscrito = mysql_query($query_ult_preinscrito, $otono2011) or die(mysql_error());
$row_ult_preinscrito = mysql_fetch_assoc($ult_preinscrito);

header('Location: http://dec-uia.com/otono_2011/acuse.php?id_preinscrito='.$row_ult_preinscrito['id_preinscrito']);
//para mandar el mail en texto plano.


} catch (Exception $e){
	
	$error_var = 'Excepción capturada: '.  $e->getMessage(). "\n";
	$headers = "From: webmaster@dec-uia.com\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";	
	$headers .= 'Cc: webmaster@dec-uia.com' . "\r\n";
	
	/*mail('webmaster@dec-uia.com','Error en preinscripción', $error_var, $headers);*/
	
	header('Location: preinscripcion_fallida.php');
	
}



}
mysql_select_db($database_otono2011, $otono2011);
$query_disciplines_names = "SELECT * FROM disciplines WHERE id_discipline != 22 AND id_discipline != 19 ORDER BY discipline ASC";
$disciplines_names = mysql_query($query_disciplines_names, $otono2011) or die(mysql_error());
$row_disciplines_names = mysql_fetch_assoc($disciplines_names);
//$totalRows_disciplines_names = mysql_num_rows($disciplines_names);

mysql_select_db($database_otono2011, $otono2011);
$query_programas = "SELECT id_program, program_type, program_name FROM site_programs WHERE cancelado = 0 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE periodo = 'o') ORDER BY program_type DESC, program_name ASC";
$programas = mysql_query($query_programas, $otono2011) or die(mysql_error());
$row_programas = mysql_fetch_assoc($programas);

/*if($_GET['discipline']==NULL || $_GET['discipline']==0){
	mysql_select_db($database_otono2011, $otono2011);
	$query_diplos_names = "SELECT * FROM site_programs WHERE program_type ='diplomado' AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE periodo = 'o') ORDER BY program_name ASC";
	$diplos_names = mysql_query($query_diplos_names, $otono2011) or die(mysql_error());
	$row_diplos_names = mysql_fetch_assoc($diplos_names);
	$totalRows_diplos_names = mysql_num_rows($diplos_names);
	
	mysql_select_db($database_otono2011, $otono2011);
	$query_cursos_names = "SELECT * FROM site_programs WHERE program_type ='curso' AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE periodo = 'o') ORDER BY program_name ASC";
	$cursos_names = mysql_query($query_cursos_names, $otono2011) or die(mysql_error());
	$row_cursos_names = mysql_fetch_assoc($cursos_names);
	$totalRows_cursos_names = mysql_num_rows($cursos_names);
}else{
	$area = $_GET['discipline'];
	mysql_select_db($database_otono2011, $otono2011);
	$query_diplos_names = "SELECT * FROM site_programs WHERE id_discipline = $area AND program_type ='diplomado' AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE periodo = 'o') ORDER BY program_name ASC";
	$diplos_names = mysql_query($query_diplos_names, $otono2011) or die(mysql_error());
	$row_diplos_names = mysql_fetch_assoc($diplos_names);
	$totalRows_diplos_names = mysql_num_rows($diplos_names);
	
	mysql_select_db($database_otono2011, $otono2011);
	$query_diplos_names_2 = "SELECT * FROM site_programs WHERE id_discipline_alterna != 'NULL' AND program_type ='diplomado' AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE periodo = 'o') ORDER BY program_name ASC";
	$diplos_names_2 = mysql_query($query_diplos_names_2, $otono2011) or die(mysql_error());
	$row_diplos_names_2 = mysql_fetch_assoc($diplos_names_2);
	$totalRows_diplos_names_2 = mysql_num_rows($diplos_names_2);
	
	mysql_select_db($database_otono2011, $otono2011);
	$query_cursos_names = "SELECT * FROM site_programs WHERE id_discipline = $area AND program_type ='curso' AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE periodo = 'o') ORDER BY program_name ASC";
	$cursos_names = mysql_query($query_cursos_names, $otono2011) or die(mysql_error());
	$row_cursos_names = mysql_fetch_assoc($cursos_names);
	$totalRows_cursos_names = mysql_num_rows($cursos_names);
	
	mysql_select_db($database_otono2011, $otono2011);
	$query_cursos_names_2 = "SELECT * FROM site_programs WHERE id_discipline_alterna != 'NULL' AND program_type ='curso' AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE periodo = 'o') ORDER BY program_name ASC";
	$cursos_names_2 = mysql_query($query_cursos_names_2, $otono2011) or die(mysql_error());
	$row_cursos_names_2 = mysql_fetch_assoc($cursos_names_2);
	$totalRows_cursos_names_2 = mysql_num_rows($cursos_names_2);
}*/

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
$(document).ready(function(){
	

	
var num_exp_ok = false;
var num_exp = $("#num_expediente");
var num_expInfo = $("#num_expInfo");

num_exp.live("change", function(){
	
$.ajax({
type: "POST",
data: "numero="+$("#num_expediente").val(),
url: "check.php",
beforeSend: function(){
num_expInfo.html("Verificando…"); //show checking or loading image
},
success: function(data){
if(data == "invalid")
{
num_exp_ok = false;
num_expInfo.html("<strong>Ya estás registrado</strong>");
$("#enviar").attr("disabled", "disabled")
}
else if(data != 0)
{
num_exp_ok = false;
num_expInfo.html("<strong>Ya estás registrado</strong>");
$("#enviar").attr("disabled", "disabled")
}
else if(data == 0)
{
num_exp_ok = true;
num_expInfo.html("");
$("#enviar").removeAttr("disabled")
}
}
});
});
})
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
function validate(){
	   
	   //___ NUEVO CODIGO ---
	   
	    var requiredFieldsAlertMsg = "Los siguientes campos son requeridos:\n\n";
		var cont = 0;
		  
		  if($('input#sipropuesta:radio').is(':checked')){
			  
			if ($('input[name="cargo_propuesta"]:radio').is(':checked')) {
			 //--
		 		}else{
			
				requiredFieldsAlertMsg += "* Cargo del titular que lo propone\n";
				cont++;
			
			}
			
			if ($('input#nombre_propuesta').val()=='') {
			 
				requiredFieldsAlertMsg += "* Nombre del titular que lo propone\n";
				cont++;
			}
			nombre_propuesta
			
		  }else if($('input#nopropuesta:radio').is(':checked')){
			  
			  
			  }else{}
		  
		  if($('select#id_program').val()==0){
			  requiredFieldsAlertMsg += "* Programa\n";
				cont++;
		  }
		  
		  if($('select#anio_nac').val()==0) {
			 //--
				requiredFieldsAlertMsg += "* Fecha de nacimiento\n";
				cont++;
			
		}
		
		if ($('input[name=modalidad]:radio').is(':checked')) {
			 //--
		 }else{
			
				requiredFieldsAlertMsg += "* Modalidad\n";
				cont++;
			
		}
		 
		 if ($('input[name=genero]:radio').is(':checked')) {
			 //--
		 }else{
			
				requiredFieldsAlertMsg += "* Género\n";
				cont++;
			
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
		if($('input#calle_numero').val()==''){
			requiredFieldsAlertMsg += "* Calle y número\n";
			cont++;
		}
		if($('input#colonia').val()==''){
			requiredFieldsAlertMsg += "* Colonia\n";
			cont++;
		}
		if($('input#del_mpo').val()==''){
			requiredFieldsAlertMsg += "* Delegación o  municipio\n";
			cont++;
		}
		if($('input#cp').val()==''){
			requiredFieldsAlertMsg += "* Código postal\n";
			cont++;
		}
		if($('input#rfc').val()==''){
			requiredFieldsAlertMsg += "* RFC\n";
			cont++;
		}else if($('input#rfc2').val()==''){
			requiredFieldsAlertMsg += "* RFC\n";
			cont++;
		}
		
		if($('input#telefono').val()==''){
			requiredFieldsAlertMsg += "* Teléfono\n";
			cont++;
		}
		if($('input#correo').val()==''){
			requiredFieldsAlertMsg += "* E-mail\n";
			cont++;
		}else{
			var a = $('input#correo').val();
		    var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
			if(filter.test(a)){
				//NADA
			}
			else{
				requiredFieldsAlertMsg += '* La dirección de correo no es válida\n';
				cont++;
			}
		}
		
		if($('input#num_expediente').val()==''){
			requiredFieldsAlertMsg += "* Número de expediente\n";
			cont++;
		}
		

		
		if($('input#organo').val()==''){
			requiredFieldsAlertMsg += "* Órgano de adscripción\n";
			cont++;
		}
		
		if($('input#puesto').val()==''){
			requiredFieldsAlertMsg += "* Cargo\n";
			cont++;
		}
		
		if($('select#estado').val()==0){
			requiredFieldsAlertMsg += "* Estado\n";
			cont++;
		}
		
		if($('input#ciudad').val()==''){
			requiredFieldsAlertMsg += "* Ciudad\n";
			cont++;
		}
		
		//EMRPESA
		if($('input#empresa').val()==''){
			requiredFieldsAlertMsg += "* Empresa\n";
			cont++;
		}
		
		if($('#direccion_empresa').val()==''){
			requiredFieldsAlertMsg += "* Dirección de la empresa\n";
			cont++;
		}
		if($('input#telefono_empresa').val()==''){
			requiredFieldsAlertMsg += "* Teléfono de la empresa\n";
			cont++;
		}
		
		if(cont>0){
			alert(requiredFieldsAlertMsg);
			return false;
	}else{
	   //return false;
	   if($('form#form_news_2 input#f_s').is(':checked')){
		$('form#form_news_2 input#email_news').attr('value',$('form#form1 input#email').val());
			document.forms.form_news_2.submit();
		}
	   
	   /*return alert('La lista de admitidos se publicará en las páginas electrónicas del Instituto de la Judicatura Federal y de las Reformas Penal, de Juicio de Amparo y Derechos Humanos, el 31 de octubre de 2012.');*/

	}		
}

function deshabilitar_campos(){
	if($('#no_labora').is(':checked')){
		$('#empresa').attr('value','N/A');
		$('#empresa').attr('disabled','disabled');
		
		$('#puesto').attr('disabled','disabled');
		$('#puesto').attr('value','N/A');
		
		$('#direccion_empresa').attr('disabled','disabled');
		$('#direccion_empresa').text('N/A');
		
		$('#telefono_empresa').attr('disabled','disabled');
		$('#telefono_empresa').attr('value','N/A');
	}else{
		$('#empresa').removeAttr('disabled');
		$('#empresa').attr('value','');
		
		$('#puesto').removeAttr('disabled');
		$('#puesto').attr('value','');
		
		$('#direccion_empresa').removeAttr('disabled');
		$('#direccion_empresa').text('');
		
		$('#telefono_empresa').removeAttr('disabled');
		$('#telefono_empresa').attr('value','');
		
	}
}

function clear_radios(){
	//alert('-');
	$('input[name="como_se_entero"]').each(function(){
		var checked = $(this).attr('checked', true);
		if(checked){ 
			$(this).attr('checked', false);
			}
	});
}

function clear_otromedio(){
	$('input#otromedio').val('')
}

function isNumeric(campo,msg){
	var numericExpression = /^[0-9]+$/;
	var data = lengthRestriction(campo);
	if((campo.value.match(numericExpression))&&(data == true)){
		return true;
	}else{
		alert(msg);
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
<script>
function load_programs(id_discipline)
{
	//alert(id_discipline);
	$('select#id_program').html('<option>Cargando...</option>');	
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
        <?php if($_SERVER['PHP_SELF'] == "/otono_2011/extras.php"){ ?>
        
        <?php }else{ ?>
        <li> |</li>
        <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/preinscripcion.php'">Preinscripci&oacute;n</a></li>
        <?php }?>
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
            <li><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=4'">Comunicaci&oacute;n</a></li>
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
	  <p>
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
	    </p>
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
					<table width="100%" border="0" align="left" cellpadding="2">
<tr>
	<td width="90%" height="30" align="left" valign="middle" class="titulos_diplo"><strong>Preinscripci&oacute;n</strong></td>
</tr>
<tr>
	<td height="30" align="left" valign="middle">
	
		<form name="registro" id="registro" action="extras_a.php" method="post" onsubmit="return validate();">
        <input type="hidden" name="id_program" value="401" />
			<table width="500" border="0" cellspacing="0" cellpadding="5">
				<tr>
					<td colspan="2" align="center"><strong>Informaci&oacute;n personal</strong></td>
					</tr>
				<tr>
				  <td width="92" align="right" valign="top">* Modalidad</td>
				  <td width="388" align="left"><input type="radio" name="modalidad" value="presencial"/>&nbsp;Presencial<input type="radio" name="modalidad" value="virtual" checked="checked"/>&nbsp;Virtual<br /><br />
                  <span style="font-size:10px;">* La modalidad presencial tiene un cupo de 200 personas. En caso de no ser seleccionado para esta modalidad se considerará que solicita su inscripción a la modalidad virtual, la cual tiene un cupo de 5000 personas</span></td>
				  </tr>
                  <tr>
					<td colspan="2" align="center">
                    	<table>
                    		<tr>
                            	<td width="282">&iquest;Lo propone un magistrado de circuito, juez de distrito o titular en el Consejo de la Judicatura Federal?
                                </td>
                            	<td width="196"><input type="radio" name="propuesta" id="sipropuesta" value="1"/>&nbsp;S&iacute;&nbsp;&nbsp;<input type="radio" name="propuesta" id="nopropuesta" value="0" checked="checked"/>No</td>
                            </tr>

                         </table>
                    </td>
					</tr>
                    <tr id="cargo_prop" style="display:none;">
                        <td valign="top" align="right">
                        * Cargo del titular que lo propone
                        </td>
                        <td>
                        <input type="radio" name="cargo_propuesta" value="Magistrado de Circuito" />&nbsp;Magistrado de Circuito<br />
                        <input type="radio" name="cargo_propuesta" value="Juez de Distrito"/>&nbsp;Juez de Distrito<br />
                        <input type="radio" name="cargo_propuesta" value="Titular en el Consejo de la Judicatura Federal"/>&nbsp;Titular en el Consejo de la Judicatura Federal<br />
                         <input type="radio" name="cargo_propuesta" value="Otro"/>&nbsp;Otro<br />
                        </td>
                    </tr>
                    <tr id="nom_prop" style="display:none;">
                        <td align="right" valign="top">* Nombre del titular que lo propone</td>
                        <td><input type="text" id="nombre_propuesta" name="nombre_propuesta" size="30"/></td>
                    </tr>
				<tr>
					<td align="right" valign="top">* A. Paterno</td>
					<td valign="top"><label for="a_paterno"></label>
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
						<input name="nombre" type="text" id="nombre" onchange="populate_rfc_name()" size="30" /><br />
						<span style="font-size:10px;">*Recuerda que tu diploma quedar&aacute; con el mismo nombre que ingreses aqu&iacute;</span></td>
				</tr>
				<tr>
				  <td align="right" valign="top">* G&eacute;nero</td>
				  <td valign="top"><input type="radio" name="genero" value="F"/> Femenino<input type="radio" name="genero" value="M"/> Masculino</td>
				  </tr>
				<tr>
                	<td align="right" valign="top">* Fecha de nacimiento</td>
					<td valign="top"><table width="211" border="0" cellspacing="0" cellpadding="0">
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
                            <option value="0" disabled="disabled" selected="selected"></option>
							</select></td>
						</tr>
					</table></td>
                </tr>
				<tr>
					<td align="right" valign="top">* RFC personal</td>
					<td valign="top">
						<input name="rfc" type="text" id="rfc" size="4" maxlength="4" />
						<input name="rfc2" type="text" id="rfc2" size="6" maxlength="6" />
						<input name="rfc3" type="text" id="rfc3" size="3" maxlength="3" />
                       
						<p><span style="font-size:10px;">*<strong> Favor de revisar que el RFC sea correcto.</strong><br />
							Si cuentas con homoclave, favor de proporcionarla. Gracias.</span></p></td>
				</tr>
                <tr>
					<td align="right" valign="top">* E-mail</td>
					<td valign="top"><label for="correo"></label>
						<input name="correo" type="text" id="correo" size="30" /></td>
				</tr>
                <tr>
                  <td align="right" valign="top">* N&uacute;mero de expediente (PJF)</td>
                  <td valign="top" ><input type="text" id="num_expediente" name="num_expediente" size="30"/><div id="num_expInfo" align="left"></div></td>

                </tr>
                <tr>
                  <td align="right" valign="top">* &Oacute;rgano de adscripci&oacute;n</td>
                  <td valign="top"><input type="text" name="organo" id="organo" size="30" /></td>
                </tr>
                <tr>
                  <td align="right" valign="top">* Cargo</td>
                  <td valign="top"><input type="text" name="puesto" id="puesto" size="30" /></td>
                </tr>
                <tr>
					<td align="right" valign="top">* Tel. oficina</td>
					<td valign="top">
						<label for="telefono"></label>
						<input name="telefono" type="text" id="telefono" size="30" />
						&nbsp;&nbsp;&nbsp;Ext. 
						<input type="text" name="ext" size="8" />
						<p>*<strong>Incluir clave lada<br />No uses espacios, par&eacute;ntesis o guiones.</strong></p></td>
				</tr>
				<tr>
					<td align="right" valign="top">* Estado de residencia</td>
                     <td valign="top">
                     <select name="estado" id="estado">
                     	<option value="0" selected="selected">-Selecciona un estado-</option>
                        <option value="Aguascalientes">Aguascalientes</option>
                        <option value="Baja California">Baja California</option>
                        <option value="Baja California Sur">Baja California Sur</option>
                        <option value="Campeche">Campeche</option>
                        <option value="Chiapas">Chiapas</option>
                        <option value="Chihuahua">Chihuahua</option>
                        <option value="Coahuila de Zaragoza">Coahuila de Zaragoza</option>
                        <option value="Colima">Colima</option>
                        <option value="Distrito Federal">Distrito Federal</option>
                        <option value="Durango">Durango</option>
                        <option value="Guanajuato">Guanajuato</option>
                        <option value="Guerrero">Guerrero</option>
                        <option value="Hidalgo">Hidalgo</option>
                        <option value="Jalisco">Jalisco</option>
                        <option value="Mexico">Mexico</option>
                        <option value="Michoacan de Ocampo">Michoacan de Ocampo</option>
                        <option value="Morelos">Morelos</option>
                        <option value="Nayarit">Nayarit</option>
                        <option value="Nuevo Leon">Nuevo Leon</option>
                        <option value="Oaxaca">Oaxaca</option>
                        <option value="Puebla">Puebla</option>
                        <option value="Queretaro de Arteaga">Queretaro de Arteaga</option>
                        <option value="Quintana Roo">Quintana Roo</option>
                        <option value="San Luis Potosi">San Luis Potosi</option>
                        <option value="Sinaloa">Sinaloa</option>
                        <option value="Sonora">Sonora</option>
                        <option value="Tabasco">Tabasco</option>
                        <option value="Tamaulipas">Tamaulipas</option>
                        <option value="Tlaxcala">Tlaxcala</option>
                        <option value="Veracruz-Llave">Veracruz-Llave</option>
                        <option value="Yucatan">Yucatan</option>
                        <option value="Zacatecas">Zacatecas</option>
                        </select>
                    </td>
				</tr>
				
				<tr>
					<td align="right" valign="top">* Ciudad de residencia</td>
					<td valign="top"><label for="celular"></label>
						<input name="ciudad" type="text" id="ciudad" size="30" /></td>
				</tr>
				
					
				<tr>
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
	
	</td>
</tr>
</table>

					</td>
	  			</tr>
	  		</table>
       <script>
	   
	   $('input[name="propuesta"]').click(function(){
		   
		   	   	if($("#sipropuesta").is(':checked')){
		
		$("#cargo_prop").show()
		$('#nom_prop').show()
		}
		else if($("#nopropuesta").is(':checked')){
			
			$("#cargo_prop").hide()
			$("#nom_prop").hide()
			$('input[name="cargo_propuesta"]').removeAttr('checked')
			}
		   
		   
		   })

	   </script>
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
        	<td  align="center" valign="top" ><a href="#" onclick="parent.location='<? echo $row_banners['destino']; ?>'"><img src="imagenes/banners/<? echo $row_banners['img_banner']; ?>" width="191" border="0" align="middle" /></a></td>
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
