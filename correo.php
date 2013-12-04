<?php

$nombres="Adrian";
$apellidos="Guerrero";
$institucion="Personal";
$correo="adrian@estrategas";
$ruta="ruta_prueba";

					$headers2 = "From: Universidad Iberoamericana\r\n";
					$headers2 .= "MIME-Version: 1.0\r\n";
					$headers2 .= "Content-Type: text/html; charset=UTF-8\r\n";
					$mail_title2 = mb_convert_encoding($mail_title2,"ISO-8859-1","UTF-8");
					$mail_title2 = "Nueva Postulación Mx Design Conference 2013";
					$mensaje1 = "Nombres: ".$nombres.".<br>
								Apellidos: ".$apellidos."<br>
								Institucion: ".$institucion."<br>
								correo: ".$correo."<br>
								Ver el Material que envio haciendo clic 
								<a href=".$ruta.">Aqu&iacute;</a>";

					
				    mail('adrian@estrategasdigitales.com', $mail_title2, $mensaje1, $headers2);

					$headers = "From: Universidad Iberoamericana\r\n";
					$headers .= "MIME-Version: 1.0\r\n";
					$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
					$mail_title = mb_convert_encoding($mail_title,"ISO-8859-1","UTF-8");
					$mail_title = "Confirmaci&oacute;n de Postulación";
					$mensaje = "Gracias por enviar tu postulaci&oacute;n, esta ser&aacute; revisada por el equipo de<br>
					Mx Design Conference 2013 y de ser seleccionada, te contactaremos.<br>
					Departamento de Dise&ntilde;o, Universidad Iberoamericana Ciudad de M&eacute;xico.
					<br>
					<br>
					Confirmation of Application<br>
					Thank you for submitting your application, it will be reviewed by the team of 
					Mx Design Conference 2013, we will keep in touch. Regards.<br>
					Design Department, Universidad Iberoamericana, M&eacute;xico City.
					";


    				mail('adrian@estrategasdigitales.com', $mail_title, $mensaje, $headers);
    				?>
    				<script>
					alert('Hemos recibido Satisfactoriamente tu registro');
					window.location.href='http://www.google.com';
					</script>
    