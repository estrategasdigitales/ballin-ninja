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
	
	$update_query = "UPDATE sp_pasos_status SET
	primer_contacto = '".$_POST['primer_contacto']."',
	documentos = '".$_POST['documentos']."',
	envio_decse = '".$_POST['envio_decse']."',
	envio_claves = '".$_POST['envio_claves']."',
	pago_realizado = '".$_POST['pago_realizado']."',
	caso_cerrado = '".$_POST['caso_cerrado']."',
	caso_inconcluso = '".$_POST['caso_inconcluso']."',
	informes = '".$_POST['informes']."',
	comentario_general = '".$_POST['comentario_general']."'
	WHERE id_preinscrito = ".$_POST['id_preinscrito'];
			
	mysql_select_db($database_des_preinscritos, $des_preinscritos);
	
	$Result1 = mysql_query($update_query, $des_preinscritos) or die(mysql_error());
	
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
		
			mysql_select_db($database_des_preinscritos, $des_preinscritos);
			$Result1 = mysql_query($insertSQL, $des_preinscritos) or die(mysql_error());
		  
			move_uploaded_file($DOC_FILE1, $full_target_path1);
		}
	}
	
	header('Location: preinscrito_detalle_a.php?id_preinscrito='.$_POST['id_preinscrito']);
	//$onload = 'onload="alertas(\'El estatus del interesado a sido actualizado.\')"';
}

mysql_select_db($database_des_preinscritos, $des_preinscritos);
$query_preinscrito = "SELECT * FROM sp_preinscritos WHERE id_preinscrito = ".$_GET['id_preinscrito'];
$preinscrito = mysql_query($query_preinscrito, $des_preinscritos) or die(mysql_error());
$row_preinscrito = mysql_fetch_assoc($preinscrito);
//$totalRows_preinscrito = mysql_num_rows($preinscrito);


mysql_select_db($database_des_preinscritos, $des_preinscritos);
$query_program_name = "SELECT program_name, program_type, (SELECT discipline FROM disciplines WHERE id_discipline = ".$row_preinscrito['id_discipline'].") AS discipline FROM site_programs WHERE id_program = ".$row_preinscrito['id_program'];
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

function check_decse(){
	if($('input#envio_decse').is(':checked')){
		return confirm('Seleccionó la opción para enviar los datos a DECSE. ¿Está seguro/a que desea enviar la información? No podrás editar la información del registro hasta que las claves sean enviadas.');
	}else{
		return true;
	}
}

function add_comment(){
	$('td#td_comentario_general').html('<textarea name="comentario_general" cols="50" rows="5" id="comentario_general"><? echo $row_paso['comentario_general']; ?></textarea>');
}

function add_small_comment(id, comment){
	$('td#'+id).html('<textarea name="'+id+'" rows="3" style="width:300px; max-width:300px;">'+ comment +'</textarea>');
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
<form method="post" action="preinscrito_detalle_a.php?id_preinscrito=<? echo $_GET['id_preinscrito']; ?>" name="form1" id="form1" enctype="multipart/form-data" <? if($row_paso['envio_decse'] == 0){echo 'onsubmit="return check_decse();"';} ?>>
  <h2><?php echo $row_program_name['program_type'].' - '.$row_program_name['program_name']; ?></h2>
  <h3><?php echo $row_program_name['discipline']; ?> </h3>
  <div class="sombra"> </div>
  <table width="822" border="0" cellpadding="0" cellspacing="0">
    <tr valign="top">
      <td width="400"><h2>Datos del interesado</h2>
        <p><strong>Nombre completo: </strong><?php echo $row_preinscrito['a_paterno'].' '.$row_preinscrito['a_materno'].', '.$row_preinscrito['nombre']?></p>
        <p><strong>Fecha de registro: </strong><? echo utf8_encode(strftime("%d de %B de %Y", strtotime($row_preinscrito['fecha_registro']))); ?></p>
        <p><strong>Calle y n&uacute;mero: </strong><?php echo $row_preinscrito['calle_numero']; ?></p>
        <p><strong>Colonia: </strong><?php echo $row_preinscrito['colonia']; ?></p>
        <p><strong>Del o mpo: </strong><?php echo $row_preinscrito['del_mpo']; ?></p>
        <p><strong>CP: </strong><?php echo $row_preinscrito['cp']; ?></p>
        <p><strong>Ciudad: </strong><?php echo $row_preinscrito['ciudad']; ?></p>
        <p><strong>Estado: </strong><?php echo $row_preinscrito['estado']; ?></p>
        <p><strong>Tel&eacute;fono:</strong> <?php echo $row_preinscrito['telefono']; ?> </p>
        <p><strong>Celular: </strong><?php echo $row_preinscrito['celular']; ?> </p>
        <p><strong>RFC: </strong><?php echo $row_preinscrito['rfc']; ?> </p>
        <p><strong>Correo electr&oacute;nico: </strong><?php echo $row_preinscrito['correo']; ?> </p>
        <p><strong>Instituci&oacute;n de estudios: </strong><?php echo $row_preinscrito['institucion_estudios']; ?> </p>
        <p><strong>Nacionalidad: </strong><?php echo $row_preinscrito['nacionalidad']; ?> </p>
        <p><strong>Nivel acad&eacute;mico: </strong><?php echo $row_preinscrito['grado_academico']; ?> </p>
        <p><strong>Exalumno Ibero: </strong><?php echo $row_preinscrito['exalumno']; ?> </p>
        <p><strong>¿Cómo se enteró?: </strong><?php echo $row_preinscrito['como_se_entero']; ?> </p>
        <p><strong>¿Porqué la Ibero?:</strong> <?php echo $row_preinscrito['porque_la_ibero']; ?> </p>
        <p>&nbsp;</p>
        <p><strong>Empresa:</strong> <?php echo $row_preinscrito['empresa']; ?> </p>
        <p><strong>Puesto:</strong> <?php echo $row_preinscrito['puesto']; ?> </p>
        <p><strong>Dirección de la empresa:</strong> <?php echo $row_preinscrito['direccion_empresa']; ?> </p>
        <p><strong>Teléfono de la empresa:</strong> <?php echo $row_preinscrito['telefono_empresa']; ?> </p>  
      
      </td>
      <td width="10">&nbsp;</td>
      <td width="3" style="background:#f2f2f2;">&nbsp;</td>
      <td width="10">&nbsp;</td>
      <td width="399"><h2>Documentos</h2>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="100%" align="left"><? if($totalRows_docs > 0){ ?>
              <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <? do{ ?>
                  <tr>
                    <td align="left"><? echo $row_docs['doc_type'].': <a style="color:#F00;" href="uploads/documentos/preinscrito_'.$_GET['id_preinscrito'].'/'.$row_docs['archivo'].'" target="_blank">'.$row_docs['archivo'].'</a>'; ?></td>
                  </tr>
                  <? } while($row_docs = mysql_fetch_assoc($docs));
			?>
              </table>
              <? } ?>
            <p class="anadir_comentario"><a onclick="add_file();" style="cursor:pointer;"><img src="imagenes/archivo.png"  /> a&ntilde;adir archivo</a></p>
              <table width="100%" border="0" cellpadding="0" cellspacing="0" id="table_file">
                <tr>
                  <td><strong>Archivo</strong></td>
                  <td><strong>Tipo de documento</strong></td>
                </tr>
                <tr>
                  <td><input name="doc_0" type="file" id="doc_0" value="" size="10" /></td>
                  <td><input name="doc_type_0" type="text" id="doc_type_0" size="20" /></td>
                </tr>
              </table></td>
          </tr>
        </table></td>
    </tr>
    <tr valign="top">
      <td colspan="5">  <div class="sombra"> </div></td>
    </tr>
    <tr valign="top">
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td style="background:#f2f2f2;">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="top">
      <td><h2>Estatus del proceso</h2>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="22"><input type="checkbox" name="primer_contacto" id="primer_contacto" value="1" <? if($_SESSION['loggedin_id_access'] == 4){echo 'disabled="disabled"';} ?> <? if($row_paso['primer_contacto'] == 1){echo 'checked="checked"';} ?> /></td>
            <td width="3">&nbsp;</td>
            <td width="160">Primer contacto</td>
            <td width="14">&nbsp;</td>
            <td width="201"><p class="anadir_comentario"><a style="cursor:pointer;" onclick="add_small_comment('td_comment_primercontacto','<? echo $comment_1; ?>')"><img src="imagenes/comentario.png" /> a&ntilde;adir - editar comentario</p></a></td>
          </tr>
          <tr>
            <td colspan="5" id="td_comment_primercontacto"><p class="anadir_comentario"><? echo $comment_1; ?></p></td>
          </tr>
          <tr>
            <td width="22"><input type="checkbox" name="documentos" id="documentos" value="1" <? if($_SESSION['loggedin_id_access'] == 4){echo 'disabled="disabled"';} ?> <? if($row_paso['documentos'] == 1){echo 'checked="checked"';} ?> /></td>
            <td>&nbsp;</td>
            <td>Documentos</td>
            <td></td>
            <td><p><a class="anadir_comentario" style="cursor:pointer;" onclick="add_small_comment('td_comment_documentos','<? echo $comment_2; ?>')"><img src="imagenes/comentario.png" /> a&ntilde;adir - editar comentario</a></p></td>
          </tr>
          
            <td colspan="5"id="td_comment_documentos"><p class="anadir_comentario"><? echo $comment_2; ?></p></td>
          <tr>
            <td width="22"><input type="checkbox" name="claves" id="claves" disabled="disabled" <? if($row_paso['envio_claves'] == 1){echo 'checked="checked"';} ?> />
              <input type="hidden" name="envio_claves" id="envio_claves" value="<? echo $row_paso['envio_claves']; ?>" /></td>
            <td>&nbsp;</td>
            <td>Env&iacute;o de claves</td>
            <td></td>
            <td><p class="anadir_comentario"><a style="cursor:pointer;" onclick="add_small_comment('td_comment_envioclaves','<? echo $comment_3; ?>')"><img src="imagenes/comentario.png" /> a&ntilde;adir - editar comentario</a></p></td>
          </tr>
          <tr>
            <td colspan="5" id="td_comment_envioclaves"><p class="anadir_comentario"><? echo $comment_3; ?></p></td>
          </tr>
          <tr>
            <td width="22"><input type="checkbox" name="pago_realizado" id="pago_realizado" value="1" <? if($row_paso['envio_claves'] == 0){echo 'disabled="disabled"';} ?> <? if($row_paso['pago_realizado'] == 1){echo 'checked="checked"';} ?> onchange="check_pago(1)" /></td>
            <td>&nbsp;</td>
            <td>Pago realizado</td>
            <td></td>
            <td><p><a class="anadir_comentario" style="cursor:pointer;" onclick="add_small_comment('td_comment_pagorealizado','<? echo $comment_4; ?>')"><img src="imagenes/comentario.png" />a&ntilde;adir - editar comentario</a></p></td>
          </tr>
          <tr>
            <td colspan="5" id="td_comment_pagorealizado"><p class="anadir_comentario"><? echo $comment_4; ?></p></td>
          </tr>
        </table></td>
      <td>&nbsp;</td>
    <td style="background:#f2f2f2;">&nbsp;</td>
    <td>&nbsp;</td>
      <td><h2>Clasificar al aspirante</h2>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="40" align="center"><? if($row_paso['envio_decse'] == 1){ ?>
              <input type="checkbox" name="decse" id="decse" value="1" disabled="disabled" checked="checked" />
              <input type="hidden" name="envio_decse" id="envio_decse" value="<? echo $row_paso['envio_decse'] ?>" />
              <? }else{ ?>
              <input type="checkbox" onchange="uncheck_other(this.id);" name="envio_decse" id="envio_decse" value="1" />
              <? } ?></td>
            <td width="14" align="left">&nbsp;</td>
            <td align="left">Enviar a DECSE</td>
          </tr>
          <tr>
            <td width="40" align="center"><input type="checkbox" onchange="uncheck_other(this.id);" class="estatus" name="caso_cerrado" id="caso_cerrado" value="1" <? if($row_paso['pago_realizado'] == 1){echo 'disabled="disabled"';} ?> <? if($row_paso['caso_cerrado'] == 1){echo 'checked="checked"';} ?> /></td>
            <td align="left">&nbsp;</td>
            <td align="left">Caso cerrado</td>
          </tr>
          <tr>
            <td width="40" align="center"><input type="checkbox" onchange="uncheck_other(this.id);" class="estatus" name="caso_inconcluso" id="caso_inconcluso" value="1" <? if($row_paso['pago_realizado'] == 1){echo 'disabled="disabled"';} ?> <? if($row_paso['caso_inconcluso'] == 1){echo 'checked="checked"';} ?> /></td>
            <td align="left">&nbsp;</td>
            <td align="left">Caso inconcluso</td>
          </tr>
          <tr>
            <td width="40" align="center"><input type="checkbox" onchange="uncheck_other(this.id);" class="estatus" name="informes" id="informes" value="1" <? if($row_paso['pago_realizado'] == 1){echo 'disabled="disabled"';} ?> <? if($row_paso['informes'] == 1){echo 'checked="checked"';} ?> /></td>
            <td align="left">&nbsp;</td>
            <td align="left">Informes</td>
          </tr>
        </table>
        <h2>Comentarios</h2>
        <table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
          <tr>
            <td><p><span class="anadir_comentario"><a onclick="add_comment();" style="cursor:pointer;">A&ntilde;adir / editar comentario general</a></span></p></td>
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
    <tr>
      <td colspan="5"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="50%" align="center"><input type="button" name="editar" id="editar" value="Editar información" <? if($row_paso['envio_decse'] == 1 && $row_paso['envio_claves'] == 0){echo 'disabled="disabled"';} ?> onclick="javascrip:window.location='preinscrito_editar_a.php?id_preinscrito=<? echo $_GET['id_preinscrito']; ?>&id_program=<? echo $row_preinscrito['id_program']; ?>'" /></td>
            <td align="center"><input type="submit" name="guardar" id="guardar" value="Guardar información" <? if($row_paso['envio_decse'] == 1 && $row_paso['envio_claves'] == 0){echo 'disabled="disabled"';} ?> /></td>
          </tr>
        </table></td>
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
