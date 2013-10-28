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

if(!isset($_SESSION))
{
	session_start();
	
	if(!isset($_SESSION['usuario']))
	{
		$goto ="index.php";
		header(sprintf("Location: %s", $goto));
		exit;
	}
}

mysql_select_db($database_otono2011, $otono2011);
$query_opinions = sprintf("SELECT * FROM community_opinions WHERE id_opinion = %s", GetSQLValueString($_GET['id_opinion'], "int"));
$opinions = mysql_query($query_opinions, $otono2011) or die(mysql_error());
$row_opinions = mysql_fetch_assoc($opinions);
$totalRows_opinions = mysql_num_rows($opinions);

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	
	$updateSQL = sprintf("UPDATE community_opinions SET `date`=%s, short_name=%s, full_name=%s, age=%s, degree=%s, job_position=%s, diploma_course=%s, opinion=%s WHERE id_opinion=%s",
						   GetSQLValueString($_POST['date'], "date"),
						   GetSQLValueString($_POST['short_name'], "text"),
						   GetSQLValueString($_POST['full_name'], "text"),
						   GetSQLValueString($_POST['age'], "int"),
						   GetSQLValueString($_POST['degree'], "text"),
						   GetSQLValueString($_POST['job_position'], "text"),
						   GetSQLValueString($_POST['diploma_course'], "text"),
						   GetSQLValueString($_POST['opinion'], "text"),
						   GetSQLValueString($_POST['id_opinion'], "int"));
	
	mysql_select_db($database_otono2011, $otono2011);
	$Result1 = mysql_query($updateSQL, $otono2011) or die(mysql_error());
		
//para cargar fotos ************************************************************************************
	include('SimpleImage.php');//'libreria' para cargar fotos
//PICTURE
	$IMAGE_FILE = $_FILES['picture']['tmp_name'];
	$IMAGE_FILE_NAME = $_FILES['picture']['name'];
	if($IMAGE_FILE != NULL)
	{
		$photosDir="../imagenes/uploads/community_opinions";		
		$img_filename = str_replace(" ","_",$IMAGE_FILE_NAME);
		$photo = new SimpleImage();
		$photo->load($IMAGE_FILE);
		$photo->save($photosDir."/".$img_filename);
		
		$updateSQL = sprintf("UPDATE community_opinions SET picture=%s WHERE id_opinion=%s",
						   GetSQLValueString($img_filename, "text"),
						   GetSQLValueString($_POST['id_opinion'], "int"));
	
		mysql_select_db($database_otono2011, $otono2011);
		$Result1 = mysql_query($updateSQL, $otono2011) or die(mysql_error());
	}
//THUMBNAILS
	$IMAGE_FILE = $_FILES['thumbnail']['tmp_name'];
	$IMAGE_FILE_NAME = $_FILES['thumbnail']['name'];
	if($IMAGE_FILE != NULL)
	{	
		$photosDir="../imagenes/uploads/community_opinions";
		$thumbnails_Dir = $photosDir . "/thumbnails";
		$img_filename2 = str_replace(" ","_",$IMAGE_FILE_NAME);
		$photo = new SimpleImage();
		$photo->load($IMAGE_FILE);
		$photo->save($thumbnails_Dir."/".$img_filename2);
		
		$updateSQL = sprintf("UPDATE community_opinions SET thumbnail=%s WHERE id_opinion=%s",
						   GetSQLValueString($img_filename2, "text"),
						   GetSQLValueString($_POST['id_opinion'], "int"));
	
		mysql_select_db($database_otono2011, $otono2011);
		$Result1 = mysql_query($updateSQL, $otono2011) or die(mysql_error());
	
	}
//para cargar fotos ************************************************************************************	
		
	$insertGoTo = "admin_opinions.php";
	if (isset($_SERVER['QUERY_STRING'])) {
		$insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
		$insertGoTo .= $_SERVER['QUERY_STRING'];
	}
	header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/temp_admin.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO 8859-1"
        />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Educación Continua / Administrador</title>
<style type="text/css">
<!--
.contenido {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color:#999;
	padding-left:5px;
}
.titulo_interno{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	color:#006;
	text-decoration: underline;
}

-->
</style>
<link rel="stylesheet" href="tigra_calendar/calendar.css" type="text/css">
<script language="JavaScript" src="tigra_calendar/calendar_db.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<!-- TinyMCE -->
<script language="javascript" type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "advanced",
		plugins : "media,searchreplace,contextmenu,paste",
		theme_advanced_buttons1_add : "fontselect,fontsizeselect",
		theme_advanced_buttons2_add : "separator,forecolor,backcolor",
		theme_advanced_buttons2_add_before: "cut,copy,paste,separator,search,replace,separator",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		content_css : "example_word.css",
	    plugi2n_insertdate_dateFormat : "%Y-%m-%d",
	    plugi2n_insertdate_timeFormat : "%H:%M:%S",
		external_link_list_url : "example_link_list.js",
		external_image_list_url : "example_image_list.js",
		media_external_list_url : "example_media_list.js",
		file_browser_callback : "fileBrowserCallBack",
		paste_use_dialog : false,
		theme_advanced_resizing : true,
		theme_advanced_resize_horizontal : false,
		theme_advanced_link_targets : "_something=My somthing;_something2=My somthing2;_something3=My somthing3;",
		paste_auto_cleanup_on_paste : true,
		paste_convert_headers_to_strong : false,
		paste_strip_class_attributes : "all",
		paste_remove_spans : false,
		paste_remove_styles : false		
	});

	function fileBrowserCallBack(field_name, url, type, win) {
		// This is where you insert your custom filebrowser logic
		alert("Filebrowser callback: field_name: " + field_name + ", url: " + url + ", type: " + type);

		// Insert new URL, this would normaly be done in a popup
		win.document.forms[0].elements[field_name].value = "someurl.htm";
	}
</script>
<!-- /TinyMCE -->
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
        <table width="100%" border="0">
          <tr>
            <td width="43%" align="center">&nbsp;</td>
            <td width="49%" class="titulo_interno">Actualizar opiniones</td>
            <td width="8%" align="center">&nbsp;</td>
            </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td align="center">&nbsp;</td>
            </tr>
        </table>
            <form action="update_opinion.php" method="post" name="form1" id="form1" enctype="multipart/form-data">
              <table align="center">
                <tr valign="baseline">
                  <td width="100" align="left" nowrap="nowrap">Fecha:</td>
                  <td width="389">
                  <input type="text" name="date" id="date" size="10" value="<?php echo $row_opinions['date']; ?>" />
					<script language="JavaScript">
                        new tcal ({
                            // form name
                            'formname': 'form1',
                                    // input name
                            'controlname': 'date'
                        });
                    </script></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap="nowrap" align="right">&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr valign="baseline">
                  <td nowrap="nowrap" align="left">Nombre corto:</td>
                  <td><input type="text" name="short_name" value="<?php echo $row_opinions['short_name']; ?>" size="32" /></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap="nowrap" align="right">&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr valign="baseline">
                  <td nowrap="nowrap" align="left">Nombre completo:</td>
                  <td><input type="text" name="full_name" value="<?php echo $row_opinions['full_name']; ?>" size="32" /></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap="nowrap" align="right">&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr valign="baseline">
                  <td nowrap="nowrap" align="left">Edad</td>
                  <td><input type="text" name="age" value="<?php echo $row_opinions['age']; ?>" size="4" /></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap="nowrap" align="right">&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr valign="baseline">
                  <td nowrap="nowrap" align="left">Grado de estudios:</td>
                  <td><input type="text" name="degree" value="<?php echo $row_opinions['degree']; ?>" size="32" /></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap="nowrap" align="right">&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr valign="baseline">
                  <td nowrap="nowrap" align="left">Puesto laboral:</td>
                  <td><input type="text" name="job_position" value="<?php echo $row_opinions['job_position']; ?>" size="32" /></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap="nowrap" align="right">&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr valign="baseline">
                  <td nowrap="nowrap" align="left">Diploma/Curso:</td>
                  <td><input type="text" name="diploma_course" value="<?php echo $row_opinions['diploma_course']; ?>" size="32" /></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap="nowrap" align="right">&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr valign="baseline">
                  <td align="left" valign="top" nowrap="nowrap">Opinion:</td>
                  <td><textarea name="opinion" id="opinion" rows="5" cols="65"><?php echo $row_opinions['opinion']; ?> </textarea></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap="nowrap" align="right">&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr valign="baseline">
                  <td nowrap="nowrap" align="left">Imagen:</td>
                  <td><input type="file" name="picture" value="" size="32" /></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap="nowrap" align="right">
                  	<input type="hidden" name="picture2" id="picture2" value="<?php echo $row_opinions['picture'];?>" />
                  </td>
                  <td><?php echo $row_opinions['picture']; ?></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap="nowrap" align="right">&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr valign="baseline">
                  <td nowrap="nowrap" align="left">Thumbnail:</td>
                  <td><input type="file" name="thumbnail" value="" size="32" /></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap="nowrap" align="right">
                  	<input type="hidden" name="thumbnail2" id="thumbnail2" value="<?php echo $row_medias['thumbnail'];?>" />
                  </td>
                  <td><?php echo $row_opinions['thumbnail']; ?></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap="nowrap" align="right">&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr valign="baseline">
                  <td nowrap="nowrap" align="right">&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr valign="baseline">
                  <td align="right" valign="top" nowrap="nowrap"><input type="button" name="cancel" id="cancel" value="Cancelar" onclick="javascript:history.back(1)" /></td>
                  <td align="center"><input type="submit" value="Actualizar" /></td>
                </tr>
              </table>
              <input type="hidden" name="MM_update" value="form1" />
              <input type="hidden" name="id_opinion" id="id_opinion" value="<?php echo $_GET['id_opinion'];?>" />
            </form>
            <p>&nbsp;</p>
        <!-- InstanceEndEditable --></div>
  <div id="separador" style=" clear:both; height:20px;"></div>
  
</div>
</body>
<!-- InstanceEnd --></html>
