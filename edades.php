<?php require_once('Connections/otono2011.php'); 

require_once 'phplot.php';

mysql_select_db($database_otono2011, $otono2011);
$query_rfc = sprintf("SELECT edad, COUNT(*) as contador FROM sp_preinscritos GROUP BY edad ASC");
$rfc = mysql_query($query_rfc, $otono2011) or die(mysql_error());
$totalRows_rfc = mysql_num_rows($rfc);

$fecha_hoy = date('Ymd')."</br>";

$data = array();
$cont = 0;
while($row_rfc = mysql_fetch_assoc($rfc)){

	if($row_rfc['edad'] != 0){

		$data_edades = array();

		array_push($data_edades, $row_rfc['edad'], $row_rfc['contador']);

		array_push($data, $data_edades);

		//echo $row_rfc['edad'].' - '.$row_rfc['contador'].'<br/>';
	}
}
$p = new PHPlot(1800, 400);

$p->SetTitle('Edades de preinscritos DEC');

$p->SetDataType('text-data');
$p->SetDataValues($data);

$p->SetPlotType('bars');

$p->SetBackgroundColor('#ffffcc');
$p->SetDrawPlotAreaBackground(True);
$p->SetPlotBgColor('#ffffff');

# Draw lines on all 4 sides of the plot:
$p->SetPlotBorderType('full');

# Set a 3 line legend, and position it in the upper left corner:
$p->SetLegend(array('Cantidad'));
$p->SetLegendWorld(0.1, 95);

# Turn data labels on, and all ticks and tick labels off:
$p->SetXDataLabelPos('plotdown');
$p->SetYDataLabelPos('plotin');
$p->SetXTickPos('none');
$p->SetXTickLabelPos('none');
$p->SetYTickPos('none');
$p->SetYTickLabelPos('none');

# Generate and output the graph now:
$p->DrawGraph();
/*
$cont = 0;

while($row_rfc = mysql_fetch_assoc($rfc)){
	$rfc_fecha = str_split($row_rfc['rfc'], 10);
	$chars = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
	$rfc_fecha1 = str_replace($chars, "", $rfc_fecha[0]);
	$largo = strlen($rfc_fecha1);
	if($largo == 6){
	$cont++;

	$fecha_completa = (int)"19".(int)$rfc_fecha1;
	$edad = $fecha_hoy - $fecha_completa;
	$edad_limpia = str_split($edad, 2);

	$query_edades = "UPDATE sp_preinscritos SET edad=".$edad_limpia[0]." WHERE id_preinscrito=".$row_rfc['id_preinscrito'];

	  mysql_select_db($database_otono2011, $otono2011);
	  $Result_edades = mysql_query($query_edades, $otono2011) or die(mysql_error());

	echo $cont."- ".$fecha_completa."-".$edad_limpia[0]."<br>";
}
}
*/
?>