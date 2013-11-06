<div id="show_preinscritos">
	<script>		
		$(function() {
			$( document ).tooltip();
		});		
	</script>
	<style>			
		.comment_i{
			display:inline;
		}				
	</style>	
	<div class="jqgrid">
	<div id="msj">
		<?php 										
		echo isset($msj)?$msj:'';
		?>																										
	</div>		
	<table id="list_preinscritos"></table><!--Grid table-->
    <div id="pager_preinscritos"></div>  <!--pagination div-->
	</div>	
</div>																																				