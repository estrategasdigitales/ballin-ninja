<script>
function simple_tooltip(target_items, name){
 $(target_items).each(function(i){
		$("body").append("<div class='"+name+"' id='"+name+i+"'><p>"+$(this).attr('title')+"</p></div>");
		var my_tooltip = $("#"+name+i);

		$(this).removeAttr("title").mouseover(function(){
				my_tooltip.css({opacity:1.0, display:"none"}).fadeIn(400);
		}).mousemove(function(kmouse){
				my_tooltip.css({left:kmouse.pageX+10, top:kmouse.pageY+10});
		}).mouseout(function(){
				my_tooltip.fadeOut(200);
		});
	});
}									
$(document).ready(function() {
	
	simple_tooltip("a.tooltip_a","tooltip");
									
});
</script>		  								  
<style>
.tooltip{
    position:absolute;
    z-index:999;
    left:-9999px;
    background-color:#dedede;
    padding:2px;
    border:1px solid #fff;
	border-radius:5px;
	width:200px;
}

.tooltip p{
    margin:0;
    padding:0;
    color:#fff;
    background-color:#F00;
    padding:5px;
	border-radius:5px;
}
</style>		
<div id="show_preinscritos">																
	<div class="jqgrid">
		<div id="msj">
			<?php 										
			echo isset($msj)?$msj:'';
			?>																																
		</div>																																																																				
		<table id="list_preinscritos"></table><!--Grid table-->
	    <div id="pager_preinscritos"></div><!--pagination div-->
	</div>	
</div>																																				