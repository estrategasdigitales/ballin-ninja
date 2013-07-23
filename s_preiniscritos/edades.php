<?php require_once('Connections/otono2011.php'); 

require_once 'phplot.php';

mysql_select_db($database_otono2011, $otono2011);
$query_rfc = sprintf("SELECT edad, COUNT(*) as contador FROM sp_preinscritos GROUP BY edad ASC");
$rfc = mysql_query($query_rfc, $otono2011) or die(mysql_error());

$fecha_hoy = date('Ymd')."</br>";

$data = array();
$cont = 0;

while($row_rfc = mysql_fetch_assoc($rfc)){

	if($row_rfc['edad'] != 0){

		$data_edades = array();

		array_push($data_edades, $row_rfc['edad'], $row_rfc['contador']);

		array_push($data, $data_edades);
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

?>