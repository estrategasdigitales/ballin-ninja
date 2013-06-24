<?php require_once('restrict_access.php'); ?>
<?php require_once('Connections/des_preinscritos.php'); ?>
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

//CODIGO PARA QUE ASIGNE FORMATO LOCAL A LAS FECHAS
setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
$today_date = date("Y-m-d");
//++++++++++++++++++++

function close()
{ 	?>
	<script>
	parent.location.reload();
	//parent.location='s_seguimiento.php?caso=<?php //echo $_GET['caso']."&estado=".$_GET['estado']."&discipline=".$_GET['discipline']."&id_program=".$_GET['program_temp']; ?>';
	parent.$.fn.colorbox.close();
	</script>
	<?php
}

if(isset($_POST['update_form']) && $_POST['update_form'] == 1){
	
	$update_query = "UPDATE sp_pasos_status SET
	envio_decse = 1,
	envio_claves = 1
	WHERE id_preinscrito = ".$_POST['id_preinscrito'];
			
	mysql_select_db($database_des_preinscritos, $des_preinscritos);
	
	$Result1 = mysql_query($update_query, $des_preinscritos) or die(mysql_error());
			
			if($_POST['id_discipline'] == 15){
				$para  = 'ec.online@ibero.mx, webmaster@dec-uia.com';
				$titulo = 'Claves para depósito bancario - Reenviar a alumno';
			}else{
				$para  = $_POST['user_mail'].', webmaster@dec-uia.com';
				$titulo = 'Claves para depósito bancario - Dirección de Educación Continua';
			}
			
			//----MENSAJE DE ENVIO DE CLAVES AL ALUMNO----//
			$msg = '<html>
					<head>
						<title>Referenacia CIE para pago en BBVA Bancomer</title>
					</head>
					<body>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td colspan="3" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold;">Universidad Iberoamericana A.C.</td>
					  </tr>
					  <tr>
						<td colspan="3" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold;">Dirección de Educación Continua</td>
					  </tr>
					  <tr>
						<td colspan="3" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold;">Referencia CIE para pago en BBVA Bancomer</td>
					  </tr>
					  <tr>
						<td colspan="3">&nbsp;</td>
					  </tr>
					  <tr>
						<td colspan="3" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold;">'.strftime("%d de %B de %Y", strtotime($today_date)).'</td>
					  </tr>
					  <tr>
						<td colspan="3">&nbsp;</td>
					  </tr>
					  <tr>
						<td colspan="3" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold;">Tesorería</td>
					  </tr>
					  <tr>
						<td colspan="3" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold;">&nbsp;</td>
					  </tr>
					  <tr>
						<td colspan="3" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold;">Alumno <span style="color:#069">'.$_POST['nombre'].'</span></td>
					  </tr>
					  <tr>
						<td colspan="3" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold;">Número de cuenta: <span style="color:#069">'.$_POST['numero_cuenta'].'</span></td>
					  </tr>
					  <tr>
						<td colspan="3" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold;">Programa: <span style="color:#069">'.$_POST['programa'].'</span></td>
					  </tr>
					  <tr>
						<td colspan="3" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold;">Clave: <span style="color:#069">'.$_POST['clave'].'</span></td>
					  </tr>
					  <tr>
						<td colspan="3" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold;">Generación: <span style="color:#069">'.$_POST['generacion'].'</span></td>
					  </tr>
					  <tr>
						<td colspan="3">&nbsp;</td>
					  </tr>
					  <tr>
						<td colspan="3" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold;">&nbsp;</td>
					  </tr>
					  <tr>
						<td colspan="3" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold;">Información para llenar la ficha de depósito de BBVA Bancomer</td>
					  </tr>
					  <tr>
						<td colspan="3">&nbsp;</td>
					  </tr>
					  <tr>
						<td align="right" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold;">Convenio CIE</td>
						<td align="center" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold;">Nombre del cliente</td>
						<td align="left" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold;">Referencia CIE</td>
					  </tr>
					  <tr>
						<td align="right" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#069">58207</td>
						<td align="center" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#069">UNIVERSIDAD IBEROAMERICANA A.C.</td>
						<td align="left" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#069">'.$_POST['referencia_cie'].'</td>
					</table>
					</body>
					</html>';
			//----HEADERS----//
			$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
			$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$cabeceras .= 'From: Dirección de Educación Continua - No responder <webmaster@dec-uia.com>';
			mail($para, $titulo, $msg, $cabeceras);
			//mail('pvazquezdiaz@gmail.com', $titulo, $msg, $cabeceras);
			//-----//
			$comentario = "<strong>No. Cta:</strong> ".$_POST['numero_cuenta'].";<br />";
			$comentario .= "<strong>Clave:</strong> ".$_POST['clave'].";<br />";
			$comentario .= "<strong>Generaci&oacute;n:</strong> ".$_POST['generacion'].";<br />";
			$comentario .= "<strong>Referencia CIE:</strong> ".$_POST['referencia_cie'].";<br />";
			$comentario .= "<strong>Generaci&oacute;n:</strong> ".$_POST['generacion']."<br />";
			$insertSQL = "INSERT INTO sp_comentarios (id_preinscrito, id_paso, comentario, fecha) VALUES ('".$_POST['id_preinscrito']."', '3', '$comentario','". date('Y-m-d') ."')";
			
			//mysql_select_db($database_seg_preinscripciones, $seg_preinscripciones);
			$Result2 = mysql_query($insertSQL, $des_preinscritos) or die(mysql_error());
			
			$insert_query = "INSERT INTO sp_claves_decse (
			id_preinscrito,
			id_discipline,
			id_program,
			numero_de_cuenta,
			clave,
			generacion,
			referencia_cie)
			VALUES(
			'".$_POST['id_preinscrito']."',
			'".$_POST['id_discipline']."',
			'".$_POST['id_program']."',
			'".$_POST['numero_cuenta']."',
			'".$_POST['clave']."',
			'".$_POST['generacion']."',
			'".$_POST['referencia_cie']."'
			)";			
								
			$Result1 = mysql_query($insert_query, $des_preinscritos) or die(mysql_error());
	
	close();
}

mysql_select_db($database_des_preinscritos, $des_preinscritos);
$query_preinscrito = "SELECT * FROM sp_preinscritos WHERE id_preinscrito = ".$_GET['id_preinscrito'];
$preinscrito = mysql_query($query_preinscrito, $des_preinscritos) or die(mysql_error());
$row_preinscrito = mysql_fetch_assoc($preinscrito);
//$totalRows_preinscrito = mysql_num_rows($preinscrito);


mysql_select_db($database_des_preinscritos, $des_preinscritos);
$query_program_name = "SELECT id_program, program_name, program_type, id_discipline, (SELECT discipline FROM disciplines WHERE id_discipline = ".$row_preinscrito['id_discipline'].") AS discipline FROM site_programs WHERE id_program = ".$row_preinscrito['id_program'];
$program_name = mysql_query($query_program_name, $des_preinscritos) or die(mysql_error());
$row_program_name = mysql_fetch_assoc($program_name);
//$totalRows_program_name = mysql_num_rows($program_name);


//query para sacar los pasos y el status del usuario
//query para sacar el paso y el comentario donde se encuentra el interesado		
mysql_select_db($database_des_preinscritos, $des_preinscritos);
$query_paso = "SELECT comentario_general FROM sp_pasos_status WHERE id_preinscrito = ".$_GET['id_preinscrito'];
$paso = mysql_query($query_paso, $des_preinscritos) or die(mysql_error());
$row_paso = mysql_fetch_assoc($paso);


//query para sacar el los documentos del usuario
mysql_select_db($database_des_preinscritos, $des_preinscritos);
$query_docs = "SELECT * FROM sp_documentos WHERE id_preinscrito = ".$_GET['id_preinscrito'];
$docs = mysql_query($query_docs, $des_preinscritos) or die(mysql_error());
$row_docs = mysql_fetch_assoc($docs);
$totalRows_docs = mysql_num_rows($docs);

//CODIGO PARA QUE ASIGNE FORMATO LOCAL A LAS FECHAS
setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
//++++++++++++++++++++
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Untitled Document</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>
function verificar(){
	return confirm('¿Está seguro/a que desea enviar las claves al alumno? Esta acción es definitiva y no puede deshacerse.');
}
</script>
</head>

<body>
<form method="post" action="preinscrito_detalle_decse.php?id_preinscrito=<? echo $_GET['id_preinscrito']; ?>" name="form1" id="form1" enctype="multipart/form-data" onSubmit="return verificar();">
<table width="500" border="0" align="center" cellpadding="3" cellspacing="0">
	<tr>
		<td class="rojo">&nbsp;</td>
	</tr>
	<tr>
		<td class="rojo">&nbsp;</td>
	</tr>
	<tr>
		<td class="rojo"><strong>Datos del programa</strong></td>
	</tr>
	<tr></tr>
	<tr>
		<td><strong>Programa de inter&eacute;s: </strong><?php echo $row_program_name['program_type'].' - '.$row_program_name['program_name']; ?></td>
	</tr>
	<tr>
		<td><strong>Área: </strong><?php echo $row_program_name['discipline']; ?></td>
	</tr>
	<tr>
		<td><strong>Fecha de registro: </strong><? echo utf8_encode(strftime("%d de %B de %Y", strtotime($row_preinscrito['fecha_registro']))); ?></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class="rojo"><strong>Datos del interesado</strong></td>
	</tr>
	<tr></tr>
	<tr>
		<td>
			<strong>Nombre completo: </strong><?php echo $row_preinscrito['a_paterno'].' '.$row_preinscrito['a_materno'].', '.$row_preinscrito['nombre']?>
		</td>
	</tr>
	<tr>
		<td><strong>Direcci&oacute;n: </strong><?php echo $row_preinscrito['calle_numero'].', Col. '.$row_preinscrito['colonia'].', Del. o Mpo. '.$row_preinscrito['del_mpo'].', C.P. '.$row_preinscrito['cp'].'. '.$row_preinscrito['ciudad'].', '.$row_preinscrito['estado']; ?></td>
	</tr>
	<tr>
		<td><strong>Tel&eacute;fono:</strong> <?php echo $row_preinscrito['telefono']; ?></td>
	</tr>
	<tr>
		<td><strong>Celular: </strong><?php echo $row_preinscrito['celular']; ?></td>
	</tr>
	<tr>
		<td><strong>RFC: </strong><?php echo $row_preinscrito['rfc']; ?></td>
	</tr>
	<tr>
		<td><strong>Correo electr&oacute;nico: </strong><?php echo $row_preinscrito['correo']; ?></td>
	</tr>
	<tr>
		<td><strong>Instituci&oacute;n de estudios: </strong><?php echo $row_preinscrito['institucion_estudios']; ?></td>
	</tr>
	<tr>
		<td><strong>Nacionalidad: </strong><?php echo $row_preinscrito['nacionalidad']; ?></td>
	</tr>
	<tr>
		<td><strong>Nivel acad&eacute;mico: </strong><?php echo $row_preinscrito['grado_academico']; ?></td>
	</tr>
	<tr>
		<td><strong>Exalumno Ibero: </strong><?php echo $row_preinscrito['exalumno']; ?></td>
	</tr>
	<tr>
		<td><strong>¿Cómo se enteró?: </strong><?php echo $row_preinscrito['como_se_entero']; ?></td>
	</tr>
	<tr>
		<td><strong>¿Porqué la Ibero?:</strong> <?php echo $row_preinscrito['porque_la_ibero']; ?></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td><strong class="rojo">Documentos</strong></td>
	</tr>
	<tr></tr>
	<tr>
		<td align="left">
			<? if($totalRows_docs > 0){ ?>
			<table width="100%" border="0" cellspacing="0" cellpadding="5">
			<? do{ ?>
				<tr>
					<td width="50%" align="left">
						<? echo $row_docs['doc_type'].': <a style="color:#F00;" href="uploads/documentos/preinscrito_'.$_GET['id_preinscrito'].'/'.$row_docs['archivo'].'" target="_blank">'.$row_docs['archivo'].'</a>'; ?></td>
				</tr>
				<? } while($row_docs = mysql_fetch_assoc($docs));
			?>
			</table>
			<? } ?>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td><span class="rojo"><strong>Comentarios</strong></span></td>
	</tr>
	<tr>
		<td><? echo $row_paso['comentario_general']; ?></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class="rojo"><strong>Referencia bancaria</strong></td>
	</tr>
	<tr></tr>
	<tr>
		<td><table width="100%" border="0" cellspacing="0" cellpadding="5">
			<tr>
				<td width="50%" align="right">Nombre completo:</td>
				<td><label for="nombre"></label>
					<input name="nombre" type="text" id="nombre" value="<?php echo $row_preinscrito['a_paterno'].' '.$row_preinscrito['a_materno'].', '.$row_preinscrito['nombre']?>" size="50" /></td>
			</tr>
			<tr>
				<td align="right">N&uacute;mero de cuenta:</td>
				<td><label for="numero_cuenta"></label>
					<input name="numero_cuenta" type="text" id="numero_cuenta" size="50" /></td>
			</tr>
			<tr>
				<td align="right">Programa:</td>
				<td><label for="programa"></label>
					<input name="programa" type="text" id="programa" value="<?php echo $row_program_name['program_name']; ?>" size="50" /></td>
			</tr>
			<tr>
				<td align="right">Clave:</td>
				<td><label for="clave"></label>
					<input name="clave" type="text" id="clave" size="50" /></td>
			</tr>
			<tr>
				<td align="right">Generaci&oacute;n:</td>
				<td><label for="generacion"></label>
					<input name="generacion" type="text" id="generacion" size="50" /></td>
			</tr>
			<tr>
				<td align="right">Referencia CIE:</td>
				<td><label for="referencia_cie"></label>
					<input name="referencia_cie" type="text" id="referencia_cie" size="50" /></td>
			</tr>
		</table></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td align="center"><input type="submit" name="guardar" id="guardar" value="Enviar claves" /></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<input type="hidden" name="cont" id="cont" value="1" />
<input type="hidden" name="user_mail" value="<? echo $row_preinscrito['correo']; ?>" />
<input type="hidden" name="id_preinscrito" value="<? echo $_GET['id_preinscrito']; ?>" />
<input type="hidden" name="id_program" value="<? echo $row_program_name['id_program']; ?>" />
<input type="hidden" name="id_discipline" value="<? echo $row_program_name['id_discipline']; ?>" />
<input type="hidden" name="update_form" value="1" />
</form>
</body>
</html>
<?php
mysql_free_result($preinscrito);
?>
