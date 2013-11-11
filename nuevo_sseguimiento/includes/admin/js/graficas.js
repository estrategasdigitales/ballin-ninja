
var graficas = {
						
 	onReady:function()            
  	{												
  		$("#fecha_inicio,#fecha_fin").datepicker({
         changeMonth: true,		
         changeYear: true
  		});											  		
																																				
		$("#his_area_programa,#b_area_programa").on("click",graficas.area_programa);
  	},																																																						
 																			 									
  	area_programa:function(){												
																									
    var base_url = $("#base_url").text();
	var id_discipline = $("#id_discipline option:selected").val();  
												
	var data = "id_discipline="+id_discipline;	
		
	/*																												
	if($(this).attr("id")=="b_area_programa"){
		if($("#fecha_inicio").val()=='' && $("#fecha_fin").val()==''){
			alert("los campos fecha no deben quedar vacios");	
			return false;		
		}										
		data+= "&fecha_inicio="+$("#fecha_inicio").val()+"&fecha_fin="+$("#fecha_fin").val();										
	}*/																											
	data+= "&fecha_inicio="+$("#fecha_inicio").val()+"&fecha_fin="+$("#fecha_fin").val();										
  											 													   															
    $.post(base_url+'admin/graficas/area_programa/?'+data, function (area_programa) {		
 		  														 																									
        var area_programa = eval('(' + area_programa + ')');
        
        if(area_programa.success==false)
        {																																				
        	alert("No existen datos");
        	return false;
        }																															
													
        $('#container').highcharts({						
        	chart: {																				
				//renderTo: 'graficaLineal', 	// Le doy el nombre a la gráfica
				defaultSeriesType: 'line'	// Pongo que tipo de gráfica es
			},												
			title: {		
				text: area_programa.title	// Titulo (Opcional)
			},							
			// Pongo los datos en el eje de las 'X'
			xAxis: {														
				categories: area_programa.dis_pro,		
				// Pongo el título para el eje de las 'X'
				title: {			
					text: 'Disciplinas'		
				}
			},
			yAxis: {					
				// Pongo el título para el eje de las 'Y'
				title: {					
					text: 'Nº preinscritos'
				}
			},
			// Doy los datos de la gráfica para dibujarlas
			series: [{					
							
		                name: 'totales',		
		                data: area_programa.total						
		            }																											
		         ],					
        	});
    	});		
    }  			
}

$(document).ready(function(){ 
    graficas.onReady();                              
}); 						
