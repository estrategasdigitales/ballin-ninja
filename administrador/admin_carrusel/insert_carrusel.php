<?php 
require_once('../../Connections/otono2011.php');

$query_orden = mysql_query("SELECT MAX(orden+1) AS maximo_orden FROM carrusel_index");
$row_query = mysql_fetch_assoc($query_orden);

if((isset($_POST['MM_insert'])) && ($_POST['MM_insert'] == 'form1')){

  include('SimpleImage.php');

  $IMAGE_FILE = $_FILES['imagen']['tmp_name'];
  $IMAGE_FILE_NAME = $_FILES['imagen']['name'];
  
  if($IMAGE_FILE != NULL)
  {
  	$photosDir="../../imagenes/carrusel";
	$img_filename = str_replace(" ","_",$IMAGE_FILE_NAME);
	$photo = new SimpleImage();
	$photo->load($IMAGE_FILE);
  	$photo->save($photosDir."/".$img_filename);
  }


  $insertSQL = sprintf("INSERT INTO carrusel_index(imagen_carrusel, titulo, texto, destino, orden, visible) VALUES ('%s', '%s', '%s', '%s', '%s', '%s')",
                      mysql_real_escape_string($img_filename),
                      mysql_real_escape_string(utf8_decode($_POST['titulo'])),
                      mysql_real_escape_string(utf8_decode($_POST['texto'])),
                      mysql_real_escape_string($_POST['destino']),
                      mysql_real_escape_string($_POST['orden']),
                      mysql_real_escape_string($_POST['visible']));

  mysql_select_db($database_otono2011, $otono2011);
  $Result1 = mysql_query($insertSQL, $otono2011) or die(mysql_error());

  header('Location: admin_carrusel_home.php');
  echo "entro";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../../css/estilos.css" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
<title>Administrador Carrusel - Nueva Imagen</title>
</head>

<body>

<form action="insert_carrusel.php" onsubmit="return checkFields();" method="post" name="form1" id="form1" enctype="multipart/form-data">
<table align="center" width="70%">
    <tr>
      <td align="right">
          <a href="logout.php"><FONT COLOR="red"><b>Cerrar Sesion</b></font></a>
      </td>
    </tr>
  </table>
<table border="1" bgcolor="#E6E6E6" align="center" width="70%">
  <tr><td><br>
  <table border="0" align="center" cellpadding="5" cellspacing="0" width="40%">
       <tr>
            <td colspan="3" align="center" class="titulo_interno"><strong>Nueva Imagen Carrusel Home</strong></td>
       </tr>
       <tr>
      		 <td width="25%">* Imagen:</td>
             <td><input type="file" name="imagen" id="imagen" /></td>
       </tr>
        <tr>
       		<td width="25%">* T&iacute;tulo:</td>
            <td><input type="text" name="titulo" size="80" maxlength="60" placeholder="Maximo 60 Caracteres"/></td>
       </tr>
       <tr>
       		<td width="25%">* Texto:</td>
            <td><input type="text" name="texto" size="80" maxlength="140" placeholder="Maximo 140 Caracteres"></textarea>
            	<!--input type="text" name="destino" size="60" placeholder="Ej: http://www.diplomados.uia.mx/programas.php?id_discipline=4&id_program=392"/--></td>
       </tr>
       <tr>
       		<td width="25%">* Destino:</td>
            <td><input type="text" name="destino" size="80" placeholder="Ej: http://www.diplomados.uia.mx/programas.php?id_discipline=4&id_program=392"/></td>
            <input type="hidden" name="orden" value="<?php echo $row_query['maximo_orden']; ?>">
            <input type="hidden" name="visible" value="NO">
       </tr>
     
       <tr>	
       		<td colspan="2" align="center"><input type="button" value="Regresar" onclick="javascript:window.location='admin_carrusel_home.php'" />&nbsp;&nbsp;&nbsp;
       		<input type="submit" value="Insertar" /></td>
       </tr>
    </table>
    <br>
  </td></tr>
</table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>

<script>
function checkFields(){

	
if($('input#imagen').val() == ""){
	alert('El campo imagen es obligatorio')
	return false
	}
else if($('input[name="destino"]').val() == ""){
	alert('El campo destino es obligatorio')
	return false
	}
	return true
}
</script>
</body>
</html>