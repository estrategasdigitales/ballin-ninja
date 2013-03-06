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

//$id_preinscrito = isset($_POST['id_preinscrito']) ? $_POST['id_preinscrito'] : 9;
$id_preinscrito = $_GET['id_preinscrito'];

$cambio_html = array("á" => "&aacute;", "é" => "&eacute;", "í" => "&iacute;");

mysql_select_db($database_otono2011, $otono2011);
$query_acuse = "SELECT * FROM sp_preinscritos_pjf WHERE id_preinscrito = ".$id_preinscrito;
//echo $query_notas_armonia.'<br />'.'<br />';
$acuse = mysql_query($query_acuse, $otono2011) or die(mysql_error());
$row_acuse = mysql_fetch_assoc($acuse);
?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Acuse Prerregistro</title>
<link rel="stylesheet" type="text/css" href="./libreria/css/estilos.css" />
</head>

<body>
<div><input type="button" name="imprimir" value="Imprimir" onclick="window.print();" /></div>
<div>
	<table border="1px #888" width="60">
    <tr>
    <td>
	<table>
		<tr>
    		<td colspan="4"><img src="./media/img/imgCabeceraAcusePrerregistro.png" /></td>
    	</tr>
        <tr>
        	<td><span class="textoInformacionDato">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
        	<td colspan="2">
            	<span class="tituloAcuse">ACUSE  DE  PREREGISTRO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FOLIO: 
            	<?php
				if($id_preinscrito < 10){
					echo "000".$id_preinscrito;
				}elseif($id_preinscrito >= 10 && $id_preinscrito < 100){
					echo "00".$id_preinscrito;
				}elseif($id_preinscrito >= 100 && $id_preinscrito < 1000){
					echo "0".$id_preinscrito;
				}else{
					echo $id_preinscrito;
				}
				?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                <?php
                list($fecha, $tiempo) = split(" ", $row_acuse['fecha_registro']);
				list($anio, $mes, $dia) = split("-", $fecha);
				list($hora, $minuto, $segundo) = split(":", $tiempo);
				?>
				<span>Fecha y Hora: <?php 
				//echo $fecha['mday'] < 10 ? "0".$fecha['mday'] : $fecha['mday'];
				echo $dia < 10 ? "0".$dia : $dia;
				echo "/";
				echo $mes < 10 ? "0".$mes : $mes;
				echo "/".$anio." ";
				echo $hora < 10 ? "0".$hora : $hora;
				echo ":";
				echo $minuto < 10 ? "0".$minuto : $minuto;
				echo ":";
				echo $segundo < 10 ? "0".$segundo : $segundo;
				?><!--17/10/2012 15:21:11--></span>
            </td>
            <td><span class="textoInformacionDato">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
        </tr>
        <tr>
        	<td><span class="textoInformacionDato">&nbsp;</span></td>
        	<td colspan="2">
            	<span class="textoImportante">La <span class="textoImportanteResaltado">lista de admitidos</span> se publicar&aacute; en las p&aacute;ginas electr&oacute;nicas del Instituto de la Judicatura Federal (www.ijf.cjf.gob.mx) y de las Reformas Penal, de Juicio de Amparo y Derechos Humanos (www.cjf.gob.mx/reformas), el <span class="textoImportanteResaltado">31 de octubre de 2012</span>.</span>
            </td>
            <td><span class="textoInformacionDato">&nbsp;</span></td>
        </tr>
        <!--tr>
        	<td colspan="4"><span class="textoInformacionDato">&nbsp;</span></td>
        </tr-->
        <tr>
        	<td><span class="textoInformacionDato">&nbsp;</span></td>
        	<td colspan="2">
            	<span class="textoInformacionTitulo">Informaci&oacute;n del Diplomado</span>
            </td>
            <td><span class="textoInformacionDato">&nbsp;</span></td>
        </tr>
        <tr>
        	<td><span class="textoInformacionDato">&nbsp;</span></td>
        	<td>
            	<span class="textoInformacionCaracteristica">Modalidad:</span>
            </td>
            <td>
            	<span class="textoInformacionCaracteristica"><?php
                echo ucfirst($row_acuse['modalidad']);
				?></span>
            </td>
            <td><span class="textoInformacionDato">&nbsp;</span></td>
        </tr>
        <tr>
        	<td><span class="textoInformacionDato">&nbsp;</span></td>
        	<td>
            	<span class="textoInformacionDato">
            	
                </span>
            </td>
            <td>
            	<span class="textoInformacionDato">
            	La modalidad presencial tiene un cupo de 200 personas. En caso de no ser seleccionado para esta modalidad se considerar&aacute; que solicita su inscripci&oacute;n a la modalidad virtual, la cual tiene un cupo de 5000 personas.
                </span>
            </td>
            <td><span class="textoInformacionDato">&nbsp;</span></td>
        </tr>
        <tr>
        	<td colspan="4"></td>
        </tr>
        <tr>
        	<td><span class="textoInformacionDato">&nbsp;</span></td>
        	<td colspan="2">
            	<span class="textoInformacionTitulo">Informaci&oacute;n personal</span>
            </td>
            <td><span class="textoInformacionDato">&nbsp;</span></td>
        </tr>
        <tr>
        	<td><span class="textoInformacionDato">&nbsp;</span></td>
        	<td>
            	<span class="textoInformacionCaracteristica">Apellido paterno:</span>
            </td>
            <td>
            	<span class="textoInformacionDato">
            	<?php
                echo $row_acuse['a_paterno'];//strtr($row_acuse['a_paterno'], $cambio_html);
				?>
                </span>
            </td>
            <td><span class="textoInformacionDato">&nbsp;</span></td>
        </tr>
        <tr>
        	<td><span class="textoInformacionDato">&nbsp;</span></td>
        	<td>
            	<span class="textoInformacionCaracteristica">Apellido materno:</span>
            </td>
            <td>
            	<span class="textoInformacionDato">
            	<?php echo $row_acuse['a_materno']; ?>
                </span>
            </td>
            <td><span class="textoInformacionDato">&nbsp;</span></td>
        </tr>
        <tr>
        	<td><span class="textoInformacionDato">&nbsp;</span></td>
        	<td>
            	<span class="textoInformacionCaracteristica">Nombre:</span>
            </td>
            <td>
            	<span class="textoInformacionDato">
            	<?php echo $row_acuse['nombre']; ?>
                </span>
            </td>
            <td><span class="textoInformacionDato">&nbsp;</span></td>
        </tr>
        <tr>
        	<td><span class="textoInformacionDato">&nbsp;</span></td>
        	<td>
            	<span class="textoInformacionCaracteristica">G&eacute;nero:</span>
            </td>
            <td>
            	<span class="textoInformacionDato">
            	<?php echo $row_acuse['genero']; ?>
                </span>
            </td>
            <td><span class="textoInformacionDato">&nbsp;</span></td>
        </tr>
        <tr>
        	<td><span class="textoInformacionDato">&nbsp;</span></td>
        	<td>
            	<span class="textoInformacionCaracteristica">Fecha de nacimiento:</span>
            </td>
            <td>
            	<span class="textoInformacionDato">
            	<?php echo $row_acuse['fecha_nac']; ?>
                </span>
            </td>
            <td><span class="textoInformacionDato">&nbsp;</span></td>
        </tr>
        <tr>
        	<td><span class="textoInformacionDato">&nbsp;</span></td>
        	<td>
            	<span class="textoInformacionCaracteristica">R.F.C.:</span>
            </td>
            <td>
            	<span class="textoInformacionDato">
            	<?php echo $row_acuse['rfc']; ?>
                </span>
            </td>
            <td><span class="textoInformacionDato">&nbsp;</span></td>
        </tr>
        <tr>
        	<td><span class="textoInformacionDato">&nbsp;</span></td>
        	<td>
            	<span class="textoInformacionCaracteristica">Correo electr&oacute;nico:</span>
            </td>
            <td>
            	<span class="textoInformacionDato">
            	<?php echo $row_acuse['correo']; ?>
                </span>
            </td>
            <td><span class="textoInformacionDato">&nbsp;</span></td>
        </tr>
        <tr>
        	<td colspan="4"></td>
        </tr>
        <tr>
        	<td><span class="textoInformacionDato">&nbsp;</span></td>
        	<td colspan="2">
            	<span class="textoInformacionTitulo">Informaci&oacute;n laboral</span>
            </td>
            <td><span class="textoInformacionDato">&nbsp;</span></td>
        </tr>
        <tr>
        	<td><span class="textoInformacionDato">&nbsp;</span></td>
        	<td>
            	<span class="textoInformacionCaracteristica">N&uacute;mero de expediente:</span>
            </td>
            <td>
            	<span class="textoInformacionDato">
            	<?php echo $row_acuse['num_expediente']; ?>
                </span>
            </td>
            <td><span class="textoInformacionDato">&nbsp;</span></td>
        </tr>
        <tr>
        	<td><span class="textoInformacionDato">&nbsp;</span></td>
        	<td>
            	<span class="textoInformacionCaracteristica">&Oacute;rgano jurisdiccional o Unidad administrativa de adscripci&oacute;n:</span>
            </td>
            <td>
            	<span class="textoInformacionDato">
            	<?php echo $row_acuse['organo_adscripcion']; ?>
                </span>
            </td>
            <td><span class="textoInformacionDato">&nbsp;</span></td>
        </tr>
        <tr>
        	<td><span class="textoInformacionDato">&nbsp;</span></td>
        	<td>
            	<span class="textoInformacionCaracteristica">Cargo:</span>
            </td>
            <td>
            	<span class="textoInformacionDato">
            	<?php echo $row_acuse['puesto']; ?>
                </span>
            </td>
            <td><span class="textoInformacionDato">&nbsp;</span></td>
        </tr>
        <tr>
        	<td colspan="4"></td>
        </tr>
        <tr>
        	<td><span class="textoInformacionDato">&nbsp;</span></td>
        	<td colspan="2">
            	<span class="textoInformacionTitulo">Residencia</span>
            </td>
            <td><span class="textoInformacionDato">&nbsp;</span></td>
        </tr>
        <tr>
        	<td><span class="textoInformacionDato">&nbsp;</span></td>
        	<td>
            	<span class="textoInformacionCaracteristica">Estado de residencia:</span>
            </td>
            <td>
            	<span class="textoInformacionDato">
            	<?php echo $row_acuse['estado']; ?>
                </span>
            </td>
            <td><span class="textoInformacionDato">&nbsp;</span></td>
        </tr>
        <tr>
        	<td><span class="textoInformacionDato">&nbsp;</span></td>
        	<td>
            	<span class="textoInformacionCaracteristica">Ciudad de residencia:</span>
            </td>
            <td>
            	<span class="textoInformacionDato">
            	<?php echo $row_acuse['ciudad']; ?>
                </span>
            </td>
            <td><span class="textoInformacionDato">&nbsp;</span></td>
        </tr>
	</table>
    </td>
    </tr>
    </table>
</div>
</body>
</html>
<?php
mysql_free_result($acuse);
?>