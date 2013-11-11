var filtro = {              

  onReady:function()            
  {                                                                        
      filtro.controller = $("#controller").text();              
      $("#filtro #id_discipline").on("change",filtro.get_tipos_programas); 
      $("#filtro #program_type").on("change",filtro.get_programas);
      $("#filtro #id_program").on("change",filtro.search_programa);
  },                                                                                                                                                                                                                                                                                                                                                               

  get_tipos_programas:function()
  {              
      if($(this).val()==0){             
        return false;   
      }                           

      var url = $("#base_url").text()+"admin/"+filtro.controller+"/get_tipos_programas";
      var data = "id_discipline="+$(this).val();                                                           

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

      filtro.search_disciplina(filtro.controller);                                                  
  },                                                                                                                                                                                      

  get_programas:function()
  {          
      if($(this).val()==0){
        return false;   
      }                       
        
      var id_discipline = $("#id_discipline option:selected").val();             
      var data = "program_type="+$(this).val()+"&id_discipline="+id_discipline;
      var url = $("#base_url").text()+"admin/"+filtro.controller+"/get_programas";

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

    filtro.search_tipo_programa(filtro.controller);                                 
  },                       

  search_disciplina:function(controller)
  {                                                                                                                                                                                               
    var searchString = $("#id_discipline option:selected").val();         
    var data = new Object();                                                
    data.searchField = 'pre.id_discipline';     
    data.searchOper = 'eq';                                                                                                                        
    data.searchString = searchString;                                                        
    $("#list_"+controller).jqGrid('setGridParam',{search:true,postData:data,page:1}).trigger("reloadGrid"); 
  },                                                                                     

  search_tipo_programa:function(controller)
  {                                                            
    var id_discipline = $("#id_discipline option:selected").val();                                                                                                                                                                                                      
    var program_type = $("#program_type option:selected").val();          
    var data = new Object();                                                                                                                                    
    data.searchField = ['pre.id_discipline','pro.program_type'];     
    data.searchOper = 'eq';                                                                                                                                                                                                                             
    data.searchString = [id_discipline,program_type];                                                                                                                
    $("#list_"+controller).jqGrid('setGridParam',{search:true,postData:data,page:1}).trigger("reloadGrid"); 
  },                                                              

  search_programa:function()
  {                                                                                                                                                                      
    var searchString = $("#id_program option:selected").val();         
    var data = new Object();                                                 
    data.searchField = 'pro.id_program';     
    data.searchOper = 'eq';                                                                                                                                                                           
    data.searchString = searchString;                                                                                          
    $("#list_"+filtro.controller).jqGrid('setGridParam',{search:true,postData:data,page:1}).trigger("reloadGrid"); 
  }                                          
}                                    

var users = {                                 
    indice_array:0,                                            
    onReady:function()
    {                                                                                            
      var base_url = $("#base_url").text();
          $("#list").jqGrid({                                        
          url:base_url+'admin/users/jqGrid', 
          mtype : "post",   
          datatype: "json",  
          colNames:['Nombre','Rol de usuario','Editar','Notificación','Activo','Borrar'], 
          colModel:[                                                                                                                                             
              {name:'nombre',index:'nombre',width:150,align:'left'},                                                                                                                                                                                                           
              {name:'rol',index:'rol',width:150,align:'left'},                                                                                                                                                                                                                            
              {name:'editar',search:false,sortable:false,align:'center',width:50,formatter:function(cellValue, options, rowdata, action){                                                                                                                                                                                                         
                return "<a href='"+base_url+"admin/users/edit/" + options.rowId + "'><div class='ui-pg-div ui-inline-edit' onmouseout=\"jQuery(this).removeClass('ui-state-hover')\" onmouseover=\"jQuery(this).addClass('ui-state-hover');\"  style='display:inline-block;cursor:pointer;' title='Modificar fila seleccionada'><span class='ui-icon ui-icon-pencil'></span></div></a>";                            
              }},                                                                                                                                                                                                                                                                                                                                                              
              {name:'notificacion',search:false,sortable:false,align:'center',width:50,formatter:function(cellValue, options, rowdata, action){                   
                var checked = (cellValue==1)?'checked':'';                                                                                                                                                          
                return "<input type='checkbox' name='chk_notificacion' id='"+options.rowId+"' "+checked+">";                                       
              }},         												                                                                                                               
              {name:'activo',search:false,sortable:false,align:'center',width:50,formatter:function(cellValue, options, rowdata, action){                   
                var checked = (cellValue==1)?'checked':'';                                                                                                                                                          
                return "<input type='checkbox' name='chk_activo' id='"+options.rowId+"' "+checked+">";                                       
              }},                                                     
              {name: 'myac',search:false,width:80,fixed:true,sortable:false,resize:false,formatter:'actions',formatoptions:{
                    keys: true,                                                                  
                    editbutton: false,             
                    editformbutton: false,
                    delbutton: true,                                                                                                                             
                    delOptions:{                    
                        url: 'delete',                                                                                                                                             
                        msg: "Desea eliminar el registro?",                                                          
                        afterSubmit: function (response, postdata) {
                            var r = $.parseJSON(response.responseText);
                            $("#msj").html(r.message);                                 
                            return [r.success, r.message, null];
                        }                                                                                                                                              
                    }                         
                 }    
              },                                                                                                                                                                                                                                                                                                                                                 
          ],                                                                                                                                                                      
          rowNum:5,                                    
          width: 970,     		                                                                                    
          rowList:[10,20,30],
          pager: '#pager',                                              
          sortname: 'user_uuid',
          sortorder: "desc",                 
          viewrecords: true,    
          rownumbers: true,             
          gridview: true,                                  
          caption:"Usuarios",
          loadComplete:function(data){
            if(data.records == 0){    
              var msj = $("#msj");    
              msj.html(data.msg);
              setTimeout(function(){
                msj.empty();
              },5000);                                                                                          
            }                                                                                                                                      
          }                                                                                                                                                    
    }).navGrid('#pager',{edit:false,add:false,del:false,excel:true}, 
    {}, //  default settings for edit
    {}, //  default settings for add
    {},  // delete instead that del:false we need this
    {searchOnEnter:true,closeOnEscape:true}, // search options
    {} /* view parameters*/               
    ).jqGrid('navButtonAdd',
    '#pager',																
    { caption:"Exportar a Excel",
        buttonicon: "ui-icon-bookmark",
        onClickButton: this.exportar, position: "last"
    });													
																															
      $("#exportar").on("click",users.exportar);
      $("#list input[name=chk_notificacion]").live("click",users.update_notificacion);  
      $("#list input[name=chk_activo]").live("click",users.update_activo); 
      $("#filtro_users #id_discipline").on("change",users.get_tipos_programas_ax); 
      $("#filtro_users #program_type").on("change",users.get_programas_ax);
      $("#tipo").on("change",users.tipo_usuario);                                                                                             
      $("#agregar_programas").on("click",users.agregar_programas);  
      $("#form_add_users").on("submit",users.add_users); 
      $("#form_update_users").on("submit",users.update_users);     
      $("#usuario_programas a").on("click",users.confirm_delete_programa); 
      $("#usuario_programas .new_program").live("click",users.delete_programa_new);
    },					                             							
      						
    exportar:function()
    {																							
        $("#list").jqGrid('excelExport',{url:'excel/'});       
    },						     				         					

    tipo_usuario:function()
    {                                   
      if($(this).val()==1){                            
        $("#agregar_programas").attr("disabled",true);
        $("#usuario_programas").empty();
        $("#programas").val(null);                                                         
      }else{                                                                    
        $("#agregar_programas").attr("disabled",false);
      }                                
    },                                                                                                                                             
                  
    delete_programa_new:function(e)
    {                                                                                                                                           
        e.preventDefault();
        var indice_array = $(this).attr("id"); 
        var programas = $.parseJSON($("#programas").val());
        programas.splice(indice_array,1); 

        if(programas.length>0){                                                           
          $("#programas").val(JSON.stringify(programas));
        }else{                                                                                                     
          $("#programas").val(null);  
        }                                                                                                                      
        $(this).parent().remove();            
    },                                                                                                                                                                                                                                            
            
    confirm_delete_programa:function(e)
    {                   
        e.preventDefault();
        var self = $(this);
        $("<div></div>").dialog({                                                                                
              buttons: {            
                "Eliminar": function () { 
                  users.delete_usuario_programa(self);          
                  $(this).dialog("close"); 
                },                                             
                "Cancelar": function () { $(this).dialog("close"); } 
              },                                       
              close: function (event, ui) { $(this).remove(); },
              resizable: true,                 
              title: "Confirmar",
              modal: true                                                                
          }).text("¿ Está seguro de eliminar el programa ?");  
    },              
    
    delete_usuario_programa:function(self)
    {                                                                                                       
        var li = self.parent();                                                        
        var id_usuario_programa = self.children().attr("id");                 
        var url = $("#base_url").text()+"admin/users/delete_usuario_programa";     
        var data = "id_usuario_programa="+id_usuario_programa; 

        $.ajax({                                                                                
            async:true,              
            type:"POST",
            dataType:"json",                    
            contentType: "application/x-www-form-urlencoded,multipart/form-data",
            url:url,                                
            data:data,         
            success:function(res)    
            {                         
              if(res.success){                                                                                                                       
                $("#msj").html(res.msg); 
                li.remove();
              }                                                  
            },                                                                                                                                                      
            timeout:4000,             
            error:function(res)
            {                                           
              console.log(res);            
            }                                                                               
        });                            
    },                                                                                           

    agregar_programas:function()
    {                                                                                      
          if($("#id_discipline").val()!=0 && $("#program_type").val()!=0 && $("#id_program").val()!=0)
          {                             
            var base_url = $("#base_url").text()                                                                                                                
            var li  = $("<li></li>");                                                                                                    
            var div = $("<div id='"+users.indice_array+"' class='new_program'><a href='#'><img src='"+base_url+"includes/admin/images/delete.png'></a></div>");         

            var id_discipline  = $("#id_discipline option:selected").val();
            var id_program     = $("#id_program option:selected").val();
            var option_program = $("#id_program option:selected").text(); 

            if($("#programas").val())
            {          

              var programas = $.parseJSON($("#programas").val());              
              programas.push({"id_discipline": id_discipline, "id_program": id_program})                     
              li.append(option_program);  
              li.append(div);              
              $("#usuario_programas ul").append(li);

            }else{                                                                

              var programas = [{"id_discipline": id_discipline, "id_program": id_program}];                      
              li.append(option_program);   
              li.append(div);                             
              $("#usuario_programas ul").append(li);
                  
            }             
                                                        
            users.indice_array=users.indice_array+1;                                  
            programas = JSON.stringify(programas); 
            $("#programas").val(programas);                                                                                                                                                                                                     
            $("#id_discipline option[value=0]").attr("selected",true);
            $("#program_type option[value=0]").attr("selected",true);
            $("#id_program option[value=0]").attr("selected",true);
          }                                                                                                                                                                 
    },                                                  

    add_users:function(e)
    {                                                       
        e.preventDefault();                         
        var url = $("#base_url").text()+"admin/users/add";         
        var data = $(this).serialize();       
        
        $.ajax({                                                 
            async:true,              
            type:"POST",            
            dataType:"json",                    
            contentType: "application/x-www-form-urlencoded,multipart/form-data",
            url:url,                    
            data:data,                
            success:function(res)    
            {                   
              if(res.success==false){         
                $("#msj").html(res.msg);   
              }else{                                                                                                                                                                                                
                document.location.href=res.redirect;                                        
              }                                                                                                                   
            },                                                             
            timeout:4000,             
            error:function(respuesta)
            {                                           
              console.log(respuesta.responseText);            
            }                                                                                
        });              
    },    
              
    update_users:function(e)
    {                                               
        e.preventDefault();                                
        var url = $("#base_url").text()+"admin/users/update";         
        var data = $(this).serialize();

        $.ajax({                                                         
            async:true,              
            type:"POST",                      
            dataType:"json",                    
            contentType: "application/x-www-form-urlencoded,multipart/form-data",
            url:url,                    
            data:data,                
            success:function(res)    
            {                                
              if(res.success==false){         
                $("#msj").html(res.msg);   
              }else{                                                                                                                                                                                                             
                document.location.href=res.redirect;                                        
              }                                                                                                                                    
            },                                                                     
            timeout:4000,             
            error:function(respuesta)
            {                                           
              console.log(respuesta);            
            }                              
        });       
    },                              

    get_tipos_programas_ax:function()
    {                                                                                               
        var url = $("#base_url").text()+"admin/users/get_tipos_programas_ax";
        var data = "id_discipline="+$(this).val();               

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

    get_programas_ax:function()
    {                                                   
        var id_discipline = $("#id_discipline option:selected").val();             
        var data = "program_type="+$(this).val()+"&id_discipline="+id_discipline;
        var url = $("#base_url").text()+'admin/users/get_programas_ax';

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
                                         
    update_notificacion:function(e)
    {                                   
      var value = ($(this).attr('checked'))?1:0;                               
      var data = "user_uuid="+$(this).attr("id")+"&value="+value;
      var url = $("#base_url").text()+'admin/users/update_notificacion';

        $.ajax({                                 
            async:true,              
            type:"POST",
            dataType:"json",                    
            contentType: "application/x-www-form-urlencoded,multipart/form-data",
            url:url,                    
            data:data,     
            success:function(res)    
            {                                         
              $("#msj").html(res.message);         
            },                                                  
            timeout:4000,             
            error:function(res)
            {                                           
              console.log(res);            
            }                     
        });                  
    },                                         

    update_activo:function(e)
    {                                           
        var value = ($(this).attr('checked'))?1:0;                               
        var data = "user_uuid="+$(this).attr("id")+"&value="+value;
        var url = $("#base_url").text()+'admin/users/update_activo';

        $.ajax({                                 
            async:true,                   
            type:"POST",
            dataType:"json",                    
            contentType: "application/x-www-form-urlencoded,multipart/form-data",
            url:url,                    
            data:data,     
            success:function(res)    
            {                                              
              $("#msj").html(res.message);         
            },                                                  
            timeout:4000,             
            error:function(res)
            {                                           
              console.log(res);            
            }                     
        });  
    }                                                                        
}   

var preinscritos = {
														
  onReady:function()
  {                    		 										
      var base_url = $("#base_url").text();
      jQuery("#list_preinscritos").jqGrid({                                                  
          url:base_url+'admin/preinscritos/jqGrid', 
          mtype : "post",   
          datatype: "json",             
          colNames:['Nombre','Apellido paterno','Apellido materno','Programa de interes','Fecha','Código de promoción','Primer contacto','Documentos','Enviar a decse','Envío de claves','Pago realizado','Eliminar'],       //Grid column headings
          colModel:[                                            		                                               						                                                                                                                                                                                                                                                                                                												                                                                       		
              {name:'nombre',index:'nombre',width:130,search:true,sortable:true,align:'left',width:120,formatter:function(cellValue, options, rowdata, action){                                                                                                                                                                                                         
                return "<a href='detalle/" + options.rowId + "' class='group1' name='edit'>"+cellValue+"</a>";                                    
              }},                     		                                                                                                                                                                                           
              {name:'a_paterno',index:'a_paterno',search:true,sortable:true,width:120,align:'left'}, 
              {name:'a_materno',index:'a_materno',search:true,sortable:true,width:120,align:'left'},                                                                                                                                                                                                           
              {name:'program_name',index:'program_name',search:true,sortable:true,width:200,align:'left'},                                                                                                                                                                                                           
              {name:'fecha_registro',index:'fecha_registro',search:false,sortable:true,width:100,align:'left'},  
              {name:'codigo',index:'codigo',search:false,sortable:true,width:100,align:'left'},  
              {name:'primer_contacto',index:'primer_contacto',search:false,sortable:false,width:100,align:'center',formatter:function(cellValue, options, rowdata, action){ 
                cellValue = cellValue.split('|');							   														
                if(cellValue[0]){                                   																							
                  var cell = "<img src='"+base_url+"includes/admin/images/seguimiento/green.png'>";
                  	if(cellValue[1]){																																																						
                  		cell+="<div class='comment_i' title='"+cellValue[1]+"'><img src='"+base_url+"includes/admin/images/seguimiento/informacion.png'></div>";
                	}																																																																			
                	return cell;											
                }																								                                                     	        								        		        			                                  
                return '';   								 																					                     
              }},        						                                          		         				                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
              {name:'documentos',index:'documentos',search:false,sortable:false,width:100,align:'center',formatter:function(cellValue, options, rowdata, action){ 
                cellValue = cellValue.split('|');   
                if(cellValue[0]){                                   																	
                  var cell = "<img src='"+base_url+"includes/admin/images/seguimiento/green.png'>";
                  	if(cellValue[1]){																																																						
                  		cell+="<div class='comment_i' title='"+cellValue[1]+"'><img src='"+base_url+"includes/admin/images/seguimiento/informacion.png'></div>";
                	}																																																													
                	return cell;											
                }																								                                                     	        								        		        			                                  
                return '';              			                  																			
              }},            
              {name:'envio_decse',index:'envio_decse',search:false,sortable:false,width:100,align:'center',formatter:function(cellValue, options, rowdata, action){ 
               cellValue = cellValue.split('|');   
                if(cellValue[0]){                                   																	
                  var cell = "<img src='"+base_url+"includes/admin/images/seguimiento/green.png'>";
                  	if(cellValue[1]){																																																										
                  		cell+="<div class='comment_i' title='"+cellValue[1]+"'><img src='"+base_url+"includes/admin/images/seguimiento/informacion.png'></div>";
                	}																																																													
                	return cell;											
                }																								                                                     	        								        		        			                                  
                return '';                    
              }},
              {name:'envio_claves',index:'envio_claves',search:false,sortable:false,width:100,align:'center',formatter:function(cellValue, options, rowdata, action){ 
                cellValue = cellValue.split('|');   
                if(cellValue[0]){                                   																	
                  var cell = "<img src='"+base_url+"includes/admin/images/seguimiento/green.png'>";
                  	if(cellValue[1]){																																																						
                  		cell+="<div class='comment_i' title='"+cellValue[1]+"'><img src='"+base_url+"includes/admin/images/seguimiento/informacion.png'></div>";
                	}																																																													
                	return cell;											
                }																								                                                     	        								        		        			                                  
                return '';     																		                    
              }},		
              {name:'pago_realizado',index:'pago_realizado',search:false,sortable:false,width:100,align:'center',formatter:function(cellValue, options, rowdata, action){ 
                cellValue = cellValue.split('|');   
                if(cellValue[0]){                                   																	
                  var cell = "<img src='"+base_url+"includes/admin/images/seguimiento/green.png'>";
                  	if(cellValue[1]){																																																										
                  		cell+="<div class='comment_i' title='"+cellValue[1]+"'><img src='"+base_url+"includes/admin/images/seguimiento/informacion.png'></div>";
                	}																																																													
                	return cell;											
                }																								                                                     	        								        		        			                                  
                return '';   						                      				
              }},         															
              {name: 'eliminar',search:false,width:60,fixed:true,sortable:false,resize:false,formatter:'actions',formatoptions:{
                    keys: true,                                                                                                                                   
                    editbutton: false,             
                    editformbutton: false,
                    delbutton: true,                                                                                                                             
                    delOptions:{                                  
                        url: 'delete_preinscrito',                                                                                                                                             
                        msg: "Desea eliminar el registro?",                                                          
                        afterSubmit: function (response, postdata){       
                            var r = $.parseJSON(response.responseText);
                            $("#msj").html(r.message);                   
                            return [r.success, r.message, null];
                        }                                                                                                                                                
                    }                                
                 }                        
              },                                                                    
          ],									                                                                                                                                                                                                                         
          rowNum:20,    							                        
          width: 970,                                    
          height: 200,                          
          rowList:[10,20,30],     
          pager: '#pager_preinscritos',                                              
          sortname: 'id_preinscrito', 
          sortorder: "desc",                                  
          viewrecords: true,        
          rownumbers: true,             
          gridview: true,                               
          caption:"Preinscritos",       
          loadComplete:function(data){
            if(data.records == 0){    
              var msj = $("#msj");    
              msj.html(data.msg);
              setTimeout(function(){
                msj.empty();           
              },5000);                                                                                      
            }                                                                                                                                
          },                                                               
         editurl:'edit'                                                                                                                                                                                                    
      }).navGrid('#pager_preinscritos',{edit:false,add:false,del:false},
      {}, //  default settings for edit
    {}, //  default settings for add
    {},  // delete instead that del:false we need this
    {searchOnEnter:true,closeOnEscape:true}, // search options
    {} /* view parameters*/ 
    ).jqGrid('navButtonAdd',
    '#pager_preinscritos',																
    { caption:"Exportar a Excel",
        buttonicon: "ui-icon-bookmark",
        onClickButton: preinscritos.exportar, position: "last"
    });				               													                                                
 								
    $("#list_preinscritos a[name=edit]").live("click",preinscritos.edit); 
  },  	                           
                                  
  exportar:function()
  {																														
    $("#list_preinscritos").jqGrid('excelExport',{url:'excel/'});       
  },        	           		                      
		                                                                                                                                                                                                                                                                                                                                                 
  edit:function(e)
  {
    e.preventDefault();
    $.colorbox({href:$(this).attr("href"),iframe:true, width:"850px", height:"90%"});
  }                                                                                                                 			                                                                                                                              
}
            
var inscritos = {

  onReady:function()
  {                                                                                                                                                                                                                                                                                                                                                                                                                                 
      var base_url = $("#base_url").text();
      jQuery("#list_inscritos").jqGrid({                                                
          url:base_url+'admin/inscritos/jqGrid', //another controller function for generating data
          mtype : "post",     //Ajax request type. It also could be GET
          datatype: "json",   //supported formats XML, JSON or Arrray									
          colNames:['Nombre','Apellido paterno','Apellido materno','Programa de interes','Fecha','Primer contacto','Documentos','Enviar a decse','Envío de claves','Pago realizado','Eliminar'],       //Grid column headings
          colModel:[      											                                                                                         		                                                                                                                                                                                                                 
              {name:'nombre',index:'nombre',width:110,align:'left'}, 
              {name:'a_paterno',index:'a_paterno',width:120,align:'left'}, 
              {name:'a_materno',index:'a_materno',width:120,align:'left'},      		                                                                                                                                                                                                     
              {name:'program_name',index:'program_name',width:200,align:'left'},               					                                                                                                                                                                                            
              {name:'fecha_registro',index:'fecha_registro',width:100,align:'left',search:false},  		       				                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
              {name:'primer_contacto',index:'primer_contacto',edittype:'select',align:'center',formatter:'select', editoptions:{value:"0:;1:<img src='../../includes/admin/images/seguimiento/green.png'>"},search:false,sortable:false,width:60},                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           	
              {name:'documentos',index:'documentos',edittype:'select',align:'center',formatter:'select', editoptions:{value:"0:;1:<img src='../../includes/admin/images/seguimiento/green.png'>"},search:false,sortable:false,width:60},                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           	
              {name:'envio_decse',index:'envio_decse',edittype:'select',align:'center',formatter:'select', editoptions:{value:"0:;1:<img src='../../includes/admin/images/seguimiento/green.png'>"},search:false,sortable:false,width:60},                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           	
              {name:'envio_claves',index:'envio_claves',edittype:'select',align:'center',formatter:'select', editoptions:{value:"0:;1:<img src='../../includes/admin/images/seguimiento/green.png'>"},search:false,sortable:false,width:60},                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           	
			        {name:'pago_realizado',index:'pago_realizado',edittype:'select',align:'center',formatter:'select', editoptions:{value:"0:;1:<img src='../../includes/admin/images/seguimiento/green.png'>"},search:false,sortable:false,width:60},                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           	
              {name:'eliminar',search:false,width:60,fixed:true,sortable:false,resize:false,formatter:'actions',formatoptions:{
                    keys: true,   		        											   																		           									          						                                                                                                        
                    editbutton: false,             
                    editformbutton: false,
                    delbutton: true,                                                                                                                             
                    delOptions:{         			               			              
                        url: 'delete_inscrito', 				                                                                                                                                            
                        msg: "Desea eliminar el registro?",                                                          
                        afterSubmit: function (response, postdata) {
                            var r = $.parseJSON(response.responseText);
                            $("#msj").html(r.message);                   
                            return [r.success, r.message, null];
                        }                                                                                                                                                
                    }                               
                 }                  
      		}                 												                                        										
          ],                                                                                                                                                                                                                                
          rowNum:20,                        
          width:970,			                                    
          height:200,                             
          rowList:[10,20,30],
          pager: '#pager_inscritos',                                              
          sortname: 'id_preinscrito',                   
          viewrecords: true,                
          sortorder: "desc",            
          rownumbers: true,                 
          gridview: true,                                  
          caption:"Inscritos",       
          loadComplete:function(data){
            if(data.records == 0){    
              var msj = $("#msj");    
              msj.html(data.msg);
              setTimeout(function(){
                msj.empty();           
              },5000);                                                                                        
            }                                                                                                                                     
          }                                                                                                                                                                                                                                   
      }).navGrid('#pager_inscritos',{edit:false,add:false,del:false},
      {}, //  default settings for edit
    {}, //  default settings for add
    {},  // delete instead that del:false we need this
    {searchOnEnter:true,closeOnEscape:true}, // search options
    {} /* view parameters*/ 
    ).jqGrid('navButtonAdd',
      '#pager_inscritos',                                   
      {                 
        caption:"Exportar a Excel",
        buttonicon: "ui-icon-bookmark",
        onClickButton: this.exportar, position: "last"
      }                           
    );                                                                                                                                                                                                          
  },              

  exportar:function()
  {                                                                        
      $("#list_inscritos").jqGrid('excelExport',{url:'excel/'});       
  }                                                                        
}   

var casos_cerrados = {

  onReady:function()
  {                                    				                                                                                                                                                                                                                                                                                                                                                                                                          
      var base_url = $("#base_url").text();
      jQuery("#list_casos_cerrados").jqGrid({                                                
          url:base_url+'admin/casos_cerrados/jqGrid', //another controller function for generating data
          mtype : "post", //Ajax request type. It also could be GET
          datatype: "json", //supported formats XML, JSON or Arrray 					
          colNames:['Nombre','Apellido paterno','Apellido materno','Programa de interes','Fecha','Primer contacto','Documentos','Enviar a decse','Envío de claves','Pago realizado','Eliminar'],       //Grid column headings
          colModel:[                                       											                                                                                                                                                                                                                                                                                             
              {name:'nombre',index:'nombre',width:110,align:'left'}, 
              {name:'a_paterno',index:'a_paterno',width:120,align:'left'}, 
              {name:'a_materno',index:'a_materno',width:120,align:'left'},                                                                                                                                                                                                           
              {name:'program_name',index:'program_name',width:200,align:'left'},                                                                                                                                                                                                           
              {name:'fecha_registro',index:'fecha_registro',width:100,align:'left'},
              {name:'primer_contacto',index:'primer_contacto',edittype:'select',align:'center',formatter:'select', editoptions:{value:"0:;1:<img src='../../includes/admin/images/seguimiento/green.png'>"},search:false,sortable:false,width:60},                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           	
              {name:'documentos',index:'documentos',edittype:'select',align:'center',formatter:'select', editoptions:{value:"0:;1:<img src='../../includes/admin/images/seguimiento/green.png'>"},search:false,sortable:false,width:60},                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           	
              {name:'envio_decse',index:'envio_decse',edittype:'select',align:'center',formatter:'select', editoptions:{value:"0:;1:<img src='../../includes/admin/images/seguimiento/green.png'>"},search:false,sortable:false,width:60},                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           	
              {name:'envio_claves',index:'envio_claves',edittype:'select',align:'center',formatter:'select', editoptions:{value:"0:;1:<img src='../../includes/admin/images/seguimiento/green.png'>"},search:false,sortable:false,width:60},                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           	
			        {name:'pago_realizado',index:'pago_realizado',edittype:'select',align:'center',formatter:'select', editoptions:{value:"0:;1:<img src='../../includes/admin/images/seguimiento/green.png'>"},search:false,sortable:false,width:60},                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          
              {name:'eliminar',search:false,width:60,fixed:true,sortable:false,resize:false,formatter:'actions',formatoptions:{
                    keys: true,                                                                                                                          
                    editbutton: false,             
                    editformbutton: false,
                    delbutton: true,                                                                                                                             
                    delOptions:{                                  
                        url: 'delete_caso_cerrado',                                                                                                                                             
                        msg: "Desea eliminar el registro?",                                                          
                        afterSubmit: function (response, postdata) {
                            var r = $.parseJSON(response.responseText);
                            $("#msj").html(r.message);                   
                            return [r.success, r.message, null];
                        }                                                                                                                                                               
                    }                                    
                 }                  
              }																										                                                         
          ],                                                                                                                                                                                                                                     
          rowNum:20,                        
          width: 970,		                                    
          height:200,                                                      
          rowList:[10,20,30],           
          pager: '#pager_casos_cerrados',                                              
          sortname:"id_preinscrito", 
          sortorder:"desc",                  
          viewrecords: true,              
          rownumbers: true,                 
          gridview: true,                                  
          caption:"Casos cerrados", 
          loadComplete:function(data){
            if(data.records == 0){    
              var msj = $("#msj");    
              msj.html(data.msg);
              setTimeout(function(){
                msj.empty();           
              },5000);                                                                                        
            }                                                                                                                                     
          }                                                   
          //editurl:'delete'                                                                                                                                                                                    
      }).navGrid('#pager_casos_cerrados',{edit:false,add:false,del:false},
      {}, //  default settings for edit
    {}, //  default settings for add
    {},  // delete instead that del:false we need this
    {searchOnEnter:true,closeOnEscape:true}, // search options
    {} /* view parameters*/ 
    ).jqGrid('navButtonAdd',
      '#pager_casos_cerrados',                                   
      {                                                  
        caption:"Exportar a Excel",
        buttonicon: "ui-icon-bookmark",
        onClickButton: this.exportar, position: "last"
      }                           
    );                                                                                                                                                                                                               
  },                                       

  exportar:function()
  {                                                                                                 
      $("#list_casos_cerrados").jqGrid('excelExport',{url:'excel/'});       
  }        
}      
						                                      
var casos_inconclusos = {

  onReady:function()
  {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
      var base_url = $("#base_url").text();
      jQuery("#list_casos_inconclusos").jqGrid({                                                
          url:base_url+'admin/casos_inconclusos/jqGrid', //another controller function for generating data
          mtype : "post", //Ajax request type. It also could be GET
          datatype: "json", //supported formats XML, JSON or Arrray 											
          colNames:['Nombre','Apellido paterno','Apellido materno','Programa de interes','Fecha','Primer contacto','Documentos','Enviar a decse','Envío de claves','Pago realizado','Eliminar'],       //Grid column headings
          colModel:[                                                                                                                                                                                                                                                                                                                         
              {name:'nombre',index:'nombre',width:110,align:'left'}, 
              {name:'a_paterno',index:'a_paterno',width:120,align:'left'}, 
              {name:'a_materno',index:'a_materno',width:120,align:'left'},                                                                                                                                                                                                           
              {name:'program_name',index:'program_name',width:200,align:'left'},                                                                                                                                                                                                           
              {name:'fecha_registro',index:'fecha_registro',width:100,align:'left'},
              {name:'primer_contacto',index:'primer_contacto',edittype:'select',align:'center',formatter:'select', editoptions:{value:"0:;1:<img src='../../includes/admin/images/seguimiento/green.png'>"},search:false,sortable:false,width:60},                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           	
              {name:'documentos',index:'documentos',edittype:'select',align:'center',formatter:'select', editoptions:{value:"0:;1:<img src='../../includes/admin/images/seguimiento/green.png'>"},search:false,sortable:false,width:60},                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           	
              {name:'envio_decse',index:'envio_decse',edittype:'select',align:'center',formatter:'select', editoptions:{value:"0:;1:<img src='../../includes/admin/images/seguimiento/green.png'>"},search:false,sortable:false,width:60},                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           	
              {name:'envio_claves',index:'envio_claves',edittype:'select',align:'center',formatter:'select', editoptions:{value:"0:;1:<img src='../../includes/admin/images/seguimiento/green.png'>"},search:false,sortable:false,width:60},                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           	
			        {name:'pago_realizado',index:'pago_realizado',edittype:'select',align:'center',formatter:'select', editoptions:{value:"0:;1:<img src='../../includes/admin/images/seguimiento/green.png'>"},search:false,sortable:false,width:60},                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
              {name:'eliminar',search:false,width:60,fixed:true,sortable:false,resize:false,formatter:'actions',formatoptions:{
                    keys: true,                                                                                                                                
                    editbutton: false,             
                    editformbutton: false,
                    delbutton: true,                                                                                                                             
                    delOptions:{                                     
                        url: 'delete_casos_inconclusos',                                                                                                                                             
                        msg: "Desea eliminar el registro?",                                                          
                        afterSubmit: function (response, postdata) {
                            var r = $.parseJSON(response.responseText);
                            $("#msj").html(r.message);                   
                            return [r.success, r.message, null];
                        }                                                                                                                                                          
                    }                                            
                 }                      
              }               								                                                         
          ],                                                                                                                                                                                                                         
          rowNum:20,                           
          width: 970,                  		                                    
          height:200,                 
          rowList:[10,20,30],
          pager: '#pager_casos_inconclusos',                                              
          sortname: 'id_preinscrito',
          sortorder: "desc",                         
          viewrecords: true,        
          rownumbers: true,                 
          gridview: true,                                  
          caption:"Casos inconclusos", 
          loadComplete:function(data){
            if(data.records == 0){          
              var msj = $("#msj");    
              msj.html(data.msg); 
              setTimeout(function(){
                msj.empty();           
              },5000);                                                                                        
            }                                                                                                                                     
          }                                                                                                                                                                                                                                                
      }).navGrid('#pager_casos_inconclusos',{edit:false,add:false,del:false},
      {}, //  default settings for edit
      {}, //  default settings for add
      {},  // delete instead that del:false we need this
      {searchOnEnter:true,closeOnEscape:true}, // search options
      {} /* view parameters*/ 
      ).jqGrid('navButtonAdd',
        '#pager_casos_inconclusos',                                   
        {                                                        
          caption:"Exportar a Excel",
          buttonicon: "ui-icon-bookmark",
          onClickButton: this.exportar, position: "last"
        }                                                           
      );                                                                                                                                                                                                           
    },                                                                              

  exportar:function()
  {                                                                                             
      $("#list_casos_inconclusos").jqGrid('excelExport',{url:'excel/'});       
  }                                                                                   
}     

var informes = {

  onReady:function()
  {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           
      var base_url = $("#base_url").text();
      jQuery("#list_informes").jqGrid({                                                   
          url:base_url+'admin/informes/jqGrid', //another controller function for generating data
          mtype : "post", //Ajax request type. It also could be GET
          datatype: "json", //supported formats XML, JSON or Arrray                       
          colNames:['Nombre','Apellido paterno','Apellido materno','Programa de interes','Atendido','Eliminar'],       //Grid column headings
          colModel:[                                                                                                                                                                                                                                                                                                                                                          
              {name:'nombre',index:'nombre',width:130,search:true,sortable:true,align:'left',width:120,formatter:function(cellValue, options, rowdata, action){                                                                                                                                                                                                         
                return "<a href='informes_contacto/" + options.rowId + "' class='group1' name='edit'>"+cellValue+"</a>";                                    
              }},                                                                
              {name:'paterno',index:'paterno',width:120,align:'left'}, 
              {name:'materno',index:'materno',width:120,align:'left'},                                                                                                                                                                                                           
              {name:'program_name',index:'program_name',width:200,align:'left'},                                                                                                                                                                                                           
              {name:'atendido',index:'atendido',edittype:'select',align:'center',formatter:'select', editoptions:{value:"0:No;1:Si"},search:false,sortable:false,width:60},                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
              {name:'eliminar',search:false,width:60,fixed:true,sortable:false,resize:false,formatter:'actions',formatoptions:{
                    keys: true,                                                                                                                                             
                    editbutton: false,             
                    editformbutton: false,
                    delbutton: true,                                                                                                                                
                    delOptions:{                                           
                        url: 'delete_informes',                                                                                                                                             
                        msg: "Desea eliminar el registro?",                                                          
                        afterSubmit: function (response, postdata) {
                            var r = $.parseJSON(response.responseText);
                            $("#msj").html(r.message);                   
                            return [r.success, r.message, null];
                        }                                                                                                                                                          
                    }                               
                 }                  
              }                                                                           
          ],                                                                                                                                                                                                                         
          rowNum:5,                        
          width: 970,                                       
          //height: 300,            
          rowList:[10,20,30],   
          pager: '#pager_informes',                                              
          sortname: 'id', 
          sortorder: "desc",                        
          viewrecords: true,        
          rownumbers: true,                 
          gridview: true,                                  
          caption:"Informes", 
          loadComplete:function(data){
            if(data.records == 0){    
              var msj = $("#msj");    
              msj.html(data.msg);
              setTimeout(function(){
                msj.empty();           
              },5000);                                                                                        
            }                                                                                                                                            
          }                                                                                                                                                                                                                                                   
      }).navGrid('#pager_informes',{edit:false,add:false,del:false},
      {}, //  default settings for edit
    {}, //  default settings for add
    {},  // delete instead that del:false we need this
    {searchOnEnter:true,closeOnEscape:true}, // search options
    {} /* view parameters*/ 
    ).jqGrid('navButtonAdd',
        '#pager_informes',                                       
        {                                                        
          caption:"Exportar a Excel",
          buttonicon: "ui-icon-bookmark",
          onClickButton: this.exportar, position: "last"
        }                                                              
    );                         
    $("#list_informes a[name=edit]").live("click",informes.edit); 
  },                                                                              

  exportar:function()
  {                                                                                                                     
      $("#list_informes").jqGrid('excelExport',{url:'excel/'});       
  },          

  edit:function(e)
  {       
    e.preventDefault();
    $.colorbox({href:$(this).attr("href"),iframe:true, width:"850px", height:"90%"});
  }				                
} 
                                                                                                                               
$(document).ready(function(){ 
    filtro.onReady();                
    users.onReady(); 
    preinscritos.onReady(); 
    inscritos.onReady();   
    casos_cerrados.onReady();     
    casos_inconclusos.onReady();      
    informes.onReady();              
});                                                                 