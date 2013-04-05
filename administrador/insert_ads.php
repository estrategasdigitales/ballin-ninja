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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "insert_form")) {
   $insertSQL = sprintf("INSERT INTO ads (`date`, short_desc, content) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['date'], "date"),
                       GetSQLValueString($_POST['short_desc'], "text"),
                       GetSQLValueString($_POST['content'], "text"));
  
  mysql_select_db($database_otono2011, $otono2011);
  $Result1 = mysql_query($insertSQL, $otono2011) or die(mysql_error());
  
  	 $insertGoTo = "admin_ads.php";
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
          </ul>
          <p>&nbsp;</p>
          <h2>Artículos</h2>
          <ul>
            <li><a href="admin_discipline_articles.php?id_discipline=1">Disciplinas</a> </li>
            <li><a href="admin_media_articles.php">La DEC en los Medios</a> </li>
            <li><a href="admin_opinions.php">La Comunidad Ibero Opina</a> </li>
            <li><a href="admin_weekly_articles.php">Artículos semanales</a> </li>
          </ul>
          <p>&nbsp;</p>
        </div>
      </div>
    </div>
  </div>
  <div id="contenedor_irregular_index" style="width:800px;"><!-- InstanceBeginEditable name="contenido" -->
        <table width="100%" border="0">
          <tr>
            <td width="43%" align="center">&nbsp;</td>
            <td width="49%" class="titulo_interno"><strong>Nuevo aviso</strong></td>
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
        <form name="insert_form" action="insert_ads.php" method="post"> 
        <table width="100%" border="0">
          <tr>
            <td width="29%">&nbsp;</td>
            <td width="16%">Fecha:</td>
            <td width="47%">    
            <input type="text" name="date" id="date" size="10" value="<?php echo date('Y-m-d');?>" />
			<script language="JavaScript">
				new tcal ({
					// form name
					'formname': 'insert_form',
							// input name
					'controlname': 'date'
				});
			</script></td>
            <td width="8%">&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>Descripci&oacute;n corta:</td>
            <td><input type="text" name="short_desc" id="short_desc" size="30" /></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>Contenido:</td>
            <td><textarea name="content" id="content" rows="5" cols="50"> </textarea></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><input type="button" name="cancel" id="cancel" value="Cancelar" onclick="javascript:history.back(1)" /></td>
            <td align="center"><input type="submit" name="insert" id="insert" value="Insertar" /></td>
            <td>&nbsp;</td>
          </tr>
        </table>
        <input type="hidden" name="MM_insert" value="insert_form" />
        </form>
        
        <!-- InstanceEndEditable --></div>
  <div id="separador" style=" clear:both; height:20px;"></div>
  
</div>
</body>
<!-- InstanceEnd --></html>
