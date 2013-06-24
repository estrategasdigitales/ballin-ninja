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

if(isset($_POST['update_form']) && $_POST['update_form'] == 1){
	
	$id_program = $_POST['id_program'];
	
	mysql_select_db($database_des_preinscritos, $des_preinscritos);
	
	$query_diplos_names = "SELECT id_discipline FROM site_programs WHERE id_program = ".$id_program;
	$diplos_names = mysql_query($query_diplos_names, $des_preinscritos) or die(mysql_error());
	$row_diplos_names = mysql_fetch_assoc($diplos_names);
	//$totalRows_diplos_names = mysql_num_rows($diplos_names);
	
	$id_discipline = $row_diplos_names['id_discipline'];
	
	if($_POST['como_se_entero']==NULL){
		$como_se_entero = $_POST['otromedio'];
	}else{
		$como_se_entero = $_POST['como_se_entero'];
	}
	
	//Información Personal
	
	$a_paterno = $_POST['a_paterno'];
	$a_materno = $_POST['a_materno'];
	$nombre = $_POST['nombre'];
	$calle_numero = $_POST['calle_numero'];
	$colonia = $_POST['colonia'];
	$del_mpo = $_POST['del_mpo'];
	$cp = $_POST['cp'];
	$ciudad = $_POST['ciudad'];
	$estado = $_POST['estado'];
	$rfc = $_POST['rfc'].$_POST['rfc2'].$_POST['rfc3'];
	$telefono = $_POST['telefono'];
	$celular = $_POST['celular'];
	$correo = $_POST['correo'];
	if($_POST['nacionalidad_new'] == 0){
		$nacionalidad = $_POST['nacionalidad'];
	}else{
		$nacionalidad = $_POST['nacionalidad_new'];
	}
	
	//Información Académica
	
	$grado_academico = $_POST['grado_academico'];
	$institucion_estudios = $_POST['institucion_estudios'];
	$porque_la_ibero = $_POST['porque_la_ibero'];
	$exalumno = $_POST['exalumno'];
	
	$empresa = $_POST['empresa'];
	$puesto = $_POST['puesto'];
	$direccion_empresa = $_POST['direccion_empresa'];
	$telefono_empresa = $_POST['telefono_empresa'];
		
	$insertSQL = "UPDATE sp_preinscritos SET
	id_discipline = '$id_discipline',
	id_program = '$id_program',
	como_se_entero = '$como_se_entero',
	a_paterno = '$a_paterno',
	a_materno = '$a_materno',
	nombre = '$nombre',
	calle_numero = '$calle_numero',
	colonia = '$colonia',
	del_mpo = '$del_mpo',
	cp = '$cp',
	ciudad = '$ciudad',
	estado = '$estado',
	rfc = '$rfc',
	telefono = '$telefono',
	celular = '$celular',
	correo = '$correo',
	nacionalidad = '$nacionalidad',
	grado_academico = '$grado_academico',
	institucion_estudios = '$institucion_estudios',
	exalumno = '$exalumno',
	porque_la_ibero = '$porque_la_ibero',
	
	empresa = '$empresa',
	puesto = '$puesto',
	direccion_empresa = '$direccion_empresa',
	telefono_empresa = '$telefono_empresa'
	WHERE id_preinscrito = ".$_POST['id_preinscrito'];
	
	  
	//mysql_select_db($database_des_preinscritos, $des_preinscritos);
	
	$Result1 = mysql_query($insertSQL, $des_preinscritos) or die(mysql_error());
	
	//--------
	
	$update_query = "UPDATE sp_pasos_status SET
	primer_contacto = '".$_POST['primer_contacto']."',
	documentos = '".$_POST['documentos']."',
	envio_decse = '".$_POST['envio_decse']."',
	envio_claves = '".$_POST['envio_claves']."',
	pago_realizado = '".$_POST['pago_realizado']."',
	caso_cerrado = '".$_POST['caso_cerrado']."',
	caso_inconcluso = '".$_POST['caso_inconcluso']."',
	informes = '".$_POST['informes']."',
	comentario_general = '".$_POST['comentario_general']."',
	atendido = '".$_POST['atendido']."'
	WHERE id_preinscrito = ".$_POST['id_preinscrito'];
			
	//mysql_select_db($database_des_preinscritos, $des_preinscritos);
	
	$Result1 = mysql_query($update_query, $des_preinscritos) or die(mysql_error());
	
	if($_POST['envio_decse'] == 1){
	
		$update_query = "UPDATE sp_preinscritos SET
		fecha_envio_decse = '". date('Y-m-d H:i:s') ."'
		WHERE id_preinscrito = ".$_POST['id_preinscrito'];
		
		$Result1 = mysql_query($update_query, $des_preinscritos) or die(mysql_error());
		
		$to = 'alger.huitron@ibero.mx, beatriz.alcubilla@ibero.mx, lourdes.trujano@ibero.mx';
			$subject = 'Un nuevo interesado requiere claves de inscripción';
			$message = '<html>
							<head>
								<title>Un nuevo interesado requiere claves de inscripción</title>
							</head>
							<body>El interesado <strong>'.$_POST['preinscrito_name'].'</strong> requiere que sus datos sean dados de alta en el sistema DECSE <br /><br />Puedes revisar sus datos en dec-uia.com/s_preiniscritos
							</body>
						</html>';
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: Dirección de Educación Continua - No responder <webmaster@dec-uia.com>';
			mail($to, $subject, $message, $headers);
	
	}
	
	
	//PARA INSERTAR O ACTUALIZAR COMENTARIOS
	if($_POST['td_comment_primercontacto'] != NULL){
		
		$query_comment_1 = "SELECT * FROM sp_comentarios WHERE id_preinscrito = ".$_GET['id_preinscrito']." AND id_paso = 1";
		$comment_1 = mysql_query($query_comment_1, $des_preinscritos) or die(mysql_error());
		//$row_comment_1 = mysql_fetch_assoc($comment_1);
		$totalRows_comment_1 = mysql_num_rows($comment_1);
		
		if($totalRows_comment_1 == 0){
			$insert_comment_1 = "INSERT INTO sp_comentarios (id_preinscrito, id_paso, comentario, fecha) VALUES ('".$_POST['id_preinscrito']."','1','".$_POST['td_comment_primercontacto']."','".date('Y-m-d')."')";
			$Result1 = mysql_query($insert_comment_1, $des_preinscritos) or die(mysql_error());
		}else{
			$update_comment_1 = "UPDATE sp_comentarios SET comentario = '".$_POST['td_comment_primercontacto']."' WHERE id_preinscrito = '".$_POST['id_preinscrito']."' AND id_paso = 1";
			$Result1 = mysql_query($update_comment_1, $des_preinscritos) or die(mysql_error());
		}
	
	}
	if($_POST['td_comment_documentos'] != NULL){
		
		$query_comment_1 = "SELECT * FROM sp_comentarios WHERE id_preinscrito = ".$_GET['id_preinscrito']." AND id_paso = 2";
		$comment_1 = mysql_query($query_comment_1, $des_preinscritos) or die(mysql_error());
		//$row_comment_1 = mysql_fetch_assoc($comment_1);
		$totalRows_comment_1 = mysql_num_rows($comment_1);
		
		if($totalRows_comment_1 == 0){
			$insert_comment_1 = "INSERT INTO sp_comentarios (id_preinscrito, id_paso, comentario, fecha) VALUES ('".$_POST['id_preinscrito']."','2','".$_POST['td_comment_documentos']."','".date('Y-m-d')."')";
			$Result1 = mysql_query($insert_comment_1, $des_preinscritos) or die(mysql_error());
		}else{
			$update_comment_1 = "UPDATE sp_comentarios SET comentario = '".$_POST['td_comment_documentos']."' WHERE id_preinscrito = '".$_POST['id_preinscrito']."' AND id_paso = 2";
			$Result1 = mysql_query($update_comment_1, $des_preinscritos) or die(mysql_error());
		}
	
	}
	if($_POST['td_comment_decse'] != NULL){
		
		$query_comment_1 = "SELECT * FROM sp_comentarios WHERE id_preinscrito = ".$_GET['id_preinscrito']." AND id_paso = 3";
		$comment_1 = mysql_query($query_comment_1, $des_preinscritos) or die(mysql_error());
		//$row_comment_1 = mysql_fetch_assoc($comment_1);
		$totalRows_comment_1 = mysql_num_rows($comment_1);
		
		if($totalRows_comment_1 == 0){
			$insert_comment_1 = "INSERT INTO sp_comentarios (id_preinscrito, id_paso, comentario, fecha) VALUES ('".$_POST['id_preinscrito']."','3','".$_POST['td_comment_decse']."','".date('Y-m-d')."')";
			$Result1 = mysql_query($insert_comment_1, $des_preinscritos) or die(mysql_error());
		}else{
			$update_comment_1 = "UPDATE sp_comentarios SET comentario = '".$_POST['td_comment_decse']."' WHERE id_preinscrito = '".$_POST['id_preinscrito']."' AND id_paso = 3";
			$Result1 = mysql_query($update_comment_1, $des_preinscritos) or die(mysql_error());
		}
	
	}
	if($_POST['td_comment_envioclaves'] != NULL){
		
		$query_comment_1 = "SELECT * FROM sp_comentarios WHERE id_preinscrito = ".$_GET['id_preinscrito']." AND id_paso = 3";
		$comment_1 = mysql_query($query_comment_1, $des_preinscritos) or die(mysql_error());
		//$row_comment_1 = mysql_fetch_assoc($comment_1);
		$totalRows_comment_1 = mysql_num_rows($comment_1);
		
		if($totalRows_comment_1 == 0){
			$insert_comment_1 = "INSERT INTO sp_comentarios (id_preinscrito, id_paso, comentario, fecha) VALUES ('".$_POST['id_preinscrito']."','3','".$_POST['td_comment_envioclaves']."','".date('Y-m-d')."')";
			$Result1 = mysql_query($insert_comment_1, $des_preinscritos) or die(mysql_error());
		}else{
			$update_comment_1 = "UPDATE sp_comentarios SET comentario = '".$_POST['td_comment_envioclaves']."' WHERE id_preinscrito = '".$_POST['id_preinscrito']."' AND id_paso = 3";
			$Result1 = mysql_query($update_comment_1, $des_preinscritos) or die(mysql_error());
		}
	
	}
	if($_POST['td_comment_pagorealizado'] != NULL){
		
		$query_comment_1 = "SELECT * FROM sp_comentarios WHERE id_preinscrito = ".$_GET['id_preinscrito']." AND id_paso = 4";
		$comment_1 = mysql_query($query_comment_1, $des_preinscritos) or die(mysql_error());
		//$row_comment_1 = mysql_fetch_assoc($comment_1);
		$totalRows_comment_1 = mysql_num_rows($comment_1);
		
		if($totalRows_comment_1 == 0){
			$insert_comment_1 = "INSERT INTO sp_comentarios (id_preinscrito, id_paso, comentario, fecha) VALUES ('".$_POST['id_preinscrito']."','4','".$_POST['td_comment_pagorealizado']."','".date('Y-m-d')."')";
			$Result1 = mysql_query($insert_comment_1, $des_preinscritos) or die(mysql_error());
		}else{
			$update_comment_1 = "UPDATE sp_comentarios SET comentario = '".$_POST['td_comment_pagorealizado']."' WHERE id_preinscrito = '".$_POST['id_preinscrito']."' AND id_paso = 4";
			$Result1 = mysql_query($update_comment_1, $des_preinscritos) or die(mysql_error());
		}
	
	}
	
	//Para subir archivos
	$cont = $_POST['cont'];
		
	for($i=0 ; $i < $cont ; $i++){
		//Insertar codiguin pa subir archivo.
		if($_FILES['doc_'.$i]['tmp_name'] != NULL){
			$DOC_FILE1 = $_FILES['doc_'.$i]['tmp_name'];
			$DOC_FILE_NAME = $_FILES['doc_'.$i]['name'];
			$DOC_FILE_TYPE1 = $_FILES['doc_'.$i]['type'];
			$DOC_FILE_SIZE1 = $_FILES['doc_'.$i]['size'];
			$DOC_FILE_NAME1 = str_replace(" ","_",$DOC_FILE_NAME);
			
			$target_path1 = "uploads/documentos/preinscrito_".$_POST['id_preinscrito']."/";
			
			// Create the new directory
			if(!file_exists($target_path1)){
				mkdir($target_path1, 0777);
			}
			
			$full_target_path1 = $target_path1 . $DOC_FILE_NAME1;
			
			$insertSQL = "INSERT INTO sp_documentos (id_preinscrito, doc_type, archivo) VALUES ('".$_POST['id_preinscrito']."', '".$_POST['doc_type_'.$i]."', '".$DOC_FILE_NAME1."')";
		
			//mysql_select_db($database_des_preinscritos, $des_preinscritos);
			$Result1 = mysql_query($insertSQL, $des_preinscritos) or die(mysql_error());
		  
			move_uploaded_file($DOC_FILE1, $full_target_path1);
		}
	}
	
	header('Location: preinscrito_detalle.php?id_preinscrito='.$_POST['id_preinscrito']);
	//$onload = 'onload="alertas(\'El estatus del interesado a sido actualizado.\')"';
}

mysql_select_db($database_des_preinscritos, $des_preinscritos);
$query_preinscrito = "SELECT * FROM sp_preinscritos WHERE id_preinscrito = ".$_GET['id_preinscrito'];
$preinscrito = mysql_query($query_preinscrito, $des_preinscritos) or die(mysql_error());
$row_preinscrito = mysql_fetch_assoc($preinscrito);
//$totalRows_preinscrito = mysql_num_rows($preinscrito);


mysql_select_db($database_des_preinscritos, $des_preinscritos);
$query_program_name = "SELECT id_program, program_name, program_type FROM site_programs WHERE id_program IN (SELECT id_program FROM site_fechas_ini WHERE periodo = 'p') ORDER BY program_type DESC, program_name ASC";
$program_name = mysql_query($query_program_name, $des_preinscritos) or die(mysql_error());
$row_program_name = mysql_fetch_assoc($program_name);
//$totalRows_program_name = mysql_num_rows($program_name);


//query para sacar los pasos y el status del usuario
//query para sacar el paso y el comentario donde se encuentra el interesado		
mysql_select_db($database_des_preinscritos, $des_preinscritos);
$query_paso = "SELECT * FROM sp_pasos_status WHERE id_preinscrito = ".$_GET['id_preinscrito'];
$paso = mysql_query($query_paso, $des_preinscritos) or die(mysql_error());
$row_paso = mysql_fetch_assoc($paso);


//query para sacar el los documentos del usuario
mysql_select_db($database_des_preinscritos, $des_preinscritos);
$query_docs = "SELECT * FROM sp_documentos WHERE id_preinscrito = ".$_GET['id_preinscrito'];
$docs = mysql_query($query_docs, $des_preinscritos) or die(mysql_error());
$row_docs = mysql_fetch_assoc($docs);
$totalRows_docs = mysql_num_rows($docs);

//query para sacar los comentarios por pasos del usuario
mysql_select_db($database_des_preinscritos, $des_preinscritos);
$query_comments = "SELECT * FROM sp_comentarios WHERE id_preinscrito = ".$_GET['id_preinscrito'];
$comments = mysql_query($query_comments, $des_preinscritos) or die(mysql_error());
$row_comments = mysql_fetch_assoc($comments);

do{
	switch($row_comments['id_paso']){
		case 1:
			$comment_1 =  $row_comments['comentario'];
		break;
		case 2:
			$comment_2 =  $row_comments['comentario'];
		break;
		case 3:
			$comment_3 =  $row_comments['comentario'];
		break;
		case 4:
			$comment_4 =  $row_comments['comentario'];
		break;
		case 5:
			$comment_5 =  $row_comments['comentario'];
		break;
	}
}while($row_comments = mysql_fetch_assoc($comments));

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
function alertas(msg){
	alert(msg);
}
function check_pago(value){
	if(value == 1 ){
		$('input.estatus').each(function(){
		var checked = $(this).attr('checked', true);
			if(checked){ 
				$(this).attr('checked', false);
			}
			$(this).attr('disabled','disabled')
		});
		$('input#pago_realizado').attr('onchange','check_pago(0)');
	}else if(value == 0 ){
		$('input.estatus').each(function(){
			$(this).removeAttr('disabled','disabled')
		});
		$('input#pago_realizado').attr('onchange','check_pago(1)');
	}
}

var cont = 1;
function add_file(){
	$('table#table_file').append('<tr><td width="50%"><input type="file" name="doc_'+cont+'" id="doc_'+cont+'" value="" /></td><td align="right"><input type="text" name="doc_type_'+cont+'" id="doc_type_'+cont+'" /></td></tr>');
	cont++;
	$('input#cont').attr('value',cont);
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

function check_decse(){
	if($('input#envio_decse').is(':checked')){
		return confirm('Seleccionó la opción para enviar los datos a DECSE. ¿Está seguro/a que desea enviar la información?');
	}else{
		return true;
	}
}

function add_comment(){
	$('td#td_comentario_general').html('<textarea name="comentario_general" cols="50" rows="5" id="comentario_general"><? echo $row_paso['comentario_general']; ?></textarea>');
}

function add_small_comment(id, comment){
	$('td#'+id).html('<textarea name="'+id+'" rows="5" style="width:110px; max-width:110px;">'+ comment +'</textarea>');
}

function uncheck_other(id){
	switch(id){
		case 'envio_decse':
			$('input#caso_cerrado').attr('checked',false);
			$('input#caso_inconcluso').attr('checked',false);
			$('input#informes').attr('checked',false);
		break;
		case 'caso_cerrado':
			$('input#caso_inconcluso').attr('checked',false);
			$('input#informes').attr('checked',false);
		break;
		case 'caso_inconcluso':
			$('input#caso_cerrado').attr('checked',false);
			$('input#informes').attr('checked',false);
		break;
		case 'informes':
			$('input#caso_cerrado').attr('checked',false);
			$('input#caso_inconcluso').attr('checked',false);
		break;
	}
}
</script>
</head>

<body <? echo $onload; ?>>
<div style="margin:10px;">
  <form method="post" action="preinscrito_editar.php?id_preinscrito=<? echo $_GET['id_preinscrito']; ?>" name="form1" id="form1" enctype="multipart/form-data" <? if($row_paso['envio_decse'] == 0){echo 'onsubmit="return check_decse();"';} ?>>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr valign="top">
        <td colspan="5"><h2>Datos del programa</h2>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><strong>Programa de inter&eacute;s: </strong>
                <select name="id_program" id="id_program" style="width:450px; max-width:450px;">
                  <? do{ ?>
                  <option value="<?php echo $row_program_name['id_program']; ?>" <?php if($row_program_name['id_program'] == $_GET['id_program']){echo 'selected="selected"';}?>><?php echo $row_program_name['program_type'].' - '.$row_program_name['program_name']; ?></option>
                  <? }while($row_program_name = mysql_fetch_assoc($program_name)); ?>
                </select></td>
            </tr>
            <tr>
              <td><strong>Fecha de registro: </strong><? echo utf8_encode(strftime("%d de %B de %Y", strtotime($row_preinscrito['fecha_registro']))); ?></td>
            </tr>
          </table></td>
      </tr>
      <tr valign="top">
        <td colspan="5"><div class="sombra"> </div></td>
      </tr>
      <tr valign="top">
        <td width="400">&nbsp;</td>
        <td width="10">&nbsp;</td>
        <td width="3" style="background:#f2f2f2;">&nbsp;</td>
        <td width="10">&nbsp;</td>
        <td width="399">&nbsp;</td>
      </tr>
      <tr valign="top">
        <td width="400"><h2>Datos del interesado</h2>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><strong>Nombre completo: </strong><br />
                <table border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td> A. Paterno:
                      <input type="text" name="a_paterno" id="a_paterno" value="<?php echo $row_preinscrito['a_paterno']; ?>" /></td>
                  </tr>
                  <tr>
                    <td> A. Materno:
                      <input type="text" name="a_materno" id="a_materno" value="<?php echo $row_preinscrito['a_materno']; ?>" /></td>
                  </tr>
                  <tr>
                    <td> Nombre:
                      <input type="text" name="nombre" id="nombre" value="<?php echo $row_preinscrito['nombre']; ?>" /></td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td><strong>Direcci&oacute;n: </strong><br />
                Calle y número:
                <input type="text" name="calle_numero" id="calle_numero" value="<?php echo $row_preinscrito['calle_numero']; ?>" />
                <br />
                Colonia:
                <input type="text" name="colonia" id="colonia" value="<?php echo $row_preinscrito['colonia']; ?>" />
                <br />
                Delegaci&oacute; o municipio:
                <input type="text" name="del_mpo" id="del_mpo" value="<?php echo $row_preinscrito['del_mpo']; ?>" />
                <br />
                C.P.
                <input type="text" name="cp" id="cp" value="<?php echo $row_preinscrito['cp']; ?>" />
                <br />
                Ciuada:
                <input type="text" name="ciudad" id="ciudad" value="<?php echo $row_preinscrito['ciudad']; ?>" />
                <br />
                Estado:
                <input type="text" name="estado" id="estado" value="<?php echo $row_preinscrito['estado']; ?>" /></td>
            </tr>
            <tr>
              <td><strong>Tel&eacute;fono:</strong><br />
                <input type="text" name="telefono" id="telefono" value="<?php echo $row_preinscrito['telefono']; ?>" /></td>
            </tr>
            <tr>
              <td><strong>Celular: </strong><br />
                <input type="text" name="celular" id="celular" value="<?php echo $row_preinscrito['celular']; ?>" /></td>
            </tr>
            <tr>
              <td><strong>RFC: </strong><br />
                <input type="text" name="rfc" id="rfc" value="<?php echo $row_preinscrito['rfc']; ?>" /></td>
            </tr>
            <tr>
              <td><strong>Correo electr&oacute;nico: </strong><br />
                <input type="text" name="correo" id="correo" value="<?php echo $row_preinscrito['correo']; ?>" /></td>
            </tr>
            <tr>
              <td><strong>Instituci&oacute;n de estudios: </strong><br />
                <input type="text" name="institucion_estudios" id="institucion_estudios" value="<?php echo $row_preinscrito['institucion_estudios']; ?>" /></td>
            </tr>
            <tr>
              <td><strong>Nacionalidad: </strong><?php echo $row_preinscrito['nacionalidad']; ?><br />
                <input type="hidden" name="nacionalidad" id="nacionalidad" value="<?php echo $row_preinscrito['nacionalidad']; ?>" />
                <select name="nacionalidad_new" id="nacionalidad_new">
                  <option value="0" disabled="disabled" selected="selected">Selecciona un pa&iacute;s</option>
                  <option value="MX - M&eacute;xico">M&eacute;xico</option>
                  <option value="0" disabled="disabled">-------------------</option>
                  <option value="AF - Afganist&aacute;n">Afganist&aacute;n</option>
                  <option value="AL - Albania">Albania</option>
                  <option value="DE - Alemania">Alemania</option>
                  <option value="AD - Andorra">Andorra</option>
                  <option value="AO - Angola">Angola</option>
                  <option value="AI - Anguilla">Anguilla</option>
                  <option value="AQ - Ant&aacute;rtida">Ant&aacute;rtida</option>
                  <option value="AG - Antigua y Barbuda">Antigua y Barbuda</option>
                  <option value="AN - Antillas Holandesas">Antillas Holandesas</option>
                  <option value="SA - Arabia Saud&iacute;">Arabia Saud&iacute;</option>
                  <option value="DZ - Argelia">Argelia</option>
                  <option value="AR - Argentina">Argentina</option>
                  <option value="AM - Armenia">Armenia</option>
                  <option value="AW - Aruba">Aruba</option>
                  <option value="AU - Australia">Australia</option>
                  <option value="AT - Austria">Austria</option>
                  <option value="AZ - Azerbaiy&aacute;n">Azerbaiy&aacute;n</option>
                  <option value="BS - Bahamas">Bahamas</option>
                  <option value="BH - Bahrein">Bahrein</option>
                  <option value="BD - Bangladesh">Bangladesh</option>
                  <option value="BB - Barbados">Barbados</option>
                  <option value="BE - B&eacute;lgica">B&eacute;lgica</option>
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
                  <option value="BT - But&aacute;n">But&aacute;n</option>
                  <option value="CV - Cabo Verde">Cabo Verde</option>
                  <option value="KH - Camboya">Camboya</option>
                  <option value="CM - Camer&uacute;n">Camer&uacute;n</option>
                  <option value="CA - Canad&aacute;">Canad&aacute;</option>
                  <option value="TD - Chad">Chad</option>
                  <option value="CL - Chile">Chile</option>
                  <option value="CN - China">China</option>
                  <option value="CY - Chipre">Chipre</option>
                  <option value="VA - Ciudad del Vaticano (Santa Sede)">Ciudad del Vaticano (Santa Sede)</option>
                  <option value="CO - Colombia">Colombia</option>
                  <option value="KM - Comores">Comores</option>
                  <option value="CG - Congo">Congo</option>
                  <option value="CD - Congo, Rep&uacute;blica Democr&aacute;tica del">Congo, Rep&uacute;blica Democr&aacute;tica del</option>
                  <option value="KR - Corea">Corea</option>
                  <option value="KP - Corea del Norte">Corea del Norte</option>
                  <option value="CI - Costa de Marf&iacute;l">Costa de Marf&iacute;l</option>
                  <option value="CR - Costa Rica">Costa Rica</option>
                  <option value="HR - Croacia (Hrvatska)">Croacia (Hrvatska)</option>
                  <option value="CU - Cuba">Cuba</option>
                  <option value="DK - Dinamarca">Dinamarca</option>
                  <option value="DJ - Djibouti">Djibouti</option>
                  <option value="DM - Dominica">Dominica</option>
                  <option value="EC - Ecuador">Ecuador</option>
                  <option value="EG - Egipto">Egipto</option>
                  <option value="SV - El Salvador">El Salvador</option>
                  <option value="AE - Emiratos &Aacute;rabes Unidos">Emiratos &Aacute;rabes Unidos</option>
                  <option value="ER - Eritrea">Eritrea</option>
                  <option value="SI - Eslovenia">Eslovenia</option>
                  <option value="ES - Espa&ntilde;a">Espa&ntilde;a</option>
                  <option value="US - Estados Unidos">Estados Unidos</option>
                  <option value="EE - Estonia">Estonia</option>
                  <option value="ET - Etiop&iacute;a">Etiop&iacute;a</option>
                  <option value="FJ - Fiji">Fiji</option>
                  <option value="PH - Filipinas">Filipinas</option>
                  <option value="FI - Finlandia">Finlandia</option>
                  <option value="FR - Francia">Francia</option>
                  <option value="GA - Gab&oacute;n">Gab&oacute;n</option>
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
                  <option value="HT - Hait&iacute;">Hait&iacute;</option>
                  <option value="HN - Honduras">Honduras</option>
                  <option value="HU - Hungr&iacute;a">Hungr&iacute;a</option>
                  <option value="IN - India">India</option>
                  <option value="ID - Indonesia">Indonesia</option>
                  <option value="IQ - Irak">Irak</option>
                  <option value="IR - Ir&aacute;n">Ir&aacute;n</option>
                  <option value="IE - Irlanda">Irlanda</option>
                  <option value="IS - Islandia">Islandia</option>
                  <option value="KY - Islas Caim&aacute;n">Islas Caim&aacute;n</option>
                  <option value="IL - Israel">Israel</option>
                  <option value="IT - Italia">Italia</option>
                  <option value="JM - Jamaica">Jamaica</option>
                  <option value="JP - Jap&oacute;n">Jap&oacute;n</option>
                  <option value="JO - Jordania">Jordania</option>
                  <option value="KZ - Kazajist&aacute;n">Kazajist&aacute;n</option>
                  <option value="KE - Kenia">Kenia</option>
                  <option value="KG - Kirguizist&aacute;n">Kirguizist&aacute;n</option>
                  <option value="KI - Kiribati">Kiribati</option>
                  <option value="KW - Kuwait">Kuwait</option>
                  <option value="LA - Laos">Laos</option>
                  <option value="LS - Lesotho">Lesotho</option>
                  <option value="LV - Letonia">Letonia</option>
                  <option value="LB - L&iacute;bano">L&iacute;bano</option>
                  <option value="LR - Liberia">Liberia</option>
                  <option value="LY - Libia">Libia</option>
                  <option value="LI - Liechtenstein">Liechtenstein</option>
                  <option value="LT - Lituania">Lituania</option>
                  <option value="LU - Luxemburgo">Luxemburgo</option>
                  <option value="MK - Macedonia, Ex-Rep&uacute;blica Yugoslava de">Macedonia, Ex-Rep&uacute;blica Yugoslava de</option>
                  <option value="MG - Madagascar">Madagascar</option>
                  <option value="MY - Malasia">Malasia</option>
                  <option value="MW - Malawi">Malawi</option>
                  <option value="MV - Maldivas">Maldivas</option>
                  <option value="ML - Mal&iacute;">Mal&iacute;</option>
                  <option value="MT - Malta">Malta</option>
                  <option value="MA - Marruecos">Marruecos</option>
                  <option value="MQ - Martinica">Martinica</option>
                  <option value="MU - Mauricio">Mauricio</option>
                  <option value="MR - Mauritania">Mauritania</option>
                  <option value="YT - Mayotte">Mayotte</option>
                  <option value="FM - Micronesia">Micronesia</option>
                  <option value="MD - Moldavia">Moldavia</option>
                  <option value="MC - M&oacute;naco">M&oacute;naco</option>
                  <option value="MN - Mongolia">Mongolia</option>
                  <option value="MS - Montserrat">Montserrat</option>
                  <option value="MZ - Mozambique">Mozambique</option>
                  <option value="NA - Namibia">Namibia</option>
                  <option value="NR - Nauru">Nauru</option>
                  <option value="NP - Nepal">Nepal</option>
                  <option value="NI - Nicaragua">Nicaragua</option>
                  <option value="NE - N&iacute;ger">N&iacute;ger</option>
                  <option value="NG - Nigeria">Nigeria</option>
                  <option value="NU - Niue">Niue</option>
                  <option value="NF - Norfolk">Norfolk</option>
                  <option value="NO - Noruega">Noruega</option>
                  <option value="NC - Nueva Caledonia">Nueva Caledonia</option>
                  <option value="NZ - Nueva Zelanda">Nueva Zelanda</option>
                  <option value="OM - Om&aacute;n">Om&aacute;n</option>
                  <option value="NL - Pa&iacute;ses Bajos">Pa&iacute;ses Bajos</option>
                  <option value="PA - Panam&aacute;">Panam&aacute;</option>
                  <option value="PG - Pap&uacute;a Nueva Guinea">Pap&uacute;a Nueva Guinea</option>
                  <option value="PK - aquist&aacute;n">Paquist&aacute;n</option>
                  <option value="PY - Paraguay">Paraguay</option>
                  <option value="PE - Per&uacute;">Per&uacute;</option>
                  <option value="PN - Pitcairn">Pitcairn</option>
                  <option value="PF - Polinesia Francesa">Polinesia Francesa</option>
                  <option value="PL - Polonia">Polonia</option>
                  <option value="PT - Portugal">Portugal</option>
                  <option value="PR - Puerto Rico">Puerto Rico</option>
                  <option value="QA - Qatar">Qatar</option>
                  <option value="UK - Reino Unido">Reino Unido</option>
                  <option value="CF - Rep&uacute;blica Centroafricana">Rep&uacute;blica Centroafricana</option>
                  <option value="CZ - Rep&uacute;blica Checa">Rep&uacute;blica Checa</option>
                  <option value="ZA - Rep&uacute;blica de Sud&aacute;frica">Rep&uacute;blica de Sud&aacute;frica</option>
                  <option value="DO - Rep&uacute;blica Dominicana">Rep&uacute;blica Dominicana</option>
                  <option value="SK - Rep&uacute;blica Eslovaca">Rep&uacute;blica Eslovaca</option>
                  <option value="RE - Reuni&oacute;n">Reuni&oacute;n</option>
                  <option value="RW - Ruanda">Ruanda</option>
                  <option value="RO - Rumania">Rumania</option>
                  <option value="RU - Rusia">Rusia</option>
                  <option value="WS - Samoa">Samoa</option>
                  <option value="SM - San Marino">San Marino</option>
                  <option value="VC - San Vicente y Granadinas">San Vicente y Granadinas</option>
                  <option value="SH - Santa Helena">Santa Helena</option>
                  <option value="LC - Santa Luc&iacute;a">Santa Luc&iacute;a</option>
                  <option value="ST - Santo Tom&eacute; y Pr&iacute;ncipe">Santo Tom&eacute; y Pr&iacute;ncipe</option>
                  <option value="SN - Senegal">Senegal</option>
                  <option value="SC - Seychelles">Seychelles</option>
                  <option value="SL - Sierra Leona">Sierra Leona</option>
                  <option value="SG - Singapur">Singapur</option>
                  <option value="SY - Siria">Siria</option>
                  <option value="SO - Somalia">Somalia</option>
                  <option value="LK - Sri Lanka">Sri Lanka</option>
                  <option value="SZ - Suazilandia">Suazilandia</option>
                  <option value="SD - Sud&aacute;n">Sud&aacute;n</option>
                  <option value="SE - Suecia">Suecia</option>
                  <option value="CH - Suiza">Suiza</option>
                  <option value="SR - Surinam">Surinam</option>
                  <option value="TH - Tailandia">Tailandia</option>
                  <option value="TW - Taiw&aacute;n">Taiw&aacute;n</option>
                  <option value="TZ - Tanzania">Tanzania</option>
                  <option value="TJ - Tayikist&aacute;n">Tayikist&aacute;n</option>
                  <option value="TG - Togo">Togo</option>
                  <option value="TO - Tonga">Tonga</option>
                  <option value="TT - Trinidad y Tobago">Trinidad y Tobago</option>
                  <option value="TN - T&uacute;nez">T&uacute;nez</option>
                  <option value="TM - Turkmenist&aacute;n">Turkmenist&aacute;n</option>
                  <option value="TR - Turqu&iacute;a">Turqu&iacute;a</option>
                  <option value="TV - Tuvalu">Tuvalu</option>
                  <option value="UA - Ucrania">Ucrania</option>
                  <option value="UG - Uganda">Uganda</option>
                  <option value="UY - Uruguay">Uruguay</option>
                  <option value="UZ - Uzbekist&aacute;n">Uzbekist&aacute;n</option>
                  <option value="VU - Vanuatu">Vanuatu</option>
                  <option value="VE - Venezuela">Venezuela</option>
                  <option value="VN - Vietnam">Vietnam</option>
                  <option value="YE - Yemen">Yemen</option>
                  <option value="YU - Yugoslavia">Yugoslavia</option>
                  <option value="ZM - Zambia">Zambia</option>
                  <option value="ZW - Zimbabue">Zimbabue</option>
                </select></td>
            </tr>
            <tr>
              <td><strong>Nivel acad&eacute;mico: </strong><br />
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td><label>
                        <input type="radio" name="grado_academico" value="Preparatoria" id="grado_academico_0" <? if($row_preinscrito['grado_academico'] == 'Preparatoria'){echo 'checked="checked"';} ?> />
                        Preparatoria </label></td>
                    <td><label>
                        <input type="radio" name="grado_academico" value="Maestr&iacute;a" id="grado_academico_1" <? if($row_preinscrito['grado_academico'] != 'Preparatoria' && $row_preinscrito['grado_academico'] != 'Licenciatura' && $row_preinscrito['grado_academico'] != 'Doctorado'){echo 'checked="checked"';} ?> />
                        Maestr&iacute;a</label></td>
                  </tr>
                  <tr>
                    <td><label>
                        <input type="radio" name="grado_academico" value="Licenciatura" id="grado_academico_2" <? if($row_preinscrito['grado_academico'] == 'Licenciatura'){echo 'checked="checked"';} ?> />
                        Licenciatura</label></td>
                    <td><label>
                        <input type="radio" name="grado_academico" value="Doctorado" id="grado_academico_3" <? if($row_preinscrito['grado_academico'] == 'Doctorado'){echo 'checked="checked"';} ?> />
                        Doctorado</label></td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td><strong>Exalumno Ibero: </strong><br />
                <table width="32%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="50%"><label>
                        <input type="radio" name="exalumno" value="Si" id="exalumno_0" <?php if($row_preinscrito['exalumno']=='Si'){echo 'checked="checked"';} ?> />
                        Si </label></td>
                    <td width="50%"><label>
                        <input type="radio" name="exalumno" value="No" id="exalumno_1" <?php if($row_preinscrito['exalumno']=='No'){echo 'checked="checked"';} ?> />
                        No</label></td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td><strong>¿Cómo se enteró?: </strong><br />
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="50%"><label>
                        <input type="radio" name="como_se_entero" value="Cat&aacute;logo" id="como_se_entero_0" onchange="clear_otromedio();" <?php if($row_preinscrito['como_se_entero']=='Cat&aacute;logo'){echo 'cheked="checked"';} ?> />
                        Cat&aacute;logo</label></td>
                    <td width="50%"><label>
                        <input type="radio" name="como_se_entero" value="Internet" id="como_se_entero_1" onchange="clear_otromedio();" <?php if($row_preinscrito['como_se_entero']=='Internet'){echo 'cheked="checked"';} ?> />
                        Internet</label></td>
                  </tr>
                  <tr>
                    <td width="50%"><label>
                        <input type="radio" name="como_se_entero" value="Peri&oacute;dico" id="como_se_entero_2" onchange="clear_otromedio();" <?php if($row_preinscrito['como_se_entero']=='Peri&oacute;dico'){echo 'cheked="checked"';} ?> />
                        Peri&oacute;dico</label></td>
                    <td width="50%"><label>
                        <input type="radio" name="como_se_entero" value="Revista" id="como_se_entero_3" onchange="clear_otromedio();" <?php if($row_preinscrito['como_se_entero']=='Revista'){echo 'cheked="checked"';} ?> />
                        Revista</label></td>
                  </tr>
                  <tr>
                    <td width="50%"><label>
                        <input type="radio" name="como_se_entero" value="Recomendaci&oacute;n" id="como_se_entero_4" onchange="clear_otromedio();" <?php if($row_preinscrito['como_se_entero']=='Recomendaci&oacute;n'){echo 'cheked="checked"';} ?> />
                        Recomendaci&oacute;n</label></td>
                    <td width="50%"><label>
                        <input type="radio" name="como_se_entero" value="Email" id="como_se_entero_5" onchange="clear_otromedio();" <?php if($row_preinscrito['como_se_entero']=='Email'){echo 'cheked="checked"';} ?> />
                        Email</label></td>
                  </tr>
                  <tr>
                    <td colspan="2"><label>Otro:
                        <input name="otromedio" type="text" id="otromedio" size="26" onkeyup="clear_radios();" <?php if($row_preinscrito['como_se_entero']!='Cat&aacute;logo' && $row_preinscrito['como_se_entero']!='Internet' && $row_preinscrito['como_se_entero']!='Peri&oacute;dico' && $row_preinscrito['como_se_entero']!='Revista' && $row_preinscrito['como_se_entero']!='Recomendaci&oacute;n' && $row_preinscrito['como_se_entero']!='Email' && $row_preinscrito['como_se_entero']!='Email'){echo 'value="'.$row_preinscrito['como_se_entero'].'"';} ?> />
                      </label></td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td><strong>¿Porqué la Ibero?:</strong><br />
                <input type="text" name="porque_la_ibero" id="porque_la_ibero" value="<?php echo $row_preinscrito['porque_la_ibero']; ?>" /></td>
            </tr>
             <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><strong>Empresa:</strong><br />
                <input type="text" name="empresa" id="empresa" value="<?php echo $row_preinscrito['empresa']; ?>" /></td>
            </tr>
            <tr>
              <td><strong>Puesto:</strong><br />
                <input type="text" name="puesto" id="puesto" value="<?php echo $row_preinscrito['puesto']; ?>" /></td>
            </tr>
            <tr>
              <td><strong>Direcci&oacute;n de la empresa:</strong><br />
                <input type="text" name="direccion_empresa" id="direccion_empresa" value="<?php echo $row_preinscrito['direccion_empresa']; ?>" /></td>
            </tr>
            <tr>
              <td><strong>Tel&eacute;fono de la empresa:</strong><br />
                <input type="text" name="telefono_empresa" id="telefono_empresa" value="<?php echo $row_preinscrito['telefono_empresa']; ?>" /></td>
            </tr>
          </table></td>
        <td width="10">&nbsp;</td>
        <td width="3" style="background:#CCC;">&nbsp;</td>
        <td width="10">&nbsp;</td>
        <td width="399"><h2>Documentos</h2>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="left"><? if($totalRows_docs > 0){ ?>
                <table width="100%" border="0" cellspacing="0" cellpadding="5">
                  <? do{ ?>
                    <tr>
                      <td width="50%" align="left"><? echo $row_docs['doc_type'].': <a style="color:#F00;" href="uploads/documentos/preinscrito_'.$_GET['id_preinscrito'].'/'.$row_docs['archivo'].'" target="_blank">'.$row_docs['archivo'].'</a>'; ?></td>
                    </tr>
                    <? } while($row_docs = mysql_fetch_assoc($docs));
			?>
                </table>
                <? } ?>
               <p class="anadir_comentario"><a onclick="add_file();" style="cursor:pointer;"><img src="imagenes/archivo.png"  /> a&ntilde;adir archivo</a></p>
                <table width="100%" border="0" cellspacing="0" cellpadding="0" id="table_file">
                  <tr>
                    <td width="55%"><strong>Archivo</strong></td>
                    <td width="45%" align="right"><strong>Tipo de documento</strong></td>
                  </tr>
                  <tr>
                    <td><input name="doc_0" type="file" id="doc_0" value="" size="10" /></td>
                    <td align="right"><input name="doc_type_0" type="text" id="doc_type_0" size="20" /></td>
                  </tr>
                </table>
                <h2>Comentarios</h2>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><strong class="rojo"></strong> | <span class="anadir_comentario"><a onclick="add_comment();" style="cursor:pointer;">A&ntilde;adir / editar comentario general</a></span></td>
                  </tr>
                  <tr>
                    <td id="td_comentario_general"><? echo $row_paso['comentario_general']; ?>
                      <input type="hidden" name="comentario_general" id="comentario_general" value="<? echo $row_paso['comentario_general']; ?>" /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td></td>
                  </tr>
                </table></td>
            </tr>
          </table></td>
      </tr>
      <tr valign="top">
        <td colspan="5"><div class="sombra"> </div></td>
      </tr>
      <tr valign="top">
        <td><h2>Estatus del proceso</h2>
        	<table width="100%" border="0" cellpadding="0" cellspacing="0">
        		<tr>
        			<td width="22"><input type="checkbox" name="primer_contacto" id="primer_contacto" value="1" <? if($_SESSION['loggedin_id_access'] == 4){echo 'disabled="disabled"';} ?> <? if($row_paso['primer_contacto'] == 1){echo 'checked="checked"';} ?> /></td>
        			<td width="3">&nbsp;</td>
        			<td width="134">Primer contacto</td>
        			<td width="11">&nbsp;</td>
        			<td width="165"><p class="anadir_comentario"><a style="cursor:pointer;" onclick="add_small_comment('td_comment_primercontacto','<? echo $comment_1; ?>');"><img src="imagenes/comentario.png" /> a&ntilde;adir - editar comentario</a></p></td>
        			</tr>
        		<tr>
        			<td colspan="5" id="td_comment_primercontacto"><p class="anadir_comentario"><a href="&ordm;"><? echo $comment_1; ?></a></p></td>
        			</tr>
        		<tr>
        			<td width="22"><input type="checkbox" name="documentos" id="documentos" value="1" <? if($_SESSION['loggedin_id_access'] == 4){echo 'disabled="disabled"';} ?> <? if($row_paso['documentos'] == 1){echo 'checked="checked"';} ?> /></td>
        			<td>&nbsp;</td>
        			<td>Documentos</td>
        			<td></td>
        			<td><p><a class="anadir_comentario" style="cursor:pointer;" onclick="add_small_comment('td_comment_documentos','<? echo $comment_2; ?>')"><img src="imagenes/comentario.png" /> a&ntilde;adir - editar comentario</a></p></td>
        			</tr>
        		<tr>
        			<td colspan="5"id="td_comment_documentos"><p class="anadir_comentario"><? echo $comment_2; ?></p></td>
        			</tr>
        		<tr></tr>
        		<tr>
        			<td width="22"><? if($row_paso['envio_decse'] == 1){ ?>
        				<input type="checkbox" name="decse2" id="decse2" value="1" disabled="disabled" checked="checked" />
        				<input type="hidden" name="envio_decse2" id="envio_decse2" value="<? echo $row_paso['envio_decse'] ?>" />
        				<? }else{ ?>
        				<input type="checkbox" onchange="uncheck_other(this.id);" name="envio_decse2" id="envio_decse2" value="1" />
        				<? } ?></td>
        			<td>&nbsp;</td>
        			<td>Enviar a DECSE</td>
        			<td></td>
        			<td><p><a class="anadir_comentario" style="cursor:pointer;" onclick="add_small_comment('td_comment_decse','<? echo $comment_3; ?>')"><img src="imagenes/comentario.png" /> a&ntilde;adir - editar comentario</a></p></td>
        			</tr>
        		<tr>
        			<td colspan="5"id="td_comment_decse"><p class="anadir_comentario"><? echo $comment_3; ?></p></td>
        			</tr>
        		<tr>
        			<td width="22"><input type="checkbox" name="claves" id="claves" disabled="disabled" <? if($row_paso['envio_claves'] == 1){echo 'checked="checked"';} ?> />
        				<input type="hidden" name="envio_claves" id="envio_claves" value="<? echo $row_paso['envio_claves']; ?>" /></td>
        			<td>&nbsp;</td>
        			<td>Env&iacute;o de claves</td>
        			<td></td>
        			<td><p class="anadir_comentario"><a style="cursor:pointer;" onclick="add_small_comment('td_comment_envioclaves','<? echo $comment_4; ?>')"><img src="imagenes/comentario.png" /> a&ntilde;adir - editar comentario</a></p></td>
        			</tr>
        		<tr>
        			<td colspan="5" id="td_comment_envioclaves"><p class="anadir_comentario"><? echo $comment_4; ?></p></td>
        			</tr>
        		<tr>
        			<td width="22"><input type="checkbox" name="pago_realizado" id="pago_realizado" value="1" <? if($row_paso['envio_claves'] == 0){echo 'disabled="disabled"';} ?> <? if($row_paso['pago_realizado'] == 1){echo 'checked="checked"';} ?> onchange="check_pago(1)" /></td>
        			<td>&nbsp;</td>
        			<td>Pago realizado</td>
        			<td></td>
        			<td><p><a class="anadir_comentario" style="cursor:pointer;" onclick="add_small_comment('td_comment_pagorealizado','<? echo $comment_5; ?>')"><img src="imagenes/comentario.png" />a&ntilde;adir - editar comentario</a></p></td>
        			</tr>
        		<tr>
        			<td colspan="5" id="td_comment_pagorealizado"><p class="anadir_comentario"><? echo $comment_5; ?></p></td>
        			</tr>
        		</table></td>
        <td>&nbsp;</td>
        <td style="background:#f2f2f2;">&nbsp;</td>
        <td>&nbsp;</td>
        <td><h2>Clasificar al aspirante</h2>
        	<table width="100%" border="0" cellpadding="5" cellspacing="0">
        		<tr>
        			<td width="20"><input type="checkbox" onchange="uncheck_other(this.id);" class="estatus" name="caso_cerrado" id="caso_cerrado" value="1" <? if($row_paso['pago_realizado'] == 1){echo 'disabled="disabled"';} ?> <? if($row_paso['caso_cerrado'] == 1){echo 'checked="checked"';} ?> /></td>
        			<td width="2">&nbsp;</td>
        			<td colspan="3">Caso cerrado</td>
        			</tr>
        		<tr>
        			<td width="20"><input type="checkbox" onchange="uncheck_other(this.id);" class="estatus" name="caso_inconcluso" id="caso_inconcluso" value="1" <? if($row_paso['pago_realizado'] == 1){echo 'disabled="disabled"';} ?> <? if($row_paso['caso_inconcluso'] == 1){echo 'checked="checked"';} ?> /></td>
        			<td>&nbsp;</td>
        			<td colspan="3">Caso inconcluso</td>
        			</tr>
        		<tr>
        			<td width="20"><input type="checkbox" onchange="uncheck_other(this.id);" class="estatus" name="informes" id="informes" value="1" <? if($row_paso['pago_realizado'] == 1){echo 'disabled="disabled"';} ?> <? if($row_paso['informes'] == 1){echo 'checked="checked"';} ?> /></td>
        			<td>&nbsp;</td>
        			<td width="103">Informes</td>
        			<td width="20" align="center"><input type="checkbox" onchange="uncheck_other(this.id);" class="estatus" name="atendido" id="atendido" value="1" <? if($row_paso['pago_realizado'] == 1){echo 'disabled="disabled"';} ?> <? if($row_paso['atendido'] == 1){echo 'checked="checked"';} ?> /></td>
        			<td width="156" align="left">Atendido</td>
        			</tr>
        		</table>
        	<table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
            <tr>
              <td></td>
            </tr>
          </table></td>
      </tr>
      <tr align="center" valign="top">
        <td colspan="5">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr align="center" valign="middle">
    <td width="50%"><input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="javascrip:window.location='preinscrito_detalle.php?id_preinscrito=<? echo $_GET['id_preinscrito']; ?>'" /></td>
    <td width="50%"><input type="submit" name="guardar" id="guardar" value="Guardar informaci&oacute;n" /></td>
  </tr>
</table>        &nbsp;&nbsp;&nbsp;</td>
      </tr>
    </table>
    </td>
    </tr>
    </table>
    <input type="hidden" name="cont" id="cont" value="1" />
    <input type="hidden" name="id_preinscrito" value="<? echo $_GET['id_preinscrito']; ?>" />
    <input type="hidden" name="update_form" value="1" />
  </form>
</div>
</body>
</html>
<?php
mysql_free_result($preinscrito);
?>
