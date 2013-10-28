<?php require_once('Connections/otono2011.php'); ?>
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE sp_preinscritos_pjf SET fecha_registro=%s, modalidad=%s, a_paterno=%s, a_materno=%s, nombre=%s, genero=%s, fecha_nac=%s, ciudad=%s, estado=%s, rfc=%s, telefono=%s, correo=%s, puesto=%s, num_expediente=%s, organo_adscripcion=%s, recibio_propuesta=%s, nombre_propuesta=%s, cargo_propuesta=%s WHERE id_preinscrito=%s",
                       GetSQLValueString($_POST['fecha_registro'], "date"),
                       GetSQLValueString($_POST['modalidad'], "text"),
                       GetSQLValueString($_POST['a_paterno'], "text"),
                       GetSQLValueString($_POST['a_materno'], "text"),
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['genero'], "text"),
                       GetSQLValueString($_POST['fecha_nac'], "date"),
                       GetSQLValueString($_POST['ciudad'], "text"),
                       GetSQLValueString($_POST['estado'], "text"),
                       GetSQLValueString($_POST['rfc'], "text"),
                       GetSQLValueString($_POST['telefono'], "text"),
                       GetSQLValueString($_POST['correo'], "text"),
                       GetSQLValueString($_POST['puesto'], "text"),
                       GetSQLValueString($_POST['num_expediente'], "double"),
                       GetSQLValueString($_POST['organo_adscripcion'], "text"),
                       GetSQLValueString($_POST['recibio_propuesta'], "text"),
                       GetSQLValueString($_POST['nombre_propuesta'], "text"),
                       GetSQLValueString($_POST['cargo_propuesta'], "text"),
                       GetSQLValueString($_POST['id_preinscrito'], "int"));

  mysql_select_db($database_otono2011, $otono2011);
  $Result1 = mysql_query($updateSQL, $otono2011) or die(mysql_error());

  $updateGoTo = "admin_pjf.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_editar_pjf = "-1";
if (isset($_POST['id_preinscrito'])) {
  $colname_editar_pjf = $_POST['id_preinscrito'];
}
mysql_select_db($database_otono2011, $otono2011);
$query_editar_pjf = sprintf("SELECT * FROM sp_preinscritos_pjf WHERE id_preinscrito = %s", GetSQLValueString($colname_editar_pjf, "int"));
$editar_pjf = mysql_query($query_editar_pjf, $otono2011) or die(mysql_error());
$row_editar_pjf = mysql_fetch_assoc($editar_pjf);
$totalRows_editar_pjf = mysql_num_rows($editar_pjf);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Modalidad:</td>
      <td valign="baseline"><table>
        <tr>
          <td><input type="radio" name="modalidad" value="radiobutton1" <?php if (!(strcmp(htmlentities($row_editar_pjf['modalidad'], ENT_COMPAT, 'utf-8'),"radiobutton1"))) {echo "checked=\"checked\"";} ?> />
            [ Etiqueta ]</td>
        </tr>
        <tr>
          <td><input type="radio" name="modalidad" value="radiobutton2" <?php if (!(strcmp(htmlentities($row_editar_pjf['modalidad'], ENT_COMPAT, 'utf-8'),"radiobutton2"))) {echo "checked=\"checked\"";} ?> />
            [ Etiqueta ]</td>
        </tr>
      </table></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">A Paterno:</td>
      <td><input type="text" name="a_paterno" value="<?php echo htmlentities($row_editar_pjf['a_paterno'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">A Materno:</td>
      <td><input type="text" name="a_materno" value="<?php echo htmlentities($row_editar_pjf['a_materno'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nombre:</td>
      <td><input type="text" name="nombre" value="<?php echo htmlentities($row_editar_pjf['nombre'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Género:</td>
      <td><input type="text" name="genero" value="<?php echo htmlentities($row_editar_pjf['genero'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Fecha Nac:</td>
      <td><input type="text" name="fecha_nac" value="<?php echo htmlentities($row_editar_pjf['fecha_nac'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Ciudad:</td>
      <td><input type="text" name="ciudad" value="<?php echo htmlentities($row_editar_pjf['ciudad'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Estado:</td>
      <td><input type="text" name="estado" value="<?php echo htmlentities($row_editar_pjf['estado'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">RFC:</td>
      <td><input type="text" name="rfc" value="<?php echo htmlentities($row_editar_pjf['rfc'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Teléfono:</td>
      <td><input type="text" name="telefono" value="<?php echo htmlentities($row_editar_pjf['telefono'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Correo:</td>
      <td><input type="text" name="correo" value="<?php echo htmlentities($row_editar_pjf['correo'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Puesto:</td>
      <td><input type="text" name="puesto" value="<?php echo htmlentities($row_editar_pjf['puesto'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Número de expediente:</td>
      <td><input type="text" name="num_expediente" value="<?php echo htmlentities($row_editar_pjf['num_expediente'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Organo de adscripción:</td>
      <td><input type="text" name="organo_adscripcion" value="<?php echo htmlentities($row_editar_pjf['organo_adscripcion'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nombre de quien propuso:</td>
      <td><input type="text" name="nombre_propuesta" value="<?php echo htmlentities($row_editar_pjf['nombre_propuesta'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Cargo de quien propuso:</td>
      <td><input type="text" name="cargo_propuesta" value="<?php echo htmlentities($row_editar_pjf['cargo_propuesta'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Actualizar registro" /></td>
    </tr>
  </table>
  <input type="hidden" name="id_preinscrito" value="<?php echo $row_editar_pjf['id_preinscrito']; ?>" />
  <input type="hidden" name="fecha_registro" value="<?php echo htmlentities($row_editar_pjf['fecha_registro'], ENT_COMPAT, 'utf-8'); ?>" />
  <input type="hidden" name="recibio_propuesta" value="<?php echo htmlentities($row_editar_pjf['recibio_propuesta'], ENT_COMPAT, 'utf-8'); ?>" />
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_preinscrito" value="<?php echo $row_editar_pjf['id_preinscrito']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($editar_pjf);
?>
