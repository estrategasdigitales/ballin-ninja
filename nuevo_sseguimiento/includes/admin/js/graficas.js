
var graficas = {				
						
 	onReady:function()            
  	{																																
  		$.datepicker.regional['es'] = {
		      closeText: 'Cerrar',
		      prevText: '<Ant',
		      nextText: 'Sig>',
		      currentText: 'Hoy',
		      monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		      monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
		      dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
		      dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
		      dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
		      weekHeader: 'Sm',
		      dateFormat: 'mm/dd/yy',
		      firstDay: 1,
		      isRTL: false,		
		      showMonthAfterYear: false,
		      yearSuffix: ''};												
   		$.datepicker.setDefaults($.datepicker.regional['es']);
   																																				
  		$("#fecha_inicio,#fecha_fin").datepicker({		
         changeMonth: true,						
         changeYear: true,											
  		});																																												

  		$("#filtro_graficas #id_discipline").on("change",graficas.get_tipos_programas); 
      	$("#filtro_graficas #program_type").on("change",graficas.get_programas);
																																																																			
		$("#his_area_programa, #b_area_programa").on("click",graficas.area_programa);
		$("#b_nacionalidad").on("click",graficas.nacionalidad);		
		$("#b_nivel_academico").on("click",graficas.nivel_academico);	
		$("#b_exalumno").on("click",graficas.exalumno_ibero);	
		$("#b_entero").on("click",graficas.como_se_entero);	
		$("#b_status_proceso").on("click",graficas.status_proceso);			
  	},																																																															

  	get_tipos_programas:function()
    {												    							                                                                                           
        var url = $("#base_url").text()+"admin/graficas/get_tipos_programas";
        var data = "id_discipline="+$(this).val();               

        var id_program = $("#id_program option:selected").val();
        if(id_program!=0)
        {
        	$("#id_program option[value=0]").attr("selected",true);
        }																			

        $.ajax({                                                 
          async:true,              
          type:"POST",       
          dataType:"html",                    
          contentType: "application/x-www-form-urlencoded,multipart/form-data",
          data:data,                        
          url:url,                     
          success:function(respuesta)    
          {                                                                                                                                            
            $("#program_type").html(respuesta);         
          },                                                             
          timeout:4000,             
          error:function(respuesta)
          {                                           
            console.log(respuesta);            
          }							                              
        });             
    },								                         

    get_programas:function()
    {         						                                          
        var id_discipline = $("#id_discipline option:selected").val();             
        var data = "program_type="+$(this).val()+"&id_discipline="+id_discipline;
        var url = $("#base_url").text()+'admin/graficas/get_programas';

        $.ajax({                                         
            async:true,              
            type:"POST",
            dataType:"html",                    
            contentType: "application/x-www-form-urlencoded,multipart/form-data",
            url:url,                    
            data:data,     
            success:function(respuesta)    
            {                                                       
              $("#id_program").html(respuesta);         
            },                                                             
            timeout:4000,             
            error:function(respuesta)
            {                                                          
              console.log(respuesta);            
            }		                           
        });      
    }, 		  																																																																																
 																							 									
  	area_programa:function(){												
																																		
    var base_url = $("#base_url").text();
	var id_discipline = $("#id_discipline option:selected").val();  
												
	var data = "id_discipline="+id_discipline+"&fecha_inicio="+$("#fecha_inicio").val()+"&fecha_fin="+$("#fecha_fin").val();	
																																															 													   															
    $.post(base_url+'admin/graficas/area_grafica/?'+data, function (area_programa) {		
 		  														 																									
        var area_programa = eval('(' + area_programa + ')');
        
        if(area_programa.success==false)
        {																																				
        	alert("No existen datos");
        	return false;
        }																															
													
        $('#container').highcharts({						
        	chart: {																																	
				//renderTo: 'graficaLineal', 	// Le doy el nombre a la gráfica
				defaultSeriesType: 'bar'	// Pongo que tipo de gráfica es
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
    },									

    nacionalidad:function()
    {																																			
	   	var base_url = $("#base_url").text();
		var id_discipline = $("#id_discipline option:selected").val();  
													
		var data = "id_discipline="+id_discipline+"&fecha_inicio="+$("#fecha_inicio").val()+"&fecha_fin="+$("#fecha_fin").val();
								
		var program_type = $("#program_type option:selected").val();			
		if($("#program_type option:selected").val()!=0){
			data+="&program_type="+program_type;			 									
		}																				

		var id_program = $("#id_program option:selected").val();
		if($("#id_program option:selected").val()!=0){
			data+="&id_program="+id_program;			 									
		}																																	

	  																						 													   															
	    $.post(base_url+'admin/graficas/nacionalidad_grafica/?'+data, function (area_programa){				
	 		  																										 																									
	        var area_programa = eval('(' + area_programa + ')');
	        			
	        if(area_programa.success==false)
	        {																																				
	        	alert("No existen datos");
	        	return false;
	        }																																				
														
	        $('#container').highcharts({						
	        	chart: {																																	
					defaultSeriesType: 'bar'
				},												
				title: {		
					text: area_programa.title	
				},							
				xAxis: {																					
					categories: area_programa.dis_pro,		
					title: {			
						text: 'Nacionalidad'		
					}
				},
				yAxis: {					
					title: {					
						text: 'Nº preinscritos'
					}
				},
				series: [{					
								
			                name: 'totales',		
			                data: area_programa.total						
			            }																														
			         ],					
	        	});
	    	});								
	},			

	nivel_academico:function()
    {																																												
	   	var base_url = $("#base_url").text();
		var id_discipline = $("#id_discipline option:selected").val();  
													
		var data = "id_discipline="+id_discipline+"&fecha_inicio="+$("#fecha_inicio").val()+"&fecha_fin="+$("#fecha_fin").val();
								
		var program_type = $("#program_type option:selected").val();			
		if($("#program_type option:selected").val()!=0){
			data+="&program_type="+program_type;			 									
		}																				

		var id_program = $("#id_program option:selected").val();
		if($("#id_program option:selected").val()!=0){
			data+="&id_program="+id_program;			 									
		}																																											

	  																						 													   															
	    $.post(base_url+'admin/graficas/nivel_academico_grafica/?'+data, function (area_programa){				
	 		  																										 																									
	        var area_programa = eval('(' + area_programa + ')');
	        			
	        if(area_programa.success==false)
	        {																																				
	        	alert("No existen datos");
	        	return false;
	        }																																				
														
	        $('#container').highcharts({						
	        	chart: {																																	
					defaultSeriesType: 'bar'
				},												
				title: {		
					text: area_programa.title	
				},											
				xAxis: {																							
					categories: area_programa.dis_pro,		
					title: {															
						text: 'Nivel de estudios'		
					}			
				},
				yAxis: {					
					title: {					
						text: 'Nº preinscritos'
					}
				},
				series: [{					
								
			                name: 'totales',		
			                data: area_programa.total						
			            }																														
			         ],					
	        	});
	    	});								
	},										

	exalumno_ibero:function()
    {																																																														
	   	var base_url = $("#base_url").text();
		var id_discipline = $("#id_discipline option:selected").val();  
													
		var data = "id_discipline="+id_discipline+"&fecha_inicio="+$("#fecha_inicio").val()+"&fecha_fin="+$("#fecha_fin").val();
								
		var program_type = $("#program_type option:selected").val();			
		if($("#program_type option:selected").val()!=0){
			data+="&program_type="+program_type;			 									
		}																				

		var id_program = $("#id_program option:selected").val();
		if($("#id_program option:selected").val()!=0){
			data+="&id_program="+id_program;			 									
		}																																											

	  																								 													   															
	    $.post(base_url+'admin/graficas/exalumno_grafica/?'+data, function (area_programa){				
	 		  																																			 																									
	        var area_programa = eval('(' + area_programa + ')');
	        			
	        if(area_programa.success==false)
	        {																																				
	        	alert("No existen datos");
	        	return false;
	        }																																				
														
	        $('#container').highcharts({						
	        	chart: {																																	
					defaultSeriesType: 'bar'
				},												
				title: {		
					text: area_programa.title	
				},											
				xAxis: {																							
					categories: area_programa.dis_pro,		
					title: {															
						text: 'Nivel de estudios'		
					}			
				},
				yAxis: {					
					title: {					
						text: 'Nº preinscritos'
					}
				},			
				series: [{					
								
			                name: 'totales',		
			                data: area_programa.total						
			            }																														
			         ],					
	        	});
	    	});												
	},						

	como_se_entero:function()
    {																																																																											
	   	var base_url = $("#base_url").text();
		var id_discipline = $("#id_discipline option:selected").val();  
													
		var data = "id_discipline="+id_discipline+"&fecha_inicio="+$("#fecha_inicio").val()+"&fecha_fin="+$("#fecha_fin").val();
															
		var program_type = $("#program_type option:selected").val();			
		if($("#program_type option:selected").val()!=0){
			data+="&program_type="+program_type;			 									
		}																				

		var id_program = $("#id_program option:selected").val();
		if($("#id_program option:selected").val()!=0){
			data+="&id_program="+id_program;			 									
		}																																											
																											 													   															
	    $.post(base_url+'admin/graficas/se_entero_grafica/?'+data, function (area_programa){				
	 		  																																												 																									
	        var area_programa = eval('(' + area_programa + ')');
	        			
	        if(area_programa.success==false)
	        {																																				
	        	alert("No existen datos");
	        	return false;
	        }																																												
														
	        $('#container').highcharts({						
	        	chart: {																																	
					defaultSeriesType: 'line'
				},																
				title: {					
					text: area_programa.title	
				},											
				xAxis: {																							
					categories: area_programa.dis_pro,		
					title: {															
						text: 'Nivel de estudios'		
					}			
				},
				yAxis: {					
					title: {					
						text: 'Nº preinscritos'
					}
				},
				series: [{					
								
			                name: 'totales',		
			                data: area_programa.total						
			            }																														
			         ],					
	        	});
	    	});												
	},					

	status_proceso:function()
	{												
		var base_url = $("#base_url").text();
		var id_discipline = $("#id_discipline option:selected").val();  
													
		var data = "id_discipline="+id_discipline+"&fecha_inicio="+$("#fecha_inicio").val()+"&fecha_fin="+$("#fecha_fin").val();
															
		var program_type = $("#program_type option:selected").val();			
		if($("#program_type option:selected").val()!=0){
			data+="&program_type="+program_type;			 									
		}																						

		var id_program = $("#id_program option:selected").val();
		if($("#id_program option:selected").val()!=0){
			data+="&id_program="+id_program;			 									
		}																																															
																																									 													   															
	    $.post(base_url+'admin/graficas/status_proceso_grafica/?'+data, function (proceso){				
	 		  																																																 																									
	        var proceso = eval('(' + proceso + ')');				

	        if(proceso.status.success==true)
	        {																																												
	        																																																																																						
		        $('#status').highcharts({						
		        	chart: {																																	
						defaultSeriesType: 'line'
					},																
					title: {					
						text: proceso.status.title	
					},											
					xAxis: {																															
						categories: proceso.status.dis_pro,		
						title: {																			
							text: 'Nivel de estudios'		
						}			
					},
					yAxis: {					
						title: {					
							text: 'Nº preinscritos'
						}
					},
					series: [{					
									
				                name: 'totales',		
				                data: proceso.status.total						
				            }																																			
				         ],					
		        });	

	        }				

	        if(proceso.casos_abiertos.success==true)
	        {										

		    	$('#casos_abiertos').highcharts({						
		        	chart: {																																	
						defaultSeriesType: 'line'
					},																
					title: {					
						text: proceso.casos_abiertos.title	
					},											
					xAxis: {																											
						categories: proceso.casos_abiertos.dis_pro,		
						title: {																	
							text: 'Casos abiertos'		
						}			
					},
					yAxis: {					
						title: {					
							text: 'Nº preinscritos'
						}
					},
					series: [{					
									
				                name: 'totales',		
				                data: proceso.casos_abiertos.total						
				            }																														
				         ],					
		        });	
	        }												

	        if(proceso.casos_cerrados.success==true)
	        {							
		        $('#casos_cerrados').highcharts({						
		        	chart: {																																	
						defaultSeriesType: 'line'
					},																
					title: {					
						text:  proceso.casos_cerrados.title	
					},											
					xAxis: {																											
						categories: proceso.casos_cerrados.dis_pro,		
						title: {																	
							text: 'Casos cerrados'		
						}			
					},
					yAxis: {					
						title: {					
							text: 'Nº preinscritos'
						}
					},
					series: [{													
									
				                name: 'totales',		
				                data: proceso.casos_cerrados.total							
				            }																														
				         ],							
		        });			

	    	}

	        				
	        if(proceso.casos_inconclusos.success==true)
	        {															
		        $('#casos_inconclusos').highcharts({						
		        	chart: {																																						
						defaultSeriesType: 'line'
					},																
					title: {					
						text: proceso.casos_inconclusos.title	
					},											
					xAxis: {																											
						categories: proceso.casos_inconclusos.dis_pro,		
						title: {																	
							text: 'Casos inconclusos'		
						}							
					},
					yAxis: {					
						title: {					
							text: 'Nº preinscritos'
						}
					},							
					series: [{										
									
				                name: 'totales',		
				                data: proceso.casos_inconclusos.total						
				            }																														
				         ],							
		        });
	        }								
	        	    
	    });																
	}							
}

$(document).ready(function(){ 
    graficas.onReady();                              
}); 						
