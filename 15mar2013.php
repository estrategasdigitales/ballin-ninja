<?php //require_once('Connections/dec_news.php'); ?>
<?php
/*if (!function_exists("GetSQLValueString")) {
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
*/
/*mysql_select_db($database_dec_news, $dec_news);
$query_communitu_op = "SELECT * FROM community_opinions ORDER BY `date` DESC";
$communitu_op = mysql_query($query_communitu_op, $dec_news) or die(mysql_error());
$row_communitu_op = mysql_fetch_assoc($communitu_op);
$totalRows_communitu_op = mysql_num_rows($communitu_op);

mysql_select_db($database_dec_news, $dec_news);
$query_profs_ops = "SELECT * FROM weekly_articles ORDER BY `date` DESC";
$profs_ops = mysql_query($query_profs_ops, $dec_news) or die(mysql_error());
$row_profs_ops = mysql_fetch_assoc($profs_ops);
$totalRows_profs_ops = mysql_num_rows($profs_ops);

//-----OTRAS DISCIPLINAS-----//
$query_oferta_dis = "SELECT id_program, id_discipline, program_name, (SELECT fecha FROM site_fechas_ini WHERE site_fechas_ini.id_program = site_programs.id_program AND fecha >  '2012-10-30' LIMIT 0,1) AS fecha FROM site_programs WHERE id_discipline = 1 OR id_discipline = 2 OR id_discipline = 3 AND cancelado = 0 ORDER BY fecha ASC";
$oferta_dis = mysql_query($query_oferta_dis, $dec_news) or die(mysql_error());
$row_oferta_dis = mysql_fetch_assoc($oferta_dis);
$totalRows_oferta_dis = mysql_num_rows($oferta_dis);

$query_oferta_gastro = "SELECT id_program, id_discipline, program_name, (SELECT fecha FROM site_fechas_ini WHERE site_fechas_ini.id_program = site_programs.id_program AND fecha >  '2012-10-30' LIMIT 0,1) AS fecha FROM site_programs WHERE id_discipline = 11 AND cancelado = 0 ORDER BY fecha ASC";
$oferta_gastro = mysql_query($query_oferta_gastro, $dec_news) or die(mysql_error());
$row_oferta_gastro = mysql_fetch_assoc($oferta_gastro);
$totalRows_oferta_gastro = mysql_num_rows($oferta_gastro);

$query_oferta_online = "SELECT id_program, id_discipline, program_name, (SELECT fecha FROM site_fechas_ini WHERE site_fechas_ini.id_program = site_programs.id_program AND fecha >  '2012-10-30' LIMIT 0,1) AS fecha FROM site_programs WHERE id_discipline = 15 AND cancelado = 0 ORDER BY fecha ASC";
$oferta_online = mysql_query($query_oferta_online, $dec_news) or die(mysql_error());
$row_oferta_online = mysql_fetch_assoc($oferta_online);
$totalRows_oferta_online = mysql_num_rows($oferta_online);

$query_oferta_polit = "SELECT id_program, id_discipline, program_name, (SELECT fecha FROM site_fechas_ini WHERE site_fechas_ini.id_program = site_programs.id_program AND fecha >  '2012-10-30' LIMIT 0,1) AS fecha FROM site_programs WHERE id_discipline = 4 OR id_discipline = 5 OR id_discipline = 6 OR id_discipline = 7 AND cancelado = 0 ORDER BY fecha ASC";
$oferta_polit = mysql_query($query_oferta_polit, $dec_news) or die(mysql_error());
$row_oferta_polit = mysql_fetch_assoc($oferta_polit);
$totalRows_oferta_polit = mysql_num_rows($oferta_polit);

$query_oferta_hum = "SELECT id_program, id_discipline, program_name, (SELECT fecha FROM site_fechas_ini WHERE site_fechas_ini.id_program = site_programs.id_program AND fecha >  '2012-10-30'
 LIMIT 0,1) AS fecha FROM site_programs WHERE id_discipline = 10 AND cancelado = 0 ORDER BY fecha ASC";
$oferta_hum = mysql_query($query_oferta_hum, $dec_news) or die(mysql_error());
$row_oferta_hum = mysql_fetch_assoc($oferta_hum);
$totalRows_oferta_hum = mysql_num_rows($oferta_hum);

$query_oferta_neg = "SELECT id_program, id_discipline, program_name, (

SELECT fecha
FROM site_fechas_ini
WHERE site_fechas_ini.id_program = site_programs.id_program
AND fecha >  '2012-03-14'
LIMIT 0 , 1
) AS fecha
FROM site_programs
WHERE id_discipline =8
OR id_discipline =9
AND cancelado = 0
ORDER BY fecha ASC ";

$oferta_neg = mysql_query($query_oferta_neg, $dec_news) or die(mysql_error());
$row_oferta_neg = mysql_fetch_assoc($oferta_neg);
$totalRows_oferta_neg = mysql_num_rows($oferta_neg);*/
/*
function WordLimiter($text,$limit){
	$explode = explode(' ',$text);
	$string  = '';
	$dots = '...';
	if(count($explode) <= $limit){
		$dots = '';
		}
	for($i=0;$i<$limit;$i++){
		$string .= $explode[$i]." ";
	}
	if ($dots) {
		$string = substr($string, 0, strlen($string));
		}
	return $string.$dots;
}
*/
//CODIGO PARA QUE ASIGNE FORMATO LOCAL A LAS FECHAS
setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
//++++++++++++++++++++
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Bolet&iacute;n de Educaci&oacute;n Continua de la Ibero</title>
</head>

<body>
<table width="680" border="0" cellspacing="0" cellpadding="0" style="background:#FFF;">
  <tr>
    <td><table width="680" border="0" cellspacing="12" cellpadding="0">
        <tr>
          <td align="center" bgcolor="#FFFFCC" style="font-family:Arial, Helvetica, sans-serif; font-size:9px; color:#000;">Si no puedes ver este correo correctamente, haz clic <a href="http://dec-uia.com/newsletter/15mar2013.php" style="color:#F00;">aqu&iacute;</a></td>
        </tr>
        <tr>
          <td align="center" valign="top"><a href="http://www.dec-uia.com/landingHarvard/landing.php?tipo=jSl2QH8Xp8EqWEO" target="_blank"><img src="http://dec-uia.com/newsletter/mages/mailing_harvard_2.jpg" width="600" height="610" border="0" /></a></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>