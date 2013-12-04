<script src="Scripts/ie_detect.js"></script>
<link href="css/estilos.css" rel="stylesheet" type="text/css" />
<?php
$connect=mysql_connect("localhost","decuiaco","DEC2010")
or die ("Fallo en el establecimiento de la conexi&oacute;n");
mysql_select_db("decuiaco_site",$connect)
or die ("Fallo en la tabla");
// Check connection

$nombre = utf8_encode($_POST['Nombre']);
$apellido_p = utf8_decode($_POST['Apellido']);
$email = $_POST['email'];

if ((!trim($nombre))||(!trim($apellido_p))||(!trim($email))){
   echo "Disculpe no puede dejar campos vac&iacute;os, intentelo nuevamente<br><br>";
   echo "Espere... sera redireccionado en 5 segundos";
   ?>
   <meta http-equiv="Refresh" content="5; URL=http://www.diplomados.uia.mx/extras.php">
   <?php
   }else{
	   	

$nombre = utf8_decode($_POST['Nombre']);
$apellido_p = utf8_decode($_POST['Apellido']);
$email = $_POST['email'];

$sql = "SELECT MAX(codigo) AS nueva_clave FROM site_promos WHERE codigo LIKE 'PI7%'";
$promo_query = mysql_query($sql) or die(mysql_error());
$row_promo_query = mysql_fetch_assoc($promo_query);

$code = $row_promo_query['nueva_clave'];
$divided = explode("-", $code);
$numero = intval($divided[1]);
$numero++;
$largo = strlen($numero);

switch($largo){
	case 1:
	$codigo = "PI7-000".$numero;
	break;
	case 2:
	$codigo = "PI7-00".$numero;
	break;
	case 3:
	$codigo = "PI7-0".$numero;
	break;
	case 4:
	$codigo = "PI7-".$numero;
	break;
	case 5:
	$codigo = "PI7-".$numero;
	break;
}

$query = sprintf("INSERT INTO site_promos (nombre,a_paterno,mail,codigo) 
				  VALUES ('%s','%s','%s','%s')",
				  mysql_real_escape_string(htmlentities($nombre, ENT_COMPAT, 'ISO-8859-1')),
				  mysql_real_escape_string(htmlentities($apellido_p,  ENT_COMPAT, 'ISO-8859-1')),
				  mysql_real_escape_string(htmlentities($email, ENT_COMPAT, 'UTF-8')),
				  mysql_real_escape_string(htmlentities($codigo, ENT_COMPAT, 'UTF-8')));
$ejequery=mysql_query($query,$connect);

	

$my_error = mysql_error($connect);
if(!empty($my_error)) { 
echo "Ha habido un error al insertar los valores.<br>"; 
} else{
?>
<meta http-equiv="Refresh" content="0; URL=http://www.dec-uia.com/otono_2011/extras3.php">

<?php    
	$headers = "From: Diplomados y cursos Ibero\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
	$mail_title = mb_convert_encoding($mail_title,"ISO-8859-1","UTF-8");
	$mail_title = "Código de promoción Ibero 70 años";
	$mensaje = "Gracias por registrarte a nuestra Promoci&oacute;n Ibero 70 a&ntilde;os <br>
				Tu c&oacute;digo para aplicar es <b>".$codigo.".</b> Es importante tenerlo a la mano al momento de tu preinscripci&oacute;n en l&iacute;nea.<br>
				Para hacer v&aacute;lida tu promoci&oacute;n debes tomar en cuenta lo siguiente:<br><br>
				<ul>
				<li>Conserva tu C&Oacute;DIGO.</li>
				<li>Completa  el FORMATO DE PREINSCRIPCI&Oacute;N en l&iacute;nea donde deber&aacute;s ingresar el programa de tu inter&eacute;s.</li>
				<li>Personal de la Direcci&oacute;n de Educaci&oacute;n Continua de la Ibero  se pondr&aacute; en contacto contigo para avisarte en caso de que  el programa que elegiste solicite REQUISITOS EXTRA.</li>
				<li>Si tu programa solicita REQUISITOS EXTRA c&uacute;mplelos a la brevedad para evitar perder la promoci&oacute;n.</li>
				<li>Una vez completada tu preinscripci&oacute;n y cumplidos los requisitos extra recibir&aacute;s por correo electr&oacute;nico tu CLAVE DE PAGO, a partir de ese momento tendr&aacute;s 3 d&iacute;as para efectuar el pago correspondiente aplicando el 40% de descuento.</li>
				<li>Atiende todas las bases*</li>
				</ul>
				<br>
				Para iniciar tu PREINSCRIPCI&Oacute;N haz clic en el enlace: <a href=http://www.diplomados.uia.mx/preinscripcion.php>http://www.diplomados.uia.mx/preinscripcion.php</a>
				<br>Si no puedes abrir el enlace, intenta copiarlo y pegarlo en tu navegador.
				<br><br>
				*BASES  DE LA PROMOCI&Oacute;N
				<ul>
				<li>Descuento no acumulable con otras promociones. </li>
				<li>Promoci&oacute;n v&aacute;lida del 12 al 15 de marzo de 2013.  </li>
				<li>No aplica descuento para quienes ya est&eacute;n inscritos . </li>
				<li>Aplica sobre el costo total del programa. </li>
				<li>V&aacute;lido para todos los programas primavera 2013. </li>
				</ul>
				<br>
				Para m&aacute;s informaci&oacute;n visita: <a href=http://www.diplomados.uia.mx>www.diplomados.uia.mx</a><br>
				&iexcl;Hasta pronto! 
				Si no realizaste esta solicitud, ignora y elimina este mensaje.
				<br><br>
				<span>No olvides leer el <a style=color:red href=http://www.dec-uia.com/otono_2011/politicas_privacidad.php>Aviso de Privacidad</a></span>
				";


    mail($email, $mail_title, $mensaje, $headers);



	$headers2 = "From: Diplomados y cursos Ibero\r\n";
	$headers2 .= "MIME-Version: 1.0\r\n";
	$headers2 .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$mail_title2 = mb_convert_encoding($mail_title2,"ISO-8859-1","UTF-8");
	$mail_title2 = "Nuevo Inscrito codigo ".$codigo."";
	$mensaje1 = "Nombre: ".$nombre.".<br>
				Apellido: ".$apellido_p."<br>
				correo: ".$email."<br>
				codigo: ".$codigo."<br>";

	
    mail('adrian@estrategasdigitales.com', $mail_title2, $mensaje1, $headers2);


}
if (mysql_errno() == 1062 ) {
      echo "El correo electronico ingresado ya esta registrado en nuestra base de datos.<br>";
      
} else {
      echo mysql_error();
}
mysqli_close($con);
}

?>
