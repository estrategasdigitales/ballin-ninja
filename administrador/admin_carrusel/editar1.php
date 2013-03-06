<?php 
require_once('../../Connections/otono2011.php');

if(isset($_POST['submitted'])){
  $id=$_GET['id'];
  $titulo = htmlentities( $_POST['titulo']);
  $texto = htmlentities($_POST['texto']); 
  $destino = htmlentities($_POST['destino']); 
  $orden = htmlentities($_POST['orden']); 

  
  //$imagen_principal = $_POST['imagen_principal'];
    
  mysql_select_db($database_otono2011, $otono2011);
  $query = 'UPDATE carrusel_index SET titulo="'.$titulo.'", texto="'.$texto.'", destino="'.$destino.'", orden="'.$orden.'" WHERE id_carrusel_index="'.$id.'"'; 
  $result = mysql_query($query, $otono2011) or die(mysql_error());
  
  if($result){
    header("Location:admin_carrusel_home.php");

  } }else{



    $id=$_GET['id'];
    mysql_select_db($database_otono2011, $otono2011);
    $postImagenes2 = sprintf("SELECT * FROM carrusel_index WHERE id_carrusel_index='$id'");
    $result_post2 = mysql_query($postImagenes2, $otono2011) or die(mysql_error());
    $row2=mysql_fetch_array($result_post2);

    $titulo=$row2["titulo"];
    $texto=$row2["texto"];
    $destino=$row2["destino"];
    $orden=$row2["orden"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
<title>Documento sin título</title>
</head>

<body>
<form action="editar1.php?id=<?php echo $id; ?>" onsubmit="return checkFields();" method="post" name="form1" id="form1" enctype="multipart/form-data">
<table border="0" align="center" cellpadding="5" cellspacing="0">
       <tr>
            <td colspan="3" align="center" class="titulo_interno"><strong>Nueva Imagen Carrusel Home</strong></td>
       </tr>
       
        <tr>
          <td>* T&iacute;tulo:</td>
            <td><input type="text" name="titulo" size="60" value="<?php echo $titulo; ?>"/></td>
       </tr>
       <tr>
          <td>* Texto:</td>
            <td><textarea name="texto" cols="46" rows="10"><?php echo $texto; ?></textarea>
              <!--input type="text" name="destino" size="60" placeholder="Ej: http://www.diplomados.uia.mx/programas.php?id_discipline=4&id_program=392"/--></td>
       </tr>
       <tr>
          <td>* Destino:</td>
            <td><input type="text" name="destino" size="60" value="<?php echo $destino; ?>"/></td>
       </tr>
       <tr>
          <td colspan="3">&nbsp;</td>
       </tr>
       <tr> <td></td>
          <td><input type="button" value="Cancelar" onclick="javascript:window.location='admin_carrusel_home.php'" /></td>
          <td><input type="submit" name="submitted" value="Insertar" /></td>
       </tr>
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
}else{
  header("Location: admin_carrusel_home.php");
}
</script>
<?php
}
?>
</body>
</html>