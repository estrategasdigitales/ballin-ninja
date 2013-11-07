<?php echo $this->load->view('admin/graficas/menu_graficas'); ?>
<header>
<script src="<?php echo base_url('includes/highcharts/js/highcharts.js'); ?>"></script>
<script src="<?php echo base_url('includes/highcharts/js/modules/exporting.js'); ?>"></script>		
</header>																	
Grafica del <input type="text" name="fecha_inicio"> al <input type="text" name="fecha_fin"><input type="button" name="graficar_historico" id="graficar_historico" value="Graficar histórico">
<div id="graficas">																								
	<div>																														
	<label>Disciplinas: *</label>				
	<select name="id_discipline" id="id_discipline">		
		<option value="0">Todas las disciplinas</option>																																											
		<?php foreach($disciplinas as $disciplina){ ?>		
		<option value="<?php echo $disciplina->id_discipline; ?>"  <?php echo set_select('id_discipline', $disciplina->id_discipline); ?>><?php echo $disciplina->discipline; ?></option>												
		<?php } ?>																																																								
	</select>																		
	</div>															
	<div>																																																					
	<label>Tipo de programa: *</label>								
	<select name="program_type" id="program_type">																																													
		<option value="0">Selecciona el tipo de programa</option>																																																																																																																
	</select>																																																					
	</div>																			
	<div>																																																														
	<label>Programas: *</label>								
	<select name="id_program" id="id_program">																																													
		<option value="0">Selecciona un programa</option>																																																																			
	</select>																																							
	</div>													
</div>																	
<input type="button" name="graficar" id="graficar" value="Graficar">
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<script>				
	$("#graficar_historico").on("click",gen_grafico);

	function graficar_historico(){

	 $('#container').highcharts({
            chart: {
                type: 'area'
            },
            title: {
                text: 'US and USSR nuclear stockpiles'
            },
            subtitle: {
                text: 'Source: <a href="http://thebulletin.metapress.com/content/c4120650912x74k7/fulltext.pdf">'+
                    'thebulletin.metapress.com</a>'
            },
            xAxis: {
                labels: {
                    formatter: function() {
                        return this.value; // clean, unformatted number for year
                    }
                }
            },
            yAxis: {
                title: {
                    text: 'Nuclear weapon states'
                },
                labels: {
                    formatter: function() {
                        return this.value / 1000 +'k';
                    }
                }
            },
            tooltip: {
                pointFormat: '{series.name} produced <b>{point.y:,.0f}</b><br/>warheads in {point.x}'
            },
            plotOptions: {
                area: {
                    pointStart: 1940,
                    marker: {
                        enabled: false,
                        symbol: 'circle',
                        radius: 2,
                        states: {
                            hover: {
                                enabled: true
                            }
                        }
                    }
                }
            },
            series: [{
                name: 'USA',
                data: [null, null, null, null, null, 6 , 11, 32, 110, 235, 369, 640,
                    1005, 1436, 2063, 3057, 4618, 6444, 9822, 15468, 20434, 24126,
                    27387, 29459, 31056, 31982, 32040, 31233, 29224, 27342, 26662,
                    26956, 27912, 28999, 28965, 27826, 25579, 25722, 24826, 24605,
                    24304, 23464, 23708, 24099, 24357, 24237, 24401, 24344, 23586,
                    22380, 21004, 17287, 14747, 13076, 12555, 12144, 11009, 10950,
                    10871, 10824, 10577, 10527, 10475, 10421, 10358, 10295, 10104 ]
            }, {
                name: 'USSR/Russia',
                data: [null, null, null, null, null, null, null , null , null ,null,
                5, 25, 50, 120, 150, 200, 426, 660, 869, 1060, 1605, 2471, 3322,
                4238, 5221, 6129, 7089, 8339, 9399, 10538, 11643, 13092, 14478,
                15915, 17385, 19055, 21205, 23044, 25393, 27935, 30062, 32049,
                33952, 35804, 37431, 39197, 45000, 43000, 41000, 39000, 37000,
                35000, 33000, 31000, 29000, 27000, 25000, 24000, 23000, 22000,
                21000, 20000, 19000, 18000, 18000, 17000, 16000]
            }]
        });			
      }

    function gen_grafico(){	

    var base_url = $("#base_url").text();
	var id_discipline = $("#id_discipline option:selected").val();  
    var data = "id_discipline="+id_discipline;

    $.get(base_url+'admin/graficas/area_grafica/?'+data, function (csv) {
        
        console.log(csv);													
        var csv = eval('(' + csv + ')');						
        console.log(csv.disciplinas);																				

        $('#container').highcharts({						
        	chart: {																				
				renderTo: 'graficaLineal', 	// Le doy el nombre a la gráfica
				defaultSeriesType: 'line'	// Pongo que tipo de gráfica es
			},
			title: {		
				text: 'Datos de las Visitas'	// Titulo (Opcional)
			},
			subtitle: {
				text: 'Jarroba.com'		// Subtitulo (Opcional)
			},
			// Pongo los datos en el eje de las 'X'
			xAxis: {														
				categories: csv.disciplinas,		
				// Pongo el título para el eje de las 'X'
				title: {
					text: 'Meses'
				}
			},
			yAxis: {
				// Pongo el título para el eje de las 'Y'
				title: {
					text: 'Nº Visitas'
				}
			},
			// Doy formato al la "cajita" que sale al pasar el ratón por encima de la gráfica
			tooltip: {
				enabled: true,
				formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
						this.x +': '+ this.y +' '+this.series.name;
				}		
			},
			// Doy opciones a la gráfica
			plotOptions: {
				line: {
					dataLabels: {
						enabled: true
					},
					enableMouseTracking: true
				}
			},
			// Doy los datos de la gráfica para dibujarlas
			series: [{					
							
		                name: 'totales',		
		                data: csv.total						
		            }																											
		         ],
        });
    });

    }  							 		
</script>