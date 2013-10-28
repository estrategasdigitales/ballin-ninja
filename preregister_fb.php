<?php require_once('Connections/trivia_2011.php'); ?>
<?php

mysql_select_db($database_trivia_2011, $trivia_2011);

if($_POST['nombre']!=NULL){
	
	$query_usuarios1 = "SELECT * FROM participantes WHERE email = '".$_POST['email1']."'";
	$usuarios1 = mysql_query($query_usuarios1, $trivia_2011) or die(mysql_error());
	//$row_usuarios1 = mysql_fetch_assoc($usuarios1);
	$totalRows_usuarios1 = mysql_num_rows($usuarios1);
	
	if($totalRows_usuarios1 == 0){
	
		$insertSQL = "INSERT INTO participantes (nombre, apellido, email, contrasena) VALUES ('".$_POST['nombre']."', '".$_POST['apellido']."', '".$_POST['email1']."', '".$_POST['password1']."')";
		
		$Result1 = mysql_query($insertSQL, $trivia_2011) or die(mysql_error());
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		$message_registro = '
		<p>Estimado '.$_POST['nombre'].'</p>
<p>&iexcl;Gracias por registrarte a la Trivia Ibero!</p>
		<p>Tu clave de acceso es: '.$_POST['password1'].'</p>
		<p>Podr&aacute;s jugar las veces que quieras.</p>
<p>En unos d&iacute;as podr&aacute;s ganar una de nuestras becas para cualquiera de nuestros cursos.*</p>
		<p>Revisa la oferta acad&eacute;mica en <a href="http://www.diplomados.uia.mx/" target="_blank">http://www.diplomados.uia.mx/</a></p>
		<p>Recuerda que si tus amigos registrados no participan, no sumar&aacute;s puntos. <strong>&iexcl;Inv&iacute;talos!</strong></p>
<p>&nbsp;</p>
<p>SI T&Uacute; SABES, T&Uacute; GANAS<br />&iexcl;Mucho &eacute;xito!</p>
		<p>ATTE:<br />
		Direcci&oacute;n de Educaci&oacute;n Continua, Universidad Iberoamericana Ciudad de M&eacute;xico.</p>
		<p style="font-size:9px;">*No aplica en diplomados, programas de licenciatura o posgrado. V&aacute;lido en la Ibero Ciudad de M&eacute;xico y sedes externas.</p>
		<p><img src="http://dec-uia.com/trivia_2012/images/banner_mail.jpg" /></p>';
		
		mail($_POST['email1'],'Confirmaci&oacute;n registro Trivia Ibero Oto&ntilde;o 2012',$message_registro,$headers);
		
		$query_usuarios1 = "SELECT id_participante FROM participantes ORDER BY id_participante DESC LIMIT 0,1";
		$usuarios1 = mysql_query($query_usuarios1, $trivia_2011) or die(mysql_error());
		$row_usuarios1 = mysql_fetch_assoc($usuarios1);
		
		for($i = 1; $i <= $_POST['cont']; $i++){
			
			if($_POST['correo_'.$i] != NULL){
				$insertSQL = "INSERT INTO recomendaciones (id_participante, correo, completo_trivia) VALUES ('".$row_usuarios1['id_participante']."', '".$_POST['correo_'.$i]."', 0)";
				
				$Result1 = mysql_query($insertSQL, $trivia_2011) or die(mysql_error());
				
				$message_invitado = '
				<p>Estimad@:</p>
 
				<p>'.$_POST['nombre'].' '.$_POST['apellido'].' te ha invitado a jugar en la Trivia Ibero.</p>
				<p>Participa  por becas de hasta el 100% para estudiar el curso* que siempre has deseado. S&oacute;lo demuestra tus conocimientos contestando correctamente las preguntas y gana.				</p>
				<p>Revisa nuestra oferta acad&eacute;mica en <a href="http://www.diplomados.uia.mx/">http://www.diplomados.uia.mx/</a></p>
				
				<p>&iexcl;No dejes pasar esta extraordinaria oportunidad!</p>
				 
				<p>PARA PARTICIPAR REGISTRATE EN <a href="http://www.diplomados.uia.mx/extras.php">http://www.diplomados.uia.mx/extras.php</a></p>
				
				<p>Síguenos en <a href="http://www.facebook.com/diplomados.uia/app_203351739677351">Facebook</a> para conocer m&aacute;s detalles.</p>
				 
<p>SI T&Uacute; SABES, T&Uacute; GANAS</p>
				 
				<p>ATTE:<br /> 
				Direcci&oacute;n de Educaci&oacute;n Continua, Universidad Iberoamericana Ciudad de M&eacute;xico.</p>
				<p style="font-size:9px;">*No aplica en diplomados, programas de licenciatura o posgrado. V&aacute;lido en la Ibero Ciudad de M&eacute;xico y sedes externas.</p>
				<p><img src="http://dec-uia.com/trivia_2012/images/banner_mail.jpg" /></p>';
				
				mail($_POST['correo_'.$i],'Gana una BECA en la Ibero.',$message_invitado,$headers);
			}
			
		}
		
		header("Location: extras_fb.php?type=0&user=true&reg_news=".$_POST['reg_news']."&email=".$_POST['email1']);
	
	}else{
	
		header("Location: extras_fb.php?type=0&user=true&reg_news=".$_POST['reg_news']."&email=".$_POST['email1']);
		
	}
}

mysql_free_result($usuarios);
?>