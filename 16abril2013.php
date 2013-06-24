<?php/* require_once('Connections/dec_news.php'); */?>
<?php/*
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

mysql_select_db($database_dec_news, $dec_news);
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
$query_oferta_dis = "SELECT id_program, id_discipline, program_name, (SELECT fecha FROM site_fechas_ini WHERE site_fechas_ini.id_program = site_programs.id_program AND fecha >  '2013-03-20' LIMIT 0,1) AS fecha FROM site_programs WHERE id_discipline = 1 OR id_discipline = 2 OR id_discipline = 3 AND cancelado = 0 ORDER BY fecha ASC";
$oferta_dis = mysql_query($query_oferta_dis, $dec_news) or die(mysql_error());
$row_oferta_dis = mysql_fetch_assoc($oferta_dis);
$totalRows_oferta_dis = mysql_num_rows($oferta_dis);

$query_oferta_gastro = "SELECT id_program, id_discipline, program_name, (SELECT fecha FROM site_fechas_ini WHERE site_fechas_ini.id_program = site_programs.id_program AND fecha >  '2013-03-20' LIMIT 0,1) AS fecha FROM site_programs WHERE id_discipline = 11 AND cancelado = 0 ORDER BY fecha ASC";
$oferta_gastro = mysql_query($query_oferta_gastro, $dec_news) or die(mysql_error());
$row_oferta_gastro = mysql_fetch_assoc($oferta_gastro);
$totalRows_oferta_gastro = mysql_num_rows($oferta_gastro);

$query_oferta_online = "SELECT id_program, id_discipline, program_name, (SELECT fecha FROM site_fechas_ini WHERE site_fechas_ini.id_program = site_programs.id_program AND fecha >  '2013-03-20' LIMIT 0,1) AS fecha FROM site_programs WHERE id_discipline = 15 AND cancelado = 0 ORDER BY fecha ASC";
$oferta_online = mysql_query($query_oferta_online, $dec_news) or die(mysql_error());
$row_oferta_online = mysql_fetch_assoc($oferta_online);
$totalRows_oferta_online = mysql_num_rows($oferta_online);

$query_oferta_polit = "SELECT id_program, id_discipline, program_name, (SELECT fecha FROM site_fechas_ini WHERE site_fechas_ini.id_program = site_programs.id_program AND fecha >  '2013-03-20' LIMIT 0,1) AS fecha FROM site_programs WHERE id_discipline = 4 OR id_discipline = 5 OR id_discipline = 6 OR id_discipline = 7 AND cancelado = 0 ORDER BY fecha ASC";
$oferta_polit = mysql_query($query_oferta_polit, $dec_news) or die(mysql_error());
$row_oferta_polit = mysql_fetch_assoc($oferta_polit);
$totalRows_oferta_polit = mysql_num_rows($oferta_polit);

$query_oferta_hum = "SELECT id_program, id_discipline, program_name, (SELECT fecha FROM site_fechas_ini WHERE site_fechas_ini.id_program = site_programs.id_program AND fecha >  '2013-03-20'
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
$totalRows_oferta_neg = mysql_num_rows($oferta_neg);

$sql_idiomas="SELECT * from site_programs INNER JOIN site_fechas_ini ON site_fechas_ini.id_program = site_programs.id_program WHERE id_discipline=14 AND fecha>'2013-04-15' AND fecha < '2013-04-30'order by fecha ASC ";//solo cambiar la fechas que esta en esta consulta
$query_idiomas=mysql_query($sql_idiomas);

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
<table width="680" border="0" cellspacing="0" cellpadding="0" style="border:solid 4px #CCC; background:#FFF;">
  <tr>
    <td><table width="665" border="0" cellspacing="12" cellpadding="0">
        <tr>
          <td width="641" align="center" bgcolor="#FFFFCC" style="font-family:Arial, Helvetica, sans-serif; font-size:9px; color:#000;">Si no puedes ver este correo correctamente, haz clic <a href="http://dec-uia.com/newsletter/16abril2013.php" style="color:#F00;">aqu&iacute;</a></td>
        </tr>
        <tr>
          <td align="center" valign="top"><img src="http://dec-uia.com/newsletter/mages/newsletter_banner_principal.jpg" width="654" height="190" border="0" usemap="#Map" /></td>
        </tr>
        <tr>
          <td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left"><span style="font-family:Arial, Helvetica, sans-serif; font-size:20px; color:#F00; font-style:oblique; margin:0px 0px 0px 0px;">Educaci&oacute;n Continua Ibero, Diplomados y cursos</span></td>
              </tr>
              <tr>
                <td><table width="575" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td align="center"></td>
                    </tr>
                    <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td colspan="2" ><a href="http://www.diplomados.uia.mx/programas.php?id_discipline=14&id_program=177" target="_blank"><img src="http://dec-uia.com/newsletter/mages/baner_ingles.png" alt="" style="margin:15px 0px 0px 0px;" /></a></td>
                          </tr>
                          <tr>
                            <td width="59%" colspan="2" >&nbsp;</td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <? $row_profs_ops = mysql_fetch_assoc($profs_ops); ?>
                          <td colspan="3" align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#666;"></td>
                        </tr>
                        <tr>
                          <td width="21%" height="0" align="left" valign="top"><!--p></p--></td>
                          <td width="4%" height="0"></td>
                          <td width="75%" height="0" align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#666;"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"><span style="color:#666; font-size:24px; font-family:Arial, Helvetica, sans-serif; font-style:italic;">Alumnos</span></td>
                          <td>&nbsp;</td>
                          <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#666; border-bottom:1px solid #666;">&nbsp;</td>
                        </tr>
                        <tr>
                          <td align="left" valign="top">&nbsp;</td>
                          <td>&nbsp;</td>
                          <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#666;">&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="126" align="left" valign="top"><span style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#666; font-style:oblique;"><img src="http://dec-uia.com/newsletter/mages/papel_urbanismo.png" alt="" width="120" height="123" /></span></td>
                          <td width="4%">&nbsp;</td>
                          <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#666;"><span style="font-family:Arial, Helvetica, sans-serif; font-size:20px; color:#F00; font-style:oblique;">El papel del urbanismo y de la ciudadanía en la 
construcción de ciudades seguras</span>
                            <p>El Diplomado "Espacio público y ciudades seguras: planeación, diseño y gestión" ha sido muy enriquecedor, han venido ponentes extranjeros, entre ellos gente de Colombia que nos habló del proyecto implementado en Medellín donde la incidencia delictiva se ha reducido en más de un 50%. Para ello nos platicaron que entraron arquitectos, urbanistas y personas dedicadas a la seguridad y empezaron a  retomar los espacios, sobre todo zonas peligrosas, usando el eslogan <span style="font-style:italic;">Lo mejor para los más pobres</span>.  <a href="http://www.dec-uia.com/otono_2011/community_opinions_detail.php?id_opinion=254" style="color:#F00; text-decoration:none; font-size:12px;" target="_blank">Leer más. </a><br />
<br /> El próximo Diplomado Espacio público y ciudades seguras: planeación, diseño y gestión inicia el 26 de abril.  <a href="http://www.diplomados.uia.mx/programas.php?id_discipline=1&id_program=186" style="color:#F00; text-decoration:none; font-size:12px;" target="_blank">Más información. </a> 
                              <br />
                              <!--<a href="http://www.diplomados.uia.mx/programas.php?id_discipline=23&id_program=387&titulo=Social_Media_Strategies" target="_blank" style="color:#F00; text-decoration:none; font-size:12px;">m&aacute;s info &gt;</a> <br />-->
                              <br />
                              <strong><em>Licenciada en Ciencias Humanas y alumna del diplomado.</em></strong><br />Lorena Ramírez </p></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top">&nbsp;</td>
                          <td width="4%">&nbsp;</td>
                          <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#666;">&nbsp;</td>
                        </tr>
                      </table>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td colspan="3" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="25%"><span style="color:#666; font-size:24px; font-family:Arial, Helvetica, sans-serif; font-style:italic;">Profesores</span></td>
                                <td width="75%" style="border-bottom:1px solid #666;">&nbsp;</td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td width="21%" align="left" valign="top">&nbsp;</td>
                            <td width="4%">&nbsp;</td>
                            <td width="75%" align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#666;">&nbsp;</td>
                          </tr>
                          <tr>
                            <td height="126" align="left" valign="top"><span style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#666; font-style:oblique; line-height:12px;"><img src="http://dec-uia.com/newsletter/mages/arte_bonito.png" alt="" width="120" height="123" /></span></td>
                            <td>&nbsp;</td>
                            <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#666;"><p><span style="font-family:Arial, Helvetica, sans-serif; font-size:20px; color:#F00; font-style:oblique;">El arte no es lo "bonito", va mucho más allá...</span> </p>
                              <p>Hoy en día las experiencias estéticas no necesariamente tienen que ver con lo bello. Sensaciones de asco,  miedo,  desesperación, también  forman parte de este concepto ya que forman parte del cúmulo de sentimientos que habitan a todo ser humano. Aquello definido como  "estético" está en todos los momentos de nuestra vida donde las emociones se hacen presentes, por lo que siempre estamos más cerca de la experiencia artística de lo que pensamos.


<br />
                                <br />
                                Conoce más acerca de los Diplomados <a href=" http://www.diplomados.uia.mx/programas.php?id_discipline=2&id_program=11" target="_blank" style="color:#F00;text-decoration:none;">Estudios de arte </a>y <a href=" http://www.diplomados.uia.mx/programas.php?id_discipline=2&id_program=413" style="color:#F00;text-decoration:none;" target="_blank">Recorrido por el arte mexicano</a>.  <br />
  <!--<a href="http://www.diplomados.uia.mx/programas.php?id_discipline=9&id_program=423&titulo=Sistemas_de_gesti%F3n_con_base_en_ISO_9000" target="_blank" style="color:#F00; text-decoration:none; font-size:12px;">m&aacute;s info &gt;</a><br />-->
  <em><br />
  </em><strong><em>Coordinadora Diplomados de Arte</em></strong><br />
                           Mtra. Cristina García</p></td>
                          </tr>
                          <tr>
                            <td align="left" valign="top">&nbsp;</td>
                            <td>&nbsp;</td>
                            <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#666;">&nbsp;</td>
                          </tr>
                          <tr>
                            <td height="126" align="left" valign="top"><span style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#666; font-style:oblique;"><img src="http://dec-uia.com/newsletter/mages/sommelier.png" alt="" width="120" height="123" /></span></td>
                            <td>&nbsp;</td>
                            <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#666;"><span style="font-family:Arial, Helvetica, sans-serif; font-size:20px; color:#F00; font-style:oblique;">Palabra de Sommelier: Secretos detrás de un descorche</span>
                              <p>“Para saber de vino, sólo bebiendo” – afirma el sommelier Fermín Gómez, expositor del <a href="http://www.diplomados.uia.mx/programas.php?id_discipline=11&id_program=446" target="_blank" style="color:#F00;text-decoration:none;">Curso Vino, aromas y sabores</a>, quien durante una cata nos platicaba que los sabores y aromas son tan personales que no hay recetas ni fórmulas para explicarlos, simplemente se perciben. Basta con servir una copa de vino blanco Viogner entre un grupo de personas, para que las opiniones varíen entre el aroma a cítrico, kiwi, piña o maracuyá, ¿y quién tiene la razón? Todos definitivamente. <a href="http://www.dec-uia.com/otono_2011/articulos2.php?id_discipline=11&id_article=287" target="_blank" style="color:#F00; text-decoration:none; font-size:12px;"> Leer  más.</a><br />
                               
  <em><br />
  </em><strong><em>Expositor del Curso Vino, aromas y sabores</em></strong><br />Sommelier Fermín Gómez.</p></td>
                          </tr>
                          <tr>
                            <td height="18" align="left" valign="top">&nbsp;</td>
                            <td>&nbsp;</td>
                            <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#666;">&nbsp;</td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center"><img src="http://www.dec-uia.com/newsletter/mages/prox_programas.jpg" width="651" height="47" /></td>
              </tr>
              <tr>
                <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td><table width="90%" border="0" align="center" cellpadding="5" cellspacing="0">
                          <tr>
                            <td width="29%"><img src="http://www.dec-uia.com/newsletter/mages/headers_colores/header_verde.gif" width="178" height="23" /></td>
                            <td width="6%">&nbsp;</td>
                            <td width="29%"><img src="http://www.dec-uia.com/newsletter/mages/headers_colores/header_amarillo.gif" width="178" height="23" /></td>
                            <td width="6%">&nbsp;</td>
                            <td width="30%"><img src="http://www.dec-uia.com/newsletter/mages/headers_colores/header_azul.gif" width="178" height="23" /></td>
                          </tr>
                          <tr valign="top">
                            <td align="left"><? do{ 
											$row_oferta_dis = mysql_fetch_assoc($oferta_dis);
										}while($row_oferta_dis['fecha']<'2013-04-16'); ?>
                              <span style="color:#F00; font-family:Arial, Helvetica, sans-serif; font-size:12px;"><strong><a style="color:#F00; text-decoration:none;" href="http://www.diplomados.uia.mx/programas.php?id_discipline=<?php echo $row_oferta_dis['id_discipline']; ?>&amp;id_program=<?php echo $row_oferta_dis['id_program']; ?>"><?php echo $row_oferta_dis['program_name']; ?></a></strong></span><span style="color:#666; font-family:Arial, Helvetica, sans-serif; font-size:12px;"><br />
                              Inicio: <?php echo strftime("%d de %B de %Y", strtotime($row_oferta_dis['fecha'])); ?></span>
                              <? $row_oferta_dis = mysql_fetch_assoc($oferta_dis); ?>
                              <p><span style="color:#F00; font-family:Arial, Helvetica, sans-serif; font-size:12px;"><strong> <a style="color:#F00; text-decoration:none;" href="http://www.diplomados.uia.mx/programas.php?id_discipline=<?php echo $row_oferta_dis['id_discipline']; ?>&amp;id_program=<?php echo $row_oferta_dis['id_program']; ?>"> <?php echo $row_oferta_dis['program_name']; ?></a></strong></span><span style="color:#666; font-family:Arial, Helvetica, sans-serif; font-size:12px;"><br />
                                Inicio: <?php echo strftime("%d de %B de %Y", strtotime($row_oferta_dis['fecha'])); ?></span></p></td>
                            <td align="left">&nbsp;</td>
                            <td align="left"><? do{ 
											$row_oferta_gastro = mysql_fetch_assoc($oferta_gastro);
										}while($row_oferta_gastro['fecha']<'2013-04-16'); ?>
                              <span style="color:#F00; font-family:Arial, Helvetica, sans-serif; font-size:12px;"><strong><a style="color:#F00; text-decoration:none;" href="http://www.diplomados.uia.mx/programas.php?id_discipline=<?php echo $row_oferta_gastro['id_discipline']; ?>&amp;id_program=<?php echo $row_oferta_gastro['id_program']; ?>"><?php echo $row_oferta_gastro['program_name']; ?></a></strong></span><span style="color:#666; font-family:Arial, Helvetica, sans-serif; font-size:12px;"><br />
                              Inicio: <?php echo strftime("%d de %B de %Y", strtotime($row_oferta_gastro['fecha'])); ?></span>
                              <p><span style="color:#F00; font-family:Arial, Helvetica, sans-serif; font-size:12px;"><strong>
                                <? $row_oferta_gastro = mysql_fetch_assoc($oferta_gastro); ?>
                                <a style="color:#F00; text-decoration:none;" href="http://www.diplomados.uia.mx/programas.php?id_discipline=<?php echo $row_oferta_gastro['id_discipline']; ?>&amp;id_program=<?php echo $row_oferta_gastro['id_program']; ?>"> <?php echo $row_oferta_gastro['program_name']; ?></a></strong></span><span style="color:#666; font-family:Arial, Helvetica, sans-serif; font-size:12px;"><br />
                                Inicio: <?php echo strftime("%d de %B de %Y", strtotime($row_oferta_gastro['fecha'])); ?></span></p></td>
                            <td align="left">&nbsp;</td>
                            <td align="left"><? do{ 
											$row_oferta_online = mysql_fetch_assoc($oferta_online);
										}while($row_oferta_online['fecha']<'2013-04-16'); ?>
                              <span style="color:#F00; font-family:Arial, Helvetica, sans-serif; font-size:12px;"><strong><a style="color:#F00; text-decoration:none;" href="http://www.diplomados.uia.mx/programas.php?id_discipline=<?php echo $row_oferta_online['id_discipline']; ?>&amp;id_program=<?php echo $row_oferta_online['id_program']; ?>"><?php echo $row_oferta_online['program_name']; ?></a></strong></span><span style="color:#666; font-family:Arial, Helvetica, sans-serif; font-size:12px;"><br />
                              Inicio: <?php echo strftime("%d de %B de %Y", strtotime($row_oferta_online['fecha'])); ?></span>
                              </p>
                              <p>
                                <? do{ 
											$row_oferta_online = mysql_fetch_assoc($oferta_online);
										}while($row_oferta_online['fecha']<'2013-04-15'); ?>
                                </br>
                                <span style="color:#F00; font-family:Arial, Helvetica, sans-serif; font-size:12px;"><strong><a style="color:#F00; text-decoration:none;" href="http://www.diplomados.uia.mx/programas.php?id_discipline=<?php echo $row_oferta_online['id_discipline']; ?>&amp;id_program=<?php echo $row_oferta_online['id_program']; ?>"><?php echo $row_oferta_online['program_name']; ?></a></strong></span><span style="color:#666; font-family:Arial, Helvetica, sans-serif; font-size:12px;"><br />
                                Inicio: <?php echo strftime("%d de %B de %Y", strtotime($row_oferta_online['fecha'])); ?></span></p></td>
                          </tr>
                          <tr valign="top">
                            <td><img src="http://www.dec-uia.com/newsletter/mages/headers_colores/header_gris.gif" width="178" height="23" /></td>
                            <td>&nbsp;</td>
                            <td><img src="http://www.dec-uia.com/newsletter/mages/headers_colores/header_morado.gif" width="178" height="23" /></td>
                            <td>&nbsp;</td>
                            <td><img src="http://www.dec-uia.com/newsletter/mages/headers_colores/header_turquesa.gif" width="178" height="23" /></td>
                          </tr>
                          <tr valign="top">
                            <td align="left"><? do{ 
											$row_oferta_polit = mysql_fetch_assoc($oferta_polit);
										}while($row_oferta_polit['fecha']<'2013-04-16'); ?>
                              <span style="color:#F00; font-family:Arial, Helvetica, sans-serif; font-size:12px;"><strong><a style="color:#F00; text-decoration:none;" href="http://www.diplomados.uia.mx/programas.php?id_discipline=<?php echo $row_oferta_polit['id_discipline']; ?>&amp;id_program=<?php echo $row_oferta_polit['id_program']; ?>"><?php echo $row_oferta_polit['program_name']; ?></a></strong></span><span style="color:#666; font-family:Arial, Helvetica, sans-serif; font-size:12px;"><br />
                              Inicio: <?php echo strftime("%d de %B de %Y", strtotime($row_oferta_polit['fecha'])); ?></span>
                              <p><span style="color:#F00; font-family:Arial, Helvetica, sans-serif; font-size:12px;"><strong>
                                <? $row_oferta_polit = mysql_fetch_assoc($oferta_polit); ?>
                                <a style="color:#F00; text-decoration:none;" href="http://www.diplomados.uia.mx/programas.php?id_discipline=<?php echo $row_oferta_polit['id_discipline']; ?>&amp;id_program=<?php echo $row_oferta_polit['id_program']; ?>"> <?php echo $row_oferta_polit['program_name']; ?></a></strong></span><span style="color:#666; font-family:Arial, Helvetica, sans-serif; font-size:12px;"><br />
                                Inicio: <?php echo strftime("%d de %B de %Y", strtotime($row_oferta_polit['fecha'])); ?></span></p></td>
                            <td align="left">&nbsp;</td>
                            <td align="left"><? do{ 
											$row_oferta_hum = mysql_fetch_assoc($oferta_hum);
										}while($row_oferta_hum['fecha']<'2013-04-16'); ?>
                              <span style="color:#F00; font-family:Arial, Helvetica, sans-serif; font-size:12px;"><strong><a style="color:#F00; text-decoration:none;" href="http://www.diplomados.uia.mx/programas.php?id_discipline=<?php echo $row_oferta_hum['id_discipline']; ?>&amp;id_program=<?php echo $row_oferta_hum['id_program']; ?>"><?php echo $row_oferta_hum['program_name']; ?></a></strong></span><span style="color:#666; font-family:Arial, Helvetica, sans-serif; font-size:12px;"><br />
                              Inicio: <?php echo strftime("%d de %B de %Y", strtotime($row_oferta_hum['fecha'])); ?></span></td>
                            <td align="left">&nbsp;</td>
                            <td align="left"><? do{ 
							
											$row_oferta_neg = mysql_fetch_assoc($oferta_neg);
										}while($row_oferta_neg['fecha']<'2013-04-16'); ?>
                              <span style="color:#F00; font-family:Arial, Helvetica, sans-serif; font-size:12px;"><strong><a style="color:#F00; text-decoration:none;" href="http://www.diplomados.uia.mx/programas.php?id_discipline=<?php echo $row_oferta_neg['id_discipline']; ?>&amp;id_program=<?php echo $row_oferta_neg['id_program']; ?>"><?php echo $row_oferta_neg['program_name']; ?></a></strong></span><span style="color:#666; font-family:Arial, Helvetica, sans-serif; font-size:12px;"><br />
                              Inicio: <?php echo strftime("%d de %B de %Y", strtotime($row_oferta_neg['fecha'])); ?></span>
                              <p>
                                <? do{ 
											$row_oferta_neg = mysql_fetch_assoc($oferta_neg);
										}while($row_oferta_neg['fecha']<'2013-04-16'); ?>
                                <span style="color:#F00; font-family:Arial, Helvetica, sans-serif; font-size:12px;"><strong><a style="color:#F00; text-decoration:none;" href="http://www.diplomados.uia.mx/programas.php?id_discipline=<?php echo $row_oferta_neg['id_discipline']; ?>&amp;id_program=<?php echo $row_oferta_neg['id_program']; ?>"><?php echo $row_oferta_neg['program_name']; ?></a></strong></span><span style="color:#666; font-family:Arial, Helvetica, sans-serif; font-size:12px;"><br />
                                Inicio: <?php echo strftime("%d de %B de %Y", strtotime($row_oferta_neg['fecha'])); ?></span></p></td>
                          </tr>
                          <tr>
                            <td></td>
                            <td>&nbsp;</td>
                            <td><img src="http://www.dec-uia.com/newsletter/mages/headers_colores/btn_ingles.png" width="178" height="23"></td>
                            <td>&nbsp;</td>
                            <td></td>
                          </tr>
                          <tr>
                            <td></td>
                             <td></td>
                            <td>
                              <?php
                                while ($object=mysql_fetch_object($query_idiomas)) {

                                        echo "<span style='color:#F00; font-family:Arial, Helvetica, sans-serif; font-size:12px;''>
                                          <strong>
                                            <a style='color:#F00; text-decoration:none;' href='http://www.diplomados.uia.mx/programas.php?id_discipline=".$object->id_discipline."&amp;id_program=".$object->id_program."'>
                                              ".$object->program_name."
                                            </a>
                                           </strong>
                                        </span>
                                        <span style='color:#666; font-family:Arial, Helvetica, sans-serif; font-size:12px;'>
                                         <br />
                                           Inicio: ".strftime('%d de %B de %Y', strtotime($object->fecha))."
                                        </span>
                                      </p>";

                                        //echo $object->program_name;
                                       //<!--Inicio: <?php echo strftime('%d de %B de %Y', strtotime($row_oferta_neg['fecha'])); -->
                                 } 
                              ?>
                            </td>
                             <td></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center"><img src="http://www.dec-uia.com/newsletter/mages/header_contacto2.png" width="651" height="35" /></td>
              </tr>
              <tr>
                <td align="center"><table width="90%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="5">
                          <tr>
                              <td align="left" style="color:#666; font-size:18px; font-family:Arial, Helvetica, sans-serif; font-style:italic;">Direcci&oacute;n de Educaci&oacute;n Continua | UIA</td>

                          </tr>
                          <tr>
                            <td align="left" style="color:#666; font-size:12px; font-family:Arial, Helvetica, sans-serif; font-style:italic;">Tel. (55) 59.50.40.00 y 91.77.44.00<br> sin costo: 01 800 627 7615</td>
                            <td align="left" style="color:#2e4da4; font-size:12px; font-family:Arial, Helvetica, sans-serif; font-style:italic;">Conversa con nosotros <a href="https://www.facebook.com/diplomados.uia"><img src="http://www.dec-uia.com/newsletter/mages/logo_FB.png" style="width: 10%;margin-right: 13px;margin-left: 13px;"></a><a href="https://twitter.com/DiplomadosIbero"><img src="http://www.dec-uia.com/newsletter/mages/logo_TW.png" style="width: 10%;"></a></td>

                          </tr>
                          <tr>
                            <td align="left" style="color:#666; font-size:12px; font-family:Arial, Helvetica, sans-serif; font-style:italic;">Prol. Paseo de la Reforma 880, edificio G, P.B.  Santa Fe, México,  D.F. <br />
                            <td align="left" style="color:#666; font-size:18px; font-family:Arial, Helvetica, sans-serif; font-style:italic;"><a style="color:#F00; font-size:24px; font-family:Arial, Helvetica, sans-serif; font-style:italic; text-decoration:none;" href="http://www.diplomados.uia.mx" target="_blank">www.diplomados.uia.mx</a></td>

                               </td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
<map name="Map" id="Map">
  <area shape="rect" coords="473,123,501,150" href="http://www.facebook.com/diplomados.uia" target="_blank" />
  <area shape="rect" coords="506,124,533,151" href="https://twitter.com/#!/DiplomadosIbero" />
</map>
</body>
</html>
<?php
mysql_free_result($communitu_op);

mysql_free_result($profs_ops);
?>
