<?php
session_start();

if(isset($_SESSION['sesion'])){
  $sesion = 1;
}else{
  $sesion = 0;
  header("Location:index.php");
}
if($_SERVER['PHP_SELF'] == "admin_carrusel_home.php"){

header("Location:admin_carrusel_home.php");

}

if($_GET['logout']){
session_unset();
session_destroy();

header("Location:index.php");

}

require_once('../../Connections/otono2011.php');

  if(isset($_POST['submitted'])){

    $id=$_POST['id'];
    $titulo = htmlentities( $_POST['titulo']);
    $texto = htmlentities($_POST['texto']); 
    $destino = htmlentities($_POST['destino']); 
    $orden = htmlentities($_POST['orden']); 
    $visible= $_POST['visible'];

    
    //$imagen_principal = $_POST['imagen_principal'];
      
    mysql_select_db($database_otono2011, $otono2011);
    $query = 'UPDATE carrusel_index SET titulo="'.$titulo.'", texto="'.$texto.'", destino="'.$destino.'", orden="'.$orden.'", visible="'.$visible.'" WHERE id_carrusel_index="'.$id.'"'; 
    $result = mysql_query($query, $otono2011) or die(mysql_error());
    
      if($result){
        header("Location:admin_carrusel_home.php");

      } 

  }else{



      $id=$_POST['id'];
      mysql_select_db($database_otono2011, $otono2011);
      $postImagenes2 = sprintf("SELECT * FROM carrusel_index WHERE id_carrusel_index='$id'");
      $result_post2 = mysql_query($postImagenes2, $otono2011) or die(mysql_error());
      $row2=mysql_fetch_array($result_post2);

      $titulo=$row2["titulo"];
      $texto=$row2["texto"];
      $destino=$row2["destino"];
      $orden=$row2["orden"];
      $imagen=$row2["imagen_carrusel"];
      $orden=$row2["orden"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../../css/estilos.css" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
<title>Administrador Carrusel - Editar</title>
</head>

<body>
<form action="editar.php?id=<?php echo $id; ?>" onsubmit="return checkFields();" method="post" name="form1" id="form1" enctype="multipart/form-data">
<table align="center" width="70%">
    <tr>
      <td align="right">
          <a href="logout.php"><FONT COLOR="red"><b>Cerrar Sesion</b></font></a>
      </td>
    </tr>
  </table>
<table border="1" align="center" width="70%" bgcolor="#E6E6E6">
  <tr><td><br>
  <table border="0" align="center" cellpadding="5" cellspacing="0" width="40%">
       <tr class="titulo_tabla">
            <td colspan="3" align="center" class="titulo_interno"><strong>Editar</strong></td>
       </tr>
       <tr>
        <td colspan="2" align="center">
        <img src="../../imagenes/carrusel/<?php echo $imagen; ?>" width="80%"/>
       </td>
       </tr>
       <tr>
          <td width="25%">Cambiar imagen:</td>
          <td><input type="file" name="imagen" value="<?php echo $imagen; ?>"></td>
       </tr>
        <tr>
          <td width="25%">T&iacute;tulo:</td>
          <td><input type="text" name="titulo" maxlength="60" size="80" value="<?php echo $titulo; ?>"/></td>
        </tr>
        <tr>
          <td colspan="2" align="center">M&aacute;ximo 60 Caracteres</td>
       </tr>
       <tr>
          <td width="25%">Texto:</td>
          <td><input type="text" name="texto" maxlength="140" size="80" value="<?php echo $texto; ?>"/></td>
              <!--input type="text" name="destino" size="60" placeholder="Ej: http://www.diplomados.uia.mx/programas.php?id_discipline=4&id_program=392"/--></td>
            </tr>
            <tr>
              <td colspan="2" align="center">M&aacute;ximo 140 Caracteres</td>
       </tr>
       <tr>
         <td width="25%">Destino:</td>
         <td><input type="text" name="destino" size="80" value="<?php echo $destino; ?>"/></td>
       </tr>
       <tr>
         <td width="25%">Orden en el Carrusel:</td>
         <td><span><?php echo $orden; ?></span></td>
       </tr>
       <tr>
        <td width="25%">Visible</td>
          <td>
                <select name="visible" id="visible">
                   <option value="NO">NO</option>
                   <option value="SI">SI</option>
                </select>
          </td>
        </tr>
       <tr>
          <td colspan="3">&nbsp;</td>
       </tr>
       <tr> 
          <td colspan="2" align="center"><input type="button" value="Regresar" onclick="javascript:window.location='admin_carrusel_home.php'" />
          &nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submitted" value="Guardar" /></td>
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
}else{
  header("Location: admin_carrusel_home.php");
}
</script>
<?php
}
?>
</body>
</html>