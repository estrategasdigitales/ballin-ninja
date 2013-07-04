<?php require_once('../Connections/otono2011.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	
	//Insertar codiguin pa subir archivo.
    $DOC_FILE1 = $_FILES['program_colaboracion_img']['tmp_name'];
	
	if($DOC_FILE1 != NULL){
		//$DOC_FILE_NAME1 = "logo_".$_POST['nombre'].".jpg";
		$DOC_FILE_NAME1 = $_FILES['program_colaboracion_img']['name'];
		$DOC_FILE_TYPE1 = $_FILES['program_colaboracion_img']['type'];
		$DOC_FILE_SIZE1 = $_FILES['program_colaboracion_img']['size'];
		
		$target_path1 = "../otono_2011/imagenes/colaboradores/";
		
		// Create the new directory
		if(!file_exists($target_path1)){
			mkdir($target_path1, 0777);
		}
		
		$img_colaborador = $DOC_FILE_NAME1;
		
		$full_target_path1 = $target_path1 . $DOC_FILE_NAME1;
		
		move_uploaded_file($DOC_FILE1, $full_target_path1);
	
	}else{
		$img_colaborador = NULL;
	}
	
	//Insertar codiguin pa subir archivo.
    $DOC_FILE2 = $_FILES['program_pdf']['tmp_name'];
	
	if($DOC_FILE2 != NULL){
		  
		//$DOC_FILE_NAME1 = "logo_".$_POST['nombre'].".jpg";
		$DOC_FILE_NAME2 = $_FILES['program_pdf']['name'];
		$DOC_FILE_TYPE2 = $_FILES['program_pdf']['type'];
		$DOC_FILE_SIZE2 = $_FILES['program_pdf']['size'];
		
		$target_path2 = "../otono_2011/temarios/";
		
		// Create the new directory
		if(!file_exists($target_path2)){
			mkdir($target_path2, 0777);
		}
		
		$pdf_programa = $DOC_FILE_NAME2;
		
		$full_target_path2 = $target_path2 . $DOC_FILE_NAME2;
		
		move_uploaded_file($DOC_FILE2, $full_target_path2);
	}else{
		
		$pdf_programa = NULL;
		
	}
	
	//Insertar codiguin pa subir archivo.
    $DOC_FILE3 = $_FILES['banner']['tmp_name'];
	
	if($DOC_FILE3 != NULL){
		  
		//$DOC_FILE_NAME1 = "logo_".$_POST['nombre'].".jpg";
		$DOC_FILE_NAME3 = $_FILES['banner']['name'];
		$DOC_FILE_TYPE3 = $_FILES['banner']['type'];
		$DOC_FILE_SIZE3 = $_FILES['banner']['size'];
		
		$target_path3 = "../otono_2011/imagenes/banners/programas_banners/";
		
		// Create the new directory
		if(!file_exists($target_path3)){
			mkdir($target_path3, 0777);
		}
		
		$banner = $DOC_FILE_NAME3;
		
		$full_target_path3 = $target_path3 . $DOC_FILE_NAME3;
		
		move_uploaded_file($DOC_FILE3, $full_target_path3);
		
	}else{
		
		$banner = NULL;
		
	}
	
		//Insertar codiguin pa subir archivo.
    $DOC_FILE4 = $_FILES['banner_home']['tmp_name'];
	
	if($DOC_FILE4 != NULL){
		  
		//$DOC_FILE_NAME1 = "logo_".$_POST['nombre'].".jpg";
		$DOC_FILE_NAME4 = $_FILES['banner_home']['name'];
		$DOC_FILE_TYPE4 = $_FILES['banner_home']['type'];
		$DOC_FILE_SIZE4 = $_FILES['banner_home']['size'];
		
		$target_path4 = "../otono_2011/imagenes/uploads/banner_prox/";
		
		// Create the new directory
		if(!file_exists($target_path4)){
			mkdir($target_path4, 0777);
		}
		
		$banner_home = $DOC_FILE_NAME4;
		
		$full_target_path4 = $target_path4 . $DOC_FILE_NAME4;
		
		move_uploaded_file($DOC_FILE4, $full_target_path4);
		
	}else{
		
		$banner_home = NULL;
		
	}
	
	
	
	
	
	$id_discipline_alterna = NULL;
	if($_POST['id_discipline_alterna_1'] != ""){
		$id_discipline_alterna = $_POST['id_discipline_alterna_1'];
	}
	if($_POST['id_discipline_alterna_2'] != ""){
		$id_discipline_alterna .= ', '.$_POST['id_discipline_alterna_2'];
	}
	if($_POST['id_discipline_alterna_3'] != ""){
		$id_discipline_alterna .= ', '.$_POST['id_discipline_alterna_3'];
	}
	if($_POST['id_discipline_alterna_4'] != ""){
		$id_discipline_alterna .= ', '.$_POST['id_discipline_alterna_4'];
	}
	
	$id_encargado = NULL;
	if($_POST['id_encargado_1'] != ""){
		$id_encargado = $_POST['id_encargado_1'];
	}
	if($_POST['id_encargado_2'] != ""){
		$id_encargado .= ', '.$_POST['id_encargado_2'];
	}
	if($_POST['id_encargado_3'] != ""){
		$id_encargado .= ', '.$_POST['id_encargado_3'];
	}
	if($_POST['id_encargado_4'] != ""){
		$id_encargado .= ', '.$_POST['id_encargado_4'];
	}
	
	$id_maestro = NULL;
	if($_POST['id_maestro_1'] != ""){
		$id_maestro = $_POST['id_maestro_1'];
	}
	if($_POST['id_maestro_2'] != ""){
		$id_maestro .= ', '.$_POST['id_maestro_2'];
	}
	if($_POST['id_maestro_3'] != ""){
		$id_maestro .= ', '.$_POST['id_maestro_3'];
	}
	if($_POST['id_maestro_4'] != ""){
		$id_maestro .= ', '.$_POST['id_maestro_4'];
	}
	

	if(isset($_POST['program_new'])){
		$nuevo = $_POST['program_new'];
	}else{
		$nuevo = 0;
	}

  $insertSQL = sprintf("INSERT INTO site_programs (id_program, id_discipline, id_discipline_alterna, program_type, program_name, program_colaboracion, program_colaboracion_img, program_new, `description`, imagen, observaciones, id_maestro, duration, costo_curso, cost_inscripcion, costo_modulo, id_encargado, banner, banner_url, program_pdf, cancelado, periodo, idioma) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_program'], "int"),
                       GetSQLValueString($_POST['id_discipline'], "int"),
                       GetSQLValueString($id_discipline_alterna, "text"),
                       GetSQLValueString($_POST['program_type'], "text"),
                       GetSQLValueString($_POST['program_name'], "text"),
                       GetSQLValueString($_POST['program_colaboracion'], "text"),
                       GetSQLValueString($img_colaborador, "text"),
                       GetSQLValueString($nuevo, "int"),
                       GetSQLValueString($_POST['description'], "text"),
					   GetSQLValueString($banner_home, "text"),
                       GetSQLValueString($_POST['observaciones'], "text"),
                       GetSQLValueString($id_maestro, "text"),
                       GetSQLValueString($_POST['duration'], "text"),
                       GetSQLValueString($_POST['costo_curso'], "text"),
                       GetSQLValueString($_POST['cost_inscripcion'], "text"),
                       GetSQLValueString($_POST['costo_modulo'], "text"),
                       GetSQLValueString($id_encargado, "text"),
                       GetSQLValueString($banner, "text"),
			GetSQLValueString($_POST['banner_url'], "text"),
                       GetSQLValueString($pdf_programa, "text"),
                       GetSQLValueString(isset($_POST['cancelado']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['periodo'], "text"),
                       GetSQLValueString(isset($_POST['idioma']) ? "true" : "", "defined","1","NULL"));

  mysql_select_db($database_otono2011, $otono2011);
  $Result1 = mysql_query($insertSQL, $otono2011) or die(mysql_error());
  
  $insertGoTo = "programas_home.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_otono2011, $otono2011);
$query_discipline = "SELECT * FROM disciplines ORDER BY id_discipline ASC";
$discipline = mysql_query($query_discipline, $otono2011) or die(mysql_error());
$row_discipline = mysql_fetch_assoc($discipline);
$totalRows_discipline = mysql_num_rows($discipline);

mysql_select_db($database_otono2011, $otono2011);
$query_maestros = "SELECT id_maestro, nombre_maestro FROM site_maestros ORDER BY nombre_maestro ASC";
$maestros = mysql_query($query_maestros, $otono2011) or die(mysql_error());
$row_maestros = mysql_fetch_assoc($maestros);
$totalRows_maestros = mysql_num_rows($maestros);

mysql_select_db($database_otono2011, $otono2011);
$query_encargado = "SELECT id_encargado, nombre FROM site_directory ORDER BY nombre ASC";
$encargado = mysql_query($query_encargado, $otono2011) or die(mysql_error());
$row_encargado = mysql_fetch_assoc($encargado);
$totalRows_encargado = mysql_num_rows($encargado);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/temp_admin.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"
        />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Educaci&oacute;n Continua</title>
<script src="../Scripts/jquery.js"></script>
<script language="javascript" type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<!-- TinyMCE -->
<script language="javascript" type="text/javascript">

	function fileBrowserCallBack(field_name, url, type, win) {
		// This is where you insert your custom filebrowser logic
		alert("Filebrowser callback: field_name: " + field_name + ", url: " + url + ", type: " + type);

		// Insert new URL, this would normaly be done in a popup
		win.document.forms[0].elements[field_name].value = "someurl.htm";
	}
</script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript">
$(document).ready(function(){

CKEDITOR.replace( 'observaciones' );
CKEDITOR.replace( 'description' );

})

function check_fields(){

	var empty_fields = true;
	var message = "Los siguientes campos son obligatorios:\n\n"
	

	if($('input[name="program_name"]').val() == ""){
		message += "Nombre\n";
		empty_fields = 0;
	}
	if(!$('input[name="program_type"]').is(':checked')){
		message += "Tipo\n";
		empty_fields = 0;
	}
	if(!$('input[name="periodo"]').is(':checked')){
		message += "Periodo\n";
		empty_fields = 0;
	}
	if($('select[name="id_maestro_1"]').val() == ""){
		message += "Maestro\n";
    	empty_fields = 0;
	}
	if(!$.trim($(document).find('#description').val())){
    	message += "Descripci\u00F3n\n";
    	empty_fields = 0;
	}

	if(empty_fields != 0){
		return true;
	}else if(empty_fields == 0){
		alert(message);
		return false;
	}

}

</script>
<!-- InstanceEndEditable -->
<link href="../css/estilos.css" rel="stylesheet"
        type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>
<div id="container">
  <div id="header">
    <div id="logos">
      <h1><a href="http://uia.mx/" target="_blank"><img src="../imagenes/logo_UIA.jpg" alt="logo" width="100" height="78" border="0" class="logo"/></a><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/index.php'"><img src="../imagenes/logo_DEC.jpg" alt="DEC" width="90" height="78" border="0" /></a></h1>
    </div>
    <h1 style="float:left; margin:15px; color:#666;"> Administrador de Contenidos</h1>
    <a href="index.php"><img width="20px" height="20px" src="imagenes/home.png" style="float:left; clear:both; margin-left: 206px; margin-top:-13px;"></img></a>
    <div class="bannersuperior2" style="margin-left: 4px"></div>
  </div>
  <div id="separador"></div>
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
          <h2>Programas</h2>
          <ul>
            <li><a href="programas_home.php">Programas</a> </li>
            <li><a href="fechas_home.php">Fechas</a> </li>
            <li><a href="fechas_idiom_home.php">Fechas Idiomas</a> </li>
            <li><a href="propuestas_progr_home.php">Propuestas Programas</a></li>
          </ul>
          <p>&nbsp;</p>
          <h2>Carrusel Index</h2>
          <ul>
            <li><a href="admin_carrusel/index.php">Banners</a></li>
          </ul>
          <p>&nbsp;</p>
          <h2>Art&iacute;culos</h2>
          <ul>
            <li><a href="admin_discipline_articles.php?id_discipline=1">Disciplinas</a> </li>
            <li><a href="admin_opinions.php">La Comunidad Ibero Opina</a> </li>            
            <li><a href="admin_weekly_articles.php">Art&iacute;culos semanales</a> </li>
            <!--li><a href="admin_media_articles.php">La DEC en los Medios</a> </li-->
          </ul>
          <p>&nbsp;</p>
          <h2>Sedes</h2>
          <ul>
            <li><a href="admin_sedes_home.php">Sedes</a></li>
          </ul>
          <p>&nbsp;</p>
          <h2>Directorio</h2>
          <ul>
            <li><a href="admin_dir_dec.php">DEC</a></li>
            <li><a href="admin_dir_maestros.php">Maestros</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div id="contenedor_irregular_index" style="width:800px;"><!-- InstanceBeginEditable name="contenido" -->
    <h1>Nuevo Programa </h1>
    <form action="programas_nuevo.php" onsubmit="return check_fields();" method="post" name="form1" id="form1" enctype="multipart/form-data">
      <table border="0" align="left" cellpadding="5" cellspacing="0">
        <tr valign="baseline">
          <td align="right" valign="top" nowrap="nowrap"><strong>Disciplina:</strong></td>
          <td colspan="2"><select name="id_discipline" id="id_discipline">
              <?php
				do {  
				?>
              <option value="<?php echo $row_discipline['id_discipline']?>"><?php echo $row_discipline['discipline']?></option>
              <?php
				} while ($row_discipline = mysql_fetch_assoc($discipline));
				  $rows = mysql_num_rows($discipline);
				  if($rows > 0) {
					  mysql_data_seek($discipline, 0);
					  $row_discipline = mysql_fetch_assoc($discipline);
				  }
				?>
            </select></td>
        </tr>
        <tr valign="baseline">
          <td align="right" valign="top" nowrap="nowrap"><strong>Disciplina alterna:</strong></td>
          <td colspan="2"> (1)
            <select name="id_discipline_alterna_1" id="id_discipline_alterna_1">
              <option value="">N/A</option>
              <?php
				do {  
				?>
              <option value="<?php echo $row_discipline['id_discipline']?>"><?php echo $row_discipline['discipline']?></option>
              <?php
				} while ($row_discipline = mysql_fetch_assoc($discipline));
				  $rows = mysql_num_rows($discipline);
				  if($rows > 0) {
					  mysql_data_seek($discipline, 0);
					  $row_discipline = mysql_fetch_assoc($discipline);
				  }
				?>
            </select>
            <br />
            (2)
            <select name="id_discipline_alterna_2" id="id_discipline_alterna_2">
              <option value="">N/A</option>
              <?php
				do {  
				?>
              <option value="<?php echo $row_discipline['id_discipline']?>"><?php echo $row_discipline['discipline']?></option>
              <?php
				} while ($row_discipline = mysql_fetch_assoc($discipline));
				  $rows = mysql_num_rows($discipline);
				  if($rows > 0) {
					  mysql_data_seek($discipline, 0);
					  $row_discipline = mysql_fetch_assoc($discipline);
				  }
				?>
            </select>
            <br />
            (3)
            <select name="id_discipline_alterna_3" id="id_discipline_alterna_4">
              <option value="">N/A</option>
              <?php
				do {  
				?>
              <option value="<?php echo $row_discipline['id_discipline']?>"><?php echo $row_discipline['discipline']?></option>
              <?php
				} while ($row_discipline = mysql_fetch_assoc($discipline));
				  $rows = mysql_num_rows($discipline);
				  if($rows > 0) {
					  mysql_data_seek($discipline, 0);
					  $row_discipline = mysql_fetch_assoc($discipline);
				  }
				?>
            </select>
            <br />
            (4)
            <select name="id_discipline_alterna_4" id="id_discipline_alterna_4">
              <option value="">N/A</option>
              <?php
				do {  
				?>
              <option value="<?php echo $row_discipline['id_discipline']?>"><?php echo $row_discipline['discipline']?></option>
              <?php
				} while ($row_discipline = mysql_fetch_assoc($discipline));
				  $rows = mysql_num_rows($discipline);
				  if($rows > 0) {
					  mysql_data_seek($discipline, 0);
					  $row_discipline = mysql_fetch_assoc($discipline);
				  }
				?>
            </select></td>
        </tr>
        <tr valign="baseline">
          <td align="right" valign="top" nowrap="nowrap"><strong>Tipo:</strong></td>
          <td colspan="2" valign="baseline"><table width="216">
              <tr>
                <td width="99"><input type="radio" name="program_type" value="diplomado" />
                  curso</td>
                <td width="19">&nbsp;</td>
                <td width="82"><input type="radio" name="program_type" value="programa" />
                 programa</td>
              </tr>
              <tr>
                <td><input type="radio" name="program_type" value="diplomado" />
                  diplomado</td>
                <td></td>
                <td> </td>
              </tr>
            </table></td>
        </tr>
        <tr valign="baseline">
          <td align="right" valign="top" nowrap="nowrap"><strong>Periodo:</strong></td>
          <td colspan="2" valign="baseline"><table>
              <tr>
                <td><input type="radio" name="periodo" value="p" />
                  Primavera</td>
              </tr>
              <tr>
                <td><input type="radio" name="periodo" value="v" />
                  Verano</td>
              </tr>
              <tr>
                <td><input type="radio" name="periodo" value="o" />
                  Oto&ntilde;o</td>
              </tr>
            </table></td>
        </tr>
        <tr valign="baseline">
          <td align="right" valign="top" nowrap="nowrap"><strong>Nombre:</strong></td>
          <td colspan="2"><input type="text" name="program_name" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td align="right" valign="top" nowrap="nowrap"><strong>En colaboraci&oacute;n con:</strong></td>
          <td colspan="2"><input type="text" name="program_colaboracion" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td align="right" valign="top" nowrap="nowrap"><strong>Colaborador img:</strong></td>
          <td colspan="2"><input type="file" name="program_colaboracion_img" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td align="right" valign="top" nowrap="nowrap"><strong>Nuevo:</strong></td>
          <td colspan="2"><input type="radio" name="program_new" value="1" /></td>
        </tr>
        <tr valign="baseline">
          <td align="right" valign="top" nowrap="nowrap"><strong>Nueva Versi&oacute;n:</strong></td>
          <td colspan="2"><input type="radio" name="program_new" value="2" /></td>
        </tr>
        <tr valign="baseline">
          <td align="right" valign="top" nowrap="nowrap"><strong>Descripci&oacute;n:</strong></td>
          <td colspan="2"><textarea id="description" name="description" cols="50" rows="50"></textarea></td>
        </tr>
        <tr valign="baseline">
          <td align="right" valign="top" nowrap="nowrap"><strong>Observaciones:</strong></td>
          <td colspan="2"><textarea id="observaciones" name="observaciones" cols="50" rows="10"></textarea></td>
        </tr>
        <tr valign="baseline">
          <td align="right" valign="top" nowrap="nowrap"><strong>Maestro:</strong></td>
          <td colspan="2"> (1)
            <select name="id_maestro_1" id="id_maestro_1">
              <option value="">N/A</option>
              <?php
					do {  
					?>
              <option value="<?php echo $row_maestros['id_maestro']?>"><?php echo $row_maestros['nombre_maestro']?></option>
              <?php
					} while ($row_maestros = mysql_fetch_assoc($maestros));
					  $rows = mysql_num_rows($maestros);
					  if($rows > 0) {
						  mysql_data_seek($maestros, 0);
						  $row_maestros = mysql_fetch_assoc($maestros);
					  }
					?>
            </select>
            <br />
            (2)
            <select name="id_maestro_2" id="id_maestro_2">
              <option value="">N/A</option>
              <?php
					do {  
					?>
              <option value="<?php echo $row_maestros['id_maestro']?>"><?php echo $row_maestros['nombre_maestro']?></option>
              <?php
					} while ($row_maestros = mysql_fetch_assoc($maestros));
					  $rows = mysql_num_rows($maestros);
					  if($rows > 0) {
						  mysql_data_seek($maestros, 0);
						  $row_maestros = mysql_fetch_assoc($maestros);
					  }
					?>
            </select>
            <br />
            (3)
            <select name="id_maestro_3" id="id_maestro_3">
              <option value="">N/A</option>
              <?php
					do {  
					?>
              <option value="<?php echo $row_maestros['id_maestro']?>"><?php echo $row_maestros['nombre_maestro']?></option>
              <?php
					} while ($row_maestros = mysql_fetch_assoc($maestros));
					  $rows = mysql_num_rows($maestros);
					  if($rows > 0) {
						  mysql_data_seek($maestros, 0);
						  $row_maestros = mysql_fetch_assoc($maestros);
					  }
					?>
            </select>
            <br />
            (4)
            <select name="id_maestro_4" id="id_maestro_4">
              <option value="">N/A</option>
              <?php
					do {  
					?>
              <option value="<?php echo $row_maestros['id_maestro']?>"><?php echo $row_maestros['nombre_maestro']?></option>
              <?php
					} while ($row_maestros = mysql_fetch_assoc($maestros));
					  $rows = mysql_num_rows($maestros);
					  if($rows > 0) {
						  mysql_data_seek($maestros, 0);
						  $row_maestros = mysql_fetch_assoc($maestros);
					  }
					?>
            </select></td>
        </tr>
        <tr valign="baseline">
          <td align="right" valign="top" nowrap="nowrap"><strong>Duraci&oacute;n:</strong></td>
          <td colspan="2"><input type="text" name="duration" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td align="right" valign="top" nowrap="nowrap"><strong>Costo curso:</strong></td>
          <td colspan="2"><input type="text" name="costo_curso" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td align="right" valign="top" nowrap="nowrap"><strong>Costo inscripcion:</strong></td>
          <td colspan="2"><input type="text" name="cost_inscripcion" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td align="right" valign="top" nowrap="nowrap"><strong>Costo m&oacute;dulo:</strong></td>
          <td colspan="2"><input type="text" name="costo_modulo" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td align="right" valign="top" nowrap="nowrap"><strong>Encargado:</strong></td>
          <td colspan="2"> (1)
            <select name="id_encargado_1" id="id_encargado_1">
              <?php
					do {  
					?>
              <option value="<?php echo $row_encargado['id_encargado']?>"><?php echo $row_encargado['nombre']?></option>
              <?php
					} while ($row_encargado = mysql_fetch_assoc($encargado));
					  $rows = mysql_num_rows($encargado);
					  if($rows > 0) {
						  mysql_data_seek($encargado, 0);
						  $row_encargado = mysql_fetch_assoc($encargado);
					  }
					?>
            </select>
            <br />
            (2)
            <select name="id_encargado_2" id="id_encargado_2">
              <option value="">N/A</option>
              <?php
					do {  
					?>
              <option value="<?php echo $row_encargado['id_encargado']?>"><?php echo $row_encargado['nombre']?></option>
              <?php
					} while ($row_encargado = mysql_fetch_assoc($encargado));
					  $rows = mysql_num_rows($encargado);
					  if($rows > 0) {
						  mysql_data_seek($encargado, 0);
						  $row_encargado = mysql_fetch_assoc($encargado);
					  }
					?>
            </select>
            <br />
            (3)
            <select name="id_encargado_3" id="id_encargado_3">
              <option value="">N/A</option>
              <?php
					do {  
					?>
              <option value="<?php echo $row_encargado['id_encargado']?>"><?php echo $row_encargado['nombre']?></option>
              <?php
					} while ($row_encargado = mysql_fetch_assoc($encargado));
					  $rows = mysql_num_rows($encargado);
					  if($rows > 0) {
						  mysql_data_seek($encargado, 0);
						  $row_encargado = mysql_fetch_assoc($encargado);
					  }
					?>
            </select>
            <br />
            (4)
            <select name="id_encargado_4" id="id_encargado_4">
              <option value="">N/A</option>
              <?php
					do {  
					?>
              <option value="<?php echo $row_encargado['id_encargado']?>"><?php echo $row_encargado['nombre']?></option>
              <?php
					} while ($row_encargado = mysql_fetch_assoc($encargado));
					  $rows = mysql_num_rows($encargado);
					  if($rows > 0) {
						  mysql_data_seek($encargado, 0);
						  $row_encargado = mysql_fetch_assoc($encargado);
					  }
					?>
            </select></td>
        </tr>
        <!--tr valign="baseline">
          <td align="right" valign="top" nowrap="nowrap"><strong>Banner:</strong></td>
          <td colspan="2"><input type="file" name="banner" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td align="right" valign="top" nowrap="nowrap"><strong>Banner URL.</strong></td>
          <td colspan="2"><input type="text" name="banner_url" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td align="right" valign="top" nowrap="nowrap"><strong>Banner en Home:</strong></td>
          <td colspan="2"><input type="file" name="banner_home" value="" size="32" /></td>
        </tr-->
        <tr valign="baseline">
          <td align="right" valign="top" nowrap="nowrap"><strong>Programa PDF:</strong></td>
          <td colspan="2"><input type="file" name="program_pdf" value="" size="32" /></td>
        </tr>
        <tr valign="baseline"> 
          <!--td align="right" valign="top" nowrap="nowrap">Publicado:</td>
		  <td colspan="2"><input type="checkbox" name="publicado" value="" /></td--> 
        </tr>
        <tr valign="baseline">
          <td align="right" valign="top" nowrap="nowrap"><strong>Cancelado:</strong></td>
          <td colspan="2"><input type="checkbox" name="cancelado" value="" /></td>
        </tr>
        <tr valign="baseline">
          <td align="right" valign="top" nowrap="nowrap"><strong>Idioma:</strong></td>
          <td colspan="2"><input type="checkbox" name="idioma" value="" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">&nbsp;</td>
          <td><input name="Button" type="button" value="Cancelar" onclick="javascript:history.back()" /></td>
          <td><input type="submit" value="Insert record" /></td>
        </tr>
      </table>
      <input type="hidden" name="id_program" value="" />
      <input type="hidden" name="MM_insert" value="form1" />
    </form>
    <p>&nbsp;</p>
    <!-- InstanceEndEditable --></div>
  <div id="separador" style=" clear:both; height:20px;"></div>
  
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($discipline);

mysql_free_result($maestros);

mysql_free_result($encargado);
?>
