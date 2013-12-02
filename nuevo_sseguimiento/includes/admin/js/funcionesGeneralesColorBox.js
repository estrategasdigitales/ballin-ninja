var colorBox = {
	indice_file:1,

	onReady:function()
  {
  	$("#agregar_input_file").on("click",colorBox.agregar_input_file);
    $("#estatus_proceso a").on("click",colorBox.mostrar_text_area);
    $("#comentarios,#clasificar_aspirante a").on("click",colorBox.mostrar_text_area);
  },                                                                                                                                                                                             
          
  agregar_input_file:function(e)
  {                                         
  	e.preventDefault();	
    var div = $("<div></div>");	                            
  	var file = "<input type='file' name='documento_upload[]'>";
    var doc_type = "<input type='text' name='doc_type[]'>";
	  div.append(file);            
    div.append(doc_type);                                               
    $("#subir_documentos").append(div);                   
    colorBox.indice_file++;                                           				  			
  },                                                                   

  mostrar_text_area:function(e)
  {                     
    e.preventDefault();                     
    var rel = $(this).attr("rel");
    $("#"+rel).css("display","block");
  }             
};  

$(document).ready(function() {  
    colorBox.onReady();                   
});  