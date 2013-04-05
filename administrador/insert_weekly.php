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
//Para llenar lista de disciplinas
	mysql_select_db($database_otono2011, $otono2011);
	$query_disciplines = "SELECT * FROM disciplines";
	$disciplines = mysql_query($query_disciplines, $otono2011) or die(mysql_error());
	$row_disciplines = mysql_fetch_assoc($disciplines);

//Para llenar lista de tipos de artículo
	mysql_select_db($database_otono2011, $otono2011);
	$query_tipos = "SELECT * FROM article_types";
	$tipos = mysql_query($query_tipos, $otono2011) or die(mysql_error());
	$row_tipos = mysql_fetch_assoc($tipos);
	
//Para llenar lista de entrevistado
mysql_select_db($database_otono2011, $otono2011);
$query_entrevistado = "SELECT * FROM site_maestros ORDER BY nombre_maestro ASC";
$entrevistado = mysql_query($query_entrevistado, $otono2011) or die(mysql_error());
$row_entrevistado = mysql_fetch_assoc($entrevistado);

//Para llenar lista de programas
mysql_select_db($database_otono2011, $otono2011);
$query_programas = "SELECT * FROM site_programs ORDER BY program_name ASC";
$programas = mysql_query($query_programas, $otono2011) or die(mysql_error());
$row_programas = mysql_fetch_assoc($programas);

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

//para cargar fotos *******************************************************
  include('SimpleImage.php');
  //BIG_PICTURE
   $IMAGE_FILE = $_FILES['big_picture']['tmp_name'];
   $IMAGE_FILE_NAME = $_FILES['big_picture']['name'];
  
  if($IMAGE_FILE != NULL)
  {
  	$photosDir="../imagenes/uploads/weekly_articles";
	
	$thumbnails_Dir = $photosDir . "/big_pictures";
	
	$img_filename = str_replace(" ","_",$IMAGE_FILE_NAME);
	$photo = new SimpleImage();
	$photo->load($IMAGE_FILE);
  
  	$photo->save($thumbnails_Dir."/".$img_filename);
  }
  //PICTURE
  $IMAGE_FILE = $_FILES['picture']['tmp_name'];
  $IMAGE_FILE_NAME = $_FILES['picture']['name'];
  
  if($IMAGE_FILE != NULL)
  {
  	$photosDir="../imagenes/uploads/weekly_articles";
	$img_filename2 = str_replace(" ","_",$IMAGE_FILE_NAME);
	$photo = new SimpleImage();
	$photo->load($IMAGE_FILE);
  
  	$photo->save($photosDir."/".$img_filename2);
  }
  //THUMBNAILS
   $IMAGE_FILE = $_FILES['thumbnail']['tmp_name'];
   $IMAGE_FILE_NAME = $_FILES['thumbnail']['name'];
  
  if($IMAGE_FILE != NULL)
  {
  	$photosDir="../imagenes/uploads/weekly_articles";
	$thumbnails_Dir = $photosDir . "/thumbnails";	
	$img_filename3 = str_replace(" ","_",$IMAGE_FILE_NAME);
	$photo = new SimpleImage();
	$photo->load($IMAGE_FILE);
  
  	$photo->save($thumbnails_Dir."/".$img_filename3);
  }
  //DISCIPLINE SECTION PICTURE
   $IMAGE_FILE = $_FILES['discipline_section_picture']['tmp_name'];
   $IMAGE_FILE_NAME = $_FILES['discipline_section_picture']['name'];
  
  if($IMAGE_FILE != NULL)
  {
  	$photosDir="../imagenes/uploads/weekly_articles";
	
	$thumbnails_Dir = $photosDir . "/discipline_section_pictures";
	
	$img_filename4 = str_replace(" ","_",$IMAGE_FILE_NAME);
	$photo = new SimpleImage();
	$photo->load($IMAGE_FILE);
  
  	$photo->save($thumbnails_Dir."/".$img_filename4);
  }
//para cargar fotos *******************************************************
	
  $insertSQL = sprintf("INSERT INTO weekly_articles (id_article, title, interviewee_name, `date`, content, big_picture, picture, thumbnail, type, diploma_course, id_discipline, discipline_section_picture, newsletter) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_article'], "int"),
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['interviewee_name'], "text"),
                       GetSQLValueString($_POST['date'], "date"),
                       GetSQLValueString($_POST['content'], "text"),
                       GetSQLValueString($img_filename, "text"),
                       GetSQLValueString($img_filename2, "text"),
                       GetSQLValueString($img_filename3, "text"),
                       GetSQLValueString($_POST['type'], "int"),
                       GetSQLValueString($_POST['diploma_course'], "int"),
                       GetSQLValueString($_POST['id_discipline'], "int"),
					   GetSQLValueString($img_filename4, "text"),
					   GetSQLValueString($_POST['newsletter'], "int"));

  mysql_select_db($database_otono2011, $otono2011);
  $Result1 = mysql_query($insertSQL, $otono2011) or die(mysql_error());

  $insertGoTo = "admin_weekly_articles.php";
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
<script type="text/javascript"> 
<!-- 
function block(frm)
{
	switch(frm["type"].value)
	{
		case "0":
			frm["id_discipline"].disabled = true;
			//frm["diploma_course"].disabled = true;
			frm["discipline_section_picture"].disabled = true;
			break;
		case "1":
			frm["id_discipline"].disabled = true;
			//frm["diploma_course"].disabled = true;
			frm["discipline_section_picture"].disabled = true;
			break;
		case "2":
			frm["id_discipline"].disabled = true;
			//frm["diploma_course"].disabled = false;
			frm["discipline_section_picture"].disabled = true;
			break;
		case "3":
			frm["id_discipline"].disabled = false;
			//frm["diploma_course"].disabled = true;
			frm["discipline_section_picture"].disabled = false;
			break;
	}
}
// -->
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
            <h1>Nuevo artículo semanal
              </h1>
            <form action="insert_weekly.php" method="post" name="form1" id="form1" enctype="multipart/form-data">
              <table width="578" border="0" align="left" cellpadding="5" cellspacing="0">
                <tr valign="baseline">
                  <td align="right" nowrap="nowrap"><strong>Fecha:</strong></td>
                  <td><input type="text" name="date" id="date" size="10" value="<?php echo date('Y-m-d');?>" />
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
                  <td align="right" nowrap="nowrap"><strong>El art&iacute;culo pertenece a: </strong></td>
                  <td>
                  	<select name="type" id="type" onchange="block(this.form);">
                        <?php do{?>
                        <option value="<?php echo $row_tipos['id_type'];?>"><?php echo $row_tipos['type'];?></option>
                        <?php } while($row_tipos = mysql_fetch_assoc($tipos));?>
	                </select>
                  </td>
                </tr>
                <tr valign="baseline">
                  <td align="right" nowrap="nowrap"><strong>Nombre de la disciplina:</strong></td>
                  <td><select name="id_discipline" id="id_discipline" disabled="disabled">
                        <option value="0"> Selecciona una disciplina... </option>
                        <?php do{?>
                        <option value="<?php echo $row_disciplines['id_discipline'];?>"><?php echo $row_disciplines['discipline'];?></option>
                        <?php } while($row_disciplines = mysql_fetch_assoc($disciplines));?>
	                  </select>
                  </td>
                </tr>
                <tr valign="baseline">
                  <td width="182" align="right" nowrap="nowrap"><strong>Titulo:</strong></td>
                  <td width="384"><input type="text" name="title" value="" size="60" /></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap="nowrap" align="right"><strong>Nombre del entrevistado:</strong></td>
                  <td>
                  	<select name="interviewee_name" id="interviewee_name">
                  		<option value="0"> Selecciona un entrevistado... </option>
                  		<?php do{?>
                  		<option value="<?php echo $row_entrevistado['nombre_maestro'];?>"><?php echo $row_entrevistado['nombre_maestro'];?></option>
                  		<?php } while($row_entrevistado = mysql_fetch_assoc($entrevistado));?>
                  		</select></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap="nowrap" align="right"><strong>Diplomado / Curso:</strong></td>
                  <td>
                  	<select name="diploma_course" id="diploma_course">
                  		<option value="0"> Selecciona un programa... </option>
                  		<?php do{?>
                  		<option value="<?php echo $row_programas['program_name'];?>"><?php echo $row_programas['program_name'];?></option>
                  		<?php } while($row_programas = mysql_fetch_assoc($programas));?>
                  		</select></td>
                </tr>
                <tr valign="baseline">
                  <td align="right" valign="top" nowrap="nowrap"><strong>Contenido:</strong></td>
                  <td><textarea name="content" id="content" rows="5" cols="60"> </textarea></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap="nowrap" align="right"><strong>Imagen / pagina principal:</strong></td>
                  <td><input type="file" name="big_picture" id="big_picture" size="50" /></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap="nowrap" align="right"><strong>Imagen / ver detalle:</strong></td>
                  <td><input type="file" name="picture" id="picture" size="50" /></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap="nowrap" align="right"><strong>Imagen / ver todos:</strong></td>
                  <td><input type="file" name="thumbnail" id="thumbnail" size="50" /></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap="nowrap" align="right"><strong>Imagen / seccion disciplina:</strong></td>
                  <td><input type="file" name="discipline_section_picture" id="discipline_section_picture" size="50" disabled="disabled" /></td>
                </tr>
                <tr valign="baseline">
                	<td align="right" nowrap="nowrap"><strong>Newsletter:</strong></td>
                	<td><input name="newsletter" type="checkbox" id="newsletter" value="1" />
                		<label for="newsletter"></label></td>
                	</tr>
                <tr valign="baseline">
                  <td nowrap="nowrap" align="right">&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr valign="baseline">
                  <td nowrap="nowrap" align="right"><strong>
                  <input type="button" name="cancel" id="cancel" value="Cancelar" onclick="javascript:history.back(1)" />
                  </strong></td>
                  <td align="center"><input type="submit" value="Insertar" /></td>
                </tr>
              </table>
              <input type="hidden" name="MM_insert" value="form1" />
            </form>
            <p>&nbsp;</p>
        <!-- InstanceEndEditable --></div>
  <div id="separador" style=" clear:both; height:20px;"></div>
  
</div>
</body>
<!-- InstanceEnd --></html>
